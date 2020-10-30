<template>
    <div>
        <section class="hero pt-5">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-md-4"></div>
                    <div class="col-md-8 text-center pt-md-5">
                        <h1 class="font-weight-bolder text-center mt-5">
                            ALL COURSES <br>
                            WHAT WE OFFER
                        </h1></div>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="text-center text-primary" v-if="loading">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div v-if="!loading">
                <div class="text-center" v-if="allcategCourses.length===0">
                    <h3>
                        {{$t('noCourses')}}
                    </h3>
                </div>
                <course :course="c" v-for="c in allcategCourses" :key="c.id" v-else/>
            </div>
        </div>

    </div>
</template>
<script>

    import {mapGetters} from "vuex";
    import Course from "./CourseComponent";

    export default {
        name: 'CategoryCourses',
        components: {Course},
        methods: {
            fetchCourses() {
                this.$store.dispatch('getCategoryCourses', this.$route.params.id)
            },
        },
        computed: mapGetters(["allcategCourses", "loading"]),
        created() {
            this.fetchCourses();
        }
    }

</script>

<style scoped>
    .hero {
        background: linear-gradient(rgba(19, 19, 19, 0.3), rgba(19, 19, 19, 0.3)), url('../../assets/images/all1.jpg') no-repeat center center;
        height: 70vh;
        background-size: cover;
        border-bottom: 15px solid #3081FB;
        color: white;
    }

</style>
