<template>
    <div>
        <section class="hero">
            <div class="container mt-4 h-100">
                <!--                <div class="row h-100">-->
                <!--                    <div class="col-md-4 d-none d-md-block"></div>-->
                <!--                    <div class="col-md-8 text-center pt-md-2">-->
                <!--                        <h1 class="font-weight-bolder text-uppercase">-->
                <!--                            THE NEXT YOU<br>-->
                <!--                            The best way to predict <br>-->
                <!--                            the future is to create it-->
                <!--                        </h1>-->
                <!--                    </div>-->
                <!--                </div>-->
            </div>
        </section>
        <div class="payment-page">
            <div class="mt-4">
                <h4>{{$t('please_add_speciment')}}:</h4> <input type="file" @change="previewImage" accept="image/*" >
                <a class="navbar-brand text-primary font-weight-bolder" :href="loggedInUser.speciment" target="_blank"><i class="fa fa-eye"></i>{{ $t('view_spec') }}</a>
            </div>
            <h1 class="mt-4">{{$t('countDown.my_recits')}}</h1>
            <div class="mt-4" v-if="allTeacherPayments.length===0" style="color:red">
                {{$t('no_recipt')}}
            </div>
            <table class="table" v-else>
                <thead>
                <tr>
                    <th scope="col">Session Number</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Method</th>
                    <th scope="col">Date of session</th>
                    <th scope="col">Course</th>

                </tr>
                </thead>
                <tbody>
                <tr v-for="t in allTeacherPayments" v-bind:key="t.id">
                    <td>{{t.enrollment_id}}</td>
                    <td>{{t.user_id}}</td>
                    <td>{{t.amount}}</td>
                    <td>{{t.method}}</td>
                    <!--<td>{{t.session.created_at}}</td>-->
                    <td>{{t.object}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";
    import storage from 'firebase/storage';
    import firebase from "firebase";

    export default {
        name: "Payments",
        /*
        |--------------------------------------------------------------------------
        | Component > data
        |--------------------------------------------------------------------------
        */
        data() {
            return {
                form: {
                    speciment: ''
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
            ...mapActions(["fetchTeacherPayments"]),
            handelAdd () {
                this.picture=null;
                const storageRef=firebase.storage().ref(`teachers/${this.imageData.name}`).put(this.imageData);
                storageRef.on(`state_changed`,snapshot=>{
                        this.uploadValue = (snapshot.bytesTransferred/snapshot.totalBytes)*100;
                    }, error=>{},
                    ()=>{this.uploadValue=100;
                        storageRef.snapshot.ref.getDownloadURL().then((url)=>{
                            this.form.speciment = url;
                            this.$store.dispatch('addSpeciment', this.form)
                            .then( (result) => {
                                this.$swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Your work has been saved',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                window.location.reload()
                            })
                            .catch(function (error) {
                                this.$swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'Something get wrong',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            });
                        });
                    }
                );
            },
            previewImage(event) {
                this.uploadValue=0;
                this.picture=null;
                this.imageData = event.target.files[0];
                this.handelAdd();
            },
        },
        /*
        |--------------------------------------------------------------------------
        | Component > computed
        |--------------------------------------------------------------------------
        */
        computed: {
            ...mapGetters(["allTeacherPayments"]),
            ...mapGetters(["loggedInUser"])
        },
        /*
        |--------------------------------------------------------------------------
        | Component > created
        |--------------------------------------------------------------------------
        */
        created() {
            this.fetchTeacherPayments();
        }
    }
</script>

<style scoped>
.hero {
    /*background-image: url('../../assets/images/demand/online.jpg');*/
    background: linear-gradient(rgba(19, 19, 19, 0), rgba(19, 19, 19, 0)), url('../../assets/images/auth/hero.jpg') no-repeat center center;
    height: 50vh;
    background-size: cover;
    border-bottom: 15px solid #3081FB;
    color: white;
}
.payment-page {
    padding: 10px;
}
</style>
