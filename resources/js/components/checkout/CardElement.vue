<template>
    <div>
        <card class='stripe-card'
              :class='{ complete }'
              stripe='pk_test_51HK26oKzha99bEEwW8zlncEHA6FPsPh7N3R84cJyMN6af5fPs9WMmZwae2CodeHWfPiyAlA6ScX0hbWFb8v1dfWn00oLMytNRI'
              :options='stripeOptions'
              @change='change($event)'
        />
        <div id="card-errors" role="alert" v-text="errorMessage"></div>
        <button class='pay-with-stripe btn btn-block btn-outline-primary my-3' @click='pay' >Pay ${{price}}</button>
    </div>
</template>

<script>
    import { Card, createToken } from 'vue-stripe-elements-plus'

    export default {
        name: "Stripe",
        components:{Card},
        props:["price"],
        data () {
            return {
                complete: false,
                errorMessage:'',
                stripeOptions: {
                  style : {
                        base: {
                            color: '#32325d',
                            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                            fontSmoothing: 'antialiased',
                            fontSize: '16px',
                            '::placeholder': {
                                color: 'rgba(19,19,19,0.85)'
                            }
                        },
                        invalid: {
                            color: '#fa755a',
                            iconColor: '#fa755a'
                        }
                    }
                }
            }
        },
        methods: {
            pay () {
                createToken().then(data => console.log(data.token))
            },
            change(event){
                if (event.error) {
                    this.errorMessage = event.error.message
                } else {
                    this.errorMessage = '';
                }
            }
        }
    }
</script>

<style scoped>
    .stripe-card {
        border: 1px solid grey;
        padding: 10px;
    }
    .stripe-card.complete {
        border-color: green;
    }
</style>
