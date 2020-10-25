<template>
    <div>
        <div class="text-center text-primary" v-if="profileLoading">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <section class="hero pt-5">
            <div class="container mt-4 h-100">
                <div class="text-right">
                    <button class="btn btn-danger" @click="logout">Logout</button>
                </div>
                <div class="row h-100">
                    <div class="col-md-4"></div>
                    <div class="col-md-8 text-center pt-md-5">
                        <h1 class="font-weight-bolder display-2">
                            THE NEXT <br/>
                            YOU
                        </h1>
                        <h1 class="font-weight-bolder text-uppercase">
                            The best way to predict <br/>
                            the future is to create it
                        </h1>
                    </div>
                </div>
            </div>
        </section>
        <div class="container" v-if="!profileLoading">

            <div class="container">
                <div class="jumbotron1 p-0 mt-2">
                    <div class="container details">
                        <div class="row align-items-center counts">
                            <div
                                class="col-md-4 pl-0 teacher-image"
                                :style="{
                  backgroundImage: 'url(' + userProfile.image + ')',
                  backgroundSize: 'cover',
                  backgroundRepeat: 'no-repeat',
                }"
                            >
                                <!--<img :src="userProfile.image" alt="Avatar" class="w-100">-->
                            </div>
                            <div class="col-md-8 mb-2 stat">
                                <div class="row">
                                    <div class="col-12">
                                        <h3 class="text-uppercase">
                                            <strong>
                                                Instructor. {{ userProfile.first_name }}
                                                {{ userProfile.last_name }}
                                            </strong>
                                        </h3>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-2 text-center">
                                        <i class="fa fa-star fa-2x text-warning"></i>
                                    </div>
                                    <div class="col-8">
                    <span>{{
                      allTeacherDetails.ratings.length > 0
                        ? allTeacherDetails.ratings.length
                        : "0"
                    }}</span>
                                        Reviews
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-2 text-center">
                                        <i class="fa fa-users fa-2x text-warning"></i>
                                    </div>
                                    <div class="col-8">
                    <span>{{
                      allTeacherDetails.students[0].count > 0
                        ? allTeacherDetails.students[0].count
                        : "0"
                    }}</span>
                                        Students enrolled
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-2 text-center">
                                        <i class="fa fa-play-circle fa-2x text-warning"></i>
                                    </div>
                                    <div class="col-8">
                    <span>{{
                      userCourses.length > 0 ? userCourses.length : "0"
                    }}</span>
                                        Courses
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="count-down py-2 my-2">

                    <div>
                        <div class="row">
                            <div class="mx-auto" v-if="upComingSections.length > 0">
                                <h4 class="text-center my-2 text-white text-uppercase">
                                    Your course will start in
                                </h4>
                                <Count-down
                                    :year="upComingSections[0].startDate.slice(0, 4)"
                                    :month="upComingSections[0].startDate.slice(5, 7)-1"
                                    :day="upComingSections[0].startDate.slice(8, 10)"
                                    :hour="upComingSections[0].startDate.slice(11, 13)"
                                    :minute="upComingSections[0].startDate.slice(14, 16)"
                                    :second="0"
                                    :text="false"
                                />
                                <h4 class="text-center my-2 text-white">BE READY</h4>
                            </div>
                        </div>
                        <p
                            class="text-center text-white my-2"
                            v-if="upComingSections.length > 0"
                        >
                            <router-link
                                :to="{
                  name: 'LiveCourse',
                  params: { slug: upComingSections[0].id },
                }"
                                tag="button"
                                class="btn btn-danger"
                            >
                                Go to the course page
                            </router-link>
                        </p>
                    </div>
                </div>
                <div class="container my-3 text-right">
                    <router-link :to="{ name: 'NewCourse' }">
                        <button class="btn btn-primary">
                            <i class="fa fa-plus"></i> Create a new course
                        </button>
                    </router-link>
                </div>
                <div class="container teacher-area">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0" @click="collapsedCourses = !collapsedCourses">
                                    <button
                                        class="btn btn-link font-weight-bolder rounded"
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
                                        <i class="fa fa-plus" v-if="collapsedCourses"></i>
                                        <i class="fa fa-minus" v-else></i>
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
                                    <ul class="list-unstyled">
                                        <li
                                            class="media bg-white p-2 mt-4"
                                            v-for="course in userCourses"
                                            :key="course.id"
                                        >
                                            <div class="media-body">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <router-link
                                                            :to="{
                              name: 'Detail',
                              params: { slug: course.id },
                            }"
                                                        >
                                                            <h5
                                                                class="mt-0 mb-1 text-primary font-weight-bolder rounded"
                                                            >
                                                                {{ course.short_description }}
                                                            </h5>
                                                        </router-link>
                                                    </div>
                                                    <div class="col-md-3 text-right">
                                                        <router-link
                                                            :to="{
                              name: 'EditCourse',
                              params: { slug: course.id },
                            }"
                                                        >
                                                            <button class="btn btn-primary">Edit</button>
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
                                <h2 class="mb-0" @click="collapsedPayments = !collapsedPayments">
                                    <button
                                        class="btn btn-link font-weight-bolder rounded collapsed"
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
                                        <i class="fa fa-plus" v-if="collapsedPayments"></i>
                                        <i class="fa fa-minus" v-else></i>
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
                                    <payments/>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="evaluation">
                                <h2 class="mb-0" @click="collapsedRatings = !collapsedRatings">
                                    <button
                                        class="btn btn-link font-weight-bolder rounded collapsed"
                                        type="button"
                                        data-toggle="collapse"
                                        data-target="#collapseEval"
                                        aria-expanded="false"
                                        aria-controls="collapseEval"
                                    >
                                        Ratings
                                    </button>
                                    <button
                                        class="btn btn-link collapsed float-right"
                                        type="button"
                                        data-toggle="collapse"
                                        data-target="#collapseEval"
                                        aria-expanded="false"
                                        aria-controls="collapseEval"
                                    >
                                        <i class="fa fa-plus" v-if="collapsedRatings"></i>
                                        <i class="fa fa-minus" v-else></i>
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
                                        <h3>No ratings yet</h3>
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
                                <h2 class="mb-0" @click="collapsedPersonal = !collapsedPersonal">
                                    <button
                                        class="btn btn-link font-weight-bolder collapsed"
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
                                        <i class="fa fa-plus" v-if="collapsedPersonal"></i>
                                        <i class="fa fa-minus" v-else></i>
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
                                    <edit-profile :userProfile="userProfile"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from "vuex";
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
                "getUpcomingSections",

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
            "upComingSections",
        ]),
        created() {
            this.fetchUserCourses();
            this.fetchTeacherDetails();
            this.getUpcomingSections();
        },
    };
