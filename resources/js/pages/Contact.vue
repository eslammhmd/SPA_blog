<template>
    <div class="row mt-5">
        <h4 class="text-center mb-4 fst-italic">Get in touch</h4>
        <div class="col-8" style="margin: 0 auto;">
            <form  @submit.prevent="submit">
                <!-- Email input -->
                <div class="form-outline mb-3">
                    <input type="text" placeholder="Name..." class="form-control"  v-model="fields.name" />
                    <span v-if="errors.name" class="text-danger fw-bold float-end mt-1">{{ errors.name[0] }}</span>
                </div>
                <!-- Email input -->
                <div class="form-outline mb-3">
                    <input type="email" placeholder="Email..." class="form-control" v-model="fields.email" />
                    <span v-if="errors.email" class="text-danger fw-bold float-end mt-1">{{ errors.email[0] }}</span>
                </div>
                <div class="mb-3">
                    <textarea placeholder="Enter your message here..." class="form-control" rows="3" v-model="fields.body"></textarea>
                    <span v-if="errors.body" class="text-danger fw-bold float-end mt-1">{{ errors.body[0] }}</span>
                </div>
                <!-- Submit button -->
                <button type="submit" class="btn btn-success btn-block mb-4">Send Email</button>
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
      axios.post("/api/contact", this.fields)
        .then(() => {
            alert("Message Sent!");
            this.$router.push({ name: "Blog" });
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          console.log(error)
        });
    },
  },
};
</script>
