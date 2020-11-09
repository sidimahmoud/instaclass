<template>
    <div>
        <div class="hero">
            <div class=" jumbotron1 pt-5 ">
                <div class="container h-100">
                    <h1 class="text-center mt-md-5 text-white">
                        ABOUT INSTANTACLASSE <br>
                        WHO WE ARE?
                    </h1>
                </div>
            </div>
            <div class=" jumbotron2 py-5">
                <div class="container  align-items-center mt-2">
                    <div class="row justify-content-around align-items-center">
                        <div class="col-md-6 col-sm-12 text-center d-none d-md-block">
                            <img src="../assets/images/about/bigstock-Young-Asian-Business-Man-Using-364591240.jpg" width="400px" class="img-fluid rounded">
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <h1>About Us</h1>
                            <p class="text-justify">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aperiam dignissimos
                                doloremque dolores facilis, harum, ipsa libero necessitatibus odit quia quis vel.
                                Aspernatur dolorem omnis quas quisquam unde veniam voluptatem? <br>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias consequatur corporis
                                delectus, distinctio enim esse eveniet exercitationem expedita fugit labore, laboriosam,
                                optio quia quidem ratione sapiente sequi tempore temporibus veniam!
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
                            Our difference
                        </h1>
                        <p class="text-justify">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto aspernatur aut, autem
                            delectus dolor dolore dolorum est fugiat illum labore laborum libero magnam nam officiis
                            praesentium sapiente sequi sit vero? <br>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci blanditiis consectetur
                            consequatur culpa cumque deserunt dignissimos dolore facere hic impedit, libero nihil
                            obcaecati
                            odio quas qui quo totam voluptatem, voluptatibus.
                        </p>

                    </div>
                    <div class="col-md-6 col-sm-12 text-center">
                        <img src="../assets/images/about/bigstock-Family-Does-Exercises-Online--372384175.jpg" width="400px" class="img-fluid rounded">
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-dark text-white mb-0 py-3">
            <div class="container newsLetter">
                <h1 class="text-center">
                    Stay informed
                </h1>
                <p class="text-center">Subscribe to our mailbox
                </p>
                <form @submit.prevent="subscribe">
                    <div class="row">
<!--                        <div class="col-md-6">-->
<!--                            <div class="form-group">-->
<!--                                <input type="text" class="form-control" placeholder="First Name" v-model="first_name">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-md-6">-->
<!--                            <div class="form-group">-->
<!--                                <input type="text" class="form-control" placeholder="Last Name" v-model="last_name">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-6">-->
<!--                            <div class="input-group mb-3">-->
<!--                                <input type="text" class="form-control" placeholder="Address" v-model="address">-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Email"
                                       aria-label="Recipient's username" aria-describedby="basic-addon2"
                                       v-model="email">
                                <div class="input-group-append">
                                <span class="input-group-text p-0" id="basic-addon2">
                                    <button class="btn btn-primary">
                                        Subscribe
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
                        this.$alert('Subscribed successfully','News letter', 'success')
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
        height: 70vh;
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
    }

    h1 {
        font-weight: bolder
    }
</style>
