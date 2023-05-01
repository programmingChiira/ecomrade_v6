<template>

  <body class="index-page">
    <section class="my-5 py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-9">
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
              <div class="container">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                  <li class="breadcrumb-item"><router-link to="/resource">Course year</router-link></li>
                  <li style="color: #189483;" class="breadcrumb-item"><strong>Edit</strong></li>
                </ol>
              </div>
            </nav>
          </div>
        </div>

        <div class="row align-items-center  justify-content-center">

          <div style="padding: 10px;" class="col-lg-12 col-sm-12">
            <form @submit.prevent="submit">
              <label for="year"><span>Year</span></label>
              <input class="form-control" type="text" id="year" v-model="field.year" />
              <span v-if="errors.year" class="error">{{ errors.year[0] }}</span>
              <br />

              <!-- <label for="getyears"><span>Category Name</span></label>
              <select class="form-control" v-model="field.year" id="getyears">
                <option disabled value="">Select option</option>
                <option value="null"> Null</option>
                <option :value="category.year" v-for="category in getyears" :key="category.id">
                  {{ category.year }}
                </option>
              </select>
              <span v-if="errors.year" class="error">{{ errors.year[0] }}</span>
              <br /> -->

              <button style="float: right;" type="submit" class="btn bg-gradient-primary">
                Submit
              </button>
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
  props: ["id"],
  components: {
    Footer
  },
  data() {
    return {
      field: {},
      errors: {},
      success: false,
      getyears: [],
    };
  },
  
  methods: {
    submit() {
      axios
        .put("/api/years/" + this.id, this.field)
        .then(() => {
          this.field = {};
          this.errors = {};
          this.success = true;

          let timerInterval
          Swal.fire({
            title: 'Processing',
            html: '',
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
              this.$router.push({ name: "AdmYear" });
            }
          })

          setInterval(() => {
            this.success = false;
          }, 2500);
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },

  mounted() {
    axios
      .get("/api/years/" + this.id)
      .then((response) => (this.field = response.data))
      .catch((error) => {
        console.log(error);
      });

    axios
      .get("/api/getyears")
      .then((response) => (this.getyears = response.data))
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>