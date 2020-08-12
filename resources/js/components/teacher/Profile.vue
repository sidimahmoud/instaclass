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
                    <span class="btn btn-danger">612K </span> <br> Enroll Students
                </div>
                <div class="p-4 border border-white text-center" style="height: 100px; width: 150px">
                    <span class="btn btn-danger">{{userCourses.length>0?userCourses.length:"0"}} </span> <br> Courses
                </div>

                <div class="p-4 border border-white text-center" style="height: 100px; width: 200px">
                    <span class="btn btn-danger">102 </span> <br> Reviews
                </div>

            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-7 bg-white shadow">
                    <nav class="nav nav-pills nav-fill mt-3">
                        <a class="nav-item nav-link active" href="#about" data-toggle="tab">About</a>
                        <a class="nav-item nav-link" href="#courses" data-toggle="tab">Courses</a>
                        <a class="nav-item nav-link" href="#Reviews" data-toggle="tab">Reviews</a>
                    </nav>
                    <hr>
                    <div class="tab-content my-5">
                        <div class="tab-pane fade show active" id="about">
                            <h3 class="font-weight-bolder">About Me</h3>
                            <p>
                                {{userProfile.about}}
                            </p>

                        </div>

                        <!-- courses-->
                        <div class="tab-pane fade show" id="courses">
                            <ul class="list-unstyled">
                                <li class="media shadow-sm border rounded p-2 mt-4" v-for="course in userCourses" :key="course.id">
                                    <div class="media-body">
                                        <router-link :to="{ name: 'Detail', params: { slug: course.slug}}" >
                                            <h5 class="mt-0 mb-1 text-danger font-weight-bolder">{{course.name}}</h5>
                                        </router-link>
                                        {{course.short_description}}
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary btn-sm disabled">
                                                Enrollments <span class="badge badge-light">4</span>
                                            </button>
                                            <button type="button" class="btn btn-primary btn-sm disabled ml-5">
                                                All views <span class="badge badge-light">410</span>
                                            </button>
                                        </div>
                                    </div>
                                </li>

                            </ul>

                        </div>

                        <!--                            Reviews-->
                        <div class="tab-pane fade show" id="Reviews">

                            Reviews

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
    import {mapGetters, mapActions} from 'vuex'

    export default {
        name: "TeacherProfile",
        methods: {
            ...mapActions(["fetchProfile"]),
            fetchUserCourses() {
                this.$store.dispatch('fetchUserCourses', this.userProfile.id)
            },
        },
        computed: mapGetters(["userProfile", "userCourses"]),
        created() {
            this.fetchProfile();
            this.fetchUserCourses();
        }
    }

</script>

<style scoped>
    .jumbotron {
        background-image: url('../../assets/images/teaprofile/bg.png');
        border-radius: 0;
    }

</style>
