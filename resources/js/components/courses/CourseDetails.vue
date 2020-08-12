<template>
    <div>
        <div class="text-center text-primary" v-if="loading">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div v-if="!loading">
            <div class="jumbotron">
                <div class="container d-flex align-items-center">
                    <div class="row justify-content-around align-items-center">
                        <div class="col-md-6 col-sm-12  justify-content-center align-items-center text-white">
                            <img :src="course.image" alt="" class="img-fluid" max-width="500px">
                        </div>

                        <div class="col-md-6 col-sm-12 text-center text-md-left p-2 text-white">
                            <h2>{{course.name}}</h2>
                            <p>{{course.short_description}}</p>
                            <br>
                            <span class="badge badge-warning text-white">
                            <i class="fa fa-star text-white mr-2"></i>
                            4.7
                        </span>
                            ({{course.ratings.length }} rating)
                            <div class="mt-4">
                                <img src="../../assets/images/details/02.png" alt="">
                                <span class="font-weight-bolder">
                            {{course.user.first_name}} {{course.user.last_name}}
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-7 bg-white shadow">
                        <nav class="nav nav-pills nav-fill mt-3">
                            <a class="nav-item nav-link active" href="#overview" data-toggle="tab">Overview</a>
                            <a class="nav-item nav-link" href="#FAQ" data-toggle="tab">FAQ</a>
                            <a class="nav-item nav-link" href="#Reviews" data-toggle="tab">Reviews</a>
                        </nav>
                        <hr>
                        <div class="tab-content my-5">
                            <div class="tab-pane fade show active" id="overview">
                                <h3 class="font-weight-bolder">{{course.name}}</h3>
                                <p>
                                    {{course.description}}
                                </p>
                                <div>
                        <span>
                            <span class="h5 mr-5 font-weight-bold">{{course.enrollments.length}} Total Students</span>
                        </span>
                                    <span>
                                 4.7
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        ({{course.ratings.length}} Rating)
                        </span>
                                </div>
                                <div>
                                    <p class="h5 mt-5 font-weight-bold">What you’ll learn?</p>
                                    <ul>
                                        <li>Phasellus enim magna, varius et commodo ut.</li>
                                        <li>Sed consequat justo non mauris pretium at tempor justo.</li>
                                        <li>Ut nulla tellus, eleifend euismod pellentesque vel, sagittis vel justo.</li>
                                        <li>Phasellus enim magna, varius et commodo ut.</li>
                                        <li>Sed consequat justo non mauris pretium at tempor justo.</li>
                                        <li>Nulla tellus, eleifend euismod pellentesque vel, sagittis vel justo.</li>
                                    </ul>
                                </div>
                                <div>
                                    <p class="h5 mt-5 font-weight-bold">Requirements</p>
                                    <ul>
                                        <li>Phasellus enim magna, varius et commodo ut.</li>
                                        <li>Sed consequat justo non mauris pretium at tempor justo.</li>
                                        <li>Ut nulla tellus, eleifend euismod pellentesque vel, sagittis vel justo.</li>

                                    </ul>
                                </div>
                            </div>

                            <!--FAQ-->
                            <div class="tab-pane fade show" id="FAQ">
                                FAQ
                            </div>

                            <!--Reviews-->
                            <div class="tab-pane fade show" id="Reviews">

                                <h5 class="my-4 font-weight-bolder">Ratings and Reviews</h5>
                                <div v-if="course.ratings.length>0">
                                    <div class="bg-white rounded  px-4 mb-4 ">
                                        <div>
                                            <div class="star-rating">
                                                <a href="#"><i class="fa fa-star text-warning"></i></a>
                                                <a href="#"><i class="fa fa-star text-warning"></i></a>
                                                <a href="#"><i class="fa fa-star text-warning"></i></a>
                                                <a href="#"><i class="fa fa-star text-warning"></i></a>
                                                <a href="#"><i class="fa fa-star text-warning"></i></a>
                                                <b class="text-black ml-2">334</b>
                                            </div>
                                            <p class="text-black mb-4 mt-2">Rated 3.5 out of 5</p>
                                        </div>
                                        <div class="graph-rating">
                                            <div class="row">
                                                <div class="col-2">
                                                    5 <i class="fa fa-star text-primary"></i>
                                                </div>
                                                <div class="col-8">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 50%;"
                                                             aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    50%
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2">
                                                    4 <i class="fa fa-star text-primary"></i>
                                                </div>
                                                <div class="col-8">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 30%;"
                                                             aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    30%
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2">
                                                    3 <i class="fa fa-star text-primary"></i>
                                                </div>
                                                <div class="col-8">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 12%;"
                                                             aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    12%
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2">
                                                    2 <i class="fa fa-star text-primary"></i>
                                                </div>
                                                <div class="col-8">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 8%;"
                                                             aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    08%
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2">
                                                    1 <i class="fa fa-star text-primary"></i>
                                                </div>
                                                <div class="col-8">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 0%;"
                                                             aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    0%
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <h5 class="my-4 font-weight-bolder">All Ratings and Reviews</h5>
                                    <!--<review v-for="rating in course.ratings" :key="rating.id" :rating="rating"/>-->

                                    <div class="media mt-3 shadow-sm" v-for="rating in course.ratings" :key="rating.id">
                                        <a href="#">
                                            <img alt="Generic placeholder image"
                                                 src="http://bootdey.com/img/Content/avatar/avatar1.png"
                                                 class="mr-3 rounded-pill" height="50px">
                                        </a>
                                        <div class="media-body">
                                            <div class="reviews-members-header">
                                                <span class="star-rating float-right">
                                                      <i class="fa fa-star text-warning" v-for="star in rating.rate"></i>
                                                </span>
                                                <h6 class="mb-1"><a class="text-black" href="#">{{rating.user.first_name}}
                                                    {{rating.user.last_name}}</a>
                                                </h6>
                                                <p class="text-gray">{{rating.created_at.slice(0, 10)}}</p>
                                            </div>
                                            <div class="reviews-members-body">
                                                <p>{{rating.review}}
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div v-else class="text-center">
                                    <h3>There is no ratings yet</h3>
                                </div>

                            </div>
                        </div>


                    </div>
                    <div class="col-md-1">

                    </div>
                    <div class="col-md-4 text-center">
                        <div class="card bg-white">
                            <img class="card-img-top" :src="course.image" alt="Card image cap">
                            <div class="card-body text-center">
                                <h3 class="card-title font-weight-bolder text-danger">
                                    {{(course.status==2)?'$'+course.price:"Free Course"}}</h3>
                                <p class="card-text">23 hours left at this price!</p>
                                <a href="#" class="btn btn-primary my-3">Buy now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5 p-5 bg-primary text-center text-white">
                    <div class="col-12">
                        <h1>Ready to get started</h1>
                        <div>
                            <button class="btn btn-danger">View all courses</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>

    import {mapGetters} from "vuex";
    import Review from "./Review";

    export default {
        name: 'Detail',
        components: {Review},
        methods: {
            findCourse() {
                this.$store.dispatch('getCourse', this.$route.params.slug)
            },
        },
        computed: mapGetters(["course", "loading", 'isLoggedIn']),
        created() {
            this.findCourse();
        }
    }

</script>

<style scoped>

    .jumbotron {
        background-image: url('../../assets/images/details/bg.png');
        border-radius: 0;
    }

    .rounded-pill {
        border-radius: 50rem !important;
    }
</style>
