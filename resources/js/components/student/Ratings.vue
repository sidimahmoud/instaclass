<template>
    <div>
        <section class="hero mb-2 pt-5">
            <div class="container mt-4 h-100">
            </div>
        </section>
        <div class="container-fluid">
            <div class="row my-4 student-area">
                <div class="col-md-12 bg-white shadow">
                    <div class="tab-content my-1">
                        <h4>{{$t('profile.ratings')}}</h4>
                        <div class="tab-pane fade show" id="ratings">
                            <div  v-if="!isEmpty(userProfile.ratings)">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{$t('profile.teacherName')}}</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">{{$t('profile.ratings')}}</th>
                                        <th scope="col">{{$t('profile.comment')}}</th>
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
                            </div>
                            <div class="text-center no-content" v-else>
                                <h3>{{$t('profile.noRatings')}}</h3>
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
    import {isEmpty} from "../../helpers/common";

    export default {
        name: "StudentRatings",
        /*
        |--------------------------------------------------------------------------
        | Component > components
        |--------------------------------------------------------------------------
        */
        components: {},
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
            
            isEmpty(v) {
                return isEmpty(v);
            },
        },
        /*
        |--------------------------------------------------------------------------
        | Component > computed
        |--------------------------------------------------------------------------
        */
        computed: {
            ...mapGetters(["userProfile"]),
        },
        /*
        |--------------------------------------------------------------------------
        | Component > mounted
        |--------------------------------------------------------------------------
        */
        mounted() {},
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
        border: 1px solid black;
        border-radius: 1px;
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
    .no-content {
        margin-bottom: 120px;
    }
</style>
