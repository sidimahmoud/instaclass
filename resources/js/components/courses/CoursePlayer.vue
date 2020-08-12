<template>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-9 col-sm-12">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0"
                            allowfullscreen></iframe>
                </div>
                <div class="row mt-1">
                    <div class="col-md-12">
                        <nav class="nav nav-pills nav-fill">
                            <a class="nav-item nav-link active" href="#overview" data-toggle="tab">Overview</a>
                            <a class="nav-item nav-link" href="#FAQ" data-toggle="tab">FAQ</a>
                        </nav>
                        <hr>
                        <div class="tab-content my-5">
                            <div class="tab-pane fade show active" id="overview">
                                <div class="container">
                                    <h3 class="font-weight-bolder">{{course.name}}</h3>
                                    <p>
                                        {{course.description}}
                                    </p>
                                    <div>
                        <span>
                            <span class="h5 mr-5 font-weight-bold">{{course.enrollments.length}} Total Students</span>
                        </span>
                                        <span>
                                 4.7
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        ({{course.ratings.length}} Rating)
                        </span>
                                    </div>
                                    <div>
                                        <p class="h5 mt-5 font-weight-bold">What you’ll learn?</p>
                                        <ul>
                                            <li>Phasellus enim magna, varius et commodo ut.</li>
                                            <li>Sed consequat justo non mauris pretium at tempor justo.</li>
                                            <li>Ut nulla tellus, eleifend euismod pellentesque vel, sagittis vel
                                                justo.
                                            </li>
                                            <li>Phasellus enim magna, varius et commodo ut.</li>
                                            <li>Sed consequat justo non mauris pretium at tempor justo.</li>
                                            <li>Nulla tellus, eleifend euismod pellentesque vel, sagittis vel justo.
                                            </li>
                                        </ul>
                                    </div>
                                    <div>
                                        <p class="h5 mt-5 font-weight-bold">Requirements</p>
                                        <ul>
                                            <li>Phasellus enim magna, varius et commodo ut.</li>
                                            <li>Sed consequat justo non mauris pretium at tempor justo.</li>
                                            <li>Ut nulla tellus, eleifend euismod pellentesque vel, sagittis vel
                                                justo.
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!--FAQ-->
                            <div class="tab-pane fade show" id="FAQ">
                                FAQ
                            </div>


                        </div>


                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="row shadow-sm ">
                    <h4 class="text-center">Course content
                    </h4>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "CoursePlayer",
        methods: {
            findCourse() {
                this.$store.dispatch('getCourse', this.$route.params.slug)
            },
        },
        computed: mapGetters(["course"]),
        created() {
            this.findCourse();
        }
    }
</script>

<style scoped>

</style>
