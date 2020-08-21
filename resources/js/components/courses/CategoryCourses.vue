<template>
    <div class="container pt-5 border-top border-primary">
        <div class="text-center text-primary" v-if="loading">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div  v-if="!loading">
            <course :course="c" v-for="c in allcategCourses" :key="c.id"/>
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

</style>
