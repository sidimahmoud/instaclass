<template>
    <div>
        <section class="hero pt-5">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-md-4"></div>
                    <div class="col-md-8 text-center pt-md-5">
                        <h1 class="font-weight-bolder text-center">
                            ALL COURSES <br><br>
                            WHAT WE OFFER
                        </h1></div>
                </div>

            </div>

        </section>
        <div class="text-center text-primary" v-if="loading">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div v-if="!loading">
            <div class="text-center my-3">
                <h2><strong>SELECT YOUR COURSE TODAY</strong></h2>
                <p class="w-50 m-auto">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium assumenda dolorum ea earum
                    eius est illo, minima molestiae, omnis quo rem tempore voluptates. Eius nisi quia recusandae rem
                    veritatis voluptate?
                </p>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 border-right border-primary filter">
                        <div>
                            <strong>Category</strong>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">All Categories</label>
                            <select multiple class="form-control" id="exampleFormControlSelect2">
                                <option v-for="c in allCategories">{{c.name_en}}</option>
                            </select>
                        </div>
                        <hr>
                        <strong>Price</strong>
                        <div>
                            <label for="price">$0</label>
                            <input type="range" id="price" name="price"
                                   min="0" max="10" value="3" style="width: 60%">
                            <label for="price">1000$</label>
                        </div>
                    </div>
                    <div class="col-md-10 courses">
                        <course v-for="c in allCourses.data" :key="c.id" :course="c"/>
                    </div>


                    <nav aria-label="Page navigation example" v-if="allCourses.data.length>16">
                        <ul class="pagination justify-content-end">
                            <li :class="['page-item', {'disabled':!allCourses.prev_page_url}]">
                                <a class="page-link " href="#" @click="first">
                                    First
                                </a>
                            </li>
                            <li :class="['page-item', {'disabled':!allCourses.prev_page_url}]">
                                <a class="page-link " href="#" @click="previous">
                                    <<
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

    export default {
        name: 'Courses',
        components: {
            Course
        },
        data() {
            return {
                curPage: 1,
            }

        },
        methods: {
            ...mapActions(["fetchCategories"]),
            fetchCourses() {
                this.$store.dispatch('fetchCourses', this.curPage)
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
            }

        },
        computed: mapGetters(["allCourses", "loading", "allCategories"]),
        created() {
            this.fetchCourses();
            this.fetchCategories();
        }
    }
</script>

<style scoped lang="scss">
    .hero {
        background: linear-gradient(rgba(19, 19, 19, 0.3), rgba(19, 19, 19, 0.3)), url('../../assets/images/all1.jpg') no-repeat center center;
        height: 70vh;
        background-size: cover;
        border-bottom: 15px solid #3081FB;
        color: white;
    }

    .filter {
        border-radius: 15px;
        background: linear-gradient(90deg,
            rgb(0, 0, 0, 0.2),
            rgb(255, 255, 255, 1));
        font-weight: 800 !important;
    }

    .courses {
        border-radius: 5%;
    }
</style>
