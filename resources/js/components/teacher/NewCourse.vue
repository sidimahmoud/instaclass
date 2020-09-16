<template>
    <div class="border-top border-primary pt-5">
        <div class="container rounded py-3 bg-white">

            <h3 class="text-center">Submit new course</h3>
            <form class="my-3" method="post" @submit.prevent="saveCourse">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="selectLang">Select category</label>
                            <select class="form-control" id="selectLang" @change="loadSubs" required>
                                <option v-for="c in allCategories" :key="c.id" :value="c.id">{{c.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="subCateg">Sub category</label>
                            <select class="form-control" id="subCateg" v-model="course.sub_category_id" required>
                                <option v-for="c in subCategories" :key="c.id" :value="c.id">{{c.name}}</option>

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
                                <label for="price">Estimated price per session</label>
                                <input type="text" class="form-control" id="price" aria-describedby="priceHelp"
                                       placeholder="Price" v-model="course.price" required>
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
                            <input type="number" min="1" max="50" class="form-control" id="persons"
                                   placeholder="authorized students" v-model="course.authorized_students" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="partage">Autorisez vous le partage de votre annonce?</label>
                            <select class="form-control" id="partage" v-model="course.sharable" required>
                                <option value="1">Instatavite peut le partager</option>
                                <option value="0">Je n'autorise pas</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Course name</label>
                            <input type="text" class="form-control" id="name"
                                   placeholder="Name" v-model="course.name" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="thumbnail">Thumbnail</label>
                            <input type="file" class="form-control-file" id="thumbnail">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="desc">Give a short description to this course</label>
                            <input type="text" class="form-control" id="desc"
                                   placeholder="Name" v-model="course.short_description" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="sections">Number of session</label>
                            <input type="number" value="1" min="1" class="form-control" id="sections" required
                                   @change="addSection">
                        </div>
                    </div>


                    <!--                <div class="col-md-4">-->
                    <!--                    <div class="form-group">-->
                    <!--                        <label for="type">Type</label>-->
                    <!--                        <select class="form-control" id="type" v-model="course.type" required>-->
                    <!--                            <option value="1">Recorded</option>-->
                    <!--                            <option value="2">Live</option>-->
                    <!--                        </select>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--                <div class="col-md-4">-->
                    <!--                    <div class="form-group">-->
                    <!--                        <label for="status">Status</label>-->
                    <!--                        <select class="form-control" id="status" v-model="course.status" required>-->
                    <!--                            <option value="1">PUBLIC</option>-->
                    <!--                            <option value="2">PRIVATE</option>-->
                    <!--                        </select>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--                <div class="col-md-4" v-if="course.status==2">-->
                    <!--                    <div class="form-group">-->
                    <!--                        <label for="price">Price</label>-->
                    <!--                        <input type="text" class="form-control" id="price"-->
                    <!--                               placeholder="Price" v-model="course.price" required>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--                <div class="col-md-4" v-if="course.type==2">-->
                    <!--                    <div class="form-group">-->
                    <!--                        <label for="duration">Estimated duration</label>-->
                    <!--                        <input type="text" class="form-control" id="duration"-->
                    <!--                               placeholder="Duration" v-model="course.estimated_duration" required>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--                <div class="col-md-4" v-if="course.type==2">-->
                    <!--                    <div class="form-group">-->
                    <!--                        <label for="persons">Number of authorized students</label>-->
                    <!--                        <input type="number" min="1" class="form-control" id="persons"-->
                    <!--                               placeholder="authorized students" v-model="course.authorized_students" required>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--                <div class="col-md-4" v-if="course.type==2">-->
                    <!--                    <div class="form-group">-->
                    <!--                        <label for="joinAfter">Students can join after</label>-->
                    <!--                        <select class="form-control" id="joinAfter" required>-->
                    <!--                            <option value="0">unauthorized</option>-->
                    <!--                            <option value="5">5 min</option>-->
                    <!--                            <option value="10">10 min</option>-->
                    <!--                            <option value="15">15 min</option>-->
                    <!--                            <option value="20">20 min</option>-->
                    <!--                            <option value="1">Anytime</option>-->
                    <!--                        </select>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--                <div class="col-md-4">-->
                    <!--                    <div class="form-group">-->
                    <!--                        <label for="name">Course name</label>-->
                    <!--                        <input type="text" class="form-control" id="name"-->
                    <!--                               placeholder="Name" v-model="course.name" required>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--                <div class="col-md-4" v-if="course.type==2">-->
                    <!--                    <div class="form-group">-->
                    <!--                        <label for="partage">Autorisez vous le partage de votre annonce?</label>-->
                    <!--                        <select class="form-control" id="partage" v-model="course.sharable" required>-->
                    <!--                            <option value="1">Tout le monde</option>-->
                    <!--                            <option value="0">Je n'autorise pas</option>-->
                    <!--                        </select>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--                <div class="col-md-4">-->
                    <!--                    <div class="form-group">-->
                    <!--                        <label for="thumbnail">Thumbnail</label>-->
                    <!--                        <input type="file" class="form-control-file" id="thumbnail">-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--                <div class="col-md-4">-->
                    <!--                    <div class="form-group">-->
                    <!--                        <label for="short_desc">Short description</label>-->
                    <!--                        <input type="text" class="form-control" id="short_desc"-->
                    <!--                               placeholder="Short description" v-model="course.short_description" required>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--                <div class="col-md-12">-->
                    <!--                    <div class="form-group">-->
                    <!--                        <label for="desc">Course description</label>-->
                    <!--                        <textarea class="form-control" id="desc" rows="3" v-model="course.description"-->
                    <!--                                  required> </textarea>-->
                    <!--                    </div>-->
                    <!--                </div>-->

                </div>
                <div class="row border m-2 " v-for="(section, index) in sections" :key="index">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="section1Title">Session {{index+1}}: Give a title to this session</label>
                            <input type="text" class="form-control" id="section1Title"
                                   placeholder="Title" name="title[]" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="short_desc">Session {{index+1}} description: GIve a description of what you will
                                teach in this session</label>
                            <input type="text" class="form-control" id="short_desc"
                                   placeholder="Short description" name="desc[]" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Session {{index+1}} availabilities:</label>
                            <input type="datetime-local" name="date[]" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Session {{index+1}} estimated duration:</label>
                            <input type="text" name="session[]" class="form-control" required>
                        </div>
                    </div>

                </div>
                <button class="btn btn-primary btn-block" type="submit">Publish course</button>
            </form>

        </div>
    </div>

</template>

<script>
    import {mapGetters, mapActions} from 'vuex'

    export default {
        name: "NewCourse",
        data() {
            return {
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
                    },
                ]
            }
        },
        methods: {
            ...mapActions(['fetchCategories']),
            loadSubs(event) {
                const id = event.target.value;
                this.$store.dispatch('fetchSubCategories', id)
            },
            saveCourse() {
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
                formData.append("sections", this.sections);
                formData.append("image", imagefile.files[0]);
                axios.post('/course', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                }).then(res => {
                    console.log(res);
                    alert("Your course was published successfully")
                })
                    .catch(err => console.log(err.response));
                console.log(this.section);
            },

            addSection(event) {
                const sections = event.target.value;
                this.sections = [];
                for (let i = 0; i < sections; i++) {
                    this.sections.push({
                        title: '',
                        stratDate: '',
                        duration: '',
                        description: '',
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

</style>
