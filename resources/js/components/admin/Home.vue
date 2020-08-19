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
                                <div class="h5 mb-0 font-weight-bold ">
                                    {{counts.categories}}
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
                                <div class="h5 mb-0 font-weight-bold ">
                                    {{counts.courses}}

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
                                <div class="h5 mb-0 font-weight-bold ">
                                    {{counts.teachers}}

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
                                <div class="h5 mb-0 font-weight-bold ">
                                    {{counts.students}}

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
    import axios from "axios";

    export default {
        name: "Home",
        data(){
            return {
                counts: '',
            }
        },
        created() {
            let token = localStorage.getItem('token') || '';
            if (token) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
            }
            axios.get('https://instantclass.herokuapp.com/api/counts').then(res => this.counts = res.data).catch(err => console.log(err))
        }
    }
</script>


<style scoped>

</style>
