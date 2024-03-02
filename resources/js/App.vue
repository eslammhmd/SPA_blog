<template>
<div class="container-fluid">
    <a class="btn btn-success mt-2" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
    <i class="fa-solid fa-arrow-right"></i>
</a>
<div class="offcanvas offcanvas-start bg-success" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title fw-bold text-white">Brand</h5>
    <button type="button" style="color: white; !important" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div class="d-flex flex-column fw-bold ">
        <RouterLink :to="{name:'Home'}">Home</RouterLink>
        <RouterLink :to="{name:'Blog'}">Blog</RouterLink>
        <RouterLink :to="{name:'Contact'}">Contact</RouterLink>
        <RouterLink v-if="!loggedIn"  :to="{name:'Login'}">Dashboard</RouterLink>
    </div>
  </div>
</div>

<main>
    <div class="container">
        <!-- listen to emit event -->
        <router-view @update-sidebar="updateSidebar" :key="$route.path"></router-view>

    </div>
</main>
</div>

</template>



<script>
export default{
    data(){
        return {
            loggedIn: false,
        }
    },


    methods:{
        updateSidebar(){
            this.loggedIn = !this.loggedIn;
        }
    },
    mounted(){
        if(localStorage.getItem('authenticated')){
            this.loggedIn=true;
        }else{
            this.loggedIn=false;
        }
    },


    emits:['updateSidebar'],
}
</script>