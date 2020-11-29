<template>
    <div>
        <section class="hero mb-2 pt-5" v-if="!profileLoading">
            <div class="container mt-4 h-100">
            </div>
        </section>
        <div class="text-center text-primary" v-if="profileLoading" style="top: 30vh">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div class="container-fluid" v-if="!profileLoading">
            <div class="row my-4 student-area">
                <div class="col-md-12 bg-white shadow">
                    <div class="tab-content my-1">
                        <h4>{{$t('profile.payments')}}</h4>
                        <div id="receipts">
                            <h3 class="text-center" v-if="studentPayments.length===0">Your receipts will appear here.</h3>
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
            ...mapActions(["fetchUserEnrollments", "fetchReceipts", "fetchUpcomingClasses"]),
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
            isEmpty(v) {
                return isEmpty(v);
            },
            handleGoLive(link) {
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
        height: 70vh;
        background-size: cover;
        border-bottom: 15px solid #3081FB;
        color: white;
    }

    .jumbotron1 {
        background-color: transparent;
        border-radius: 0;
        width: 100%;

        img {
            /*border-radius: 0 10% 10% 0;*/
            /*border: 2px solid black;*/
            max-height: 250px;
            /*max-width: 450px;*/
        }
    }

    .details {
        border: 1px solid black;
        border-right: 1px solid black;
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

    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        grid-gap: 10px;
        padding: 1rem;
        text-align: center;
    }

    .item-product {
        border: 1px solid rgb(241, 241, 241);
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
