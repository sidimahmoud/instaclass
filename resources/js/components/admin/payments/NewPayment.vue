<template>
    <form>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Select teacher</label>
            <select class="form-control" id="exampleFormControlSelect1">
                <option>1- Teacher Instant</option>
                <option>2- Another teacher</option>

            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Object of payment</label>
            <select multiple class="form-control" id="exampleFormControlSelect2">
                <option>17- Build PWAs with Vuejs</option>
                <option>28- Full Stack Laravel Vuejs</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Note (optional) </label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div>
            <!-- Heading -->
            <h2 class=" h2 text-center">Checkout form</h2>
            <!-- payement info-->
            <div class="my-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="method">Payement method</label>
                    </div>
                    <div class="col-md-6">
                        <select class="custom-select d-block w-50 mb-2" id="method" required>
                            <option>Credit card</option>
                            <option>PayPal</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid payment method.
                        </div>
                    </div>
                </div>
                <div class=" border rounded">
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
                                <label for="cc-expiration">Expiration</label>
                                <input type="text" class="form-control" id="cc-expiration"
                                       placeholder=""
                                       required>
                                <div class="invalid-feedback">
                                    Expiration date required
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="cc-expiration">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" placeholder=""
                                       required>
                                <div class="invalid-feedback">
                                    Security code required
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="cc-number">Credit card number</label>
                                <input type="text" class="form-control" id="cc-number" placeholder=""
                                       required>
                                <div class="invalid-feedback">
                                    Credit card number is required
                                </div>
                            </div>

                        </div>
                        <div class="custom-control custom-checkbox text-right">
                            <input type="checkbox" class="custom-control-input" id="save-info">
                            <label class="custom-control-label" for="save-info">
                                Save this information for next time
                            </label>
                        </div>

                    </div>

                </div>
            </div>
            <button class="btn btn-primary btn-lg btn-block mb-3" type="submit">
                Send Payment
            </button>
        </div>
    </form>
</template>

<script>
    export default {
        name: "NewPayment"
    }
</script>

<style scoped>

</style>
