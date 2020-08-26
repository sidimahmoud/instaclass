<template>
    <div class="container pt-5 border-top border-primary">
        <div class="text-center text-primary" v-if="loading">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div v-if="!loading">
            <course :course="c" v-for="c in allCourses.data" :key="c.id"/>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">

                    <li class="page-item " v-if="allCourses.prev_page_url">
                        <a class="page-link " href="#" @click="curPage=1" tabindex="-1">
                            First
                        </a>
                    </li>
                    <li class="page-item " v-if="allCourses.prev_page_url">
                        <a class="page-link " href="#" @click="previous" tabindex="-1">
                            <<
                        </a>
                    </li>

                    <li class="page-item"><a class="page-link" href="#">{{allCourses.current_page}} of {{allCourses.last_page}}</a></li>

                    <li class="page-item" v-if="allCourses.next_page_url">
                        <a class="page-link" href="#" @click="next" disabled="1">
                            >>
                        </a>
                    </li>
                    <li class="page-item" v-if="allCourses.next_page_url">
                        <a class="page-link" href="#" @click="curPage=allCourses.from" disabled="1">
                            last
                        </a>
                    </li>
                </ul>
            </nav>

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
                pagination:{},
            }

        },
        methods: {
            fetchCourses(){
                let $this = this;
                this.$store.dispatch('fetchCourses', this.curPage)
            },
            next(){
                this.curPage++;
                this.fetchCourses();
            },
            previous(){
                this.curPage--;
                this.fetchCourses();
            }
            // makePagination(data){
            //     this.pagination = {
            //         current_page: data.current_page,
            //         first_page_url: data.first_page_url,
            //         from: data.from,
            //         last_page_url: data.last_page_url,
            //         next_page_url: data.next_page_url,
            //         prev_page_url: data.prev_page_url,
            //     }
            // }
        },
        computed: mapGetters(["allCourses", "loading"]),
        created() {
            this.fetchCourses();
        }
    }
</script>

<style scoped>

</style>
