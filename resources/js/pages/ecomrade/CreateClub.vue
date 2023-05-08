<template>
  <body class="index-page">
    <div class="full-page-loader" v-if="loading">
      <img src="/triangle.svg" alt="Loader" />
    </div>
    <section class="my-5 py-5">
      <div class="container">

        <div class="row">
          <div class="col-md-4 col-10">
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
              <div class="container">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                  <li class="breadcrumb-item"><router-link to="/club">Club</router-link></li>
                  <li style="color: #189483;" class="breadcrumb-item"><strong>New</strong></li>
                </ol>
              </div>
            </nav>
          </div>
        </div>

        <div class="row align-items-center  justify-content-center">

          <div style="padding: 10px;" class="col-lg-12 col-sm-12">
            <form @submit.prevent="submit">
              <!-- Title -->
              <label for="name"><span>Club name</span></label>
              <input class="form-control" type="text" id="name" v-model="fields.name" />
              <span v-if="errors.name" class="error">{{ errors.name[0] }}</span>
              <br />

              <!-- Image -->
              <label for="image"><span>Thumbnail</span></label>
              <input class="form-control" type="file" id="image" @input="grabFile1" />
              <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
              <div class="preview row">
                <div class="col-6 col-md-6">

                </div>
                <img :src="url1" alt="" />
              </div>
              <br />

              <label for="description"><span>Description</span></label>
              <textarea class="form-control" id="description" v-model="fields.description" rows="6"></textarea>
              <span v-if="errors.description" class="error">{{ errors.description[0] }}</span>
              <br>
              <button style="margin: 5px;float:right;" class="btn bg-gradient-primary btn-sm"
                type="submit">Submit</button>
            </form>
          </div>
        </div>
      </div>
      <hr class="horizontal dark my-5">
    </section>

    <Footer />
  </body>
</template>

<script>
import Footer from './Footer.vue'

export default {

  components: {
    Footer
  },
  data() {
    return {

      showInput: 0,
      file1: null,

      success: false,
      fields: {
        club_category: "",
      },
      errors: {},
      url1: "",
      categories: [],

      clubs: [],
      title: "",
      links: [],

      id: "",
      name: "",
    };
  },

  methods: {

    grabFile1(event) {
      this.fields.file1 = event.target.files[0];
      this.url1 = URL.createObjectURL(event.target.files[0]);
      URL.revokeObjectURL(event.target.files[0]);
    },

    submit() {
      const fd = new FormData();
      fd.append("name", this.fields.name);
      fd.append("description", this.fields.description);
      fd.append("file1", this.fields.file1);

      fd.append("_method", "POST");


      axios
        .post("/api/clubs", fd, {
          headers: { "content-type": "multipart/form-data" },
        })
        .then(() => {
          this.fields = {};
          this.url1 = null;
          this.success = true;
          this.errors = {};

          let timerInterval
          Swal.fire({
            title: 'Processing',
            html: ' ',
            timer: 1000,
            timerProgressBar: true,

            didOpen: () => {
              Swal.showLoading()
              const b = Swal.getHtmlContainer().querySelector('b')
              timerInterval = setInterval(() => {
                if (b) {
                  b.textContent = Swal.getTimerLeft()
                }
              }, 100)


            },
            willClose: () => {
              clearInterval(timerInterval)
            }
          }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
              console.log('All is well')
              this.$router.push({ name: "Club" });
            }
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

  watch: {
    title() {
      axios
        .get("/api/clubs", {
          params: {
            search: this.title,
          },
        })
        .then((response) => {
          this.clubs = response.data.data;
          this.links = response.data.meta.links;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },

  mounted() {

    axios
      .get("/api/user")
      .then((response) => (this.name = response.data.name))
      .catch((error) => {
        if (error.response.status === 401) {
          this.$emit("updateSidebar");
          localStorage.removeItem("authenticated");
          this.$router.push({ name: "Login" });
        }
      });

    axios
      .get("/api/categories")
      .then((response) => (this.categories = response.data))
      .catch((error) => {
        console.log(error);
      });

  },
};
</script>

