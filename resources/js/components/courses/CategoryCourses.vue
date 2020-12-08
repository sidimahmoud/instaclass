<template>
    <div>
        <section class="hero pt-5">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-md-4"></div>
                    <div class="col-md-8 text-center pt-md-5"></div>
                </div>
            </div>
        </section>
        <div class="container pb-3">
            <div class="text-center text-primary" v-if="loading">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div v-if="!loading">
                <div class="no-course" v-if="allcategCourses.length===0">
                    <h3>
                        {{$t('noCourses')}}
                    </h3>
                </div>
                <template v-else>
                    <course  v-for="c in allcategCourses" :key="c.id" :course="c"/>
                </template>
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
        background: linear-gradient(rgba(19, 19, 19, 0.3), rgba(19, 19, 19, 0.3)), url('../../assets/images/all2.jpg') no-repeat center center;
        height: 50vh;
        background-size: cover;
        border-bottom: 15px solid #3081FB;
        color: white;
    }

    .no-course {
        padding: 50px;
        margin-bottom: 100px;
        text-align: center;
    }

    @media (max-width: 600px) {
        .hero {
            background: linear-gradient(rgba(19, 19, 19, 0.3), rgba(19, 19, 19, 0.3)), url('../../assets/images/all1.jpg') no-repeat center center;
            height: 40vh;
            background-size: cover;
            border-bottom: 15px solid #3081FB;
            color: white;
        }

        .no-course {
            padding: 5px;
            margin-bottom: 70px;
            text-align: left;
            font-size: 12px;
        }
    }
</style>
