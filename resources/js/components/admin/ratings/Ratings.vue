<template>
    <div >
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
<!--            <tr v-for="t in allAdmins">-->
<!--                <th scope="row">{{t.id}}</th>-->
<!--                <td>{{t.first_name}}</td>-->
<!--                <td>{{t.last_name}}</td>-->
<!--                <td>{{t.email.toLocaleLowerCase()}}</td>-->
<!--                <td><input type="checkbox" name="" id="" checked disabled></td>-->
<!--                <td>{{t.headline}}</td>-->

<!--            </tr>-->
            </tbody>
        </table>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'

    export default {
        name: "Ratings",
        methods: {
            ...mapActions(["fetchRatings"]),
        },
        computed: mapGetters(["AllRatings"]),
        created() {
            this.fetchRatings();
        }
    }
</script>

<style scoped>

</style>
