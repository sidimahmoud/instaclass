<template>
  <div>
    <div class="text-center text-primary" v-if="profileLoading">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    <div v-if="!profileLoading">
      <div class="jumbotron py-0">
        <div class="text-right">
          <span class="font-weight-bold text-white mr-2"
            >Bonjour {{ userProfile.first_name }}</span
          >
          <button class="btn btn-danger" @click="logout">Logout</button>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="text-white text-center">
              <img
                :src="userProfile.image"
                width="80px"
                alt="Avatar"
                class="rounded-circle"
              />
              <h4>{{ userProfile.first_name }} {{ userProfile.last_name }}</h4>
              <p>{{ userProfile.headline }}</p>
            </div>
          </div>
          <div class="col-md-6">
            <div
              class="d-flex align-items-center justify-content-center text-white"
            >
              <div
                class="p-4 border border-white text-center"
                style="height: 100px; width: 200px"
              >
                <span class="btn btn-danger"
                  >{{
                    allTeacherDetails.students[0].count > 0
                      ? allTeacherDetails.students[0].count
                      : "0"
                  }}
                </span>
                <br />
                Course Enrollments
              </div>
              <div
                class="p-4 border border-white text-center"
                style="height: 100px; width: 150px"
              >
                <span class="btn btn-danger"
                  >{{ userCourses.length > 0 ? userCourses.length : "0" }}
                </span>
                <br />
                Courses
              </div>

              <div
                class="p-4 border border-white text-center"
                style="height: 100px; width: 200px"
              >
                <span class="btn btn-danger"
                  >{{
                    allTeacherDetails.ratings.length > 0
                      ? allTeacherDetails.ratings.length
                      : "0"
                  }}
                </span>
                <br />
                Reviews
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <h4 class="text-center my-2 text-white">
              You have one course to start after
            </h4>
            <div class="row">
              <div class="col mx-auto">
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
            <p class="text-center text-white my-2">
              <router-link
                :to="{ name: 'LiveCourse' }"
                tag="button"
                class="btn btn-danger"
              >
                Go to course page
              </router-link>
            </p>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="accordion" id="accordionExample">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h2 class="mb-0">
                <button
                  class="btn btn-link"
                  type="button"
                  data-toggle="collapse"
                  data-target="#collapseOne"
                  aria-expanded="true"
                  aria-controls="collapseOne"
                >
                  Manage my courses
                </button>
                <button
                  class="btn btn-link float-right"
                  type="button"
                  data-toggle="collapse"
                  data-target="#collapseOne"
                  aria-expanded="true"
                  aria-controls="collapseOne"
                >
                  <i class="fa fa-plus"></i>
                </button>
              </h2>
            </div>
            <div
              id="collapseOne"
              class="collapse"
              aria-labelledby="headingOne"
              data-parent="#accordionExample"
            >
              <div class="card-body">
                <div class="text-right">
                  <router-link :to="{ name: 'NewCourse' }">
                    <button class="btn btn-primary">
                      <i class="fa fa-plus"></i> New
                    </button>
                  </router-link>
                </div>
                <ul class="list-unstyled">
                  <li
                    class="media shadow-sm border rounded p-2 mt-4"
                    v-for="course in userCourses"
                    :key="course.id"
                  >
                    <div class="media-body">
                      <div class="row">
                        <div class="col-md-9">
                          <router-link
                            :to="{
                              name: 'Detail',
                              params: { slug: course.slug },
                            }"
                          >
                            <h5
                              class="mt-0 mb-1 text-primary font-weight-bolder"
                            >
                              {{ course.name }}
                            </h5>
                          </router-link>
                          {{ course.short_description }}
                        </div>
                        <div class="col-md-3">
                          <router-link :to="{ name: 'AddSection' }">
                            <button class="btn btn-success">Add session</button>
                          </router-link>
                          <router-link
                            :to="{
                              name: 'EditCourse',
                              params: { slug: course.slug },
                            }"
                          >
                            <button class="btn btn-warning">Edit</button>
                          </router-link>
                          <a
                            href="javascript:;"
                            class="btn btn-danger"
                            v-on:click="deleteCourse(course.id)"
                          >
                            Delete
                          </a>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="payments">
              <h2 class="mb-0">
                <button
                  class="btn btn-link collapsed"
                  type="button"
                  data-toggle="collapse"
                  data-target="#collapsePayment"
                  aria-expanded="false"
                  aria-controls="collapsePayment"
                >
                  Payments and receipts
                </button>
                <button
                  class="btn btn-link collapsed float-right"
                  type="button"
                  data-toggle="collapse"
                  data-target="#collapsePayment"
                  aria-expanded="false"
                  aria-controls="collapsePayment"
                >
                  <i class="fa fa-plus"></i>
                </button>
              </h2>
            </div>
            <div
              id="collapsePayment"
              class="collapse"
              aria-labelledby="payments"
              data-parent="#accordionExample"
            >
              <div class="card-body">
                <payments />
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="evaluation">
              <h2 class="mb-0">
                <button
                  class="btn btn-link collapsed"
                  type="button"
                  data-toggle="collapse"
                  data-target="#collapseEval"
                  aria-expanded="false"
                  aria-controls="collapseEval"
                >
                  Reviews
                </button>
                <button
                  class="btn btn-link collapsed float-right"
                  type="button"
                  data-toggle="collapse"
                  data-target="#collapseEval"
                  aria-expanded="false"
                  aria-controls="collapseEval"
                >
                  <i class="fa fa-plus"></i>
                </button>
              </h2>
            </div>
            <div
              id="collapseEval"
              class="collapse"
              aria-labelledby="evaluation"
              data-parent="#accordionExample"
            >
              <div class="card-body">
                <div
                  class="text-center"
                  v-if="allTeacherDetails.ratings.length === 0"
                >
                  <h3>No reviews</h3>
                </div>
                <div v-else>
                  <review
                    v-for="r in allTeacherDetails.ratings"
                    :key="r.id"
                    :rating="r"
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingThree">
              <h2 class="mb-0">
                <button
                  class="btn btn-link collapsed"
                  type="button"
                  data-toggle="collapse"
                  data-target="#collapseThree"
                  aria-expanded="false"
                  aria-controls="collapseThree"
                >
                  Personal informations
                </button>
                <button
                  class="btn btn-link collapsed float-right"
                  type="button"
                  data-toggle="collapse"
                  data-target="#collapseThree"
                  aria-expanded="false"
                  aria-controls="collapseThree"
                >
                  <i class="fa fa-plus"></i>
                </button>
              </h2>
            </div>
            <div
              id="collapseThree"
              class="collapse"
              aria-labelledby="headingThree"
              data-parent="#accordionExample"
            >
              <div class="card-body">
                <edit-profile :userProfile="userProfile" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import NewCourse from "./NewCourse";
