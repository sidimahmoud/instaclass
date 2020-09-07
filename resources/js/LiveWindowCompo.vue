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
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
                    .then(function () {
                        console.log(_this.accessToken)
                    });
            }
        },
        mounted: function () {
            console.log('Video chat room loading...')

            this.getAccessToken()
        }
    }
</script>
