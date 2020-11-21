<template>
    <div>
        <section class="hero pt-5">
            <div class="container h-100">
                <!--                <div class="row h-100 align-items-center">-->
                <!--                    <div class="col-md-6"><h1 class="font-weight-bolder">REQUEST YOUR COURSE</h1></div>-->
                <!--                    <div class="col-md-6"></div>-->
                <!--                    <div class="col-md-6"></div>-->
                <!--                    <div class="col-md-6 text-center">-->
                <!--                        <h1 class="font-weight-bolder">CHOOSE YOUR DIRECTION</h1>-->
                <!--                        <h1 class="font-weight-bolder">CREATE YOUR FUTURE</h1>-->
                <!--                    </div>-->
                <!--                </div>-->
            </div>

        </section>
        <div class="container">
            <div class="row mt-5">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto form px-5 py-2">
                    <form class="mt-4" @submit.prevent="demander">
                        <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="msg">
                        <span class="btn btn-light rounded-circle">
                             <i class="fa fa-check text-success fa-2x"></i>
                        </span>
                            {{msg}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <h2 class="text-center">{{$t('demande.title')}}</h2>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1"> {{$t('demande.desc')}}</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" required v-model="details">
                        </textarea>
                        </div>
                        <div class="form-group" v-if="lang ==='fr'|| lang ==='en'||lang === 'es'">
                            <label for="lang">{{$t('demande.lang')}}</label>
                            <select class="form-control" id="lang" v-model="language">
                                <option value="fr">{{$t('demande.languages.fr')}}</option>
                                <option value="en">{{$t('demande.languages.en')}}</option>
                                <option value="es">{{$t('demande.languages.es')}}</option>
                                <option value="">{{$t('demande.languages.other')}}</option>
                            </select>
                        </div>
                        <div class="form-group" v-else>
                            <label for="lang1">{{$t('demande.lang')}}</label>
                            <input type="text" class="form-control" id="lang1" required v-model="language">
                        </div>
                        <div class="form-group mb-1">
                            <label for="email">{{$t('demande.email')}}</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                   :placeholder="$t('demande.emailPlaceholder')" v-model="email">
                            <small id="emailHelp" class="form-text text-muted">
                                {{$t('demande.emailHelp')}}
                            </small>
                        </div>
                        <button class="btn btn-primary btn-block mb-2">{{$t('demande.btn')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "Demande",
        data() {
            return {
                details: '',
                language: 'fr',
                email: '',
                msg: ''
            }
        },
        methods: {
            demander() {
                let payload = {
                    details: this.details,
                    lang: this.language,
                    email: this.email,
                };
                this.$store.dispatch('demander', payload)
                    .then(res => {
                        this.lang === "fr" ? this.msg = res.data.messageFR : this.msg = res.data.messageEN;
                        this.details = '';
                        this.lang = 'fr';
                        this.email = '';
                    })
            }
        },
        computed: {
            ...mapGetters(["lang"])
        }

    }
</script>

<style scoped>
    .form {
        border-radius: 15%;
        margin-bottom: 15px;
        background: #ffffff;
        /*box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);*/
        border: 2px solid black;
        border-bottom: 2px solid black;
    }

    .hero {
        /*background-image: url('../../assets/images/demand/online.jpg');*/
        background: linear-gradient(rgba(19, 19, 19, 0.3), rgba(19, 19, 19, 0.3)), url('../../assets/images/Request1.jpg') no-repeat center center;
        height: 50vh;
        background-size: cover;
        border-bottom: 15px solid #3081FB;
        color: white;
    }
</style>
