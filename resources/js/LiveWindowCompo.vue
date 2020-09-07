<template>
    <div class="p-5">
        <h1 class="text-2xl mb-4">Laravel Video Chat</h1>
        <div class="grid grid-flow-row grid-cols-3 grid-rows-3 gap-4 bg-black">
            <div id="my-video-chat-window"></div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        name: 'LiveWindowCompo',
        data: function () {
            return {
                accessToken: ''
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
                        _this.accessToken = response.data
                        console.log(response.data)
                        _this.connectToRoom()

                    })
                    .catch(function (error) {
                        console.log(error);
                    })
                    .then(function () {
                        console.log(_this.accessToken)
                    });
            },
            connectToRoom : function () {

                const { connect, createLocalVideoTrack } = require('twilio-video');

                connect( this.accessToken, { name:'cool room' }).then(room => {

                    console.log(`Successfully joined a Room: ${room}`);

                    const videoChatWindow = document.getElementById('video-chat-window');

                    createLocalVideoTrack().then(track => {
                        videoChatWindow.appendChild(track.attach());
                    });

                    room.on('participantConnected', participant => {
                        console.log(`A remote Participant connected: ${participant}`);
                    });
                }, error => {
                    console.error(`Unable to connect to Room: ${error.message}`);
                });
            }
        },
        mounted: function () {
            console.log('Video chat room loading...')

            this.getAccessToken()
        }
    }
</script>