import Payments from "./Payments";
import Review from "../courses/Review";
import NewSection from "./NewSection";
import EditProfile from "./EditProfile";
import CountDown from "../CountDown";
import axios from "axios";

export default {
  name: "TeacherProfile",
  components: {
    NewCourse,
    Payments,
    Review,
    NewSection,
    EditProfile,
    CountDown,
  },
  methods: {
    ...mapActions([
      "fetchProfile",
      "fetchUserCourses",
      "fetchTeacherDetails",
      "fetchTeacherPayments",
    ]),

    logout() {
      this.$store.dispatch("logout").then(() => {
        this.$router.push("/");
      });
    },
    deleteCourse(id) {
      const token = localStorage.getItem("token") || null;
      if (token) {
        axios.defaults.headers.common["Authorization"] = "Bearer " + token;
        if (confirm("Do you really want to delete?")) {
          this.$store
            .dispatch("deleteCourse", id)
            .then((resp) => {
              location.reload();
            })
            .catch((error) => {
              console.log(error);
            });
        }
      }
    },
  },
  computed: mapGetters([
    "profileLoading",
    "userProfile",
    "userCourses",
    "allTeacherDetails",
  ]),
  created() {
    this.fetchProfile();
    this.fetchUserCourses();
    this.fetchTeacherDetails();
  },
};
</script>

<style scoped>
.jumbotron {
  background-image: url("../../assets/images/teaprofile/bg.png");
  border-radius: 0;
}
</style>
