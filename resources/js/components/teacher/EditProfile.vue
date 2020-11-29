<template>
    <div class="container mt-5 pt-5 bootstrap snippet ">
        <div class="text-center"><h1>{{userProfile.first_name}} {{userProfile.last_name}}</h1></div>
        <div class="row">
            <div class="col-sm-3"><!--left col-->
                <div class="text-center">
                    <img :src="userProfile.image" class="profile-image avatar img-circle img-thumbnail"
                         alt="avatar">
                    <h6>{{$t('profile.addImg')}}</h6>
                    <input type="file" @change="previewImage" accept="image/*">
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
                                           v-model="form.first_name">
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="last_name">{{$t('auth.lName')}}</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name"
                                           placeholder="last name" title="enter your last name if any."
                                           v-model="form.last_name">
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="phone">{{$t('profile.phone')}}</label>
                                    <input type="text" class="form-control" name="phone" id="phone"
                                           placeholder="Phone" title="enter your phone number if any."
                                           v-model="form.phone">
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="email">{{$t('profile.mail')}}</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                           placeholder="you@email.com" title="enter your email."
                                           v-model="form.email">
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="lang">{{$t('profile.languages')}}</label>
                                    <input type="text" class="form-control"  id="lang" placeholder="Example: English, French"
                                           v-model="form.languages">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="about">{{$t('profile.about')}} <small>({{$t('profile.about_help')}})</small></label>
                                    <textarea name="" id="about" class="form-control" v-model="form.about" maxlength="100"></textarea>
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
    import storage from 'firebase/storage';
    import firebase from "firebase";
    import {isEmpty} from "../../helpers/common";

    export default {
        name: "EditProfile",
        /*
        |--------------------------------------------------------------------------
        | Component > data
        |--------------------------------------------------------------------------
        */
        data() {
            return {
                form: {
                    first_name: '',
                    last_name: '',
                    phone: '',
                    email: '',
                    about: '',
                    languages: ''
                },
                progressUpload: 0,
                imageData: null,
                picture: null,
                uploadValue: 0,
            };
        },
        /*
        |--------------------------------------------------------------------------
        | Component > methods
        |--------------------------------------------------------------------------
        */
        methods: {
            updateProfile() {
                const _this = this
                this.picture=null;
                if(!isEmpty(this.imageData.name)) {
                    const storageRef=firebase.storage().ref(`profiles/${this.imageData.name}`).put(this.imageData);
                    storageRef.on(`state_changed`,snapshot=>{
                            this.uploadValue = (snapshot.bytesTransferred/snapshot.totalBytes)*100;
                        }, error=>{},
                        ()=>{this.uploadValue=100;
                            storageRef.snapshot.ref.getDownloadURL().then((url)=>{
                                let payload = {
                                    "first_name" : this.form.first_name,
                                    "last_name" : this.form.last_name,
                                    "phone" : this.form.phone,
                                    "email" : this.form.email,
                                    "about" : this.form.about,
                                    "languages" : this.form.languages,
                                    "image" : url
                                }

                                axios.put('/user/' + this.userProfile.id, payload).then(res => {
                                    this.$swal.fire(
                                        'Ok!',
                                        this.$t('profile.updated'),
                                        'success'
                                    )
                                    this.$store.dispatch("fetchProfile")
                                })
                                .catch(err => console.log(err.response));
                            });
                        }
                    );
                }else{
                    this.update()
                }
            },
            update(){
                let payload = {
                    "first_name" : this.form.first_name,
                    "last_name" : this.form.last_name,
                    "phone" : this.form.phone,
                    "email" : this.form.email,
                    "about" : this.form.about,
                    "languages" : this.form.languages
                }
                //const imagefile = document.querySelector('#img');
                /* formData.append("first_name", document.querySelector('#first_name').value);
                formData.append("last_name", document.querySelector('#last_name').value);
                formData.append("phone", document.querySelector('#phone').value);
                formData.append("email", document.querySelector('#email').value);
                formData.append("about", document.querySelector('#about').value);
                formData.append("languages", document.querySelector('#lang').value);
                formData.append("_method", "put"); */
                console.log(payload)
                axios.put('/user/' + this.userProfile.id, payload).then(res => {
                    this.$swal.fire(
                        'Ok!',
                        this.$t('profile.updated'),
                        'success'
                    )
                    this.$store.dispatch("fetchProfile")
                })
                .catch(err => console.log(err.response));
            },
            previewImage(event) {
                this.uploadValue=0;
                this.picture=null;
                this.imageData = event.target.files[0];
                //this.handelAdd();
            },
        },
        /*
        |--------------------------------------------------------------------------
        | Component > computed
        |--------------------------------------------------------------------------
        */
        computed: {
            ...mapGetters(["userProfile", "profileLoading"])
        },
        /*
        |--------------------------------------------------------------------------
        | Component > mounted
        |--------------------------------------------------------------------------
        */
        mounted(){
            this.$store.dispatch("fetchProfile").then(() => {
                this.form = this.userProfile
            })
        }
    }
</script>
