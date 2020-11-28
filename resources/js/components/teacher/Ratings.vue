<template>
    <div>
        <section class="hero">
            <div class="container mt-4 h-100">
            </div>
        </section>
        <div class="payment-page">
            <div
                class="text-center text-margin-long"
                v-if="isEmpty(allTeacherDetails.ratings)"
            >
                <h3>{{$t('profile.empty_ratings')}}</h3>
            </div>
            <div v-else>
                <review
                    v-for="r in allTeacherDetails.ratings"
                    :key="r.id"
                    :rating="r"
                />
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";
    import Review from "../courses/Review";
    import {isEmpty} from "../../helpers/common";

    export default {
        name: "Payments",
        /*
        |--------------------------------------------------------------------------
        | Component > components
        |--------------------------------------------------------------------------
        */
        components: {
            Review,
        },
        /*
        |--------------------------------------------------------------------------
        | Component > data
        |--------------------------------------------------------------------------
        */
        data() {
            return {
                form: {
                    speciment: ''
                },
                progressUpload: 0,
                imageData: null,
                picture: null,
                uploadValue: 0,
            };
        },
        /*
        |--------------------------------------------------------------------------
        | Component > methods
        |--------------------------------------------------------------------------
        */
        methods: {
            ...mapActions([
                "fetchTeacherDetails",
            ]),
            isEmpty(v) {
                return isEmpty(v);
            },
        },
        /*
        |--------------------------------------------------------------------------
        | Component > computed
        |--------------------------------------------------------------------------
        */
        computed: {
            ...mapGetters([
                "allTeacherDetails",
            ]),
        },
        /*
        |--------------------------------------------------------------------------
        | Component > created
        |--------------------------------------------------------------------------
        */
        created() {
            this.fetchTeacherDetails();
        }
    }
</script>

<style scoped>
.hero {
    /*background-image: url('../../assets/images/demand/online.jpg');*/
    background: linear-gradient(rgba(19, 19, 19, 0), rgba(19, 19, 19, 0)), url('../../assets/images/auth/hero.jpg') no-repeat center center;
    height: 70vh;
    background-size: cover;
    border-bottom: 15px solid #3081FB;
    color: white;
}
.payment-page {
    padding: 10px;
}
.text-margin-long {
    margin-bottom: 200px;
}
</style>
