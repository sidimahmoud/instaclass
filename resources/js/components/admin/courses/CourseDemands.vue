<template>
    <h1>Demands</h1>
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
