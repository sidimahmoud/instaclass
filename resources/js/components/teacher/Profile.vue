<template>
    <div>
        <div class="jumbotron">
            <button class="btn btn-danger float-right" @click="logout">
                Logout
            </button>
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
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                New Course
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <new-course/>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="payments">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsePayment" aria-expanded="false" aria-controls="collapsePayment">
                                Payments
                            </button>
                        </h2>
                    </div>
                    <div id="collapsePayment" class="collapse" aria-labelledby="payments" data-parent="#accordionExample">
                        <div class="card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Receipts
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="evaluation">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEval" aria-expanded="false" aria-controls="collapseEval">
                                Reviews
                            </button>
                        </h2>
                    </div>
                    <div id="collapseEval" class="collapse" aria-labelledby="evaluation" data-parent="#accordionExample">
                        <div class="card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Personal informations
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-7 bg-white shadow">
                                        <nav class="nav nav-pills nav-fill mt-3">
                                            <a class="nav-item nav-link active" href="#about" data-toggle="tab">About</a>
                                            <a class="nav-item nav-link" href="#courses" data-toggle="tab">My Courses</a>
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
                                                    <li class="media shadow-sm border rounded p-2 mt-4" v-for="course in userCourses"
                                                        :key="course.id">
                                                        <div class="media-body">
                                                            <router-link :to="{ name: 'Detail', params: { slug: course.slug}}">
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
                                                <router-link :to="{name: 'EditProfile'}" tag="a" class="btn btn-danger">
                                                    Edit Profile
                                                </router-link>                                            </div>
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
    import {mapGetters, mapActions} from 'vuex'
    import NewCourse from "./NewCourse";
    export default {
        name: "TeacherProfile",
        components:{
            NewCourse
        },
        methods: {
            ...mapActions(["fetchProfile"]),
            fetchUserCourses() {
                this.$store.dispatch('fetchUserCourses', this.userProfile.id)
            },
            logout() {
                this.$store.dispatch('logout')
                    .then(() => {
                        this.$router.push('/')
                    })
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
