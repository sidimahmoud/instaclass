<template>
    <div class="container-fluid border-top border-primary pt-4">
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

        <div class="grid grid-flow-row grid-cols-3 grid-rows-3 gap-4 bg-black">
            <div id="video-chat-window"></div>
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
                started: false
            }
        },
        methods: {
            getAccessToken: function () {
                const _this = this;
                // Request a new token
                let token = localStorage.getItem('token');
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
                axios.get('https://instantclass.herokuapp.com/api/access_token')
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
            connectToRoom: function () {

                const {connect, createLocalVideoTrack} = require('twilio-video');

                connect(this.accessToken, {name: 'cool room'}).then(room => {

                    console.log(`Successfully joined a Room: ${room}`);

                    const videoChatWindow = document.getElementById('video-chat-window');

                    createLocalVideoTrack().then(track => {
                        videoChatWindow.appendChild(track.attach());
                    });

                    room.on('participantConnected', participant => {
                        console.log(`Participant "${participant.identity}" connected`);

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
                }, error => {
                    console.error(`Unable to connect to Room: ${error.message}`);
                });
            }
        },
        mounted: function () {
            // this.getAccessToken()
        }
    }
</script>
