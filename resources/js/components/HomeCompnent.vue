<template>
    <div class="bg-light">
        <div class="hero">
            <span class="shareBar">
                <span>{{$t('share_on')}}</span><br/>
                <div class="share-facebook" @click="handleShareFacebook">
                    <a  target="_blank"
                        :href="$t('share_body.facebook')"
                    >
                        <!-- <el-button type="primary" plain small>   --><i class="fa fa-facebook fa-2x"></i><!-- </el-button> -->
                        <!--<img src="../assets/images/fbShare.png" width="120px" height="40px" alt="">-->
                    </a>
                </div>
                
                <div class="share-twitter" @click="handleShareTwitter">
                    <a 
                        target="_blank"
                        :href="$t('share_body.twitter')"
                    >

                        <!-- <el-button type="primary" plain small> --><i class="fa fa-twitter fa-2x"></i><!-- </el-button> -->

                    </a> <br/>
                </div>
                <div class="share-email" @click="handleShareEmail">
                    <a target="_blank"
                       :href="$t('share_body.email')"
                    >
                        <!-- <el-button type="primary" plain small>   --><i class="fa fa-envelope fa-2x"></i><!-- </el-button> -->
                    </a> <br/>
                </div>

            </span>
            <div class="jumbotron jumbotron1 mb-0">
                <div class="text-home-slogan">
                    <h4>{{$t('title.1')}}</h4>
                    <p>{{$t('title.2')}}</p>
                </div>
                <div class="container  align-items-center mt-md-2 h-100">
                    <div class="row justify-content-around align-items-center h-100">
                        <div class="col-md-2 d-none d-md-block"></div>
                        
                        <!--                    <div class="col-md-6 d-none d-md-block">-->
                        <!--                        <img src="../assets/images/home/home.png" width="450px" class=" float-right"-->
                        <!--                             alt="logo">-->
                        <!--                    </div>-->
                    </div>
                </div>
            </div>
            <div class="mb-0 p-5">
                <div>
                    <div class="row">
                        <div class="col-md-6 text-white">
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
                                <li>{{$t('title2.students.4')}}</li>
                            </ul>
                        </div>
                        <div class="col-md-6 text-white">
                            <my-video :sources="video.sources" :options="video.options"></my-video>
                        </div>
                    </div>
                </div>
            </div>
            <!--  <div class="jumbotron jumbotron2">

                 <div class="container  align-items-center mt-2">
                     <div class="row justify-content-around align-items-center">
                         <div
                             class="col-md-7 col-sm-12 justify-content-center align-items-center text-white">
                             <h3>
                                 {{$t('title2.teachers.title')}}:
                             </h3>
                             <ul>
                                 <li>{{$t('title2.teachers.1')}}</li>
                                 <li>{{$t('title2.teachers.2')}}</li>
                                 <li>{{$t('title2.teachers.3')}}</li>
                             </ul>
                         </div>
                         <div class="col-md-5 col-sm-12 justify-content-center align-items-center d-none d-md-block text-white">
                             <h3>
                                 {{$t('title2.students.title')}}:
                             </h3>
                             <ul>
                                 <li>{{$t('title2.students.1')}}</li>
                                 <li>{{$t('title2.students.2')}}</li>
                                 <li>{{$t('title2.students.3')}}</li>
                             </ul>
                         </div>
                     </div>
                 </div>
             </div> -->
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
            <div class="container pt-5">
                <h3 class="text-center text-white"> {{$t('whyChoose.title')}}
                </h3>
                <div class="row p-3">
                    <div class="col-md-3 d-flex align-items-stretch">
                        <div class="shadow-sm carte m-3 text-center " style="background: #6098C9;">
                            <p>
                                {{$t('whyChoose.1')}}
                            </p>
                            <p class="text-white ">
                                <i class="fa fa-thumbs-up fa-5x"></i>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-stretch">
                        <div class="shadow-sm carte   m-3 text-center " style="background: #53C4B4;">
                            <p>
                                {{$t('whyChoose.2')}}
                            </p>
                            <p class="text-white " style="bottom: 0">
                                <i class="fa fa-thumbs-up fa-5x"></i>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-stretch">
                        <div class="shadow-sm carte  m-3  text-center " style="background: #B9A253;">
                            <p>
                                {{$t('whyChoose.3')}}
                            </p>
                            <p class="text-white ">
                                <i class="fa fa-thumbs-up fa-5x"></i>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-stretch">
                        <div class="shadow-sm carte  m-3  text-center " style="background: #DC7280;">
                            <p>
                                {{$t('whyChoose.4')}}
                            </p>
                            <p class="text-white ">
                                <i class="fa fa-thumbs-up fa-5x"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="reviews mt-5 mb-0 p-4">
            <div class="container">
                <h2 class="text-center mb-5"> {{$t('howItWorks.title')}}</h2>
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3>{{$t('howItWorks.teachers.title')}}:</h3>
                        <ul style="list-style-type: none;">
                            <li>{{$t('howItWorks.teachers.1')}}</li>
                            <li>{{$t('howItWorks.teachers.2')}}</li>
                            <li>{{$t('howItWorks.teachers.3')}}</li>
                            <li>{{$t('howItWorks.teachers.4')}}</li>
                            <li>{{$t('howItWorks.teachers.5')}}</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h3>{{$t('howItWorks.students.title')}}:</h3>
                        <ul style="list-style-type: none;">
                            <li>{{$t('howItWorks.students.1')}}</li>
                            <li>{{$t('howItWorks.students.2')}}</li>
                            <li>{{$t('howItWorks.students.3')}}</li>
                            <li>{{$t('howItWorks.students.4')}}</li>
                            <li>{{$t('howItWorks.students.5')}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
    import {mapGetters, mapActions} from "vuex";
    import CategoryCompo from "./courses/CategoryCompo";
    import MailBox from "./MailBox";
    import myVideo from 'vue-video'

    export default {
        name: 'Home',

        components: {
            CategoryCompo,
            MailBox,
            myVideo
        },
        data() {
            return {
                video: {
                    sources: [{
                        src: 'https://firebasestorage.googleapis.com/v0/b/instaclass-9f27f.appspot.com/o/instaclass%2FInstantaclasse%20Video%20promo%20Francais.mp4?alt=media&token=a30759f0-a10c-4185-9ae0-3a72b0d07126',
                        type: 'video/mp4'
                    }],
                    options: {
                        autoplay: false,
                        volume: 0.6,
                        poster: 'https://firebasestorage.googleapis.com/v0/b/instaclass-9f27f.appspot.com/o/instaclass%2Fonline.jpg?alt=media&token=5f31b6be-063f-456e-842e-2e14aa855142'
                    }
                }
            }
        },
        methods: {
            ...mapActions(["fetchCategories"]),
            handleShareFacebook () {
                window.open(this.$t('share_body.facebook'))
            },
            handleShareTwitter () {
                window.open(this.$t('share_body.twitter'))
            },
            handleShareEmail () {
                window.open(this.$t('share_body.email'))
            },
        },
        computed: {
            ...mapGetters(["allCategories", "loadingCategories"]),
        },
        mounted() {
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
        /*border-radius: 0 0 300px 0;*/
        border-bottom: 10px solid #0b40c6;
        background-size: cover;
        height: 70vh;
        font-family: 'Poppins', sans-serif;

        h2 {
            line-height: 2 !important;
        }

        @media only screen and (max-width: 720px) {
            border-radius: 0 0 100px 0 !important;

            h2 {
                line-height: normal !important;
                font-size: medium !important;
            }
        }

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
        border-radius: 0 0 0 0px;
        background-repeat: no-repeat;
        background-size: cover;
        @media only screen and (max-width: 600px) {
            border-radius: 0;
        }
    }

    .categories {
        /*margin-bottom: 250px;*/
        /*position: relative;*/
    }

    .el-button--primary.is-plain {
        color: #409EFF;
        background: transparent !important;
        border: none !important;
    }
    .el-button--primary.is-plain:hover {
        color: #409EFF !important;
    }

    .classes {
        /*background-image: url('../assets/images/home/bg3.png');*/
        background: linear-gradient(#f8f9fa, rgba(255, 255, 255, 0.61)), url('../assets/images/home/bg3.png') no-repeat center center;
        background-size: cover;
    }

    .whyChoose {
        background: linear-gradient(rgba(19, 19, 19, 0.67), rgba(19, 19, 19, 0.67)), url('../assets/images/home/why.jpg') no-repeat center center;
        background-size: cover;
    }

    .reviews {
        background: linear-gradient(rgba(19, 19, 19, 0.7), rgba(19, 19, 19, 0.7)), url('../assets/images/home/how1.jpg') no-repeat center center;
        background-size: cover;
        color: white;
        padding: 20px;

        li:not(:last-child) {
            margin-bottom: 10px;
        }
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

    .button-mobile {
        display: none;
    }

    .button-web {
        display: block;
    }

    @media (max-width: 500px) {
        .text-header {
            display: none;
        }

        .button-mobile {
            display: block;
            color: #fff;
            background-color: blue;
            width: 65px;
            height: 25px;
            text-align: center;
            border-radius: 5px;
        }
        .button-web {
            display: none;
        }

        .jumbotron1 {
            background-image: url('../assets/images/home/bg1.jpg');
            /*border-radius: 0 0 300px 0;*/
            border-bottom: 10px solid #0b40c6;
            background-size: cover;
            height: 45vh;
            font-family: 'Poppins', sans-serif;
            h2 {
                line-height: 2 !important;
            }
        }

    }

    .shareBar {
        background-color: #fff;
        top: 200px;
        height: 120px;
        position: absolute;
        border-radius: 5px;
        width: auto;
        
        span {
            padding: 3px;
        }

        @media only screen and (max-width: 600px) {
            top: 70px;
            width: 60px;
        }
    }

    .share {
        &-facebook {
            text-align: center;
            padding: 10px;
            width: 100%;
            color:#fff;
            background-color: #3b5998;
            a {
                color:#fff;
                width: 100%;
            }
        }
        &-twitter {
            text-align: center;
            color: #fff;
            padding: 10px;
            width: 100%;
            background-color: #00aced;
            a {
                color:#fff;
                width: 100%;
            }
        }
        &-email {
            text-align: center;
            color: #fff;
            padding: 10px;
            width: 100%;
            background-color: #aaaaaa;
            a {
                color:#fff;
                width: 100%;
            }
        }
    }

    .text-home-slogan {
        display: none;
    }

    @media only screen and (min-width: 600px) {
        .text-home-slogan {
            display: block;
            float: right;
            margin-top: 130px;
            margin-left: 30px;
        }
    }
</style>
