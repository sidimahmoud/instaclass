<template>
    <div>
        <div class="jumbotron text-right" style="height: 200px"></div>
        <div class="container rounded py-3 bg font-weight-bold" v-if="!loading">
            <h3 class="text-center font-weight-bolder">Edit Course</h3>
            <form class="my-3" method="post" @submit.prevent="saveCourse">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="selectLang">Select category</label>
                            <select class="form-control" id="selectLang" required @change="loadSubs">
                                <option v-for="c in allCategories" :key="c.id" :value="c.id"
                                        :selected="course.sub_category.category.id===c.id">{{c.name_en}}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="subCateg">Sub category</label>
                            <select class="form-control" id="subCateg" required>
                                <option selected="selected">{{course.sub_category.name_en}}</option>
                                <option v-for="c in subCategories" :key="c.id" :value="c.id">{{c.name_en}}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">In which language will you teach</label>
                            <select class="form-control" id="exampleFormControlSelect1" required
                                    v-model="course.language">
                                <option value="EN">EN</option>
                                <option value="FR">FR</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row mb-3">
                            <div class="col">
                                <label for="price">Price per session</label>
                                <input type="text" class="form-control" id="price" aria-describedby="priceHelp"
                                       placeholder="Price" :value="course.price" required>
                                <small id="priceHelp" class="form-text text-muted">A reasonable price will give you the
                                    chance to have students enrolled in your course.</small>

                            </div>
                            <div class="col">
                                <label for="price">Currency</label>
                                <select class="form-control" v-model="course.currency" aria-describedby="currencyHelp"
                                        required>
                                    <option value="cad">CAD</option>
                                    <option value="usd">USD</option>
                                    <option value="eur">Eur</option>
                                </select>
                                <small id="currencyHelp" class="form-text text-muted">
                                    Canadiens users have to select CAD.
                                </small>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="duration">Estimated duration</label>
                            <input type="text" class="form-control" id="duration"
                                   placeholder="Duration" v-model="course.estimated_duration" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="persons">Number of authorized students</label>
                            <input type="number" min="1" class="form-control" id="persons"
                                   placeholder="authorized students" :value="course.authorized_students" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="partage">Autorisez vous le partage de votre annonce?</label>
                            <select class="form-control" id="partage" required>
                                <option value="true" :selected="course.sharable">Instatavite peut le partager</option>
                                <option value="false" :selected="!course.sharable">Je n'autorise pas</option>
                            </select>
                        </div>
                    </div>

                </div>
                <h3>Sessions: </h3>
                <div class="row border m-3" v-for="(section, index) in course.sections" :key="index">
                    <div class="col-12"><strong>Session {{index+1}}:</strong></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="section1Title">Title</label>
                            <input type="text" class="form-control" id="section1Title"
                                   placeholder="Title" v-model="section.title" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="short_desc">Description</label>
                            <input type="text" class="form-control" id="short_desc"
                                   placeholder="Short description" v-model="section.description" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Availabilities:</label>
                            <input type="datetime-local" class="form-control" v-model="section.startDate" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Video:</label>
                            <input type="file" class="form-control-file">
                        </div>
                    </div>
                </div>


                <button class="btn btn-primary btn-block" type="submit">Save course</button>
            </form>

        </div>
    </div>

</template>

<script>
    import {mapGetters, mapActions} from 'vuex'

    export default {
        name: "NewCourse",
        methods: {
            ...mapActions(['fetchCategories']),
            findCourse() {
                this.$store.dispatch('getCourse', this.$route.params.slug)
            },
            loadSubs(event) {
                const id = event.target.value;
                this.$store.dispatch('fetchSubCategories', id)
            },
            updateCourse() {
                const formData = new FormData();
                const imagefile = document.querySelector('#thumbnail');
                formData.append("sub_category_id", this.course.sub_category_id);
                formData.append("language", this.course.language);
                formData.append("price", this.course.price);
                formData.append("currency", this.course.currency);
                formData.append("estimated_duration", this.course.estimated_duration);
                formData.append("authorized_students", this.course.authorized_students);
                formData.append("sharable", this.course.sharable);
                formData.append("name", this.course.name);
                formData.append("short_description", this.course.short_description);
                formData.append("_method", "put");

                formData.append("sections", JSON.stringify(this.sections));
                axios.post('/course', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                }).then(res => {
                    console.log(res);
                    alert("Your course was updated successfully")
                })
                    .catch(err => console.log(err.response));
            },
        },
        computed: mapGetters(["allCategories", "subCategories", "course", "loading"]),
        created() {
            this.fetchCategories();
            this.findCourse();

        }

    }
</script>

<style scoped>
    .bg {
        background: linear-gradient(180deg, rgba(75, 189, 254, 0.83), #fbf3f3);
    }

    .jumbotron {
        background-image: url('../../assets/images/teaprofile/bg.jpg');
        border-radius: 0;
    }
</style>
