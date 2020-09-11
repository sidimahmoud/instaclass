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
                    <button class="btn btn-primary" @click="getAccessToken">Join Test</button>
                </div>
                <div class="m-2 bg-black text-center" v-if="started">
                    <div class="border border-dark m-2 p-1 rounded" id="video-chat-window"></div>

                    <button class="btn btn-danger" @click="endRoom">End course</button>
                    <button class="btn btn-primary" @click="shareScreen" v-if="!sharing">Share screen</button>
                    <button class="btn btn-danger" @click="stopSaring" v-if="sharing">Stop sharing</button>
                    <button class="btn btn-primary" @click="roomDetails" :disabled="!roomSid">Details</button>
                    <button class="btn btn-primary" @click="roomParticipants">Participants</button>
                    <button class="btn btn-primary" @click="roomRecordings">Recordings</button>
                    <!--<button class="btn btn-primary" @click="rooms">My rooms</button>-->
                </div>
            </div>
            <div class="col-md-2">
                <div>
                    <h3 class="border-bottom text-center">Participants</h3>
                </div>
                <ul id="participants-list">
                    <li v-for="p in participants">{{p}}</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import CountDown from "../CountDown";

    export default {
        name: 'LiveWindowCompo',
        components: {
            CountDown
        },
        data() {
            return {
                accessToken: '',
                started: false,
                myRoom: 'test',
                user: 'teacher@gmail.com',
                roomSid: false,
                participants: [],
                sharing: false,
            }
        },
        methods: {
            getAccessToken() {
                const _this = this;
                // Request a new token
                let token = localStorage.getItem('token');
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
                axios.get(`https://instantclass.herokuapp.com/api/access_token/${_this.myRoom}/${_this.user}`)
                    .then(function (response) {
                        _this.accessToken = response.data;
                        _this.started = true;
                        _this.connectToRoom()
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            createRoom() {
                let token = localStorage.getItem('token');
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
                axios.post(`https://instantclass.herokuapp.com/api/create_room/${this.myRoom}`).then(res => {
                        console.log(res.data);
                        this.roomSid = res.data.sid;
                        this.accessToken = res.data.token;
                        this.myRoom = res.data.name;
                        this.connectToRoom();
                    }
                ).catch(err => console.log(err.response))
            },
            connectToRoom() {
                const {connect, createLocalVideoTrack} = require('twilio-video');
                connect(this.accessToken, {name: this.myRoom}).then(room => {
                    console.log(`Successfully joined a Room: ${room}`);
                    this.roomSid = room.sid;
                    const videoChatWindow = document.getElementById('video-chat-window');
                    createLocalVideoTrack().then(track => {
                        videoChatWindow.appendChild(track.attach());
                        $('#video-chat-window > video').css({
                            'width': '100%',
                            'position': 'relative',
                            'margin-left': '0px',
                            'max-height': '80%',
                        });
                    });
                    room.on('participantConnected', participant => {
                        console.log(`Participant "${participant.identity}" connected`);
                        this.participants.push(participant.identity);
                        // participant.tracks.forEach(publication => {
                        //     if (publication.isSubscribed) {
                        //     }
                        // });
                        participant.on('trackSubscribed', track => {
                        videoChatWindow.appendChild(track.attach());
                        });
                    });
                }, error => {
                    console.error(`Unable to connect to Room: ${error.message}`);
                });
            },
            endRoom() {
                let token = localStorage.getItem('token');
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
                axios.post(`https://instantclass.herokuapp.com/api/endroom/${this.myRoom}`).then(() => {
                        console.log("ended");
                        this.$router.push({name: "TeacherProfile"});
                    }
                ).catch(err => console.log(err.response))
            },

            roomDetails() {
                let token = localStorage.getItem('token');
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
                axios.get(`https://instantclass.herokuapp.com/api/room-details/${this.myRoom}`).then(res => {
                        console.log(res.data);
                    }
                ).catch(err => console.log(err.response))
            },
            roomRecordings() {
                let token = localStorage.getItem('token');
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
                axios.get(`https://instantclass.herokuapp.com/api/room-recordings}`).then(res => {
                        console.log(res.data);
                    }
                ).catch(err => console.log(err.response))
            },
            async shareScreen() {
                const {connect, LocalVideoTrack} = require('twilio-video');
                connect(this.accessToken, {name: this.myRoom}).then(room => {
                    navigator.mediaDevices.getDisplayMedia().then(stream => {
                        const screenTrack = new LocalVideoTrack(stream.getTracks()[0]);
                        room.localParticipant.publishTrack(screenTrack);
                    }).catch(() => {
                        alert('Could not share the screen.')
                    });
                })
            },
            stopSaring() {
                room.localParticipant.unpublishTrack(screenTrack);
                screenTrack.stop();
                screenTrack = null;
                this.sharing = false;
            },
            roomParticipants() {
                let token = localStorage.getItem('token');
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
                axios.get(`https://instantclass.herokuapp.com/api/room/${this.roomSid}/participants`).then(res => {
                        console.log(res.data);
                    }
                ).catch(err => console.log(err.response))
            },
            rooms() {
                let token = localStorage.getItem('token');
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
                axios.get(`https://instantclass.herokuapp.com/api/rooms/${this.myRoom}`).then(res => {
                        console.log(res.data);
                    }
                ).catch(err => console.log(err.response))
            },
        },
    }
</script>
