<template>
    <div>
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
                            <!--                            <div-->
                            <!--                                class="col-md-4 pl-0 teacher-image"-->
                            <!--                                :style="{-->
                            <!--                                  backgroundImage: 'url(' + userProfile.image + ')',-->
                            <!--                                  backgroundSize: 'cover',-->
                            <!--                                  backgroundRepeat: 'no-repeat',-->
                            <!--                                }"-->
                            <!--                            >-->
                            <!--                            </div>-->
                            <div class="col-md-4 text-center">
                                <img :src="userProfile.image" class="profile-image avatar img-circle img-thumbnail" alt="Avatar">
                            </div>

                            <div class="col-md-8 mb-2 stat">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="text-uppercase">
                                            <strong>
                                                {{$t('profile.instructor')}}. {{ userProfile.first_name }}
                                                {{ userProfile.last_name }}
                                            </strong>
                                        </h4>
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
                                        {{$t('profile.ratings')}}
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
                                        {{$t('profile.coursesNumber')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- {{upComingSections.length}} -->

                </div>
                <div class="count-down py-2 my-3">
                    <div>
                        <div class="row">
                            <div class="col-md-6 w-md-50 mx-auto" v-if="upComingSections.length > 0">
                                <h4 class="text-center my-2 text-white text-uppercase">
                                    {{$t('profile.timer_course_start')}}
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
                            <div class="col-md-6 w-md-50 mx-auto" v-if="upComingSections.length === 0">
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
                        <!-- <p
                            class="text-center text-white my-2"
                            v-if="upComingSections.length > 0"
                        >
                            <button @click="handleLive"
                                    class="btn btn-danger">
                                Go to the course page
                                <div v-if="upComingSections.length > 0">Title: {{upComingSections[0].title}}</div>
                            </button>
                        </p> -->
                    </div>
                </div>
                <div class="container-fluid teacher-area">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <router-link :to="{ name: 'NewCourse' }">
                                <button class="btn btn-primary">
                                    <i class="fa fa-plus"></i> {{$t('profile.createCourse')}}
                                </button>
                            </router-link>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                {{$t('manage_course')}}
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled" v-if="!isEmpty(userCourses)">
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
                                                    <span class="view-enrolled" @click="handleEnrolled(course.id)">{{$t('view_subscriped_list')}}</span>
                                                </div>
                                                <div class="col-md-3 text-right">
                                                    <button @click="handleLive(course.id)"
                                                        class="btn btn-warning">
                                                        <i class="fa fa-play fa-2x"></i>
                                                    </button>
                                                    <router-link
                                                        :to="{
                                                            name: 'EditCourse',
                                                            params: { slug: course.id },
                                                        }">
                                                        <button class="btn btn-primary"><i class="fa fa-pencil fa-2x"></i></button>
                                                    </router-link>
                                                    <a
                                                        href="javascript:;"
                                                        class="btn btn-danger"
                                                        v-on:click="deleteCourse(course.id)"
                                                    >
                                                        <i class="fa fa-trash fa-2x"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <p v-else>{{$t('countDown.empty_course')}}</p>
                            </div>
                        </div>
                        <!-- <p
                            class="text-center text-white my-2"
                            v-if="upComingSections.length > 0"
                        >
                            <button @click="handleLive"
                                    class="btn btn-danger">
                                Go to the course page
                                <div v-if="upComingSections.length > 0">Title: {{upComingSections[0].title}}</div>
                            </button>
                        </p> -->
                        <!-- <div class="card"> -->
                            <!-- <div class="card-header" id="payments">
                                <h2 class="mb-0" @click="collapsedPayments = !collapsedPayments">
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
                            </div> -->
                            <!-- <div
                                id="collapsePayment"
                                class="collapse"
                                aria-labelledby="payments"
                                data-parent="#accordionExample"
                            >
                                <div class="card-body">
                                    <payments/>
                                </div>
                            </div> -->
                        <!-- </div> -->
                        <!-- <div class="card">
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
                        </div> -->
                        <!-- <div class="card">
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
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        
        <el-dialog
            :title="$t('enrollements_title')"
            ref="classes-modal"
            :visible.sync="dialogVisible"
            custom-class="enrollement-modal"
            :before-close="handleClose">
            <div v-if="isEmpty(courseEnrollement)">
                {{$t('no_enrollement')}}
            </div>
            <table class="table" v-else>
                <thead>
                <tr>
                    <th scope="col">{{$t('no_enrollement')}}</th>
                    <th scope="col">Section</th>

                </tr>
                </thead>
                <tbody>
                <tr v-for="t in courseEnrollement" v-bind:key="t.id">
                    <td>{{t.user.first_name}}</td>
                    <td>S{{t.course_file.number}}</td>
                </tr>
                </tbody>
            </table>
            <span slot="footer" class="dialog-footer">
                <el-button @click="handleClose">Ok</el-button>
            </span>
        </el-dialog>

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
                dialogVisible: false
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
                "getTeacherNextSections",
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
                        title: this.$t('profile.areYou'),
                        text: this.$t('profile.irreversible'),
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: this.$t('profile.confirm'),
                        cancelButtonText:this.$t('profile.cancel'),
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.$store
                                .dispatch("deleteCourse", id)
                                .then((resp) => {
                                    this.$swal.fire(
                                        'Ok!',
                                        this.$t('profile.deleted'),
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
            handleLive(id) {
                //this.$swal.fire(this.$t('profile.notify_video'));
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
            handleEnrolled(v) {
                console.log(v)
                this.$store.dispatch("getCourseEnrollement", v);
                this.dialogVisible = true;
            },
            handleClose() {
                this.$refs['classes-modal'].close();
                this.dialogVisible = false
                window.location.reload()
            }
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
                "courseEnrollement"
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
            this.getTeacherNextSections();
        },
    };
</script>

<style scoped lang="scss">
    .hero {
        background: linear-gradient(rgba(19, 19, 19, 0), rgba(19, 19, 19, 0)), url('../../assets/images/auth/account1.jpg') no-repeat center center;
        height: 55vh;
        background-size: cover;
        color: white;
    }

    .jumbotron1 {
        background-color: #fff;
        border-radius: 0;

        img {
            /*border-radius: 0 10% 10% 0;*/
            /*border: 2px solid black;*/
            /*max-height: 450px;*/
            /*max-width: 450px;*/
            max-height: 250px;

        }
    }

    .details {
        border: 1px solid black;
        border-right: 1px solid black;
    }

    .teacher-image {
        height: 200px;
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
    }

    .teacher-area {
        background-color: #ccc;
        border: 2px solid black;
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
        font-size: 20px;
        border-radius: 20px !important;

        .btn {
            font-size: 20px;
            color: #000 !important;
            font-weight: 800;
        }
    }
    .view-enrolled {
        cursor: pointer;
        text-decoration: underline;
    }

    @media (max-width: 600px) {
        .hero {
            background: linear-gradient(rgba(19, 19, 19, 0), rgba(19, 19, 19, 0)), url('../../assets/images/auth/account.jpg') no-repeat center center;
            height: 30vh;
            background-size: cover;
            color: white;
        }

        .counts {
            background: linear-gradient(rgb(253, 255, 255, 0.5), rgb(255, 255, 255, 0.5));
        }

        .count-down {
            background: linear-gradient(rgba(19, 19, 19, 0.8), rgba(19, 19, 19, 0.8));
        }
    }
</style>


