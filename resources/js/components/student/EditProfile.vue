<template>

    <div class="container bootstrap snippet rounded pt-3" v-if="!profileLoading">
        <div class="text-center">
            <h1 class="font-weight-bolder">{{userProfile.first_name}} {{userProfile.last_name}}</h1>
        </div>
        <div class="row">
            <div class="col-sm-3"><!--left col-->
                <div class="text-center">
                    <img :src="userProfile.image" class="avatar img-circle img-thumbnail"
                         alt="avatar">
                    <h6>Add a photo</h6>
                    <input type="file" class="text-center center-block file-upload" id="img">
                </div>
                <br>
            </div><!--/col-3-->
            <div class="col-sm-9">
                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <form class="form" @submit.prevent="updateProfile">
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
                                    <label for="phone">Phone (optional)</label>
                                    <input type="text" class="form-control" name="phone" id="phone"
                                           placeholder="Phone" title="enter your phone number if any."
                                           :value="userProfile.phone">
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
                                    <label for="lang">Spoken languages</label>
                                    <input type="text" class="form-control" id="lang"
                                           title="enter your email."
                                           :value="userProfile.languages">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="about">About Me</label>
                                    <textarea name="" id="about" class="form-control">{{userProfile.about}}</textarea>
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


</template>

<script>
    import {mapActions, mapGetters} from "vuex";
    import user from "../../store/modules/user";

    export default {
        name: "EditProfile",
        data() {
            return {
                user: ''
            }
        },
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
                        'accept':'Application/json'
                    }
                }).then(res => {
                    console.log(res);
                    alert("Your course was published successfully");
                    location.reload()

                })
                    .catch(err => console.log(err.response));
            },
        },
        computed: {
            ...mapGetters(["userProfile", "profileLoading"])
        },
    }
</script>

<style scoped>
    .container {
        background: linear-gradient(180deg, rgba(75, 189, 254, 0.83), #fbf3f3);
    }
</style>
