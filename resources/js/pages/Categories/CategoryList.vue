
<script setup>
import Navbar from '../inc/Navbar.vue';
</script>


<template>
    <Navbar />
    <router-view />


    <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="success">
        <strong>Deleted Successfully!</strong>
        </div>

    <div class="container">
        <div class="card text-center mb-2" v-for="(category, i) in categories" :key="category.id">
            <div class="card-header bg-success">
                <h3 class="text-white  fw-bolder text-capitalize">{{ category.name }}</h3>
                <span class="text-white">{{ i+1}}</span>
            </div>
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <!-- <a href="#" class="btn btn-secondary me-2 ">Update</a> -->
                <RouterLink class="btn btn-secondary me-2" :to="{name:'EditCategory' , params:{id:category.id}}">Edit</RouterLink>
                <a href="#" class="btn btn-danger" @click="destroy(category.id)">Delete</a>
            </div>
            <div class="card-footer text-muted">
                {{ category.created_at }}
            </div>
        </div>

    </div>
</template>


<script>
export default {
    data() {
        return {
            categories: [],
            success :false,
        };
    },

    methods:{
        destroy(id){
            axios
            .delete("/api/categories/" + id)
            .then(() => {
                // console.log(response)
                this.success = true;
                setInterval(() => {
                    this.success = false;
                }, 2500);
                this.fetchCategory()

            })
            .catch((error) => {
                // console.log(error)
                this.errors = error.response.data.errors;
            });
        },


        fetchCategory(){
            axios
            .get("/api/categories")
            .then((response) => {
                // console.log(response)
                this.categories = response.data;
            })
            .catch((error) => {
                // console.log(error)
                this.errors = error.response.data.errors;
            });
        }
    },
    mounted() {
        this.fetchCategory()
    },
    emits:['updateSidebar']
}
</script>
