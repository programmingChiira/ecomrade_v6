<template>
  <body class="contact-us">
    <header>
      <div class="page-header min-vh-85">
        <div>
          <img style="opacity: 1;object-fit: cover;"
            class="position-absolute fixed-top ms-auto w-50 h-100 z-index-0 d-none d-sm-none d-md-block border-radius-section border-top-end-radius-0 border-top-start-radius-0 border-bottom-end-radius-0"
            src="/assets/img/login.png" alt="image">
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-7 d-flex justify-content-center flex-column">
              <div class="card d-flex blur justify-content-center p-4 shadow-lg my-sm-0 my-sm-6 mt-8 mb-5">
                <div class="text-center">
                  <h3 class="text-gradient text-primary">Contact us</h3>
                  <p class="mb-0">
                    We value inputs from our users, please reach out.
                  </p>
                </div>
                <form id="contact-form" @submit.prevent="submit">
                  <div class="card-body pb-2">
                    <div class="row">
                      <div class="col-md-6">
                        <label>Name</label>
                        <div class="input-group mb-4">
                          <input class="form-control" placeholder="Full Name" aria-label="Full Name" type="text"
                            v-model="fields.name">
                        </div>
                      </div>
                      <div class="col-md-6 ps-md-2">
                        <label>Phone No. / Email</label>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="+254..." v-model="fields.contact">
                        </div>
                      </div>
                    </div>
                    <div class="form-group mb-0 mt-md-0 mt-4">
                      <label>How can we help you?</label>
                      <textarea name="message" class="form-control" id="message" rows="6"
                        placeholder="My feedback is ...." v-model="fields.feedback"></textarea>
                    </div>
                    <div class="row">
                      <div class="col-md-12 text-center">
                        <button type="submit" class="btn bg-gradient-primary mt-3 mb-0">Send Message</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>


    <hr class="horizontal dark my-5">
    <!-- END Section Content -->

    <Footer />
  </body>
</template>

<script>
import Footer from './Footer.vue'

export default {

  components: {
    Footer
  },
  emits: ["updateSidebar"],
  data() {
    return {
      posts: [],
      fields: {
        //
      },
    };
  },

  methods: {

    submit() {
      const fd = new FormData();
      fd.append("name", this.fields.name);
      fd.append("contact", this.fields.contact);
      fd.append("feedback", this.fields.feedback);

      fd.append("_method", "POST");

      axios
        .post("/api/feeds", fd, {
          headers: { "content-type": "multipart/form-data" },
        })
        .then(() => {
          this.fields = {};
          this.success = true;
          this.errors = {};

          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Feedback <strong> Sent</strong>',
            showConfirmButton: false,
            timer: 1500
          })


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

  mounted() {
    axios
      .get("/api/home-posts")
      .then((response) => (this.posts = response.data.data))
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>