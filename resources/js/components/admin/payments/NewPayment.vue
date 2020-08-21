<template>
    <div>

        <form @submit.prevent="savePayment">
            <div class="row ">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Select teacher</label>
                            <select class="form-control" id="exampleFormControlSelect1" v-model="payment.user_id">
                                <option value="0">Select teacher</option>
                                <option v-for="t in allTeachers" :value="t.id">{{t.id}}-{{t.first_name}} / {{t.email}}
                                </option>
                            </select>
                        </div>
                        <p class="btn btn-primary btn-block" @click="loadCourses">Load courses</p>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Object of payment</label>
                            <select multiple class="form-control" id="exampleFormControlSelect2" v-model="payment.object">
                                <option v-for="c in TeacherCourses" :value="c.id">{{c.name}}</option>
                            </select>
                        </div>
                    </div>
            </div>


            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="text" class="form-control" id="amount" v-model="payment.amount">
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Note (optional) </label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                          v-model="payment.note"></textarea>
            </div>
            <div>
                <!-- Heading -->
                <!-- payement info-->
                <div class="my-3">

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
    </div>

</template>

<script>
    import {mapActions, mapGetters} from 'vuex'

    export default {
        name: "NewPayment",
        data() {
            return {
                payment: {
                    user_id: 0,
                    type: 'sent',
                    amount: '',
                    method: 'card',
                    object: [],
                    note: '',
                }
            }
        },
        methods: {
            ...mapActions(["fetchTeachers"]),
            loadCourses(id) {
                if (this.payment.user_id === 0) {
                    alert("Select teacher first");
                } else
                    this.$store.dispatch('fetchTeacherCourses', this.payment.user_id)
            },
            savePayment() {
                console.log(this.payment)
            }
        },
        computed: {
            ...mapGetters(["allTeachers", "TeacherCourses"]),
        },
        created() {
            this.fetchTeachers();
        }
    }
</script>

<style scoped>

</style>
