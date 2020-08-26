<template>
    <div class="container border-top border-primary">
        <div class="row mt-5">

            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto bg-white shadow-sm">
                <form class="mt-4">
                    <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="msg">
                       <i class="fa fa-check"></i>  {{msg}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <h2 class="text-center">Demande de cours</h2>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"> Dites nous le cours que vous aimeriez suivre en direct sur la plateforme</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" required v-model="details">

                        </textarea>
                    </div>
                    <div class="form-group" v-if="lang ==='fr'|| lang ==='en'||lang === 'es'">
                        <label for="lang">Langue du cours</label>
                        <select class="form-control" id="lang" v-model="lang">
                            <option value="fr">Français</option>
                            <option value="en">Anglais</option>
                            <option value="es">Espagnol</option>
                            <option value="Langue">Autre (Précisez)</option>
                        </select>
                    </div>
                    <div class="form-group" v-else>
                        <label for="lang1">Langue du cours</label>
                        <input type="text" class="form-control" id="lang1" v-model="lang">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address (optionnel)</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" v-model="email">
                        <small id="emailHelp" class="form-text text-muted">
                            Vous serez averti quand le cours sera disponible.
                        </small>
                    </div>
                    <button class="btn btn-primary btn-block my-3">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Demande",
        data(){
            return {
                details: '',
                lang: 'fr',
                email: '',
                msg:''
            }
        },
        methods:{
            demander(){
                let payload={
                    details: this.details,
                    lang: this.lang,
                    email: this.email,
                };
                  this.$store.dispatch('demander', payload)
                .then(res=>{
                    this.msg= res.data;
                })
            }
        }
    }
</script>

<style scoped>

</style>
