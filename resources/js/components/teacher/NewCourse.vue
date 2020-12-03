<template>
    <div>
        <div class="jumbotron text-right" style="height: 200px"></div>
        <beat-loader :loading="pageLoader" color="#004d4d" class="center-screen"></beat-loader>
        <div class="container py-3 mb-5 bg font-weight-bold">
            <h3 class="text-center font-weight-bolder">{{$t('newCourse.title')}}</h3>
            <form class="my-3" @submit.prevent="saveCourse">
                <div class="row" v-if="step===1">
                    <!--categ-->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="selectLang">{{$t('newCourse.categ')}}</label>
                            <select class="form-control" id="selectLang" @change="loadSubs" required>
                                <option v-for="c in allCategories" :key="c.id" :value="c.id" :selected="c.id===1">
                                    {{(lang==="en")? c.name_en:c.name_fr}}
                                </option>
                                <!-- <option value="0">{{$t('newCourse.createCateg')}}</option> -->
                            </select>

                        </div>
                    </div>
                    <!--subcateg-->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="subCateg">{{$t('newCourse.sub')}}</label>
                            <select class="form-control" id="subCateg" @change="model" v-model="course.sub_category_id"
                                    required>
                                <option v-for="c in subCategories" :key="c.id" :value="c.id">
                                    {{(lang==="en")? c.name_en:c.name_fr}}
                                </option>
                                <!-- <option class="border-top border-primary" value="0">{{$t('newCourse.createSub')}}
                                </option> -->
                            </select>
                        </div>
                    </div>
                    <!--Lang-->
                    <div class="col-md-4">
                        <div class="form-group" v-if="course.language ==='French' || course.language ==='English' || course.language ==='Spanish'">
                            <label for="exampleFormControlSelect1">{{$t('newCourse.lang')}}</label>
                            <select class="form-control" id="exampleFormControlSelect1" required
                                    v-model="course.language">
                                <option value="French">{{$t('demande.languages.fr')}}</option>
                                <option value="English">{{$t('demande.languages.en')}}</option>
                                <option value="Spanish">{{$t('demande.languages.es')}}</option>
                                <option value="">{{$t('demande.languages.other')}}</option>
                            </select>
                        </div>
                        <div class="form-group" v-else>
                            <label for="lang1">{{$t('newCourse.lang')}}</label>
                            <input type="text" class="form-control" id="lang1" required v-model="course.language">
                        </div>
                    </div>
                </div>
                <div class="row" v-if="step===2">
                    <!--Price-->
                    <div class="col-md-12">
                        <div class="form-row mb-3">
                            <div class="col-md-3">
                                <label for="price">{{$t('newCourse.price')}}</label>
                                <input type="text" class="form-control" id="price" aria-describedby="priceHelp"
                                       placeholder="Price" v-model="course.price" required :disabled="course.is_free">
                                <small id="priceHelp" class="form-text text-muted">
                                </small>

                            </div>
                            
                            <div class="col-md-3">
                                <label for="price">{{$t('newCourse.currency')}}</label>
                                <select class="form-control" v-model="course.currency" aria-describedby="currencyHelp"
                                        required>
                                    <option value="cad">CAD</option>
                                    <!--                                    <option value="usd">USD</option>-->
                                    <!--                                    <option value="eur">EUR</option>-->
                                </select>
                                <!--                                <small id="currencyHelp" class="form-text text-muted">-->
                                <!--                                    Canadiens users have to select CAD.-->
                                <!--                                </small>-->
                            </div>
                            <div class="col-md-3">
                                <div class="form-group text-center">
                                    <br/>
                                    <label>{{$t('newCourse.is_free')}}</label>
                                    <input type="checkbox" v-model="course.is_free">
                                </div>
                            </div>
                            
                        </div>
                        <div>
                            <p class=" font-weight-light">
                                <br>
                                {{$t('newCourse.priceHelp')}}
                            </p>

                        </div>
                    </div>
                    <!--duration-->
                    <!--                    <div class="col-md-4">-->
                    <!--                        <div class="form-group">-->
                    <!--                            <label for="duration">Estimated duration with all sessions</label>-->
                    <!--                            <input type="text" class="form-control" id="duration"-->
                    <!--                                   placeholder="Duration" v-model="course.estimated_duration" required>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <!--Students-->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="persons">{{$t('newCourse.students')}}</label>
                            <el-input-number placeholder="authorized students" v-model="course.authorized_students" controls-position="right" :min="1" :max="50" style="width:100%">
                            </el-input-number>
                            <!-- <input type="number" min="1" max="50" class="form-control" id="persons"
                                   placeholder="authorized students" v-model="course.authorized_students" required> -->
                        </div>
                    </div>
                    <!--partage-->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="partage">{{$t('newCourse.sharing')}}</label>
                            <select class="form-control" id="partage" v-model="course.sharable" required>
                                <option value="1">{{$t('newCourse.authorised')}}</option>
                                <option value="0">{{$t('newCourse.unauthorised')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <br>
                            <label>{{$t('newCourse.recordings')}}</label>
                            <input type="checkbox" v-model="course.allow_share_records" disabled>
                        </div>
                    </div>

                </div>
                <div class="row" v-if="step===3">
                    <h3>{{$t('newCourse.summary')}}</h3>
                    <!--Summary-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="desc">{{$t('newCourse.summaryHelp')}} (maximum: 150 {{$t('carachtar')}})</label>
                            <textarea class="form-control" v-model="course.short_description" maxlength="150" required></textarea>
                        </div>
                    </div>
                </div>
                <div v-if="step===4">
                    <div class="form-row">
                        <div class="col-3">
                            <label for="sections">{{$t('newCourse.number')}}</label>
                        </div>
                        <div class="col-2 text-left">
                            <div class="form-group">
                                <input type="number" value="1" min="1" class="form-control" id="sections" required
                                       @change="addSection">
                            </div>
                        </div>
                        <div class="col-12">
                            <p class="font-weight-bolder">
                                {{$t('newCourse.note')}}
                            </p>
                        </div>
                    </div>

                    <!--sections-->
                    <div v-for="(section, index) in sections" :key="index">
                        <el-divider content-position="left"><span style="color: blue">Session: {{index + 1}}</span></el-divider>
                        <div class="row border m-2 ">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="section1Title">{{$t('newCourse.give')}}:</label>
                                    <input type="text" class="form-control" id="section1Title"
                                        placeholder="Title" name="title[]" required v-model="sections[index].title">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="short_desc">{{$t('newCourse.desc')}}:</label>
                                    <textarea type="text" class="form-control" id="short_desc"
                                            :placeholder="$t('newCourse.description')" name="desc[]" required
                                            v-model="sections[index].description"></textarea>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{$t('newCourse.available')}}:</label>
                                    <!-- <input type="datetime-local" name="date[]" class="form-control" required
                                        v-model="sections[index].stratDate"> -->
                                    <el-date-picker
                                        v-model="sections[index].stratDate"
                                        type="datetime"
                                        :placeholder="$t('newCourse.select_time')"
                                        :picker-options="datePickerOptions1">
                                    </el-date-picker>
                                    <small>{{$t('newCourse.teaching_note')}}</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>{{$t('newCourse.timezone')}}</label>
                                <select class="form-control" v-model="sections[index].timezone" required>
                                    <option value="GMT">Greenwich Mean Time</option>
                                    <option value="ET">Eastern Time ET</option>
                                    <option value="PT">Pacific Time PT</option>
                                    <option value="AT">Atlantic Time ET</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <br/>
                                    <label>{{$t('newCourse.session')}} {{index+1}} {{$t('newCourse.duration')}}:</label>
                                    <select class="mr-2 " name="session[]" aria-describedby="durationHelp"
                                            v-model="sections[index].duration" required>
                                        <option value="1">1</option>
                                        <option value="1.5">1.5</option>
                                        <option value="2">2</option>
                                    </select>h

                                    <small id="durationHelp" class="form-text text-muted">
                                        {{$t('newCourse.durationHelp')}}
                                    </small>

                                </div>
                            </div>
                            <!--                        <div class="col-md-3">-->
                            <!--                            <label>I can teach this session every</label>-->
                            <!--                            <select class="form-control" v-model="sections[index].frequency" required>-->
                            <!--                                <option value="0">None</option>-->
                            <!--                                <option value="weekly">Week</option>-->
                            <!--                                <option value="monthly">Month</option>-->
                            <!--                            </select>-->
                            <!--                        </div>-->
                            
                        </div>
                    </div>
                    <!--                submitbtn-->
                </div>

                <div class="text-center" v-if="step===4">
                    <button class="btn btn-primary " type="submit" :disabled="savingCourse">
                        <span v-if="!savingCourse">
                            {{$t('newCourse.publish')}}

                        </span>
                        <div class="text-center text-white" v-if="savingCourse">
                                        <span class="spinner-border spinner-border-sm" role="status"
                                              aria-hidden="true"/>
                            {{$t('wait_msg')}}
                        </div>
                    </button>
                </div>
            </form>
            <div>
                <button class="btn btn-dark" @click="step--" :disabled="step===1">
                    {{$t('newCourse.prev')}}
                </button>
                <button class="btn btn-primary float-right" @click="next" :disabled="step===4" v-if="step!==4">
                    {{$t('newCourse.next')}}
                </button>
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
    import {isEmpty} from "../../helpers/common";
    import BeatLoader from 'vue-spinner/src/BeatLoader.vue';

    export default {
        name: "NewCourse",
        components: {
            BeatLoader
        },
        data() {
            return {
                step: 1,
                course: {
                    sub_category_id: 1,
                    language: 'English',
                    price: '0',
                    currency: 'cad',
                    estimated_duration: '',
                    authorized_students: '',
                    sharable: '1',
                    allow_share_records: '1',
                    name: '',
                    image: '',
                    short_description: '',
                    is_free: false
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
                        duration: '1',
                        description: '',
                        timezone: 'GMT',
                        frequency: '',
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
                datePickerOptions1: {
                    disabledDate (date) {
                        return date < new Date('2021-1-4');
                    }
                },
                pageLoader: false
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
                if (id == 0)
                    $('#exampleModalCenter').modal('show')
                this.$store.dispatch('fetchSubCategories', id)
            },
            saveCourse() {
                this.pageLoader = true
                console.log('this.course.is_free')
                console.log(this.course)
                console.log(this.course.is_free ? '1' : '0')
                this.savingCourse = true;
                const formData = new FormData();
                const imagefile = document.querySelector('#thumbnail');
                formData.append("sub_category_id", this.course.sub_category_id);
                formData.append("language", this.course.language);
                formData.append("price", this.course.price);
                formData.append("currency", this.course.currency);
                formData.append("estimated_duration", 10);
                formData.append("authorized_students", this.course.authorized_students);
                formData.append("sharable", this.course.sharable);
                formData.append("name", this.course.name);
                formData.append("short_description", this.course.short_description);
                formData.append("allow_share_records", this.course.allow_share_records);
                formData.append("is_free", this.course.is_free ? '1' : '0');
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
                   /*  this.$alert('', 'New Course', 'success').then(
                        () => this.$router.push({name: 'Courses'})
                    ) */
                    this.pageLoader = false
                    this.$swal.fire({
                        title: '',
                        text: this.$t('newCourse.thank_msg'),
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'ok'
                    }).then((result) => {
                        this.$router.push({name: 'Courses'})
                    })

                })
                .catch(err => {
                    console.log(err)
                    this.pageLoader = false
                    this.savingCourse = false
                });
            },
            addSection(event) {
                const sections = event.target.value;
                this.sections = [];
                for (let i = 0; i < sections; i++) {
                    this.sections.push({
                        title: '',
                        stratDate: '',
                        duration: '1',
                        description: '',
                        timeZone: '',
                        frequency: '',
                    })
                }


            },
            next() {
                if (this.step ==3) {
                    if (isEmpty(this.course.short_description)) {
                        return
                    } else this.step++
                }else this.step++
            }
        },
        computed: mapGetters(["allCategories", "subCategories", "lang"]),
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
        border-radius: 10px;
        box-shadow: 10px 10px 23px 0 rgba(130, 130, 130, 1);
        background: #fff;
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
        z-index: 1000px;
    }
</style>
