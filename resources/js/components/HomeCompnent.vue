<template>
    <div>
        <div class="hero">
            <div class="jumbotron jumbotron1 mb-0">
            <span class="bg-primary px-1 py-3  shareBar">
                <button class="btn btn-light btn-sm">
                    <i class="fa fa-facebook text-primary"></i>
                </button>
                <br>
                <br>
                    <button class="btn btn-light btn-sm">
                    <i class="fa fa-instagram text-primary"></i>
                </button>


            </span>
                <div class="container  align-items-center mt-5 h-100">
                    <div class="row justify-content-around align-items-center h-100">
                        <div class="col-md-6"></div>
                        <div
                            class="col-md-6 col-sm-12 text-center px-md-5 justify-content-center align-items-center ">
                            <h1 class="display-4">
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
            <span class="bg-primary px-1 py-3  shareBar">
                <button class="btn btn-light">
                    <i class="fa fa-facebook  text-primary"></i>
                </button>
                <br>
                <br>
                    <button class="btn btn-light">
                    <i class="fa fa-instagram text-primary"></i>
                </button>


            </span>
                <div class="container  align-items-center mt-5">
                    <div class="row justify-content-around align-items-center">
                        <div
                            class="col-md-6 col-sm-12 text-center  justify-content-center align-items-center text-white">
                            <h1 class="display-4">
                                {{$t('title2')}}
                            </h1>
                            <!--<img src="../assets/images/home/onlineEd.jpg" width="350px">-->
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <img src="../assets/images/home/onlineEd.jpg" width="500px" class="img-fluid rounded">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class=" text-right pr-5">
            <iframe
                src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&layout=button_count&size=large&appId=223985172274465&width=130&height=28"
                width="130" height="28" style="border:none;overflow:hidden; min-width: 130px" scrolling="no"
                frameborder="0"
                allowTransparency="true" allow="encrypted-media"></iframe>
            <br>
            <!--            <a href="https://www.facebook.com/sharer/sharer.php?s=100&p[url]=https://www.instantclass.herokuapp.com/courses&p[images][0]=&p[title]=Title%20Goes%20Here&p[summary]=Description%20goes%20here!"> <img src="../assets/images/fb.png" alt="fb" width="150px"></a> <br>-->
            <a href="https://www.instagram.com/canada/?hl=en" target="_blank"> <img src="../assets/images/insta.png"
                                                                                    alt="insta" class="rounded"
                                                                                    width="130px"></a>
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

                <div class="row  categories" v-if="!loadingCategories">
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
                    <div class="col-md-3 rounded bg-white text-dark p-0 text-center review">
                        <div class="card m-0">
                            <img class="card-img-top" src="../assets/images/home/review.jpg" alt="Card image cap">
                            <div class="card-body">

                                <p class="card-text">
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
                                </p>
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

<style scoped>
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
        background-image: url('../assets/images/home/heroHome.png');
        border-radius: 0 0 300px 0;
        border-bottom: 10px solid #0b40c6;
        background-size: cover;

        height: 70vh;
    }

    .jumbotron2 {
        /*background-image: url('../assets/images/home/bg2.jpg');*/
        background-color: transparent;
        border-radius: 0 0 0 200px;
        height: 500px;
    }

    .hero {
        background-image: url('../assets/images/home/bg2.jpg');
        border-radius: 0 0 0 200px;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .shareBar {
        top: 200px;
        position: absolute;
        border-radius: 30px;
    }

    .categories {
        margin-bottom: 250px;
        /*position: relative;*/
    }

    .classes {
        /*background-image: url('../assets/images/home/bg3.png');*/
        background: linear-gradient(#f8f9fa, rgba(255, 255, 255, 0.61)), url('../assets/images/home/bg3.png') no-repeat center center;
        background-size: cover;
        height: 600px;
        margin-bottom: 100px !important;
        padding-bottom: 50px !important;
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
        border-radius: 0 0 20px 20px

    }

    .review {
        box-shadow: -8px -8px 0px 0px rgba(48, 129, 251, 1);
    }

</style>
