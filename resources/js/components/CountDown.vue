<template>
    <div class="font-weight-bold">
        <div class="row  justify-content-center">
            <span>
                <div class="btn btn-primary ">
                    {{displayDays}} <br>
                    Day
                </div>
            </span>
            <span>
                <div class="btn btn-primary ">
                    {{displayHours}} <br>
                    Hour
                </div>
            </span>
            <span>
                <div class="btn btn-primary ">
                    {{displayMinutes}} <br>
                    Min
                </div>
            </span>
            <span>
                <div class="btn btn-primary ">
                    {{displaySeconds}} <br>
                    Sec
                </div>
            </span>
            <div class="col-12 text-white text-center" v-if="text">
                <h3 v-if="expired">{{$t('countDown.enabled')}}</h3>
                <h3 v-if="!expired">{{$t('countDown.beReady')}}</h3>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'vue-moment'

    export default {
        name: "CountDown",
        props: {
            "year": '',
            "month": '',
            "day": '',
            "hour": '',
            "minute": '',
            "second": '',
            "text": {
                default: true,
                type: Boolean
            }

        },
        data() {
            return {
                displayDays: 0,
                displayHours: 0,
                displayMinutes: 0,
                displaySeconds: 0,
                expired: false
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
            },
            end() {
                return new Date(
                    this.year,
                    this.month,
                    this.day,
                    this.hour,
                    this.minute,
                    this.second,
                )
            }
        },
        mounted() {
            this.showRemaining()
        },
        methods: {
            showRemaining() {
                const timer = setInterval(() => {
                    const now = new Date();
                    // const end = new Date(2020, 9, 15, 10, 10, 0, 0);
                    const distance = Number(this.end.getTime()) - Number(now.getTime());
                    if (distance < 0) {
                        clearInterval(timer);
                        this.expired = true;
                        return
                    }
                    const days = Math.floor(distance / this._days);
                    const hours = Math.floor((distance % this._days) / this._hours);
                    const minutes = Math.floor((distance % this._hours) / this._minutes);
                    const seconds = Math.floor((distance % this._minutes) / this._seconds);
                    this.displayDays = this.formatNum(days);
                    this.displayHours = this.formatNum(hours);
                    this.displayMinutes = this.formatNum(minutes);
                    this.displaySeconds = this.formatNum(seconds);
                }, 1000)
            },
            formatNum: num => (num > 9 ? num : "0" + num),
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

