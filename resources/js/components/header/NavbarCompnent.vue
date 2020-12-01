<template>
    <div class="px-5">
        <nav id= "nav-main" class="navbar navbar-expand-lg navbar-light bg-light py-0 fixed-top">
            <div class="container rounded-bottom">
                <!-- <div class="annonce"></div><br/> -->
                <a href="/" class="navbar-brand">
                    <img src="../../assets/logo.png" alt="" width="60px">
                </a>
                <!--                <ul class="lang text-center p-0 text-primary">-->
                <!--                    <span class="nav-item" v-if="isLoggedIn">{{$t('hello')}}, {{loggedInUser.first_name}}</span>-->
                <!--                    <li class="btn" v-if="locale==='fr'" @click="en">-->
                <!--                        <strong>EN</strong>-->
                <!--                    </li>-->
                <!--                    <li class="btn " v-else @click="fr">-->
                <!--                        <strong>FR</strong>-->
                <!--                    </li>-->
                <!--                    &lt;!&ndash;                <li v-if="isLoggedIn && !$route.matched.some(({ name }) => name === 'Home')">&ndash;&gt;-->
                <!--                    &lt;!&ndash;                    Welcome <strong>&ndash;&gt;-->
                <!--                    &lt;!&ndash;                    {{userProfile.first_name}}&ndash;&gt;-->
                <!--                    &lt;!&ndash;                </strong>&ndash;&gt;-->
                <!--                    &lt;!&ndash;                </li>&ndash;&gt;-->
                <!--                </ul>-->
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!--                <form class="form-inline  my-lg-0 mr-lg-2 w-50" @submit.prevent="search">-->

                    <!--                    <div class="form-group w-100">-->
                    <!--                        <input class="form-control  mr-sm-2 w-75" type="text"-->
                    <!--                               :placeholder="$t('search')"-->
                    <!--                               v-model="q" aria-label="Search">-->
                    <!--                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">-->
                    <!--                            {{$t("searchBtn")}}-->
                    <!--                        </button>-->
                    <!--                    </div>-->
                    <!--                </form>-->


                    <ul class="navbar-nav  justify-content-center  align-items-center w-100 ">

                        <li class="nav-item " v-if="!$route.matched.some(({ name }) => name === 'Home')">
                            <router-link :to="{ name: 'Home'}" tag="a" class="nav-link " data-toggle="collapse"
                                         data-target=".navbar-collapse.show">
                                {{$t('nav.home')}}
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'About'}" tag="a" class="nav-link" data-toggle="collapse"
                                         data-target=".navbar-collapse.show">
                                {{$t('nav.about')}}

                            </router-link>
                        </li>
                        <li class="nav-item">

                            <router-link :to="{ name: 'Courses'}" tag="a" class="nav-link" data-toggle="collapse"
                                         data-target=".navbar-collapse.show">
                                {{$t('nav.courses')}}
                            </router-link>

                        </li>
                        <li class="nav-item" v-if="isLoggedIn">
                            <router-link :to="{name: 'Signin'}" tag="a"
                                         class="nav-link" data-toggle="collapse" data-target=".navbar-collapse.show">
                                {{$t('nav.become')}}
                            </router-link>
                        </li>
                        <li class="nav-item" v-else>
                            <router-link :to="{name: 'Signin'}" tag="a"
                                         class="nav-link" data-toggle="collapse" data-target=".navbar-collapse.show">
                                {{$t('nav.become')}}
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{name: 'Demande'}" tag="a"
                                         class="nav-link" data-toggle="collapse" data-target=".navbar-collapse.show">
                                {{$t('nav.demande')}}
                            </router-link>
                        </li>
                        <li class="nav-item" v-if="!isLoggedIn">
                            <router-link :to="{name: 'TeacherProfile'}" tag="a"
                                         class="nav-link " data-toggle="collapse" data-target=".navbar-collapse.show">
                                {{$t('nav.account')}}
                            </router-link>
                        </li>
                         <li class="nav-item mr-md-5" v-else>
                            <!-- <router-link :to="{name: 'TeacherProfile'}" tag="a"
                                         class="nav-link" data-toggle="collapse" data-target=".navbar-collapse.show">
                                {{$t('nav.account')}}

                            </router-link> -->
                            <!-- <li class="nav-item dropdown mr-md-5" v-else>
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <el-button type="info" @click="handleProfile">
                                        {{$t('nav.account')}}<i class="el-icon-arrow-down el-icon--right"></i>
                                    </el-button>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <span class="dropdown-item" @click="handlePayments">{{$t('profile.payments')}}</span>
                                    <span class="dropdown-item" @click="handleRatings">{{$t('profile.ratings')}}</span>
                                    <span class="dropdown-item" @click="PersonalInfo">{{$t('profile.pers_info')}}</span>
                                    <div class="dropdown-divider"></div>
                                    <span class="dropdown-item" @click="logout">{{$t('profile.logout')}}</span>
                                </div>
                            </li> -->
                            <div class="dropdown">
                                <el-dropdown>
                                    <el-button type="info" @click="handleProfile">
                                        {{$t('nav.account')}}<i class="el-icon-arrow-down el-icon--right"></i>
                                    </el-button>
                                    <el-dropdown-menu slot="dropdown">
                                        <el-dropdown-item @click.native="handlePayments">{{$t('profile.payments')}}</el-dropdown-item>
                                        <el-dropdown-item @click.native="handleRatings">{{$t('profile.ratings')}}</el-dropdown-item>
                                        <el-dropdown-item @click.native="PersonalInfo">{{$t('profile.pers_info')}}</el-dropdown-item>
                                        <el-dropdown-item @click.native="logout">{{$t('profile.logout')}}</el-dropdown-item>
                                    </el-dropdown-menu>
                                </el-dropdown>
                            </div>
                        </li>
                        <!--                        Lang-->


                        <span class="nav-item d-sm-flex" v-if="isLoggedIn">{{$t('hello')}} {{getFistName(loggedInUser.first_name)}}</span>
