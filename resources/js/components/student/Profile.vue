<template>
    <div>
        <section class="hero mb-2 pt-5" v-if="!profileLoading">
            <div class="container mt-4 h-100">
                <div class="text-right">
                    <button class="btn btn-danger mr-2" @click="logout">
                        Logout
                    </button>
                    <router-link :to="{name: 'EditStudentProfile'}" tag="a" class="btn btn-primary">
                        Edit Profile
                    </router-link>
                </div>

                <div class="row h-100">
                    <div class="col-md-4 d-none d-md-block"></div>
                    <div class="col-md-8 text-center pt-md-2">
                        <h1 class="font-weight-bolder text-uppercase">
                            THE NEXT YOU<br>
                            The best way to predict <br>
                            the future is to create it
                        </h1>
                    </div>
                </div>
            </div>
        </section>
        <div class="text-center text-primary" v-if="profileLoading" style="top: 30vh">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div class="container" v-if="!profileLoading">

            <div class="jumbotron1  p-0 mt-2">
                <div class="container-fluid details">
                    <div class="row align-items-center counts">
                        <div
                            class="col-md-4 pl-0 teacher-image"
                            :style="{
                                  backgroundImage: 'url(' + userProfile.image + ')',
                                  backgroundSize: 'cover',
                                  backgroundRepeat: 'no-repeat',
                            }">
                            <!--<img :src="userProfile.image" alt="Avatar" class="w-100">-->
                        </div>
                        <div class="col-md-8 mb-2">
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="text-uppercase">
                                        <strong>
                                            {{ userProfile.first_name }} {{ userProfile.last_name }}
                                        </strong>
                                    </h3>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-6">
                                        <i class="fa fa-users fa-2x text-warning"></i>
                                        Course Enrollments
                                    </div>
                                    <div class="col-4 py-2">
                                  <span class="btn btn-block btn-primary">
                                      {{userEnrollments.length > 0
                                      ? userEnrollments.length
                                      : "0"}}
                                  </span>
                                    </div>
                                    <div class="col-2"></div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <i class="fa fa-star fa-2x text-warning"></i>
                                        Reviews
                                    </div>
                                    <div class="col-4 py-2">
                                        <span class="btn btn-block btn-primary">0</span>
                                    </div>
                                    <div class="col-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="count-down py-2 my-2">
                <div class="w-50 mx-auto">
                    <h4 class="text-center my-2 text-white text-uppercase">
                        You have one course to start after
                    </h4>
                    <div class="" v-if="upcomingClasses.length > 0 ">
                        <Count-down
                            :year="upcomingClasses[0].startDate.slice(0, 4)"
                            :month="upcomingClasses[0].startDate.slice(5, 7)-1"
                            :day="upcomingClasses[0].startDate.slice(8, 10)"
                            :hour="upcomingClasses[0].startDate.slice(11, 13)"
                            :minute="upcomingClasses[0].startDate.slice(14, 16)"
                            :second="0"
                        />
                    </div>
                    <div v-else>
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
            <div class="row my-4 student-area">
                <div class="col-md-12 bg-white shadow">
                    <nav class="nav nav-pills nav-fill mt-3">
                        <a class="nav-item nav-link active" href="#courses" data-toggle="tab">
                            My courses
                        </a>
                        <a class="nav-item nav-link" href="#receipts" data-toggle="tab">
                            My receipts
                        </a>
                        <a class="nav-item nav-link" href="#ratings" data-toggle="tab">
                            Ratings
                        </a>
                    </nav>
                    <hr/>
                    <div class="tab-content my-1">
                        <!-- Enrollments-->
                        <div class="tab-pane fade show active" id="courses">
                            <div class="grid" >
                                <div v-if="isEmpty(userEnrollments)">
                                    You have no course yet.
                                </div>
                                <div class="item-product" v-for="e in userEnrollments" v-bind:key="e.id">
                                    <div class="product-grid__img-wrapper">
                                        <img :src="e.course_file.course.image" alt="Img" class="product-grid__img"/>
                                    </div>
                                    				
                                    <span><strong>{{ e.course_file.course.name }}</strong></span><br/>
                                    <span>{{$t('start_at')}}: {{ e.course_file.startDate }}</span><br/>
                                    <span>{{ e.course_file.course.user.first_name }}</span>
                                    <span>{{ e.course_file.course.user.last_name }}</span><br/>
                                    <button v-if="!isEmpty(e.course_file.video_link)" class="btn btn-danger" @click="handleGoLive(e.course_file.video_link)"><i class="fa fa-play"></i> {{$t('profile.go_live')}}</button>
                                    <span class="empty-link" v-else>{{$t('profile.no_video_yet')}}</span>
                                </div>
                                
                            </div>
                        </div>

                        <div class="tab-pane fade show" id="receipts">
                            <h3 class="text-center" v-if="studentPayments.length===0">Your receipts will appear
                                here. </h3>
                            <div class="accordion" id="accordionExample">
                                <div class="card my-2" v-for="p in studentPayments" :key="p.id">
                                    <div class="card-header" :id="'payment'+p.id">
                                        <h2 class="mb-0">
                                            <p
                                                class="btn btn-link font-weight-bolder rounded"
                                                type="button"
                                                data-toggle="collapse"
                                                :data-target="'#collapse'+p.id"
                                                aria-expanded="true"
                                                :aria-controls="'collapse'+p.id"
                                            >
                                                Order N°{{p.id}}, {{p.created_at.slice(0,10)}},
                                                {{p.created_at.slice(11,16)}}, {{p.object}}
                                            </p>
                                        </h2>
                                    </div>
                                    <div
                                        :id="'collapse'+p.id"
                                        class="collapse"
                                        :aria-labelledby="'payment'+p.id"
                                        data-parent="#accordionExample"
                                    >
                                        <div class="card-body">
                                            <receipt :payment="p"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <div class="tab-pane fade show" id="ratings">
                            <table class="table" v-if="userProfile.ratings > 0">
                                <thead>
                                <tr>
                                    <th scope="col">Teacher Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Rating</th>
                                    <th scope="col">Comment</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="r in userProfile.ratings" v-bind:key="r.id">
                                    <th scope="row">{{ e.teacher_id }}</th>
                                    <td>{{ e.created_at }}</td>
                                    <td>{{ e.rate }}</td>
                                    <td>{{ e.reverse }}</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="text-center" v-else>
                                <h3>No ratings yet</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import axios from "axios";
    import {mapActions, mapGetters} from "vuex";
    import CountDown from "../CountDown";
    import Receipt from "./Receipt";
    import {isEmpty} from "../../helpers/common";

    export default {
        name: "StudentProfile",
        /*
        |--------------------------------------------------------------------------
        | Component > components
        |--------------------------------------------------------------------------
        */
        components: {CountDown, Receipt},
        /*
        |--------------------------------------------------------------------------
        | Component > data
        |--------------------------------------------------------------------------
        */
        data() {
            return {
                liveClassDetail: "Loading...",
                activeRooms: [],
            };
        },
        /*
        |--------------------------------------------------------------------------
        | Component > methods
        |--------------------------------------------------------------------------
        */
        methods: {
            ...mapActions([ "fetchUserEnrollments", "fetchReceipts", "fetchUpcomingClasses"]),
            logout() {
                this.$store.dispatch("logout").then(() => {
                    this.$router.go();
                });
            },
            lives() {
                return this.userEnrollments.map((item) => {
                    return item.course.type === 1;
                });
            },
            recorded() {
                return this.userEnrollments.map((item) => {
                    return item.course.type === 2;
                });
            },
            retrieveActiveRooms() {
                const _this = this;
                _this.liveClassDetail = "Loading...";
                // Request a new token
                axios
                    .get("/rooms-by-status/in-progress")
                    .then((response) => {
                        _this.activeRooms = response.data;
                        if (response.data.length === 0) {
                            _this.liveClassDetail = "You have no Live class for the moment";
                        }
                    })
                    .catch((error) => console.log(error));
            },
            isEmpty (v) {
                return isEmpty(v);
            },
            handleGoLive(link){
                this.$router.push({path: link});
            }
        },
        /*
        |--------------------------------------------------------------------------
        | Component > computed
        |--------------------------------------------------------------------------
        */
        computed: {
            ...mapGetters(["userProfile", "userEnrollments", "profileLoading", "studentPayments", "upcomingClasses"]),
        },
        /*
        |--------------------------------------------------------------------------
        | Component > mounted
        |--------------------------------------------------------------------------
        */
        mounted() {
            this.fetchUserEnrollments();
            this.fetchReceipts();
            this.fetchUpcomingClasses();
        },
    };
