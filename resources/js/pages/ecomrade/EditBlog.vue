<template>
    <body class="index-page">
        <loader/>
        <section class="my-5 py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-10">
                        <nav
                            aria-label="breadcrumb"
                            class="breadcrumb-nav mb-2"
                        >
                            <div class="container">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <router-link to="/">Home</router-link>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <router-link to="/blog"
                                            >Blog</router-link
                                        >
                                    </li>
                                    <li
                                        style="color: #189483"
                                        class="breadcrumb-item"
                                    >
                                        <strong>Edit</strong>
                                    </li>
                                </ol>
                            </div>
                        </nav>
                    </div>
                </div>

                <div class="row align-items-center justify-content-center">
                    <div style="padding: 10px" class="col-lg-12 col-sm-12">
                        <form @submit.prevent="submit">
                            <!-- Title -->
                            <label for="title"><span>Title</span></label>
                            <input
                                class="form-control"
                                type="text"
                                id="title"
                                v-model="fields.title"
                            />
                            <span v-if="errors.title" class="error">{{
                                errors.title[0]
                            }}</span>
                            <br />

                            <!-- Image -->
                            <label for="image"><span>Image 1</span></label>
                            <input
                                class="form-control"
                                type="file"
                                id="image"
                                @input="grabFile1"
                            />
                            <span v-if="errors.file" class="error">{{
                                errors.file[0]
                            }}</span>
                            <div class="preview row">
                                <div class="col-6 col-md-6"></div>
                                <img :src="url1" alt="" />
                            </div>
                            <br />

                            <label v-if="input2 === 2" for="image"
                                ><span>Image 2</span></label
                            >
                            <input
                                v-if="input2 === 2"
                                class="form-control"
                                type="file"
                                id="image"
                                @input="grabFile2"
                            />
                            <span v-if="errors.file" class="error">{{
                                errors.file[0]
                            }}</span>
                            <div v-if="input2 === 2" class="preview row">
                                <div class="col-6 col-md-6"></div>
                                <img :src="url2" alt="" />
                            </div>
                            <hr />

                            <label v-if="input3 === 3" for="image"
                                ><span>Image 3</span></label
                            >
                            <input
                                v-if="input3 === 3"
                                class="form-control"
                                type="file"
                                id="image"
                                @input="grabFile3"
                            />
                            <span v-if="errors.file" class="error">{{
                                errors.file[0]
                            }}</span>
                            <div v-if="input3 === 3" class="preview row">
                                <div class="col-6 col-md-6"></div>
                                <img :src="url3" alt="" />
                            </div>
                            <hr />

                            <label v-if="input4 === 4" for="image"
                                ><span>Image 4</span></label
                            >
                            <input
                                v-if="input4 === 4"
                                class="form-control"
                                type="file"
                                id="image"
                                @input="grabFile4"
                            />
                            <span v-if="errors.file" class="error">{{
                                errors.file[0]
                            }}</span>
                            <div v-if="input4 === 4" class="preview row">
                                <div class="col-6 col-md-6"></div>
                                <img :src="url4" alt="" />
                            </div>
                            <hr />

                            <label v-if="input5 === 5" for="image"
                                ><span>Image 5</span></label
                            >
                            <input
                                v-if="input5 === 5"
                                class="form-control"
                                type="file"
                                id="image"
                                @input="grabFile5"
                            />
                            <span v-if="errors.file" class="error">{{
                                errors.file[0]
                            }}</span>
                            <div v-if="input5 === 5" class="preview row">
                                <div class="col-6 col-md-6"></div>
                                <img :src="url5" alt="" />
                            </div>
                            <hr />

                            <h4 v-if="input6 === 6" style="color: #189483">
                                Sorry ! you've maxed out on image upload.
                            </h4>

                            <button
                                class="btn bg-gradient-primary btn-sm"
                                v-if="disappear2"
                                type="button"
                                @click="showInput2"
                            >
                                Add Image
                            </button>
                            <button
                                class="btn bg-gradient-primary btn-sm"
                                v-if="disappear3"
                                type="button"
                                @click="showInput3"
                            >
                                Add Image
                            </button>
                            <button
                                class="btn bg-gradient-primary btn-sm"
                                v-if="disappear4"
                                type="button"
                                @click="showInput4"
                            >
                                Add Image
                            </button>
                            <button
                                class="btn bg-gradient-primary btn-sm"
                                v-if="disappear5"
                                type="button"
                                @click="showInput5"
                            >
                                Add Image
                            </button>
                            <br />

                            <!-- Drop down -->
                            <label for="categories"
                                ><span>Choose a category:</span></label
                            >
                            <select
                                class="form-control"
                                v-model="fields.post_category"
                                id="categories"
                            >
                                <option disabled value="">Select option</option>
                                <option
                                    :value="category.name"
                                    v-for="category in categories"
                                    :key="category.id"
                                >
                                    {{ category.name }}
                                </option>
                            </select>
                            <span v-if="errors.post_category" class="error">{{
                                errors.post_category[0]
                            }}</span>
                            <br />

                            <!-- Body-->
                            <label for="body"><span>Body</span></label>
                            <textarea
                                class="form-control"
                                id="body"
                                v-model="fields.body"
                                rows="6"
                            ></textarea>
                            <span v-if="errors.body" class="error">{{
                                errors.body[0]
                            }}</span>
                            <br />
                            <!-- Button -->
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
            <hr class="horizontal dark my-5" />
        </section>
        <Footer />
    </body>