<!--                        <span class="nav-item d-none d-sm-flex " >{{$t('hello')}}</span>-->
                        <li class="btn ml-md-5 text-primary" data-toggle="collapse"
                            data-target=".navbar-collapse.show" v-if="locale==='fr'" @click="en">
                            <strong>EN</strong>
                        </li>
                        <li class="btn ml-md-5 text-primary" data-toggle="collapse"
                            data-target=".navbar-collapse.show" v-else @click="fr">
                            <strong>FR</strong>
                        </li>
                    </ul>


                </div>
            </div>

        </nav>
    </div>

</template>
<script>
    import {mapGetters, mapActions} from 'vuex'
    import i18n from "../../src/i18n";
    import $ from 'jquery';

    $('.navbar-nav a').on('click', function(){
        $('.navbar-collapse').click(); //bootstrap 4.x
    });

    export default {
        name: 'AppNav',
        computed: mapGetters(["isLoggedIn", "loggedInUser"]),
        data() {
            return {
                q: '',
                locale: 'en',
                show: false
            }
        },
        methods: {
            en() {
                i18n.locale = "en";
                this.locale = "en";
            },
            fr() {
                i18n.locale = "fr";
                this.locale = "fr";

            },
            logout() {
                this.$store.dispatch('logout')
                    .then(() => {
                        let r = this.$router.resolve({name: 'Home'});
                        window.location.assign(r.href)
                    })
            },
            search() {
                this.$store.dispatch('search', this.q)
                    .then(res => this.$router.push({name: 'Search'}))
            },
            ...mapActions(["fetchProfile"]),
            handleRatings() {
                this.$router.push({name: 'TeacherRatings'})
            },
            handlePayments () {
                this.$root.$emit('bv::toggle::collapse', 'nav-collapse')
                this.$router.push({name: 'Studentpayments'})
            },
            handleProfile() {
                this.$router.push({name: 'TeacherProfile'})
            },
            PersonalInfo() {
                this.$router.push({name: 'TeacherInfo'})
            },
            getFistName(str) {
             return str.split(" ")[0];
            }
        },
        created() {
            console.log(this.loggedInUser);
            if (this.isLoggedIn)
                this.fetchProfile()
        }
    }

</script>

<style scoped lang="scss">

    .router-link-exact-active {
        font-weight: bolder;
        background-color: red;
        border-bottom-right-radius: 10px;
        border-bottom-left-radius: 10px;
        color: white !important;
    }

    .router-link-exact-active:hover {
        color: white !important;
    }

    a {
        font-weight: bolder;
        color: blue !important;
        margin-right: 20px;
    }

    a:hover {
        color: red !important;
    }

    .lang {
        list-style-type: none;
        margin-top: 0;
        position: absolute;
        right: 40px !important;
        z-index: 1;
        @media only screen and (max-width: 991px) {
            margin-top: 10px;
            margin-right: 15px;
        }
    }

    .nav-link {
        padding: 20px;
    }

    .annonce {
        width: 100%;
        height: 70px;
        background-image: url('../../assets/images/banniere.jpg');
        border-radius: 0 0 0 0;
        background-repeat: no-repeat;
        background-size: cover;
        @media only screen and (max-width: 600px) {
            border-radius: 0;
        }
    }

    .menu-marign {
        margin-top: 70px;
    }

</style>
