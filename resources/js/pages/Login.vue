<template>
    <div class="row mt-5">
        <div class="col-8" style="margin: 0 auto;">
            <form  @submit.prevent="submit">
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="email" id="form2Example1" class="form-control" v-model="fields.email" />
                    <label class="form-label mt-1" for="form2Example1">Email address</label>
                    <span v-if="errors.email" class="text-danger fw-bold float-end mt-1">{{ errors.email[0] }}</span>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" id="form2Example2" class="form-control" v-model="fields.password" />
                    <label class="form-label mt-1" for="form2Example2">Password</label>
                    <span v-if="errors.password" class="text-danger fw-bold float-end mt-1">{{ errors.password[0] }}</span>
                </div>
                <!-- Submit button -->
                <button type="submit" class="btn btn-success btn-block mb-4">Sign in</button>
            </form>
        </div>
    </div>
</template>


<script>
export default {
  data() {
    return {
      fields: {},
      errors: {},
    };
  },
  methods: {
    submit() {
      axios
        .post("/api/login", this.fields)
        .then(() => {
          this.$router.push({ name: "Dashboard" });
          localStorage.setItem('authenticated' , 'true')
          this.$emit('updateSidebar')
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>