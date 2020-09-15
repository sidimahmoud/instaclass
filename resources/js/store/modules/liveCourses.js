import axios from 'axios'

const state = {
    activeRoom: '',
    accessToken: '',
    roomSid: false,
};
const getters = {
    getActiveRoom: (state) => state.activeRoom,
};
const actions = {
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
};
const mutations = {};

export default {
    state,
    getters,
    actions,
    mutations
}
