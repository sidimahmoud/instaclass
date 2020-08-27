<template>
    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact border-top border-primary">
        <div class="container mt-4">
            <div class="section-title text-center">
                <div class="row">
                    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto ">
                        <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="alert">
                         <i class="fa fa-check text-success fa-2x mr-2"></i>
                            {{alert}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>

                <h2>Contact</h2>
                <p>Contactez nous pour toutes questions ou commentaires</p>
            </div>

            <div class="row">
                <div class="col-12 mt-5 mt-lg-0 d-flex align-items-stretch">
                    <form  class="php-email-form" @submit.prevent="send">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="name">Votre nom</label>
                                <input type="text" name="name" class="form-control" id="name" data-rule="minlen:4"
                                       data-msg="Please enter at least 4 chars" required v-model="name" />
                                <div class="validate"></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="name">Votre Email</label>
                                <input type="email" class="form-control" name="email" id="email" data-rule="email"
                                       data-msg="Please enter a valid email" required v-model="email" />
                                <div class="validate"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Message</label>
                            <textarea class="form-control" name="message" rows="10" data-rule="required"
                                      data-msg="Please write something for us"
                            required v-model="msg"></textarea>
                            <div class="validate"></div>
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
        name: "ContactCompo",
        data() {
            return {
                name: '',
                email: '',
                msg: '',
                alert: ''
            }
        },
        methods: {
            send() {
                let payload = {
                    name: this.name,
                    email: this.email,
                    message: this.msg,
                };
                this.$store.dispatch('contacter', payload)
                    .then(res => {
                        this.alert = res.data;
                        this.name = '';
                        this.email = '';
                        this.msg = '';
                    })
            }
        }
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
