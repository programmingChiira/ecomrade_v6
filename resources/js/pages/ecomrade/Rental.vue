<template>
    <body class="index-page">
        <section class="my-5 py-5">

            <div class="container">
                <div class="row justify-content-center my-2 py-1">
                    <div class="custom-search">
                        <input v-model="rental_name" @input="searchrental" type="text" class="custom-search-input"
                            placeholder="Search rentals | Prices | Category..." name="searchrental">
                        <br>
                        <br>
                        <div class="search-results-container" v-if="searchResults.length > 0"
                            style="background-color: rgb(250, 250, 250); border: none; border-radius: 5px;">
                            <br>
                            <ul style="padding: 20px;" class="search-results">
                                <li style="margin: 13px;" v-for="result in searchResults" :key="result.id">
                                    <input style="background-color: rgb(250, 250, 250);border:none;color:#189483;"
                                        type="button" @click="selectItem(result)" :value="result.rental_name">
                                    <hr class="horizontal dark my-1">
                                </li>
                            </ul>
                        </div>

                        <span style="float:right;margin:6px;">
                            <button data-toggle="tooltip" data-placement="bottom" title="List" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" class="btn btn-sm">
                                <i style="font-size: 13px;" class="fa fa-list"></i>
                            </button>

                            <button data-toggle="tooltip" data-placement="bottom" title="Location" data-bs-toggle="modal"
                                data-bs-target="#exampleModal1" class="btn btn-sm">
                                <i style="color: black;font-size: 13px;" class="fa fa-map-marker"></i>
                            </button>

                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Rental Categories
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div style="padding: 15px;" class="container row">
                                            <ul>
                                                <li style="display: inline;" v-for="category in categories"
                                                    :key="category.id">
                                                    <input data-bs-dismiss="modal" class="btn btn-sm" type="button"
                                                        name="search" :value="category.name"
                                                        @click="rental_name = category.name">
                                                </li>
                                                <h5 v-if="!categories.length">Sorry, no item found!</h5>
                                            </ul>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn bg-gradient-dark btn-sm"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModal1Label"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModal1Label">
                                                Rental Location
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div style="padding: 15px;" class="container row">
                                            <ul>
                                                <li style="display: inline;" v-for="location in locations"
                                                    :key="location.id">
                                                    <input data-bs-dismiss="modal" class="btn btn-sm" type="button"
                                                        name="search" :value="location.name"
                                                        @click="rental_name = location.name">
                                                </li>
                                                <h5 v-if="!locations.length">Sorry, no item found!</h5>
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
                                        <li style="color: #189483;" class="breadcrumb-item"><strong>Rentals</strong></li>
                                    </ol>
                                </div>
                            </nav>
                        </div>
                        <div style="float:right;" class="col-md-8 col-2">
                            <router-link v-if="id == true && type == 'admin' || type == 'landlord' " to="/createrental" style="float: right;" class="text-info icon-move-right">
                                <button data-toggle="tooltip" data-placement="bottom" title="Create rental"
                                    type="button" class="btn bg-gradient-primary btn-sm">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </router-link>

                            <router-link v-else-if="id == false" to="/login" style="float: right;" class="text-info icon-move-right">
                                <button data-toggle="tooltip" data-placement="bottom" title="Create rental"
                                    type="button" class="btn bg-gradient-primary btn-sm">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </router-link>
                        </div>
                    </div>
                </div>


                <div class="d-flex justify-content-center row">
                    <div style="margin: 20px;background-color: #E9ECEF;" class="col-md-12" v-for="rental in rentals" :key="rental.id">
                        <div class="row p-2 bg-white border rounded">
                            <div class="col-md-3 mt-1">
                                <router-link :to="{
                                    name: 'ViewRental',
                                    params: { slug: rental.slug },
                                }">
                                    <img v-if="rental.image_1 == false || rental.image_1 == null || rental.image_1 == 'null' || rental.image_1 == '' || rental.image_1 == 'undefined' || rental.image_1 == NULL"
                                        loading="lazy" src="/web/img/no_img.jpg"
                                        class="img-fluid img-responsive rounded product-image">

                                    <img v-else :src="'./img/house/' + rental.image_1"
                                        class="img-fluid img-responsive rounded product-image">

                                </router-link>
                            </div>
                            <div class="col-md-6 mt-1">
                                <h5> {{ rental.rental_name }} </h5>
                                <div class="d-flex flex-row">
                                    <span style="margin: 3px;" class="badge bg-dark">
                                        <div v-if="Math.round(rental.avg_rating) === 0" class="stars">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div v-if="Math.round(rental.avg_rating) === 1" class="stars">
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div v-if="Math.round(rental.avg_rating) === 2" class="stars">
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div v-if="Math.round(rental.avg_rating) === 3" class="stars">
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div v-if="Math.round(rental.avg_rating) === 4" class="stars">
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div v-if="Math.round(rental.avg_rating) === 5" class="stars">
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: orange;" class="fa fa-star"></i>
                                        </div>
                                    </span>
                                    <span> ({{ rental.rating_count }}) </span>
                                </div>
                                <div class="mt-1 mb-1 spec-1">
                                    <span>{{ rental.rental_category }}</span>
                                </div>
                                <ul
                                    v-if="rental.rental_description_1 == 0 || rental.rental_description_1 == false || rental.rental_description_1 == null || rental.rental_description_1 == 'null' || rental.rental_description_1 == '' || rental.rental_description_1 == 'NULL' || rental.rental_description_1 == 'undefined'">
                                </ul>
                                <ul v-else>
                                    <li> {{ rental.rental_description_1 }}</li>
                                </ul>

                                <ul
                                    v-if="rental.rental_description_2 == 0 || rental.rental_description_2 == false || rental.rental_description_2 == null || rental.rental_description_2 == 'null' || rental.rental_description_2 == '' || rental.rental_description_2 == 'NULL' || rental.rental_description_2 == 'undefined'">
                                </ul>
                                <ul v-else>
                                    <li> {{ rental.rental_description_2 }}</li>
                                </ul>

                                <ul
                                    v-if="rental.rental_description_3 == 0 || rental.rental_description_3 == false || rental.rental_description_3 == null || rental.rental_description_3 == 'null' || rental.rental_description_3 == '' || rental.rental_description_3 == 'NULL' || rental.rental_description_3 == 'undefined'">
                                </ul>
                                <ul v-else>
                                    <li> {{ rental.rental_description_3 }}</li>
                                </ul>
                            </div>
                            <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                                <div class="d-flex flex-row align-items-center">
                                    <h4 class="mr-1">Ksh. {{ rental.rental_price }}</h4>
                                </div>
                                <h6 class="text-success"> {{ rental.pay_per }} </h6>
                                <h6>
                                    <span style="color: red;"
                                        v-if="rental.vacancy_status == 'Not available' || rental.vacancy_status == false || rental.vacancy_status == null || rental.vacancy_status == 'null' || rental.vacancy_status == '' || rental.vacancy_status == 'undefined'">
                                        Not available
                                    </span>
                                    <span style="color: #189483;" v-else> Available</span>
                                </h6>
                                <div class="d-flex flex-column mt-4">
                                    <router-link class="btn bg-gradient-primary btn-sm" :to="{
                                        name: 'ViewRental',
                                        params: { slug: rental.slug },
                                    }"> View More </router-link>
                                </div>
                                <div class="mx-3 mt-3 mb-2">
                                    <button v-if="rental.user_id == id || id == 1" type="button" @click="destroy(rental.id)"
                                        class="delete-btn" style="float: left;border:none;outline:none;background: none;">
                                        <i class="fa fa-trash-o" style="color: red;"></i>
                                    </button>

                                    <router-link style="float: right;" v-if="rental.user_id == id || id == 1" :to="{
                                        name: 'EditRental',
                                        params: { slug: rental.slug },
                                    }"><i class="fa fa-edit" style="color: #189483;"></i>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h5 v-if="!rentals.length">Sorry, no item found!</h5>
                </div>
            </div>
            <hr class="horizontal dark my-5">
        </section>

        <Footer />
    </body>
