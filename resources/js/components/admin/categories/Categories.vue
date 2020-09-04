<template>
   <div>
       <big-sppiner v-if="loadingCategories" />
       <div v-else>
           <div>
               <form class="form-inline my-2 my-lg-0 mr-lg-2 float-right">
                   <input class="form-control mr-sm-2" type="search" placeholder="Search " aria-label="Search">
                   <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
               </form>
           </div>
           <h1 class="text-center">All platform categories</h1>
           <table class="table">
               <thead>
               <tr>
                   <th scope="col">ID</th>
                   <th scope="col">Name</th>
                   <th scope="col">Description</th>
                   <th scope="col">Published</th>
                   <th scope="col">Edit</th>
               </tr>
               </thead>
               <tbody>
               <tr v-for="t in allCategories">
                   <th scope="row">{{t.id}}</th>
                   <td>{{t.name}}</td>
                   <td>{{t.description}}</td>
                   <td>{{t.published}}</td>
                   <td><button class="btn btn-primary">Edit</button></td>
               </tr>
               </tbody>
           </table>
       </div>
   </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'
    import BigSppiner from "../../spinners/BigSppiner";
    export default {
        name: "Categories",
        components: {BigSppiner},
        methods: {
            ...mapActions(["fetchCategories"])
        },
        computed: mapGetters(["allCategories", "loadingCategories"]),
        created() {
            this.fetchCategories();
        }
    }
</script>

<style scoped>

</style>
