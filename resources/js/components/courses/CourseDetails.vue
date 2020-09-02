<template>
    <div>
        <div class="text-center text-primary" v-if="loading">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div v-if="!loading">
            <!--            blue band-->
            <div class="jumbotron"></div>
            <!--/            blue band-->
            <!--            Course header-->
            <div class="container bg-white">
                <div class="row justify-content-around align-items-center border-bottom border-primary">
                    <div class="col-md-2 text-center">
                        <img :src="course.user.image" width="80px" alt="Avatar">
                        <br>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                    </div>
                    <div class="col-md-3">
                        <div class="font-weight-bolder">
                            {{course.user.first_name}}
                        </div>
                        <div>
                            {{course.user.city}},{{course.user.country}}
                        </div>
                        <div v-if="course.user.languages">
                            Spoken languages: {{course.user.languages}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <a href="https://www.facebook.com/sharer/sharer.php?s=100&p[url]=https://www.instantclass.herokuapp.com/courses&p[images][0]=&p[title]=Title%20Goes%20Here&p[summary]=Description%20goes%20here!">
                            <img src="../../assets/images/fb.png" alt="fb" width="150px">
                            <i class="fa fa-thumbs-up fa-2x text-primary"></i>

                        </a> <br>
                        <!--                        <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&width=117&layout=button_count&action=like&size=large&share=false&height=21&appId=223985172274465" width="117" height="21" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>-->
                    </div>
                    <div class="col-md-2">
                        <a href="#"> <img src="../../assets/images/insta.png" alt="insta" width="150px"></a>

                        <!--                        <a href="https://www.facebook.com/sharer/sharer.php?s=100&p[url]=https://www.instantclass.herokuapp.com&p[images][0]=&p[title]=Title%20Goes%20Here&p[summary]=Description%20goes%20here!"-->
                        <!--                           target="_blank"-->
                        <!--                           onclick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=250'); return false">-->
                        <!--                            <button type="button"-->
                        <!--                                    class="btn btn-facebook "><i class="fa fa-facebook fa-2"></i>-->
                        <!--                                <i class="fa fa-share-alt"></i>-->
                        <!--                            </button>-->
                        <!--                        </a>-->
                        <!--                        <a href="#" target="_blank">-->
                        <!--                            <button type="button" class="btn btn-instagram ">-->
                        <!--                                <i class="fa fa-instagram"/>-->
                        <!--                                <i class="fa fa-share-alt"></i>-->
                        <!--                            </button>-->
                        <!--                        </a>-->
                    </div>
                    <div class="col-md-2">
                        <router-link
                            :to="{ name: 'Checkout', params: {id: course.id, name: course.name, price: course.price}}"
                            tag="a" class="btn btn-primary my-3" v-if="!enrolled">
                            S'inscrire à tout les séances
                        </router-link>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-3" v-if="course.category">
                        <router-link :to="{ name: 'CategCourses', params: { id: course.category.id}}" tag="a" class="mr-3">
                            Category: <strong>{{course.category.name}}</strong>
                        </router-link>
                        Sub-category :
                    </div>
                    <div class="col-md-3">Number of Sessions: {{course.sections.length}}</div>
                    <div class="col-md-3">Language : {{course.language}}</div>
                    <div class="col-md-3">Price: ${{course.price}}/session</div>
                </div>
                <div class="row justify-content-around align-items-center shadow-sm" v-for="section in course.sections"
                     :key="section.id">
                    <div class="col-md-9">
                        <h4>{{section.title}}</h4>
                        <p>{{section.description}}</p>
                        <p>
                            Availabilities : {{section.startDate}}
                        </p>
                    </div>
                    <div class="col-md-1 d-none -d-md-flex"></div>
                    <div class="col-md-2">
                        <router-link
                            :to="{ name: 'Checkout', params: {id: course.id, name: course.name, price: course.price}}"
                            tag="a" class="btn btn-primary my-3" v-if="!enrolled">
                            S'inscrire
                        </router-link>
                    </div>
                </div>
            </div>
            <!--/            Course header-->

            <!--            Course details-->
            <!--            <div class="container">-->
            <!--                <div class="row">-->
            <!--                    <div class="col-md-12 bg-white ">-->
            <!--                        <nav class="nav nav-pills nav-fill mt-3">-->
            <!--                            <a class="nav-item nav-link active" href="#overview" data-toggle="tab">Overview</a>-->
            <!--                            <a class="nav-item nav-link" href="#FAQ" data-toggle="tab">FAQ</a>-->
            <!--                            <a class="nav-item nav-link" href="#Reviews" data-toggle="tab">Reviews</a>-->
            <!--                        </nav>-->
            <!--                        <hr>-->
            <!--                        <div class="tab-content my-5">-->
            <!--                            <div class="tab-pane fade show active" id="overview">-->
            <!--                                <h3 class="font-weight-bolder">{{course.name}}</h3>-->
            <!--                                <p>-->
            <!--                                    {{course.description}}-->
            <!--                                </p>-->
            <!--                                <div>-->
            <!--                        <span>-->
            <!--                            <span class="h5 mr-5 font-weight-bold">{{course.enrollments.length}} Total Students</span>-->
            <!--                        </span>-->
            <!--                                    <span>-->
            <!--                                 4.7-->
            <!--                        <i class="fa fa-star text-warning"></i>-->
            <!--                        <i class="fa fa-star text-warning"></i>-->
            <!--                        <i class="fa fa-star text-warning"></i>-->
            <!--                        <i class="fa fa-star text-warning"></i>-->
            <!--                        <i class="fa fa-star text-warning"></i>-->
            <!--                        ({{course.ratings.length}} Rating)-->
            <!--                        </span>-->
            <!--                                </div>-->
            <!--                                <div>-->
            <!--                                    <p class="h5 mt-5 font-weight-bold">What you’ll learn?</p>-->
            <!--                                    <ul>-->
            <!--                                        <li>Phasellus enim magna, varius et commodo ut.</li>-->
            <!--                                        <li>Sed consequat justo non mauris pretium at tempor justo.</li>-->
            <!--                                        <li>Ut nulla tellus, eleifend euismod pellentesque vel, sagittis vel justo.</li>-->
            <!--                                        <li>Phasellus enim magna, varius et commodo ut.</li>-->
            <!--                                        <li>Sed consequat justo non mauris pretium at tempor justo.</li>-->
            <!--                                        <li>Nulla tellus, eleifend euismod pellentesque vel, sagittis vel justo.</li>-->
            <!--                                    </ul>-->
            <!--                                </div>-->
            <!--                                <div>-->
            <!--                                    <p class="h5 mt-5 font-weight-bold">Requirements</p>-->
            <!--                                    <ul>-->
            <!--                                        <li>Phasellus enim magna, varius et commodo ut.</li>-->
            <!--                                        <li>Sed consequat justo non mauris pretium at tempor justo.</li>-->
            <!--                                        <li>Ut nulla tellus, eleifend euismod pellentesque vel, sagittis vel justo.</li>-->

            <!--                                    </ul>-->
            <!--                                </div>-->
            <!--                            </div>-->

            <!--                            &lt;!&ndash;FAQ&ndash;&gt;-->
            <!--                            <div class="tab-pane fade show" id="FAQ">-->
            <!--                                FAQ-->
            <!--                            </div>-->

            <!--                            &lt;!&ndash;Reviews&ndash;&gt;-->
            <!--                            <div class="tab-pane fade show" id="Reviews">-->

            <!--                                <h5 class="my-4 font-weight-bolder">Ratings and Reviews</h5>-->
            <!--                                <div v-if="course.ratings.length>0">-->
            <!--                                    <div class="bg-white rounded  px-4 mb-4 ">-->
            <!--                                        <div>-->
            <!--                                            <div class="star-rating">-->
            <!--                                                <a href="#"><i class="fa fa-star text-warning"></i></a>-->
            <!--                                                <a href="#"><i class="fa fa-star text-warning"></i></a>-->
            <!--                                                <a href="#"><i class="fa fa-star text-warning"></i></a>-->
            <!--                                                <a href="#"><i class="fa fa-star text-warning"></i></a>-->
            <!--                                                <a href="#"><i class="fa fa-star text-warning"></i></a>-->
            <!--                                                <b class="text-black ml-2">{{course.ratings.length>0?course.ratings.length:"0"}}</b>-->
            <!--                                            </div>-->
            <!--                                            <p class="text-black mb-4 mt-2">Rated 3.5 out of 5</p>-->
            <!--                                        </div>-->
            <!--                                        <div class="graph-rating">-->
            <!--                                            <div class="row">-->
            <!--                                                <div class="col-2">-->
            <!--                                                    5 <i class="fa fa-star text-primary"></i>-->
            <!--                                                </div>-->
            <!--                                                <div class="col-8">-->
            <!--                                                    <div class="progress">-->
            <!--                                                        <div class="progress-bar" role="progressbar" style="width: 50%;"-->
            <!--                                                             aria-valuemin="0" aria-valuemax="100"></div>-->
            <!--                                                    </div>-->
            <!--                                                </div>-->
            <!--                                                <div class="col-2">-->
            <!--                                                    50%-->
            <!--                                                </div>-->
            <!--                                            </div>-->
            <!--                                            <div class="row">-->
            <!--                                                <div class="col-2">-->
            <!--                                                    4 <i class="fa fa-star text-primary"></i>-->
            <!--                                                </div>-->
            <!--                                                <div class="col-8">-->
            <!--                                                    <div class="progress">-->
            <!--                                                        <div class="progress-bar" role="progressbar" style="width: 30%;"-->
            <!--                                                             aria-valuemin="0" aria-valuemax="100"></div>-->
            <!--                                                    </div>-->
            <!--                                                </div>-->
            <!--                                                <div class="col-2">-->
            <!--                                                    30%-->
            <!--                                                </div>-->
            <!--                                            </div>-->
            <!--                                            <div class="row">-->
            <!--                                                <div class="col-2">-->
            <!--                                                    3 <i class="fa fa-star text-primary"></i>-->
            <!--                                                </div>-->
            <!--                                                <div class="col-8">-->
            <!--                                                    <div class="progress">-->
            <!--                                                        <div class="progress-bar" role="progressbar" style="width: 12%;"-->
            <!--                                                             aria-valuemin="0" aria-valuemax="100"></div>-->
            <!--                                                    </div>-->
            <!--                                                </div>-->
            <!--                                                <div class="col-2">-->
            <!--                                                    12%-->
            <!--                                                </div>-->
            <!--                                            </div>-->
            <!--                                            <div class="row">-->
            <!--                                                <div class="col-2">-->
            <!--                                                    2 <i class="fa fa-star text-primary"></i>-->
            <!--                                                </div>-->
            <!--                                                <div class="col-8">-->
            <!--                                                    <div class="progress">-->
            <!--                                                        <div class="progress-bar" role="progressbar" style="width: 8%;"-->
            <!--                                                             aria-valuemin="0" aria-valuemax="100"></div>-->
            <!--                                                    </div>-->
            <!--                                                </div>-->
            <!--                                                <div class="col-2">-->
            <!--                                                    08%-->
            <!--                                                </div>-->
            <!--                                            </div>-->
            <!--                                            <div class="row">-->
            <!--                                                <div class="col-2">-->
            <!--                                                    1 <i class="fa fa-star text-primary"></i>-->
            <!--                                                </div>-->
            <!--                                                <div class="col-8">-->
            <!--                                                    <div class="progress">-->
            <!--                                                        <div class="progress-bar" role="progressbar" style="width: 0%;"-->
            <!--                                                             aria-valuemin="0" aria-valuemax="100"></div>-->
            <!--                                                    </div>-->
            <!--                                                </div>-->
            <!--                                                <div class="col-2">-->
            <!--                                                    0%-->
            <!--                                                </div>-->
            <!--                                            </div>-->
            <!--                                        </div>-->

            <!--                                    </div>-->
            <!--                                    <h5 class="my-4 font-weight-bolder">All Ratings and Reviews</h5>-->
            <!--                                    &lt;!&ndash;<review v-for="rating in course.ratings" :key="rating.id" :rating="rating"/>&ndash;&gt;-->

            <!--                                    <div class="media mt-3 shadow-sm" v-for="rating in course.ratings" :key="rating.id">-->
            <!--                                        <a href="#">-->
            <!--                                            <img alt="Generic placeholder image"-->
            <!--                                                 :src="rating.user.image"-->
            <!--                                                 class="mr-3 rounded-pill" height="50px">-->
            <!--                                        </a>-->
            <!--                                        <div class="media-body">-->
            <!--                                            <div class="reviews-members-header">-->
            <!--                                                <span class="star-rating float-right">-->
            <!--                                                      <i class="fa fa-star text-warning"-->
            <!--                                                         v-for="star in rating.rate"></i>-->
            <!--                                                </span>-->
            <!--                                                <h6 class="mb-1"><a class="text-black" href="#">{{rating.user.first_name}}-->
            <!--                                                    {{rating.user.last_name}}</a>-->
            <!--                                                </h6>-->
            <!--                                                <p class="text-gray">{{rating.created_at.slice(0, 10)}}</p>-->
            <!--                                            </div>-->
            <!--                                            <div class="reviews-members-body">-->
            <!--                                                <p>{{rating.review}}-->
            <!--                                                </p>-->
            <!--                                            </div>-->

            <!--                                        </div>-->
            <!--                                    </div>-->
            <!--                                </div>-->


            <!--                                <div v-else class="text-center">-->
            <!--                                    <h3>There is no ratings yet</h3>-->
            <!--                                </div>-->

            <!--                            </div>-->
            <!--                        </div>-->


            <!--                    </div>-->
            <!--                </div>-->
            <!--                <div class="row mt-5 p-5 bg-primary text-center text-white">-->
            <!--                    <div class="col-12">-->
            <!--                        <h1>Ready to get started</h1>-->
            <!--                        <div>-->
            <!--                            <button class="btn btn-danger">-->
            <!--                                <router-link :to="{name: 'Courses'}" tag="a" class="text-white">-->
            <!--                                    View all courses-->
            <!--                                </router-link>-->
            <!--                            </button>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
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
        computed: mapGetters(["course", "loading", "enrolled", 'isLoggedIn']),
        created() {
            this.findCourse();
        },

    }

</script>

<style scoped lang="scss">
    .jumbotron {
        background-image: url('../../assets/images/details/bg.png');
        border-radius: 0;
        height: 50px;
        padding: 0;

    }

    .rounded-pill {
        border-radius: 50rem !important;
    }

    .btn-facebook {
        text-decoration: none;
        color: #4C67A1;
        transition: all .2s ease-in-out;


        &:hover {
            background: linear-gradient(to right, #4C67A1 0%, #0389a1 100%);
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.10);


            i {
                color: #ffffff;
            }
        }


    }

    .btn-instagram {
        text-decoration: none;
        color: #C71E7E;
        transition: all .2s ease-in-out;


        &:hover {
            background: linear-gradient(to right, #ff3019 0%, #c90477 100%);
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.10);

            i {
                color: #ffffff;
            }
        }

    }

</style>
