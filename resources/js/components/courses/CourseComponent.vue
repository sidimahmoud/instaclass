<template>
<!--    <div>-->
        <div class="col-md-4 col-sm-12 mb-2 shadow-lg">
            <div class="card">
                <router-link :to="{ name: 'Detail', params: { slug: course.id}}" tag="a">
                    <img class="card-img-top" :src="course.image">
                </router-link>
                <div class="card-body">
                    <!--                        <h5 class="card-title">Card title</h5>-->
                    <p class="card-text">
                        <strong>Category - </strong> {{course.sub_category.category.name_en}} <br>
                        <strong>Sub-category - </strong> {{course.sub_category.name_en}} <br>
                        <strong>Duration - </strong> {{course.estimated_duration}} <br>
                        <strong>Language - </strong> {{course.language}} <br>
                        <strong>Sessions - </strong> {{course.sections.length}} <br>
                        <strong>Price - </strong> ${{course.price}} <br>

                    </p>

                    <router-link
                        :to="{ name: 'Checkout', params: {id: course.id, name: course.name, price: course.price}}"
                        tag="button" class="btn btn-primary btn-block my-3">
                        S'inscrire à ce cours
                    </router-link>
                </div>
            </div>

        </div>


<!--        <router-link :to="{ name: 'Detail', params: { slug: course.id}}" tag="a">-->
<!--            <div class="row mb-2 shadow-sm px-0 py-2 bg-white justify-content-around align-items-center text-center">-->
<!--                <div class="col-md-3  align-items-center">-->
<!--                    <img class="w-100 rounded-circle" :src="course.image" alt="Card image cap">-->
<!--                </div>-->
<!--                <div class="col-md-9 justify-content-center align-items-center">-->
<!--                    <div class="row text-left">-->
<!--                        <div class="col-md-3 col-sm-12 justify-content-center align-items-center ">-->
<!--                            <strong>{{course.sub_category.category.name_en}}</strong> >-->
<!--                            <strong>{{course.sub_category.name_en}}</strong>-->
<!--                        </div>-->
<!--                        <div class="col-md-3 col-sm-12 justify-content-center align-items-center "><b>Number of-->
<!--                            Sessions:</b> 3-->
<!--                        </div>-->
<!--                        <div class="col-md-3 col-sm-12 justify-content-center align-items-center "><b>Duration per-->
<!--                            session:</b>{{course.duration}}-->
<!--                        </div>-->
<!--                        <div class="col-md-3 col-sm-12 justify-content-center align-items-center "><b>Language:</b>-->
<!--                            {{course.language}}-->
<!--                        </div>-->

<!--                    </div>-->
<!--                    <div class="row text-left ">-->
<!--                        <div class="col-6">-->
<!--                            <b>Description :</b> <br>-->
<!--                            {{course.short_description}}-->
<!--                        </div>-->
<!--                        <div class="col-6 text-right">-->
<!--                            Price per session: <b>{{course.price==0?"Free":"$"+course.price}}</b>-->
<!--                        </div>-->

<!--                    </div>-->
<!--                    <div class="row text-left mt-2">-->
<!--                        <div class="col-4">-->
<!--                            <b>Availability</b>-->
<!--                        </div>-->
<!--                        <div class="col-4">-->
<!--                            17/09: 05pm - 8pm ET-->
<!--                        </div>-->
<!--                        <div class="col-4">-->
<!--                            10/10: 11am - 12pm ET-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="row  mt-2">-->
<!--                        <div class="col-md-6 align-items-center">-->
<!--                            <div v-if="course.sharable">-->
<!--                                <b>Partager sur </b>-->
<!--                                <i class="fa fa-facebook  mr-3"></i>-->
<!--                                <i class="fa fa-instagram  mr-3"></i>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-md-6 text-right">-->
<!--                            <router-link-->
<!--                                :to="{ name: 'Checkout', params: {id: course.id, name: course.name, price: course.price}}"-->
<!--                                tag="a" class="btn btn-primary my-3">-->
<!--                                S'inscrire à ce cours-->
<!--                            </router-link>-->
<!--                        </div>-->
<!--                    </div>-->

<!--                </div>-->
<!--            </div>-->
<!--        </router-link>-->

<!--    </div>-->

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
