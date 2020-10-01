<template>
    <div>
        <h1 class="text-center">All Messages</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">email</th>
                <th scope="col">Message</th>
                <th scope="col">Date</th>

            </tr>
            </thead>
            <tbody>
            <tr v-for="d in allContacts">
                <th scope="row">{{d.id}}</th>
                <td>{{d.name}}</td>
                <td>{{d.email}}</td>
                <td>{{d.message}}</td>
                <td>{{d.created_at}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "Messages",
        methods: {
            ...mapActions(["fetchContacts"])
        },
        computed: mapGetters(["allContacts"]),
        created() {
            this.fetchContacts();
        }
    }
</script>

<style scoped>

</style>
