<template>
    <div class="container pt-5 border-top border-primary">
        <div class="text-center text-primary" v-if="loading">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div class="row text-center"  v-if="!loading">
            <div class="col-lg-3 col-md-4 col-sm-12 mb-4" v-for="c in allCourses" :key="c.id">
                <course :course="c"/>
            </div>
        </div>
    </div>
</template>

<script>
    import Course from "./CourseComponent";
    import {mapGetters, mapActions} from "vuex";

    export default {
        name: 'Courses',
        components: {
            Course
        },
        methods: {
            ...mapActions(["fetchCourses"])
        },
        computed: mapGetters(["allCourses", "loading"]),
        created() {
            this.fetchCourses();
        }
    }
</script>

<style scoped>

</style>
