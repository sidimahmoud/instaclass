<template>
  <div class="container-fluid border-top border-primary video-call-screen">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-10">
            <div class="m-2 bg-black text-center">
              <div class="main-window-dark m-2 p-1 rounded position-relative">
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
            </div>
          </div>
          <div class="col-md-2">
            <h5 style="color:#000">You</h5>
            <div id="video-my-self"></div>
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
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import CountDown from "../CountDown";

export default {
  name: "LiveWindowCompo",
  components: {
    CountDown,
  },
  data() {
    return {
      accessToken: "",
      recorded: true,
      myRoom: this.$route.params.slug,
      sid: this.$route.params.sid,
      user: "Student",
      roomSid: false,
      activeRoom: "",
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
    onJoinCourse() {
      const _this = this;
      // Request a new token
      axios
        .get(`/room-details/${this.sid}`)
        .then((res) => {
          console.log("result", res.data);
          var response = res.data;
          if (response.status == "in-progress") {
            this.getAccessToken();
          } else {
            this.$router.push({ name: "StudentProfile" });
          }
        })
        .catch((err) => console.log("error", err.response));
    },

    getAccessToken() {
      const _this = this;
      // Request a new token
      axios
        .get(`/access_token/${this.myRoom}/${this.user}`)
        .then((response) => {
          _this.accessToken = response.data;
          _this.started = true;
          _this.connectToRoom();
        })
        .catch((error) => {
          console.log(error);
          this.$router.push({ name: "StudentProfile" });
        });
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
          //const videoChatWindow = document.getElementById("video-main-window");
          const videoChatWindow = document.getElementById("video-my-self");
          room.localParticipant.videoTracks.forEach((publication) => {
            videoChatWindow.appendChild(publication.track.attach());
            this.myVideoTrack = publication.track;
          });
          room.localParticipant.audioTracks.forEach((publication) => {
            videoChatWindow.appendChild(publication.track.attach());
            this.myAudioTrack = publication.track;
          });

          room.participants.forEach((participant) => {
            console.log("participant forEach", participant);
            if (participant.isSubscribed) {
              console.log("isSubscribed");
            }

            participant.tracks.forEach((publication) => {
              if (publication.isSubscribed) {
                // const track = publication.track;
                // mainVideoWindow.appendChild(track.attach());
              }
            });

            participant.on("trackSubscribed", (track) => {
              // mainVideoWindow.appendChild(track.attach());
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
                console.log('participant.identity');
                console.log(participant.identity);
                if(participant.identity == "teacher-identity") {
                  var teacherChatWindow = document.getElementById("video-main-window");
                  teacherChatWindow.appendChild(track.attach());
                }else {
                  var videoSection = document.getElementById(
                    "video-" + participant.identity
                  );
                  videoSection.appendChild(track.attach());
                }
              }, 500);
            });
          });

          room.on("participantConnected", (participant) => {
            console.log(`Participant "${participant.identity}" connected`);
            this.participants.push({
              id: participant.identity,
              name: participant.identity.split("-")[0],
            });

            participant.tracks.forEach((publication) => {
              if (publication.isSubscribed) {
                console.log("isSubscribid");
                /* const track = publication.track;
                videoChatWindow.appendChild(track.attach()); */
              }
            });

            participant.on("trackSubscribed", (track) => {
                 //videoChatWindow.appendChild(track.attach());
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
                console.log('participant.identity');
                console.log(participant.identity);
                if(participant.identity == "teacher-identity") {
                  var teacherChatWindow = document.getElementById("video-main-window");
                  teacherChatWindow.appendChild(track.attach());
                }else {
                  var videoSection = document.getElementById(
                    "video-" + participant.identity
                  );
                  videoSection.appendChild(track.attach());
                }
              }, 500);
            });
          });
          room.on("participantDisconnected", (participant) => {
            console.log(`Participant ${participant.identity} disconnected`);
            if (participant.identity == "teacher-identity") {
              this.$router.push({ name: "StudentProfile" });
            }
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
    updateMicStatus() {
      console.log("updateMicStatus");
      if (this.micStatus) {
        this.micStatus = false;
        this.myAudioTrack.disable();
      } else {
        this.micStatus = true;
        this.myAudioTrack.enable();
      }
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
    console.log('last update')
    this.onJoinCourse();
  },
};
</script>


<style  scoped>
.video-call-screen {
  height: 100vh;
  background: #F0F8FF;
  padding-top: 5vh;
}

.main-window {
  background: #fff;
  border: 1px solid #eee;
}

.sub-window {
  border: 1px solid #eee;
}

#video-main-window {
  height: 90vh;
}

#video-main-window >>> video {
  width: 100%;
  height: 100%;
  object-fit: fill;
}

#video-sub-window {
  display: flex;
  flex-direction: column;
  height: 90vh;
  overflow-y: auto;
}
#video-sub-window >>> video {
  width: 90%;
}

#video-my-self {
  width: 100%;
  padding: 5px;
}

.video-item {
  width: 100%;
  padding: 5px;
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
