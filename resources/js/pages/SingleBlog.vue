<template>
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-7 mx-auto ">
                <div class="card text-center">
                    <div class="p-1">
                        <img :src="`/${post.img_path}`" class="card-img-top" alt="..."  loading="lazy">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-success text-capitalize">{{ post.title }}</h5>
                        <p class="card-text">{{ post.body }}</p>
                    </div>
                    <div class="card-footer text-muted">
                        <h6>{{ post.created_at }}</h6>
                        <span class="text-danger">Auth : {{ post.user }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- -------------------related posts------------------- -->
    <section class="mt-5">
        <div class="container related-posts" v-if="relatedPosts.length >= 1">
            <h3 class="fw-bolder text-secondary ">Related Category</h3>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
                <RouterLink
                v-for="item in relatedPosts" 
                :key="item.id"
                :to="{name:'SingleBlog' , params:{slug:item.slug},
                    }">
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img :src="`/${item.img_path}`" class="card-img-top" alt="..." loading="lazy">
                        <div class="card-body">
                            <h5 class="card-text text-success">{{item.title}}</h5>
                        </div>
                    </div>
                </div>
                </RouterLink>
            </div>
        </div>
    </section>
</template>


<script>
export default {
    emits: ['updateSidebar'],
    props: ["slug"],

    data() {
        return {
            post: {},
            relatedPosts: [],
        };
    },

    mounted() {
        // get all blogs  from the api and store it in posts variable
        axios
            .get("/api/posts/" + this.slug)
            .then((response) => {
                // console.log(response.data.data)
                this.post = response.data.data;
            })
            .catch((error) => {
                console.log(error)
                // this.errors = error.response.data.errors;
            });




        //  make a request for related posts
        axios
            .get('/api/related-posts/' + this.slug)
            .then((res) => {
                this.relatedPosts = res.data.data
            }).catch(err => console.log(err));

    },


};
</script>