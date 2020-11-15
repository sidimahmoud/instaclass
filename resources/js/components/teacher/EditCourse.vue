<template>
    <div>
        <div class="jumbotron text-right" style="height: 200px"></div>
        <div class="container-fluid ">
            <div class="font-weight-bold rounded bg p-3" v-if="!loading">
                <h3 class="text-center font-weight-bolder">Edit Course</h3>
                <form class="my-3" method="post" @submit.prevent="updateCourse">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cat">Select category</label>
                                <select class="form-control" id="cat" required @change="loadSubs">
                                    <option v-for="c in allCategories" :key="c.id" :value="c.id"
                                            :selected="course.sub_category.category.id===c.id">{{c.name_en}}
                                    </option>
                                    <option value="0">Create a Sub-Category</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="subCat">Sub category</label>
                                <select class="form-control" id="subCat" @change="model" required>
                                    <option selected="selected">{{course.sub_category.name_en}}</option>
                                    <option v-for="c in subCategories" :key="c.id" :value="c.id">{{c.name_en}}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" v-if="course.language ==='FR'|| course.language ==='EN'">
                                <label for="exampleFormControlSelect1">In which language will you teach?</label>
                                <select class="form-control" id="exampleFormControlSelect1" required
                                        v-model="course.language">
                                    <option value="EN">EN</option>
                                    <option value="FR">FR</option>
                                    <option value="">Add a new language</option>
                                </select>
                            </div>
                            <div class="form-group" v-else>
                                <label for="lang1">In which language will you teach?</label>
                                <input type="text" class="form-control" id="lang1" required v-model="course.language">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-row mb-3">
                                <div class="col-md-3">
                                    <label for="price">Estimated price per session</label>
                                    <input type="text" class="form-control" id="price" aria-describedby="priceHelp"
                                           placeholder="Price" v-model="course.price" required>
                                    <small id="priceHelp" class="form-text text-muted">A reasonable price will give you the
                                        chance to have students enrolled in your course.
                                    </small>

                                </div>

                                <div class="col-md-3">
                                    <label for="price">Currency</label>
                                    <select class="form-control" v-model="course.currency" aria-describedby="currencyHelp"
                                            required>
                                        <option value="cad">CAD</option>
                                        <option value="usd">USD</option>
                                        <option value="eur">EUR</option>
                                    </select>
                                    <small id="currencyHelp" class="form-text text-muted">
                                        Canadiens users have to select CAD.
                                    </small>
                                </div>
                                <div class="col-md-6">
                                    <p class=" font-weight-light">
                                        Your estimated total earnings for the course will depend of your estimated price,
                                        number of sessions and students enrolled.
                                    </p>
                                    <p class="font-weight-bolder">Note:
                                        When the number of sessions exceed 3, your third course will be free student
                                        enrolled.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="duration">Estimated duration with all sessions</label>
                                <input type="text" class="form-control" id="duration"
                                       placeholder="Duration" v-model="course.estimated_duration" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="persons">Number of authorized students per session</label>
                                <input type="number" min="1" max="50" class="form-control" id="persons"
                                       placeholder="authorized students" v-model="course.authorized_students">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="partage">Autorisez vous le partage de votre annonce?</label>
                                <select class="form-control" id="partage" v-model="course.sharable" required>
                                    <option value="1">Instantavite peut le partager</option>
                                    <option value="0">Je n'autorise pas</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="desc">Summerize what you will teach in your course</label>
                                <textarea class="form-control" id="desc" v-model="course.short_description"
                                          required></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="checkbox" v-model="course.allow_share_records" >
                                <label>Autorisez vous le partage desenregistrements?</label>
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

        <div class="modal fade " id="exampleModalCenter" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">New Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="my-3" method="post" @submit.prevent="saveCategory">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title">Name (English)</label>
                                        <input type="text" class="form-control" id="title" v-model="newCateg.name"
                                               required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="desc">Name (french)</label>
                                        <input type="text" class="form-control"  v-model="newCateg.nom"
                                               required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control-file" id="image" required>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-block" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modelSub" tabindex="-1" role="dialog"
             aria-labelledby="modelSubTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modelSubTitle">New Sub-category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="my-3" method="post" @submit.prevent="saveSub">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="selCat">Select category</label>
                                        <select class="form-control" id="selCat" @change="loadSubs" required
                                                v-model="newSub.catId">
                                            <option v-for="c in allCategories" :key="c.id" :value="c.id">{{c.name_en}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nfr">Name (English)</label>
                                        <input type="text" class="form-control" id="nfr" v-model="newSub.name"
                                               required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nen">Name (french)</label>
                                        <input type="text" class="form-control" id="nen" v-model="newSub.nom"
                                               required>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-block" type="submit">Submit</button>
                        </form>
                    </div>
                    <!--                    <div class="modal-footer">-->
                    <!--                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                    <!--                        <button type="button" class="btn btn-primary ">-->
                    <!--                            Save-->
                    <!--                        </button>-->
                    <!--                    </div>-->
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import {mapGetters, mapActions} from 'vuex'

    export default {
        name: "NewCourse",
        data() {
            return {
                newCateg: {
                    name: '',
                    nom: '',
                },
                newSub: {
                    catId: '',
                    name: '',
                    nom: '',
                }
            }
        },
        methods: {
            ...mapActions(['fetchCategories']),
            findCourse() {
                this.$store.dispatch('getCourse', this.$route.params.slug)
            },
            saveCategory() {
                const formData = new FormData();
                const imagefile = document.querySelector('#image');
                formData.append("name", this.newCateg.name);
                formData.append("nom", this.newCateg.nom);
                formData.append("image", imagefile.files[0]);
                axios.post('/categories', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                }).then(res => {
                    console.log(res);
                    this.$alert('Category created successfully','New category', 'success')
                    location.reload()
                })
            },
            saveSub() {
                if (this.newSub.catId === '0') {
                    this.$alert('Please select one category first','Select category', 'warning')
                    return
                }
                axios.post('/sub-categories', {
                    category_id: this.newSub.catId,
                    name: this.newSub.name,
                    nom: this.newSub.nom
                })
                    .then(res => {
                        this.$alert('Sub-category created successfully','New sub-category', 'success')
                        location.reload()
                    })
            },
            model(event) {
                const id = event.target.value;

                if (id == 0) {
                    $('#modelSub').modal('show')

                }

            },
            loadSubs(event) {
                const id = event.target.value;
                if (id == 0)
                    $('#exampleModalCenter').modal('show')
                this.$store.dispatch('fetchSubCategories', id)
            },
            updateCourse() {
                const formData = new FormData();
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
                formData.append("allow_share_records", this.course.allow_share_records? 1 : 0);

                console.log(formData)
                axios.post('/course/'+this.course.id, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                }).then(res => {
                    console.log(res);
                    this.$alert('Your course was updated successfully','Course updated', 'success')
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
        background:  #fff;
        /*background: linear-gradient(180deg, rgba(75, 189, 254, 0.83), #fbf3f3);*/
    }

    .jumbotron {
        background-image: url('../../assets/images/teaprofile/bg.jpg');
        border-radius: 0;
    }
</style>
