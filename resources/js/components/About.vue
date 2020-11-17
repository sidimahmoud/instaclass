<template>
    <div>
        <div class="hero">
            <div class=" jumbotron1 pt-5 ">
                <!--                <div class="container h-100">-->
                <!--                    <h1 class="text-center mt-md-5 text-white">-->
                <!--                        {{$t('about.hero.1')}}<br>-->
                <!--                        {{$t('about.hero.2')}}-->
                <!--                    </h1>-->
                <!--                </div>-->
            </div>
            <div class=" jumbotron2 py-5">
                <div class="container  align-items-center mt-2">
                    <div class="row justify-content-around align-items-center">
                        <div class="col-md-6 col-sm-12 text-center d-none d-md-block">
                            <img src="../assets/images/about/bigstock-Young-Asian-Business-Man-Using-364591240.jpg"
                                 width="400px" class="img-fluid rounded">
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <h1>{{$t('about.about.title')}}</h1>
                            <p class="text-justify">
                                {{$t('about.about.body')}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="bg-white py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 col-sm-12">
                        <h1>
                            {{$t('about.difference.title')}}
                        </h1>
                        <p class="text-justify">
                            {{$t('about.difference.body')}}
                        </p>

                    </div>
                    <div class="col-md-6 col-sm-12 text-center">
                        <img src="../assets/images/about/bigstock-Family-Does-Exercises-Online--372384175.jpg"
                             width="400px" class="img-fluid rounded">
                    </div>
                </div>
            </div>
        </section>

        <div class=" jumbotron2 py-5">
            <div class="container  align-items-center mt-2">
                <div class="row justify-content-around align-items-center">
                    <div class="col-md-6 col-sm-12 text-center">
                        <img src="../assets/images/about/prohibited.png" width="200px" class="img-fluid rounded">
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <h1>{{$t('about.prohibited.title')}}</h1>
                        <p class="text-justify">
                            {{$t('about.prohibited.body')}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <section class="bg-dark text-white mb-0 py-3">
            <div class="container newsLetter">
                <h1 class="text-center">
                    {{$t('about.newsletter.stay')}}
                </h1>
                <p class="text-center">{{$t('about.newsletter.subscribe')}}
                </p>
                <form @submit.prevent="subscribe">
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Email"
                                       aria-label="Recipient's username" aria-describedby="basic-addon2"
                                       v-model="email">
                                <div class="input-group-append">
                                <span class="input-group-text p-0" id="basic-addon2">
                                    <button class="btn btn-primary">
                                        {{$t('about.newsletter.subscribeBtn')}}
                                    </button>
                                </span>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>

            </div>

        </section>

    </div>
</template>

<script>
    export default {
        name: "About",
        data() {
            return {
                first_name: '',
                last_name: '',
                address: '',
                email: '',
            }
        },
        methods: {
            subscribe() {
                let payload = {
                    first_name: this.first_name,
                    last_name: this.last_name,
                    email: this.email,
                    address: this.address,
                };
                axios.post('/newsletter', payload)
                    .then(() => {
                        this.first_name = '';
                        this.last_name = '';
                        this.email = '';
                        this.address = '';
                        this.$alert('Subscribed successfully', 'News letter', 'success')
                    })
                    .catch(err => console.log(err))
            }
        },

    }
</script>

<style scoped lang="scss">

    .hero {
        background: #ccc;
    }

    .jumbotron1 {
        height: 80vh;
        border-bottom: 15px solid #3081FB;
        background: linear-gradient(rgba(19, 19, 19, 0.5), rgba(19, 19, 19, 0.5)), url('../assets/images/about/about.jpg') no-repeat center top;
        background-size: cover;
        border-radius: 0 0 200px 0;
        font-family: 'Poppins', sans-serif;

        h1 {
            line-height: 2;
        }
    }

    .newsLetter {
        input {
            background: transparent;
            color: white !important;

        }
    ;

        ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: white;
            opacity: 1; /* Firefox */
        }
    }

    h1 {
        font-weight: bolder
    }
</style>
