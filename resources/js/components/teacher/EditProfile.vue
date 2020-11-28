<template>
    <div class="container mt-5 pt-5 bootstrap snippet ">
        <div class="text-center"><h1>{{userProfile.first_name}} {{userProfile.last_name}}</h1></div>
        <div class="row">
            <div class="col-sm-3"><!--left col-->
                <div class="text-center">
                    <img :src="userProfile.image" class="avatar img-circle img-thumbnail"
                         alt="avatar">
                    <h6>{{$t('profile.addImg')}}</h6>
                    <input type="file" class="text-center center-block file-upload" id="img">
                </div>
                <br>
            </div><!--/col-3-->
            <div class="col-sm-9">

                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <form class="form" id="registrationForm" @submit.prevent="updateProfile">
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="first_name">{{$t('auth.fName')}}</label>
                                    <input type="text" class="form-control" name="first_name" id="first_name"
                                           placeholder="first name" title="enter your first name if any."
                                           :value="userProfile.first_name">
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="last_name">{{$t('auth.lName')}}</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name"
                                           placeholder="last name" title="enter your last name if any."
                                           :value="userProfile.last_name">
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="phone">{{$t('profile.phone')}}</label>
                                    <input type="text" class="form-control" name="phone" id="phone"
                                           placeholder="Phone" title="enter your phone number if any."
                                           :value="userProfile.phone">
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="email">{{$t('profile.mail')}}</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                           placeholder="you@email.com" title="enter your email."
                                           :value="userProfile.email">
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="lang">{{$t('profile.languages')}}</label>
                                    <input type="text" class="form-control"  id="lang" placeholder="Example: English, French"
                                           :value="userProfile.languages">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="about">{{$t('profile.about')}} <small style="color:red">{{$t('profile.about_help')}}</small></label>
                                    <textarea name="" id="about" class="form-control" v-model="userProfile.about"></textarea>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-6">
                                    <button class="btn btn-primary btn-block" type="submit">
                                        {{$t('profile.save')}}
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-danger btn-block" type="reset">
                                        {{$t('profile.reset')}}
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
            updateProfile() {
                const formData = new FormData();
                const imagefile = document.querySelector('#img');
                formData.append("first_name", document.querySelector('#first_name').value);
                formData.append("last_name", document.querySelector('#last_name').value);
                formData.append("phone", document.querySelector('#phone').value);
                // formData.append("country", document.querySelector('#img'));
                // formData.append("city", document.querySelector('#img'));
                formData.append("email", document.querySelector('#email').value);
                formData.append("image", imagefile.files[0]);
                formData.append("about", document.querySelector('#about').value);
                formData.append("languages", document.querySelector('#lang').value);
                formData.append("_method", "put");
                //  console.log(formData)
                axios.post('/user/' + this.userProfile.id, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'accept': 'Application/json'
                    }
                }).then(res => {
                    console.log(res);
                    this.$swal.fire(
                        'Ok!',
                        this.$t('profile.updated'),
                        'success'
                    )
                    this.$store.dispatch("fetcheProfile")
                })
                    .catch(err => console.log(err.response));
            },
        },
        computed: {
            ...mapGetters(["userProfile", "profileLoading"])
        },
    }
</script>
