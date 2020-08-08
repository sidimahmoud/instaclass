<template>
    <div>
        <div class="jumbotron">
            <div class="container d-flex align-items-center">
                <div class="row justify-content-around align-items-center">
                    <div
                        class="col-md-6 col-sm-12 text-center text-md-left justify-content-center align-items-center text-white">
                        <h1 class="display-4">The Plateform</h1>
                        <h4 class="h3">Of Learning and Sharing</h4>
                        <h4 class="h3">Of knowledge on <span class="text-danger">Live</span></h4>
                        <div class="mt-4">
                            <button class="btn btn-danger text-capitalize text-white">Get Started</button>
                            <button class="btn btn-outline-danger ml-4">
                                <span class="text-capitalize text-white">
                                    watch <i class="fa fa-play-circle ml-3"></i>
                                </span>
                            </button>
                        </div>

                    </div>

                    <div class="col-md-6 col-sm-12 text-center text-md-leftalign-items-center">
                        <img src="../assets/images/home/home.png" class="img-fluid" alt="logo">
                    </div>
                </div>
            </div>
        </div>

        <div class="container d-flex flex-column justify-content-center align-items-center mt-5 mb-5">
            <h3 class="text-primary">Latest Courses </h3>
            <span class="latest_courses_border">

    </span>
        </div>


        <div class="container">
<!--            <div class="d-flex justify-content-center mb-4">-->
<!--                <course v-for="course in allCourses" :key="course.id" :course="course" />-->
<!--            </div>-->
            <div class="row text-center">
                <div class="col-lg-3 col-md-4 col-sm-12 mb-4" v-for="course in allCourses" :key="course.id">
                    <course :course="course"/>
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
            ...mapActions(["fetchCourses"])
        },
        computed: mapGetters(["allCourses"]),
        created() {
            this.fetchCourses();
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
