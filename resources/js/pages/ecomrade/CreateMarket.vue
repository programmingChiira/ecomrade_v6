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
                  <li class="breadcrumb-item"><router-link to="/market">Market</router-link></li>
                  <li style="color: #189483;" class="breadcrumb-item"><strong>New</strong></li>
                </ol>
              </div>
            </nav>
          </div>
        </div>



        <div class="row align-items-center  justify-content-center">

          <div style="padding: 10px;" class="col-lg-12 col-sm-12">
            <form @submit.prevent="submit">
              <div v-if="step === 1">
                <h4>Product Info</h4>
                <label for="product_name"><span>Product Name<span style="color: red;"> * </span></span></label>
                <input class="form-control" type="text" id="product_name" v-model="prodName" required />
                <span v-if="errors.product_name" class="error">{{ errors.product_name[0] }}</span>
                <br />

                <label for="product_price"><span>Product Price<span style="color: red;"> * </span></span></label>
                <input class="form-control" type="number" id="product_price" v-model="prodPrice" required />
                <span v-if="errors.product_price" class="error">{{ errors.product_price[0] }}</span>
                <br />

                <label for="product_discount"><span>Price Discount</span></label>
                <input class="form-control" type="number" id="product_discount" v-model="prodDiscount" />
                <span v-if="errors.product_discount" class="error">{{ errors.product_discount[0] }}</span>
                <br />

                <label for="status">Select Category </label>
                <select class="form-control" v-model="selectedCategory">
                  <option value="">Select a Category</option>
                  <option :value="marketcategory.name" v-for="marketcategory in marketcategories"
                    :key="marketcategory.id">
                    {{ marketcategory.name }}</option>
                </select>
                <span v-if="errors.product_category" class="error">{{ errors.product_category[0] }}</span>
                <br />

                <label for="status">Select Sub-Category</label>
                <select class="form-control" v-model="selectedSubCategory" required>
                  <option value="">Select a Sub-Category</option>
                  <option v-for="marketsubcategory in marketsubcategories" :key="marketsubcategory.id"
                    :value="marketsubcategory.name">{{ marketsubcategory.name }}</option>
                </select>
                <span v-if="errors.product_sub_category" class="error">{{ errors.product_sub_category[0] }}</span>
                <br />

                <input class="form-control" type="hidden" id="product_price" v-model="prodCat" />

                <input class="form-control" type="hidden" id="product_price" v-model="prodSubCat" />

                <label for="size"><span>Product Size(Drop)</span></label>
                <select class="form-control" type="text" id="size" v-model="prodSize">
                  <option>Small</option>
                  <option>Medium</option>
                  <option>Large</option>
                </select>
                <span v-if="errors.size" class="error">{{ errors.size[0] }}</span>
                <br />

                <label for="size"><span>Product Size</span></label>
                <input class="form-control" type="text" id="size" v-model="prodSize" />
                <span v-if="errors.size" class="error">{{ errors.size[0] }}</span>
                <br />

                <label for="gender"><span> Target audience</span></label>
                <select class="form-control" type="text" id="gender" v-model="prodGender">
                  <option>Children</option>
                  <option>Male</option>
                  <option>Female</option>
                </select>
                <span v-if="errors.gender" class="error">{{ errors.gender[0] }}</span>
                <br />

                <label for="color"><span>Product Color</span></label>
                <input class="form-control" type="text" id="color" v-model="prodColor" />
                <span v-if="errors.color" class="error">{{ errors.color[0] }}</span>
                <br />

                <label for="availability"><span>Product Availability<span style="color: red;"> * </span></span></label>
                <select class="form-control" type="text" id="availability" v-model="prodAvail" required>
                  <option>Available</option>
                  <option>Out of stock</option>
                </select>
                <span v-if="errors.availability" class="error">{{ errors.availability[0] }}</span>
                <br />

                <label for="contact"><span>Product / Service<span style="color: red;"> * </span></span></label>
                <select class="form-control" v-model="prodService" required>
                  <option value="Product"> Product</option>
                  <option value="Service"> Service</option>
                </select>
                <span v-if="errors.product_service" class="error">{{ errors.product_service[0] }}</span>
                <br />

                <label for="rental_area"><span>Product Location<span style="color: red;"> * </span></span></label>
                <select class="form-control" type="text" id="rental_area" v-model="prodLocation" required>
                  <option v-for="location in locations" :key="location.id"> {{ location.name }}</option>
                </select>
                <span v-if="errors.rental_area" class="error">{{ errors.rental_area[0] }}</span>
                <br />

                <button class="btn btn-sm" @click.prevent="nextStep">Next</button>
              </div>

              <div v-if="step === 2">
                <h4>Product Images</h4>
                <label for="image"><span>Image 1 <span style="color: red;"> * </span></span></label>
                <input class="form-control" type="file" id="image" @input="grabFile1" required />
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

                <label v-if="input6 === 6" for="image"><span>Image 6</span></label>
                <input v-if="input6 === 6" class="form-control" type="file" id="image" @input="grabFile6" />
                <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
                <div v-if="input6 === 6" class="preview row">
                  <div class="col-6 col-md-6">

                  </div>
                  <img :src="url6" alt="" />
                </div>
                <hr />

                <label v-if="input7 === 7" for="image"><span>Image 7</span></label>
                <input v-if="input7 === 7" class="form-control" type="file" id="image" @input="grabFile7" />
                <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
                <div v-if="input7 === 7" class="preview row">
                  <div class="col-6 col-md-6">

                  </div>
                  <img :src="url7" alt="" />
                </div>
                <hr />

                <h4 v-if="input8 === 8" style="color: #189483;"> Sorry ! you've maxed out on image upload.
                </h4>

                <button class="btn bg-gradient-primary btn-sm" v-if="disappear2" type="button" @click="showInput2">Add
                  Image </button>
                <button class="btn bg-gradient-primary btn-sm" v-if="disappear3" type="button" @click="showInput3">Add
                  Image </button>
                <button class="btn bg-gradient-primary btn-sm" v-if="disappear4" type="button" @click="showInput4">Add
                  Image </button>
                <button class="btn bg-gradient-primary btn-sm" v-if="disappear5" type="button" @click="showInput5">Add
                  Image </button>
                <button class="btn bg-gradient-primary btn-sm" v-if="disappear6" type="button" @click="showInput6">Add
                  Image </button>
                <button class="btn bg-gradient-primary btn-sm" v-if="disappear7" type="button" @click="showInput7">Add
                  Image </button>
                <br />
                <button class="btn btn-sm" @click.prevent="prevStep">Prev </button>
                <button class="btn btn-sm" @click.prevent="nextStep">Next</button>
              </div>

              <div v-if="step === 3">
                <h4>Product Description</h4>
                <label for="product_description_1"><span>Product Description 1<span style="color: red;"> *
                    </span></span></label>
                <input class="form-control" type="text" id="product_description_1" v-model="prodDesc1" required />
                <span v-if="errors.product_description_1" class="error">{{ errors.product_description_1[0] }}</span>
                <br />

                <label for="product_description_2"><span>Product Description 2<span style="color: red;"> *
                    </span></span></label>
                <input class="form-control" type="text" id="product_description_2" v-model="prodDesc2" required />
                <span v-if="errors.product_description_2" class="error">{{ errors.product_description_2[0] }}</span>
                <br />

                <label for="product_description_3"><span>Product Description 3<span style="color: red;"> *
                    </span></span></label>
                <input class="form-control" type="text" id="product_description_3" v-model="prodDesc3" required />
                <span v-if="errors.product_description_3" class="error">{{ errors.product_description_3[0] }}</span>
                <br />

                <label for="product_description_4"><span>Product Description 4</span></label>
                <input class="form-control" type="text" id="product_description_4" v-model="prodDesc4" />
                <span v-if="errors.product_description_4" class="error">{{ errors.product_description_4[0] }}</span>
                <br />

                <label for="product_description_5"><span>Product Description 5</span></label>
                <input class="form-control" type="text" id="product_description_5" v-model="prodDesc5" />
                <span v-if="errors.product_description_5" class="error">{{ errors.product_description_5[0] }}</span>
                <br />

                <label for="product_description_6"><span>Product Description 6</span></label>
                <input class="form-control" type="text" id="product_description_6" v-model="prodDesc6" />
                <span v-if="errors.product_description_6" class="error">{{ errors.product_description_6[0] }}</span>
                <br />

                <label for="product_description_7"><span>Product Description 7</span></label>
                <input class="form-control" type="text" id="product_description_7" v-model="prodDesc7" />
                <span v-if="errors.product_description_7" class="error">{{ errors.product_description_7[0] }}</span>
                <br />

                <label for="product_more_info"><span> More Info</span></label>
                <textarea class="form-control" type="text" id="product_more_info" v-model="prodMoreInfo" rows="6"
                  placeholder="More Info ..."></textarea>
                <span v-if="errors.product_more_info" class="error">{{ errors.product_more_info[0] }}</span>
                <br />
                <button class="btn btn-sm" @click.prevent="prevStep">Prev </button>
                <button class="btn btn-sm" @click.prevent="nextStep">Next </button>
              </div>

              <div v-if="step === 4">
                <h4>Seller contacts</h4>
                <label for="size"><span>Seller Contact(Drop)</span></label>
                <select class="form-control" type="text" id="contact" v-model="prodContact">
                  <option> {{ phone }}</option>
                </select>
                <br />
                <label for="contact"><span>Seller Contact <span style="color: red;"> * </span></span></label>
                <input class="form-control" type="text" id="contact" v-model="prodContact" required />
                <span v-if="errors.contact" class="error">{{ errors.contact[0] }}</span>
                <br />
                <button class="btn btn-sm" @click.prevent="prevStep">Prev </button>
                <button style="margin: 5px;float:right;" class="btn bg-gradient-primary btn-sm"
                  type="submit">Submit</button>
              </div>
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
      step: 1,
      showInput: 0,

      disappear2: true,
      input2: false,
      disappear3: false,
      input3: false,
      disappear4: false,
      input4: false,
      disappear5: false,
      input5: false,
      disappear6: false,
      input6: false,
      disappear7: false,
      input7: false,
      disappear8: false,

      file1: null,
      file2: null,
      file3: null,
      file4: null,
      file5: null,
      file6: null,
      file7: null,

      fields: {
        slug: '',
        image_1: '',
        image_2: '',
        image_3: '',
        image_4: '',
        image_5: '',
        image_6: '',
        image_7: '',
        product_name: '',
        product_category: '',
        product_sub_category: '',
        product_description_1: '',
        product_description_2: '',
        product_description_3: '',
        product_description_4: '',
        product_description_5: '',
        product_description_6: '',
        product_description_7: '',
        product_more_info: '',
        size: '',
        gender: '',
        color: '',
        location: '',
        availability: '',
        contact: '',
        product_price: '',
        product_discount: '',
        product_service: '',
        selectedCategory: '',
        name: '',
      },
      marketcategories: {},
      marketsubcategories: {},
      selectedCategory: '',
      name: '',

      fields: {
        //category_id: '',
      },
      success: false,
      errors: {},
      url1: "",
      url2: "",
      url3: "",
      url4: "",
      url5: "",
      url6: "",
      url7: "",


      markets: [],
      title: "",
      links: [],
      phone: "",
      locations: {},
      loading: true,

      // id: "",
      // name: "",
    };
  },

  methods: {

    nextStep() {
      this.step++;
    },
    prevStep() {
      this.step--;
    },

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
      this.disappear6 = true;
      this.input2 = 2;
      this.input3 = 3;
      this.input4 = 4;
      this.input5 = 5;
    },
    showInput6() {
      this.disappear2 = false;
      this.disappear3 = false;
      this.disappear4 = false;
      this.disappear5 = false;
      this.disappear6 = false;
      this.disappear7 = true;
      this.input2 = 2;
      this.input3 = 3;
      this.input4 = 4;
      this.input5 = 5;
      this.input6 = 6;
    },
    showInput7() {
      this.disappear2 = false;
      this.disappear3 = false;
      this.disappear4 = false;
      this.disappear5 = false;
      this.disappear6 = false;
      this.disappear7 = false;
      this.disappear8 = true;
      this.input2 = 2;
      this.input3 = 3;
      this.input4 = 4;
      this.input5 = 5;
      this.input6 = 6;
      this.input7 = 7;
      this.input8 = 8;
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

    grabFile6(event) {
      this.fields.file6 = event.target.files[0];
      this.url6 = URL.createObjectURL(event.target.files[0]);
      URL.revokeObjectURL(event.target.files[0]);
    },

    grabFile7(event) {
      this.fields.file7 = event.target.files[0];
      this.url7 = URL.createObjectURL(event.target.files[0]);
      URL.revokeObjectURL(event.target.files[0]);
    },

    submit() {
      const fd = new FormData();
      fd.append("product_name", this.fields.product_name);
      fd.append("product_category", this.fields.product_category);
      fd.append("product_sub_category", this.fields.product_sub_category);
      fd.append("product_description_1", this.fields.product_description_1);
      fd.append("product_description_2", this.fields.product_description_2);
      fd.append("product_description_3", this.fields.product_description_3);
      fd.append("product_description_4", this.fields.product_description_4);
      fd.append("product_description_5", this.fields.product_description_5);
      fd.append("product_description_6", this.fields.product_description_6);
      fd.append("product_description_7", this.fields.product_description_7);
      fd.append("product_more_info", this.fields.product_more_info);
      fd.append("size", this.fields.size);
      fd.append("gender", this.fields.gender);
      fd.append("color", this.fields.color);
      fd.append("location", this.fields.location);
      fd.append("availability", this.fields.availability);
      fd.append("contact", this.fields.contact);
      fd.append("product_price", this.fields.product_price);
      fd.append("product_discount", this.fields.product_discount);
      fd.append("product_service", this.fields.product_service);
      fd.append("file1", this.fields.file1);
      fd.append("file2", this.fields.file2);
      fd.append("file3", this.fields.file3);
      fd.append("file4", this.fields.file4);
      fd.append("file5", this.fields.file5);
      fd.append("file6", this.fields.file6);
      fd.append("file7", this.fields.file7);


      fd.append("_method", "POST");


      axios
        .post("/api/markets", fd, {
          headers: { "content-type": "multipart/form-data" },
        })
        .then(() => {
          this.fields = {};
          this.url1 = null;
          this.url2 = null;
          this.url3 = null;
          this.url4 = null;
          this.url5 = null;
          this.url6 = null;
          this.url7 = null;
          this.fields.selectedCategory = "";
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
              this.$router.push({ name: "Market" });
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
    selectedCategory: function (arg) {
      axios.get('/api/marketsubcategories?name=' + this.selectedCategory)
        .then(response => {
          console.log(response.data);
          this.marketsubcategories = response.data.data;
        });
    }
  },

  mounted() {
    setTimeout(() => {
      this.loading = false;
    }, 2000);

    axios
      .get("/api/user")
      .then(response => {
        this.id = response.data.id
        this.name = response.data.name
        this.phone = response.data.phone
      })
      .catch((error) => {
        if (error.response.status === 401) {
          this.$emit("updateSidebar");
          localStorage.removeItem("authenticated");
          this.$router.push({ name: "Login" });
        }
      });

    axios.get('/api/marketcategories')
      .then(response => {
        this.marketcategories = response.data.data;
      });

    axios.get('/api/locations')
      .then(response => {
        this.locations = response.data.data;
      });

  },

  computed: {
    prodName: {
      get() {
        return this.fields.product_name;
      },
      set(value) {
        this.fields.product_name = value;
      }
    },

    prodCat: {
      get() {
        return this.fields.product_category = this.selectedCategory;
      },
      set(value) {
        this.fields.product_category = value;
      }
    },

    prodSubCat: {
      get() {
        return this.fields.product_sub_category = this.selectedSubCategory;
      },
      set(value) {
        this.fields.product_sub_category = value;
      }
    },

    selectedSubCategory: {
      get() {
        return this.fields.product_sub_category;
      },
      set(value) {
        this.fields.product_sub_category = value;
      }
    },

    prodDesc1: {
      get() {
        return this.fields.product_description_1;
      },
      set(value) {
        this.fields.product_description_1 = value;
      }
    },

    prodDesc2: {
      get() {
        return this.fields.product_description_2;
      },
      set(value) {
        this.fields.product_description_2 = value;
      }
    },

    prodDesc3: {
      get() {
        return this.fields.product_description_3;
      },
      set(value) {
        this.fields.product_description_3 = value;
      }
    },

    prodDesc4: {
      get() {
        return this.fields.product_description_4;
      },
      set(value) {
        this.fields.product_description_4 = value;
      }
    },

    prodDesc5: {
      get() {
        return this.fields.product_description_5;
      },
      set(value) {
        this.fields.product_description_5 = value;
      }
    },

    prodDesc6: {
      get() {
        return this.fields.product_description_6;
      },
      set(value) {
        this.fields.product_description_6 = value;
      }
    },

    prodDesc7: {
      get() {
        return this.fields.product_description_7;
      },
      set(value) {
        this.fields.product_description_7 = value;
      }
    },

    prodMoreInfo: {
      get() {
        return this.fields.product_more_info;
      },
      set(value) {
        this.fields.product_more_info = value;
      }
    },

    prodSize: {
      get() {
        return this.fields.size;
      },
      set(value) {
        this.fields.size = value;
      }
    },

    prodGender: {
      get() {
        return this.fields.gender;
      },
      set(value) {
        this.fields.gender = value;
      }
    },

    prodColor: {
      get() {
        return this.fields.color;
      },
      set(value) {
        this.fields.color = value;
      }
    },

    prodLocation: {
      get() {
        return this.fields.location;
      },
      set(value) {
        this.fields.location = value;
      }
    },

    prodAvail: {
      get() {
        return this.fields.availability;
      },
      set(value) {
        this.fields.availability = value;
      }
    },

    prodContact: {
      get() {
        return this.fields.contact;
      },
      set(value) {
        this.fields.contact = value;
      }
    },

    prodPrice: {
      get() {
        return this.fields.product_price;
      },
      set(value) {
        this.fields.product_price = value;
      }
    },

    prodDiscount: {
      get() {
        return this.fields.product_discount;
      },
      set(value) {
        this.fields.product_discount = value;
      }
    },

    prodService: {
      get() {
        return this.fields.product_service;
      },
      set(value) {
        this.fields.product_service = value;
      }
    },

    slugValue: {
      get() {
        let result = '';
        let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let charactersLength = characters.length;
        for (let i = 0; i < 100; i++) {
          result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return this.fields.slug = result + '-' + this.fields.product_name;
      },
      set(value) {
        this.fields.slug = value;
      }
    }
  },
};
</script>

<style scoped></style>