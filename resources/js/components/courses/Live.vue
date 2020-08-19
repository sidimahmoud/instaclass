<template>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="text-center py-5">
                    Course start 3:00 PM GMT, <a
                    href="https://us04web.zoom.us/j/76384885110?pwd=WUpEMlVwU3ZUc0hTcnM4Sm1vejBWdz09">
                    Link
                </a>
                </div>
                <div class="row mt-1">
                    <div class="col-12">



                    </div>
                </div>
            </div>

        </div>
    </div>

</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "CoursePlayer",
        methods: {
            findCourse() {
                this.$store.dispatch('getCourse', this.$route.params.slug)
            },
        },
        computed: mapGetters(["course"]),
        created() {
            this.findCourse();
        }
    }
</script>

<style scoped>

</style>
