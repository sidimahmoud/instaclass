<template>
    <div>
        <h1 class="text-center">List of teachers</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
                <th scope="col">Email</th>
                <th scope="col">Active</th>
                <th scope="col">Bio</th>
                <th scope="col">Edit</th>
                <th scope="col">Block</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="t in allTeachers">
                <th scope="row">{{t.id}}</th>
                <td>{{t.first_name}}</td>
                <td>{{t.last_name}}</td>
                <td>{{t.email.toLocaleLowerCase()}}</td>
                <td><input type="checkbox" name="" id="" checked disabled></td>
                <td>{{t.headline}}</td>
                <td>
                    <button class="btn btn-warning">
                        <i class="fa fa-edit"></i>
                    </button>
                </td>
                <td>
                    <button class="btn btn-danger">
                        &times
                    </button>
                </td>

            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'

    export default {
        name: "Teachers",
        methods: {
            ...mapActions(["fetchTeachers"])
        },
        computed: mapGetters(["allTeachers"]),
        created() {
            this.fetchTeachers();
        }
    }
</script>

<style scoped>

</style>
