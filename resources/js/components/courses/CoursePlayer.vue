<template>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0"
                            allowfullscreen></iframe>
                </div>
                <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#exampleModalCenter">
                    <i class="fa fa-heart text-danger"></i> Rate this course
                </button>
                <!--                    <div class="col-md-12">-->
                <!--                        <nav class="nav nav-pills nav-fill">-->
                <!--                            <a class="nav-item nav-link active" href="#overview" data-toggle="tab">Overview</a>-->
                <!--                            <a class="nav-item nav-link" href="#FAQ" data-toggle="tab">FAQ</a>-->

                <!--                        </nav>-->
                <!--                        <hr>-->
                <!--                        <div class="tab-content my-5">-->
                <!--                            <div class="tab-pane fade show active" id="overview">-->
                <!--                                <div class="container">-->
                <!--                                    <h3 class="font-weight-bolder">{{course.name}}</h3>-->
                <!--                                    <p>-->
                <!--                                        {{course.description}}-->
                <!--                                    </p>-->
                <!--                                    <div>-->
                <!--                                        <span class="h5 mr-5 font-weight-bold">{{course.enrollments.length}} Total Students</span>-->
                <!--                                    </div>-->
                <!--                                    <div>-->
                <!--                                        <p class="h5 mt-5 font-weight-bold">What you’ll learn?</p>-->
                <!--                                        <ul>-->
                <!--                                            <li>Phasellus enim magna, varius et commodo ut.</li>-->
                <!--                                            <li>Sed consequat justo non mauris pretium at tempor justo.</li>-->
                <!--                                            <li>Ut nulla tellus, eleifend euismod pellentesque vel, sagittis vel-->
                <!--                                                justo.-->
                <!--                                            </li>-->
                <!--                                            <li>Phasellus enim magna, varius et commodo ut.</li>-->
                <!--                                            <li>Sed consequat justo non mauris pretium at tempor justo.</li>-->
                <!--                                            <li>Nulla tellus, eleifend euismod pellentesque vel, sagittis vel justo.-->
                <!--                                            </li>-->
                <!--                                        </ul>-->
                <!--                                    </div>-->
                <!--                                    <div>-->
                <!--                                        <p class="h5 mt-5 font-weight-bold">Requirements</p>-->
                <!--                                        <ul>-->
                <!--                                            <li>Phasellus enim magna, varius et commodo ut.</li>-->
                <!--                                            <li>Sed consequat justo non mauris pretium at tempor justo.</li>-->
                <!--                                            <li>Ut nulla tellus, eleifend euismod pellentesque vel, sagittis vel-->
                <!--                                                justo.-->
                <!--                                            </li>-->

                <!--                                        </ul>-->
                <!--                                    </div>-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                            &lt;!&ndash;FAQ&ndash;&gt;-->
                <!--                            <div class="tab-pane fade show" id="FAQ">-->
                <!--                                FAQ-->
                <!--                            </div>-->
                <!--                        </div>-->
                <!--                    </div>-->
            </div>
        </div>
        <!-- Modal rating -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Rate course</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3>How was the session with the teacher</h3>
                        <div class="pl-5">
                            <p @click="rate=5">
                                <i class="fa fa-star text-warning mx-2 rateStar" v-for="n in 5"/>
                                <strong>Excellent</strong>
                            </p>
                            <p @click="rate=4">
                                <i class="fa fa-star text-warning mx-2 rateStar" v-for="n in 4"/>
                                <i class="fa fa-star text-secondary mx-2 rateStar"/>
                                <strong>Above Average</strong>
                            </p>
                            <p @click="rate=3">
                                <i class="fa fa-star text-warning mx-2 rateStar" v-for="n in 3"/>
                                <i class="fa fa-star text-secondary mx-2 rateStar" v-for="n in 2"/>
                                <strong>Average</strong>
                            </p>
                            <p @click="rate=2">
                                <i class="fa fa-star text-warning mx-2 rateStar" v-for="n in 2"/>
                                <i class="fa fa-star text-secondary mx-2 rateStar" v-for="n in 3"/>
                                <strong>Below Average</strong>
                            </p>
                            <p @click="rate=1">
                                <i class="fa fa-star text-warning mx-2 rateStar"/>
                                <i class="fa fa-star text-secondary mx-2 rateStar" v-for="n in 4"/>
                                <strong>Poor</strong>
                            </p>
                        </div>

                        <div class="form-group">
                            <label for="desc">Leave a comment</label>
                            <textarea class="form-control" id="desc" rows="3" required v-model="review"> </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary " @click="rating" :disabled="sending">
                            <span v-if="!sending">
                                Submit review
                            </span>
                            <span v-if="sending">
                                 <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true">
                                 </span>
                                Wait...
                            </span>

                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    import axios from "axios";

    export default {
        name: "CoursePlayer",
        data() {
            return {
                rate: 5,
                review: "",
                course_id: '',
                sending: false
            }
        },
        methods: {
            findCourse() {
                this.$store.dispatch('getSection', this.$route.params.slug)
            },
            rating() {
                this.$store.dispatch('rateCourse', {rate: this.rate, review: this.review, course_id: this.course.id})
                    .then(res => {
                        res.data === "success" ? alert("Success") : alert("error");
                        window.location.reload()
                    }).catch(err => console.log(err))
            }
        },
        computed: mapGetters(["course"]),
        created() {
            this.findCourse();
        }
    }
</script>

<style scoped>

</style>
