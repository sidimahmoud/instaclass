<template>
    <div class="card shadow-sm" style="width: 16rem;">
        <router-link :to="{ name: 'Detail', params: { slug: course.slug}}" tag="a">
            <img class="card-img-top" :src="course.image" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title text-center">{{course.name}}</h5>
                <p class="card-text">{{course.short_description}}</p>
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
    a:hover {
        text-decoration: none;
    }
</style>
