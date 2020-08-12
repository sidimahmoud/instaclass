<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <form method="post" @submit.prevent="login">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" placeholder="Enter email" v-model="email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1"
                                       placeholder="Password" v-model="password">
                            </div>
                            <div class="text-center text-primary" v-if="!authStatus==='loading'">
                                <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <div class="text-center" v-else>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {

        name: "Login",
        data() {
            return {
                email: '',
                password: ''
            }
        },
        methods: {
            login() {
                let email = this.email;
                let password = this.password;
                this.$store.dispatch('login', {email, password})
                    .then(() => this.$router.push('/'))
                    .catch(err => console.log(err))
            }
        },
        computed: mapGetters(["authStatus"])
    }
</script>

<style scoped>

</style>
