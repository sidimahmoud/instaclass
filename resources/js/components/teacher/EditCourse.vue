<template>
    <div>
        <div class="jumbotron text-right" style="height: 200px"></div>
        <beat-loader :loading="pageLoader" color="#004d4d" class="center-screen"></beat-loader>
        <div class="container-fluid ">
            <div class="font-weight-bold rounded bg p-3" v-if="!loading">
                <h3 class="text-center font-weight-bolder">{{$t('course.edit_course')}}</h3>
                <form class="my-3" method="post" @submit.prevent="updateCourse">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cat">{{$t('course.select_cat')}}</label>
                                <select class="form-control" id="cat" required @change="loadSubs">
                                    <option v-for="c in allCategories" :key="c.id" :value="c.id"
                                            :selected="course.course.sub_category.category.id===c.id">{{c.name_en}}
                                    </option>
                                    <option value="0">{{$t('newCourse.createSub')}}</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="subCat">{{$t('newCourse.sub')}}</label>
                                <select class="form-control" id="subCat" @change="model" required>
                                    <option selected="selected">{{course.course.sub_category.name_en}}</option>
                                    <option v-for="c in subCategories" :key="c.id" :value="c.id">{{c.name_en}}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" v-if="course.course.language ==='French' || course.course.language ==='English' || course.course.language ==='Spanish'">
                                <label for="exampleFormControlSelect1">{{$t('newCourse.lang')}}?</label>
                                <select class="form-control" id="exampleFormControlSelect1" required
                                        v-model="course.course.language">
                                    <option value="French">{{$t('demande.languages.fr')}}</option>
                                    <option value="English">{{$t('demande.languages.en')}}</option>
                                    <option value="Spanish">{{$t('demande.languages.es')}}</option>
                                    <option value="">{{$t('demande.languages.other')}}</option>
                                </select>
                            </div>
                            <div class="form-group" v-else>
                                <label for="lang1">{{$t('newCourse.lang')}}</label>
                                <input type="text" class="form-control" id="lang1" required v-model="course.course.language">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-row mb-3">
                                <div class="col-md-3">
                                    <label for="price">{{$t('newCourse.price')}}</label>
                                    <input type="text" class="form-control" id="price" aria-describedby="priceHelp"
                                           placeholder="Price" v-model="course.course.price" required>
                                    <small id="priceHelp" class="form-text text-muted"> {{$t('newCourse.priceHelp')}}</small>

                                </div>

                                <div class="col-md-3">
                                    <label for="price">{{$t('newCourse.currency')}}</label>
                                    <select class="form-control" v-model="course.course.currency" aria-describedby="currencyHelp"
                                            required>
                                        <option value="cad">CAD</option>
                                        <!-- <option value="usd">USD</option>
                                        <option value="eur">EUR</option> -->
                                    </select>
                                    <!-- <small id="currencyHelp" class="form-text text-muted">
                                        Canadiens users have to select CAD.
                                    </small> -->
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group text-center">
                                        <br/>
                                        <label>{{$t('newCourse.is_free')}}</label>
                                        <input class="form-control" type="checkbox" v-model="course.course.is_free">
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <p class=" font-weight-light">
                                        {{$t('newCourse.priceHelp')}}
                                    </p>
                                    
                                </div> -->
                            </div>
                        </div>
                        <!-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="duration">Estimated duration with all sessions</label>
                                <input type="text" class="form-control" id="duration"
                                       placeholder="Duration" v-model="course.estimated_duration" required>
                            </div>
                        </div> -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="persons">{{$t('newCourse.sharing')}}</label>
                                <input type="number" min="1" max="50" class="form-control" id="persons"
                                       placeholder="authorized students" v-model="course.course.authorized_students">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="partage">{{$t('newCourse.sharing')}}</label>
                                <select class="form-control" id="partage" v-model="course.course.sharable" required>
                                    <option value="1">{{$t('newCourse.authorised')}}</option>
                                    <option value="0">{{$t('newCourse.unauthorised')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <h3>{{$t('newCourse.summary')}}</h3>
                                <!--Summary-->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="desc">{{$t('newCourse.summaryHelp')}} (maximum: 100 {{$t('carachtar')}})</label>
                                        <textarea class="form-control" v-model="course.course.short_description" maxlength="100" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="checkbox" v-model="course.course.allow_share_records" disabled>
                                <label>{{$t('newCourse.recordings')}}</label>
                            </div>
                        </div>


                    </div>
                    <h3>{{$t('sessions')}}: </h3>
                    <div class="row border m-3" v-for="(section, index) in course.course.sections" :key="index">
                        <div class="col-12"><strong>{{$t('session')}} {{index+1}}:</strong></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="section1Title">{{$t('title_name')}}</label>
                                <input type="text" class="form-control" id="section1Title"
                                       placeholder="Title" v-model="section.title" required>
                            </div>
                        </div><br/>
                        <div class="col-md-12">
                            <br/>
                            <div class="form-group">
                                <label for="short_desc">Description</label>
                                <wysiwyg type="text" class="form-control" id="short_desc"
                                    placeholder="Short description" v-model="section.description" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{$t('avai')}}:</label><br/>
                                <el-date-picker
                                    v-model="section.startDate"
                                    type="datetime"
                                    :placeholder="$t('newCourse.select_time')"
                                    format="yyyy-MM-dd HH:mm:ss" 
                                    value-format="yyyy-MM-dd HH:mm:ss"
                                    :picker-options="datePickerOptions1">
                                </el-date-picker>
                                <!-- <input type="datetime-local" class="form-control" v-model="section.startDate" required> -->
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label>{{$t('video')}}:</label>
                                <input type="file" class="form-control-file">
                            </div>
                        </div> -->
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">{{$t('course.edit_course')}}</button>
                </form>
            </div>
        </div>

        <div class="modal fade " id="exampleModalCenter" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{$t('new_course')}}</h5>
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
    import BeatLoader from 'vue-spinner/src/BeatLoader.vue';

    export default {
        name: "NewCourse",
        components: {
            BeatLoader
        },
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
                },
                datePickerOptions1: {
                    disabledDate (date) {
                        return date < new Date('2021-2-11');
                    }
                },
                pageLoader: false
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
                this.pageLoader = true;
                /* const formData = new FormData();
                formData.append("sub_category_id", this.course.course.sub_category_id);
                formData.append("language", this.course.course.language);
                formData.append("price", this.course.course.price);
                formData.append("currency", this.course.course.currency);
                formData.append("estimated_duration", this.course.course.estimated_duration);
                formData.append("authorized_students", this.course.course.authorized_students);
                formData.append("sharable", this.course.course.sharable);
                formData.append("name", this.course.course.name);
                formData.append("short_description", this.course.course.short_description);
                formData.append("_method", "put");
                console.log(this.course.course.sections);
                formData.append("sections", this.course.course.sections);
                formData.append("allow_share_records", this.course.course.allow_share_records? 1 : 0);
                formData.append("is_free", this.course.is_free ? '1' : '0'); */

                let payload = {
                    "sub_category_id": this.course.course.sub_category_id,
                    "language": this.course.course.language,
                    "price": this.course.course.price,
                    "currency": this.course.course.currency,
                    "estimated_duration": this.course.course.estimated_duration,
                    "authorized_students": this.course.course.authorized_students,
                    "sharable": this.course.course.sharable,
                    "name": this.course.course.name,
                    "short_description": this.course.course.short_description,
                    "sections": this.course.course.sections,
                    "allow_share_records": this.course.course.allow_share_records? 1 : 0,
                    "is_free": this.course.is_free ? '1' : '0'
                }

                axios.put('/course/'+this.course.course.id, payload)
                .then(res => {
                    console.log(res);
                    this.$swal.fire({
                        title: '',
                        text: this.$t('newCourse.update_msg'),
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'ok'
                    }).then((result) => {
                        this.pageLoader = false;
                        this.$router.push({name: 'TeacherProfile'})
                    })
                    //this.$alert('Your course was updated successfully','Course updated', 'success')
                }).catch((err) => {
                    this.pageLoader = false;
                    console.log(err.response)
                });
            },
        },
        computed: {
            ...mapGetters(["allCategories", "subCategories", "course", "loading"]),
        },
        mounted() {
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

    .center-screen {
        position:fixed; /* change this to fixed */
        top: 50%;
        left: 50%;
        margin-top: -50px;
        margin-left: -50px;
        width: 100px;
        height: 100px;
        z-index: 2000px;
    }
</style>
