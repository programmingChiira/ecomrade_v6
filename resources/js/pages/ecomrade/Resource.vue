<template>
    <body class="index-page">
        <Loader/>
        <section class="my-5 py-5">
            <div class="container">

                <div class="row justify-content-center my-2 py-1">
                    <div class="custom-search">
                        <input v-model="title" @input="searchresource" type="text" class="custom-search-input"
                            placeholder="Search resource" name="searchresource">
                        <br>
                        <br>
                        <div class="search-results-container" v-if="searchResults.length > 0"
                            style="background-color: rgb(250, 250, 250); border: none; border-radius: 5px;">
                            <br>
                            <ul style="padding: 20px;" class="search-results">
                                <li style="margin: 13px;" v-for="result in searchResults" :key="result.id">
                                    <input style="background-color: rgb(250, 250, 250);border:none;color:#189483;"
                                        type="button" @click="selectItem(result)" :value="result.title">
                                    <hr class="horizontal dark my-1">
                                </li>
                            </ul>
                        </div>
                        <span style="float:right;margin:6px;">

                            <button data-toggle="tooltip" data-placement="bottom" title="File" data-bs-toggle="modal"
                                data-bs-target="#exampleModal1" class="btn btn-sm">
                                <i style="font-size: 13px;" class="fa fa-file"></i>
                            </button>

                            <button data-toggle="tooltip" data-placement="bottom" title="Calendar" data-bs-toggle="modal"
                                data-bs-target="#exampleModal2" class="btn btn-sm">
                                <i style="font-size: 13px;" class="fa fa-calendar"></i>
                            </button>

                            <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModal1Label"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModal1Label">
                                                Courses
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div style="padding: 15px;" class="container row">
                                            <ul>
                                                <li style="display: inline;" v-for="course in courses" :key="course.id">
                                                    <input data-bs-dismiss="modal" class="btn btn-sm" type="button"
                                                        name="search" :value="course.name" @click="title = course.name">
                                                </li>
                                                <h5 v-if="!courses.length">Sorry, no item found!</h5>
                                            </ul>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn bg-gradient-dark btn-sm"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal2Label"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModal2Label">
                                                Year
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div style="padding: 15px;" class="container row">
                                            <ul>
                                                <li style="display: inline;" v-for="year in years" :key="year.id">
                                                    <input data-bs-dismiss="modal" class="btn btn-sm" type="button"
                                                        name="search" :value="'Year ' + year.year"
                                                        @click="title = 'Year ' + year.year">
                                                </li>
                                                <h5 v-if="!years.length">Sorry, no item found!</h5>
                                            </ul>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn bg-gradient-dark btn-sm"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </span>

                    </div>
                </div>

                <div class="row">
                    <div class="row">
                        <div class="col-md-4 col-10">
                            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                                <div class="container">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                                        <li style="color: #189483;" class="breadcrumb-item"><strong>Resources</strong></li>
                                    </ol>
                                </div>
                            </nav>
                        </div>
                        <div style="float:right;" class="col-md-8 col-2">
                            <router-link v-if="id == false" to="/login" style="float: right;"
                                class="text-info icon-move-right">
                                <button data-toggle="tooltip" data-placement="bottom" title="New resource" type="button"
                                    class="btn bg-gradient-primary btn-sm">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </router-link>

                            <router-link v-else to="/createresource" style="float: right;"
                                class="text-info icon-move-right">
                                <button data-toggle="tooltip" data-placement="bottom" title="New resource" type="button"
                                    class="btn bg-gradient-primary btn-sm">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </router-link>
                        </div>
                    </div>
                </div>

                    <div class="row align-items-center justify-content-center">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-12" v-for="resource in resources"
                            :key="resource.id">
                            <div style="background-color: #E9ECEF;" class="card shadow">
                                <!-- <img src="img/no_img.png" class="card-img-top" alt="..."> -->

                                <img v-if="isImage(resource.resource_1)" loading="lazy"
                                    style="background-color: white;width: 100%;height: 200px; object-fit: cover;"
                                    src="/img/image.webp" class="card-img-top" width="100%">

                                <img v-else style="background-color: white;width: 100%;height: 200px; object-fit: contain;"
                                    src="/img/pdf.png" class="card-img-top" width="100%">

                                <div class="card-body">
                                    <h5 class="card-title"> {{ truncateText(resource.title) }} </h5>
                                </div>
                                <div class="card-body card-p">
                                    <div class="d-flex flex-row justify-content-between">
                                        <div class="d-flex flex-column">
                                            <div class="col col-xs-6">
                                                <i class="far fa-comments"></i> {{ resource.rating_count }}
                                            </div>
                                        </div>

                                        <div class="d-flex flex-column">
                                            <div class="col col-xs-6">
                                                <span style="margin: 3px;" class="badge bg-dark">
                                                    <div v-if="Math.round(resource.avg_rating) === 0" class="stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <div v-if="Math.round(resource.avg_rating) === 1" class="stars">
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <div v-if="Math.round(resource.avg_rating) === 2" class="stars">
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <div v-if="Math.round(resource.avg_rating) === 3" class="stars">
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <div v-if="Math.round(resource.avg_rating) === 4" class="stars">
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <div v-if="Math.round(resource.avg_rating) === 5" class="stars">
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                    </div>
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                    <br />
                                    <div class="d-flex flex-row justify-content-between">
                                        <router-link class="btn bg-gradient-primary btn-block btn-sm" :to="{
                                            name: 'ViewResource',
                                            params: { slug: resource.slug },
                                        }">
                                            <small>
                                                View
                                            </small>
                                        </router-link>
                                    </div>

                                    <div class="d-flex flex-row justify-content-between">
                                        <div class="d-flex flex-column">
                                            <div class="col col-xs-6">
                                                <button v-if="resource.user_id == id || id == 1" type="button"
                                                    @click="destroy(resource.id)" class="delete-btn"
                                                    style="float: left;border:none;outline:none;background: none;">
                                                    <i class="fa fa-trash-o" style="color: red;"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-column">
                                            <div class="col col-xs-6">
                                                <router-link style="float: right;" v-if="resource.user_id == id || id == 1"
                                                    :to="{
                                                        name: 'EditResource',
                                                        params: { slug: resource.slug },
                                                    }"><i class="fa fa-edit" style="color: #189483;"></i>
                                                </router-link>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <br />
                        </div>
                        <h5 v-if="!resources.length">Sorry, no item found!</h5>
                    </div>
                    <br /><br />
                    <div v-if="lastPage > 1" class="pagination">
                        <button class="btn bg-gradient-primary btn-sm" style="margin: 4px;" v-if="currentPage > 1"
                            @click="resourceTitle(currentPage - 1)">&laquo; Prev</button>

                        <button class="btn bg-gradient-primary btn-sm" style="margin: 4px;" v-if="currentPage < lastPage"
                            @click="resourceTitle(currentPage + 1)">
                            Next &raquo;</button>
                    </div>
            </div>
            <hr class="horizontal dark my-5">
        </section>
        <!-- END Section Content -->

        <Footer />
    </body>
