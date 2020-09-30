<template>
    <div class="container border-top border-primary">
        <div class="row mt-5">

            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto   form">
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
                    <h2 class="text-center">Demande de cours</h2>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"> Dites nous le cours que vous aimeriez suivre en direct
                            sur la plateforme</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" required v-model="details">

                        </textarea>
                    </div>
                    <div class="form-group" v-if="lang ==='fr'|| lang ==='en'||lang === 'es'">
                        <label for="lang">Langue du cours desiré</label>
                        <select class="form-control" id="lang" v-model="lang">
                            <option value="fr">Français</option>
                            <option value="en">Anglais</option>
                            <option value="es">Espagnol</option>
                            <option value="">Autre (Précisez)</option>
                        </select>
                    </div>
                    <div class="form-group" v-else>
                        <label for="lang1">Langue du cours</label>
                        <input type="text" class="form-control" id="lang1" required v-model="lang">
                    </div>
                    <div class="form-group mb-5">
                        <label for="email">Email address (optionnel)</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                               placeholder="Enter email" v-model="email">
                        <small id="emailHelp" class="form-text text-muted">
                            Vous serez averti quand le cours sera disponible.
                        </small>
                    </div>
                    <button class="btn btn-primary btn-block mt-5">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Demande",
        data() {
            return {
                details: '',
                lang: 'fr',
                email: '',
                msg: ''
            }
        },
        methods: {
            demander() {
                let payload = {
                    details: this.details,
                    lang: this.lang,
                    email: this.email,
                };
                this.$store.dispatch('demander', payload)
                    .then(res => {
                        this.msg = res.data;
                        this.details = '';
                        this.lang = 'fr';
                        this.email = '';
                    })
            }
        }
    }
</script>

<style scoped>
    .form {
        border-radius: 3px;
        margin-bottom: 15px;
        background: #ffffff;
        box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
        padding: 30px;
    }
</style>
