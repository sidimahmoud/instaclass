<template>
    <div 
        v-loading="pageLoading"
        element-loading-text="Loading..."
        element-loading-spinner="el-icon-loading">
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
                <h5><strong>{{$t('courses.title')}}</strong></h5>
                <p v-if="!isEmpty(allCourses.data)">
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
                                        @change="handleCategorie" v-model="filter.categ">
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
                            <input type="range" id="price" v-model="filter.price" name="price" class="mx-auto"
                                   min="0" max="1000" value="1000" style="width: 60%" @change="price">
                            <label for="price">${{filter.price}}</label>
                        </div>
                        <div class="border-bottom border-dark">
                            <p class="filter-title">
                                <strong>{{$t('courses.courseLang')}}</strong>
                            </p>
                            <div class="form-group">
                                <select multiple class="form-control" v-model="filter.lang" id="lang" @change="handleLang">
                                    <option value="">{{$t('courses.all')}}</option>
                                    <option value="French">{{$t('demande.languages.fr')}}</option>
                                    <option value="English">{{$t('demande.languages.en')}}</option>
                                    <option value="Spanish">{{$t('demande.languages.es')}}</option>
                                    <option value="">OTHER</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <p class="filter-title">
                                <strong>{{$t('courses.sessionsPer')}}</strong>
                            </p>
                            <div class="form-group">
                                <select multiple class="form-control" v-model="filter.section" id="sessions" @change="handleSectionCount">
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
                        <template v-if="!isEmpty(allCourses.data)">
                            <course v-for="c in allCourses.data" :key="c.id" :course="c"/>
                            <div class="text-center list-pagination" v-if="!isEmpty(allCourses.data)">
                                <el-pagination
                                    :page-size="5"
                                    :page-count="allCourses.total_pages"
                                    layout="prev, pager, next"
                                    :total="allCourses.total"
                                    :current-page="allCourses.current_page"
                                    @current-change="reloadList">
                                </el-pagination>
                            </div>
                        </template>
                        <template v-else>
                            <div class="text-center">
                                {{$t('courses.no_courses')}}
                            </div>
                        </template>
                    </div>
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
                    categ: [],
                    lang: [],
                    section: []
                },
                pageLoading: false
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
            reloadList(n){
                this.pageLoading = true
                let payload = {
                    'page': n,
                    'filter[section_count]': this.filter.section,
                    'filter[price_less_than]': this.filter.price,
                    'filter[sub_category_id]': this.filter.categ,
                    'filter[language]': this.filter.lang
                }
                this.fetchCourses(payload);
                setTimeout(() => {
                    this.pageLoading = false
                },500)  
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
        height: 50vh;
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
            height: 30vh;
            background-size: cover;
            border-bottom: 15px solid #3081FB;
            color: white;
        }
    }
</style>
