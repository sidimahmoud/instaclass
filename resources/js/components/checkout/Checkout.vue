<template>
    <div class="container border-top border-primary pt-5 mt-5">
        <!-- Heading -->
        <h2 class=" h2 text-center">Checkout form</h2>
        <!--Grid row-->
        <div class="row">
            <!--Grid column-->
            <div class="col-md-8 mb-4 ">
                <!--Card-->
                <div class="card">
                    <!--Card content-->
                    <div class="my-3">
                        <div class="text-center" v-if="course_price===0">
                            <h3>This course is free</h3>
                            <h5>No payment required</h5>
                            <button class="btn btn-primary btn-lg btn-block" @click="enrollForFree">Enroll</button>
                        </div>
                        <div v-else>

                            <stripe-elements
                                ref="elementsRef"
                                :pk="publishableKey"
                                :amount="course_price"
                                locale="en"
                                @token="tokenCreated"
                                @loading="loading = $event"
                            />
                            <button class="btn btn-primary btn-lg btn-block" @click="checkout">Pay Now</button>
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
                    <span class="badge badge-secondary badge-pill">
                            1 </span>
                </h4>

                <!-- Cart -->
                <ul class="list-group mb-3 z-depth-1">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">
                                <span class="font-weight-bold">
                                    {{course_name}}
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
                        <span>Total (USA)</span>
                        <strong>${{totalCourse}}</strong>
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
                course_id: this.$route.params.id,
                course_file_id: this.$route.params.id,
                course_name: this.$route.params.name,
                course_price: this.$route.params.price,
                sections_count: this.$route.params.sections_count,
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
            }
        },
        methods: {
            tokenCreated(token) {
                let payload = {
                    paymentMethod: this.paymentMethod,
                    course_id: this.course_id,
                    course_name: "Course N°" + this.course_id,
                    course_price: this.totalCourse,
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
                    course_id: this.course_id,
                    course_name: "Course N°" + this.course_id,
                    course_price: this.course_price,
                };
                this.$store.dispatch('enrollInAllSection', payload)
                    .then(() => {
                        alert("Enrolled successfully");
                        this.$router.push({name: 'StudentProfile'})
                    })
                    .catch(err => console.log(err))
            },
        },
        mounted() {
            console.log(this.$route.params)
        }
    }
</script>

<style scoped>

</style>
