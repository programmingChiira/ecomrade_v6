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
                                    <li style="color: #189483;" class="breadcrumb-item"><strong>Edit profile</strong></li>
                                </ol>
                            </div>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div style="display: flex;flex-wrap: wrap;margin:6px;float:right;">
                        <!-- <router-link style="margin: 10px;float:right;" title="Delete my account" to="/createblog" class="btn btn-sm">
                            <i style="font-size: 12px;color:red;" class="fa fa-trash-o"></i>
                        </router-link>

                        <router-link style="margin: 10px;float:right;" title="Change password" :to="'/editPassword' + slug" class="btn btn-sm">
                            <i style="font-size: 12px;color: green;" class="fa fa-eye-slash"></i>
                        </router-link> -->
                      </div>
                    <div style="padding: 10px;" class="col-lg-12 col-sm-12">
                        <form @submit.prevent="submit">
                            <!-- Title -->

                            <div v-if="step === 1">

                                <h4>Profile</h4>
                                <label for="image"><span>Profile Pic</span></label>
                                <input class="form-control" type="file" id="image" @input="grabFile" />
                                <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
                                <div class="preview row">
                                    <div class="col-6 col-md-6">

                                    </div>
                                    <img :src="url" alt="" />
                                </div>
                                <br />

                                <label for="name"><span>Name</span></label>
                                <input class="form-control" type="text" id="name" v-model="fields.name"
                                    placeholder="e.g John Doe" />
                                <span v-if="errors.name" class="error">{{ errors.name[0] }}</span>
                                <br />

                                <label for="phone"><span>Phone No.</span></label>
                                <input class="form-control" type="text" id="phone" v-model="fields.phone"
                                    placeholder="e.g +254123458" />
                                <span v-if="errors.phone" class="error">{{ errors.phone[0] }}</span>
                                <br />

                                <label for="email"><span>Email</span></label>
                                <input class="form-control" type="email" id="email" v-model="fields.email"
                                    placeholder="e.g john@doe.com" />
                                <span v-if="errors.email" class="error">{{ errors.email[0] }}</span>
                                <br />

                                <label for="categories"><span>Gender:</span></label>
                                <select class="form-control" v-model="fields.gender" id="categories">
                                    <option disabled value="">Select option</option>
                                    <option value="male"> Male</option>
                                    <option value="female"> Female</option>
                                </select>
                                <span v-if="errors.gender" class="error">{{
                                    errors.gender[0]
                                }}</span>
                                <br />
                                <button class="btn btn-sm" @click.prevent="nextStep">Next</button>

                                <button style="margin: 5px;float:right;" 
                                    class="btn bg-gradient-primary btn-sm"
                                    type="submit">Submit
                                </button>
                            </div>


                            <div v-if="step === 2">
                                <h4>Personal description</h4>
                                <label for="title"><span> Title</span></label>
                                <input class="form-control" type="text" id="title" v-model="fields.title"
                                    placeholder="e.g dev, economist, teacher e.t.c" />
                                <span v-if="errors.title" class="error">{{ errors.title[0] }}</span>
                                <br />

                                <label for="personal_description"><span> Personal description</span></label>
                                <textarea class="form-control" id="personal_description"
                                    v-model="fields.personal_description" rows="6"></textarea>
                                <span v-if="errors.personal_description" class="error">{{ errors.personal_description[0]
                                }}</span>
                                <br />

                                <label for="campus"><span>Campus</span></label>
                                <input class="form-control" type="text" id="campus" v-model="fields.campus" />
                                <span v-if="errors.campus" class="error">{{ errors.campus[0] }}</span>
                                <br />

                                <label for="campus_area"><span>Campus Area</span></label>
                                <input class="form-control" type="text" id="campus_area" v-model="fields.campus_area" />
                                <span v-if="errors.campus_area" class="error">{{ errors.campus[0] }}</span>
                                <br />

                                <button class="btn btn-sm" @click.prevent="prevStep">Prev </button>
                                <button class="btn btn-sm" @click.prevent="nextStep">Next</button>

                                <button style="margin: 5px;float:right;" 
                                    class="btn bg-gradient-primary btn-sm"
                                    type="submit">Submit
                                </button>
                            </div>


                            <div v-if="step === 3">
                                <h4>My links</h4>
                                <label for="youtube"><span>youtube Account Link</span></label>
                                <input class="form-control" type="text" id="youtube" v-model="fields.youtube" />
                                <span v-if="errors.youtube" class="error">{{ errors.youtube[0] }}</span>
                                <br />

                                <label for="instagram"><span>instagram Account Link</span></label>
                                <input class="form-control" type="text" id="instagram" v-model="fields.instagram" />
                                <span v-if="errors.instagram" class="error">{{ errors.instagram[0] }}</span>
                                <br />

                                <label for="twitter"><span>twitter Account Link</span></label>
                                <input class="form-control" type="text" id="twitter" v-model="fields.twitter" />
                                <span v-if="errors.twitter" class="error">{{ errors.twitter[0] }}</span>
                                <br />

                                <label for="facebook"><span>facebook Account Link</span></label>
                                <input class="form-control" type="text" id="facebook" v-model="fields.facebook" />
                                <span v-if="errors.facebook" class="error">{{ errors.facebook[0] }}</span>
                                <br />

                                <label for="linkedin"><span>linkedin Account Link</span></label>
                                <input class="form-control" type="text" id="linkedin" v-model="fields.linkedin" />
                                <span v-if="errors.linkedin" class="error">{{ errors.linkedin[0] }}</span>
                                <br />

                                <label for="github"><span>github Account Link</span></label>
                                <input class="form-control" type="text" id="github" v-model="fields.github" />
                                <span v-if="errors.github" class="error">{{ errors.github[0] }}</span>
                                <br />

                                <!-- Button -->
                                <button class="btn btn-sm" @click.prevent="prevStep">Prev </button>
                                <button style="margin: 5px;float:right;" 
                                    class="btn bg-gradient-primary btn-sm"
                                    type="submit">Submit
                                </button>
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
    props: ["slug"],
    data() {
        return {
            step: 1,
            success: false,
            fields: {
                category_id: "",
            },
            errors: {},
            url: "",
            categories: [],

            users: [],
            title: "",
            links: [],

            id: "",
            name: "",
        };
    },

    methods: {

        nextStep() {
            this.step++;
        },
        prevStep() {
            this.step--;
        },
        filterByCategory(name) {
            axios
                .get("/api/posts", {
                    params: {
                        category: name,
                    },
                })
                .then((response) => {
                    this.posts = response.data.data;
                    this.links = response.data.meta.links;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        changePage(link) {
            if (!link.url || link.active) {
                retun;
            }
            axios
                .get(link.url)
                .then((response) => {
                    this.posts = response.data.data;
                    this.links = response.data.meta.links;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        grabFile(e) {
            const file = e.target.files[0];
            this.fields.file = file;
            this.url = URL.createObjectURL(file);
            URL.revokeObjectURL(file);
        },

        submit() {
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

                    const fd = new FormData();
                    fd.append("name", this.fields.name);
                    fd.append("phone", this.fields.phone);
                    fd.append("email", this.fields.email);
                    fd.append("gender", this.fields.gender);
                    fd.append("title", this.fields.title);
                    fd.append("personal_description", this.fields.personal_description);
                    fd.append("campus", this.fields.campus);
                    fd.append("campus_area", this.fields.campus_area);
                    fd.append("youtube", this.fields.youtube);
                    fd.append("instagram", this.fields.instagram);
                    fd.append("twitter", this.fields.twitter);
                    fd.append("facebook", this.fields.facebook);
                    fd.append("linkedin", this.fields.linkedin);
                    fd.append("github", this.fields.github);
                    if (this.fields.file) {
                        fd.append("file", this.fields.file);
                    }

                    fd.append("_method", "PUT");

                    axios
                        .post(`/api/users/${this.slug}`, fd, {
                            headers: {
                                "content-type": "multipart/form-data",
                            },
                        })
                        .then((res) => {
                            this.$emit("showEditSuccess");
                        })
                        .catch((error) => {
                            this.errors = error.response.data.errors;
                            if (error.response.status === 403) {
                                this.$router.push({ name: "DashboardPostsList" });
                            }
                        });
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('All is well')
                    this.$router.push({ name: 'Profile' });
                }
            })
        },

    },

    watch: {
        title() {
            axios
                .get("/api/posts", {
                    params: {
                        search: this.title,
                    },
                })
                .then((response) => {
                    this.posts = response.data.data;
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
            .get("/api/users/" + this.slug)
            .then((response) => {
                this.fields = response.data.data;
                this.url = "./img/profiles/" + response.data.data.profile_pic;
            })
            .catch((error) => {
                if (error.response.status === 403) {
                    this.$router.push({ name: "Blog" });
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

<style scoped>
.create-post {
    background-color: #fff;
    padding: 0 3vw;
}

.container input,
textarea,
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 20px;
    font-size: 16px;
}

h1 {
    text-align: center;
    padding: 60px 0 50px 0;
}

.add-post-btn {
    background-color: black;
    color: white;
    border: none;
    cursor: pointer;
    transition: 0.3s ease;
}

.add-post-btn:hover {
    transform: translateY(-4px);
}

.preview img {
    max-width: 70%;
    height: 50vh;
    object-fit: contain;
}
</style>