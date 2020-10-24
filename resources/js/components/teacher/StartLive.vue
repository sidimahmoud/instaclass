<template>
  <div class="container-fluid border-top border-primary video-call-screen">
    <div class="row">
      <div class="col-md-6">
        <div class="m-2 bg-black text-center">
          <div class="main-window m-2 p-1 rounded position-relative">
            <div id="video-main-window"></div>
            <div class="control-panel position-absolute">
              <i
                class="fa fa-video-camera"
                v-bind:class="cameraStatus ? 'on' : 'off'"
                aria-hidden="true"
                v-on:click="updateCameraStatus()"
              ></i>
              <i
                class="fa fa-microphone"
                v-bind:class="micStatus ? 'on' : 'off'"
                aria-hidden="true"
                v-on:click="updateMicStatus()"
              ></i>
            </div>
          </div>
          <button class="btn btn-danger" @click="endRoom">End course</button>
          <button
            class="btn btn-primary"
            @click="shareScreen"
            v-if="!sharing"
            :disabled="true"
          >
            Share screen
          </button>
          <button class="btn btn-danger" @click="stopSaring" v-if="sharing">
            Stop sharing
          </button>
          <button
            class="btn btn-primary"
            @click="roomDetails"
            :disabled="!roomSid"
          >
            Details
          </button>
          <button class="btn btn-primary" @click="roomParticipants">
            Participants
          </button>
          <button class="btn btn-primary" @click="roomRecordings">
            Recordings
          </button>
        </div>
      </div>
      <div class="col-md-4">
        <div
          class="sub-window m-2 p-1 rounded"
          id="video-sub-window"
          v-if="videoItems.length"
        >
          <div
            v-for="(item, index) in videoItems"
            :key="`index-${index}`"
            class="video-item"
          >
            <h5>{{ item.name }}</h5>
            <div v-bind:id="'video-' + item.id"></div>
          </div>
        </div>
      </div>
      <div class="col-md-2 pt-4">
        <div>
          <h3 class="border-bottom text-center">Participants</h3>
        </div>
        <ul id="participants-list">
          <li v-for="p in participants" class="my-2 shadow-sm" :key="p.id">
            {{ p.name }}
            <button
              class="btn btn-danger ml-3"
              @click="removeParticipant(p.id)"
            >
              X
            </button>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import user from "../../store/modules/user";