</script>

<style scoped lang="scss">
    .hero {
        /*background-image: url('../../assets/images/demand/online.jpg');*/
        background: linear-gradient(rgba(19, 19, 19, 0), rgba(19, 19, 19, 0)),
        url("../../assets/images/auth/hero.jpg") no-repeat center center;
        height: 70vh;
        background-size: cover;
        border-bottom: 15px solid #3081fb;
        color: white;
    }

    .jumbotron1 {
        background-color: transparent;
        border-radius: 0;

        img {
            border-radius: 0 10% 10% 0;
            border: 2px solid black;
            max-height: 450px;
            max-width: 450px;
        }
    }

    .details {
        border-radius: 2rem;
        border: 20px solid black;
        border-right: 2px solid black;
    }

    .teacher-image {
        height: 300px;
        border-radius: 0 70px 70px 0;
        @media only screen and (max-width: 600px) {
            border-radius: 0;
        }
    }

    .counts {
        background: linear-gradient(rgb(253, 255, 255, 0.5), rgb(255, 255, 255, 0.5)),
        url("../../assets/images/teaprofile/down1.png") no-repeat right center;
        background-size: contain;
        height: 300px;
    }

    .stat {
        font-weight: 800;

        span {
            margin: 15px;
        }
    }

    .count-down {
        background: linear-gradient(rgba(19, 19, 19, 0.8), rgba(19, 19, 19, 0.8)),
        url("../../assets/images/teaprofile/down1.png") no-repeat left center,
        url("../../assets/images/teaprofile/down2.png") no-repeat right center;
        background-size: contain;
        border-radius: 20px;
    }

    .teacher-area {
        background-color: #ccc;
        border: 2px solid black;
        border-radius: 20px;
        padding: 20px;
    }

    .card {
        background: linear-gradient(
                180deg,
                rgba(19, 19, 19, 0.4),
                rgba(19, 19, 19, 1)
        );
        margin-top: 6px;
        margin-bottom: 6px;
        color: white;
        border-radius: 20px !important;
    }

    .card-header {
        background: linear-gradient(180deg, rgba(75, 189, 254, 0.83), #fbf3f3);
        font-size: 40px;
        border-radius: 20px !important;

        .btn {
            font-size: 20px;
            color: #000 !important;
            font-weight: 800;
        }
    }
</style>


