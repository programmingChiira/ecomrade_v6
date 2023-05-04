<template>
    <body class="about-us">
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
                            <button data-toggle="tooltip" data-placement="bottom" title="Rentals" data-bs-toggle="modal"
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

                <br />

                <div class="row">
                    <div class="col-md-4 col-10">
                        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                            <div class="container">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                                    <li class="breadcrumb-item"><router-link to="/dashboard">Dash</router-link></li>
                                    <li style="color: #189483;" class="breadcrumb-item"><strong>Rentals</strong></li>
                                </ol>
                            </div>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="">
                            <div class="table-responsive">
                                <table class="table project-list-table table-nowrap align-middle table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="ps-4" style="width: 50px;">
                                                <div class="form-check font-size-16"><input type="checkbox"
                                                        class="form-check-input" id="contacusercheck" /><label
                                                        class="form-check-label" for="contacusercheck"></label></div>
                                            </th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">No. Rooms</th>
                                            <th scope="col">Area</th>
                                            <th scope="col">Vacancy</th>
                                            <th scope="col">Cost</th>
                                            <th scope="col">Per</th>
                                            <th v-if="id == 1" scope="col">Edit</th>
                                            <th v-if="id == 1" scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="rental in rentals" :key="rental.id">
                                            <th scope="row" class="ps-4">
                                                <div class="form-check font-size-16"><input type="checkbox"
                                                        class="form-check-input" id="contacusercheck1" /><label
                                                        class="form-check-label" for="contacusercheck1"></label></div>
                                            </th>
                                            <td>
                                                <span class="badge badge-soft-success mb-0">
                                                    {{ rental.rental_name }}
                                                </span>
                                            </td>
                                            <td>
                                                {{ rental.rental_category }}
                                            </td>
                                            <td>
                                                {{ rental.no_of_rooms }}
                                            </td>
                                            <td>
                                                {{ rental.rental_area }}
                                            </td>
                                            <td>
                                                {{ rental.vacancy_status }}
                                            </td>
                                            <td>
                                                <strong> Ksh. {{ rental.rental_price }}</strong>
                                            </td>
                                            <td>
                                                {{ rental.pay_per }}
                                            </td>
                                            <td v-if="id == 1">
                                                <router-link :to="{
                                                    name: 'EditRental',
                                                    params: { slug: rental.slug },
                                                }"><i class="fa fa-edit" style="color: #189483;"></i>
                                                </router-link>
                                            </td>
                                            <td v-if="id == 1">
                                                <button type="button"
                                                    @click="destroy(rental.id)" class="delete-btn"
                                                    style="border:none;outline:none;background: none;">
                                                    <i class="fa fa-trash-o" style="color: red;"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                        </tr>
                                    </tbody>
                                </table>
                                <h5 v-if="!rentals.length">Sorry, no item found!</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

<style scoped>
.project-list-table {
    border-collapse: separate;
    border-spacing: 0 12px
}

.project-list-table tr {
    background-color: #fff
}

.table-nowrap td,
.table-nowrap th {
    white-space: nowrap;
}

.table-borderless>:not(caption)>*>* {
    border-bottom-width: 0;
}

.table>:not(caption)>*>* {
    padding: 0.75rem 0.75rem;
    background-color: var(--bs-table-bg);
    border-bottom-width: 1px;
    box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
}

.avatar-sm {
    height: 2rem;
    width: 2rem;
}

.rounded-circle {
    border-radius: 50% !important;
}

.me-2 {
    margin-right: 0.5rem !important;
}

img,
svg {
    vertical-align: middle;
}

a {
    color: #3b76e1;
    text-decoration: none;
}

.badge-soft-danger {
    color: #f56e6e !important;
    background-color: rgba(245, 110, 110, .1);
}

.badge-soft-success {
    color: #63ad6f !important;
    background-color: rgba(99, 173, 111, .1);
}

.badge-soft-primary {
    color: #3b76e1 !important;
    background-color: rgba(59, 118, 225, .1);
}

.badge-soft-info {
    color: #57c9eb !important;
    background-color: rgba(87, 201, 235, .1);
}

.avatar-title {
    align-items: center;
    background-color: #3b76e1;
    color: #fff;
    display: flex;
    font-weight: 500;
    height: 100%;
    justify-content: center;
    width: 100%;
}

.bg-soft-primary {
    background-color: rgba(59, 118, 225, .25) !important;
}
</style>