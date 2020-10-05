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
                    <button class="btn btn-primary" @click="getAccessToken">Join Course</button>
                </div>
                <div class="m-2 bg-black text-center" v-if="started">
                    <div class="border border-dark m-2 p-1 rounded" id="video-chat-window"></div>

                    <button class="btn btn-danger" @click="leaveCourse" v-if="sharing">Leave Course</button>

                </div>
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
                recorded: true,
                myRoom: 'hello',
                user: 'Student ',
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
            connectToRoom() {
                const {connect, createLocalTracks, createLocalVideoTrack, createLocalAudioTrack} = require('twilio-video');
                connect(this.accessToken, {name: this.myRoom}).then(room => {
                    console.log(`Successfully joined a Room: ${room}`);
                    this.roomSid = room.sid;
                    this.activeRoom = room;
                    const videoChatWindow = document.getElementById('video-chat-window');
                    createLocalVideoTrack().then(track => {
                        videoChatWindow.appendChild(track.attach())
                    });
                    createLocalAudioTrack().then(track => {
                        videoChatWindow.appendChild(track.attach())
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
                        // room.tracks.forEach(track => {
                        //     // const track = publication.track;
                        //     videoChatWindow.appendChild(track.attach());
                        // });
                        participant.on('trackSubscribed', track => {
                            videoChatWindow.appendChild(track.attach());
                        });
                    });
                    room.on('participantDisconnected', participant => {
                        console.log(`Participant ${participant.identity} disconnected`);
                        this.participants.splice(this.participants.indexOf(participant.identity), 1);
                        // participant.tracks.forEach(function (track) {
                        //     track.detach().forEach(function (mediaElement) {
                        //         mediaElement.remove();
                        //     });
                        // });
                    });
                    room.on('trackAdded', function (track, participant) {
                        console.log(participant.identity + " added track: " + track.kind);
                        videoChatWindow.appendChild(track.attach());
                    });
                }, error => {
                    console.error(`Unable to connect to Room: ${error.message}`);
                });
            },
        },
    }
</script>