</script>

<style scoped lang="scss">
    .jumbotron {
        background-image: url("../../assets/images/auth/account.jpg");
        border-radius: 0;
        padding: 0;
    }

    .hero {
        /*background-image: url('../../assets/images/demand/online.jpg');*/
        background: linear-gradient(rgba(19, 19, 19, 0), rgba(19, 19, 19, 0)), url('../../assets/images/auth/hero.jpg') no-repeat center center;
        height: 50vh;
        background-size: cover;
        border-bottom: 15px solid #3081FB;
        color: white;
    }

    .jumbotron1 {
        background-color: transparent;
        border-radius: 0;
        width: 100%;

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
        background: linear-gradient(rgba(253, 255, 255, 0.5),
            rgba(255, 255, 255, 0.5)),
        url('../../assets/images/teaprofile/down1.png') no-repeat right center;
        background-size: contain;
    }

    .count-down {
        background: linear-gradient(rgba(19, 19, 19, 0.8), rgba(19, 19, 19, 0.8)), url('../../assets/images/teaprofile/down1.png') no-repeat left center, url('../../assets/images/teaprofile/down2.png') no-repeat right center;
        background-size: contain;
        border-radius: 20px;
    }

    .student-area {
        border: 3px solid black;
        border-radius: 10px;
    }
    .grid{
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        grid-gap: 10px;
        padding: 1rem;
        text-align: center;
    }
    .item-product {
        border:1px solid rgb(241, 241, 241);
        padding: 1rem;
        text-align: center;

        .product-grid__img {
            height: 80px !important;
            transition: transform .2s;
            -ms-transform: scale(1); /* IE 9 */
            -webkit-transform: scale(1); /* Safari 3-8 */
            transform: scale(1); 
        }
        .product-grid__img:hover {
            -ms-transform: scale(2.5); /* IE 9 */
            -webkit-transform: scale(2.5); /* Safari 3-8 */
            transform: scale(2.5); 
        }
    }
    .empty-link {
        color: red;
    }
</style>
