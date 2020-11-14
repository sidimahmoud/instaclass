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
                    <!--Card content-->
                    <div class="my-3">
                        <div>
                            <h4>{{$t('selected_session')}}</h4>
                            <!-- <select class="form-control" multiple v-model="selected" @change="changedSelection">
                                <option v-for="e in course.sections" v-bind:key="e.id" :value="e.id">{{e.title}}</option>
                            </select> -->
                            <select v-model="selected">
                                <option v-for="e in course.sections" v-bind:key="e.id" :value="e.id">{{e.title}}</option>
                            </select>
                        </div><br/><br/>
                        <div class="text-center" v-if="course_price===0">
                            <h3>{{$t('course.course_free')}}</h3>
                            <h5>{{$t('course.no_payment')}}</h5>
                            <button class="btn btn-primary" @click="enrollForFree">{{$t('complete_purchase')}}</button>
                        </div>
                        <div v-else>
                            <h4 class="card-info-text">{{$t('card_information')}}</h4>
                            <stripe-elements
                                ref="elementsRef"
                                :pk="publishableKey"
                                :amount="totalCourse"
                                locale="en"
                                @token="tokenCreated"
                                @loading="loading = $event"
                            />
                            <br/><br/>
                            <div class="text-center">
                                <button class="btn btn-primary" @click="checkout">{{$t('complete_purchase')}}</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!--/.Card-->
            <!--Grid column-->
            <div class="col-md-4 mb-4 ">

                <!-- Heading -->
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Course Details</span>
                </h4>

                <!-- Cart -->
                <ul class="list-group mb-3 z-depth-1">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">
                                <span class="font-weight-bold">
                                    {{$t('course.price')}}
                                </span>
                            </h6>
                        </div>
                        <span class="text-muted">${{course_price}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed" v-if="sections_count >= 3">
                        <div>
                            <h6 class="my-0">
                                <span class="font-weight-bold">
                                    3eme section gratuit 
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
                        <span>Total (USD)</span>
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

    export default {
        name: "Checkout",
        components: {
            StripeElements
        },
        data() {
            return {
                /* course_id: this.$route.query.id,
                course_file_id: this.$route.query.id,
                course_name: this.$route.query.name,
                course_price: this.$route.query.price,
                sections_count: this.$route.query.sections_count, */
                course_price: 0,
                sections_count: '',
                paymentMethod: 'card',
                loading: false,
                publishableKey: 'pk_test_51HK26oKzha99bEEwW8zlncEHA6FPsPh7N3R84cJyMN6af5fPs9WMmZwae2CodeHWfPiyAlA6ScX0hbWFb8v1dfWn00oLMytNRI',
                items: [
                    {
                        sku: 'sku_FdQKocNoVzznpJ',
                        quantity: 1
                    }
                ],
                successUrl: 'your-success-url',
                cancelUrl: 'your-cancel-url',
                course: {},
                selected: []
            }
        },
        /*
        |--------------------------------------------------------------------------
        | component > computed
        |--------------------------------------------------------------------------
        */
        computed: {
            totalCourse(){
                if(this.sections_count >= 3){
                    return (Number(this.course_price) * Number(this.sections_count))  - Number(this.course_price);
                }else{
                    return Number(this.course_price) * Number(this.sections_count);
                }
            },
            gst() {
                return Number(this.totalCourse) * 9.75 /100;
            },
            tvq() {
                return Number(this.totalCourse) * 5 /100;
            },
            allPrice() {
                return Number(this.totalCourse) + Number(this.tvq) + Number(this.gst);
            }
        },
        methods: {
            tokenCreated(token) {
                let payload = {
                    paymentMethod: this.paymentMethod,
                    course_id: this.course.id,
                    course_name: "Course N°" + this.course.course_id,
                    course_price: this.allPrice,
                    token: token.id,
                };
                this.$store.dispatch('enrollInAllSection', payload)
                    .then(() => {
                        alert("Enrolled successfully");
                        this.$router.push({name: 'StudentProfile'})
                    })
                    .catch(err => console.log(err))
            },
            checkout() {
                this.$refs.elementsRef.submit();
            },
            enrollForFree() {
                let payload = {
                    paymentMethod: this.paymentMethod,
                    course_id: this.course.id,
                    course_name: "Course N°" + this.course.course_id,
                    course_price: this.course_price,
                };
                this.$store.dispatch('enrollInAllSection', payload)
                    .then(() => {
                        alert("Enrolled successfully");
                        this.$router.push({name: 'StudentProfile'})
                    })
                    .catch(err => console.log(err))
            },
            fetchCourseFiles() {
                const _this = this;
                this.$store.dispatch('getCourse',this.$route.params.slug)
                    .then((r) => {
                        _this.course = r
                        _this.initData()
                    })
                    .catch(err => console.log(err))
            },
            changedSelection(event){
                console.log(event.target.value);
            },
            initData(){
                this.sections_count = this.course.sections.length
                this.course_price = this.course.price

                _.each(this.course.sections, (v) => {
                    this.selected.push(v.id);
                });
                
            }
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
</style>
