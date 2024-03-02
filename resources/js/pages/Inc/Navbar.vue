<template>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary shadow px-2">
    <!-- Navbar brand -->
    <!-- Toggle button -->
      <button class="navbar-toggler  " type="button"  data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
      </button>
    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-3 mb-lg-0">
        <button data-mdb-ripple-init type="button" class="btn btn-info me-3  ">
          <RouterLink :to="{name:'Dashboard'}"><i class="fa-solid fa-house"></i></RouterLink>
        </button>
      </ul>
      <!-- Left links -->

      <div class="d-flex align-items-center list_item">
        <button data-mdb-ripple-init type="button" class="btn btn-primary me-3">
          <RouterLink :to="{name:'CreateCategory'}">Create</RouterLink>
        </button>
        <button data-mdb-ripple-init type="button" class="btn btn-primary me-3">
          <RouterLink :to="{name:'CategoryList'}">List</RouterLink>
        </button>
        <button data-mdb-ripple-init type="button" class="btn btn-primary me-3">
          <RouterLink :to="{name:'CreatePost'}">Add Post</RouterLink>
        </button>
        <a
          data-mdb-ripple-init
          class="btn btn-danger px-3 fw-bold "
          href="#"
          role="button"
          @click="logout"
        >
        logout
      </a>
      </div>
    </div>
</nav>
<!-- Navbar -->




</template>
<script>
export default {
  name: 'Navbar',
    methods: {
    logout() {
      axios.post("/api/logout")
        .then(() => {
          this.$router.push({ name: "Home" })
          localStorage.removeItem('authenticated')
          this.$emit('updateSidebar')
        }).catch((error) => console.log(error));
      },
  },
};
</script>

<style scoped>
.navbar {
  margin-bottom: 2rem;
}
</style>