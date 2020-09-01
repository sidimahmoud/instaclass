<template>
    <div class="container rounded mb-4">

        <h3 class="text-center">Submit new course</h3>
        <form class="my-3" method="post" @submit.prevent="saveCourse">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="selectLang">Select category</label>
                        <select class="form-control" id="selectLang" required>
                            <option v-for="c in allCategories" :key="c.id" :value="c.id">{{c.name}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="subCateg">Sub category</label>
                        <select class="form-control" id="subCateg" v-model="course.category_id" required>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">course language</label>
                        <select class="form-control" id="exampleFormControlSelect1" required v-model="course.language">
                            <option value="EN">EN</option>
                            <option value="FR">FR</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" id="type" v-model="course.type" required>
                            <option value="1">Recorded</option>
                            <option value="2">Live</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" v-model="course.status" required>
                            <option value="1">PUBLIC</option>
                            <option value="2">PRIVATE</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4" v-if="course.status==2">
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="price"
                               placeholder="Price" v-model="course.price" required>
                    </div>
                </div>
                <div class="col-md-4" v-if="course.type==2">
                    <div class="form-group">
                        <label for="duration">Estimated duration</label>
                        <input type="text" class="form-control" id="duration"
                               placeholder="Duration" v-model="course.estimated_duration" required>
                    </div>
                </div>
                <div class="col-md-4" v-if="course.type==2">
                    <div class="form-group">
                        <label for="persons">Number of authorized students</label>
                        <input type="number" min="1" class="form-control" id="persons"
                               placeholder="authorized students" v-model="course.authorized_students" required>
                    </div>
                </div>
                <div class="col-md-4" v-if="course.type==2">
                    <div class="form-group">
                        <label for="joinAfter">Students can join after</label>
                        <select class="form-control" id="joinAfter" required>
                            <option value="0">unauthorized</option>
                            <option value="5">5 min</option>
                            <option value="10">10 min</option>
                            <option value="15">15 min</option>
                            <option value="20">20 min</option>
                            <option value="1">Anytime</option>
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
                <div class="col-md-4" v-if="course.type==2">
                    <div class="form-group">
                        <label for="partage">Autorisez vous le partage de votre annonce?</label>
                        <select class="form-control" id="partage" v-model="course.sharable" required>
                            <option value="1">Tout le monde</option>
                            <option value="0">Je n'autorise pas</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="thumbnail">Thumbnail</label>
                        <input type="file" class="form-control-file" id="thumbnail">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="short_desc">Short description</label>
                        <input type="text" class="form-control" id="short_desc"
                               placeholder="Short description" v-model="course.short_description" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="desc">Course description</label>
                        <textarea class="form-control" id="desc" rows="3" v-model="course.description"
                                  required> </textarea>
                    </div>
                </div>
            </div>
            <div class="row" v-for="(section, index) in sections" :key="index">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Séance {{index+1}} title:</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Séance {{index+1}} description:</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Séance {{index+1}} video:</label>
                        <input type="file" class="form-control-file">
                    </div>
                </div>
            </div>
            <div class="text-right">
                <p class="btn btn-primary my-3" @click="addSection">
                    <i class="fa fa-plus"></i> Ajouter une séance</p>
            </div>

            <button class="btn btn-primary btn-block" type="submit">Submit</button>
        </form>

    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'

    export default {
        name: "NewCourse",
        data() {
            return {
                course: {
                    category_id: '',
                    name: '',
                    short_description: '',
                    description: '',
                    image: '',
                    language: '',
                    duration: '',
                    status: '',
                    type: '',
                    estimated_duration: '',
                    authorized_students: '',
                    join_after: '',
                    price: '',
                    available_from: '',
                    available_to: '',
                    sharable: '',
                },
                sections: [
                    {
                        title: '',
                        file: '',
                        description: '',
                    }
                ]
            }
        },
        methods: {
            ...mapActions(['fetchCategories']),
            sanitizeTitle: function (title) {
                var slug = "";
                // Change to lower case
                var titleLower = title.toLowerCase();
                // Letter "e"
                slug = titleLower.replace(/e|é|è|ẽ|ẻ|ẹ|ê|ế|ề|ễ|ể|ệ/gi, 'e');
                // Letter "a"
                slug = slug.replace(/a|á|à|ã|ả|ạ|ă|ắ|ằ|ẵ|ẳ|ặ|â|ấ|ầ|ẫ|ẩ|ậ/gi, 'a');
                // Letter "o"
                slug = slug.replace(/o|ó|ò|õ|ỏ|ọ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ/gi, 'o');
                // Letter "u"
                slug = slug.replace(/u|ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ữ|ử|ự/gi, 'u');
                // Letter "d"
                slug = slug.replace(/đ/gi, 'd');
                slug = slug.replace(/,/gi, '-');
                // Trim the last whitespace
                slug = slug.replace(/\s*$/g, '');
                // Change whitespace to "-"
                slug = slug.replace(/\s+/g, '-');
                return slug;
            },
            saveCourse() {
                const token = localStorage.getItem('token') || null;
                if (token) {
                    // this.$store.dispatch("saveSection", this.section)
                    const formData = new FormData();
                    const imagefile = document.querySelector('#thumbnail');
                    formData.append("image", imagefile.files[0]);
                    formData.append("category_id", this.course.category_id);
                    formData.append("name", this.course.name);
                    formData.append("short_description", this.course.short_description);
                    formData.append("description", this.course.description);
                    formData.append("slug", sanitizeTitle(this.course.name));
                    formData.append("language", this.course.language);
                    formData.append("status", this.course.status);
                    formData.append("type", this.course.type);
                    formData.append("estimated_duration", this.course.estimated_duration);
                    formData.append("authorized_students", this.course.authorized_students);
                    formData.append("join_after", this.course.join_after);
                    formData.append("price", this.course.price);
                    formData.append("available_from", this.course.available_from);
                    formData.append("available_to", this.course.available_to);
                    formData.append("sharable", this.course.sharable);
                    formData.append("published", this.course.published);
                    axios.post('https://instantclass.herokuapp.com/api/courses/sections', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'Authorization': 'Bearer ' + token,
                        }
                    }).then(res => console.log(res))
                        .catch(err => console.log(err.response));
                    console.log(this.section);
                }
            },
            addSection() {
                this.sections.push({
                    course_id: '',
                    file: '',
                    description: '',
                })
            },
        },
        computed: mapGetters(["allCategories"]),
        created() {
            this.fetchCategories()
        }
    }
</script>

<style scoped>

</style>
