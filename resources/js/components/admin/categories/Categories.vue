<template>
    <div>
        <big-sppiner v-if="loadingCategories"/>
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
                    <th scope="col">Name in English</th>
                    <th scope="col">Name in French</th>
                    <th scope="col">Published</th>
                    <th scope="col">Edit</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="t in allCategories">
                    <th scope="row">{{t.id}}</th>
                    <td>{{t.name_en}}</td>
                    <td>{{t.name_fr}}</td>
                    <td>{{t.published}}</td>
                    <td>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#newCategModel" @click="newCateg.id=t.id,newCateg.nom=t.name_fr, newCateg.name=t.name_en" >Edit</button>
                    </td>
                    <td>
                        <a href="javascript:;"
                            class="btn btn-danger"
                            v-on:click="deleteCategory(t.id)">
                            Delete
                        </a>                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="modal fade " id="newCategModel" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">New Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="my-3" method="post" @submit.prevent>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title">Name (English)</label>
                                        <input type="text" class="form-control" id="title" v-model="newCateg.name"
                                               required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="desc">Name (french)</label>
                                        <input type="text" class="form-control" id="desc" v-model="newCateg.nom"
                                               required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control-file" id="image">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-block" type="submit" @click="saveCategory">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'
    import BigSppiner from "../../spinners/BigSppiner";
    import axios from "axios";

    export default {
        name: "Categories",
        components: {BigSppiner},
        data(){
          return{
              newCateg: {
                  id: '',
                  name: '',
                  nom: '',
              },
          }
        },
        methods: {
            ...mapActions(["fetchCategories"]),
            deleteCategory(id) {
                const token = localStorage.getItem("token") || null;
                if (token) {
                    axios.defaults.headers.common["Authorization"] = "Bearer " + token;
                    if (confirm("Do you really want to delete?")) {
                        this.$store
                            .dispatch("deleteCategory", id)
                            .then((resp) => {
                                location.reload();
                            })
                            .catch((error) => {
                                console.log(error);
                            });
                    }
                }
            },
            saveCategory() {
                const formData = new FormData();
                const imagefile = document.querySelector('#image');
                formData.append("name_en", this.newCateg.name);
                formData.append("name_fr", this.newCateg.nom);
                formData.append("image", imagefile.files[0]);
                formData.append("_method", "put");
                axios.post('/categories/'+this.newCateg.id, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                }).then(res => {
                    console.log(res);
                    alert("Category edited successfully")
                    location.reload()
                })
            },
        },
        computed: mapGetters(["allCategories", "loadingCategories"]),
        created() {
            this.fetchCategories();
        }
    }
</script>

<style scoped>

</style>
