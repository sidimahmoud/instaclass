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
                <div class="col-md-7 bg-white">
                    <nav class="nav nav-pills nav-fill mt-3">
                        <a class="nav-item nav-link bg-danger text-white" href="#">About</a>
                        <a class="nav-item nav-link" href="#">Purchased</a>
                        <a class="nav-item nav-link" href="#">Discussions</a>
                        <a class="nav-item nav-link" href="#">My Reviews</a>
                    </nav>
                    <hr>
                    <h3 class="font-weight-bolder">About me</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt ipsa, iusto molestiae nam
                        natus quasi! Aliquam aspernatur autem culpa debitis ducimus et rem sunt temporibus. Ipsa magni
                        reiciendis temporibus vel! <br>
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis
                        unde omnis iste natus.
                        <br>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, amet eos fugiat impedit iste nam
                        natus nostrum, odio quaerat repellat sunt, vero vitae voluptates! Aliquid debitis molestiae
                        pariatur recusandae veritatis!
                    </p>

                </div>
                <div class="col-md-1">

                </div>
                <div class="col-md-4 text-center ">
                    <div class="card bg-primary">
                        <div class="card-body text-center text-white">
                            <img src="../../assets/images/details/02.png" alt="">
                            <h3 class="card-title font-weight-bolder">Stephane Smith</h3>
                            <p class="card-text">Graphic Designer</p>
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
