<template>
    <Navbar />
    <router-view />

    <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="success">
        <strong>Post Created Successfully!</strong>
    </div>

    <form @submit.prevent="submit">
        <div class="mb-3">
            <input type="text" class="form-control" id="title" placeholder="Title..." v-model="field.title">
            <span v-if="errors.title" class="text-danger fs-6">{{ errors.title[0] }}</span>
            
        </div>
        <div class="mb-3">
            <input type="file" class="form-control" id="Images" @input="grabFile">
            <span v-if="errors.file" class="text-danger fs-6">{{ errors.file[0] }}</span>
            <div class="preview">
                <img :src="url" alt="">
            </div>
        </div>
        <div class="mb-3">
            <select v-model="field.category_id" class="form-select" aria-label="Default select example">
                <option disabled value="">Choose Category</option>
                <option :value="category.id" v-for="category in categories" :key="category.id">{{category.name}}</option>
            </select>
            <span v-if="errors.category_id" class="text-danger fs-6">{{ errors.category_id[0] }}</span>
        </div>
        <div class="form-floating mb-3">
            <textarea class="form-control" v-model="field.body" id="floatingTextarea"></textarea>
            <label for="floatingTextarea">Body...</label>
            <span v-if="errors.body" class="text-danger fs-6">{{ errors.body[0] }}</span>
        </div>
        <button type="submit" class="btn btn-dark">Create</button>
    </form>
</template>


<script>
import Navbar from '../inc/Navbar.vue';

export default {
    // props:['id'],
    data() {
        return {
            field : {category_id:''},
            errors : {},
            success : false,
            url : "",
            categories : [],
        };
    },
    methods: {
        // cause input file don't work with V-model
        grabFile(e) {
            const file = e.target.files[0];
            this.field.file = file;
            // browser will create url for uploaded file
            this.url = URL.createObjectURL(file)
            // delete references cause  memory leakage
            URL.revokeObjectURL(file)
        },

        submit() {
         axios
        .post("/api/posts", this.field,{
            headers:{ 
                "Content-Type" : "multipart/form-data"
            }
        })
        .then(() => {
            this.success = true;
            this.field = {};
            this.url = null;
            this.field.category_id = "";
            this.errors = "";
            setTimeout(() => {
                    this.success = false;
                }, 2500);

        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          this.success = false;
        });
    },
    },
    mounted (){
        axios
            .get("/api/categories")
            .then((response) => {
                // console.log(response)
                this.categories = response.data;
            })
            .catch((error) => {
                this.errors = error.response.data.errors;
                // console.log(error)
            });
    },


    components: { Navbar },
    emits:['updateSidebar']

};
</script>