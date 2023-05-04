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
                                    <li class="breadcrumb-item"><router-link to="/event">Event</router-link></li>
                                    <li style="color: #189483;" class="breadcrumb-item"><strong>New</strong></li>
                                </ol>
                            </div>
                        </nav>
                    </div>
                </div>

                <div class="row align-items-center  justify-content-center">
                    <div style="padding: 10px;" class="col-lg-12 col-sm-12">
                        <h3>Create {{ club.name }} event</h3>
                        <form @submit.prevent="submit">
                            <div v-if="step === 1">
                                <h4>Event Info</h4>

                                <label for="title"><span>Event Name<span style="color: red;"> * </span></span></label>
                                <input class="form-control" type="text" id="title" v-model="eventTitle" required />
                                <input class="form-control" type="hidden" v-model="clubId" />
                                <input class="form-control" type="hidden" v-model="clubName" />
                                <span v-if="errors.title" class="error">{{ errors.title[0] }}</span>
                                <br />

                                <label for="mode"><span>Mode</span></label>
                                <select class="form-control" type="text" id="mode" v-model="eventMode">
                                    <option>Public</option>
                                    <option>Private</option>
                                </select>
                                <span v-if="errors.mode" class="error">{{ errors.mode[0] }}</span>
                                <br />

                                <label for="mode"><span>Entry</span></label>
                                <select class="form-control" type="text" id="mode" v-model="eventEntry">
                                    <option>Free</option>
                                    <option>Pay</option>
                                </select>
                                <span v-if="errors.mode" class="error">{{ errors.mode[0] }}</span>
                                <br />

                                <div v-if="eventEntry == 'Pay'">
                                    <label for="title"><span>Entry Fee ( Ksh) </span></label>
                                    <input class="form-control" type="number" id="title" v-model="eventEntryFee" />
                                    <span v-if="errors.title" class="error">{{ errors.title[0] }}</span>
                                    <br />
                                </div>

                                <label for="rental_area"><span>Location </span></label>
                                <select class="form-control" type="text" id="rental_area" v-model="eventArea">
                                    <option v-for="location in locations" :key="location.id"> {{ location.name }}</option>
                                </select>
                                <span v-if="errors.rental_area" class="error">{{ errors.rental_area[0] }}</span>
                                <br />

                                <label for="title"><span>Pinned Location</span></label>
                                <input class="form-control" type="text" id="title" v-model="eventLocation" />
                                <span v-if="errors.title" class="error">{{ errors.title[0] }}</span>
                                <br />

                                <label for="title"><span> Date</span></label>
                                <input class="datepicker form-control" type="date" id="title" v-model="eventDate" />
                                <span v-if="errors.title" class="error">{{ errors.title[0] }}</span>
                                <br />

                                <label for="title"><span> Time</span></label>
                                <input class="datepicker form-control" type="time" id="title" v-model="eventTime" />
                                <span v-if="errors.title" class="error">{{ errors.title[0] }}</span>
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

                                <h4 v-if="input6 === 6" style="color: #189483;"> Sorry ! you've maxed out on image upload.
                                </h4>

                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear2" type="button"
                                    @click="showInput2">Add
                                    Image </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear3" type="button"
                                    @click="showInput3">Add
                                    Image </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear4" type="button"
                                    @click="showInput4">Add
                                    Image </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear5" type="button"
                                    @click="showInput5">Add
                                    Image </button>
                                <br />
                                <button class="btn btn-sm" @click.prevent="prevStep">Prev </button>
                                <button class="btn btn-sm" @click.prevent="nextStep">Next</button>
                            </div>

                            <div v-if="step === 3">
                                <h4>Event requirement</h4>
                                <label for="product_more_info"><span> Event Description</span></label>
                                <textarea class="form-control" type="text" id="product_more_info" v-model="eventDescription"
                                    rows="6" placeholder="More Info ..."></textarea>
                                <span v-if="errors.product_more_info" class="error">{{ errors.product_more_info[0] }}</span>
                                <br />

                                <label for="requirement_1"><span>Event requirement 1<span style="color: red;"> *
                                        </span></span></label>
                                <input class="form-control" type="text" id="requirement_1" v-model="eventReq1" required />
                                <span v-if="errors.requirement_1" class="error">{{ errors.requirement_1[0] }}</span>
                                <br />

                                <label for="requirement_2"><span>Event requirement 2<span style="color: red;"> *
                                        </span></span></label>
                                <input class="form-control" type="text" id="requirement_2" v-model="eventReq2" required />
                                <span v-if="errors.requirement_2" class="error">{{ errors.requirement_2[0] }}</span>
                                <br />

                                <label for="requirement_3"><span>Event requirement 3<span style="color: red;"> *
                                        </span></span></label>
                                <input class="form-control" type="text" id="requirement_3" v-model="eventReq3" required />
                                <span v-if="errors.requirement_3" class="error">{{ errors.requirement_3[0] }}</span>
                                <br />

                                <label for="requirement_4"><span>Event requirement 4</span></label>
                                <input class="form-control" type="text" id="requirement_4" v-model="eventReq4" />
                                <span v-if="errors.requirement_4" class="error">{{ errors.requirement_4[0] }}</span>
                                <br />

                                <label for="requirement_5"><span>Event requirement 5</span></label>
                                <input class="form-control" type="text" id="requirement_5" v-model="eventReq5" />
                                <span v-if="errors.requirement_5" class="error">{{ errors.requirement_5[0] }}</span>
                                <br />

                                <button class="btn btn-sm" @click.prevent="prevStep">Prev </button>
                                <button class="btn btn-sm" @click.prevent="nextStep">Next </button>
                            </div>

                            <div v-if="step === 4">
                                <h4>Event Contact</h4>
                                <label for="mode"><span>Seller Contact(Drop)</span></label>
                                <select class="form-control" type="text" id="time" v-model="eventContact">
                                    <option> {{ phone }}</option>
                                </select>
                                <br />
                                <label for="time"><span>Seller Contact <span style="color: red;"> * </span></span></label>
                                <input class="form-control" type="text" id="time" v-model="eventContact" required />
                                <span v-if="errors.time" class="error">{{ errors.time[0] }}</span>
                                <br />

                                <label for="mode"><span>Show Contact</span></label>
                                <select class="form-control" type="text" id="mode" v-model="eventShowContact">
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                                <span v-if="errors.mode" class="error">{{ errors.mode[0] }}</span>
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
import Footer from './Footer.vue';
export default {
    components: {
        Footer
    },
    emits: ["updateSidebar"],
    props: ["slug"],
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

            file1: null,
            file2: null,
            file3: null,
            file4: null,
            file5: null,

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
            phone: "",
            locations: {},
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



        eventTitle: {
            get() {
                return this.fields.title;
            },
            set(value) {
                this.fields.title = value;
            }
        },

        eventMode: {
            get() {
                return this.fields.mode;
            },
            set(value) {
                this.fields.mode = value;
            }
        },

        eventEntry: {
            get() {
                return this.fields.entry;
            },
            set(value) {
                this.fields.entry = value;
            }
        },

        eventEntryFee: {
            get() {
                return this.fields.entry_cost;
            },
            set(value) {
                this.fields.entry_cost = value;
            }
        },

        eventArea: {
            get() {
                return this.fields.area;
            },
            set(value) {
                this.fields.area = value;
            }
        },

        eventLocation: {
            get() {
                return this.fields.location;
            },
            set(value) {
                this.fields.location = value;
            }
        },

        eventDate: {
            get() {
                return this.fields.date;
            },
            set(value) {
                this.fields.date = value;
            }
        },

        eventTime: {
            get() {
                return this.fields.time;
            },
            set(value) {
                this.fields.time = value;
            }
        },

        eventDescription: {
            get() {
                return this.fields.description;
            },
            set(value) {
                this.fields.description = value;
            }
        },

        eventReq1: {
            get() {
                return this.fields.requirement_1;
            },
            set(value) {
                this.fields.requirement_1 = value;
            }
        },

        eventReq2: {
            get() {
                return this.fields.requirement_2;
            },
            set(value) {
                this.fields.requirement_2 = value;
            }
        },

        eventReq3: {
            get() {
                return this.fields.requirement_3;
            },
            set(value) {
                this.fields.requirement_3 = value;
            }
        },

        eventReq4: {
            get() {
                return this.fields.requirement_4;
            },
            set(value) {
                this.fields.requirement_4 = value;
            }
        },

        eventReq5: {
            get() {
                return this.fields.requirement_5;
            },
            set(value) {
                this.fields.requirement_5 = value;
            }
        },

        eventContact: {
            get() {
                return this.fields.contact;
            },
            set(value) {
                this.fields.contact = value;
            }
        },

        eventShowContact: {
            get() {
                return this.fields.show_contact;
            },
            set(value) {
                this.fields.show_contact = value;
            }
        },
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
            fd.append("file1", this.fields.file1);
            fd.append("file2", this.fields.file2);
            fd.append("file3", this.fields.file3);
            fd.append("file4", this.fields.file4);
            fd.append("file5", this.fields.file5);
            fd.append("requirement_1", this.fields.requirement_1);
            fd.append("requirement_2", this.fields.requirement_2);
            fd.append("requirement_3", this.fields.requirement_3);
            fd.append("requirement_4", this.fields.requirement_4);
            fd.append("requirement_5", this.fields.requirement_5);
            fd.append("description", this.fields.description);
            fd.append("mode", this.fields.mode);
            fd.append("area", this.fields.area);
            fd.append("location", this.fields.location);
            fd.append("date", this.fields.date);
            fd.append("time", this.fields.time);
            fd.append("entry", this.fields.entry);
            fd.append("entry_cost", this.fields.entry_cost);
            fd.append("contact", this.fields.contact);
            fd.append("show_contact", this.fields.show_contact);
            fd.append("club_id", this.clubId);
            fd.append("club_name", this.clubName);



            fd.append("_method", "POST");


            axios
                .post("/api/events", fd, {
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
                            this.$router.push({ name: "Event" });
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

        axios.get('/api/locations')
            .then(response => {
                this.locations = response.data.data;
            });

    },
};
</script>