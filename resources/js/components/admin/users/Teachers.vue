<template>
    <big-sppiner v-if="fetchingUsers" />
    <div v-else>
        <div>
            <form class="form-inline my-2 my-lg-0 mr-lg-2 float-right">
                <input class="form-control mr-sm-2" type="search" placeholder="Search " aria-label="Search">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        <h1 class="text-center">List of teachers</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
                <th scope="col">Email</th>
                <th scope="col">Date of account creation</th>
                <th scope="col">Active</th>
                <th scope="col">Date of subscription</th>
                <th scope="col">Banish</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="t in allTeachers">
                <th scope="row">{{t.id}}</th>
                <td>{{t.first_name}}</td>
                <td>{{t.last_name}}</td>
                <td>{{t.email.toLocaleLowerCase()}}</td>
                <td>{{t.created_at.slice(0,10)}}</td>
                <td><input type="checkbox" name="" id="" checked disabled></td>
                <td>{{t.created_at}}</td>
                <td>
                    <button class="btn btn-success" @click="banish(t.id)">
                        X
                    </button>
                </td>

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
            ...mapActions(["fetchTeachers"]),
            banish(id) {
                this.$store.dispatch("banish", id).then(() => {
                    alert("Banned successfully")
                })
            }
        },
        computed: mapGetters(["allTeachers", "fetchingUsers"]),
        created() {
            this.fetchTeachers();
        }
    }
</script>

<style scoped>

</style>
