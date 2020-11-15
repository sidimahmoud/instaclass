<template>
    <div class="container-fluid">
        <div class="text-center text-primary mt-5 pt-5" v-if="profileLoading">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <section class="hero pt-5">
            <!--            <div class="container mt-md-4 h-100">-->
            <!--                <div class="text-right">-->
            <!--                    <button class="btn btn-danger" @click="logout">Logout</button>-->
            <!--                </div>-->
            <!--                <div class="row h-100">-->
            <!--                    <div class="col-md-4"></div>-->
            <!--                    <div class="col-md-8 text-center">-->
            <!--                        <h1 class="font-weight-bolder ">-->
            <!--                            THE NEXT YOU-->
            <!--                        </h1>-->
            <!--                        <h1 class="font-weight-bolder text-uppercase">-->
            <!--                            The best way to predict <br/>-->
            <!--                            the future is to create it-->
            <!--                        </h1>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
        </section>
        <div v-if="!profileLoading">
            <div>
                <div class="jumbotron1 p-0 mt-2">
                    <div class="container-fluid details">
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
                                                {{$t('profile.instructor')}}. {{ userProfile.first_name }}
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
                      !isEmpty(allTeacherDetails.ratings)
                        ? allTeacherDetails.ratings.length
                        : "0"
                    }}</span>
                                        {{$t('profile.reviews')}}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-2 text-center">
                                        <i class="fa fa-users fa-2x text-warning"></i>
                                    </div>
                                    <div class="col-8">
                    <span>{{
                      !isEmpty(allTeacherDetails.students)
                        ? allTeacherDetails.students[0].count
                        : "0"
                    }}</span>
                                        {{$t('course.students')}}
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
                                        {{$t('profile.courses')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="count-down py-2 my-3">
                    <div>
                        <div class="row">
                            <div class="col-md-6 w-50 mx-auto" v-if="upComingSections.length > 0">
                                <h4 class="text-center my-2 text-white text-uppercase">
                                    Your course will start in
                                </h4>
                                <div>
                                    <Count-down
                                        :year="upComingSections[0].startDate.slice(0, 4)"
                                        :month="upComingSections[0].startDate.slice(5, 7)-1"
                                        :day="upComingSections[0].startDate.slice(8, 10)"
                                        :hour="upComingSections[0].startDate.slice(11, 13)"
                                        :minute="upComingSections[0].startDate.slice(14, 16)"
                                        :second="0"
                                    />
                                </div>
                            </div>
                            <div class="col-md-6 w-50 mx-auto" v-if="upComingSections.length === 0">
                                <div>
                                    <Count-down
                                        :year="2020"
                                        :month="1"
                                        :day="1"
                                        :hour="0"
                                        :minute="0"
                                        :second="0"
                                    />
                                </div>
                            </div>
                        </div>
                        <p
                            class="text-center text-white my-2"
                            v-if="upComingSections.length > 0"
                        >
                            <button @click="handleLive"
                                    tag="button"
                                    class="btn btn-danger">
                                Go to the course page
                                <div v-if="upComingSections.length > 0">Title: {{upComingSections[0].title}}</div>
                            </button>
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
                <div class="container-fluid teacher-area">
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
                                                        }">
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
                                        v-if="isEmpty(allTeacherDetails.ratings)"
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
    import {isEmpty} from "../../helpers/common";

    export default {
        name: "TeacherProfile",
        /*
        |--------------------------------------------------------------------------
        | Component > components
        |--------------------------------------------------------------------------
        */
        components: {
            NewCourse,
            Payments,
            Review,
            NewSection,
            EditProfile,
            CountDown,
        },
        /*
        |--------------------------------------------------------------------------
        | Component > data
        |--------------------------------------------------------------------------
        */
        data() {
            return {
                collapsedCourses: true,
                collapsedPayments: true,
                collapsedReceipts: true,
                collapsedRatings: true,
                collapsedPersonal: true,
            }
        },
        /*
        |--------------------------------------------------------------------------
        | Component > methods
        |--------------------------------------------------------------------------
        */
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
                    this.$router.go();
                });
            },
            deleteCourse(id) {
                const token = localStorage.getItem("token") || null;
                if (token) {
                    axios.defaults.headers.common["Authorization"] = "Bearer " + token;
                    this.$swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.$store
                                .dispatch("deleteCourse", id)
                                .then((resp) => {
                                    this.$swal.fire(
                                        'Deleted!',
                                        'Your course has been deleted.',
                                        'success'
                                    )
                                })
                                .catch((error) => {
                                    console.log(error);
                                });

                        }
                    })
                    // if (this.$confirm("Are you sure want to delete this course?")) {
                    //     this.$store
                    //         .dispatch("deleteCourse", id)
                    //         .then((resp) => {
                    //             location.reload();
                    //         })
                    //         .catch((error) => {
                    //             console.log(error);
                    //         });
                    // }
                }
            },
            handleLive() {
                this.$router.push({
                    name: "StartLive",
                    params: {
                        course_id: this.upComingSections[0].id
                    }
                });
            },
            isEmpty(v) {
                return isEmpty(v);
            },
        },
        /*
        |--------------------------------------------------------------------------
        | Component > mounted
        |--------------------------------------------------------------------------
        */
        computed: {
            ...mapGetters([
                "profileLoading",
                "userProfile",
                "userCourses",
                "allTeacherDetails",
                "upComingSections",
            ]),
        },
        /*
        |--------------------------------------------------------------------------
        | Component > mounted
        |--------------------------------------------------------------------------
        */
        mounted() {
            this.fetchUserCourses();
            this.fetchTeacherDetails();
            this.getUpcomingSections();
        },
    };
</script>

<style scoped lang="scss">
    .hero {
        background: linear-gradient(rgba(19, 19, 19, 0), rgba(19, 19, 19, 0)), url('../../assets/images/auth/account.jpg') no-repeat center center;
        height: 70vh;
        background-size: cover;
        border-bottom: 15px solid #3081FB;
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
        border-radius: 1rem;
        border: 5px solid black;
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
        margin-bottom: 100px;
    }

    .card {
        background-color: #eee;
        margin-top: 6px;
        margin-bottom: 6px;
        color: #000;
        border-radius: 20px !important;
    }

    .card-header {
        background: #fff;
        font-size: 40px;
        border-radius: 20px !important;

        .btn {
            font-size: 20px;
            color: #000 !important;
            font-weight: 800;
        }
    }
</style>


