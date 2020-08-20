<template>
    <div class="container rounded mb-4">
        <div class="text-center mb-4">
            <a class="btn btn-primary" data-toggle="collapse" href="#collapseRecorded" role="button"
               aria-expanded="false" aria-controls="collapseRecorded">
                New Course
            </a>
            <a class="btn btn-primary" data-toggle="collapse" href="#collapsePayments" role="button"
               aria-expanded="false" aria-controls="collapsePayments">
                Payments
            </a>
            <a class="btn btn-primary" data-toggle="collapse" href="#collapseRecus" role="button"
               aria-expanded="false" aria-controls="collapseRecus">
                Reçus
            </a>
            <a class="btn btn-primary" data-toggle="collapse" href="#collapseEval" role="button"
               aria-expanded="false" aria-controls="collapseEval">
                Evaluations
            </a>
        </div>
        <div class="bg-white">
            <div class="collapse p-2" id="collapseRecorded">
                <h3 class="text-center">Submit recorded course</h3>
                <form class="my-3">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="selectLang">Select category</label>
                                <select class="form-control" id="selectLang" v-model="category_id">
                                    <option v-for="c in allCategories" :key="c.id" :value="c.id">{{c.name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">course language</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>EN</option>
                                    <option>FR</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" id="type" v-model="type">
                                    <option value="1">Recorded</option>
                                    <option value="2">Live</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" v-model="status">
                                    <option value="1">PUBLIC</option>
                                    <option value="2">PRIVATE</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4" v-if="status==2">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" id="price"
                                       placeholder="Price">
                            </div>
                        </div>
                        <div class="col-md-4" >
                            <div class="form-group">
                                <label for="duration">Duration</label>
                                <input type="text" class="form-control" id="duration"
                                       placeholder="Duration" v-model="duration">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Course name</label>
                                <input type="text" class="form-control" id="name"
                                       placeholder="Name" v-model="name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="short_desc">Short description</label>
                        <input type="text" class="form-control" id="short_desc"
                               placeholder="Short description" v-model="short_description">
                    </div>
                    <div class="form-group">
                        <label for="desc">Course description</label>
                        <textarea class="form-control" id="desc" rows="3" v-model="description"> </textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="seances">Nombre de séance</label>
                                <input type="number" min="1" value="1" class="form-control" id="seances" v-model="sections">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Thumbnail">Thumbnail</label>
                                <input type="file" class="form-control-file" id="Thumbnail" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="section1">Section 1</label>
                                <input type="file" class="form-control-file" id="section1" >
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
            <div class="collapse p-2" id="collapsePayments">
                <div>
                    <h3>Payments</h3>
                </div>
            </div>
            <div class="collapse p-2" id="collapseRecus">
                <div>
                    <h3>Reçus</h3>
                </div>
            </div>
            <div class="collapse p-2" id="collapseEval">
                <div>
                    <h3>Evaluations</h3>
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
        },
        methods: {
            ...mapActions(['fetchCategories'])
        },
        computed: mapGetters(["allCategories"]),
        created() {
            this.fetchCategories()
        }

    }
</script>

<style scoped>

</style>
