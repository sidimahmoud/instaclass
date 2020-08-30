<template>
    <div class="text-center font-weight-bolder">
        <div class="row align-items-center justify-content-center" style="height: 100px">
            <div class="col-4">
                <div class="count">
                    <h3>
                        00 <br>
                        Hours
                    </h3>

                </div>
            </div>
            <div class="col-4">
                <div class="count">
                    <h3>
                        00 <br>
                        Minutes
                    </h3>

                </div>
            </div>
            <div class="col-4">
                <div class="count">
                    <h3>
                        00 <br>
                        Seconds
                    </h3>

                </div>
            </div>
            <div class="col-12">
                <h3>Timer enabled when you subscribe to a course</h3>
            </div>
        </div>
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

<style scoped>
    .count {
        background: #0e0938;
        border-radius: 2%;
        color: #fff;
    }
</style>

