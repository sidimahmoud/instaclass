<template>
    <div>
        <h1 class="text-center">Courses statistics</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Category</th>
                <th scope="col">Sub category associated</th>
                <th scope="col">Number of courses</th>
                <th scope="col">Subscribed students</th>

            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">Cat</th>
                <td>subCat</td>
                <td>217</td>
                <td>3054</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "Statistics",
        methods:{
            ...mapActions(["fetchStatistics"])
        },
        computed:mapGetters(["allStatistics"]),
        created() {
            this.fetchStatistics()
        }
    }
</script>

<style scoped>

</style>
