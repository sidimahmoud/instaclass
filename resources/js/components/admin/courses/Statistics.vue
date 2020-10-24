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
<!--            <tbody>-->
<!--            <tr v-for="categ in allStatistics" :key="categ.id">-->
<!--                <td rowspan="3">{{categ.name_en}}</td>-->
<!--                <td v-for="sub in categ.sub_categories">{{sub.name_en}}</td>-->
<!--            </tr>-->
<!--            </tbody>-->
        </table>

        <div class="row border mb-1 rounded py-1" v-for="categ in allStatistics" :key="categ.id">
            <div class="col-md-2">
                {{categ.name_en}}
            </div>
            <div class="col-md-10">
                <div class="row border mb-1 rounded" v-for="sub in categ.sub_categories">
                    <div class="col-md-4">{{sub.name_en}}</div>
                    <div class="col-md-8">
                        <div class="row " v-for="c in sub.courses">
                            <div class="col-8">{{c.name}}</div>
                            <div class="col-4">{{c.enrollments.length}}</div>
                        </div>
                    </div>

                </div>

            </div>
        </div>


    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "Statistics",
        methods: {
            ...mapActions(["fetchStatistics"])
        },
        computed: mapGetters(["allStatistics"]),
        created() {
            this.fetchStatistics()
        }
    }
</script>

<style scoped>

</style>
