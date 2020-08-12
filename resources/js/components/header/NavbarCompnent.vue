<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand text-primary font-weight-bolder" href="/">INSTANTCLASS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <router-link :to="{ name: 'Home'}" tag="a" class="nav-link">
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
                        <router-link :to="{ name: 'Contact'}" tag="a" class="nav-link">
                            Contact
                        </router-link>
                    </li>
                    <li class="nav-item" v-if="isLoggedIn">
                        <router-link :to="{name: 'TeacherProfile'}" tag="a"
                                     class="nav-link bg-danger text-white rounded">
                            Account
                        </router-link>
                    </li>
                    <li class="nav-item" v-if="isLoggedIn">
                        <a class="nav-link" >
                            <span @click="logout">
                                Logout
                            </span>
                        </a>
                    </li>
                    <li class="nav-item" v-if="!isLoggedIn">
                        <router-link :to="{ name: 'Login'}" tag="a" class="nav-link ">
                            Login
                        </router-link>
                    </li>
                    <li class="nav-item" v-if="!isLoggedIn">
                        <router-link :to="{ name: 'Register'}" tag="a" class="nav-link bg-secondary text-white rounded">
                            Register
                        </router-link>
                    </li>
                    <li class="nav-item dropdown border border-primary ml-2 rounded">
                        <a class="nav-link dropdown-toggle" href="#" id="langDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            FR
                        </a>
                        <div class="dropdown-menu" aria-labelledby="langDropdown">
                            <a class="dropdown-item" href="#">FR</a>
                            <a class="dropdown-item" href="#">EN</a>
                        </div>
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
