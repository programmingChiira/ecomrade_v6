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
                                    <li class="breadcrumb-item"><router-link to="/poll">Poll</router-link></li>
                                    <li style="color: #189483;" class="breadcrumb-item"><strong>New</strong></li>
                                </ol>
                            </div>
                        </nav>
                    </div>
                </div>

                <div class="row align-items-center  justify-content-center">
                    <div style="padding: 10px;" class="col-lg-12 col-sm-12">
                        <h3>Create {{ club.name }} poll</h3>
                        <form @submit.prevent="submit">
                            <div v-if="step === 1">
                                <h4>Poll Intro :</h4>
                                <label for="title"><span>Title<span style="color: red;"> *
                                        </span></span></label>
                                <input class="form-control" type="text" id="title" v-model="pollTitle" required />
                                <input class="form-control" type="hidden" v-model="clubId" />
                                <input class="form-control" type="hidden" v-model="clubName" />
                                <span v-if="errors.title" class="error">{{ errors.title[0] }}</span>
                                <br />

                                <label for="argument"><span>Argument<span style="color: red;"> *
                                        </span></span></label>
                                <input class="form-control" type="text" id="argument" v-model="pollArgument" required />
                                <span v-if="errors.argument" class="error">{{ errors.argument[0] }}</span>
                                <br />

                                <label for="status">Show creator of poll </label>
                                <select class="form-control" v-model="pollOwner">
                                    <option> Yes</option>
                                    <option> No</option>
                                </select>
                                <span v-if="errors.show_owner" class="error">{{ errors.show_owner[0] }}</span>
                                <br />

                                <button class="btn btn-sm" @click.prevent="nextStep">Next</button>
                            </div>

                            <div v-if="step === 2">
                                <h4>Poll Options</h4>
                                <div style="margin: 10px;">
                                    <label for="option_1"><span>Option 1<span style="color: red;"> *</span></span></label>
                                    <input class="form-control" type="text" id="option_1" v-model="pollOption1" required />
                                    <span v-if="errors.option_1" class="error">{{ errors.option_1[0] }}</span>
                                    <label for="image"><span>Option 1 Thumbnail <span style="color: red;"> *
                                            </span></span></label>
                                    <input class="form-control" type="file" id="image" @input="grabFile1" />
                                    <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
                                    <div class="preview row">
                                        <div class="col-6 col-md-6">

                                        </div>
                                        <img :src="url1" alt="" />
                                    </div>
                                    <hr class="horizontal dark my-5">
                                </div>

                                <div v-if="input2 === 2" style="margin: 10px;">
                                    <label for="option_2"><span>Option 2<span style="color: red;"> *</span></span></label>
                                    <input class="form-control" type="text" id="option_2" v-model="pollOption2" required />
                                    <span v-if="errors.option_2" class="error">{{ errors.option_2[0] }}</span>
                                    <label for="image"><span>Option 2 Thumbnail <span style="color: red;"> *
                                            </span></span></label>
                                    <input class="form-control" type="file" id="image" @input="grabFile2" />
                                    <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
                                    <div class="preview row">
                                        <div class="col-6 col-md-6">

                                        </div>
                                        <img :src="url2" alt="" />
                                    </div>
                                    <hr class="horizontal dark my-5">
                                </div>

                                <div v-if="input3 === 3" style="margin: 10px;">
                                    <label for="option_1"><span>Option 3<span style="color: red;"> *</span></span></label>
                                    <input class="form-control" type="text" id="option_3" v-model="pollOption3" required />
                                    <span v-if="errors.option_3" class="error">{{ errors.option_3[0] }}</span>
                                    <label for="image"><span>Option 3 Thumbnail <span style="color: red;"> *
                                            </span></span></label>
                                    <input class="form-control" type="file" id="image" @input="grabFile3" />
                                    <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
                                    <div class="preview row">
                                        <div class="col-6 col-md-6">

                                        </div>
                                        <img :src="url3" alt="" />
                                    </div>
                                    <hr class="horizontal dark my-5">
                                </div>

                                <div v-if="input4 === 4" style="margin: 10px;">
                                    <label for="option_4"><span>Option 4</span></label>
                                    <input class="form-control" type="text" id="option_4" v-model="pollOption4" />
                                    <span v-if="errors.option_4" class="error">{{ errors.option_4[0] }}</span>
                                    <label for="image"><span>Option 4 Thumbnail <span style="color: red;"> *
                                            </span></span></label>
                                    <input class="form-control" type="file" id="image" @input="grabFile4" />
                                    <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
                                    <div class="preview row">
                                        <div class="col-6 col-md-6">

                                        </div>
                                        <img :src="url4" alt="" />
                                    </div>
                                    <hr class="horizontal dark my-5">
                                </div>

                                <div v-if="input5 === 5" style="margin: 10px;">
                                    <label for="option_5"><span>Option 5</span></label>
                                    <input class="form-control" type="text" id="option_5" v-model="pollOption5" />
                                    <span v-if="errors.option_5" class="error">{{ errors.option_5[0] }}</span>
                                    <label for="image"><span>Option 5 Thumbnail <span style="color: red;"> *
                                            </span></span></label>
                                    <input class="form-control" type="file" id="image" @input="grabFile5" />
                                    <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
                                    <div class="preview row">
                                        <div class="col-6 col-md-6">

                                        </div>
                                        <img :src="url5" alt="" />
                                    </div>
                                    <hr class="horizontal dark my-5">
                                </div>

                                <div v-if="input6 === 6" style="margin: 10px;">
                                    <label for="option_1"><span>Option 6</span></label>
                                    <input class="form-control" type="text" id="option_6" v-model="pollOption6" />
                                    <span v-if="errors.option_6" class="error">{{ errors.option_6[0] }}</span>
                                    <label for="image"><span>Option 6 Thumbnail <span style="color: red;"> *
                                            </span></span></label>
                                    <input class="form-control" type="file" id="image" @input="grabFile6" />
                                    <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
                                    <div class="preview row">
                                        <div class="col-6 col-md-6">

                                        </div>
                                        <img :src="url6" alt="" />
                                    </div>
                                    <hr class="horizontal dark my-5">
                                </div>

                                <div v-if="input7 === 7" style="margin: 10px;">
                                    <label for="option_1"><span>Option 7</span></label>
                                    <input class="form-control" type="text" id="option_7" v-model="pollOption7" />
                                    <span v-if="errors.option_7" class="error">{{ errors.option_7[0] }}</span>
                                    <label for="image"><span>Option 7 Thumbnail <span style="color: red;"> *
                                            </span></span></label>
                                    <input class="form-control" type="file" id="image" @input="grabFile7" />
                                    <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
                                    <div class="preview row">
                                        <div class="col-6 col-md-6">

                                        </div>
                                        <img :src="url7" alt="" />
                                    </div>
                                    <hr class="horizontal dark my-5">
                                </div>

                                <div v-if="input8 === 8" style="margin: 10px;">
                                    <label for="option_8"><span>Option 8</span></label>
                                    <input class="form-control" type="text" id="option_8" v-model="pollOption8" />
                                    <span v-if="errors.option_8" class="error">{{ errors.option_8[0] }}</span>
                                    <label for="image"><span>Option 8 Thumbnail <span style="color: red;"> *
                                            </span></span></label>
                                    <input class="form-control" type="file" id="image" @input="grabFile8" />
                                    <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
                                    <div class="preview row">
                                        <div class="col-6 col-md-6">

                                        </div>
                                        <img :src="url8" alt="" />
                                    </div>
                                    <hr class="horizontal dark my-5">
                                </div>

                                <div v-if="input9 === 9" style="margin: 10px;">
                                    <label for="option_9"><span>Option 9</span></label>
                                    <input class="form-control" type="text" id="option_9" v-model="pollOption9" />
                                    <span v-if="errors.option_9" class="error">{{ errors.option_9[0] }}</span>
                                    <label for="image"><span>Option 9 Thumbnail <span style="color: red;"> *
                                            </span></span></label>
                                    <input class="form-control" type="file" id="image" @input="grabFile9" />
                                    <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
                                    <div class="preview row">
                                        <div class="col-6 col-md-6">

                                        </div>
                                        <img :src="url9" alt="" />
                                    </div>
                                    <hr class="horizontal dark my-5">
                                </div>

                                <div v-if="input10 === 10" style="margin: 10px;">
                                    <label for="option_10"><span>Option 10</span></label>
                                    <input class="form-control" type="text" id="option_10" v-model="pollOption10" />
                                    <span v-if="errors.option_10" class="error">{{ errors.option_10[0] }}</span>
                                    <label for="image"><span>Option 10 Thumbnail <span style="color: red;"> *
                                            </span></span></label>
                                    <input class="form-control" type="file" id="image" @input="grabFile10" />
                                    <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
                                    <div class="preview row">
                                        <div class="col-6 col-md-6">

                                        </div>
                                        <img :src="url10" alt="" />
                                    </div>
                                    <hr class="horizontal dark my-5">
                                </div>

                                <h4 v-if="input11 === 11" style="color: #189483;"> Sorry ! you've maxed out on image upload.
                                </h4>

                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear2" type="button"
                                    @click="showInput2">Add
                                    Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear3" type="button"
                                    @click="showInput3">Add
                                    Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear4" type="button"
                                    @click="showInput4">Add
                                    Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear5" type="button"
                                    @click="showInput5">Add
                                    Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear6" type="button"
                                    @click="showInput6">Add
                                    Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear7" type="button"
                                    @click="showInput7">Add
                                    Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear8" type="button"
                                    @click="showInput8">Add
                                    Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear9" type="button"
                                    @click="showInput9">Add
                                    Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear10" type="button"
                                    @click="showInput10">Add
                                    Image
                                </button>
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
            input6: false,
            disappear7: false,
            input7: false,
            disappear8: false,
            input8: false,
            disappear9: false,
            input9: false,
            disappear10: false,
            input10: false,
            input11: false,

            file1: null,
            file2: null,
            file3: null,
            file4: null,
            file5: null,
            file6: null,
            file7: null,
            file8: null,
            file9: null,
            file10: null,

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
            url6: "",
            url7: "",
            url8: "",
            url9: "",
            url10: "",
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


        pollTitle: {
            get() {
                return this.fields.title;
            },
            set(value) {
                this.fields.title = value;
            }
        },

        pollArgument: {
            get() {
                return this.fields.argument;
            },
            set(value) {
                this.fields.argument = value;
            }
        },

        pollOwner: {
            get() {
                return this.fields.show_owner;
            },
            set(value) {
                this.fields.show_owner = value;
            }
        },

        pollOption1: {
            get() {
                return this.fields.option_1;
            },
            set(value) {
                this.fields.option_1 = value;
            }
        },

        pollOption2: {
            get() {
                return this.fields.option_2;
            },
            set(value) {
                this.fields.option_2 = value;
            }
        },

        pollOption3: {
            get() {
                return this.fields.option_3;
            },
            set(value) {
                this.fields.option_3 = value;
            }
        },

        pollOption4: {
            get() {
                return this.fields.option_4;
            },
            set(value) {
                this.fields.option_4 = value;
            }
        },

        pollOption5: {
            get() {
                return this.fields.option_5;
            },
            set(value) {
                this.fields.option_5 = value;
            }
        },

        pollOption6: {
            get() {
                return this.fields.option_6;
            },
            set(value) {
                this.fields.option_6 = value;
            }
        },

        pollOption7: {
            get() {
                return this.fields.option_7;
            },
            set(value) {
                this.fields.option_7 = value;
            }
        },

        pollOption8: {
            get() {
                return this.fields.option_8;
            },
            set(value) {
                this.fields.option_8 = value;
            }
        },

        pollOption9: {
            get() {
                return this.fields.option_9;
            },
            set(value) {
                this.fields.option_9 = value;
            }
        },

        pollOption10: {
            get() {
                return this.fields.option_10;
            },
            set(value) {
                this.fields.option_10 = value;
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
        },
        showInput8() {
            this.disappear2 = false;
            this.disappear3 = false;
            this.disappear4 = false;
            this.disappear5 = false;
            this.disappear6 = false;
            this.disappear7 = false;
            this.disappear8 = false;
            this.disappear9 = true;
            this.input2 = 2;
            this.input3 = 3;
            this.input4 = 4;
            this.input5 = 5;
            this.input6 = 6;
            this.input7 = 7;
            this.input8 = 8;
        },
        showInput9() {
            this.disappear2 = false;
            this.disappear3 = false;
            this.disappear4 = false;
            this.disappear5 = false;
            this.disappear6 = false;
            this.disappear7 = false;
            this.disappear8 = false;
            this.disappear9 = false;
            this.disappear10 = true;
            this.input2 = 2;
            this.input3 = 3;
            this.input4 = 4;
            this.input5 = 5;
            this.input6 = 6;
            this.input7 = 7;
            this.input8 = 8;
            this.input9 = 9;
        },
        showInput10() {
            this.disappear2 = false;
            this.disappear3 = false;
            this.disappear4 = false;
            this.disappear5 = false;
            this.disappear6 = false;
            this.disappear7 = false;
            this.disappear8 = false;
            this.disappear9 = false;
            this.disappear10 = true;
            this.input2 = 2;
            this.input3 = 3;
            this.input4 = 4;
            this.input5 = 5;
            this.input6 = 6;
            this.input7 = 7;
            this.input8 = 8;
            this.input9 = 9;
            this.input10 = 10;
            this.input11 = 11;
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

        grabFile8(event) {
            this.fields.file8 = event.target.files[0];
            this.url8 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        grabFile9(event) {
            this.fields.file9 = event.target.files[0];
            this.url9 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        grabFile10(event) {
            this.fields.file10 = event.target.files[0];
            this.url10 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        submit() {
            const fd = new FormData();
            fd.append("title", this.fields.title);
            fd.append("argument", this.fields.argument);
            fd.append("option_1", this.fields.option_1);
            fd.append("option_2", this.fields.option_2);
            fd.append("option_3", this.fields.option_3);
            fd.append("option_4", this.fields.option_4);
            fd.append("option_5", this.fields.option_5);
            fd.append("option_6", this.fields.option_6);
            fd.append("option_7", this.fields.option_7);
            fd.append("option_8", this.fields.option_8);
            fd.append("option_9", this.fields.option_9);
            fd.append("option_10", this.fields.option_10);
            fd.append("file1", this.fields.file1);
            fd.append("file2", this.fields.file2);
            fd.append("file3", this.fields.file3);
            fd.append("file4", this.fields.file4);
            fd.append("file5", this.fields.file5);
            fd.append("file6", this.fields.file6);
            fd.append("file7", this.fields.file7);
            fd.append("file8", this.fields.file8);
            fd.append("file9", this.fields.file9);
            fd.append("file10", this.fields.file10);
            fd.append("club_id", this.clubId);
            fd.append("club_name", this.clubName);


            fd.append("_method", "POST");


            axios
                .post("/api/polls", fd, {
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
                    this.url8 = null;
                    this.url9 = null;
                    this.url10 = null;
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
                            this.$router.push({ name: "Poll" });
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

    },
};
</script>