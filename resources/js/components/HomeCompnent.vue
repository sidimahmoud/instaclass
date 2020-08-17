<template>
    <div>
        <div class="jumbotron">
            <div class="container  align-items-center">
                <div class="row justify-content-around align-items-center">
                    <div class="col-md-6 col-sm-12 text-center text-md-left justify-content-center align-items-center text-white">
                        <h1 class="display-3">The perfect Platform</h1>
                        <h4 class="h3 ">For Online  <span class="text-danger">Courses</span></h4>
                        <div class="mt-4">
                            <button class="btn btn-danger text-capitalize text-white">Get Started</button>
                            <button class="btn btn-outline-danger ml-4">
                                <span class="text-capitalize text-white">
                                    watch <i class="fa fa-play-circle ml-3"></i>
                                </span>
                            </button>
                        </div>

                    </div>

                    <div class="col-md-6 d-none d-md-block">
                        <img src="../assets/images/home/home.png" width="450px" class=" float-right"
                             alt="logo">
                    </div>
                </div>
            </div>
        </div>

        <div class="container d-flex flex-column justify-content-center align-items-center mt-5 mb-5">
            <h3 class="text-primary">All categories </h3>
            <span class="latest_courses_border">

    </span>
        </div>


        <div class="container">
            <div class="text-center text-primary" v-if="loadingCategories">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="row justify-content-center align-items-center" v-if="!loadingCategories">
                <div class="col-md-3 col-sm-12 p-2 text-center" v-for="categ in allCategories" :key="categ.id">
                    <div class="card" >
                        <a href="#">
                            <img class="card-img-top" :src="'https://instantclass.herokuapp.com/uploads/categories/'+categ.image" alt="Card image cap">

                        </a>
                        <div class="card-body text-center">
                            <h5 class="card-title  font-weight-bolder">{{categ.name}}</h5>
                            <p class="card-text">{{categ.description}}</p>
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

    export default {
        name: 'Home',
        components: {
            Course
        },
        methods: {
            ...mapActions(["fetchCategories"])
        },
        computed: mapGetters(["allCategories", "loadingCategories"]),
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
    }

</style>
