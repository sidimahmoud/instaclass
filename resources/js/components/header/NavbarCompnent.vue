<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand text-primary font-weight-bolder" href="/">
                <img src="../../assets/logo.png" alt="" width="60px">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav ">
                    <form class="form-inline my-2 my-lg-0 mr-lg-2">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search for courses"
                               v-model="search" aria-label="Search">
                        <router-link :to="{name: 'Search', params:{q:search}}"
                                     class="btn btn-outline-primary my-2 my-sm-0" type="submit">
                            Search
                        </router-link>
                    </form>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item " v-if="!$route.matched.some(({ name }) => name === 'Home')">
                        <router-link :to="{ name: 'Home'}" tag="a" class="nav-link ">
                            Home
                        </router-link>
                    </li>
                    <li class="nav-item ">

                        <router-link :to="{ name: 'Courses'}" tag="a" class="nav-link ">
                            All courses
                        </router-link>

                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'Demande'}" tag="a"
                                     class="nav-link">
                            Demande de cours
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'Signin'}" tag="a"
                                     class="nav-link bg-danger text-white rounded">
                            Become Instructor
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{ name: 'About'}" tag="a" class="nav-link">
                            About
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link :to="{name: 'TeacherProfile'}" tag="a"
                                     class="nav-link ">
                            Account
                        </router-link>
                    </li>
                    <li class="nav-item " v-if="this.$route.path.includes('/fr')">
                        <router-link :to="{ name: 'Home'}" tag="a" class="nav-link border border-primary ml-2 rounded">
                            EN
                        </router-link>
                    </li>
                    <li class="nav-item " v-else>
                        <router-link :to="{ name: 'HomeFr'}" tag="a"
                                     class="nav-link border border-primary ml-2 rounded">
                            FR
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
<script>
    import {mapGetters} from 'vuex'

    export default {
        name: 'AppNav',
        computed: mapGetters(["isLoggedIn"]),
        data() {
            return {
                search: '',
            }
        },
        methods: {
            logout() {
                this.$store.dispatch('logout')
                    .then(() => {
                        this.$router.push('/')
                    })
            }
        }
    }
</script>

<style scoped>
    .router-link-exact-active {
        font-weight: bolder;
    }
</style>
