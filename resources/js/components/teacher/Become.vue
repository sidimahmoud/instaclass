<template>
    <div >
        <div class="container border-top border-primary">
            <div class="row mt-5">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="signup-form bg-white">
                        <form method="post">
                            <h2>Teacher registration</h2>
                            <p class="hint-text">Create your account. It takes only a few seconds.</p>
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
                            <div class="row mb-3">
                                <div class="col">
                                    <input type="password" class="form-control"
                                           placeholder="Password" required="required">
                                </div>
                                <div class="col">
                                    <input type="password" class="form-control"
                                           placeholder="Password again" required="required">
                                </div>
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
                                <router-link :to="{name: 'Signin'}">Sign in</router-link>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
    export default {
        name: "Become"
    }
</script>

<style scoped>


    .signup-form {
        margin: 0 auto;
    }

    .signup-form h2 {
        color: #636363;
        margin: 0 0 15px;
        position: relative;
        text-align: center;
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

</style>
