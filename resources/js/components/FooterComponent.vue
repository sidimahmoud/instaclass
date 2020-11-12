<template>
    <!-- Footer -->
    <footer class="page-footer font-small">
        <!-- Footer Links -->
        <div class="container text-center text-md-left mt-5">

            <!-- Grid row -->
            <div class="row pt-3">

                <!-- Grid column -->
                <div class="text-white col-md-3">
                    <!-- Content -->
                    <h6 class="text-uppercase font-weight-bold mt-3">
                        <a class="navbar-brand text-primary font-weight-bolder" href="/">
                            <img src="../assets/logo.png" alt="" width="80px">
                        </a>
                        INSTANTACLASSE
                    </h6>

                </div><!-- Grid column -->
                <!-- Grid column -->
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <p class="h3 text-white text-center">
                                {{$t('footer.quickLinks')}}
                            </p>
                        </div>
                        <div class="col-md-8">
                            <p>
                                <router-link :to="{ name: 'Home'}" tag="a" class="text-uppercase">
                                    {{$t('footer.home')}}
                                </router-link>
                            </p>
                            <p>
                                <router-link :to="{ name: 'About'}" tag="a" class="text-uppercase">
                                    {{$t('footer.about')}}
                                </router-link>
                            </p>
                            <p>
                                <router-link :to="{ name: 'Courses'}" tag="a" class="text-uppercase">
                                    {{$t('footer.courses')}}
                                </router-link>
                            </p>
                            <p>
                                <router-link :to="{ name: 'Become'}" tag="a" class="text-uppercase">
                                    {{$t('footer.become')}}
                                </router-link>
                            </p>
                            <p>
                                <router-link :to="{ name: 'Contact'}" tag="a" class=" text-uppercase">
                                    {{$t('footer.contact')}}
                                </router-link>
                            </p>
                        </div><!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-4">

                            <!-- Links -->
                            <p>
                                <router-link :to="{ name: 'StudentProfile'}" tag="a" class=" text-uppercase">
                                    {{$t('footer.account')}}
                                </router-link>
                            </p>
                            <p>
                                <router-link to="#" tag="a" class=" text-uppercase">
                                    {{$t('footer.termsAndConditions')}}
                                </router-link>
                            </p>
                            <p>
                                <router-link :to="{ name: 'Faq'}" tag="a" class=" text-uppercase">
                                    {{$t('footer.faq')}}
                                </router-link>
                            </p>
                            <p>
                                <a href="#" class="text-uppercase"> {{$t('footer.privacy')}}</a>
                            </p>

                        </div><!-- Grid column -->
                        <!-- Grid column -->

                    </div>
                </div>
                <div class="col-md-3 align-content-center text-white mx-auto mb-md-0">
                    <p class="mt-2">
                        <a href=" https://www.facebook.com/InstantaClasse/?modal=admin_todo_tour " target="_blank">
                            <i class="fa fa-facebook  mr-3 fa-2x"></i>
                        </a>
                        <i class="fa fa-instagram  fa-2x"></i>
                    </p>
                    <p>
                        <img src="../assets/images/visa-mastercard.jpg" width="80px" alt="">
                    </p>
                </div>
                <!-- Grid column -->
            </div><!-- Grid row -->
        </div>
        <!-- Footer Links -->
        <!-- Copyright -->
        <div class="footer-copyright text-center text-capitalize text-white">
            ©2020, Société Instantavite inc
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
    }

    hr {
        background: #e2e2e2;
    }

    p {
        margin-bottom: 5px;
    }
</style>
