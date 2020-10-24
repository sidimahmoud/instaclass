<template>
    <div>
        <div class="text-center text-primary" v-if="loading">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div v-if="!loading">
            <section class="hero pt-5">
                <div class="container h-100">
                    <div class="row h-100">
                        <div class="col-md-4"></div>
                        <div class="col-md-8 text-center pt-md-5">
                            <h1 class="font-weight-bolder display-2 text-uppercase text-center">
                                Available Courses
                            </h1></div>
                    </div>

                </div>

            </section>

            <div class="container">
                <div class="course-header">
                    <div class="row justify-content-around align-items-center pt-2">
                        <div class="col-md-2 text-center">
                            <img :src="course.user.image" width="80px" height="80px" alt="Avatar"
                                 class="border rounded-circle">
                        </div>
                        <div class="col-md-4">
                            <div class="font-weight-bolder">
                                <h3>{{course.user.first_name}} {{course.user.first_name}}</h3>
                                {{course.user.city}},{{course.user.country}}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <i class="fa fa-star  fa-2x"></i> 0 Instructor rating <br>
                            <i class="fa fa-user  fa-2x mr-1"></i> 0 Students

                        </div>
                        <div class="col-md-3">
                            <router-link
                                :to="{ name: 'Checkout', params: {id: course.id, name: course.name, price: course.price}}"
                                tag="a" class="btn btn-primary my-3" v-if="!enrolled">
                                S'inscrire à tout les séances
                            </router-link>
                            <router-link :to="{name: 'StudentProfile'}" tag="a" class="btn btn-primary my-3"
                                         v-if="enrolled">
                                Deja inscrit
                            </router-link>
                        </div>
                    </div>
                    <hr class="bg-dark mx-3">
                    <div class="col-md-12 course-info" v-if="course.sub_category">
                        <div>
                            Category :
                            <router-link :to="{ name: 'CategCourses', params: { id: course.sub_category.category.id}}"
                                         tag="a" class="mr-2">
                                {{course.sub_category.category.name_en}}
                            </router-link>
                        </div>
                        <div>Sub-category : {{course.sub_category.name_en}}</div>
                        <div>Sessions: {{course.sections.length}}</div>
                        <div>Language : {{course.language}}</div>
                        <div>Price: ${{course.price}}/session</div>
                    </div>
                </div>

                <div class="text-center my-3" v-if="course.sections.length===0">
                    <h3>This first course will be available soon...</h3>
                </div>
                <div v-else>
                    <div class="row justify-content-around align-items-center shadow-sm course-det"
                         v-for="(section, index) in course.sections"
                         :key="section.id">
                        <div class="col-12 text-center">
                            <h2><strong>Session : {{index+1}}</strong></h2>
                        </div>
                        <div class="col-md-9">
                            <h2><strong>{{section.title}}</strong></h2>
                            <p>{{section.description}}</p>
                            <p>
                                Availabilities : {{section.startDate}}
                            </p>
                        </div>
                        <div class="col-md-1 d-none -d-md-flex"></div>
                        <div class="col-md-2">
                            <router-link
                                :to="{ name: 'BuyOneSection', params: {id: section.id, name: section.title, price: course.price}}"
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
    .hero {
        background: linear-gradient(rgba(19, 19, 19, 0.3), rgba(19, 19, 19, 0.3)), url('../../assets/images/details.jpg') no-repeat center center;
        height: 100vh;
        background-size: cover;
        border-bottom: 15px solid #3081FB;
        color: white;
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

    .course-header {
        border-radius: 15px;
        margin: 10px;
        background: linear-gradient(90deg,
            rgb(0, 0, 0, 0.5),
            rgb(255, 255, 255, 0.5)),
        url('../../assets/images/teaprofile/down1.png') no-repeat right center;
        background-size: contain;
        font-weight: 800 !important;

        .fa {
            color: yellow;
        }
    }

    .course-det {
        border-radius: 15px;
        margin: 10px;
        background: linear-gradient(90deg,
            rgb(0, 0, 0, 0.5),
            rgb(255, 255, 255, 1));
        font-weight: 800 !important;
        border-right: 2px solid #2b63f3;
    }


</style>
