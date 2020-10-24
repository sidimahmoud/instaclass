<template>
  <div class="container-fluid border-top border-primary pt-4">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <div class="text-center">
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
            <input type="text" id="user" class="form-control" v-model="user" />
          </div>
          <!-- <button class="btn btn-primary" @click="createRoom">Start now</button> -->
          <router-link
            :to="{ name: 'StartLive' }"
            tag="button"
            class="btn btn-primary"
          >
            Start now
          </router-link>
          <button class="btn btn-primary" @click="getAccessToken">
            Join Course
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import CountDown from "../CountDown";
import user from "../../store/modules/user";

export default {
  name: "LiveCourse",
  components: {
    CountDown,
  },
  data: function () {
    return {
      user: "teacher",
    };
  },
  methods: {
    getAccessToken() {
      const _this = this;
      return;
      // Request a new token
      // axios
      //   .get(`/access_token/${this.myRoom}/${this.user}`)
      //   .then((response) => {
      //     _this.accessToken = response.data;
      //     _this.started = true;
      //     _this.connectToRoom();
      //   })
      //   .catch((error) => console.log(error));
    },
  },
};
</script>