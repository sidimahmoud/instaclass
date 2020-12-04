<template>
    <div>
        <div>
            <div class="row justify-content-around align-items-center shadow-sm course-det p-1 py-3">
                <div class="col-md-2 categ-img" :style="{
                  backgroundImage: 'url(' + course.sub_category.category.image + ')',
                  backgroundSize: 'cover',
                  backgroundRepeat: 'no-repeat',
                  height: '115px',
                  padding: '0',
                  border: '1px solid black',
                  borderRadius: '20px'
                }"></div>
                <div class="col-md-6">
                    <strong>{{$t('courses.categorie')}}: </strong> {{lang == "en" ? course.sub_category.category.name_en : course.sub_category.category.name_fr}} <br>
                    <strong>{{$t('course.sessions')}}: </strong> {{course.sections.length}} <br>
                    <strong>{{$t('course.lang')}}: </strong> {{course.language}} <br>
                    <strong>{{$t('course.description')}}: </strong> {{course.short_description}} <br>
                </div>
                <div class="col-md-4 text-right">
                    <strong>{{$t('course.price')}}: </strong>
                    <span class="text-green" v-if="course.price==0">Free</span>
                    <span class="text-green" v-else>{{course.price}}$</span> <br/>
                    <div v-if="!isLoggedIn || isLoggedIn && loggedInUser.t==='student'">
                        <router-link
                            :to="{ path: `/checkout/${course.id}`}"
                            tag="button" class="btn btn-primary custom-class my-2">
                            {{$t('course.enroll_to_course')}}
                        </router-link>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row align-items-center text-center">
                        <div class="col-md-6 order-2 order-md-1" v-if="course.sharable">
                            <div class="fb-share-button" :data-href="'https://mondemenagement.ca/courses/'+course.id"
                                 data-layout="button" data-size="large">
                                <a target="_blank"
                                   :href="'https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Finstantaclasse.ca%2Fcourses%2F'+course.id+'&amp;src=sdkpreparse'"
                                   class="fb-xfbml-parse-ignore">
                                    <img src="../../assets/images/fbShare.png" width="70px" alt="">
                                    <!--<img src="../../assets/images/share.png" width="40px" alt="">-->
                                </a>
                                <!-- <a href="https://www.instagram.com/canada/?hl=en" target="_blank">
                                    <img
                                        src="../../assets/images/insta.png"
                                        alt="insta" class="rounded"
                                        width="73px" height="28">
                                </a> -->
                            </div>
                        </div>
                        <div class="col-md-6 mb-sm-2  order-1 order-md-2 text-right">
                            <router-link :to="{ name: 'Detail', params: { slug: course.id}}" tag="a"
                                         class="btn btn-warning custom-class  my-2">
                                {{$t('course.learnMore')}}
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--        <div class="col-md-4 col-sm-12 mb-2 shadow-lg">-->
        <!--            <div class="card">-->
        <!--                        <router-link :to="{ name: 'Detail', params: { slug: course.id}}" tag="a">-->
        <!--                            <img class="card-img-top" :src="course.image">-->
        <!--                        </router-link>-->
        <!--                <div class="card-body">-->
        <!--                    &lt;!&ndash;                        <h5 class="card-title">Card title</h5>&ndash;&gt;-->
        <!--                    <p class="card-text">-->
        <!--                        <strong>Category - </strong> {{course.sub_category.category.name_en}} <br>-->
        <!--                        <strong>Sub-category - </strong> {{course.sub_category.name_en}} <br>-->
        <!--                        <strong>Duration - </strong> {{course.estimated_duration}} <br>-->
        <!--                        <strong>Language - </strong> {{course.language}} <br>-->
        <!--                        <strong>Sessions - </strong> {{course.sections.length}} <br>-->
        <!--                        <strong>Price - </strong> ${{course.price}} <br>-->

        <!--                    </p>-->

        <!--                            <router-link-->
        <!--                                :to="{ name: 'Checkout', params: {id: course.id, name: course.name, price: course.price}}"-->
        <!--                                tag="button" class="btn btn-primary btn-block my-3">-->
        <!--                                S'inscrire à ce cours-->
        <!--                            </router-link>-->
        <!--                </div>-->
        <!--            </div>-->

        <!--        </div>-->
    </div>

</template>
<script>
    import {mapGetters} from 'vuex'

    export default {
        name: "course-components",
        /*
        |--------------------------------------------------------------------------
        | Component > methods
        |--------------------------------------------------------------------------
        */

        methods: {
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
        /*
        |--------------------------------------------------------------------------
        | Component > props
        |--------------------------------------------------------------------------
        */
        props: {
            course: {
                type: Object,
                default: null
            },
        },
        /*
        |--------------------------------------------------------------------------
        | component > mounted
        |--------------------------------------------------------------------------
        */
        mounted() {
        },
        /*
        |--------------------------------------------------------------------------
        | component > computed
        |--------------------------------------------------------------------------
        */
        computed: {
            ...mapGetters(["isLoggedIn", "loggedInUser", "lang"])
        },

    };
</script>
<style lang="scss" scoped>
    a {
        color: rgba(0, 0, 0, 0.7);
    }

    a:hover {
        text-decoration: none;
        color: #000000;
    }

    .course-det {
        border-radius: 15px;
        margin: 10px;
        /*background: linear-gradient(90deg,
            rgb(0, 0, 0, 0.5),
            rgb(255, 255, 255, 1));*/
        background-color: #fff;
        font-weight: 800 !important;
        border: 1px solid #2b63f3;
    }

    .text-green {
        color: rgb(2, 128, 13);
        font-weight: 800;
    }

    @media all and (max-width: 720px) {
        .custom-class {
            width: 100%;
            display: block;
        }
        .categ-img {
            height: 320px !important;
            background-position: center !important;
        }
    }
</style>
