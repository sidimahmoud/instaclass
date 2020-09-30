<template>
    <div>
        <div class="jumbotron">
            <div class="container  align-items-center">
                <div class="row justify-content-around align-items-center">
                    <div
                        class="col-md-6 col-sm-12 text-center text-md-left px-md-5 justify-content-center align-items-center text-white">
                        <h1 class="display-4">
                            {{$t('title')}}

                        </h1>

                    </div>

                    <div class="col-md-6 d-none d-md-block">
                        <img src="../assets/images/home/home.png" width="450px" class=" float-right"
                             alt="logo">
                    </div>
                </div>
            </div>
        </div>
        <div class=" text-right pr-5">
            <iframe
                src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&layout=button_count&size=large&appId=223985172274465&width=130&height=28"
                width="130" height="28" style="border:none;overflow:hidden; min-width: 130px" scrolling="no" frameborder="0"
                allowTransparency="true" allow="encrypted-media"></iframe>
            <br>
            <!--            <a href="https://www.facebook.com/sharer/sharer.php?s=100&p[url]=https://www.instantclass.herokuapp.com/courses&p[images][0]=&p[title]=Title%20Goes%20Here&p[summary]=Description%20goes%20here!"> <img src="../assets/images/fb.png" alt="fb" width="150px"></a> <br>-->
            <a href="https://www.instagram.com/canada/?hl=en" target="_blank"> <img src="../assets/images/insta.png" alt="insta" class="rounded" width="130px"></a>
        </div>
        <div class="container d-flex flex-column justify-content-center align-items-center mt-5 mb-5">
            <h3 class="text-primary">
                {{$t('coursesByCateg')}}
            </h3>
            <span class="latest_courses_border"> </span>
        </div>
        <div class="container">
            <div class="text-center text-primary" v-if="loadingCategories">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            <div class="row  align-items-center" v-if="!loadingCategories">
                <div class="col-md-3 col-sm-12 p-2 text-center" v-for="categ in allCategories" :key="categ.id">
                    <div class="card">
                        <router-link :to="{ name: 'CategCourses', params: { id: categ.id}}" tag="a">
                            <img class="card-img-top"
                                 :src="categ.image"
                                 alt="Card image cap">
                        </router-link>
                        <div class="card-body text-center">
                            <h5 class="card-title  font-weight-bolder">{{(lang==="en")? categ.name_en: categ.name_fr}}</h5>
<!--                            <p class="card-text">-->
<!--                            </p>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Course from "./courses/CourseComponent";
    import {mapGetters, mapActions} from "vuex";
    import i18n from "../src/i18n";

    export default {
        name: 'Home',

        components: {
            Course
        },
        methods: {
            ...mapActions(["fetchCategories"])
        },
        computed: {
            ...mapGetters(["allCategories", "loadingCategories", "lang"]),
        },
        created() {
            this.fetchCategories();
        }
    }
</script>

<style scoped>
    /* card margin*/

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
        background-image: url('../assets/images/home/bg.png');
        border-radius: 0;
        padding: 15px;
    }

</style>
