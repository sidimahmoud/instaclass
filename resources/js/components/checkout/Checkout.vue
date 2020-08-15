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

                            <!--contact info-->
                            <div class="row">

                                <!--Grid column-->
                                <div class="col-md-6 mb-2">
                                    <!--firstName-->
                                    <div class="md-form ">
                                        <input type="text" id="firstName" class="form-control">
                                        <label for="firstName" class="">First name</label>
                                    </div>
                                </div>
                                <!--Grid column-->
                                <div class="col-md-6 mb-2">
                                    <div class="md-form input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fa fa-phone "></i></span>
                                        </div>
                                        <input type="text" class="form-control " placeholder="Telephone"
                                               aria-describedby="basic-addon1">
                                    </div>

                                </div>
                            </div>


                            <!--Grid row-->
                            <!-- payement info-->
                            <div class="my-3">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6">
                                        <label for="method">Payement method</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <select class="custom-select d-block w-50 mb-2" id="method" required>
                                            <option value="">Choose...</option>
                                            <option>Espace</option>
                                            <option>Transfert</option>
                                            <option>PayPal</option>
                                            <option>Credit card</option>
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

                            <!-- shipping info-->
                            <div class="mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="shipping">
                                    <label class="custom-control-label font-weight-bold" for="shipping">
                                        Livraison
                                    </label>
                                </div>
                                <div class="border rounded p-2">
                                    <div class="row ">
                                        <!--Grid column-->
                                        <div class="col-lg-4 col-md-12">
                                            <label for="wilaya">Wilaya</label>
                                            <select class="custom-select d-block w-100" id="wilaya" required>
                                                <option value="">Choose...</option>
                                                <option>Nouakchott</option>
                                                <option>Nouadhibou</option>
                                                <option>Brakna</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a valid country.
                                            </div>

                                        </div>
                                        <!--Grid column-->

                                        <!--Grid column-->
                                        <div class="col-lg-4 col-md-6">
                                            <label for="state">Moughataa</label>
                                            <select class="custom-select d-block w-100" id="state" required>
                                                <option value="">Choose...</option>
                                                <option>TVZ</option>
                                                <option>Ksar</option>
                                                <option>Teyarett</option>
                                                <option>Arafat</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please provide a valid state.
                                            </div>

                                        </div>
                                        <!--Grid column-->

                                        <!--Grid column-->
                                        <div class="col-lg-4 col-md-6">
                                            <!--address-->
                                            <div class="md-form mb-5">
                                                <input type="text" id="address" class="form-control"
                                                       placeholder="1234 Main St">
                                                <label for="address" class="">Cartier</label>
                                            </div>

                                        </div>
                                        <!--Grid column-->

                                    </div>

                                    <div class="custom-control custom-checkbox text-right">
                                        <input type="checkbox" class="custom-control-input" id="save-adress">
                                        <label class="custom-control-label" for="save-adress">Save this information for
                                            next time</label>
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
                        <span class="text-muted">Your cart</span>
                        <span class="badge badge-secondary badge-pill">
                            1 </span>
                    </h4>

                    <!-- Cart -->
                    <ul class="list-group mb-3 z-depth-1">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">1 <span class="font-weight-bold">
                                        elem.element.nom
                                    </span></h6>
                            </div>
                            <span class="text-muted">PRIX MRU</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Livraison</span>
                            <strong>100 MRU</strong>
                        </li>

                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-success">
                                <h6 class="my-0">Promo code</h6>
                                <small>JSCOV19</small>
                            </div>
                            <span class="text-success">-250 MRU</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between font-weight-bold">
                            <span>Total (MRU)</span>
                            <strong>1200</strong>
                        </li>
                    </ul>
                    <!-- Cart -->

                    <!-- Promo code -->
                    <form class="card p-2">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Promo code"
                                   aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-secondary btn-md waves-effect m-0" type="button">Redeem</button>
                            </div>
                        </div>
                    </form>
                    <!-- Promo code -->

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
