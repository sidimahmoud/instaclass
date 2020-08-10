<template>
    <div class="container pt-5 border-top border-primary">
        <div class="row text-center">
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
        computed: mapGetters(["allCourses"]),
        created() {
            this.fetchCourses();
        }
    }
</script>

<style scoped>

</style>
