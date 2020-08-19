<template>
    <div>
        <h3>
            Instantclass Teachers
        </h3>
        <div v-for="t in allTeachers">{{t.first_name}}</div>
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
