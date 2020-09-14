<template>
    <div>
        <div class="text-center text-primary" v-if="loading">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div v-if="!loading">
            <!--            blue band-->
            <div class="jumbotron"></div>
            <!--/            blue band-->
            <!--            Course header-->
            <div class="container bg-white">
                <div class="row justify-content-around align-items-center border-bottom border-primary">
                    <div class="col-md-2 text-center">
                        <img :src="course.user.image" width="80px" alt="Avatar">
                        <br>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                    </div>
                    <div class="col-md-3">
                        <div class="font-weight-bolder">
                            {{course.user.first_name}}
                        </div>
                        <div>
                            {{course.user.city}},{{course.user.country}}
                        </div>
                        <div v-if="course.user.languages">
                            Spoken languages: {{course.user.languages}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <a href="https://www.facebook.com/sharer/sharer.php?s=100&p[url]=https://www.instantclass.herokuapp.com/courses&p[images][0]=&p[title]=Title%20Goes%20Here&p[summary]=Description%20goes%20here!">
                            <img src="../../assets/images/fb.png" alt="fb" width="150px">
                            <i class="fa fa-thumbs-up fa-2x text-primary"></i>

                        </a> <br>
                        <!--                        <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&width=117&layout=button_count&action=like&size=large&share=false&height=21&appId=223985172274465" width="117" height="21" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>-->
                    </div>
                    <div class="col-md-2">
                        <a href="#"> <img src="../../assets/images/insta.png" alt="insta" width="150px"></a>

                        <!--                        <a href="https://www.facebook.com/sharer/sharer.php?s=100&p[url]=https://www.instantclass.herokuapp.com&p[images][0]=&p[title]=Title%20Goes%20Here&p[summary]=Description%20goes%20here!"-->
                        <!--                           target="_blank"-->
                        <!--                           onclick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=250'); return false">-->
                        <!--                            <button type="button"-->
                        <!--                                    class="btn btn-facebook "><i class="fa fa-facebook fa-2"></i>-->
                        <!--                                <i class="fa fa-share-alt"></i>-->
                        <!--                            </button>-->
                        <!--                        </a>-->
                        <!--                        <a href="#" target="_blank">-->
                        <!--                            <button type="button" class="btn btn-instagram ">-->
                        <!--                                <i class="fa fa-instagram"/>-->
                        <!--                                <i class="fa fa-share-alt"></i>-->
                        <!--                            </button>-->
                        <!--                        </a>-->
                    </div>
                    <div class="col-md-2">
                        <router-link
                            :to="{ name: 'Checkout', params: {id: course.id, name: course.name, price: course.price}}"
                            tag="a" class="btn btn-primary my-3" v-if="!enrolled">
                            S'inscrire à tout les séances
                        </router-link>
                        <router-link :to="{name: 'StudentProfile'}" tag="a" class="btn btn-primary my-3" v-if="enrolled">
                            Deja inscrit
                        </router-link>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-4" v-if="course.sub_category">
                        Category:
                        <router-link :to="{ name: 'CategCourses', params: { id: course.sub_category.category.id}}"
                                     tag="a" class="mr-2 text-primary">
                            <strong>{{course.sub_category.category.name}}</strong>
                        </router-link>
                        Sub-category : {{course.sub_category.name}}
                    </div>
                    <div class="col-md-3">Sessions: {{course.sections.length}}</div>
                    <div class="col-md-2">Language : {{course.language}}</div>
                    <div class="col-md-3">Price: ${{course.price}}/session</div>
                </div>
                <div class="text-center my-3" v-if="course.sections.length===0">
                    <h3>This first course will be available soon...</h3>
                </div>
                <div v-else>
                    <div class="row justify-content-around align-items-center shadow-sm"
                         v-for="section in course.sections"
                         :key="section.id">
                        <div class="col-md-9">
                            <h4>{{section.title}}</h4>
                            <p>{{section.description}}</p>
                            <p>
                                Availabilities : {{section.startDate}}
                            </p>
                        </div>
                        <div class="col-md-1 d-none -d-md-flex"></div>
                        <div class="col-md-2">
                            <router-link :to="{ name: 'Checkout', params: {id: course.id, name: course.name, price: course.price}}"
                                tag="a" class="btn btn-primary my-3" v-if="!enrolled">
                                S'inscrire
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    import {mapGetters} from "vuex";
    import Review from "./Review";

    export default {
        name: 'Detail',
        components: {Review},
        methods: {
            findCourse() {
                this.$store.dispatch('getCourse', this.$route.params.slug)
            },
        },
        computed: mapGetters(["course", "loading", "enrolled", 'isLoggedIn']),
        created() {
            this.findCourse();
        },

    }

</script>

<style scoped lang="scss">
    .jumbotron {
        background-image: url('../../assets/images/details/bg.png');
        border-radius: 0;
        height: 50px;
        padding: 0;

    }

    .rounded-pill {
        border-radius: 50rem !important;
    }

    .btn-facebook {
        text-decoration: none;
        color: #4C67A1;
        transition: all .2s ease-in-out;


        &:hover {
            background: linear-gradient(to right, #4C67A1 0%, #0389a1 100%);
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.10);


            i {
                color: #ffffff;
            }
        }


    }

    .btn-instagram {
        text-decoration: none;
        color: #C71E7E;
        transition: all .2s ease-in-out;


        &:hover {
            background: linear-gradient(to right, #ff3019 0%, #c90477 100%);
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.10);

            i {
                color: #ffffff;
            }
        }

    }

</style>