</template>

<script>
import Footer from "./Footer.vue";
import Loader from "./Loader.vue";

export default {
    components: {
        Footer,
        Loader,
    },
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

            posts: [],
            title: "",
            links: [],

            id: "",
            name: "",
            isSubmitting: false,
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
            this.isSubmitting = true;
            let timerInterval;
            Swal.fire({
                title: "Processing",
                html: "",
                timer: 1000,
                timerProgressBar: true,

                didOpen: () => {
                    Swal.showLoading();
                    const b = Swal.getHtmlContainer().querySelector("b");
                    timerInterval = setInterval(() => {
                        if (b) {
                            b.textContent = Swal.getTimerLeft();
                        }
                    }, 100);

                    const fd = new FormData();
                    fd.append("title", this.fields.title);
                    fd.append("post_category", this.fields.post_category);
                    if (this.fields.file1) {
                        fd.append("file1", this.fields.file1);
                    }
                    if (this.fields.file2) {
                        fd.append("file2", this.fields.file2);
                    }
                    if (this.fields.file3) {
                        fd.append("file3", this.fields.file3);
                    }
                    if (this.fields.file4) {
                        fd.append("file4", this.fields.file4);
                    }
                    if (this.fields.file5) {
                        fd.append("file5", this.fields.file5);
                    }
                    fd.append("body", this.fields.body);

                    fd.append("_method", "PUT");

                    axios
                        .post(`/api/posts/${this.slug}`, fd, {
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
                                this.$router.push({
                                    name: "DashboardPostsList",
                                });
                            }
                        });
                },
                willClose: () => {
                    clearInterval(timerInterval);
                },
            })
                .then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        this.isSubmitting = true;
                        console.log("All is well");
                        this.$router.push({ name: "Blog" });
                        this.isSubmitting = true;
                    }
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    this.isSubmitting = false;
                });
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
            .get("/api/posts/" + this.slug)
            .then((response) => {
                this.fields = response.data.data;
                this.url1 = "./img/blog/" + response.data.data.image_1;
                this.url2 = "./img/blog/" + response.data.data.image_2;
                this.url3 = "./img/blog/" + response.data.data.image_3;
                this.url4 = "./img/blog/" + response.data.data.image_4;
                this.url5 = "./img/blog/" + response.data.data.image_5;
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
