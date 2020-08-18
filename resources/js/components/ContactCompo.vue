<template>
    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact border-top border-primary">
        <div class="container mt-4">
            <div class="section-title text-center">
                <h2>Contact</h2>
                <p>N'hésitez pas à nous contacter en cas de quoi</p>
            </div>

            <div class="row">
                <div class="col-lg-5 d-flex align-items-stretch">
                    <div class="info">
                        <div class="address">
                            <i class="icofont-google-map"></i>
                            <h4>Location:</h4>
                            <p>Immeuble Instantclass, N°80, Cité NASR, Ksar</p>
                        </div>

                        <div class="email">
                            <i class="icofont-envelope"></i>
                            <h4>Email:</h4>
                            <p>info@instantclass.ca</p>
                        </div>

                        <div class="phone">
                            <i class="icofont-phone"></i>
                            <h4>Call:</h4>
                            <p>+222 45 24 36 29</p>
                        </div>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2988853.7590843295!2d-109.79811447563104!3d42.98243384900618!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x875ee23448e12e69%3A0x26b02279d27d382f!2sWyoming%2C%20USA!5e0!3m2!1sen!2s!4v1597695358591!5m2!1sen!2s" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>

                </div>

                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Votre nom</label>
                                <input type="text" name="name" class="form-control" id="name" data-rule="minlen:4"
                                       data-msg="Please enter at least 4 chars"/>
                                <div class="validate"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">Votre Email</label>
                                <input type="email" class="form-control" name="email" id="email" data-rule="email"
                                       data-msg="Please enter a valid email"/>
                                <div class="validate"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Objet</label>
                            <input type="text" class="form-control" name="subject" id="subject" data-rule="minlen:4"
                                   data-msg="Please enter at least 8 chars of subject"/>
                            <div class="validate"></div>
                        </div>
                        <div class="form-group">
                            <label for="name">Message</label>
                            <textarea class="form-control" name="message" rows="10" data-rule="required"
                                      data-msg="Please write something for us"></textarea>
                            <div class="validate"></div>
                        </div>
                        <div class="mb-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Votre message a étè transmis avec succée!</div>
                        </div>
                        <div class="text-center">
                            <button type="submit">Envoyer</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </section><!-- End Contact Us Section -->
</template>

<script>
    export default {
        name: "ContactCompo"
    }
</script>

<style scoped>
    .contact .info {
        border-top: 3px solid #2b63f3;
        border-bottom: 3px solid #2b63f3;
        padding: 30px;
        background: #fff;
        width: 100%;
        box-shadow: 0 0 24px 0 rgba(0, 0, 0, 0.12);
    }

    .contact .info i {
        font-size: 20px;
        color: #2b63f3;
        float: left;
        width: 44px;
        height: 44px;
        background: #fdf1ec;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50px;
        transition: all 0.3s ease-in-out;
    }

    .contact .info h4 {
        padding: 0 0 0 60px;
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 5px;
        color: #7a6960;
    }

    .contact .info p {
        padding: 0 0 10px 60px;
        margin-bottom: 20px;
        font-size: 14px;
        color: #ab9d95;
    }

    .contact .info .email p {
        padding-top: 5px;
    }

    .contact .info .social-links {
        padding-left: 60px;
    }

    .contact .info .social-links a {
        font-size: 18px;
        display: inline-block;
        background: #333;
        color: #fff;
        line-height: 1;
        padding: 8px 0;
        border-radius: 50%;
        text-align: center;
        width: 36px;
        height: 36px;
        transition: 0.3s;
        margin-right: 10px;
    }

    .contact .info .social-links a:hover {
        background: #2b63f3;
        color: #fff;
    }

    .contact .info .email:hover i, .contact .info .address:hover i, .contact .info .phone:hover i {
        background: #2b63f3;
        color: #fff;
    }

    .contact .php-email-form {
        width: 100%;
        border-top: 3px solid #2b63f3;
        border-bottom: 3px solid #2b63f3;
        padding: 30px;
        background: #fff;
        box-shadow: 0 0 24px 0 rgba(0, 0, 0, 0.12);
    }

    .contact .php-email-form .form-group {
        padding-bottom: 8px;
    }

    .contact .php-email-form .validate {
        display: none;
        color: red;
        margin: 0;
        font-weight: 400;
        font-size: 13px;
    }

    .contact .php-email-form .error-message {
        display: none;
        color: #fff;
        background: #ed3c0d;
        text-align: center;
        padding: 15px;
        font-weight: 600;
    }

    .contact .php-email-form .sent-message {
        display: none;
        color: #fff;
        background: #18d26e;
        text-align: center;
        padding: 15px;
        font-weight: 600;
    }

    .contact .php-email-form .loading {
        display: none;
        background: #fff;
        text-align: center;
        padding: 15px;
    }

    .contact .php-email-form .loading:before {
        content: "";
        display: inline-block;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        margin: 0 10px -6px 0;
        border: 3px solid #18d26e;
        border-top-color: #eee;
        -webkit-animation: animate-loading 1s linear infinite;
        animation: animate-loading 1s linear infinite;
    }

    .contact .php-email-form input, .contact .php-email-form textarea {
        border-radius: 0;
        box-shadow: none;
        font-size: 14px;
    }

    .contact .php-email-form input {
        height: 44px;
    }

    .contact .php-email-form textarea {
        padding: 10px 12px;
    }

    .contact .php-email-form button[type="submit"] {
        background: #2b63f3;
        border: 0;
        padding: 10px 24px;
        color: #fff;
        transition: 0.4s;
        border-radius: 4px;
    }

    .contact .php-email-form button[type="submit"]:hover {
        background: #ef7f4d;
    }

    @-webkit-keyframes animate-loading {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes animate-loading {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

</style>
