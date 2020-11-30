<template>
  <section class="bg-dark text-white mb-1 py-3">
        <div class="container newsLetter">
            <h1 class="text-center">
                {{$t('about.newsletter.stay')}}
            </h1>
            <p class="text-center">{{$t('about.newsletter.subscribe')}}
            </p>
            <form @submit.prevent="subscribe">
                <div class="row">
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email"
                                    aria-label="Recipient's username" aria-describedby="basic-addon2"
                                    v-model="email">
                            <div class="input-group-append">
                            <span class="input-group-text p-0" id="basic-addon2">
                                <button class="btn btn-primary">
                                    {{$t('about.newsletter.subscribeBtn')}}
                                </button>
                            </span>
                            </div>
                        </div>
                    </div>

                </div>
            </form>

        </div>

    </section>
</template>


<script>
    export default {
        name: "MailBox",
        data() {
            return {
                first_name: '',
                last_name: '',
                address: '',
                email: '',
            }
        },
        methods: {
            subscribe() {
                let payload = {
                    first_name: this.first_name,
                    last_name: this.last_name,
                    email: this.email,
                    address: this.address,
                };
                axios.post('/newsletter-store', payload)
                .then(() => {
                    this.first_name = '';
                    this.last_name = '';
                    this.email = '';
                    this.address = '';
                    this.$notify.success({
                        message: `${this.$t('subscribed_successfully')}`
                    });
                })
                .catch(err => {
                    this.$notify.error({
                        message: `${this.$t('already_subscriped')}`
                    });
                })
            }
        },
    }
</script>

<style scoped lang="scss">
    .newsLetter {
        input {
            background: transparent;
            color: white !important;

        }
    ;

        ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: white;
            opacity: 1; /* Firefox */
        }
    }

    h1 {
        font-weight: bolder
    }
</style>