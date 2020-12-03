<template>
    <div class="container border-top border-primary pt-5 mt-5">
        <!-- Heading -->
        <h2 class=" h2 text-center">{{$t('checkout')}}</h2>
        <!--Grid row-->
        <div class="row">
            <!--Grid column-->
            <div class="col-md-8 mb-4">
                <!--Card-->
                <div class="card payment-form">
                    <!--Card content-->
                    <div class="mt-3">
                        <div>
                            <h3>{{$t('payment_option')}}</h3>
                            <p>
                                <img src="../../assets/images/visa-mastercard.jpg" width="80px" alt="">
                            </p>
                        </div>
                    </div>
                </div>
                <!--Card-->
                <div class="card payment-form">
                    <pulse-loader :loading="pageLoader" class="text-center"></pulse-loader>
                    <!--Card content-->
                    <div class="my-3">
                        <div class="text-center" v-if="course_price===0">
                            <h5>{{$t('course.course_free')}} {{$t('course.no_payment')}}</h5>
                            <!-- <p>{{$t('course.no_payment')}}</p> -->
                            <button class="btn btn-primary" @click="enrollForFree">{{$t('complete_purchase')}}</button>
                        </div>
                        <div v-else>
                            <div v-if="!isEmpty(course.course.sections)">
                                <!-- <h4>{{$t('selected_session')}}</h4> -->
                                <!-- <el-select v-model="selected" placeholder="Select" multiple @change="changedSelection" style="width:100%">
                                    <el-option
                                        v-for="e in course.course.sections"
                                        :key="e.id"
                                        :label="e.title"
                                        :value="e.id">{{e.title}}
                                    </el-option>
                                </el-select> -->
                                <dropdown-menu class="custom-style" :overlay="false">
                                    <el-button slot="trigger" class="select-session">{{$t('select_sessions')}} <i class="el-icon-arrow-down el-icon--right"></i></el-button>
                                    <div slot="header">{{$t('select_sessions')}}</div><br/>
                                    <ul slot="body">
                                        <!-- <li v-for="(e ,index) in course.course.sections" :key="e.id"> -->
                                            <el-checkbox-group 
                                                v-model="selected">
                                                <el-checkbox v-for="(e ,index) in course.course.sections" :label="e.id" :value="e.id" :key="index" @change="changedSelection" style="width:100%">Session {{index + 1}}: {{e.title}}</el-checkbox>
                                            </el-checkbox-group>
                                            <!-- <el-checkbox v-model="checked[index]" fill="#000000" text-color="#000000" @change="changedSelection">Session {{index}}: {{e.title}}</el-checkbox>
                                        </li> -->
                                    </ul>
                                </dropdown-menu>
                            </div><br/><br/>
                            <template v-if="allPrice != 0">
                                <h4 class="card-info-text">{{$t('card_information')}}</h4>
                                <stripe-elements
                                    ref="elementsRef"
                                    :pk="publishableKey"
                                    :amount="allPrice"
                                    locale="en"
                                    @token="tokenCreated"
                                    @loading="loading = $event"
                                />
                                <br/><br/>
                                <div class="text-center">
                                    <button class="btn btn-primary" @click="checkout">{{$t('complete_purchase')}}</button>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>


            </div>
            <!--/.Card-->
            <!--Grid column-->
            <div class="col-md-4 mb-4 ">

                <!-- Heading -->
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">{{$t('course.course_details')}}</span>
                </h4>

                <!-- Cart -->
                <ul class="list-group mb-3 z-depth-1">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">
                                <span class="font-weight-bold">
                                    {{$t('course.price')}} X {{sections_count}}
                                </span>
                            </h6>
                        </div>
                        <span class="text-muted">${{Number(course_price) * sections_count}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed" v-if="sections_count >= 6">
                        <div>
                            <h6 class="my-0">
                                <span class="font-weight-bold">
                                    {{$t('course.section_three_free')}}
                                </span>
                            </h6>
                        </div>
                        <span class="text-muted">- ${{course_price}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between font-weight-bold">
                        <span>{{$t('gst')}} (9.975%)</span>
                        <strong>${{gst}}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between font-weight-bold">
                        <span>{{$t('tvq')}} (5%)</span>
                        <strong>${{tvq}}</strong>
                    </li>
                    
                    <li class="list-group-item d-flex justify-content-between font-weight-bold">
                        <span>Total ( CAD )</span>
                        <strong>${{allPrice}}</strong>
                    </li>
                </ul>
                <!-- Cart -->


            </div>
            <!--Grid column-->
        </div>
        <!--Grid column-->
    </div>
    <!--Grid row-->
</template>

<script>
    import {StripeElements} from 'vue-stripe-checkout';
    import PulseLoader from 'vue-spinner/src/PulseLoader.vue';
    import {isEmpty} from "../../helpers/common";
    import { mapGetters } from 'vuex';

    export default {
        name: "Checkout",
        components: {
            StripeElements,
            PulseLoader
        },
        data() {
            return {
                course_price: 0,
                sections_count: '',
                paymentMethod: 'card',
                loading: false,
                publishableKey: 'pk_live_51HB0HpHDyIu0bdYbv47CLk1imRIm5l8JwxVpg3uWGClstvnaVKQ8hPa4gnkqOIMZvOWTL7JOKIiNn2muThX3O9YA00EYiEVmHx',
                items: [
                    {
                        sku: 'sku_FdQKocNoVzznpJ',
                        quantity: 1
                    }
                ],
                successUrl: 'your-success-url',
                cancelUrl: 'your-cancel-url',
                //course: {},
                selected: [],
                pageLoader: false,
                checked: []
            }
        },
        props: ['section'],
        /*
        |--------------------------------------------------------------------------
        | component > computed
        |--------------------------------------------------------------------------
        */
        computed: {
            ...mapGetters(["course"]),
            totalCourse(){
                if(this.sections_count >= 6){
                    return parseFloat((Number(this.course_price) * Number(this.sections_count))  - Number(this.course_price)).toFixed(2);
                }else{
                    return parseFloat(Number(this.course_price) * Number(this.sections_count)).toFixed(2);
                }
            },
            gst() {
                return parseFloat(Number(this.totalCourse) * 9.75 /100).toFixed(2);
            },
            tvq() {
                return parseFloat(Number(this.totalCourse) * 5 /100).toFixed(2);
            },
            allPrice() {
                return parseFloat(Number(this.totalCourse) + Number(this.tvq) + Number(this.gst)).toFixed(2);
            }
        },
        methods: {
            tokenCreated(token) {
                const _this = this
                this.pageLoader = true
                let payload = {
                    paymentMethod: this.paymentMethod,
                    course_id: this.course.course.id,
                    course_name: "Course N°" + this.course.course.course_id,
                    course_price: this.allPrice,
                    token: token.id,
                    sections: this.selected
                };
                this.$store.dispatch('enrollInAllSection', payload)
                    .then(() => {
                        this.pageLoader = false
                        this.$swal.fire({
                            title: '',
                            text: _this.$t('thnk_txt'),
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'ok'
                        }).then((result) => {
                            this.$router.push({name: 'StudentProfile'})
                        })
                    })
                    .catch(err => console.log(err))
            },
            checkout() {
                this.$refs.elementsRef.submit();
            },
            enrollForFree() {
                const _this = this;
                this.pageLoader = true
                let payload = {
                    paymentMethod: this.paymentMethod,
                    course_id: this.course.course.id,
                    course_name: "Course N°" + this.course.course.course_id,
                    course_price: this.course_price,
                    sections: this.selected
                };
                this.$store.dispatch('enrollInAllSection', payload)
                    .then(() => {
                        //alert("Enrolled successfully");
                        this.pageLoader = false
                        this.$swal.fire({
                            title: '',
                            text: _this.$t('thnk_txt'),//"Thank you for your purchase, Happy learning",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'ok'
                        }).then((result) => {
                            this.$router.push({name: 'StudentProfile'})
                        })
                    })
                    .catch(err => console.log(err))
            },
            fetchCourseFiles() {
                const _this = this;
                
                this.$store.dispatch('getCourse',this.$route.params.slug)
                    .then((r) => {
                        _this.initData()
                    })
                    .catch(err => console.log(err))
            },
            changedSelection(event){
                this.sections_count = this.selected.length
            },
            initData(){
                
                if(isEmpty(this.$route.query.s)) {
                    this.sections_count = this.course.course.sections.length
                    this.course_price = this.course.course.price

                    _.each(this.course.course.sections, (v) => {
                        this.selected.push(Number(v.id));
                    });
                }else {
                    const _this = this
                    this.sections_count = 1
                    this.course_price = this.course.course.price
                    this.selected.push(Number(this.$route.query.s));
                }
            },
            customLabel (option) {
                return `${option.title}`
            },
            isEmpty(v) {
                return isEmpty(v);
            },
        },
        mounted() {
            this.fetchCourseFiles();
        }
    }
</script>

<style scoped>
.payment-form{
    padding: 10px;
}
.card-info-text{
    color: red
}
.text-center-screen {
    position: relative; 
    left: 50%;
    transform: translateX(-50%);
}
.select-session {
    width: 47%
}
@media (max-width: 600px) {
    .select-session {
        width: 90%
    }
}
</style>
