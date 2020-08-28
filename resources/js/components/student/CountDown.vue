<template>
    <div>
        <h1><strong>Countdown</strong></h1>
    </div>

</template>

<script>
    import moment from 'vue-moment'

    export default {
        name: "CountDown",

        // data() {
        //     return {
        //         date: moment(60 * 10 * 1000)
        //     }
        // },
        // computed: {
        //     time: function(){
        //         return this.date.format('mm:ss');
        //     }
        // },
        // mounted: function(){
        //     setInterval(() => {
        //         this.date = moment(this.date.subtract(1, 'seconds'))
        //     }, 1000);
        // }
    }
</script>

