<template>
    <div class="container text-center border-top border-primary pt-4">
        <h1>Confirm your email address</h1>
        <p>
            We have sent an email with a confirmation link to your email address. In order to complete the sign-up process, please click the confirmation link.
            If you do not receive a confirmation email, please check your spam folder. Also, please verify that you entered a valid email address in our sign-up form.
        </p>

        If you need assistance, please <router-link class="text-primary" :to="{name: 'Contact'}">
        contact us.

    </router-link>
    </div>
</template>

<script>
    export default {
        name: "GoogleCallback",
    }

</script>

<style scoped>

</style>
