<template>
    <div id="dashbordItems">
        <!-- Content Row -->
        <div class="row">
            <!-- All courses -->
            <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Categories
                                </div>
                                <big-sppiner v-if="fetchingUsers" />
                                <div class="h5 mb-0 font-weight-bold ">
                                    {{allCounts.categories}}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-archive fa-2x text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Courses
                                </div>
                                <big-sppiner v-if="fetchingUsers" />
                                <div class="h5 mb-0 font-weight-bold ">
                                    {{allCounts.courses}}

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-book fa-2x text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Teachers
                                </div>
                                <big-sppiner v-if="fetchingUsers" />
                                <div class="h5 mb-0 font-weight-bold ">
                                    {{allCounts.teachers}}

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-user-plus fa-2x text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Students
                                </div>
                                <big-sppiner v-if="fetchingUsers" />
                                <div class="h5 mb-0 font-weight-bold ">
                                    {{allCounts.students}}

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-user fa-2x text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import BigSppiner from "../spinners/BigSppiner";
    import {mapGetters} from 'vuex'
    export default {
        name: "Home",
        components:{BigSppiner},
        computed: mapGetters(["allCounts", "fetchingUsers"]),
        created() {
            this.$store.dispatch("loadCounts")
        }
    }
</script>

<style scoped>

</style>
