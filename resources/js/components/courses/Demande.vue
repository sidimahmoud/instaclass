<template>
    <div class="container">
        <form class="mt-4">
            <h2 class="text-center">Demande de cours</h2>
            <div class="form-group">
                <label for="exampleFormControlInput1">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Course language</label>
                <input type="text" class="form-control" id="exampleFormControlSelect1">
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Dites nous le cours que vous aimeriez suivre en direct sur la plateforme</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            Vous serez averti quand le cours sera disponible
            <button class="btn btn-primary btn-block mt-3">Envoyer</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "Demande"
    }
</script>

<style scoped>

</style>
