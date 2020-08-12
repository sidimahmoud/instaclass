<template>
    <div>
        <div class="jumbotron">
            <div class="justify-content-around align-items-center">
                <div class=" align-items-center text-white">
                    <div class="mt-4 text-center">
                        <img src="../../assets/images/details/02.png" alt="">
                    </div>
                    <div class="text-center">
                        <h4>{{userProfile.first_name}} {{userProfile.last_name}}</h4>
                    </div>
                    <div class="text-center">
                        <p>{{userProfile.headline}}</p>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-center text-white">
                <div class="p-4 border border-white text-center" style="height: 100px; width: 200px">
                    <span class="btn btn-danger">{{userEnrollments.length>0? userEnrollments.length : "0"}} </span> <br>
                    Purchased
                </div>
                <div class="p-4 border border-white text-center" style="height: 100px; width: 150px">
                    <span class="btn btn-danger">03 </span> <br> Certifications
                </div>
                <div class="p-4 border border-white text-center" style="height: 100px; width: 150px">
                    <span class="btn btn-danger">4K</span> <br> Subscriptions
                </div>
                <div class="p-4 border border-white text-center" style="height: 100px; width: 200px">
                    <span class="btn btn-danger">12 </span> <br> My Reviews
                </div>

            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-7 bg-white shadow">
                    <nav class="nav nav-pills nav-fill mt-3">
                        <a class="nav-item nav-link active" href="#about" data-toggle="tab">About</a>
                        <a class="nav-item nav-link" href="#courses" data-toggle="tab">My courses</a>
                    </nav>
                    <hr>
                    <div class="tab-content my-5">
                        <div class="tab-pane fade show active" id="about">
                            <h3 class="font-weight-bolder">About Me</h3>
                            <p>
                                {{userProfile.about}}
                            </p>

                        </div>

                        <!-- Enrollments-->
                        <div class="tab-pane fade show" id="courses">
                            <ul class="list-unstyled">
                                <li class="media p-2 mt-4" v-if="userEnrollments.length==0">
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-1">No courses</h5>
                                        <p class="text-center">
                                            visit <a href="/courses"> courses
                                        </a> to get started
                                        </p>
                                    </div>
                                </li>
                                <li class="media card p-2 mt-4" v-for="e in userEnrollments" :key="e.id">
                                    <div class="media-body">
                                        <router-link :to="{name: 'Player', params: { slug: e.course.slug} }">
                                            <h5 class="mt-0 mb-1">{{e.course.name}}</h5>
                                        </router-link>
                                        {{e.created_at.slice(0,10)}}
                                    </div>
                                </li>

                            </ul>
                        </div>

                    </div>


                </div>
                <div class="col-md-1">

                </div>
                <div class="col-md-4 text-center ">
                    <div class="card bg-primary">
                        <div class="card-body text-center text-white">
                            <img src="../../assets/images/details/02.png" alt="">
                            <h3 class="card-title font-weight-bolder">{{userProfile.first_name}}
                                {{userProfile.last_name}}</h3>
                            <p class="card-text">{{userProfile.headline}}</p>
                            <a href="#" class="btn btn-danger">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "StudentProfile",
        methods: {
            ...mapActions(["fetchProfile", "fetchUserEnrollments"]),

        },
        computed: mapGetters(["userProfile", "userEnrollments"]),
        created() {
            this.fetchProfile();
            this.fetchUserEnrollments();
        }
    }
</script>

<style scoped>
    .jumbotron {
        background-image: url('../../assets/images/teaprofile/bg.png');
        border-radius: 0;
    }
</style>
