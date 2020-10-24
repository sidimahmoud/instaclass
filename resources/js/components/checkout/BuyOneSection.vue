<template>
    <div class="container border-top border-primary pt-5">
        <!-- Heading -->
        <h2 class=" h2 text-center">Enroll in this session</h2>
        <!--Grid row-->
        <div class="row">
            <!--Grid column-->
            <div class="col-md-8 mb-4 ">
                <!--Card-->
                <div class="card">
                    <!--Card content-->
                    <form class="card-body" @submit.prevent="checkout">
                        <!--Grid row-->
                        <!-- payement info-->
                        <div class="my-3">
                            <div class="text-center" v-if="course_price==0">
                                <h3>This course is free</h3>
                                <h5>No payment required</h5>
                            </div>
                            <div v-else>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="method">Payement method</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <select class="custom-select d-block w-50 mb-2" id="method" required
                                                v-model="paymentMethod">
                                            <option value="card">Credit card</option>
                                            <option value="paypal">PayPal</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid payment method.
                                        </div>
                                    </div>

                                </div>
                                <div class="row border rounded" v-if="paymentMethod==='card'">
                                    <div class="col-12">
                                        <div class="p-2">
                                            <stripe hidePostalCode={true} :price="course_price"/>

                                            <div class="custom-control custom-checkbox text-right">
                                                <input type="checkbox" class="custom-control-input" id="save-info">
                                                <label class="custom-control-label" for="save-info">Save this
                                                    information
                                                    for next
                                                    time</label>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                                <div class="row " v-if="paymentMethod==='paypal'">
                                    <div class="col-12 text-center">
                                        <button class="btn btn-primary">
                                            <i class="fa fa-paypal"></i>
                                            Checkout with PayPal
                                        </button>
                                    </div>


                                </div>
                            </div>

                        </div>

                        <button class="btn btn-primary btn-lg btn-block" type="submit">Enroll</button>

                    </form>

                </div>
                <!--/.Card-->

            </div>
            <!--Grid column-->

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
                    <li class="list-group-item d-flex justify-content-between font-weight-bold">
                        <span>Total (USD)</span>
                        <strong>${{course_price}}</strong>
                    </li>
                </ul>
                <!-- Cart -->


            </div>
            <!--Grid column-->

        </div>
        <!--Grid row-->
    </div>
</template>

<script>
    import Stripe from "../checkout/CardElement";

    export default {
        name: "BuyOneSection",
        components: {
            Stripe
        },
        data() {
            return {
                course_id: this.$route.params.id,
                course_name: this.$route.params.name,
                course_price: this.$route.params.price,
                paymentMethod: 'card',

            }
        },
        methods: {

            checkout() {
                let payload = {
                    paymentMethod: this.paymentMethod,
                    section_id: this.course_id,
                    course_name: "section "+this.section_id,
                    course_price: this.course_price
                };
                this.$store.dispatch('enroll', payload)
                    .then(() => {
                        alert("Enrolled successfully");
                        this.$router.push({name: 'StudentProfile'})
                    })
                    .catch(err => console.log(err))
            }
        },


    }
</script>

<style scoped>

</style>
