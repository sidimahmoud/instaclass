<template>
    <big-sppiner v-if="fetchingUsers"/>
    <div v-else>
        <h1 class="text-center">List of admins</h1>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
                <th scope="col">Email</th>
                <th scope="col">Active</th>
                <th scope="col">Bio</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="t in allAdmins">
                <th scope="row">{{t.id}}</th>
                <td>{{t.first_name}}</td>
                <td>{{t.last_name}}</td>
                <td>{{t.email.toLocaleLowerCase()}}</td>
                <td><input type="checkbox" name="" id="" checked disabled></td>
                <td>{{t.headline}}</td>

            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'
    import BigSppiner from "../../spinners/BigSppiner";

    export default {
        name: "Teachers",
        components: {BigSppiner},
        methods: {
            ...mapActions(["fetchAdmins"]),
            banish(id) {
                this.$store.dispatch("banish", id).then(() => {
                    alert("Banned successfully")
                })
            }
        },
        computed: mapGetters(["allAdmins", "fetchingUsers"]),
        created() {
            this.fetchAdmins();
        }
    }
</script>

<style scoped>

</style>
