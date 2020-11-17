<template>
    <div class="container pt-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card card-default">
                    <div class="card-header">{{$t('auth.resetPass')}}</div>
                    <div class="card-body">
                        <form autocomplete="off" @submit.prevent="requestResetPassword" method="post">
                            <div class="alert alert-warning alert-dismissible fade show " data-dismiss="alert"
                                 role="alert" v-if="msg">
                                {{msg}}.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" id="email" class="form-control" placeholder="user@example.com"
                                       v-model="email" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">{{$t('auth.sendLink')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        data() {
            return {
                email: null,
                has_error: false,
                msg: ''
            }
        },
        methods: {
            requestResetPassword() {
                axios.post("/reset-password", {email: this.email}).then(result => {
                    this.msg = ''
                    this.response = result.data;
                    this.$alert(this.$t('auth.emailSent'), 'Done', 'sucess')
                    this.$router.push({name: "Home"})
                }, error => {
                    console.log(error.response.data.messageFR);
                    this.lang === 'fr' ? this.msg = error.response.data.messageFR : this.msg = error.response.data.messageEN
                    $('.alert').alert()

                });
            }
        },
        computed: {
            ...mapGetters(["lang"])
        }
    }
</script>
