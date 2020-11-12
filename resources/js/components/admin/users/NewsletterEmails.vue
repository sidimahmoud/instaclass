<template>
    <div>
        <h1 class="text-center">List of subscribed users</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Email</th>
                <th scope="col">Date of subscription</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="t in emails">
                <th scope="row">{{t.id}}</th>
                <td>{{t.email.toLocaleLowerCase()}}</td>
                <td>{{t.created_at.slice(0,10)}}</td>
            </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "NewsletterEmails",
        methods:{
            ...mapActions(["fetchEmails"])
        },
        computed:{
            ...mapGetters(["emails"])
        },
        created() {
            this.fetchEmails()
        }
    }
</script>

<style scoped>

</style>
