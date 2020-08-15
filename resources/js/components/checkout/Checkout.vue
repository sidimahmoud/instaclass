<template>
    <div class="container">
        <!-- Heading -->
        <h2 class=" h2 text-center">Checkout form</h2>
        <!--Grid row-->
        <div class="row">

            <!--Grid column-->
            <div class="col-md-8 mb-4 ">

                <!--Card-->
                <div class="card">

                    <!--Card content-->
                    <form class="card-body">




                        <!--Grid row-->
                        <!-- payement info-->
                        <div class="my-3">
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <label for="method">Payement method</label>
                                </div>
                                <div class="col-lg-6">
                                    <select class="custom-select d-block w-50 mb-2" id="method" required>
                                        <option>Credit card</option>
                                        <option>PayPal</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid payment method.
                                    </div>
                                </div>
                            </div>


                            <div class="row border rounded">
                                <div class="p-2">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="cc-name">Name on card</label>
                                            <input type="text" class="form-control" id="cc-name" placeholder=""
                                                   required>
                                            <div class="invalid-feedback">
                                                Name on card is required
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="cc-number">Credit card number</label>
                                            <input type="text" class="form-control" id="cc-number" placeholder=""
                                                   required>
                                            <div class="invalid-feedback">
                                                Credit card number is required
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="cc-expiration">Expiration</label>
                                            <input type="text" class="form-control" id="cc-expiration"
                                                   placeholder=""
                                                   required>
                                            <div class="invalid-feedback">
                                                Expiration date required
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="cc-expiration">CVV</label>
                                            <input type="text" class="form-control" id="cc-cvv" placeholder=""
                                                   required>
                                            <div class="invalid-feedback">
                                                Security code required
                                            </div>
                                        </div>
                                    </div>
                                    <div class="custom-control custom-checkbox text-right">
                                        <input type="checkbox" class="custom-control-input" id="save-info">
                                        <label class="custom-control-label" for="save-info">Save this information
                                            for next
                                            time</label>
                                    </div>

                                </div>

                            </div>
                        </div>



                        <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>

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
                            <h6 class="my-0">1 <span class="font-weight-bold">
                                        Build WPA with vue.js
                                    </span></h6>
                        </div>
                        <span class="text-muted">$10.99</span>
                    </li>


                    <li class="list-group-item d-flex justify-content-between font-weight-bold">
                        <span>Total (USD)</span>
                        <strong>10.99</strong>
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
    export default {
        name: "Checkout"
    }
</script>

<style scoped>

</style>
