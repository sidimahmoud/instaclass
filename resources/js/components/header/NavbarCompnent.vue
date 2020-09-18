<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand text-primary font-weight-bolder" href="/">
                <img src="../../assets/logo.png" alt="" width="80px">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav ">
                    <form class="form-inline my-2 my-lg-0 mr-lg-2" @submit.prevent="search">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search for courses"
                               v-model="q" aria-label="Search">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">
                            Search
                        </button>
                    </form>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item " v-if="!$route.matched.some(({ name }) => name === 'Home')">
                        <router-link :to="{ name: 'Home'}" tag="a" class="nav-link ">
                            Home
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{ name: 'About'}" tag="a" class="nav-link">
                            About
                        </router-link>
                    </li>
                    <li class="nav-item ">

                        <router-link :to="{ name: 'Courses'}" tag="a" class="nav-link ">
                            All courses
                        </router-link>

                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'Become'}" tag="a"
                                     class="nav-link bg-danger text-white rounded">
                            Become Instructor
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'Demande'}" tag="a"
                                     class="nav-link">
                            Demande de cours
                        </router-link>
                    </li>


                    <li class="nav-item">
                        <router-link :to="{name: 'TeacherProfile'}" tag="a"
                                     class="nav-link ">
                            Account
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
        <ul class="lang float-md-right mt-md-0">
            <li class="nav-item " v-if="this.$route.path.includes('/fr')">
                <router-link :to="{ name: 'Home'}" tag="a" class="nav-link ml-2 rounded">
                    EN
                </router-link>
            </li>
            <li class="nav-item " v-else>
                <router-link :to="{ name: 'HomeFr'}" tag="a"
                             class="nav-link ml-2 rounded">
                    FR
                </router-link>
            </li>
        </ul>
    </nav>
</template>
<script>
    import {mapGetters} from 'vuex'

    export default {
        name: 'AppNav',
        computed: mapGetters(["isLoggedIn"]),
        data() {
            return {
                q: '',
            }
        },
        methods: {
            logout() {
                this.$store.dispatch('logout')
                    .then(() => {
                        this.$router.push('/')
                    })
            },
            search() {
                this.$store.dispatch('search', this.q)
                    .then(res => this.$router.push({name: 'Search'}))
            }
        }
    }
</script>

<style scoped>
    .router-link-exact-active {
        font-weight: bolder;
    }
    .lang{
        list-style-type: none;
        margin-top:0;
        float: right;
    }
</style>
