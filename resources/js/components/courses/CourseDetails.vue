<template>
    <div class="pb-5 ">
        <div class="text-center text-primary pt-5 mt-5" v-if="loading">
            <div class="spinner-border pt-5" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div v-if="!loading">
            <section class="hero pt-5">
                <div class="container h-100">
                    <div class="row h-100 align-content-center">
                        <div class="col-md-4"></div>
                        <div class="col-md-8 text-center pt-md-5">
                            <h1 class="font-weight-bolder text-uppercase text-center">
                                {{$t('courseDetails.hero')}}
                            </h1>
                        </div>
                    </div>
                </div>
            </section>
            <div class="container-fluid">
                <div class="course-header">
                    <div class="row justify-content-around align-items-center pt-2">
                        <div class="col-md-2 text-center">
                            <img :src="course.user.image" width="80px" height="80px" alt="Avatar"
                                 class="border rounded-circle">
                        </div>
                        <div class="col-md-4 ">
                            <div class="font-weight-bolder">
                                <h3>{{course.user.first_name}} {{course.user.first_name}}</h3>
                                <div>
                                    {{course.user.city}}, {{course.user.country}}
                                </div>
                                <div>
                                    {{course.user.languages}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 pl-3">
                            <i class="fa fa-star  fa-2x"></i> {{course.user.ratings.length}} {{$t('course.instructorRate')}} <br>
                            <i class="fa fa-user  fa-2x mr-1"></i> 0 {{$t('course.students')}}

                        </div>
                        <div :class="[isLoggedIn && loggedInUser.t==='teacher' || isLoggedIn && loggedInUser.t==='admin' ? 'd-none' : '', 'col-md-3']">
                            <router-link
                                :to="{ name: 'Checkout', params: {id: course.id, name: course.name, price: course.price}}"
                                tag="a" class="btn btn-primary my-3">
                                S'inscrire à tout les séances
                            </router-link>
                            <!-- <router-link
                                :to="{ name: 'Checkout', params: {id: course.id, name: course.name, price: course.price}}"
                                tag="a" class="btn btn-primary my-3" v-if="!enrolled">
                                {{$t('course.enroll')}}
                            </router-link>
                            <router-link :to="{name: 'StudentProfile'}" tag="a" class="btn btn-primary my-3"
                                         v-if="enrolled">
                                Deja inscrit
                            </router-link> -->
                        </div>
                    </div>
                    <hr class="bg-dark mx-3">
                    <div class="col-md-12 course-info" v-if="course.sub_category">
                        <div>
                            {{$t('course.category')}} :
                            <router-link :to="{ name: 'CategCourses', params: { id: course.sub_category.category.id}}"
                                         tag="span" class="mr-2">
                                {{course.sub_category.category.name_en}}
                            </router-link>
                        </div>
                        <div>{{$t('course.subCat')}} : {{course.sub_category.name_en}}</div>
                        <div>{{$t('course.sessions')}}: {{course.sections.length}}</div>
                        <div>{{$t('course.lang')}} : {{course.language}}</div>
                        <div>{{$t('course.price')}}: {{currencyToSymbol(course.currency)}}{{course.price}}/{{$t('course.session')}}</div>
                    </div>
                </div>

                <div class="text-center my-5" v-if="course.sections.length===0">
                    <h3>{{$t('courseDetails.title')}}</h3>
                </div>
                <div v-else>
                    <div class="row justify-content-around align-items-center shadow-sm course-det px-0 my-2"
                         v-for="(section, index) in course.sections"
                         :key="section.id">
                        <div class="col-12 text-center">
                            <h2 class="text-left"><strong>{{$t('course.session')}} N°:{{index+1}}</strong></h2>
                        </div>
                        <div class="col-md-8">
                            <h3><strong>{{section.title}}</strong></h3>
                            <p>{{section.description}}</p>
                            <p>
                                {{$t('course.scheduledAt')}} : {{section.startDate.slice(0,10)}} Hour: {{section.startDate.slice(11,16)}} {{section.timezone}}
                            </p>
                        </div>
                        <div :class="[isLoggedIn && loggedInUser.t==='teacher' || isLoggedIn && loggedInUser.t==='admin' ? 'd-none' : '', 'col-md-3']">
                            <router-link
                                :to="{ name: 'BuyOneSection', params: {id: section.id, name: section.title, price: course.price}}"
                                tag="a" class="btn btn-primary my-3" v-if="!enrolled">
                                {{$t('course.enrollInSession')}}
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
            currencyToSymbol(currency) {
                switch (currency) {
                    case 'usd' :
                        return '$';
                    case 'eur':
                        return '€';
                    default:
                        return currency
                }
            }
        },
        computed: mapGetters(["course", "loading", "enrolled", 'isLoggedIn', 'loggedInUser']),
        created() {
            this.findCourse();
        },

    }

</script>

<style scoped lang="scss">

    .hero {
        background: linear-gradient(rgba(19, 19, 19, 0.3), rgba(19, 19, 19, 0.3)), url('../../assets/images/details.jpg') no-repeat center center;
        height: 60vh;
        background-size: cover;
        border-bottom: 15px solid #3081FB;
        color: white;
    }

    .rounded-pill {
        border-radius: 50rem !important;
    }

    .course-header {
        border-radius: 15px 15px 0 0;
        margin: 10px;
        margin-bottom: 0;
        background: linear-gradient(90deg,
            rgba(10, 10, 10, 0.2),
            rgb(255, 255, 255, 0.9));
        font-weight: 800 !important;

        .fa {
            color: yellow;
        }

        .course-info {
            background: url('../../assets/images/pngtree.png') no-repeat right center;
            background-size: contain;
            padding: 20px;
        }
    }

    .course-det {
        margin: 10px;
        margin-top: 0;
        background: linear-gradient(90deg,
            rgb(189, 189, 189), rgba(255, 255, 255, 0.9));
        font-weight: 800 !important;
        border-right: 2px solid #2b63f3;
        /*box-shadow: 2px 2px 7px 5px rgba(0,0,0,0.39);*/

    }
</style>
