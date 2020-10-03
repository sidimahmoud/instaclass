<template>
    <div>
        <ul class="lang float-md-right mt-md-0 p-0">
            <li class="btn btn-light " v-if="locale==='fr'" @click="en">
                EN
            </li>
            <li class="btn btn-light" v-else @click="fr">
                FR
            </li>
            <li>
                <strong>
                    {{userProfile.first_name}}
                </strong>
            </li>
        </ul>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand text-primary font-weight-bolder" href="/">
                <img src="../../assets/logo.png" alt="" width="80px">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="form-inline  my-lg-0 mr-lg-2 w-50" @submit.prevent="search">

                    <div class="form-group w-100">
                        <input class="form-control  mr-sm-2 w-75" type="text"
                               :placeholder="$t('search')"
                               v-model="q" aria-label="Search">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">
                            {{$t("searchBtn")}}
                        </button>
                    </div>
                </form>
                <ul class="navbar-nav  justify-content-end" style="width:65%">
                    <li class="nav-item " v-if="!$route.matched.some(({ name }) => name === 'Home')">
                        <router-link :to="{ name: 'Home'}" tag="a" class="nav-link ">
                            {{$t('nav.home')}}

                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{ name: 'About'}" tag="a" class="nav-link">
                            {{$t('nav.about')}}

                        </router-link>
                    </li>
                    <li class="nav-item ">

                        <router-link :to="{ name: 'Courses'}" tag="a" class="nav-link ">
                            {{$t('nav.courses')}}
                        </router-link>

                    </li>
                    <li class="nav-item" v-if="isLoggedIn">
                        <router-link :to="{name: 'Signin'}" tag="a"
                                     class="nav-link">
                            {{$t('nav.become')}}
                        </router-link>
                    </li>
                    <li class="nav-item" v-else>
                        <router-link :to="{name: 'Signin'}" tag="a"
                                     class="nav-link bg-danger text-white rounded">
                            {{$t('nav.become')}}
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'Demande'}" tag="a"
                                     class="nav-link">
                            {{$t('nav.demande')}}
                        </router-link>
                    </li>


                    <li class="nav-item" v-if="!isLoggedIn">
                        <router-link :to="{name: 'TeacherProfile'}" tag="a"
                                     class="nav-link bg-danger text-white rounded">
                            {{$t('nav.account')}}
                        </router-link>
                    </li>
                    <li class="nav-item" v-else>
                        <router-link :to="{name: 'TeacherProfile'}" tag="a"
                                     class="nav-link bg-danger text-white rounded">
                            Account
                        </router-link>
                    </li>

                </ul>
            </div>
        </nav>
    </div>

</template>
<script>
    import {mapGetters, mapActions} from 'vuex'
    import i18n from "../../src/i18n";

    export default {
        name: 'AppNav',
        computed: mapGetters(["isLoggedIn", "userProfile"]),
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
                        this.$router.push('/')
                    })
            },
            search() {
                this.$store.dispatch('search', this.q)
                    .then(res => this.$router.push({name: 'Search'}))
            },
            ...mapActions(["fetchProfile"])
        },
        created() {
            this.fetchProfile()
        }
    }

</script>

<style scoped>
    .router-link-exact-active {
        font-weight: bolder;
    }

    .lang {
        list-style-type: none;
        margin-top: 0;
        float: right;
    }
</style>
