<template>
    <div class="container rounded mb-4">

        <h3 class="text-center">Submit new course section</h3>
        <form class="my-3" method="post" @submit.prevent="saveSection">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="selectLang">Select Course</label>
                        <select class="form-control" id="selectLang" v-model="section.course_id" required>
                            <option v-for="c in userCourses" :key="c.id" :value="c.id">{{c.name}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Session title</label>
                        <input type="text" class="form-control" id="title" v-model="section.title">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Availability</label>
                        <input type="datetime-local" class="form-control" v-model="section.startDate">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <input type="text" class="form-control" id="duration">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="desc">Session description</label>
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
                    title: '',
                    stratDate: '',
                    duration: '',
                    description: '',
                }
            }
        },
        methods: {
            loadCourses() {
                this.$store.dispatch('fetchUserCourses')
            },
            saveSection() {
                const token = localStorage.getItem('token') || null;
                if (token) {
                    // this.$store.dispatch("saveSection", this.section)
                    axios.post('/course/sections', this.section, {
                        headers: {
                            'Authorization': 'Bearer ' + token,
                        }
                    }).then(res => alert("Session saved successfully"))
                        .catch(err => console.log(err.response));

                }

            },
        },
        computed: {
            ...mapGetters(["userCourses"]),
        },
        created() {
            this.loadCourses();
        }

    }
</script>

<style scoped>

</style>
