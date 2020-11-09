<template>
    <div>
        <div class="jumbotron text-right" style="height: 200px"></div>

        <div class="container py-3 mb-5 bg font-weight-bold">
            <h3 class="text-center font-weight-bolder">New course creation</h3>
            <form class="my-3" @submit.prevent="saveCourse">
                <div class="row" v-if="step===1">
                    <!--categ-->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="selectLang">Select category</label>
                            <select class="form-control" id="selectLang" @change="loadSubs" required>
                                <option v-for="c in allCategories" :key="c.id" :value="c.id" :selected="c.id===1">
                                    {{c.name_en}}
                                </option>
                                <option value="0">Create a Category</option>
                            </select>

                        </div>
                    </div>
                    <!--subcateg-->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="subCateg">Sub category</label>
                            <select class="form-control" id="subCateg" @change="model" v-model="course.sub_category_id"
                                    required>
                                <option v-for="c in subCategories" :key="c.id" :value="c.id">{{c.name_en}}</option>
                                <option value="0">Create a Sub-Category</option>
                            </select>

                        </div>
                    </div>
                    <!--Lang-->
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
                </div>
                <div class="row" v-if="step===2">
                    <!--Price-->
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
                                <div class="form-group">
                                    <label for="sections">Number of sessions</label>
                                    <input type="number" value="1" min="1" class="form-control" id="sections" required
                                           @change="addSection">
                                </div>
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
                            <div class="col-md-3">
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
                    <!--duration-->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="duration">Estimated duration with all sessions</label>
                            <input type="text" class="form-control" id="duration"
                                   placeholder="Duration" v-model="course.estimated_duration" required>
                        </div>
                    </div>
                    <!--Students-->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="persons">Number of authorized students per session</label>
                            <input type="number" min="1" max="50" class="form-control" id="persons"
                                   placeholder="authorized students" v-model="course.authorized_students" required>
                        </div>
                    </div>
                    <!--partage-->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="partage">Autorisez vous le partage de votre annonce?</label>
                            <select class="form-control" id="partage" v-model="course.sharable" required>
                                <option value="1">Instantavite peut le partager</option>
                                <option value="0">Je n'autorise pas</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="row" v-if="step===3">
                    <!--Summary-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="desc">Summerize what you will teach in your course</label>
                            <textarea class="form-control" v-model="course.short_description" required></textarea>
                        </div>
                    </div>
                </div>
                <div v-if="step===4">
                    <!--sections-->
                    <div class="row border m-2 " v-for="(section, index) in sections" :key="index">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="section1Title">Session {{index+1}}: Give a title to this session</label>
                                <input type="text" class="form-control" id="section1Title"
                                       placeholder="Title" name="title[]" required v-model="sections[index].title">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="short_desc">Session {{index+1}} description: GIve a description of what you
                                    will
                                    teach in this session</label>
                                <textarea type="text" class="form-control" id="short_desc"
                                          placeholder="Short description" name="desc[]" required
                                          v-model="sections[index].description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Session {{index+1}} availabilities:</label>
                                <input type="datetime-local" name="date[]" class="form-control" required
                                       v-model="sections[index].stratDate">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Time Zone</label>
                            <select class="form-control" v-model="sections[index].timeZone" required>
                                <option value="ET">Eastern Time ET</option>
                                <option value="PT">Pacific Time PT</option>
                                <option value="AT">Atlantic Time ET</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Session {{index+1}} estimated duration:</label>
                                <input type="text" class="form-control" name="session[]" aria-describedby="durationHelp"
                                       v-model="sections[index].duration" required>
                                <small id="durationHelp" class="form-text text-muted">
                                    We suggest 1h per session
                                </small>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>I can teach this session every</label>
                            <select class="form-control" v-model="sections[index].frequency" required>
                                <option value="0">None</option>
                                <option value="weekly">Week</option>
                                <option value="monthly">Month</option>
                            </select>
                        </div>
                    </div>
                    <!--                submitbtn-->
                </div>

                <div class="text-center">
                    <button class="btn btn-primary " type="submit" :disabled="savingCourse">
                        <span v-if="!savingCourse">
                            Publish course
                        </span>
                        <div class="text-center text-white" v-if="savingCourse">
                                        <span class="spinner-border spinner-border-sm" role="status"
                                              aria-hidden="true"/>
                            Please wait...
                        </div>
                    </button>
                </div>
            </form>
            <div>
                <button class="btn btn-dark" @click="step--" :disabled="step===1">Back</button>
                <button class="btn btn-primary float-right" @click="step++" >Next</button>
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
                                        <input type="text" class="form-control" id="desc" v-model="newCateg.nom"
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
                    <!--                    <div class="modal-footer">-->
                    <!--                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                    <!--                        <button type="button" class="btn btn-primary ">-->
                    <!--                            Save-->
                    <!--                        </button>-->
                    <!--                    </div>-->
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
                step: 1,
                course: {
                    sub_category_id: 1,
                    language: 'EN',
                    price: '0',
                    currency: 'usd',
                    estimated_duration: '',
                    authorized_students: '',
                    sharable: '1',
                    name: '',
                    image: '',
                    short_description: '',
                    // description: '',
                    // duration: '',
                    // status: '',
                    // type: '',
                    // join_after: '',
                    // available_from: '',
                    // available_to: '',
                },
                sections: [
                    {
                        title: '',
                        stratDate: '',
                        duration: '',
                        description: '',
                        timeZone: 'ET',
                        frequency: '0',
                    },
                ],
                newCateg: {
                    name: '',
                    nom: '',
                },
                newSub: {
                    catId: '',
                    name: '',
                    nom: '',
                },
                savingCourse: false,
            }
        },
        methods: {
            ...mapActions(['fetchCategories']),
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
                    this.$alert('Category created successfully', 'New category', 'success')

                    location.reload()
                })
            },
            saveSub() {
                if (this.newSub.catId === '0') {
                    this.$alert('Please select one category first', 'Select category', 'warning')

                    return
                }
                axios.post('/sub-categories', {
                    category_id: this.newSub.catId,
                    name: this.newSub.name,
                    nom: this.newSub.nom
                })
                    .then(res => {
                        this.$alert('Sub-category created successfully', 'New sub-category', 'success')
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
                if (id === 0)
                    $('#exampleModalCenter').modal('show')
                this.$store.dispatch('fetchSubCategories', id)
            },
            saveCourse() {
                this.savingCourse = true;
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
                //this.sections.map(item=>)

                formData.append("sections", JSON.stringify(this.sections));
                console.log(formData)
                axios.post('/course', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                }).then(res => {
                    // console.log(res);
                    this.savingCourse = false;
                    this.$alert('Your course was published successfully', 'New Course', 'success')

                })
                    .catch(err => console.log(err.response));
            }
            ,

            addSection(event) {
                const sections = event.target.value;
                this.sections = [];
                for (let i = 0; i < sections; i++) {
                    this.sections.push({
                        title: '',
                        stratDate: '',
                        duration: '',
                        description: '',
                        timeZone: '',
                        frequency: '',
                    })
                }


            },
        },
        computed: mapGetters(["allCategories", "subCategories"]),
        created() {
            this.fetchCategories();
            this.$store.dispatch('fetchSubCategories', 1)
        }
    }
</script>

<style scoped>
    .bg {
        /*background: linear-gradient(180deg, rgba(75, 189, 254, 0.83), #fbf3f3);*/
        border: 5px solid black;
        box-shadow: 10px 10px 23px 0px rgba(130,130,130,1);
    }

    .jumbotron {
        background-image: url('../../assets/images/teaprofile/bg.jpg');
        border-radius: 0;
    }
</style>
