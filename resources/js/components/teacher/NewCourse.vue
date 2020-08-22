<template>
    <div class="container rounded mb-4">

        <h3 class="text-center">Submit new course</h3>
        <form class="my-3" method="post" @click.prevent="saveCourse">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="selectLang">Select category</label>
                        <select class="form-control" id="selectLang" v-model="course.category_id" required>
                            <option v-for="c in allCategories" :key="c.id" :value="c.id">{{c.name}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">course language</label>
                        <select class="form-control" id="exampleFormControlSelect1" required>
                            <option>EN</option>
                            <option>FR</option>
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
                               placeholder="Duration" v-model="course.duration" required>
                    </div>
                </div>
                <div class="col-md-4" v-if="course.type==2">
                    <div class="form-group">
                        <label for="persons">Number of authorized students</label>
                        <input type="number" min="1" class="form-control" id="persons"
                               placeholder="authorized students" required>
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
                        <select class="form-control" id="partage" required>
                            <option value="2">Instantavite peut le partager</option>
                            <option value="1">Tout le monde</option>
                            <option value="0">Je n'autorise pas</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="short_desc">Short description</label>
                <input type="text" class="form-control" id="short_desc"
                       placeholder="Short description" v-model="course.short_description" required>
            </div>
            <div class="form-group">
                <label for="desc">Course description</label>
                <textarea class="form-control" id="desc" rows="3" v-model="course.description" required> </textarea>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="seances">Nombre de séance</label>
                        <input type="number" min="1" value="1" class="form-control" id="seances"
                               v-model="course.sections" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="Thumbnail">Thumbnail</label>
                        <input type="file" class="form-control-file" id="Thumbnail">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="section1">Section 1</label>
                        <input type="file" class="form-control-file" id="section1" required>
                    </div>
                </div>
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
                    sections: 1,
                    section_1: '',
                    name: '',
                    short_description: '',
                    description: '',
                    image: '',
                    slug: '',
                    category_id: 1,
                    language: '',
                    duration: '',
                    status: '1',
                    type: '1',
                    price: '',
                }
            }
        },
        methods: {
            ...mapActions(['fetchCategories']),
            saveCourse() {
                console.log(this.course)
            }
        },
        computed: mapGetters(["allCategories"]),
        created() {
            this.fetchCategories()
        }

    }
</script>

<style scoped>

</style>
