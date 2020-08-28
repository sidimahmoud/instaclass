<template>
    <div class="media mt-3 shadow-sm">
        <a href="#">
            <img alt="Image"
                 :src="rating.user.image"
                 class="mr-3 rounded-pill" height="50px">
        </a>
        <div class="media-body">
            <div class="reviews-members-header">
                <span class="star-rating float-right">
                      <i class="fa fa-star text-warning" v-for="star in rating.rate"></i>
                </span>
                <h6 class="mb-1"><a class="text-black" href="#">{{rating.user.first_name}} {{rating.user.last_name}}</a>
                </h6>
                <p class="text-gray">{{rating.created_at.slice(0, 10)}}</p>
            </div>
            <div class="reviews-members-body">
                <p>{{rating.review}}
                </p>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "Review",
        props: ["rating"]
    }
</script>

<style scoped>


    .rounded-pill {
        border-radius: 50rem !important;
    }


</style>
