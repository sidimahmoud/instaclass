<template>
    <!-- Footer -->
    <footer class="page-footer font-small">

        <!-- Footer Links -->
        <div class="container text-center text-md-left mt-5">

            <!-- Grid row -->
            <div class="row pt-5 text-center">

                <!-- Grid column -->
                <div class="col-md-3">
                    <!-- Content -->
                    <h6 class="text-uppercase font-weight-bold text-white mt-3">
                        <a class="navbar-brand text-primary font-weight-bolder" href="/">
                            <img src="../assets/logo.png" alt="" width="80px">
                        </a>
                    </h6>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3">

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

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3">

                    <!-- Links -->
                    <p>
                        <a href="#" class="text-uppercase">faq</a>
                    </p>

                    <p>
                        <a href="#" class="text-uppercase">privacy policy</a>
                    </p>
                    <p>
                        <a href="#" class="text-uppercase"> Terms & conditions</a>
                    </p>
                    <p>
                        <router-link :to="{ name: 'Contact'}" tag="a" class=" text-uppercase">
                            Contact us
                        </router-link>
                    </p>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 align-content-center text-white mx-auto mb-md-0">
                    <p>Share</p>
                    <p>Instantclass On Social Media</p>
                    <p class="mt-2">
                        <i class="fa fa-facebook  mr-3"></i>
                        <i class="fa fa-twitter  mr-3"></i>
                        <i class="fa fa-linkedin  mr-3"></i>
                        <i class="fa fa-instagram  mr-3"></i>
                    </p>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
        <!-- Footer Links -->
        <hr>
        <!-- Copyright -->
        <div class="footer-copyright text-center py-3 text-capitalize text-white">
            © 2020 Copyright:
            <a href="https://instantclass.ca/">instantclass.ca</a>
        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->

</template>

<script>

</script>

<style scoped>
    /*  footer link */
    footer a {
        color: #FFFEFE !important;
    }

    .page-footer {
        background-color: #0e0938 !important;
        margin-top: 25vh;
    }

    hr {
        background: #e2e2e2;
    }
</style>
