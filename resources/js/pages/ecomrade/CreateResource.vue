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
                                    <li class="breadcrumb-item"><router-link to="/resource">Resource</router-link></li>
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
                            <label for="title"><span>Title</span></label>
                            <input class="form-control" type="text" id="title" v-model="fields.title" />
                            <span v-if="errors.title" class="error">{{ errors.title[0] }}</span>
                            <br />

                            <!-- Image -->
                            <label for="image"><span>1<sup>st</sup> File ( Document / Pdf / Image)</span></label>
                            <input class="form-control" type="file" id="image" @input="grabFile1" />
                            <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
                            <br />

                            <label v-if="input2 === 2" for="image"><span>2<sup>nd</sup> File ( Document / Pdf /
                                    Image)</span></label>
                            <input v-if="input2 === 2" class="form-control" type="file" id="image" @input="grabFile2" />
                            <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
                            <hr />

                            <label v-if="input3 === 3" for="image"><span>3<sup>rd</sup> File ( Document / Pdf /
                                    Image)</span></label>
                            <input v-if="input3 === 3" class="form-control" type="file" id="image" @input="grabFile3" />
                            <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
                            <hr />

                            <label v-if="input4 === 4" for="image"><span>4<sup>th</sup> File ( Document / Pdf /
                                    Image)</span></label>
                            <input v-if="input4 === 4" class="form-control" type="file" id="image" @input="grabFile4" />
                            <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
                            <hr />

                            <label v-if="input5 === 5" for="image"><span>5<sup>th</sup> File ( Document / Pdf /
                                    Image)</span></label>
                            <input v-if="input5 === 5" class="form-control" type="file" id="image" @input="grabFile5" />
                            <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
                            <hr />

                            <h4 v-if="input6 === 6" style="color: #189483;"> Sorry ! you've maxed out on resource upload.
                            </h4>

                            <button class="btn bg-gradient-primary btn-sm" v-if="disappear2" type="button"
                                @click="showInput2">Add
                                Resource </button>
                            <button class="btn bg-gradient-primary btn-sm" v-if="disappear3" type="button"
                                @click="showInput3">Add
                                Resource </button>
                            <button class="btn bg-gradient-primary btn-sm" v-if="disappear4" type="button"
                                @click="showInput4">Add
                                Resource </button>
                            <button class="btn bg-gradient-primary btn-sm" v-if="disappear5" type="button"
                                @click="showInput5">Add
                                Resource </button>
                            <br />

                            <!-- Drop down -->
                            <label for="courses"><span>Choose a course:</span></label>
                            <select class="form-control" v-model="fields.course" id="courses">
                                <option disabled value="">Select option</option>
                                <option :value="course.name" v-for="course in courses" :key="course.id">
                                    {{ course.name }}
                                </option>
                            </select>
                            <span v-if="errors.course" class="error">{{
                                errors.course[0]
                            }}</span>
                            <br />

                            <label for="academic_year"><span>Choose an academic year:</span></label>
                            <select class="form-control" v-model="fields.academic_year" id="academic_year">
                                <option disabled value="">Select option</option>
                                <option :value="year.year" v-for="year in years" :key="year.id">
                                    {{ year.year }}
                                </option>
                            </select>
                            <span v-if="errors.course" class="error">{{
                                errors.course[0]
                            }}</span>
                            <br />

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

            success: false,
            fields: {
                academic_year: "",
            },
            errors: {},
            url1: "",
            url2: "",
            url3: "",
            url4: "",
            url5: "",
            courses: {},
            years: {},

            resources: [],
            title: "",
            links: [],

            id: "",
            name: "",
        };
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
            fd.append("academic_year", this.fields.academic_year);
            fd.append("course", this.fields.course);
            fd.append("file1", this.fields.file1);
            fd.append("file2", this.fields.file2);
            fd.append("file3", this.fields.file3);
            fd.append("file4", this.fields.file4);
            fd.append("file5", this.fields.file5);

            fd.append("_method", "POST");

            axios
                .post("/api/resources", fd, {
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
                            this.$router.push({ name: "Resource" });
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
                .get("/api/resources", {
                    params: {
                        search: this.title,
                    },
                })
                .then((response) => {
                    this.resources = response.data.data;
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

        axios.get('/api/courses')
            .then(response => {
                this.courses = response.data.data;
            });

        axios.get('/api/years')
            .then(response => {
                this.years = response.data.data;
            });

    },
};
</script>

