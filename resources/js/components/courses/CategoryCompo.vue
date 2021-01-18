<template>
    <div class="col-md-3 col-sm-12 p-2  text-center d-flex align-items-stretch">
        <div class="card">
            <router-link :to="{ name: 'CategCourses', params: { id: categ.id}}" tag="a">
                <img class="card-img-top"
                     :src="categ.image"
                     :alt="categ.name_en">
            </router-link>
            <div class="card-body cateDetails">
                <h5 class="card-title  font-weight-bolder text-uppercase">
                    <strong>{{(lang==="en")? categ.name_en : categ.name_fr}}</strong>    
                </h5>
                <p class="card-text">
                    <span v-for="(sub, index) in categ.sub_categories.slice(0,3)" :key="sub.id">
                        {{(lang==="en")? sub.name_en:sub.name_fr}}{{ index != 2? ",":"" }}
                    </span>...
                </p>
                <div>
                    <router-link :to="{ name: 'CategCourses', params: { id: categ.id}}" tag="button" class="btn btn-primary btn-sm mb-2">
                        {{$t('veiwDet')}}
                    </router-link>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        name: "CategoryCompo",
        props: ["categ"],
        computed: mapGetters(["lang"])
    }
</script>

<style scoped>
    .cateDetails[data-v-7c127bf0] {
        border: 1px solid #ccc;
    }
</style>
