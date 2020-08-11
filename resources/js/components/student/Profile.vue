<template>
    <div>
        <div class="jumbotron">
            <div class="justify-content-around align-items-center">
                <div class=" align-items-center text-white">
                    <div class="mt-4 text-center">
                        <img src="../../assets/images/details/02.png" alt="">
                    </div>
                    <div class="text-center">
                        <h4>Stephane Smith</h4>
                    </div>
                    <div class="text-center">
                        <p>Graphic Designer</p>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-center text-white" >
                <div class="p-4 border border-white text-center" style="height: 100px; width: 200px">
                    <span class="btn btn-danger">03 </span> <br> Purchased
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
                                user.about
                            </p>

                        </div>

                        <!-- courses-->
                        <div class="tab-pane fade show" id="courses">
                            Courses
                        </div>

                    </div>


                </div>
                <div class="col-md-1">

                </div>
                <div class="col-md-4 text-center ">
                    <div class="card bg-primary">
                        <div class="card-body text-center text-white">
                            <img src="../../assets/images/details/02.png" alt="">
                            <h3 class="card-title font-weight-bolder">user.first_name user.last_name</h3>
                            <p class="card-text">user.headline</p>
                            <a href="#" class="btn btn-danger">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "StudentProfile"
    }
</script>

<style scoped>
    .jumbotron {
        background-image: url('../../assets/images/teaprofile/bg.png');
        border-radius: 0;
    }
</style>
