<template>
    <div class="col-md-3 col-sm-12 p-2 text-center d-flex align-items-stretch">
        <div>
            <router-link :to="{ name: 'CategCourses', params: { id: categ.id}}" tag="a">
                <img class="card-img-top"
                     :src="categ.image"
                     :alt="categ.name_en">
            </router-link>
            <div class=" bg-white rounded  text-center card-body cateDetails">
                <h5 class="card-title  font-weight-bolder">{{(lang==="en")? categ.name_en:
                    categ.name_fr}}</h5>
                <p class="card-text">
                    <span v-for="(sub, index) in categ.sub_categories.slice(0,3)" :key="sub.id">
                        {{index>0? ", ":""}} {{(lang==="en")? sub.name_en:sub.name_fr}}
                    </span>...

                </p>
                <div>
                    <router-link :to="{ name: 'CategCourses', params: { id: categ.id}}" tag="button"
                                 class="btn btn-primary btn-sm mb-2">
                        View Details
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
    .card-img-top {
        /*border-radius: 20px;*/
        /*position: absolute;*/
        /*margin-right: 40px;*/
        /*z-index: ;*/
    }

    /*.card-img-top:not(:last-child) {*/
    /*    right: 50px;*/
    /*}*/

    .cateDetails[data-v-7c127bf0] {
        border: 1px solid #ccc;
        /*margin-top: -5px;*/
        z-index: 1 !important;
        /*position: absolute;*/
        /*    top: 140px;*/
        /*    left: 16px;*/
        /*    box-shadow: 7px 10px 12px 0px rgba(76, 76, 76, 0.56);*/
        /*    width: 95%*/
    }
</style>
