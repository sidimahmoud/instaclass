<template>
    <div class="container-fluid border-top border-primary pt-4">
        <div class="row">
            <div class="col-md-10">
                <div class="text-center" v-if="!started">
                    <h1>Course has to start after</h1>
                    <div class="row my-3">
                        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                            <Count-down
                                :year="2020"
                                :month="9"
                                :day="1"
                                :hour="0"
                                :minute="0"
                                :second="0"
                                :text="false"
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" id="user" class="form-control" v-model="user">
                    </div>
                    <button class="btn btn-primary" @click="createRoom">Start now</button>
                    <button class="btn btn-primary" @click="getAccessToken">Join Course</button>

                </div>
                <div class="m-2 bg-black text-center" v-if="started">
                    <div class="border border-dark m-2 p-1 rounded" id="video-chat-window"></div>

                    <button class="btn btn-danger" @click="endRoom">End course</button>
                    <button class="btn btn-primary" @click="shareScreen" v-if="!sharing">Share screen</button>
                    <button class="btn btn-danger" @click="stopSaring" v-if="sharing">Stop sharing</button>
                    <button class="btn btn-primary" @click="roomDetails" :disabled="!roomSid">Details</button>
                    <button class="btn btn-primary" @click="roomParticipants">Participants</button>
                    <button class="btn btn-primary" @click="roomRecordings">Recordings</button>
                </div>
            </div>
            <div class="col-md-2">
                <div>
                    <h3 class="border-bottom text-center">Participants</h3>
                </div>
                <ul id="participants-list">
                    <li v-for="p in participants">{{p}}
                        <button class="btn btn-danger ml-3" @click="removeParticipant(p)">X</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import CountDown from "../CountDown";
    import user from "../../store/modules/user";

    export default {
        name: 'LiveWindowCompo',
        components: {
            CountDown
        },
        data() {
            return {
                accessToken: '',
                started: false,
                recorded: true,
                myRoom: 'hello',
                user: 'teacher@gmail.com',
                roomSid: false,
                activeRoom: '',
                participants: [],
                sharing: false,
            }
        },
        methods: {
            getAccessToken() {
                const _this = this;
                // Request a new token
                axios.get(`/access_token/${this.myRoom}/${this.user}`)
                    .then(response => {
                        _this.accessToken = response.data;
                        _this.started = true;
                        _this.connectToRoom()
                    })
                    .catch(error => console.log(error))
            },
            createRoom() {
                axios.post(`/create-room/${this.myRoom}/${this.user}/${this.recorded}`).then(res => {
                        console.log(res.data);
                        this.started = true;
                        this.roomSid = res.data.sid;
                        this.accessToken = res.data.token;
                        this.myRoom = res.data.name;
                        this.connectToRoom();
                    }
                ).catch(err => console.log(err.response))
            },
            connectToRoom() {
                const {connect, createLocalTracks} = require('twilio-video');
                connect(this.accessToken, {name: this.myRoom}).then(room => {
                    console.log(`Successfully joined a Room: ${room}`);
                    this.roomSid = room.sid;
                    this.activeRoom = room;
                    const videoChatWindow = document.getElementById('video-chat-window');
                    createLocalTracks({
                        audio: true,
                        video: {width: 1280, height: 300},
                    }).then(localTracks => {
                        localTracks.forEach(track => videoChatWindow.appendChild(track.attach())
                        );
                    });
                    room.on('participantConnected', participant => {
                        console.log(`Participant "${participant.identity}" connected`);
                        this.participants.push(participant.identity);
                        participant.tracks.forEach(publication => {
                            if (publication.isSubscribed) {
                                const track = publication.track;
                                videoChatWindow.appendChild(track.attach());
                            }
                        });
                        participant.on('trackSubscribed', track => {
                            videoChatWindow.appendChild(track.attach());
                        });
                    });
                    room.on('participantDisconnected', participant => {
                        console.log(`Participant ${participant.identity} disconnected`);
                        this.participants.splice(this.participants.indexOf(participant.identity), 1);
                        participant.tracks.forEach(function (track) {
                            track.detach().forEach(function (mediaElement) {
                                mediaElement.remove();
                            });
                        });
                    });

                }, error => {
                    console.error(`Unable to connect to Room: ${error.message}`);
                });
            },
            endRoom() {
                axios.post(`/endroom/${this.myRoom}`)
                    .then(res => {
                        console.log(res.data);
                        this.$router.push({name: "TeacherProfile"});
                    })
                    .catch(err => console.log(err.response))
            },
            removeParticipant(user) {
                axios.post(`/remove-participant/${this.roomSid}/${user}`)
                    .then(res => {
                        console.log(res.data);
                    })
                    .catch(err => console.log(err.response))
            },

            roomDetails() {
                axios.get(`/room-details/${this.myRoom}`)
                    .then(res => console.log(res.data))
                    .catch(err => console.log(err.response))
            },
            roomRecordings() {
                axios.get(`/room-recordings/${this.roomSid}`).then(res => {
                        console.log(res.data);
                    }
                ).catch(err => console.log(err.response))
            },
            shareScreen() {
                const {LocalVideoTrack} = require('twilio-video');

                navigator.mediaDevices.getDisplayMedia()
                    .then(stream => {
                        const scknreenTrack = new LocalVideoTrack(stream.getTracks()[0]);
                        this.activeRoom.localParticipant.publishTrack(screenTrack);
                    }).catch(err => {
                    console.log(err)
                    // alert('Could not share the screen.')
                });
            },
            stopSaring() {
                this.activeRoom.localParticipant.unpublishTrack(screenTrack);
                screenTrack.stop();
                screenTrack = null;
                this.sharing = false;
            },
            leaveCourse() {
                this.activeRoom.localParticipant.tracks.forEach(track => {
                    track.stop()
                });
                this.removeParticipant(this.activeRoom.localParticipant)
            },
            roomParticipants() {
                axios.get(`room/${this.roomSid}/participants`).then(res => {
                        console.log(res.data);
                    }
                ).catch(err => console.log(err.response))
            },
        },
    }
</script>
