<template>
    <div class="px-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-light py-0 fixed-top">
            <div class="container rounded-bottom">
                <a href="/" class="navbar-brand">
                    <img src="../../assets/logo.png" alt="" width="60px">
                </a>
                <ul class="lang text-center p-0 text-primary">
                    <span class="nav-item" v-if="isLoggedIn">{{$t('hello')}}, {{loggedInUser.first_name}}</span>
                    <li class="btn" v-if="locale==='fr'" @click="en">
                        <strong>EN</strong>
                    </li>
                    <li class="btn " v-else @click="fr">
                        <strong>FR</strong>
                    </li>
                    <!--                <li v-if="isLoggedIn && !$route.matched.some(({ name }) => name === 'Home')">-->
                    <!--                    Welcome <strong>-->
                    <!--                    {{userProfile.first_name}}-->
                    <!--                </strong>-->
                    <!--                </li>-->
                </ul>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
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
                        <li class="nav-item" v-else>
                            <!-- <router-link :to="{name: 'TeacherProfile'}" tag="a"
                                         class="nav-link" data-toggle="collapse" data-target=".navbar-collapse.show">
                                {{$t('nav.account')}}

                            </router-link> -->
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{$t('nav.account')}}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="/teacher/profile">Profile</a>
                                    <a class="dropdown-item" @click="logout">Logout</a>
                                </div>
                            </div>
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

    export default {
        name: 'AppNav',
        computed: mapGetters(["isLoggedIn", "loggedInUser"]),
        data() {
            return {
                q: '',
                locale: 'en',
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
                        window.location.reload
                    })
            },
            search() {
                this.$store.dispatch('search', this.q)
                    .then(res => this.$router.push({name: 'Search'}))
            },
            ...mapActions(["fetchProfile"])
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

</style>