</template>

<script>
import Footer from './Footer.vue'

import axios from 'axios';

import Cookies from 'js-cookie';

export default {

    components: {
        Footer
    },
    emits: ["updateSidebar"],
    data() {
        return {
            rentals: [],
            currentPage: 1,
            lastPage: 1,

            rental_name: '',
            searchResults: [],
            //market: {},

            success: false,
            fields: {
                category_id: "",
            },
            errors: {},
            url: "",
            user_id: "",
            links: [],
            categories: [],

            rental_category: "",
            id: "",
            name: "",
            type: "",
            locations: {},
        };
    },

    created() {
        this.rentalName(this.currentPage);

    },

    computed: {
        marketName: {
            get() {
                return this.fields.title = this.market.title;
            },
            set(value) {
                this.fields.title = value;
            }
        },
    },

    methods: {

        truncateText(rentals) {
            const truncatedText = rentals.slice(0, 10) + '...'
            return truncatedText
        },
        searchrental() {
            if (this.rental_name.length > 2) {

                axios.get('/api/searchrental', { params: { q: this.rental_name } })
                    .then(response => {
                        this.searchResults = response.data;
                    });
            } else {
                this.searchResults = [];
            }
        },

        selectItem(item) {
            this.rental_name = item.rental_name;
            this.searchResults = [];
        },
        submit() {
            axios
                .rental("/api/rentals", this.fields, {
                    headers: { "content-type": "multipart/form-data" },
                })
                .then(() => {
                    this.fields = {};
                    this.url = null;
                    this.fields.category_id = "";
                    this.success = true;
                    this.errors = {};

                    axios.get("/api/rentals").then(({
                        data
                    }) => (this.rentals = data.data));

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
                        .delete("/api/rentals/" + id)
                        .then((response) => {
                            Swal.fire(
                                'Deleted!',
                                'Information has been successfully deleted.',
                                'success'
                            );
                            // Fire.$emit('AfterCreate');
                            axios.get('/api/rentals').then(response => {
                                this.rentals = response.data.data;
                            });
                        }).catch((error) => {
                            Swal.fire("Failed!", error.message, "warning");
                        });
                }
            })
        },

        rentalName(page) {
            axios
                .get('/api/rentals?page=' + page, {
                    params: {
                        search: this.rental_name,
                    },
                })
                .then((response) => {
                    this.rentals = response.data.data;
                    this.currentPage = response.data.current_page;
                    this.lastPage = response.data.last_page;
                })
                .catch((error) => {
                    console.log(error);
                });

        },

    },

    watch: {
        rental_name(page) {
            axios
                .get("/api/rentals", {
                    params: {
                        page: page,
                        search: this.rental_name,
                    },
                })
                .then((response) => {
                    this.rentals = response.data.data;
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
                this.type = response.data.type
            })
            .catch((error) => {
                if (error.response.status === 401) {
                    this.$emit("updateSidebar");
                    localStorage.removeItem("authenticated");
                }
            });

        axios
            .get("/api/homerentalcategories")
            .then((response) => (this.categories = response.data))
            .catch((error) => {
                console.log(error);
            });

        axios.get('/api/locations')
            .then(response => {
                this.locations = response.data.data;
            });
    },
};
</script>