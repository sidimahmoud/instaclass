<template>
    <div>
        <section class="hero pt-5">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-md-4"></div>
                    <div class="col-md-8 text-center pt-md-5"></div>
                </div>
            </div>
        </section>
        <div>
            <div class="text-center my-3">
                <h2><strong>{{$t('courses.title')}}</strong></h2>
                <p class="w-50 m-auto">
                    {{$t('courses.slug')}}
                </p>
            </div>
            <div class="container-fluid">
                <div class="row pb-3">
                    <div class="col-md-2 border-right border-primary filter">
                        <div class="border-bottom border-dark">
                            <p class="filter-title">
                                <strong>{{$t('courses.category')}}</strong>
                            </p>
                            <div class="form-group">
                                <select multiple class="form-control" id="exampleFormControlSelect2"
                                        @change="handleCategorie">
                                    <option value="">{{$t('courses.all')}}</option>
                                    <option v-for="c in allCategories" :value="c.id" v-bind:key="c.id">{{c.name_en}}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="border-bottom border-dark ">
                            <p class="filter-title">
                                <strong>{{$t('courses.price')}}</strong>
                            </p>
                            <label for="price">$0</label>
                            <input type="range" id="price" name="price" class="mx-auto"
                                   min="0" max="1000" value="1000" style="width: 60%" @change="price">
                            <label for="price">${{filter.price}}</label>
                        </div>
                        <div class="border-bottom border-dark">
                            <p class="filter-title">
                                <strong>{{$t('courses.courseLang')}}</strong>
                            </p>
                            <div class="form-group">
                                <select multiple class="form-control" id="lang" @change="handleLang">
                                    <option value="">{{$t('courses.all')}}</option>
                                    <option value="EN">ENGLISH</option>
                                    <option value="FR">FRENCH</option>
                                    <option value="ES">SPANISH</option>
                                    <option value="">OTHER</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <p class="filter-title">
                                <strong>{{$t('courses.sessionsPer')}}</strong>
                            </p>
                            <div class="form-group">
                                <select multiple class="form-control" id="sessions" @change="handleSectionCount">
                                    <option value="">{{$t('courses.all')}}</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-10 align-items-center" v-if="loading">
                        <div class="text-center text-primary">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 courses" v-if="!loading">
                        <course v-for="c in allCourses.data" :key="c.id" :course="c"/>
                    </div>
                    <nav aria-label="Page navigation example"
                         v-if="!isEmpty(allCourses.data) && allCourses.data.length>16">
                        <ul class="pagination justify-content-end">
                            <li :class="['page-item', {'disabled':!allCourses.prev_page_url}]">
                                <a class="page-link " href="#" @click="first">
                                    First
                                </a>
                            </li>
                            <li :class="['page-item', {'disabled':!allCourses.prev_page_url}]">
                                <a class="page-link " href="#" @click="previous">
                                </a>
                            </li>

                            <li class="page-item"><a class="page-link" href="#">{{allCourses.current_page}} of
                                {{allCourses.last_page}}</a></li>

                            <li :class="['page-item', {'disabled':!allCourses.next_page_url}]">
                                <a class="page-link" href="#" @click="next">
                                    >>
                                </a>
                            </li>
                            <li :class="['page-item', {'disabled':!allCourses.next_page_url}]">
                                <a class="page-link" href="#" @click="last(allCourses.last_page)">
                                    last
                                </a>
                            </li>
                        </ul>
                    </nav>

                </div>
            </div>


        </div>
    </div>

</template>

<script>
    import Course from "./CourseComponent";
    import {mapGetters, mapActions} from "vuex";
    import {isEmpty} from "../../helpers/common"

    export default {
        name: 'Courses',
        /*
        |--------------------------------------------------------------------------
        | Component > components
        |--------------------------------------------------------------------------
        */
        components: {
            Course,
            // VueSlider
        }, // End of Component > components
        /*
        |--------------------------------------------------------------------------
        | Component > data
        |--------------------------------------------------------------------------
        */
        data() {
            return {
                value: 0,
                curPage: 1,
                filter: {
                    price: 1000,
                    categ: '',
                    lang: '',
                    sections: ''
                }
            }

        },// End of Component > data
        /*
        |--------------------------------------------------------------------------
        | Component > computed
        |--------------------------------------------------------------------------
        */
        computed: {
            ...mapGetters(["allCourses", "loading", "allCategories"]),
        },// End of Component > computed
        /*
        |--------------------------------------------------------------------------
        | Component > methods
        |--------------------------------------------------------------------------
        */
        methods: {
            ...mapActions(["fetchCategories"]),
            fetchCourses(payload) {
                this.$store.dispatch('fetchCourses', payload)
            },
            first() {
                this.curPage = 1;
                this.fetchCourses();
            },
            next() {
                this.curPage++;
                this.fetchCourses();
            },
            previous() {
                this.curPage--;
                this.fetchCourses();
            },
            last(n) {
                console.log(n);
                this.curPage = n;
                this.fetchCourses();
            },

            // filter methods
            handleCategorie(event) {
                let payload = {
                    'filter[sub_category_id]': event.target.value
                }
                this.fetchCourses(payload)
            },
            price(event) {
                /* console.log(event.target.value)
                this.filter.price = event.target.value;
                this.fetchCourses() */
                this.filter.price = event.target.value;
                let payload = {
                    'filter[price_less_than]': event.target.value
                }
                this.fetchCourses(payload)
            },
            handleLang(event) {
                let payload = {
                    'filter[language]': event.target.value
                }
                this.fetchCourses(payload)
            },
            isEmpty(v) {
                return isEmpty(v);
            },
            handleSectionCount(event) {
                let payload = {
                    'filter[section_count]': event.target.value
                }
                this.fetchCourses(payload)
            },

        },// End of Component > methods
        /*
        |--------------------------------------------------------------------------
        | Component > created
        |--------------------------------------------------------------------------
        */
        mounted() {
            this.fetchCourses();
            this.fetchCategories();
        }// End of Component > created
    }
</script>

<style scoped lang="scss">
    .hero {
        background: linear-gradient(rgba(19, 19, 19, 0.3), rgba(19, 19, 19, 0.3)), url('../../assets/images/all2.jpg') no-repeat center center;
        height: 70vh;
        background-size: cover;
        border-bottom: 15px solid #3081FB;
        color: white;
    }

    .filter {
        border-radius: 0 5px 10px 0;
        background: #eee;
        font-weight: 800 !important;
    }

    .courses {
        border-radius: 1%;
    }

    @media (max-width: 600px) {
        .hero {
            background: linear-gradient(rgba(19, 19, 19, 0.3), rgba(19, 19, 19, 0.3)), url('../../assets/images/all1.jpg') no-repeat center center;
            height: 65vh;
            background-size: cover;
            border-bottom: 15px solid #3081FB;
            color: white;
        }
    }
</style>
