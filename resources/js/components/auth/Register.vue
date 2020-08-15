<template>
    <div id="bodyRegister">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="signup-form">
                        <form method="post">
                            <h2>Register</h2>
                            <p class="hint-text">Create your account. It's free and only takes a minute.</p>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" name="first_name"
                                               placeholder="First Name" required="required">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="last_name" placeholder="Last Name"
                                               required="required">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email"
                                       required="required">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password"
                                       required="required">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="confirm_password"
                                       placeholder="Confirm Password" required="required">
                            </div>
                            <div class="form-group">
                                <label class="form-check-label">
                                    <input type="checkbox" required="required">
                                    I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a>
                                </label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Register Now</button>
                            </div>
                            <div class="text-center">Already have an account?
                                <router-link :to="{name: 'Login'}">Sign in</router-link>
                            </div>
                            <h2>Or</h2>
                            <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit">
                                <a href="https://instantclass.herokuapp.com/api/authorize/google" class="text-white">
                                    <i class="fa fa-google mr-2"></i> Continue with Google
                                </a>
                            </button>
                            <button class="btn btn-lg btn-github  btn-block text-uppercase" @click="loginGithub">
                                <i class="fa fa-facebook-f text-white mr-2"></i> Continue with Facebook
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
    export default {
        name: "Register"
    }
</script>

<style scoped>
    #bodyRegister {
    }

    .signup-form {
        margin: 0 auto;
        padding: 30px 0;
    }

    .signup-form h2 {
        color: #636363;
        margin: 0 0 15px;
        position: relative;
        text-align: center;
    }

    .signup-form h2:before, .signup-form h2:after {
        content: "";
        height: 2px;
        width: 30%;
        background: #d4d4d4;
        position: absolute;
        top: 50%;
        z-index: 2;
    }

    .signup-form h2:before {
        left: 0;
    }

    .signup-form h2:after {
        right: 0;
    }

    .signup-form .hint-text {
        color: #999;
        margin-bottom: 30px;
        text-align: center;
    }

    .signup-form form {
        color: #999;
        border-radius: 3px;
        margin-bottom: 15px;
        background: #ffffff;
        box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    .signup-form .form-group {
        margin-bottom: 20px;
    }

    .signup-form input[type="checkbox"] {
        margin-top: 3px;
    }

    .signup-form .btn {
        font-size: 16px;
        font-weight: bold;
        min-width: 140px;
        outline: none !important;
    }

    .signup-form .row div:first-child {
        padding-right: 10px;
    }

    .signup-form .row div:last-child {
        padding-left: 10px;
    }

    .signup-form a:hover {
        text-decoration: none;
    }


    .signup-form form a:hover {
        text-decoration: underline;
    }

    .btn-google {
        color: white;
        background-color: #ea4335
    }

    .btn-github {
        color: white;
        background: #4267B2;
    }
</style>
