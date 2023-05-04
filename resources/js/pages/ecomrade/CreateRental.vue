<template>
    <body class="index-page">
        <section class="my-5 py-5">

            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-10">
                        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                            <div class="container">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                                    <li class="breadcrumb-item"><router-link to="/rental">Rental</router-link></li>
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
                                <h4>Rental Info</h4>
                                <label for="rental_name"><span>Rental Name<span style="color: red;"> *
                                        </span></span></label>
                                <input class="form-control" type="text" id="rental_name" v-model="rentName" required />
                                <span v-if="errors.rental_name" class="error">{{ errors.rental_name[0] }}</span>
                                <br />

                                <label for="rental_price"><span>Rental Price<span style="color: red;"> *
                                        </span></span></label>
                                <input class="form-control" type="number" id="rental_price" v-model="rentPrice" required />
                                <span v-if="errors.rental_price" class="error">{{ errors.rental_price[0] }}</span>
                                <br />

                                <label for="pay_per"><span>Pay Per<span style="color: red;"> * </span></span></label>
                                <select class="form-control" type="text" id="pay_per" v-model="payPer" required>
                                    <option>Day / Night</option>
                                    <option>Month</option>
                                </select>
                                <span v-if="errors.pay_per" class="error">{{ errors.pay_per[0] }}</span>
                                <br />

                                <label for="status">Select Category<span style="color: red;"> * </span></label>
                                <select class="form-control" v-model="selectedCategory" required>
                                    <option value="">Select a Category</option>
                                    <option :value="rentalcategory.name" v-for="rentalcategory in rentalcategories"
                                        :key="rentalcategory.id">
                                        {{ rentalcategory.name }}</option>
                                </select>
                                <span v-if="errors.rental_category" class="error">{{ errors.rental_category[0] }}</span>
                                <br />

                                <input class="form-control" type="hidden" id="rental_price" v-model="rentCat" />

                                <label for="no_of_rooms"><span>No. of rooms available</span></label>
                                <input class="form-control" type="text" id="no_of_rooms" v-model="rentRooms" required />
                                <span v-if="errors.no_of_rooms" class="error">{{ errors.no_of_rooms[0] }}</span>
                                <br />

                                <label for="maps"><span> Google maps<span style="color: red;"> * </span></span></label>
                                <input class="form-control" type="text" id="maps" v-model="rentMaps" required />
                                <span v-if="errors.maps" class="error">{{ errors.maps[0] }}</span>
                                <br />

                                <label for="rental_area"><span>Rental Location<span style="color: red;"> *
                                        </span></span></label>
                                <select class="form-control" type="text" id="rental_area" v-model="rentArea" required>
                                    <option v-for="location in locations" :key="location.id"> {{ location.name }}</option>
                                </select>
                                <span v-if="errors.rental_area" class="error">{{ errors.rental_area[0] }}</span>
                                <br />

                                <label for="vacancy_status"><span>Rental Availability<span style="color: red;"> *
                                        </span></span></label>
                                <select class="form-control" type="text" id="vacancy_status" v-model="rentStatus" required>
                                    <option>Available</option>
                                    <option>Not available</option>
                                </select>
                                <span v-if="errors.vacancy_status" class="error">{{ errors.vacancy_status[0] }}</span>
                                <br />

                                <button style="margin: 4px;" class="btn btn-sm" @click.prevent="nextStep">Next</button>
                            </div>

                            <div v-if="step === 2">
                                <h4>Rental Images</h4>
                                <label for="image"><span>Image 1<span style="color: red;"> * </span></span></label>
                                <input class="form-control" type="file" id="image" @input="grabFile1" required />
                                <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
                                <div class="preview row">
                                    <div class="col-6 col-md-6">

                                    </div>
                                    <img :src="url1" alt="" />
                                </div>
                                <br />

                                <label v-if="input2 === 2" for="image"><span>Image 2<span style="color: red;"> *
                                        </span></span></label>
                                <input v-if="input2 === 2" class="form-control" type="file" id="image" @input="grabFile2"
                                    required />
                                <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
                                <div v-if="input2 === 2" class="preview row">
                                    <div class="col-6 col-md-6">

                                    </div>
                                    <img :src="url2" alt="" />
                                </div>
                                <hr />

                                <label v-if="input3 === 3" for="image"><span>Image 3<span style="color: red;"> *
                                        </span></span></label>
                                <input v-if="input3 === 3" class="form-control" type="file" id="image" @input="grabFile3"
                                    required />
                                <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
                                <div v-if="input3 === 3" class="preview row">
                                    <div class="col-6 col-md-6">

                                    </div>
                                    <img :src="url3" alt="" />
                                </div>
                                <hr />

                                <label v-if="input4 === 4" for="image"><span>Image 4<span style="color: red;"> *
                                        </span></span></label>
                                <input v-if="input4 === 4" class="form-control" type="file" id="image" @input="grabFile4"
                                    required />
                                <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
                                <div v-if="input4 === 4" class="preview row">
                                    <div class="col-6 col-md-6">

                                    </div>
                                    <img :src="url4" alt="" />
                                </div>
                                <hr />

                                <label v-if="input5 === 5" for="image"><span>Image 5<span style="color: red;"> *
                                        </span></span></label>
                                <input v-if="input5 === 5" class="form-control" type="file" id="image" @input="grabFile5"
                                    required />
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

                                <h4 v-if="input8 === 8" style="rental_area: #189483;"> Sorry ! you've maxed out on image
                                    upload.
                                </h4>

                                <button style="margin: 4px;" class="btn bg-gradient-primary btn-sm" v-if="disappear2"
                                    type="button" @click="showInput2">Add
                                    Image </button>
                                <button style="margin: 4px;" class="btn bg-gradient-primary btn-sm" v-if="disappear3"
                                    type="button" @click="showInput3">Add
                                    Image </button>
                                <button style="margin: 4px;" class="btn bg-gradient-primary btn-sm" v-if="disappear4"
                                    type="button" @click="showInput4">Add
                                    Image </button>
                                <button style="margin: 4px;" class="btn bg-gradient-primary btn-sm" v-if="disappear5"
                                    type="button" @click="showInput5">Add
                                    Image </button>
                                <button style="margin: 4px;" class="btn bg-gradient-primary btn-sm" v-if="disappear6"
                                    type="button" @click="showInput6">Add
                                    Image </button>
                                <button style="margin: 4px;" class="btn bg-gradient-primary btn-sm" v-if="disappear7"
                                    type="button" @click="showInput7">Add
                                    Image </button>
                                <br />
                                <button style="margin: 4px;" class="btn btn-sm" @click.prevent="prevStep">Prev </button>
                                <button style="margin: 4px;" class="btn btn-sm" @click.prevent="nextStep">Next</button>
                            </div>

                            <div v-if="step === 3">
                                <h4>Rental Description</h4>
                                <label for="rental_description_1"><span>Rental Description 1<span style="color: red;"> *
                                        </span></span></label>
                                <input class="form-control" type="text" id="rental_description_1" v-model="rentDesc1"
                                    required />
                                <span v-if="errors.rental_description_1" class="error">{{ errors.rental_description_1[0]
                                }}</span>
                                <br />

                                <label for="rental_description_2"><span>Rental Description 2<span style="color: red;"> *
                                        </span></span></label>
                                <input class="form-control" type="text" id="rental_description_2" v-model="rentDesc2"
                                    required />
                                <span v-if="errors.rental_description_2" class="error">{{ errors.rental_description_2[0]
                                }}</span>
                                <br />

                                <label for="rental_description_3"><span>Rental Description 3<span style="color: red;"> *
                                        </span></span></label>
                                <input class="form-control" type="text" id="rental_description_3" v-model="rentDesc3"
                                    required />
                                <span v-if="errors.rental_description_3" class="error">{{ errors.rental_description_3[0]
                                }}</span>
                                <br />

                                <label for="rental_description_4"><span>Rental Description 4<span style="color: red;"> *
                                        </span></span></label>
                                <input class="form-control" type="text" id="rental_description_4" v-model="rentDesc4"
                                    required />
                                <span v-if="errors.rental_description_4" class="error">{{ errors.rental_description_4[0]
                                }}</span>
                                <br />

                                <label for="rental_description_5"><span>Rental Description 5<span style="color: red;"> *
                                        </span></span></label>
                                <input class="form-control" type="text" id="rental_description_5" v-model="rentDesc5"
                                    required />
                                <span v-if="errors.rental_description_5" class="error">{{ errors.rental_description_5[0]
                                }}</span>
                                <br />

                                <label for="rental_description_6"><span>Rental Description 6</span></label>
                                <input class="form-control" type="text" id="rental_description_6" v-model="rentDesc6" />
                                <span v-if="errors.rental_description_6" class="error">{{ errors.rental_description_6[0]
                                }}</span>
                                <br />

                                <label for="rental_description_7"><span>Rental Description 7</span></label>
                                <input class="form-control" type="text" id="rental_description_7" v-model="rentDesc7" />
                                <span v-if="errors.rental_description_7" class="error">{{ errors.rental_description_7[0]
                                }}</span>
                                <br />

                                <label for="rental_more_info"><span> More Info</span></label>
                                <textarea class="form-control" type="text" id="rental_more_info" v-model="rentMoreInfo"
                                    rows="6" placeholder="More Info ..."></textarea>
                                <span v-if="errors.rental_more_info" class="error">{{ errors.rental_more_info[0] }}</span>
                                <br />
                                <button style="margin: 4px;" class="btn btn-sm" @click.prevent="prevStep">Prev </button>
                                <button style="margin: 4px;" class="btn btn-sm" @click.prevent="nextStep">Next </button>
                            </div>

                            <div v-if="step === 4">
                                <h4>Contact_informations</h4>
                                <label for="no_of_rooms"><span>Contact(Drop)</span></label>
                                <select class="form-control" type="text" id="contact_information" v-model="rentContact">
                                    <option> {{ phone }}</option>
                                </select>
                                <br />
                                <label for="contact_information"><span>Contact<span style="color: red;"> *
                                        </span></span></label>
                                <input class="form-control" type="text" id="contact_information" v-model="rentContact"
                                    required />
                                <span v-if="errors.contact_information" class="error">{{ errors.contact_information[0]
                                }}</span>
                                <br />
                                <button style="margin: 4px;" class="btn btn-sm" @click.prevent="prevStep">Prev </button>
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
                rental_name: '',
                rental_category: '',
                rental_sub_category: '',
                rental_description_1: '',
                rental_description_2: '',
                rental_description_3: '',
                rental_description_4: '',
                rental_description_5: '',
                rental_description_6: '',
                rental_description_7: '',
                rental_more_info: '',
                no_of_rooms: '',
                maps: '',
                rental_area: '',
                location: '',
                vacancy_status: '',
                contact_information: '',
                rental_price: '',
                pay_per: '',
                rental_service: '',
                selectedCategory: '',
                name: '',
            },
            rentalcategories: {},
            selectedCategory: '',
            name: '',

            success: false,
            errors: {},
            url1: "",
            url2: "",
            url3: "",
            url4: "",
            url5: "",
            url6: "",
            url7: "",


            rentals: [],
            title: "",
            links: [],
            phone: "",
            locations: {},

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
            fd.append("rental_name", this.fields.rental_name);
            fd.append("rental_category", this.fields.rental_category);
            fd.append("rental_description_1", this.fields.rental_description_1);
            fd.append("rental_description_2", this.fields.rental_description_2);
            fd.append("rental_description_3", this.fields.rental_description_3);
            fd.append("rental_description_4", this.fields.rental_description_4);
            fd.append("rental_description_5", this.fields.rental_description_5);
            fd.append("rental_description_6", this.fields.rental_description_6);
            fd.append("rental_description_7", this.fields.rental_description_7);
            fd.append("rental_description_8", this.fields.rental_description_8);
            fd.append("rental_more_info", this.fields.rental_more_info);
            fd.append("no_of_rooms", this.fields.no_of_rooms);
            fd.append("maps", this.fields.maps);
            fd.append("rental_area", this.fields.rental_area);
            fd.append("vacancy_status", this.fields.vacancy_status);
            fd.append("contact_information", this.fields.contact_information);
            fd.append("rental_price", this.fields.rental_price);
            fd.append("pay_per", this.fields.pay_per);
            fd.append("file1", this.fields.file1);
            fd.append("file2", this.fields.file2);
            fd.append("file3", this.fields.file3);
            fd.append("file4", this.fields.file4);
            fd.append("file5", this.fields.file5);
            fd.append("file6", this.fields.file6);
            fd.append("file7", this.fields.file7);


            fd.append("_method", "POST");


            axios
                .post("/api/rentals", fd, {
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
                            this.$router.push({ name: "Rental" });
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

        axios.get('/api/rentalcategories')
            .then(response => {
                this.rentalcategories = response.data.data;
            });

        axios.get('/api/locations')
            .then(response => {
                this.locations = response.data.data;
            });

    },

    computed: {
        rentName: {
            get() {
                return this.fields.rental_name;
            },
            set(value) {
                this.fields.rental_name = value;
            }
        },

        // selectedCategory: {
        //   get() {
        //     return this.fields.rental_category;
        //   },
        //   set(value) {
        //     this.fields.rental_category = value;
        //   }
        // },

        rentCat: {
            get() {
                return this.fields.rental_category = this.selectedCategory;
            },
            set(value) {
                this.fields.rental_category = value;
            }
        },

        selectedSubCategory: {
            get() {
                return this.fields.rental_sub_category;
            },
            set(value) {
                this.fields.rental_sub_category = value;
            }
        },

        rentDesc1: {
            get() {
                return this.fields.rental_description_1;
            },
            set(value) {
                this.fields.rental_description_1 = value;
            }
        },

        rentDesc2: {
            get() {
                return this.fields.rental_description_2;
            },
            set(value) {
                this.fields.rental_description_2 = value;
            }
        },

        rentDesc3: {
            get() {
                return this.fields.rental_description_3;
            },
            set(value) {
                this.fields.rental_description_3 = value;
            }
        },

        rentDesc4: {
            get() {
                return this.fields.rental_description_4;
            },
            set(value) {
                this.fields.rental_description_4 = value;
            }
        },

        rentDesc5: {
            get() {
                return this.fields.rental_description_5;
            },
            set(value) {
                this.fields.rental_description_5 = value;
            }
        },

        rentDesc6: {
            get() {
                return this.fields.rental_description_6;
            },
            set(value) {
                this.fields.rental_description_6 = value;
            }
        },

        rentDesc7: {
            get() {
                return this.fields.rental_description_7;
            },
            set(value) {
                this.fields.rental_description_7 = value;
            }
        },

        rentDesc8: {
            get() {
                return this.fields.rental_description_8;
            },
            set(value) {
                this.fields.rental_description_8 = value;
            }
        },

        rentMoreInfo: {
            get() {
                return this.fields.rental_more_info;
            },
            set(value) {
                this.fields.rental_more_info = value;
            }
        },

        rentRooms: {
            get() {
                return this.fields.no_of_rooms;
            },
            set(value) {
                this.fields.no_of_rooms = value;
            }
        },

        rentMaps: {
            get() {
                return this.fields.maps;
            },
            set(value) {
                this.fields.maps = value;
            }
        },

        rentArea: {
            get() {
                return this.fields.rental_area;
            },
            set(value) {
                this.fields.rental_area = value;
            }
        },

        rentStatus: {
            get() {
                return this.fields.vacancy_status;
            },
            set(value) {
                this.fields.vacancy_status = value;
            }
        },

        rentContact: {
            get() {
                return this.fields.contact_information;
            },
            set(value) {
                this.fields.contact_information = value;
            }
        },

        rentPrice: {
            get() {
                return this.fields.rental_price;
            },
            set(value) {
                this.fields.rental_price = value;
            }
        },

        payPer: {
            get() {
                return this.fields.pay_per;
            },
            set(value) {
                this.fields.pay_per = value;
            }
        },

        rentService: {
            get() {
                return this.fields.rental_service;
            },
            set(value) {
                this.fields.rental_service = value;
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
                return this.fields.slug = result + '-' + this.fields.rental_name;
            },
            set(value) {
                this.fields.slug = value;
            }
        }
    },
};
</script>

<style scoped></style>