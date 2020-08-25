<template>
    <div class="container pt-5 border-top border-primary">
        <div class="text-center text-primary" v-if="loading">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div  v-if="!loading">
                <course :course="c" v-for="c in allCourses" :key="c.id"/>
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
            search(){
                this.$store.dispatch('search', this.$route.params.q)
            }
        },
        computed: mapGetters(["allCourses", "loading"]),
        created() {
            this.search();
        }
    }
</script>

<style scoped>

</style>
