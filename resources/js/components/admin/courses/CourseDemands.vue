<template>
    <div>
        <div>
            <form class="form-inline my-2 my-lg-0 mr-lg-2 float-right">
                <input class="form-control mr-sm-2" type="search" placeholder="Search " aria-label="Search">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        <h1 class="text-center">All demands</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Course details</th>
                <th scope="col">Course Language</th>
                <th scope="col">email</th>
                <th scope="col">Status</th>

            </tr>
            </thead>
            <tbody>
            <tr v-for="d in allDemands">
                <th scope="row">{{d.id}}</th>
                <td>{{d.details}}</td>
                <td>{{d.lang}}</td>
                <td>{{d.email}}</td>
                <td>{{d.status}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "CourseDemands",
        methods: {
            ...mapActions(["fetchDemands"])
        },
        computed: mapGetters(["allDemands"]),
        created() {
            this.fetchDemands();
        }
    }
</script>

<style scoped>

</style>
