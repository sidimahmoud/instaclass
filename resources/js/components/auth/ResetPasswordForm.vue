<template>
    <div class="container pt-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card card-default">
                    <div class="card-header">{{$t('auth.newPass')}}</div>
                    <div class="card-body">
                        <!-- <ul v-if="errors">
                          <li v-for="error in errors" v-bind:key="error">{{ msg }}</li>
                        </ul> -->
                        <form autocomplete="off" @submit.prevent="resetPassword" method="post">
                            <!--                            <div class="form-group">-->
                            <!--                                <label for="email">E-mail</label>-->
                            <!--                                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>-->
                            <!--                            </div>-->
                            <div class="form-group">
                                <label for="password">{{$t('auth.password')}}</label>
                                <input type="password" id="password" class="form-control" placeholder=""
                                       v-model="password" required>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">{{$t('auth.passwordConfirm')}}</label>
                                <input type="password" id="password_confirmation" class="form-control" placeholder=""
                                       v-model="password_confirmation" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">{{$t('profile.save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                token: null,
                email: null,
                password: null,
                password_confirmation: null,
                has_error: false
            }
        },
        methods: {
            resetPassword() {
                if (this.password !== this.password_confirmation) {
                    this.$alert('Password and password confirmation dont match', 'Password', 'error')
                    return
                } else {
                    if (this.password.length < 8) {
                        this.$alert('The password must be at least 8 characters.', 'Password', 'error')
                        return
                    }
                }
                console.log('this.$route.params')
                console.log(this.$route.params.token)
                console.log(this.$route.params)
                axios.post("/reset/password/", {
                    token: this.$route.params.token,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                })
                    .then(result => {
                        // console.log(result.data);
                        this.$router.push({name: 'Login'})
                    }, error => {
                        console.error(error);
                    });
            }
        }
    }
</script>
