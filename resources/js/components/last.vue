<template>
    <div>
        <section class="hero pt-5">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-md-4"></div>
                    <div class="col-md-8 text-center pt-md-5">
                        <h1 class="font-weight-bolder display-2 text-center">
                            ALL COURSES <br>
                            WHAT WE OFFER
                        </h1></div>
                </div>

            </div>

        </section>
        <div class="container pt-5 border-top border-primary">
            <div class="text-center text-primary" v-if="loading">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div v-if="!loading">
                <div class="row">
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
        computed: mapGetters(["allCourses", "loading"]),
        created() {
            this.fetchCourses();
        }
    }
</script>

<style scoped>
    .hero {
        background: linear-gradient(rgba(19, 19, 19, 0.3), rgba(19, 19, 19, 0.3)), url('../../assets/images/all.jpg') no-repeat center center;
        height: 70vh;
        background-size: cover;
        border-bottom: 15px solid #3081FB;
        color: white;
    }
</style>
