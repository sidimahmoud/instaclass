<template>
    <div>
        <div class="hero">
            <div class="jumbotron jumbotron1 mb-0">
            <span class=" px-1 py-3  shareBar">
                <iframe
                    src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&layout=button&size=large&appId=223985172274465&width=93&height=28"
                    width="93" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                    allowTransparency="true" allow="encrypted-media">
                </iframe>
                <p>
                    <a href="https://www.instagram.com/canada/?hl=en" target="_blank"> <img
                        src="../assets/images/insta.png"
                        alt="insta" class="rounded"
                        width="93px">
                  </a>
                </p>



            </span>
                <div class="container  align-items-center mt-md-2 h-100">
                    <div class="row justify-content-around align-items-center h-100">
                        <div class="col-md-6 d-sm-none"></div>
                        <div
                            class="col-md-6 col-sm-12 text-center px-md-5 justify-content-center align-items-center ">
                            <h1>
                                {{$t('title')}}
                            </h1>

                        </div>
                        <!--                    <div class="col-md-6 d-none d-md-block">-->
                        <!--                        <img src="../assets/images/home/home.png" width="450px" class=" float-right"-->
                        <!--                             alt="logo">-->
                        <!--                    </div>-->
                    </div>
                </div>
            </div>
            <div class="jumbotron jumbotron2">

                <div class="container  align-items-center mt-2">
                    <div class="row justify-content-around align-items-center">
                        <div
                            class="col-md-6 col-sm-12 justify-content-center align-items-center text-white">
                            <h3>
                                {{$t('title2.teachers.title')}}:
                            </h3>
                            <ul>
                                <li>{{$t('title2.teachers.1')}}</li>
                                <li>{{$t('title2.teachers.2')}}</li>
                                <li>{{$t('title2.teachers.3')}}</li>
                            </ul>
                            <h3>
                                {{$t('title2.students.title')}}:
                            </h3>
                            <ul>
                                <li>{{$t('title2.students.1')}}</li>
                                <li>{{$t('title2.students.2')}}</li>
                                <li>{{$t('title2.students.3')}}</li>
                            </ul>
                            <!--<img src="../assets/images/home/onlineEd.jpg" width="350px">-->
                        </div>
                        <div class="col-md-6 col-sm-12 text-center d-none d-md-block">
                            <img src="../assets/images/home/onlineEd.jpg" width="400px" class="img-fluid rounded">
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <section class="classes">
            <div class="container d-flex flex-column justify-content-center align-items-center mt-5 ">
                <h3 class="text-primary">
                    {{$t('coursesByCateg')}}
                </h3>
                <span class="latest_courses_border"> </span>
            </div>
            <div class="container  ">
                <div class="text-center text-primary" v-if="loadingCategories">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                <div class="row my-5 categories" v-if="!loadingCategories">
                    <category-compo v-for="category in allCategories" :categ="category" :key="category.id"/>
                </div>
            </div>
        </section>
        <section class="whyChoose">
            <div class="container">
                <div class="row p-3">
                    <div class="col-12 text-center text-white">
                        <h3>Why choosing us</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliquid
                            cupiditate
                            dignissimos earum excepturi exercitationem id ipsa ipsam, molestias pariatur possimus quas
                            quia
                            quod repudiandae similique totam voluptatem voluptatibus.</p>
                    </div>
                    <div class="col-md-3 ">
                        <div class="shadow-sm carte m-3 text-center " style="background: #6098C9;">
                            <h3>Live interacting online tutoring classes</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur dignissimos
                                dolore
                                esse explicabo impedit ipsum libero odio optio perspiciatis provident, qui rerum!
                                Accusantium dolore eius illo maiores mollitia, nobis tenetur?
                            </p>
                        </div>
                    </div>

                    <div class="col-md-3 ">
                        <div class="shadow-sm carte   m-3 text-center " style="background: #53C4B4;">
