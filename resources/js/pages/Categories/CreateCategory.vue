<template>
    <!-- import nav bar -->
    <Navbar />
    <router-view />
    <!-- show on success -->
        <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="success">
        <strong>Created Successfully!</strong>
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
                <button type="submit" class="btn btn-dark btn-block mb-4">Create</button>
            </form>
        </div>
    </div>

</template>



<script >
import Navbar from '../inc/Navbar.vue';

export default {
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
                .post("/api/categories/create", this.field)
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
    emits:['updateSidebar']
};
</script>