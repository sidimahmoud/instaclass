<template>
    <div>
        <h1 class="text-center">All platform categories</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>

            </tr>
            </thead>
            <tbody>
            <tr v-for="t in allCategories">
                <th scope="row">{{t.id}}</th>
                <td>{{t.name}}</td>
                <td>{{t.description}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'
    export default {
        name: "Categories",
        methods: {
            ...mapActions(["fetchCategories"])
        },
        computed: mapGetters(["allCategories"]),
        created() {
            this.fetchCategories();
        }
    }
</script>

<style scoped>

</style>
