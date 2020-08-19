<template>
    <div>
        <h1 class="text-center">All received payments</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">User ID</th>
                <th scope="col">Amount</th>
                <th scope="col">Method</th>
                <th scope="col">Course ID</th>
                <th scope="col">Course name</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="t in allReceived">
                <th scope="row">{{t.id}}</th>
                <td>{{t.user_id}}</td>
                <td>{{t.amount}}</td>
                <td>{{t.method}}</td>
                <td>{{t.course_id}}</td>
                <td>Course name</td>
                <td>{{t.created_at}}</td>



            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'
    export default {
        name: "Received",
        methods: {
            ...mapActions(["fetchReceived"])
        },
        computed: mapGetters(["allReceived"]),
        created() {
            this.fetchReceived();
        }
    }
</script>

<style scoped>

</style>
