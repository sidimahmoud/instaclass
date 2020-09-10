<template>
    <div class="container-fluid border-top border-primary pt-4">
        <div class="row">
            <div class="col-md-9">
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
                    <button class="btn btn-primary" @click="getAccessToken">Start now</button>
                </div>
                <div class="m-2 bg-black text-center" v-if="started">
                    <div class="border border-dark m-2 p-1 rounded" id="video-chat-window"></div>
                </div>
                <div class="text-center" v-if="started">
                    <button class="btn btn-danger" @click="endRoom">End course</button>
                    <!--                    <button class="btn btn-primary" @click="createRoom">Create</button>-->
                    <button class="btn btn-primary" @click="roomDetails" :disabled="!roomSid">Details</button>
                    <button class="btn btn-primary" @click="roomParticipants">Participants</button>
                    <button class="btn btn-primary" @click="rooms">My rooms</button>
                </div>
            </div>
            <div class="col-md-3">
                <div>
                    <h3 class="border-bottom text-center">Participants</h3>
                </div>
                <ul id="participants-list">

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
                myRoom: 'hello',
                user: 'teacher@gmail.com',
                roomSid: false
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
                    .then(function () {
                        console.log(_this.accessToken)
                    });
            },
            connectToRoom() {

                const {connect, createLocalVideoTrack} = require('twilio-video');
                connect(this.accessToken, {name: this.myRoom}).then(room => {
                    console.log(`Successfully joined a Room: ${room}`);
                    this.roomSid=room;
                    const videoChatWindow = document.getElementById('video-chat-window');
                    createLocalVideoTrack().then(track => {
                        videoChatWindow.appendChild(track.attach());
                        $('#video-chat-window > video').css({
                            'width': '80%',
                            'position': 'relative',
                            // 'height': '80%',
                            'margin-left': '0px'
                        });
                    });
                    room.on('participantConnected', participant => {
                        console.log(`Participant "${participant.identity}" connected`);
                        participant.tracks.forEach(publication => {
                            if (publication.isSubscribed) {
                                const node = document.createElement("LI");
                                const textnode = document.createTextNode(participant.identity);
                                node.appendChild(textnode);
                                document.getElementById('#participants-list').appendChild(node);
                            }
                        });
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
            createRoom() {
                let token = localStorage.getItem('token');
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
                axios.post(`https://instantclass.herokuapp.com/api/create_room/${this.myRoom}`).then(res => {
                        console.log(res.data);
                        this.roomSid = res.data.sid;
                    }
                ).catch(err => console.log(err.response))
            },
            roomDetails() {
                let token = localStorage.getItem('token');
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
                axios.get(`https://instantclass.herokuapp.com/api/room/${this.myRoom}`).then(res => {
                        console.log(res.data);
                    }
                ).catch(err => console.log(err.response))
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
