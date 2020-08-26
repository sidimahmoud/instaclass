<template>
    <div class="text-center">
        <h3 v-for="d in allDemands"> {{v.details}}</h3>
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
