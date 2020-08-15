<template>
    <div>
<!--        <div class="card shadow-sm" style="width: 16rem;">-->
<!--            <router-link :to="{ name: 'Detail', params: { slug: course.slug}}" tag="a">-->
<!--                <img class="card-img-top" :src="course.image" alt="Card image cap">-->
<!--                <div class="card-body">-->
<!--                    <h5 class="card-title text-center">{{course.name}}</h5>-->
<!--                    <p class="card-text">{{course.short_description}}</p>-->
<!--                </div>-->
<!--            </router-link>-->
<!--        </div>-->
        <div class="row mb-2 shadow-sm px-0 py-2 bg-white justify-content-around align-items-center text-center" >
            <div class="col-md-3  align-items-center">
                <router-link :to="{ name: 'Detail', params: { slug: course.slug}}" tag="a">
                    <img class="w-50 rounded-circle" :src="course.image" alt="Card image cap">
                    <p>Nom Teacher</p>
                </router-link>
            </div>
            <div class="col-md-9 justify-content-center align-items-center">
                <div class="row">
                    <div class="col-md-4 col-sm-12 justify-content-center align-items-center">
                        <router-link :to="{ name: 'Detail', params: { slug: course.slug}}" tag="a">
                            <h5 class="card-title text-center">{{course.name}}</h5>
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
                        <b>{{course.price==0?"Free":"$"+course.price}}</b>
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