</template>

<script>
import Footer from './Footer.vue'
import Loader from './Loader.vue'

import axios from 'axios';

import Cookies from 'js-cookie';

export default {

    components: {
        Footer,
        Loader,
    },
    emits: ["updateSidebar"],
    data() {
        return {
            resources: [],
            currentPage: 1,
            lastPage: 1,

            title: '',
            searchResults: [],
            //resource: {},

            success: false,
            fields: {
                category_id: "",
            },
            errors: {},
            url: "",
            user_id: "",
            links: [],
            courses: [],
            years: [],

            resource_category: "",
            id: "",
            name: "",
        };
    },

    created() {
        this.resourceTitle(this.currentPage);
    },

    computed: {
        resourceName: {
            get() {
                return this.fields.title = this.resource.title;
            },
            set(value) {
                this.fields.title = value;
            }
        },
    },

    methods: {


        truncateText(posts) {
            const truncatedText = posts.slice(0, 10) + '...'
            return truncatedText
        },

        isImage(filename) {
            const extension = filename.split('.').pop().toLowerCase();
            return ['jpg', 'jpeg', 'png', 'gif'].includes(extension);
        },
        searchresource() {
            if (this.title.length > 2) {

                axios.get('/api/searchresource', { params: { q: this.title } })
                    .then(response => {
                        this.searchResults = response.data;
                    });
            } else {
                this.searchResults = [];
            }
        },

        selectItem(item) {
            this.title = item.title;
            this.searchResults = [];
        },
        submit() {
            axios
                .post("/api/resources", this.fields, {
                    headers: { "content-type": "multipart/form-data" },
                })
                .then(() => {
                    this.fields = {};
                    this.url = null;
                    this.fields.category_id = "";
                    this.success = true;
                    this.errors = {};

                    axios.get("/api/resources").then(({
                        data
                    }) => (this.resources = data.data));

                    setTimeout(() => {
                        this.success = false;
                    }, 2500);
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    this.success = false;
                });
        },


        destroy(id) {

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {

                // Send request to the server
                if (result.value) {
                    axios
                        .delete("/api/resources/" + id)
                        .then((response) => {
                            Swal.fire(
                                'Deleted!',
                                'Information has been successfully deleted.',
                                'success'
                            );
                            // Fire.$emit('AfterCreate');
                            axios.get('/api/resources').then(response => {
                                this.resources = response.data.data;
                            });
                        }).catch((error) => {
                            Swal.fire("Failed!", error.message, "warning");
                        });
                }
            })
        },

        resourceTitle(page) {
            axios
                .get('/api/resources?page=' + page, {
                    params: {
                        search: this.title,
                    },
                })
                .then((response) => {
                    this.resources = response.data.data;
                    this.currentPage = response.data.current_page;
                    this.lastPage = response.data.last_page;
                })
                .catch((error) => {
                    console.log(error);
                });

        },

    },

    watch: {
        title(page) {
            axios
                .get("/api/resources", {
                    params: {
                        page: page,
                        search: this.title,
                    },
                })
                .then((response) => {
                    this.resources = response.data.data;
                    this.currentPage = response.data.current_page;
                    this.lastPage = response.data.last_page;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },

    mounted() {
        axios
            .get("/api/user")
            .then(response => {
                this.id = response.data.id
                this.name = response.data.name
            })
            .catch((error) => {
                if (error.response.status === 401) {
                    this.$emit("updateSidebar");
                    localStorage.removeItem("authenticated");
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