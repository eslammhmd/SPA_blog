

<template>
    <!-- import nav bar -->
    <Navbar />
    <router-view />
    <!-- show on success -->
        <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="success">
        <strong>Updated Successfully!</strong>
        </div>
        <div class="row mt-5">
        <div class="col-8" style="margin: 0 auto;">
            <form @submit.prevent="submit">
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <label class="form-label mt-1" for="form2Example1">Name...</label>
                    <input type="text" id="form2Example1" class="form-control" v-model="field.name" />
                    <span v-if="errors.name" class="text-danger fs-6">{{ errors.name[0] }}</span>
                </div>
                <!-- Submit button -->
                <button type="submit" class="btn btn-dark btn-block mb-4">Edit</button>
            </form>
        </div>
    </div>



</template>



<script >
import Navbar from '../inc/Navbar.vue';

export default {
    props:['id'],
    data() {
        return {
            field: {},
            errors: {},
            success: false,
        };
    },
    methods: {
        submit() {
            axios
                .put("/api/categories/"+this.id, this.field)
                .then(() => {
                this.field = {};
                this.errors = {};
                this.success = true;
                //  hide this success after 2 second
                setInterval(() => {
                    this.success = false;
                }, 2500);
            })
                .catch((error) => {
                this.errors = error.response.data.errors;
            });
        },
    },
    components: { Navbar },
    mounted() {
        axios
            .get("/api/categories/"+this.id)
            .then((response) => {
                // console.log(response)
                this.field = response.data;
            })
            .catch((error) => {
                // console.log(error)
                this.errors = error.response.data.errors;
            });
    },


    emits:['updateSidebar']
};
</script>


