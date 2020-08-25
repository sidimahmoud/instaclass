<template>
    <div class="container bootstrap snippet">
        <div class="text-center"><h1>{{userProfile.first_name}} {{userProfile.last_name}}</h1></div>
        <div class="row">
            <div class="col-sm-3"><!--left col-->


                <div class="text-center">
                    <img :src="userProfile.image" class="avatar img-circle img-thumbnail"
                         alt="avatar">
                    <h6>Choisir une photo</h6>
                    <input type="file" class="text-center center-block file-upload">
                </div>
                <br>
            </div><!--/col-3-->
            <div class="col-sm-9">

                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <form class="form" action="#" method="post" id="registrationForm">
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="first_name">First name</label>
                                    <input type="text" class="form-control" name="first_name" id="first_name"
                                           placeholder="first name" title="enter your first name if any."
                                           :value="userProfile.first_name">
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="last_name">Last name</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name"
                                           placeholder="last name" title="enter your last name if any."
                                           :value="userProfile.last_name">
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="phone">Title</label>
                                    <input type="text" class="form-control" name="phone" id="phone"
                                           placeholder="Example : Web developer" title="enter your phone number if any."
                                           :value="userProfile.headline">
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                           placeholder="you@email.com" title="enter your email."
                                           :value="userProfile.email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="about">About</label>
                                    <textarea name="" id="about" class="form-control">{{userProfile.about}}
                                    </textarea>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-6">
                                    <button class="btn btn-success btn-block" type="submit">
                                        Save
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-danger btn-block" type="reset">
                                        Reset
                                    </button>
                                </div>
                            </div>


                        </form>

                    </div><!--/tab-pane-->

                </div><!--/tab-pane-->
            </div>
            <!--/tab-content-->

        </div>
        <!--/col-9-->
    </div>
    <!--/row-->

</template>

<script>
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "EditProfile",
        methods: {
            ...mapActions(["fetchProfile"]),
            logout() {
                this.$store.dispatch('logout')
                    .then(() => {
                        this.$router.push('/')
                    })
            }


        },
        computed: mapGetters(["userProfile"]),
        created() {
            this.fetchProfile();
        }
    }
</script>
