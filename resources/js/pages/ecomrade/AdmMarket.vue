<template>
    <body class="about-us">
        <section class="my-5 py-5">

            <div class="container">

                <div class="row justify-content-center my-2 py-1">
                    <div class="custom-search">

                        <input v-model="product_name" @input="search" type="text" class="custom-search-input"
                            placeholder="Search market | Item | Category..." name="search">
                        <br>
                        <br>
                        <div class="search-results-container" v-if="searchResults.length > 0"
                            style="background-color: rgb(250, 250, 250); border: none; border-radius: 5px;">
                            <br>
                            <ul style="padding: 20px;" class="search-results">
                                <li style="margin: 13px;" v-for="result in searchResults" :key="result.id">
                                    <input style="background-color: rgb(250, 250, 250);border:none;color:#189483;"
                                        type="button" @click="selectItem(result)" :value="result.product_name">
                                    <hr class="horizontal dark my-1">
                                </li>
                            </ul>
                        </div>

                        <span style="float:right;margin:6px;">
                            <router-link class="btn btn-sm" to="/viewCart">
                                <i style="color: black;font-size: 13px;" class="fa fa-random" aria-hidden="true"></i>
                            </router-link>

                            <button data-toggle="tooltip" data-placement="bottom" title="Categories" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" class="btn btn-sm">
                                <i style="color: black;font-size: 13px;" class="fa fa-list"></i>
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
                                                Product Categories
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
                                                        @click="product_name = category.name">
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
                                                Product Location
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
                                                        @click="product_name = location.name">
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
                                    <li style="color: #189483;" class="breadcrumb-item"><strong>Market</strong></li>
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
                                            <th scope="col">Sub-category</th>
                                            <th scope="col">Location</th>
                                            <th scope="col">Availability</th>
                                            <th scope="col">Contact</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Discount</th>
                                            <th v-if="id == 1" scope="col">Edit</th>
                                            <th v-if="id == 1" scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="market in markets" :key="market.id">
                                            <th scope="row" class="ps-4">
                                                <div class="form-check font-size-16"><input type="checkbox"
                                                        class="form-check-input" id="contacusercheck1" /><label
                                                        class="form-check-label" for="contacusercheck1"></label></div>
                                            </th>
                                            <td><span class="badge badge-soft-success mb-0">{{ market.product_name }}</span>
                                            </td>
                                            <td>{{ market.product_category }}</td>
                                            <td>{{ market.product_sub_category }}</td>
                                            <td>{{ market.location }}</td>
                                            <td>{{ market.availability }}</td>
                                            <td>{{ market.contact }}</td>
                                            <td>{{ market.product_price }}</td>
                                            <td>{{ market.product_discount }}</td>
                                            <td v-if="id == 1">
                                                <router-link :to="{
                                                    name: 'EditMarket',
                                                    params: { slug: market.slug },
                                                }"><i class="fa fa-edit" style="color: #189483;"></i>
                                                </router-link>
                                            </td>
                                            <td v-if="id == 1">
                                                <button type="button"
                                                    @click="destroy(market.id)" class="delete-btn"
                                                    style="border:none;outline:none;background: none;">
                                                    <i class="fa fa-trash-o" style="color: red;"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                        </tr>
                                    </tbody>
                                </table>
                                <h5 v-if="!markets.length">Sorry, no item found!</h5>
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

export default {

    components: {
        Footer
    },
    emits: ["updateSidebar"],
    data() {
        return {
            markets: [],
            currentPage: 1,
            lastPage: 1,

            product_name: '',
            searchResults: [],
            //market: {},
            viewedMarkets: [],

            success: false,
            fields: {
                category_id: "",
            },
            errors: {},
            url: "",
            user_id: "",
            links: [],
            categories: [],

            product_category: "",
            id: "",
            name: "",
            locations: {},
        };
    },

    created() {
        this.productName(this.currentPage);

        axios.get('/api/viewed-markets')
            .then(response => {
                this.viewedMarkets = response.data.data;
            });
    },

    computed: {
        marketName: {
            get() {
                return this.fields.product_name = this.market.product_name;
            },
            set(value) {
                this.fields.product_name = value;
            }
        },
    },

    methods: {
        search() {
            if (this.product_name.length > 2) {

                axios.get('/api/search', { params: { q: this.product_name } })
                    .then(response => {
                        this.searchResults = response.data;
                    });
            } else {
                this.searchResults = [];
            }
        },

        selectItem(item) {
            this.product_name = item.product_name;
            this.searchResults = [];
        },
        submit(market) {
            axios
                .post("/api/carts", { "user_id": market.user_id, "id": market.id, "product_name": market.product_name, "product_category": market.product_category, "image_1": market.image_1, "slug": market.slug, "contact": market.contact, "product_price": market.product_price, "product_discount": market.product_discount }, {
                    headers: { "content-type": "multipart/form-data" },
                })
                .then(() => {
                    this.fields = {};
                    this.url = null;
                    this.fields.category_id = "";
                    this.success = true;
                    this.errors = {};

                    axios.get('/api/markets')
                        .then(response => {
                            this.markets = response.data.data;
                        })
                        .catch(error => {
                            console.log(error);
                        });

                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Added to <strong> Compare</strong>',
                        showConfirmButton: false,
                        timer: 1500
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
                        .delete("/api/markets/" + id)
                        .then((response) => {
                            Swal.fire(
                                'Deleted!',
                                'Information has been successfully deleted.',
                                'success'
                            );
                            // Fire.$emit('AfterCreate');
                            axios.get('/api/markets').then(response => {
                                this.markets = response.data.data;
                            });
                        }).catch((error) => {
                            Swal.fire("Failed!", error.message, "warning");
                        });
                }
            })
        },

        productName(page) {
            axios
                .get('/api/markets?page=' + page, {
                    params: {
                        search: this.product_name,
                    },
                })
                .then((response) => {
                    this.markets = response.data.data;
                    this.currentPage = response.data.current_page;
                    this.lastPage = response.data.last_page;
                })
                .catch((error) => {
                    console.log(error);
                });

        },

    },

    watch: {
        product_name(page) {
            axios
                .get("/api/markets", {
                    params: {
                        page: page,
                        search: this.product_name,
                    },
                })
                .then((response) => {
                    this.markets = response.data.data;
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
            .get("/api/homemarketcategories")
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