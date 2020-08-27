<template>
    <div>

        <h1 class="text-center">List of payments</h1>
        <div class="text-center mt-4" v-if="allTeacherPayments.length===0">
            No payments
        </div>
        <table class="table" v-else>
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Enrollment ID</th>
                <th scope="col">Student ID</th>
                <th scope="col">Amount</th>
                <th scope="col">Method</th>
                <th scope="col">Course</th>

            </tr>
            </thead>
            <tbody>
            <tr v-for="t in allTeacherPayments">
                <th scope="row">{{t.id}}</th>
                <td>{{t.enrollment_id}}</td>
                <td>{{t.user_id}}</td>
                <td>{{t.amount}}</td>
                <td>{{t.method}}</td>
                <td>{{t.object}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "Payments",
        methods: {
            ...mapActions(["fetchTeacherPayments"]),
        },
        computed: mapGetters(["allTeacherPayments"]),
        created() {
            this.fetchTeacherPayments();
        }
    }
</script>

<style scoped>

</style>
