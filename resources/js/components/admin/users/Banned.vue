<template>
    <big-sppiner v-if="fetchingUsers" />
    <div v-else>
        <div>
            <form class="form-inline my-2 my-lg-0 mr-lg-2 float-right">
                <input class="form-control mr-sm-2" type="search" placeholder="Search " aria-label="Search">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        <h1 class="text-center">Banned users</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
                <th scope="col">Email</th>
                <th scope="col">Active</th>
                <th scope="col">Bio</th>
                <th scope="col">Unblock</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="t in allBanned">
                <th scope="row">{{t.id}}</th>
                <td>{{t.first_name}}</td>
                <td>{{t.last_name}}</td>
                <td>{{t.email.toLocaleLowerCase()}}</td>
                <td><input type="checkbox" name="" id="" disabled></td>
                <td>{{t.headline}}</td>

                <td>
                    <button class="btn btn-danger">
                        <i class="fa fa-check text-primary"></i>
                    </button>
                </td>

            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";
    import BigSppiner from "../../spinners/BigSppiner";

    export default {
        name: "Banned",
        components: {BigSppiner},
        methods: {
            ...mapActions(["fetchBanned"])
        },
        computed: mapGetters(["allBanned", "fetchingUsers"]),

        created() {
            this.fetchBanned();
        }
    }
</script>

<style scoped>

</style>
