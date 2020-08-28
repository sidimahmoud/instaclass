<template>
    <div>
        <router-link :to="{ name: 'Detail', params: { slug: course.slug}}" tag="a">
            <div class="row mb-2 shadow-sm px-0 py-2 bg-white justify-content-around align-items-center text-center">
                <div class="col-md-3  align-items-center">
                    <img class="w-100 rounded-circle" :src="course.image" alt="Card image cap">
                </div>
                <div class="col-md-9 justify-content-center align-items-center">
                    <div class="row text-left">
                        <div class="col-md-4 col-sm-12 justify-content-center align-items-center ">
                            <h5 class="card-title text-left">{{course.name}}</h5>
                        </div>
                        <div class="col-md-2 col-sm-12 justify-content-center align-items-center "><b>Duration:</b>{{course.duration}}
                        </div>
                        <div class="col-md-2 col-sm-12 justify-content-center align-items-center "><b>Language:</b>
                            {{course.language}}
                        </div>
                        <div class="col-md-2 col-sm-12 justify-content-center align-items-center "><b>Sessions:</b> 3
                        </div>
                        <div class="col-md-2 col-sm-12 justify-content-center align-items-center "><b>Type:</b>
                            {{course.type==1?"Recorded":"Live"}}
                        </div>
                    </div>
                    <div class="row text-left ">
                        <div class="col-6 " v-if="course.category">
                            Category :{{course.category.name}}
                        </div>
                        <div class="col-6 text-right">
                            Price: <b>{{course.price==0?"Free":"$"+course.price}}</b>
                        </div>
                        <div class="col-12">
                            <b>Description</b> <br>
                            {{course.short_description}}
                        </div>


                    </div>
                    <div class="row text-left mt-2">
                        <div class="col-4">
                            <b>Availability</b>
                        </div>
                        <div class="col-4">
                            17/09: 05pm - 8pm ET
                        </div>
                        <div class="col-4">
                            10/10: 11am - 12pm ET
                        </div>
                    </div>
                    <div class="row  mt-2">
                        <div class="col-md-4">
                            <b>Partager sur </b>

                            <i class="fa fa-facebook  mr-3"></i>
                            <i class="fa fa-twitter  mr-3"></i>
                            <i class="fa fa-linkedin  mr-3"></i>
                            <i class="fa fa-instagram  mr-3"></i>

                        </div>
                        <div class="col-md-6 text-right">
                            <router-link :to="{ name: 'Checkout', params: {id: course.id, name: course.name, price: course.price}}" tag="a" class="btn btn-primary my-3">
                                S'inscrire à ce cours
                            </router-link>
                        </div>
                    </div>

                </div>
            </div>
        </router-link>

    </div>

</template>
<script>

    export default {
        name: "Course",
        props: ["course"],

    };

</script>
<style>
    a {
        color: rgba(0, 0, 0, 0.7);
    }

    a:hover {
        text-decoration: none;
        color: #000000;

    }
</style>
