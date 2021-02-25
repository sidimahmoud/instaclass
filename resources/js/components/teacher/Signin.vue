<template>
    <div>
        <section class="hero pt-5 mb-3">
            <div class="text-home-slogan">
                <h3>{{$t('become_title.1')}}</h3>
                <p>{{$t('become_title.2')}}</p>
            </div>
        </section>

        <section class="why-us-section">
            <h2 class="weight-bold text-center text-primary">{{ $t('why_us') }} ?</h2>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <h4>{{$t('sign_why.1.title')}}</h4>
                    <p>{{$t('sign_why.1.body')}}</p>
                </div>
                <div class="col-md-3 col-sm-6">
                    <h4>{{$t('sign_why.2.title')}}</h4>
                    <p>{{$t('sign_why.2.body')}}</p>
                </div>
                <div class="col-md-3 col-sm-6">
                    <h4>{{$t('sign_why.3.title')}}</h4>
                    <p>{{$t('sign_why.3.body')}}</p>
                </div>
                <div class="col-md-3 col-sm-6">
                    <h4>{{$t('sign_why.3.title')}}</h4>
                    <ul>
                        <li>{{ $t('sign_why.4.body.1') }}</li>
                        <li>{{ $t('sign_why.4.body.2') }}</li>
                        <li>{{ $t('sign_why.4.body.3') }}</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="why-us-section">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <h2>{{$t('video_section.title')}}</h2>
                    <p>{{$t('video_section.body')}}</p>
                    <p>{{$t('video_section.body1')}}</p>
                    <p>{{$t('video_section.body2')}}</p>
                    <p>{{$t('video_section.body3')}}</p>
                    <p>{{$t('video_section.body4')}}</p>
                    <p>{{$t('video_section.body5')}}</p>
                    <p>{{$t('video_section.body6')}}</p>
                </div>
                <div class="col-md-6 col-sm-12">
                   <my-video :sources="video.sources" :options="video.options"></my-video>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-10 col-lg-7 mx-auto">
                    <!-- <div class="text-center"><strong>{{$t('banne_teacher')}}</strong></div> -->
                    <div class="signup-form bg-white">
                        <div class="row text-dark font-weight-bold d-none d-md-block">
                            <div class="col-md-12 mx-auto d-flex align-items-center">
                                <div class="col-md-3 col-sm-6">{{$t('auth.become.1')}}</div>
                                <div class="col-md-1 col-sm-6"><i class="fa fa-angle-double-right fa-5x"></i> </div>
                                <div class="col-md-3 col-sm-6">{{$t('auth.become.2')}}</div>
                                <div class="col-md-1 col-sm-6"><i class="fa fa-angle-double-right fa-5x"></i> </div>
                                <div class="col-md-2 col-sm-6">{{$t('auth.become.3')}}</div>
                                <div class="col-md-1 col-sm-6"><i class="fa fa-angle-double-right fa-5x"></i> </div>
                                <div class="col-md-1 col-sm-6">{{$t('auth.become.4')}}</div>
                            </div>

                        </div>
                        <form method="post" @submit.prevent="login">
                            <h4 class="text-uppercase text-center text-dark mt-3">{{$t('auth.become.getStarted')}}</h4>
                            <h2>{{$t('auth.signIn')}}</h2>
                            <!-- <p class="hint-text">{{$t('auth.become.login')}}
                            </p> -->
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"
                                 v-if="errorMessage">
                                <strong>Error!</strong> {{errorMessage}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control form-control-lg md-outline" name="email"
                                       placeholder="Email"
                                       required="required" v-model="email" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2"><i
                                        class="fa fa-envelope"/></span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control form-control-lg" name="password"
                                       :placeholder="$t('auth.password')"
                                       required="required" v-model="password" aria-describedby="basic-addon">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon"><i
                                        class="fa fa-lock"/></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-dark btn-lg btn-block ">
                                    <span v-if="!authLoading">{{$t('auth.signIn')}}</span>
                                    <div class="text-center text-white" v-if="authLoading">
                                        <span class="spinner-border spinner-border-sm" role="staitus"
                                              aria-hidden="true"/>
                                        Loading...
                                    </div>
                                </button>
                            </div>
                        </form>
                        <div>
                            <p class="font weight-bold text-center text-primary">
                                <router-link :to="{name: 'ResetPassword'}">
                                    {{$t('auth.forget')}}
                                </router-link>
                            </p>
                            <div class="text-center">{{$t('auth.new')}}
                                <router-link :to="{name: 'Become'}">{{$t('auth.signup')}}</router-link>
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
                            <!-- <button class="btn btn-lg btn-google btn-block text-uppercase" @click="authLogin('google')">
                                <i class="fa fa-google mr-2"></i> {{$t('auth.continueWith')}} Google
                            </button>
                            <button class="btn btn-lg btn-github  btn-block text-uppercase"
                                    @click="authLogin('facebook')">
                                <i class="fa fa-facebook-f text-white mr-2"></i> {{$t('auth.continueWith')}} Facebook
                            </button> -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</template>

<script>
    import {mapGetters} from 'vuex'
    import myVideo from 'vue-video'

    export default {

        name: "Login",
        components: {
            myVideo
        },
        data() {
            return {
                email: '',
                password: '',
                errorMessage: '',
                googleSignInParams: {
                    client_id: '5466659184-s2qvgg7uq9n94pjstr4duh8dg7ha7lbn.apps.googleusercontent.com'  
                },
                fbSignInParams: {
                    scope: 'email',
                    return_scopes: true
                },
                video: {
                    sources: [{
                        src: 'https://firebasestorage.googleapis.com/v0/b/instaclass-9f27f.appspot.com/o/instaclass%2FInstantaclasse%20Video%20promo%20Francais.mp4?alt=media&token=a30759f0-a10c-4185-9ae0-3a72b0d07126',
                        type: 'video/mp4'
                    }],
                    options: {
                        autoplay: false,
                        volume: 0.6,
                        poster: 'https://firebasestorage.googleapis.com/v0/b/instaclass-9f27f.appspot.com/o/instaclass%2Fonline.jpg?alt=media&token=5f31b6be-063f-456e-842e-2e14aa855142'
                    }
                }
            }
        },
        methods: {
            login() {
                let email = this.email;
                let password = this.password;
                this.$store.dispatch('login', {email, password})
                    .then(res => {
                        if (this.$route.query.redirect) {
                            let r = this.$router.resolve({path: this.$route.query.redirect});
                            window.location.assign(r.href)
                        }
                        if(res.data.user.roles[0].name === "teacher") {
                            let r = this.$router.resolve({name: 'StudentProfile'});
                            window.location.assign(r.href)
                        }else {
                            this.$alert(this.$t('no_teacher_account_msg'), '', {
                                confirmButtonText: 'OK',
                            }).then(() => {
                                this.$store.dispatch('logout')
                            });
                            //this.errorMessage = "No teacher account with this email please verify.";
                        }
                            /* this.$router.push({name: 'TeacherProfile'}) :
                            (res.data.user.roles[0].name === "student") ?
                                this.$router.push({name: 'StudentProfile'}) : this.$router.push({name: 'Admin'}); */
                    })
                    .catch(err => {
                        console.log(err.response.data);
                        this.errorMessage = err.response.data.message
                        /* this.errorMessage = err.response.data.message
                        err.response.data.message === "email unverified" ? this.$router.push({name: 'Email'}) :
                            this.errorMessage = "Please verify your Email address or password and try again"; */
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
            authLogin(provider) {
                this.$store.dispatch('socialTeacherAuth', provider)
                    .then(res => {
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
                    'role': 'teacher'
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
                        'role': 'teacher'
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
                        let r = this.$router.resolve({name: 'TeacherProfile'});
                        window.location.assign(r.href)
                    }
                })
                .catch(err => console.log(err))
            },
            handlePIP(e) {
                this.isPip = e;
            },
            handlePipOpenFailure(err) {
                console.log('Video failed to enter Picture-in-Picture mode.', err);
            },
            handlePipExitFailure(err) {
                console.log('Video failed to leave Picture-in-Picture mode.', err);
            },
        },
        computed: mapGetters(["authLoading"])
    }
</script>

<style scoped>
    .hero {
        /*background-image: url('../../assets/images/demand/online.jpg');*/
        background: linear-gradient(rgba(19, 19, 19, 0.5), rgba(19, 19, 19, 0.5)), url('../../assets/images/auth/Become1.jpg') no-repeat center center;
        height: 60vh;
        background-size: cover;
        border-bottom: 15px solid #3081FB;
        color: white;
    }

    .signup-form {
        margin: 0 auto;
        margin-bottom: 15px;
        background: #ffffff;
        border: 2px solid black;
        border-bottom: 2px solid black;
        border-radius: 5%;
        padding: 20px;

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
        background: #000;
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
        color: #000;
        margin-bottom: 30px;
        text-align: center;
    }

    .signup-form {
        color: #999;
        margin-bottom: 15px;
        background: #ffffff;
        box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
        padding: 30px;
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

    .md-form.md-outline label.active {
        background: #eeeeef;
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
    @media (max-width: 600px) {
        .hero {
            /*background-image: url('../../assets/images/demand/online.jpg');*/
            background: linear-gradient(rgba(19, 19, 19, 0.5), rgba(19, 19, 19, 0.5)), url('../../assets/images/auth/Become1.jpg') no-repeat center center;
            height: 30vh;
            background-size: cover;
            border-bottom: 15px solid #3081FB;
            color: white;
        }
    }

    .text-home-slogan {
        display: none;
    }

    @media only screen and (min-width: 600px) {
        .text-home-slogan {
            display: block;
            float: right;
            margin-top: 100px;
            margin-left: 30px;
            font-weight: 600;
        }
    }

    .why-us-section {
        background-color: #eee;
        padding: 20px;
        width: 100%;
        margin-bottom: 10px;
    }
</style>
