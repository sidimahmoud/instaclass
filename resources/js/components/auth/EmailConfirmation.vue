<template>
    <div class="verify">
        <h1>{{$t('verify.1')}}</h1>
        <p>
            {{$t('verify.2')}}
        </p>

        {{$t('verify.3')}} <router-link class="text-primary" :to="{name: 'Contact'}">{{$t('footer.contact')}}.</router-link>
    </div>
</template>

<script>
    export default {
        name: "GoogleCallback",
    }

</script>

<style scoped>
.verify {
    margin-top: 80px;
    padding: 40px;
}
</style>
