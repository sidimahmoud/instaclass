<template>
    <div class="container rounded mb-4">

        <h3 class="text-center">Submit new course section</h3>
        <form class="my-3" method="post" @submit.prevent="saveSection">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="selectLang">Select Course</label>
                        <select class="form-control" id="selectLang" v-model="section.course_id" required>
                            <option v-for="c in TeacherCourses" :key="c.id" :value="c.id">{{c.name}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Thumbnail">Video file</label>
                        <input type="file" class="form-control-file" id="Thumbnail">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="desc">Section description</label>
                        <textarea class="form-control" id="desc" rows="3" v-model="section.description"
                                  required> </textarea>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-block" type="submit">Submit</button>
        </form>

    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        name: "NewSection",
        data() {
            return {
                section: {
                    course_id: '',
                    file: '',
                    description: '',
                }
            }
        },
        methods: {
            loadCourses() {
                let user = JSON.parse(localStorage.getItem('user')) || null
                if (user) {

                    this.$store.dispatch('fetchTeacherCourses', user.u)
                }
            },
            saveSection() {
                console.log(this.section)
            },
        },
        computed: {
            ...mapGetters(["TeacherCourses"]),
        },
        created() {
            this.loadCourses();
        }

    }
</script>

<style scoped>

</style>
