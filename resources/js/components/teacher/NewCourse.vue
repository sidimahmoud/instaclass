<template>
    <div>
        <div class="jumbotron text-right" style="height: 200px"></div>

        <div class="container rounded py-3 bg font-weight-bold">
            <h3 class="text-center font-weight-bolder">create a new course</h3>
            <form class="my-3" method="post" @submit.prevent="saveCourse">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="selectLang">Select category</label>
                            <select class="form-control" id="selectLang" @change="loadSubs" required>
                                <option v-for="c in allCategories" :key="c.id" :value="c.id">{{c.name_en}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="subCateg">Sub category</label>
                            <select class="form-control" id="subCateg" v-model="course.sub_category_id" required>
                                <option v-for="c in subCategories" :key="c.id" :value="c.id">{{c.name_en}}</option>

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
                                <option value="">Create</option>
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
                                    <option value="eur">Eur</option>
                                </select>
                                <small id="currencyHelp" class="form-text text-muted">
                                    Canadiens users have to select CAD.
                                </small>
                            </div>
                            <div class="col-3">
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="duration">Estimated duration with all sessions</label>
                            <input type="text" class="form-control" id="duration"
                                   placeholder="Duration" v-model="course.estimated_duration" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="persons">Number of authorized students per session</label>
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

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="desc">Summerize the course</label>
                            <input type="text" class="form-control" id="desc"
                                   v-model="course.short_description" required>
                        </div>
                    </div>

                </div>
                <div class="row border m-2 " v-for="(section, index) in sections" :key="index">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="section1Title">Session {{index+1}}: Give a title to this session</label>
                            <input type="text" class="form-control" id="section1Title"
                                   placeholder="Title" name="title[]" required v-model="sections[index].title">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="short_desc">Session {{index+1}} description: GIve a description of what you will
                                teach in this session</label>
                            <input type="text" class="form-control" id="short_desc"
                                   placeholder="Short description" name="desc[]" required
                                   v-model="sections[index].description">
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
                                We suggest you arround 1h per session
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
                        timeZone: 'ET',
                        frequency: '0',
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
                //this.sections.map(item=>)

                formData.append("sections", JSON.stringify(this.sections));
                console.log(formData)
                axios.post('/course', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                }).then(res => {
                    console.log(res);
                    alert("Your course was published successfully")
                })
                    .catch(err => console.log(err.response));
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
        background: linear-gradient(180deg, rgba(75, 189, 254, 0.83), #fbf3f3);
    }

    .jumbotron {
        background-image: url('../../assets/images/teaprofile/bg.jpg');
        border-radius: 0;
    }
</style>
