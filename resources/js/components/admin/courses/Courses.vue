<template>
    <div>
        <div>
            <form class="form-inline my-2 my-lg-0 mr-lg-2 float-right">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        <h1 class="text-center">All platform courses</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Name of teacher</th>
                <!-- <th scope="col">Name of enrolled students</th> -->
                <th scope="col">Language</th>
                <th scope="col">Nombre of sessions</th>
                <th scope="col">Price per session</th>
                <th scope="col">Status (paying or free)</th>
                <th scope="col">Date of sessions</th>
                <th scope="col">Date of creation</th>
                <th scope="col">Students list</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="t in allCourses.data" v-bind:key="t.id">
                <th scope="row">{{t.user.first_name}}</th>
                <!-- <td><el-button @click="handleShowEnrolled(t.id)">View enrolled</el-button></td> -->
                <td>{{t.language}}</td>
                <td>{{t.sections_count}}</td>
                <td>{{t.price}}</td>
                <td>{{t.price == 0 ? 'Free' : 'Paying'}}</td>
                <td><el-button @click="handleShowSection(t.id)">View</el-button></td>
                <td>{{t.created_at}}</td>
                <td><el-button @click="handleEnrollment(t.id)">Open</el-button></td>
            </tr>
            </tbody>
        </table>

        <el-dialog
            title="Course sessions"
            :visible.sync="showModal"
            :show-close="true"
            :modal-append-to-body="false"
            :append-to-body="true"
            custom-class="custom-modal"
            width='70%'>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Section</th>
                        <th scope="col">DATE</th>

                    </tr>
                </thead>
                <tbody v-if="!isEmpty(course)">
                    <tr v-for="t in course.course.sections" v-bind:key="t.id">
                        <th scope="row">{{t.title}}</th>
                        <td>{{formatDate(t.startDate)}}</td>
                    </tr>
                </tbody>
            </table>
        </el-dialog>

        <el-dialog
            title="Course sessions"
            :visible.sync="showModal2"
            :show-close="true"
            :modal-append-to-body="false"
            :append-to-body="true"
            custom-class="custom-modal"
            width='70%'>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Section</th>
                        <th scope="col">DATE</th>

                    </tr>
                </thead>
                <tbody v-if="!isEmpty(course)">
                    <tr v-for="t in course.course.sections" v-bind:key="t.id">
                        <th scope="row">{{t.title}}</th>
                        <td>{{formatDate(t.startDate)}}</td>
                    </tr>
                </tbody>
            </table>
        </el-dialog>

        <el-dialog
            :title="$t('enrollements_title')"
            ref="classes-modal"
            :visible.sync="dialogVisible"
            custom-class="enrollement-modal"
            :before-close="handleClose">
            <div v-if="isEmpty(courseEnrollement)">
                {{$t('no_enrollement')}}
            </div>
            <table class="table" v-else>
                <thead>
                <tr>
                    <th scope="col">{{$t('no_enrollement')}}</th>
                    <th scope="col">Section</th>

                </tr>
                </thead>
                <tbody>
                <tr v-for="t in courseEnrollement" v-bind:key="t.id">
                    <td>{{t.user.first_name}}</td>
                    <td>S{{t.course_file.number}}</td>
                </tr>
                </tbody>
            </table>
            <span slot="footer" class="dialog-footer">
                <el-button @click="handleClose">Ok</el-button>
            </span>
        </el-dialog>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'
    import {isEmpty} from "../../../helpers/common";
    import moment from "moment";
    
    export default {
        name: "Courses",
        /*
        |--------------------------------------------------------------------------
        | component > data
        |--------------------------------------------------------------------------
        */
        data() {
            return {
                showModal: false,
                showModal2: false,
                dialogVisible: false
            }
        },
        /*
        |--------------------------------------------------------------------------
        | Component > computed
        |--------------------------------------------------------------------------
        */
        computed: {
            ...mapGetters([
                "courseEnrollement"
            ]),
        },
        /*
        |--------------------------------------------------------------------------
        | component > methods
        |--------------------------------------------------------------------------
        */
        methods: {
            ...mapActions(["fetchCourses", "getCourse"]),
            handleShowSection(id) {
                console.log(id)
                this.$store.dispatch('getCourse', id);
                this.showModal = true
            },
            handleShowEnrolled(id) {
                this.$store.dispatch('getCourse', id);
                this.showModal2 = true
            },
            isEmpty(v) {
                return isEmpty(v);
            },
            formatDate(d) {
                return moment(d).format("LLL");
            },
            handleEnrollment(v) {
                console.log(v)
                this.$store.dispatch("getCourseEnrollement", v);
                this.dialogVisible = true;
            },
            handleClose() {
                this.$refs['classes-modal'].close();
                this.dialogVisible = false
               // window.location.reload()
            }
        },
        /*
        |--------------------------------------------------------------------------
        | component > computed
        |--------------------------------------------------------------------------
        */
        computed: mapGetters(["allCourses", "course"]),
        /*
        |--------------------------------------------------------------------------
        | component > created
        |--------------------------------------------------------------------------
        */
        created() {
            this.fetchCourses();
        }
    }
</script>

<style scoped>

</style>
