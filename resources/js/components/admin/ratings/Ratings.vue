<template>
    <div >
        <h1 class="text-center">All Ratings</h1>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Teacher name</th>
                <th scope="col">Student name</th>
                <th scope="col">Comment</th>
                <th scope="col">Stars Number</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="t in allRatings">
                <th scope="row">{{t.id}}</th>
                <td>{{t.teacher.first_name}} {{t.teacher.last_name}}</td>
                <td>{{t.user.first_name}} {{t.user.last_name}}</td>
                <td>{{t.review}}</td>
                <td>{{t.rate}}</td>
                <td>{{t.created_at.slice(0,10)}}</td>

            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'

    export default {
        name: "Ratings",
        methods: {
            ...mapActions(["fetchRatings"]),
        },
        computed: mapGetters(["allRatings"]),
        created() {
            this.fetchRatings();
        }
    }
</script>

<style scoped>

</style>
