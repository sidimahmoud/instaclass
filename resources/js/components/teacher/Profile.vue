<template>
    <div>
        <div class="jumbotron">
            <div class="justify-content-around align-items-center">
                <div class=" align-items-center text-white">
                    <div class="mt-4 text-center">
                        <img src="../../assets/images/details/02.png" alt="">
                    </div>
                    <div class="text-center">
                        <h4>{{user.first_name}} {{user.last_name}}</h4>
                    </div>
                    <div class="text-center">
                        <p>{{user.headline}}</p>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-center text-white">
                <div class="p-4 border border-white text-center" style="height: 100px; width: 200px">
                    <span class="btn btn-danger">612K </span> <br> Enroll Students
                </div>
                <div class="p-4 border border-white text-center" style="height: 100px; width: 150px">
                    <span class="btn btn-danger">08 </span> <br> Courses
                </div>
                <div class="p-4 border border-white text-center" style="height: 100px; width: 150px">
                    <span class="btn btn-danger">44K</span> <br> Subscriptions
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
                                {{user.about}}
                            </p>

                        </div>

                        <!-- courses-->
                        <div class="tab-pane fade show" id="courses">
                            <ul class="list-unstyled">
                                <li class="media mt-4" v-for="course in courses" :key="course.id">
                                    <img class="mr-3" :src="course.image" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-1">{{course.name}}</h5>
                                        {{course.short_description}}
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
                            <h3 class="card-title font-weight-bolder">{{user.first_name}} {{user.last_name}}</h3>
                            <p class="card-text">{{user.headline}}</p>
                            <a href="#" class="btn btn-danger">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: "TeacherProfile",
        data() {
            return {
                user: '',
                courses: [],
            }
        },
        created() {
            let token = localStorage.getItem('token') || '';
            if (token) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
                axios.get('https://instantclass.herokuapp.com/api/user').then(res => this.user = res.data);
                axios.get(`https://instantclass.herokuapp.com/api/${this.user.id}/courses`).then(res => this.courses = res.data)

                    .catch(err => console.log(err))
            }
        }
    }

</script>

<style scoped>
    .jumbotron {
        background-image: url('../../assets/images/teaprofile/bg.png');
        border-radius: 0;
    }

</style>
