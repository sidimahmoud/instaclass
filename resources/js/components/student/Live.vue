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
          <button class="btn btn-primary" @click="onJoinCourse">
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

export default {
  name: "LiveWindowCompo",
  components: {
    CountDown,
  },
  data() {
    return {
      myRoom: this.$route.params.slug,
      sid: this.$route.params.sid,
      user: "Student",
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
            this.$router.push({
              name: "LiveVideo",
              params: { slug: this.myRoom, sid: this.sid },
            });
          } else {
            this.$router.push({ name: "StudentProfile" });
          }
        })
        .catch((err) => console.log("error", err.response));
    },
  },
};
</script>
