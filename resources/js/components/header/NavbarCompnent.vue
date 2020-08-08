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
                        <router-link to="/" tag="a" class="nav-link">
                            Home
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/about" tag="a" class="nav-link">
                            About
                        </router-link>
                    </li>
                    <li class="nav-item dropdown">

                        <router-link to="#" tag="a" class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                                     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            All courses
                        </router-link>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Category 1</a>
                            <a class="dropdown-item" href="#">Category 2</a>
                            <a class="dropdown-item" href="#">Category 3</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#">Contact</a>
                    </li>
                    <li class="nav-item ">
                        <router-link to="/teacher/profile" tag="a" class="nav-link bg-danger text-white rounded">
                            Account
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
    computed: mapGetters(["isLoggedIn", "loggedInUser"])
}
</script>

<style scoped>
    .router-link-exact-active {
        font-weight: bolder;
    }
</style>
