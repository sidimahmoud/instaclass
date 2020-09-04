<template>
   <div>
       <big-sppiner v-if="loadingCategories" />
       <div class="container rounded mb-4">

           <h3 class="text-center">Select category to see it's sub-categories</h3>
           <div class="row ">
               <div class="col-md-12">
                   <div class="form-group">
                       <label for="exampleFormControlSelect1">Select category</label>
                       <select class="form-control" id="exampleFormControlSelect1" @change="loadsubs">
                           <option value="0">Select category</option>
                           <option v-for="t in allCategories" :value="t.id">{{t.id}}-{{t.name}}
                           </option>
                       </select>
                   </div>
               </div>
               <div class="col-md-12">
                   <div class="form-group">
                       <label for="exampleFormControlSelect2">Sub-categories</label>
                       <select multiple class="form-control" id="exampleFormControlSelect2">
                           <option v-for="c in subCategories">{{c.name}}</option>
                       </select>
                   </div>
               </div>
           </div>
           <h3 class="text-center">Or create new sub category</h3>
           <div class="row ">
               <div class="col-md-4">
                   <div class="form-group">
                       <label for="cats">Select category</label>
                       <select class="form-control" id="cats" v-model="category_id">
                           <option value="0">Select category</option>
                           <option v-for="t in allCategories" :value="t.id">{{t.id}}-{{t.name}}
                           </option>
                       </select>
                   </div>
               </div>
               <div class="col-md-4">
                   <div class="form-group">
                       <label for="title">Category name</label>
                       <input type="text" class="form-control" id="title" v-model="name">
                   </div>
               </div>
               <div class="col-md-4">
                   <label >Click to save</label>
                   <button class="btn btn-primary btn-block" @click="saveSub">Create</button>
               </div>
           </div>
       </div>
   </div>
</template>

<script>
    import {mapGetters, mapActions} from "vuex";
    import BigSppiner from "../../spinners/BigSppiner";

    export default {
        name: "SubCategories",
        components: {BigSppiner},
        data() {
            return {
                category_id: '0',
                name: '',
            }
        },
        methods: {
            ...mapActions(["fetchCategories"]),
            loadsubs(event) {
                let id = event.target.value;
                this.$store.dispatch("fetchSubCategories", id)
            },
            saveSub(){
                if (this.category_id==='0'){
                    alert("Select category");
                    return
                }
                axios.post('https://instantclass.herokuapp.com/api/sub-categories', {category_id: this.category_id, name:this.name})
                    .then(res => {
                    alert("Sub-category created successfully")
                    location.reload()
                })
            }
        },
        computed: {
            ...mapGetters(["allCategories", "subCategories", "loadingCategories"]),
        },
        created() {
            this.fetchCategories();
        }
    }
</script>

<style scoped>

</style>
