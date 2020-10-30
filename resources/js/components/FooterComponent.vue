<template>
    <!-- Footer -->
    <footer class="page-footer font-small">
        <!-- Footer Links -->
        <div class="container text-center text-md-left mt-5">

            <!-- Grid row -->
            <div class="row pt-5">

                <!-- Grid column -->
                <div class="text-white col-md-3">
                    <!-- Content -->
                    <h6 class="text-uppercase font-weight-bold mt-3">
                        <a class="navbar-brand text-primary font-weight-bolder" href="/">
                            <img src="../assets/logo.png" alt="" width="80px">
                        </a>
                        INSTANTACLASSE
                    </h6>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus,
                        adipisci asperiores
                        aspernatur autem
                    </p>
                </div><!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3">
                    <p class="h3 text-white">
                        Quick Links
                    </p>
                    <p>
                        <router-link :to="{ name: 'Home'}" tag="a" class="text-uppercase">
                            Home
                        </router-link>
                    </p>
                    <p>
                        <router-link :to="{ name: 'About'}" tag="a" class="text-uppercase">
                            About us
                        </router-link>
                    </p>
                    <p>
                        <router-link :to="{ name: 'Courses'}" tag="a" class="text-uppercase">
                            our courses
                        </router-link>
                    </p>
                    <p>
                        <router-link :to="{ name: 'Become'}" tag="a" class="text-uppercase">
                            Become Instructor
                        </router-link>
                    </p>

                </div><!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3">

                    <!-- Links -->
                    <p>
                        <router-link :to="{ name: 'StudentProfile'}" tag="a" class=" text-uppercase">
                            Account
                        </router-link>
                    </p>
                    <p>
                        <router-link to="#" tag="a" class=" text-uppercase">
                            Terms & Conditions
                        </router-link>
                    </p>
                    <p>
                        <router-link :to="{ name: 'Faq'}" tag="a" class=" text-uppercase">
                            FAQ
                        </router-link>
                    </p>
                    <p>
                        <a href="#" class="text-uppercase"> Privacy policy</a>
                    </p>
                    <p>
                        <router-link :to="{ name: 'Contact'}" tag="a" class=" text-uppercase">
                            Contact us
                        </router-link>
                    </p>
                </div><!-- Grid column -->
                <!-- Grid column -->
                <div class="col-md-3 align-content-center text-white mx-auto mb-md-0">
                    <p class="h3">
                        Contact Info
                    </p>
                    <p>
                        <i class="fa fa-home mr-2"></i> No: 100 , Avenue Road,
                        NewYork, United States
                    </p>
                    <p>
                        <i class="fa fa-phone mr-2"></i> +22 54455454
                    </p>
                    <p>
                        <i class="fa fa-envelope mr-2"></i> example@gmail.com
                    </p>
                </div><!-- Grid column -->
            </div><!-- Grid row -->
        </div>
        <!-- Footer Links -->
        <hr>
        <!-- Copyright -->
        <div class="footer-copyright text-center py-3 text-capitalize text-white">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        © 2020 Copyright:
                        <a href="https://instantaclasse.ca/" class="text-lowercase">instantaclasse.ca</a>
                    </div>
                    <div class="col-6">
                        <p class="mt-2">
                            <a href=" https://www.facebook.com/InstantaClasse/?modal=admin_todo_tour " target="_blank">
                                <i class="fa fa-facebook  mr-3 fa-2x"></i>
                            </a>
                            <i class="fa fa-instagram  fa-2x"></i>
                        </p>
                    </div>
                </div>
            </div>
        </div><!-- Grid column -->
    </footer><!-- Footer -->
</template>

<script>
</script>

<style scoped>
    /*  footer link */
    footer a {
        color: #FFFEFE !important;
    }

    .page-footer {
        background-color: #000 !important;
        margin-top: -50px;
    }

    hr {
        background: #e2e2e2;
    }
</style>
