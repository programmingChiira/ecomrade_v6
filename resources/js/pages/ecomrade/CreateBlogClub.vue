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
                  <li class="breadcrumb-item"><router-link to="/blog">Blog</router-link></li>
                  <li style="color: #189483;" class="breadcrumb-item"><strong>New</strong></li>
                </ol>
              </div>
            </nav>
          </div>
        </div>

        <div class="row align-items-center  justify-content-center">
          <div style="padding: 10px;" class="col-lg-12 col-sm-12">
            <h3>Create {{ club.name }} article</h3>
            <form @submit.prevent="submit">
              <!-- Title -->
              <label for="title"><span>Title</span></label>
              <input class="form-control" type="text" id="title" v-model="fields.title" />
              <input class="form-control" type="hidden" v-model="clubId" />
              <input class="form-control" type="hidden" v-model="clubName" />
              <span v-if="errors.title" class="error">{{ errors.title[0] }}</span>
              <br />

              <!-- Image -->
              <label for="image"><span>Image 1</span></label>
              <input class="form-control" type="file" id="image" @input="grabFile1" />
              <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
              <div class="preview row">
                <div class="col-6 col-md-6">

                </div>
                <img :src="url1" alt="" />
              </div>
              <br />

              <label v-if="input2 === 2" for="image"><span>Image 2</span></label>
              <input v-if="input2 === 2" class="form-control" type="file" id="image" @input="grabFile2" />
              <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
              <div v-if="input2 === 2" class="preview row">
                <div class="col-6 col-md-6">

                </div>
                <img :src="url2" alt="" />
              </div>
              <hr />

              <label v-if="input3 === 3" for="image"><span>Image 3</span></label>
              <input v-if="input3 === 3" class="form-control" type="file" id="image" @input="grabFile3" />
              <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
              <div v-if="input3 === 3" class="preview row">
                <div class="col-6 col-md-6">
                </div>
                <img :src="url3" alt="" />
              </div>
              <hr />

              <label v-if="input4 === 4" for="image"><span>Image 4</span></label>
              <input v-if="input4 === 4" class="form-control" type="file" id="image" @input="grabFile4" />
              <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
              <div v-if="input4 === 4" class="preview row">
                <div class="col-6 col-md-6">

                </div>
                <img :src="url4" alt="" />
              </div>
              <hr />

              <label v-if="input5 === 5" for="image"><span>Image 5</span></label>
              <input v-if="input5 === 5" class="form-control" type="file" id="image" @input="grabFile5" />
              <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
              <div v-if="input5 === 5" class="preview row">
                <div class="col-6 col-md-6">

                </div>
                <img :src="url5" alt="" />
              </div>
              <hr />

              <h4 v-if="input6 === 6" style="color: #189483;"> Sorry ! you've maxed out on image upload.
              </h4>

              <button class="btn bg-gradient-primary btn-sm" v-if="disappear2" type="button" @click="showInput2">Add
                Image </button>
              <button class="btn bg-gradient-primary btn-sm" v-if="disappear3" type="button" @click="showInput3">Add
                Image </button>
              <button class="btn bg-gradient-primary btn-sm" v-if="disappear4" type="button" @click="showInput4">Add
                Image </button>
              <button class="btn bg-gradient-primary btn-sm" v-if="disappear5" type="button" @click="showInput5">Add
                Image </button>
              <br />

              <!-- Drop down -->
              <label for="categories"><span>Choose a category:</span></label>
              <select class="form-control" v-model="fields.post_category" id="categories">
                <option disabled value="">Select option</option>
                <option :value="category.name" v-for="category in categories" :key="category.id">
                  {{ category.name }}
                </option>
              </select>
              <span v-if="errors.post_category" class="error">{{
                errors.post_category[0]
              }}</span>
              <br />

              <label for="body"><span>Body</span></label>
              <textarea class="form-control" id="body" v-model="fields.body" rows="6"></textarea>
              <span v-if="errors.body" class="error">{{ errors.body[0] }}</span>
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
import Footer from './Footer.vue';
export default {
  components: {
    Footer
  },
  emits: ["updateSidebar"],
  props: ["slug"],
  data() {
    return {

      showInput: 0,

      disappear2: true,
      input2: false,
      disappear3: false,
      input3: false,
      disappear4: false,
      input4: false,
      disappear5: false,
      input5: false,

      file1: null,
      file2: null,
      file3: null,
      file4: null,

      club: {},
      success: false,
      fields: {
        post_category: "",
      },
      errors: {},
      url1: "",
      url2: "",
      url3: "",
      url4: "",
      url5: "",
      categories: [],

      id: "",
      name: "",
    };
  },
  computed: {
    clubId: {
      get() {
        return this.club.id;
      },
      set(value) {
        this.club.id = value;
      }
    },

    clubName: {
      get() {
        return this.club.name;
      },
      set(value) {
        this.club.name = value;
      }
    },
  },
  methods: {

    showInput2() {
      this.disappear2 = false;
      this.disappear3 = true;
      this.input2 = 2;
    },
    showInput3() {
      this.disappear2 = false;
      this.disappear3 = false;
      this.disappear4 = true;
      this.input2 = 2;
      this.input3 = 3;
    },
    showInput4() {
      this.disappear2 = false;
      this.disappear3 = false;
      this.disappear4 = false;
      this.disappear5 = true;
      this.input2 = 2;
      this.input3 = 3;
      this.input4 = 4;
    },

    showInput5() {
      this.disappear2 = false;
      this.disappear3 = false;
      this.disappear4 = false;
      this.disappear5 = false;
      this.input2 = 2;
      this.input3 = 3;
      this.input4 = 4;
      this.input5 = 5;
      this.input6 = 6;
    },

    grabFile1(event) {
      this.fields.file1 = event.target.files[0];
      this.url1 = URL.createObjectURL(event.target.files[0]);
      URL.revokeObjectURL(event.target.files[0]);
    },

    grabFile2(event) {
      this.fields.file2 = event.target.files[0];
      this.url2 = URL.createObjectURL(event.target.files[0]);
      URL.revokeObjectURL(event.target.files[0]);
    },

    grabFile3(event) {
      this.fields.file3 = event.target.files[0];
      this.url3 = URL.createObjectURL(event.target.files[0]);
      URL.revokeObjectURL(event.target.files[0]);
    },

    grabFile4(event) {
      this.fields.file4 = event.target.files[0];
      this.url4 = URL.createObjectURL(event.target.files[0]);
      URL.revokeObjectURL(event.target.files[0]);
    },

    grabFile5(event) {
      this.fields.file5 = event.target.files[0];
      this.url5 = URL.createObjectURL(event.target.files[0]);
      URL.revokeObjectURL(event.target.files[0]);
    },

    submit() {
      const fd = new FormData();
      fd.append("title", this.fields.title);
      fd.append("post_category", this.fields.post_category);
      fd.append("body", this.fields.body);
      fd.append("club_id", this.clubId);
      fd.append("club_name", this.clubName);
      fd.append("file1", this.fields.file1);
      fd.append("file2", this.fields.file2);
      fd.append("file3", this.fields.file3);
      fd.append("file4", this.fields.file4);
      fd.append("file5", this.fields.file5);


      fd.append("_method", "POST");


      axios
        .post("/api/club_posts", fd, {
          headers: { "content-type": "multipart/form-data" },
        })
        .then(() => {
          this.fields = {};
          this.url1 = null;
          this.url2 = null;
          this.url3 = null;
          this.url4 = null;
          this.url5 = null;
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
              this.$router.push({ name: "Post" });
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
      .get("/api/clubs/" + this.slug)
      .then(response => {
        //console.log(JSON.stringify(response));
        this.club = response.data.data;
        this.messageCount = response.data.message_count;
      })
      .catch((error) => {
        //console.log(error);
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