export default {
  name: "StartLive",
  data: function () {
    return {
      accessToken: "",
      recorded: false,
      myRoom: "",
      user: "teacher",
      roomSid: false,
      activeRoom: "",
      stream: "",
      participants: [],
      sharing: false,
      videoItems: [],
      cameraStatus: true,
      micStatus: true,
      myVideoTrack: null,
      myAudioTrack: null,
    };
  },
  methods: {
    createRoom() {
      this.myRoom = this.create_link();
      axios
        .post(`/create-room/${this.myRoom}/${this.user}/${this.recorded}`)
        .then((res) => {
          console.log(res.data);
          this.started = true;
          this.roomSid = res.data.sid;
          this.accessToken = res.data.token;
          this.myRoom = res.data.name;
          this.connectToRoom();
        })
        .catch((err) => console.log(err.response));
    },

    connectToRoom() {
      const _vue = this;
      const {
        connect,
        createLocalTracks,
        createLocalVideoTrack,
        createLocalAudioTrack,
      } = require("twilio-video");
      connect(this.accessToken, { name: this.myRoom }).then(
        (room) => {
          console.log(`Successfully joined a Room: ${room}`);
          this.roomSid = room.sid;
          this.activeRoom = room;
          const videoChatWindow = document.getElementById("video-main-window");
          room.localParticipant.videoTracks.forEach((publication) => {
            videoChatWindow.appendChild(publication.track.attach());
            this.myVideoTrack = publication.track;
          });
          room.localParticipant.audioTracks.forEach((publication) => {
            videoChatWindow.appendChild(publication.track.attach());
            this.myAudioTrack = publication.track;
          });

          // publication.track.attach() +
          room.on("participantConnected", (participant) => {
            console.log(`Participant "${participant.identity}" connected`);
            this.participants.push({
              id: participant.identity,
              name: participant.identity.split("-")[0],
            });

            participant.tracks.forEach((publication) => {
              if (publication.isSubscribed) {
                console.log("isSubscribid");
                // const track = publication.track;
                // videoChatWindow.appendChild(track.attach());
              }
            });

            participant.on("trackSubscribed", (track) => {
              //   videoChatWindow.appendChild(track.attach());
              if (
                _vue.videoItems.findIndex(
                  (item) => item.id == participant.identity
                ) == -1
              ) {
                _vue.videoItems.push({
                  id: participant.identity,
                  name: participant.identity.split("-")[0],
                });
              }
              setTimeout(() => {
                var videoSection = document.getElementById(
                  "video-" + participant.identity
                );
                videoSection.appendChild(track.attach());
              }, 1);
            });
          });
          room.on("participantDisconnected", (participant) => {
            console.log(`Participant ${participant.identity} disconnected`);
            this.videoItems.splice(
              this.videoItems.indexOf(
                (item) => item.id == participant.identity
              ),
              1
            );
            this.participants.splice(
              this.participants.indexOf(
                (item) => item.id == participant.identity
              ),
              1
            );
          });
          room.on("trackAdded", function (track, participant) {
            console.log(participant.identity + " added track: " + track.kind);
            // videoChatWindow.appendChild(track.attach());
          });
        },
        (error) => {
          console.error(`Unable to connect to Room: ${error.message}`);
        }
      );
    },
    shareScreen() {
      const { LocalVideoTrack } = require("twilio-video");
      navigator.mediaDevices
        .getDisplayMedia()
        .then((stream) => {
          let screenTrack = LocalVideoTrack(stream.getTracks()[0]);
          this.activeRoom.localParticipant.publishTrack(screenTrack);
        })
        .catch((err) => {
          console.log(err);
          alert("Could not share the screen.");
        });
    },
    stopSaring() {
      this.activeRoom.localParticipant.unpublishTrack(screenTrack);
      screenTrack.stop();
      screenTrack = null;
      this.sharing = false;
    },
    endRoom() {
      axios
        .post(`/endroom/${this.myRoom}`)
        .then((res) => {
          this.stream.stop().then(() => {
            this.$router.push({ name: "TeacherProfile" });
          });
        })
        .catch((err) => this.$router.push({ name: "TeacherProfile" }));
    },
    removeParticipant(user) {
      axios
        .post(`/remove-participant/${this.roomSid}/${user}`)
        .then((res) => {
          console.log(res.data);
          var response = res.data;
          if (response.user) {
          }
        })
        .catch((err) => console.log(err.response));
    },

    roomDetails() {
      axios
        .get(`/room-details/${this.myRoom}`)
        .then((res) => console.log(res.data))
        .catch((err) => console.log(err.response));
    },
    roomRecordings() {
      axios
        .get(`/room-recordings/${this.roomSid}`)
        .then((res) => {
          console.log(res.data);
        })
        .catch((err) => console.log(err.response));
    },

    leaveCourse() {
      this.activeRoom.disconnect();
      this.activeRoom.localParticipant.tracks.forEach((track) => {
        track.stop();
      });
    },
    roomParticipants() {
      axios
        .get(`room/${this.roomSid}/participants`)
        .then((res) => {
          console.log(res.data);
        })
        .catch((err) => console.log(err.response));
    },
    create_link() {
      var dt = new Date().getTime();
      var uuid = "IC-xxx-xxx-xxx".replace(/[xy]/g, function (c) {
        var r = (dt + Math.random() * 16) % 16 | 0;
        dt = Math.floor(dt / 16);
        return (c == "x" ? r : (r & 0x3) | 0x8).toString(16);
      });
      return uuid;
    },
    updateMicStatus() {
      console.log("updateMicStatus");
      if (this.micStatus) {
        this.micStatus = false;
        this.myAudioTrack.disable();
      } else {
        this.micStatus = true;
        this.myAudioTrack.enable();
      }
      console.log(this.micStatus);
    },
    updateCameraStatus() {
      console.log("updateCameraStatus");
      if (this.cameraStatus) {
        this.cameraStatus = false;
        this.myVideoTrack.disable();
      } else {
        this.cameraStatus = true;
        this.myVideoTrack.enable();
      }
    },
  },
  created() {
    this.createRoom();
  },
};
</script>
<style scoped>
.video-call-screen {
  height: 100vh;
  background: #565656;
  padding-top: 5vh;
}

.main-window {
  background: #565656;
  border: 1px solid #565656;
}

.sub-window {
  border: 1px solid #565656;
}

#video-main-window {
  /* height: 500px; */
  height: 80vh;
}
#video-main-window >>> video {
  width: 100%;
  height: 100%;
  object-fit: fill;
}

#video-sub-window {
  display: flex;
  flex-direction: column;
  height: 80vh;
  overflow-y: auto;
}
#video-sub-window >>> video {
  width: 100%;
}
.video-item {
  margin-top: 10px;
  width: 100%;
  padding: 10px;
}
.control-panel {
  bottom: 0;
  width: 100%;
  text-align: center;
}
.control-panel .fa {
  font-size: 25px;
  margin: 10px;
  cursor: pointer;
}
.control-panel .off {
  color: #f4253e;
}
.control-panel .on {
  color: #252629;
}

::-webkit-scrollbar {
  width: 12px;
}

::-webkit-scrollbar-track {
  box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
  border-radius: 10px;
}

::-webkit-scrollbar-thumb {
  border-radius: 10px;
  box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.5);
}
</style>