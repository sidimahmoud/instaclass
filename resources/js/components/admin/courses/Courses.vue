<template>
    <div>
        <div>
            <form class="form-inline my-2 my-lg-0 mr-lg-2 float-right">
                <input class="form-control mr-sm-2" type="search" placeholder="Search " aria-label="Search">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        <h1 class="text-center">All platform courses</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Language</th>

            </tr>
            </thead>
            <tbody>
            <tr v-for="t in allCourses">
                <th scope="row">{{t.id}}</th>
                <td>{{t.name}}</td>
                <td>{{t.language}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'
    export default {
        name: "Courses",
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
