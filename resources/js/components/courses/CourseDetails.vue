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
                        <div class="col-md-8 text-center pt-md-5"></div>
                    </div>
                </div>
            </section>
            <div class="container-fluid bg-light mt-0 pt-3 pb-3 course-details-mobile">
                <div class="course-header mt-3">
                    <div class="row justify-content-around align-items-center pt-2 course-details-profile">
                        <div class="col-md-2 text-center">
                            <img :src="course.course.user.image" alt="Avatar"
                                 class="border profile-image avatar img-circle img-thumbnail">
                        </div>
                        <div class="col-md-4 ">
                            <div class="font-weight-bolder">
                                <h3>{{course.course.user.first_name}} {{course.course.user.last_name}}</h3>
                                <h4>{{course.course.user.languages}}</h4>
                                <div>
                                    {{course.course.user.about}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 pl-3">
                            {{$t('course.instructorRate')}} {{courseRate()}}  <i class="fa fa-star"></i><br>
                            <i class="fa fa-user  fa-2x mr-1"></i> 0 {{$t('course.students')}}

                        </div>
                        <div :class="[isLoggedIn && loggedInUser.t==='teacher' || isLoggedIn && loggedInUser.t==='admin' ? 'd-none' : '', 'col-md-3']">
                            <template v-if="!isEmpty(course.course.sections) && course.course.sections.length >= 2">
                                <router-link
                                :to="{ path:`/checkout/${course.course.id}`}"
                                tag="a" class="btn btn-primary my-3">
                                    {{$t('course.enroll_to_all')}}
                                </router-link>
                            </template>
                        </div>
                    </div>
                    <hr class="bg-dark mx-3">
                    <div class="col-md-12 course-info" v-if="course.course.sub_category">
                        <div>
                            {{$t('course.category')}} :
                            <router-link :to="{ name: 'CategCourses', params: { id: course.course.sub_category.category.id}}"
                                         tag="span" class="mr-2">
                                {{course.course.sub_category.category.name_en}}
                            </router-link>
                        </div>
                        <div>{{$t('course.subCat')}} : {{ lang == "en" ? course.course.sub_category.name_en : course.course.sub_category.name_fr}}</div>
                        <div>{{$t('course.sessions')}}: {{course.course.sections.length}}</div>
                        <div>{{$t('course.lang')}} : {{$t(course.course.language)}}</div>
                        <div>{{$t('course.price')}}: <span v-if="course.course.price===0">{{$t('free')}}</span> <span
                            v-if="course.course.price!=0">{{course.course.price}}$</span></div>
                    </div>
                </div>

                <div class="text-center my-5" v-if="course.course.sections.length===0">
                    <h3>{{$t('courseDetails.title')}}</h3>
                </div>
                <div v-else>
                    <div class="row justify-content-around align-items-center shadow-sm course-det px-0 my-2"
                         v-for="(section, index) in course.course.sections"
                         :key="section.id">
                        <div class="col-12 text-center">
                            <h2 class="text-left"><strong>{{$t('course.session')}} N°:{{index+1}}</strong></h2>
                        </div>
                        <div class="col-md-8">
                            <h3><strong>{{section.title}}</strong></h3>
                            <p v-html="section.description"></p>
                            <p>{{$t('course.duration')}}: {{section.duration}} h</p>
                            <p>
                                {{$t('course.scheduledAt')}} : {{section.startDate.slice(0,10)}} Hour: {{section.startDate.slice(11,16)}} {{section.timezone}}
                            </p>
                        </div>
                        <div :class="[isLoggedIn && loggedInUser.t==='teacher' || isLoggedIn && loggedInUser.t==='admin' ? 'd-none' : '', 'col-md-3']">
                            <router-link
                                :to="{ path:`/checkout/${course.course.id}`, query: {s: section.id,}}"
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
    import {isEmpty} from "../../helpers/common"

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
            },
            courseRate(){
                let sum = 0;
                this.course.ratings.map(rating=>{
                    sum += rating.rate
                })
                //return parseInt(sum/this.course.ratings.length, 10)
                return 0;
            },
            isEmpty(v) {
                return isEmpty(v);
            }
        },
        computed: mapGetters(["course", "loading", "enrolled", 'isLoggedIn', 'loggedInUser', "lang"]),
        created() {
            this.findCourse();
        },

    }

</script>

<style scoped lang="scss">

    .hero {
        background: linear-gradient(rgba(19, 19, 19, 0.3), rgba(19, 19, 19, 0.3)), url('../../assets/images/details/bg1.png') no-repeat center center;
        height: 50vh;
        background-size: contain;
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
       /*  background: linear-gradient(90deg,
            rgba(10, 10, 10, 0.2),
            rgb(255, 255, 255, 0.9)); */
        background-color: #fff;
        font-weight: 800 !important;

        .fa {
            color: orange;
        }

        .course-info {
            //background: url('../../assets/images/pngtree.png') no-repeat right center;
            background-size: contain;
            background-color: #fff;
            padding: 20px;
        }
    }

    .course-det {
        margin: 10px;
        margin-top: 0;
        background-color: #fff;
        /* background: linear-gradient(90deg,
            rgb(189, 189, 189), rgba(255, 255, 255, 0.9)); */
        font-weight: 800 !important;
        border-right: 2px solid #2b63f3;
        /*box-shadow: 2px 2px 7px 5px rgba(0,0,0,0.39);*/

    }

    @media (max-width: 600px) {
        .hero {
            background: linear-gradient(rgba(19, 19, 19, 0.3), rgba(19, 19, 19, 0.3)), url('../../assets/images/details1.jpg') no-repeat center center;
            height: 40vh;
            background-size: contain;
            border-bottom: 15px solid #3081FB;
            color: white;
        }
        .course-details-mobile {
            width: 100%;
            padding: 5px;
        }
        .course-details-profile {
            padding: 10px;
        }
    }
</style>
