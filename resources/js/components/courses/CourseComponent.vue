<template>
    <div>
        <div class="row mb-2 shadow-sm px-0 py-2 bg-white justify-content-around align-items-center text-center" >
            <div class="col-md-3  align-items-center">
                <router-link :to="{ name: 'Detail', params: { slug: course.slug}}" tag="a">
                    <img class="w-100 rounded-circle" :src="course.image" alt="Card image cap">
                </router-link>
            </div>
            <div class="col-md-9 justify-content-center align-items-center">
                <div class="row text-left">
                    <div class="col-md-4 col-sm-12 justify-content-center align-items-center ">
                        <router-link :to="{ name: 'Detail', params: { slug: course.slug}}" tag="a">
                            <h5 class="card-title text-left">{{course.name}}</h5>
                        </router-link>
                    </div>
                    <div class="col-md-2 col-sm-12 justify-content-center align-items-center "> <b>Duration:</b> 3H</div>
                    <div class="col-md-2 col-sm-12 justify-content-center align-items-center "><b>Language:</b> Fr</div>
                    <div class="col-md-2 col-sm-12 justify-content-center align-items-center "><b>Sessions:</b> 3</div>
                    <div class="col-md-2 col-sm-12 justify-content-center align-items-center "><b>Type:</b> {{course.status==1?"Public":"Private"}}</div>
                </div>
                <div class="row text-left">
                    <div class="col-8">
                        <b>Description</b> <br>
                        {{course.short_description}}
                    </div>
                    <div class="col-4 text-right">
                        <b>Price</b> <br>
                        <b>{{course.price==0?"Free":"$"+course.price}}</b>
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
            </div>



        </div>
    </div>

</template>
<script>

    export default {
        name: "Course",
        props: ["course"],

    };

</script>
<style>
    a:hover {
        text-decoration: none;
    }
</style>
