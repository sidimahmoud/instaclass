<template>
    <div class="container rounded mb-4">

        <h3 class="text-center">Create category</h3>
        <form class="my-3" method="post" @submit.prevent="saveCategory">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="title">Category name (English)</label>
                        <input type="text" class="form-control" id="title" v-model="name" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nom">Category name (French)</label>
                        <input type="text" class="form-control" id="nom" v-model="nom" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file" id="image" required>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-block" type="submit">Submit</button>
        </form>

    </div>
</template>

<script>
    export default {
        name: "NewCategory",
        data() {
            return {
                name: '',
                nom: '',
            }
        },
        methods: {
            saveCategory() {
                const formData = new FormData();
                const imagefile = document.querySelector('#image');
                formData.append("name", this.name);
                formData.append("nom", this.nom);
                formData.append("image", imagefile.files[0]);
                axios.post('/categories', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                }).then(res => {
                    console.log(res);
                    alert("Category created successfully")
                    location.reload()
                })
            }
        }
    }
</script>
<style scoped>

</style>
