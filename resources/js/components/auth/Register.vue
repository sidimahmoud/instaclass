<template>
    <div>
        <section class="hero pt-5 mb-3">
            <div class="container h-100">
                <!--                <div class="row h-100">-->
                <!--                    <div class="col-md-4"></div>-->
                <!--                    <div class="col-md-8 text-center pt-md-5">-->
                <!--                        <h1 class="font-weight-bold">-->
                <!--                            THE NEXT <br>-->
                <!--                            YOU-->
                <!--                        </h1>-->
                <!--                        <h1 class="font-weight-bold text-uppercase">-->
                <!--                            The best way to predict <br>-->
                <!--                            the future is to create it-->
                <!--                        </h1>-->
                <!--                    </div>-->
                <!--                </div>-->

            </div>

        </section>
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="signup-form bg-white">
                        <form @submit.prevent="register">
                            <h2>{{$t('auth.signup')}}</h2>
                            <p class="hint-text">{{$t('auth.createYourAccount')}}</p>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"
                                 v-if="errorMessage">
                                {{errorMessage}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" name="first_name"
                                               :placeholder="$t('auth.fName')" required="required" v-model="first_name">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="last_name"
                                               :placeholder="$t('auth.lName')"
                                               required="required" v-model="last_name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email"
                                       required="required" v-model="email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password"
                                       :placeholder="$t('auth.password')"
                                       required="required" v-model="password1">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="confirm_password"
                                       :placeholder="$t('auth.passwordConfirm')" required="required"
                                       v-model="password2">
                            </div>
                            <div class="form-group">
                                <label class="form-check-label">
                                    <input type="checkbox" required="required">
                                    {{$t('auth.accept')}} <a href="#" data-toggle="modal"
                                                             data-target="#exampleModalLong">
                                    {{$t('footer.termsAndConditions')}} </a> &amp; <a
                                    href="#">{{$t('footer.privacy')}}</a>
                                </label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    <span v-if="!authLoading">{{$t('auth.signup')}}</span>
                                    <div class="text-center text-white" v-if="authLoading">
                                    <span class="spinner-border spinner-border-sm" role="status"
                                          aria-hidden="true">
                                    </span>
                                        Loading...
                                    </div>
                                </button>
                            </div>
                        </form>
                        <div class="text-center">{{$t('auth.user')}}
                            <router-link :to="{name: 'Login'}">{{$t('auth.signIn')}}</router-link>
                        </div>
                        <h2>{{$t("auth.or")}}</h2>
                        <g-signin-button
                            class="btn btn-lg btn-google btn-block text-uppercase"
                            :params="googleSignInParams"
                            @success="ongSignInSuccess"
                            @error="ongSignInError">
                            <i class="fa fa-google mr-2"></i> {{$t('auth.continueWith')}} Google
                        </g-signin-button>
                        <fb-signin-button
                            class="btn btn-lg btn-github btn-block text-uppercase"
                            :params="fbSignInParams"
                            @success="onSignInSuccess"
                            @error="onSignInError">
                            <i class="fa fa-facebook-f text-white mr-2"></i> {{$t('auth.continueWith')}} Facebook
                        </fb-signin-button>
                        <!-- <button class="btn btn-lg btn-google btn-block text-uppercase" @click="loginGoogle('google')">
                            <i class="fa fa-google mr-2"></i> {{$t('auth.continueWith')}} Google
                        </button>
                        <button class="btn btn-lg btn-github  btn-block text-uppercase"
                                @click="loginGoogle('facebook')">
                            <i class="fa fa-facebook-f text-white mr-2"></i> {{$t('auth.continueWith')}} Facebook
                        </button> -->
                    </div>
                </div>
            </div>
        </div>
        <!--        Modal Terms of use-->
        <!-- Button trigger modal -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <span v-if="lang==='en'">TERMS AND CONDITIONS FOR THE INSTANTACLASSE WEBSITE </span>
                            <span v-if="lang==='fr'">Termes et conditions pour l’utilisation du site web d’INSTANTACLASSE</span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <terms :title="false"></terms>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Understood</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
    import {mapGetters} from "vuex";
    import Terms from "../Terms";

    export default {
        name: "Register",
        components: {Terms},
        data() {
            return {
                first_name: '',
                last_name: '',
                email: '',
                password1: '',
                password2: '',
                errorMessage: '',
                googleSignInParams: {
                    client_id: '5466659184-s2qvgg7uq9n94pjstr4duh8dg7ha7lbn.apps.googleusercontent.com'  
                },
                fbSignInParams: {
                    scope: 'email',
                    return_scopes: true
                },
            }
        },
        methods: {

            register() {
                if (this.password1 !== this.password2) {
                    this.errorMessage = "Password confirmation doesn't match Password";
                    return
                }
                this.$store.dispatch('register', {
                    first_name: this.first_name,
                    last_name: this.last_name,
                    email: this.email,
                    password: this.password1,
                })
                    .then(res => {
                        console.log(res)
                        this.$router.push({name: 'Email'})
                        // (res.data.user.roles[0].name === "teacher") ? this.$router.push({name: 'TeacherProfile'}) : this.$router.push({name: 'StudentProfile'});
                    })
                    .catch(err => {
                        // console.log(err.response.data.errors[Object.keys(err.response.data.errors)[0][0]]);
                        this.errorMessage = err.response.data.errors[Object.keys(err.response.data.errors)[0]]
                    })
            },
            // loginGithub() {
            //     this.$store.dispatch('socialStudentAuth', "google")
            //         .then((res) => {
            //             console.log(res);
            //             if (res.data.url) {
            //                 console.log(res.data.url);
            //                 window.location.href = res.data.url
            //             }
            //         })
            //         .catch(err => console.log(err))
            // },
            loginGoogle(provider) {
                this.$store.dispatch('socialStudentAuth', provider)
                    .then((res) => {
                        if (res.data.url) {
                            let r = this.$router.resolve({name: 'StudentProfile'});
                            window.location.assign(r.href)
                        }
                    })
                    .catch(err => console.log(err))
            },
            ongSignInSuccess (googleUser) {
                const profile = googleUser.getBasicProfile() // etc etc
                console.log(profile.getEmail());
                let payload = {
                    'name': profile.getName(),
                    'email': profile.getEmail(),
                    'role': 'student'
                };
                this.handleSocial(payload);
            },
            ongSignInError (error) {
                this.loginErrors = "Error occured durring facebook login."
                console.log('OH NOES', error)
            },
            onSignInSuccess (response) {
                const _this = this;

                FB.api('/me?fields=email,name', dude => {
                    let payload = {
                        'name': dude.name,
                        'email': dude.email,
                        'role': 'student'
                    };
                    _this.handleSocial(payload);
                })
            },
            onSignInError (error) {
                this.loginErrors = "Error occured durring facebook login."
                console.log('OH NOES', error)
            },
            handleSocial(payload) {
                this.$store.dispatch('handleTeacherSocial', payload)
                .then(res => {
                    if (res.data != null) {
                        let r = this.$router.resolve({name: 'StudentProfile'});
                        window.location.assign(r.href)
                    }
                })
                .catch(err => console.log(err))
            }
        },
        computed: mapGetters(["authLoading", "lang"])
    }
</script>

<style scoped>
    #bodyRegister {
    }

    .signup-form {
        margin: 0 auto;
        padding: 30px 0;
        border: 2px solid black;
        border-bottom: 2px solid black;
        border-radius: 5%;
    }

    .signup-form h2 {
        color: #636363;
        margin: 0 0 15px;
        position: relative;
        text-align: center;
    }

    .signup-form h2:before, .signup-form h2:after {
        content: "";
        height: 2px;
        width: 30%;
        background: #d4d4d4;
        position: absolute;
        top: 50%;
        z-index: 2;
    }

    .signup-form h2:before {
        left: 0;
    }

    .signup-form h2:after {
        right: 0;
    }

    .signup-form .hint-text {
        color: #999;
        margin-bottom: 30px;
        text-align: center;
    }

    .signup-form {
        color: #999;
        margin-bottom: 15px;
        padding: 20px;
        background: #ffffff;
        box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
    }

    .signup-form .form-group {
        margin-bottom: 20px;
    }

    .signup-form input[type="checkbox"] {
        margin-top: 3px;
    }

    .signup-form .btn {
        font-size: 16px;
        font-weight: bold;
        min-width: 140px;
        outline: none !important;
    }

    .signup-form .row div:first-child {
        padding-right: 10px;
    }

    .signup-form .row div:last-child {
        padding-left: 10px;
    }

    .signup-form a:hover {
        text-decoration: none;
    }


    .signup-form form a:hover {
        text-decoration: underline;
    }

    .btn-google {
        color: white;
        background-color: #ea4335
    }

    .btn-github {
        color: white;
        background: #4267B2;
    }

    .btn-github a {
        color: white;
    }

    .btn-google a {
        color: white;
    }

    input {
        border: 2px solid black !important;
        background: transparent;
    }

    .input-group-text {
        display: flex;
        align-items: center;
        padding: 0.375rem 0.75rem;
        margin-bottom: 0px;
        font-size: 0.9rem;
        font-weight: 400;
        line-height: 1.6;
        text-align: center;
        white-space: nowrap;
        background-color: transparent;
        border: none;
        border-radius: 0.25rem;
        margin-left: -40px;
        z-index: 1;
    }

    .hero {
        /*background-image: url('../../assets/images/demand/online.jpg');*/
        background: linear-gradient(rgba(19, 19, 19, 0), rgba(19, 19, 19, 0)), url('../../assets/images/auth/hero.jpg') no-repeat center center;
        height: 55vh;
        background-size: cover;
        border-bottom: 15px solid #3081FB;
        color: white;
    }
    @media (max-width: 600px) {
        .hero {
            /*background-image: url('../../assets/images/demand/online.jpg');*/
            background: linear-gradient(rgba(19, 19, 19, 0), rgba(19, 19, 19, 0)), url('../../assets/images/auth/hero.jpg') no-repeat center center;
            height: 30vh;
            background-size: cover;
            border-bottom: 15px solid #3081FB;
            color: white;
        }
    }
</style>
