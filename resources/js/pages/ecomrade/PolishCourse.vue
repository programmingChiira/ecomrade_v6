<template>
  <body class="index-page">
    <Loader/>
    <section class="my-5 py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-10">
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
              <div class="container">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                  <li class="breadcrumb-item"><router-link to="/resource">Course</router-link></li>
                  <li style="color: #189483;" class="breadcrumb-item"><strong>Edit</strong></li>
                </ol>
              </div>
            </nav>
          </div>
        </div>

        <div class="row align-items-center  justify-content-center">

          <div style="padding: 10px;" class="col-lg-12 col-sm-12">
            <form @submit.prevent="submit">
              <label for="name"><span>Name</span></label>
              <input class="form-control" type="text" id="name" v-model="field.name" />
              <span v-if="errors.name" class="error">{{ errors.name[0] }}</span>
              <br />

              <!-- <label for="getcourses"><span>Category Name</span></label>
              <select class="form-control" v-model="field.name" id="getcourses">
                <option disabled value="">Select option</option>
                <option value="null"> Null</option>
                <option :value="category.name" v-for="category in getcourses" :key="category.id">
                  {{ category.name }}
                </option>
              </select>
              <span v-if="errors.name" class="error">{{ errors.name[0] }}</span>
              <br /> -->

              
              
              <button
                                v-if="!isSubmitting"
                                style="margin: 5px; float: right"
                                class="btn bg-gradient-primary btn-sm"
                                type="submit"
                            >
                                Submit
                            </button>
                            <i
                                v-if="isSubmitting"
                                style="
                                    -webkit-animation: fa-spin 3s infinite
                                        linear;
                                    animation: fa-spin 2s infinite linear;
                                    font-size: 17px;
                                    color: #189483;
                                    float: right;
                                "
                                class="fa fa-graduation-cap"
                            ></i>
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
import Loader from './Loader.vue'

export default {
  props: ["id"],
  components: {
    Footer,
    Loader,
  },
  data() {
    return {
      field: {},
      errors: {},
      success: false,
      getcourses: [],
      isSubmitting: false,
    };
  },

  methods: {
    submit() {
      this.isSubmitting = true;
      axios
        .put("/api/courses/" + this.id, this.field)
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
              this.isSubmitting = true;
              console.log('All is well')
              this.$router.push({ name: "AdmCourse" });
              this.isSubmitting = true;
            }
          })

          setInterval(() => {
            this.success = false;
          }, 2500);
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          this.isSubmitting = false;
        });
    },
  },

  mounted() {
    axios
      .get("/api/courses/" + this.id)
      .then((response) => (this.field = response.data))
      .catch((error) => {
        console.log(error);
      });

    axios
      .get("/api/getcourses")
      .then((response) => (this.getcourses = response.data))
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>