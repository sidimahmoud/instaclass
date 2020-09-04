<template>
    <div class="text-center font-weight-bolder">
        <div class="row align-items-center justify-content-center" style="height: 100px">
            <div class="col-3">
                <div class="count">
                    <h3>
                        {{displayDays}} <br>
                        Days
                    </h3>

                </div>
            </div>
            <div class="col-3">
                <div class="count">
                    <h3>
                        {{displayHours}} <br>
                        Hours
                    </h3>

                </div>
            </div>
            <div class="col-3">
                <div class="count">
                    <h3>
                        {{displayMinutes}} <br>
                        Minutes
                    </h3>

                </div>
            </div>
            <div class="col-3">
                <div class="count">
                    <h3>
                        {{displaySeconds}} <br>
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
        data() {
            return {
                displayDays: 0,
                displayHours: 0,
                displayMinutes: 0,
                displaySeconds: 0,
            }
        },
        computed: {
            _seconds: () => 1000,
            _minutes() {
                return this._seconds * 60
            },
            _hours() {
                return this._minutes * 60
            },
            _days() {
                return this._hours * 24
            }
        },
        mounted() {
            this.showRemaining()
        },
        methods:{
            showRemaining(){
                const timer = setInterval(()=>{
                    const now = new Date();
                    const end = new Date(2020, 9, 15, 10, 10, 0, 0);
                    const distance = Number(end.getTime()) - Number(now.getTime());
                    if(distance<0){
                        clearInterval(timer);
                        return
                    }
                    const days = Math.floor(distance/ this._days);
                    const hours = Math.floor((distance % this._days)/this._hours);
                    const minutes = Math.floor((distance % this._hours)/this._minutes);
                    const seconds = Math.floor((distance % this._minutes)/this._seconds);
                    this.displayDays = this.formatNum(days);
                    this.displayHours = this.formatNum(hours);
                    this.displayMinutes = this.formatNum(minutes);
                    this.displaySeconds = this.formatNum(seconds);
                },1000)
            },
            formatNum: num => (num> 9 ? num : "0"+num),
        }

    }
</script>

<style scoped>
    .count {
        background: #0e0938;
        border-radius: 5%;
        color: #fff;
    }
</style>