<!--                            <svg height="100" width="100" class="carte-icon">-->
<!--                                <circle cx="50" cy="50" r="40" stroke="blue" stroke-width="1" fill="white"/>-->
<!--                            </svg>-->
                            <h3>Live interacting online tutoring classes</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur dignissimos
                                dolore
                                esse explicabo impedit ipsum libero odio optio perspiciatis provident, qui rerum!
                                Accusantium dolore eius illo maiores mollitia, nobis tenetur?
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3 ">
                        <div class="shadow-sm carte  m-3  text-center " style="background: #B9A253;">
                            <h3>Live interacting online tutoring classes</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur dignissimos
                                dolore
                                esse explicabo impedit ipsum libero odio optio perspiciatis provident, qui rerum!
                                Accusantium dolore eius illo maiores mollitia, nobis tenetur?
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3 ">
                        <div class="shadow-sm carte  m-3  text-center " style="background: #DC7280;">
                            <h3>Live interacting online tutoring classes</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur dignissimos
                                dolore
                                esse explicabo impedit ipsum libero odio optio perspiciatis provident, qui rerum!
                                Accusantium dolore eius illo maiores mollitia, nobis tenetur?
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="reviews mt-5 mb-0 p-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2 class="text-center">Perfect reviews from our real customers</h2>
                        <p class="text-justify">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet autem culpa delectus deserunt
                            dolor ducimus ea eum, exercitationem explicabo facilis hic id iste laboriosam placeat qui
                            rerum
                            ullam voluptas voluptatem?
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aliquam aperiam molestias
                            mollitia
                            repellat! Ab consequatur facilis magni sint vel.
                        </p>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-3 rounded  text-dark p-0 text-center review">
                        <div class="card m-0 border-0">
                            <img class="card-img-top" src="../assets/images/home/review.jpg" alt="Card image cap">
                            <div class="card-body">
                                <svg height="100" width="100" class="review-img">
                                    <circle cx="50" cy="50" r="40" stroke="#3081FB" stroke-width="1" fill="white"/>
                                </svg>
                                <div class="card-text">
                                    <h3>Full Name</h3>
                                    <div>
                                        <i class="fa fa-star text-warning" v-for="n in 5" :key="n"></i>
                                    </div>
                                    Lorem Ipsum. Proin gravida nibh vel
                                    velit kolop auctor aliquet.orem Ipsum.
                                    Proin gravida nibh vel velit kolop auct
                                    or aliquet.orem Ipsum. orem Ipsum.
                                    orem Ipsum. Proin gravida nibh vel
                                    velit kolop auctor aliquet.orem Ipsum.
                                    Proin gravida nibh vel velit kolop auct
                                    or aliquet.orem Ipsum. orem Ipsum.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
    import {mapGetters, mapActions} from "vuex";
    import CategoryCompo from "./courses/CategoryCompo";

    export default {
        name: 'Home',

        components: {
            CategoryCompo,
        },
        methods: {
            ...mapActions(["fetchCategories"])
        },
        computed: {
            ...mapGetters(["allCategories", "loadingCategories"]),
        },
        created() {
            this.fetchCategories();
        }
    }
</script>

<style scoped lang="scss">
    .card:not(:first-child) {
        margin-left: 15px !important;
    }

    /* latest courses border bottom*/
    .latest_courses_border {
        border-bottom: 5px solid red;
        max-width: 6%;
        min-height: 6%;
        max-height: 6%;
        min-width: 8%;
        display: block;
    }

    .jumbotron {
        background-repeat: no-repeat;
        background-size: cover;
        padding: 15px;
    }

    .jumbotron1 {
        background-image: url('../assets/images/home/bg1.jpg');
        border-radius: 0 0 300px 0;
        border-bottom: 10px solid #0b40c6;
        background-size: cover;

        height: 60vh;
    }

    .jumbotron2 {
        /*background-image: url('../assets/images/home/bg2.jpg');*/
        background-color: transparent;
        height: 300px;
        border-radius: 0 0 0 200px;
        @media only screen and (max-width: 600px) {
            border-radius: 0;
        }
    }

    .hero {
        background-image: url('../assets/images/home/bg2.jpg');
        border-radius: 0 0 0 200px;
        background-repeat: no-repeat;
        background-size: cover;
        @media only screen and (max-width: 600px) {
            border-radius: 0;
        }
    }

    .shareBar {
        top: 200px;
        position: absolute;
        border-radius: 30px;
        @media only screen and (max-width: 600px) {
            top: 40px;
        }
    }

    .categories {
        /*margin-bottom: 250px;*/
        /*position: relative;*/
    }

    .classes {
        /*background-image: url('../assets/images/home/bg3.png');*/
        background: linear-gradient(#f8f9fa, rgba(255, 255, 255, 0.61)), url('../assets/images/home/bg3.png') no-repeat center center;
        background-size: cover;
    }


    .whyChoose {
        background: linear-gradient(rgba(19, 19, 19, 0.67), rgba(19, 19, 19, 0.67)), url('../assets/images/home/bg3.png') no-repeat center center;
    }

    .reviews {
        background: linear-gradient(rgba(19, 19, 19, 0.5), rgba(19, 19, 19, 0.7)), url('../assets/images/home/reviews.jpg') no-repeat center center;
        color: white;
        border-radius: 100px 0 0 0;
        padding: 20px
    }

    .card-icon {
        height: 50px;
        width: 50px;
        margin-top: -70px;
    }

    .carte {
        padding-top: 100px;
        clip-path: polygon(0 0, 180% 50%, 0 180%, 0 50%) !important;
        border-radius: 0 0 20px 20px;

        .carte-icon {
            margin-top: -60px;
        }
    }

    .review {
        box-shadow: -8px -8px 0px 0px rgba(48, 129, 251, 1);

        .review-img {
            margin-top: -60px;
        }
    }

</style>
