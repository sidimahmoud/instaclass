<template>
    <div class="container border-top border-primary">
        <div class="row mt-5">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto bg-white shadow-sm">
                <form class="mt-4">
                    <h2 class="text-center">Demande de cours</h2>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email address</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1"
                               placeholder="name@example.com">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Language du cours</label>
                        <input type="text" class="form-control" id="exampleFormControlSelect1" placeholder="English">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Detail du cours</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">Dites nous le cours que vous aimeriez suivre en direct sur la plateforme
                        </textarea>
                    </div>
                    Vous serez averti quand le cours sera disponible
                    <button class="btn btn-primary btn-block my-3">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Demande"
    }
</script>

<style scoped>

</style>
