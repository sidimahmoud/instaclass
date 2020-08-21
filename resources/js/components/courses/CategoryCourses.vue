<template>
    <div class="border-top border-primary pt-5">
        <div class="text-center text-primary" v-if="loading">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div  v-if="!loading">
            <course  v-for="c in allcategCourses" :key="c.id" :course="c"/>
        </div>
    </div>
</template>
<script>

    import {mapGetters} from "vuex";
    import course from "./CourseComponent";

    export default {
        name: 'CategoryCourses',
        components:{course},
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
