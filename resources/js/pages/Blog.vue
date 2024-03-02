<template>
    <nav class="navbar my-3 navbar-expand-lg navbar-light bg-success  blog-navbar">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 custom-ul">
                    <!-- display category dynamically -->
                    <li><a href="#" @click="getPosts()">all</a></li>
                    <li class="nav-item" v-for="category in categories" :key="category.id">
                        <a href="#" @click="filterCategory(category.name)" >{{category.name}}</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input v-model="title" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                </form>
            </div>
        </div>
    </nav>

    <!-- ------------------------start Blog section------------------------ -->
<div class="container">
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">

    <div class="col mb-4" v-for="post in posts" :key="post.id">
      <div class="card">
        <div class="inner">
          <img :src="post.img_path" class="card-img-top card-img" alt="..."  loading="lazy">
        </div>
        <div class="card-body text-center">
          <h5 class="card-title fw-bold text-success text-capitalize">{{post.title}}</h5>
          <p class="card-text preview-text">{{ post.body}}</p>
          <div class="bg-success text-center p-1">
                <RouterLink :to="{name:'SingleBlog' , params:{slug:post.slug}}">{{post.title}}</RouterLink>
             </div>
        </div>
      </div>
    </div>
  </div>
  <!-- pagination -->
  <div class=" pagination">
    <a  href="#" class="page-link bg-dark"
     v-for="(link , i) in links" :key="i" 
     v-html="link.label"
     :class="{active :link.active , disabled:!link.url}"
     @click="changePage(link)"
     ></a>
</div>
<!-- ----------------ending pagination-------------- -->
</div>
<!-- if there is no results -->
<h3 class="text-danger fst-italic text-center" v-if="!posts.length">Sorry, No results found </h3>
<!-- -----------------------end Blog section-------------------------- -->
<!-------------------------- pagination ------------------------->

</template>




<script >

export default {
  emits:['updateSidebar'],
    data() {
        return {
            posts: [],
            categories: [],
            title : '',
            links : [],
        };
    },

    methods: {
        getPosts(){
            axios.get("/api/blog-posts")
            .then((response) => {
                // console.log(response.data.data)
                this.posts = response.data.data;
            })

        },
        filterCategory(name){
            axios.get("/api/posts", {params:{category: name}})
            .then((response) => {
                // console.log(response.data.data)
                this.posts = response.data.data;
                this.links = response.data.meta.links;

            })
            .catch((error) => {
                console.log(error)
                // this.errors = error.response.data.errors;
            });
        },
        // change page for pagination
        changePage(link){
            if(!link.url || link.active){
                return ;
            }
            axios.get(link.url)
            .then((response) => {
                // console.log(response.data.data)
                this.posts = response.data.data;
                this.links = response.data.meta.links;
            })
            .catch((error) => {
                console.log(error)
                // this.errors = error.response.data.errors;
            });
        }
    },
    watch:{
        title(){
            axios.get("/api/posts", {params:{search: this.title}})
            .then((response) => {
                // console.log(response.data.data)
                this.posts = response.data.data;
                this.links = response.data.meta.links;

            })
            .catch((error) => {
                console.log(error)
                // this.errors = error.response.data.errors;
            });
        }
    },
    mounted() {
        axios
            .get("/api/blog-posts")
            .then((response) => {
                // console.log(response.data.data)
                this.posts = response.data.data;
            })
            .catch((error) => {
                console.log(error)
                // this.errors = error.response.data.errors;
            });


            // filter  category by id
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



            // pagination
            axios
            .get("/api/posts")
            .then((response) => {
                // console.log(response)
                // console.log( response.data.meta.links)
                this.links = response.data.meta.links;
            })
            .catch((error) => {
                // console.log(error)
                this.errors = error.response.data.errors;
            });
    },


};
</script>

<!-- // pagination
this.links= response.data.meta.links;
console.log( response.data.meta.links) -->