<template>
    <div>
        <div>
            <div>
                <form class="form-inline my-2 my-lg-0 mr-lg-2 float-right">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search " aria-label="Search">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
            <h1 class="text-center">All sent payments</h1>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Teacher ID</th>
                    <th scope="col">Teacher name</th>
                    <th scope="col">Teacher email</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Method</th>
                    <th scope="col">Course ID</th>
                    <th scope="col">Course name</th>
                    <th scope="col">Date</th>

                </tr>
                </thead>
                <tbody>
                <tr v-for="t in allSent">
                    <th scope="row">{{t.id}}</th>
                    <td>{{user_id}}</td>
                    <td>Course name</td>
                    <td>Teacher email</td>
                    <td>{{t.amount}}</td>
                    <td>{{t.method}}</td>
                    <td>{{t.course_id}}</td>
                    <td>{{t.object}}</td>
                    <td>{{t.created_at}}</td>


                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'

    export default {
        name: "Sent",
        methods: {
            ...mapActions(["fetchSent"])
        },
        computed: mapGetters(["allSent", "fetchingUsers"]),
        created() {
            this.fetchSent();
        }
    }
</script>

<style scoped>

</style>
