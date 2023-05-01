<template>
    <body class="index-page">
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


                <div class="row">
                    <div class="col-md-4 col-9">
                        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                            <div class="container">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                                    <li style="color: #189483;" class="breadcrumb-item"><strong>Market</strong></li>
                                </ol>
                                <div v-if="lastPage > 1" class="pagination">
                                    <button class="btn bg-gradient-primary btn-sm" style="margin: 4px;"
                                        v-if="currentPage > 1" @click="productName(currentPage - 1)">&laquo; Prev</button>

                                    <button class="btn bg-gradient-primary btn-sm" style="margin: 4px;"
                                        v-if="currentPage < lastPage" @click="productName(currentPage + 1)">
                                        Next &raquo;</button>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div style="float:right;" class="col-md-8 col-3">
                        <router-link to="/createmarket" style="float: right;" class="text-info icon-move-right">
                            <button data-toggle="tooltip" data-placement="bottom" title="Sell my products / services"
                                type="button" class="btn bg-gradient-primary btn-sm">
                                Add
                            </button>
                        </router-link>
                    </div>
                </div>

                <div>
                    <ul>
                        <li v-for="product in viewedMarkets" :key="product.id">
                            {{ product.product_name }}
                        </li>
                    </ul>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-4 col-sm-6 col-12" v-for="market in markets" :key="market.id">
                        <div class="card card-plain card-blog">
                            <div style="background-color: #E9ECEF;" class="card">

                                <router-link :to="{
                                    name: 'ViewMarket',
                                    params: { slug: market.slug },
                                }">
                                    <img v-if="market.image_1 == false || market.image_1 == null || market.image_1 == 'null' || market.image_1 == '' || market.image_1 == ' ' || market.image_1 == NULL"
                                        loading="lazy"
                                        style="background-color: white;width: 100%;height: 200px; object-fit: cover;"
                                        src="/web/img/no_img.jpg" class="card-img-top" width="100%">

                                    <img v-else
                                        style="background-color: white;width: 100%;height: 200px; object-fit: cover;"
                                        :src="'./img/market/' + market.image_1" class="card-img-top" width="100%">

                                </router-link>

                                <div class="card-body pt-0 px-0">
                                    <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                        <h4>{{ market.product_name }}</h4>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                        <small class="text-muted mt-1">Cost</small>
                                        <h6>
                                            <span
                                                v-if="market.product_discount == 0 || market.product_discount == false || market.product_discount == null || market.product_discount == 'null' || market.product_discount == '' || market.product_discount == ' '">Ksh.
                                                {{ market.product_price }}</span>
                                            <span v-else><span style="text-decoration: line-through;color: #189483;">Ksh. {{
                                                market.product_price - market.product_discount
                                            }}</span> Ksh. {{ market.product_price }}</span>
                                        </h6>
                                    </div>

                                    <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                        <small class="text-muted mt-1">Status</small>
                                        <h6>
                                            <span style="color: red;"
                                                v-if="market.availability == 'Out of stock' || market.availability == false || market.availability == null || market.availability == 'null' || market.availability == '' || market.availability == ' '">
                                                Out Of Order</span>
                                            <span style="color: #189483;" v-else> Available</span>
                                        </h6>
                                    </div>

                                    <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                        <small class="text-muted mt-1">Location</small>
                                        <h6>
                                            <span style="color: red;"
                                                v-if="market.location == 'undefined' || market.location == false || market.location == null || market.location == 'null' || market.location == '' || market.location == ' '">
                                                Not Provided</span>
                                            <span style="color: #189483;" v-else> {{ market.location }}</span>
                                        </h6>
                                    </div>

                                    <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                        <span style="margin: 3px;" class="badge bg-dark ">
                                            <i class="fa fa-comments-o"></i> {{ market.rating_count }}
                                        </span>

                                        <span style="margin: 3px;" class="badge bg-dark">
                                            <div v-if="Math.round(market.avg_rating) === 0" class="stars">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div v-if="Math.round(market.avg_rating) === 1" class="stars">
                                                <i style="color: orange;" class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div v-if="Math.round(market.avg_rating) === 2" class="stars">
                                                <i style="color: orange;" class="fa fa-star"></i>
                                                <i style="color: orange;" class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div v-if="Math.round(market.avg_rating) === 3" class="stars">
                                                <i style="color: orange;" class="fa fa-star"></i>
                                                <i style="color: orange;" class="fa fa-star"></i>
                                                <i style="color: orange;" class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div v-if="Math.round(market.avg_rating) === 4" class="stars">
                                                <i style="color: orange;" class="fa fa-star"></i>
                                                <i style="color: orange;" class="fa fa-star"></i>
                                                <i style="color: orange;" class="fa fa-star"></i>
                                                <i style="color: orange;" class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div v-if="Math.round(market.avg_rating) === 5" class="stars">
                                                <i style="color: orange;" class="fa fa-star"></i>
                                                <i style="color: orange;" class="fa fa-star"></i>
                                                <i style="color: orange;" class="fa fa-star"></i>
                                                <i style="color: orange;" class="fa fa-star"></i>
                                                <i style="color: orange;" class="fa fa-star"></i>
                                            </div>
                                        </span>
                                    </div>


                                    <div class="mx-3 mt-3 mb-2">
                                        <form @submit.prevent="submit(market)">
                                            <input class="form-control" type="hidden" v-model="market.user_id" />
                                            <input class="form-control" type="hidden" v-model="market.id" />
                                            <input class="form-control" type="hidden" v-model="market.product_name" />
                                            <input class="form-control" type="hidden" v-model="market.product_category" />
                                            <input class="form-control" type="hidden" v-model="market.image_1" />
                                            <input class="form-control" type="hidden" v-model="market.slug" />
                                            <input class="form-control" type="hidden" v-model="market.contact" />
                                            <input class="form-control" type="hidden" v-model="market.product_price" />
                                            <input class="form-control" type="hidden" v-model="market.product_discount" />
                                            <button data-toggle="tooltip" data-placement="bottom" title="Add to compare"
                                                style="font-size: 13px;" type="submit"
                                                class="btn bg-gradient-primary btn-sm btn-block">
                                                Compare <sup> ( {{ market.cart_count }} )</sup>
                                            </button>
                                        </form>

                                    </div>
                                    <div class="mx-3 mt-3 mb-2">
                                        <button v-if="market.user_id == id || id == 1" type="button" @click="destroy(market.id)"
                                            class="delete-btn"
                                            style="float: left;border:none;outline:none;background: none;">
                                            <i class="fa fa-trash-o" style="color: red;"></i>
                                        </button>

                                        <router-link style="float: right;" v-if="market.user_id == id || id == 1" :to="{
                                            name: 'EditMarket',
                                            params: { slug: market.slug },
                                        }"><i class="fa fa-edit" style="color: #189483;"></i>
                                        </router-link>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <br />
                    </div>
                    <h5 v-if="!markets.length">Sorry, no item found!</h5>
                </div>
                <br /><br />
                <div v-if="lastPage > 1" class="pagination">
                    <button class="btn bg-gradient-primary btn-sm" style="margin: 4px;" v-if="currentPage > 1"
                        @click="productName(currentPage - 1)">&laquo; Prev</button>

                    <button class="btn bg-gradient-primary btn-sm" style="margin: 4px;" v-if="currentPage < lastPage"
                        @click="productName(currentPage + 1)">Next &raquo;</button>
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

<style>
.circle {
    background: #CB0C9F;
    width: 25px;
    height: 25px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    text-align: center;
}

.image {
    background: #fff;
    width: 200px;
    height: 200px;
    border-radius: 50%;
    display: flex;
    opacity: 1;
}

.preview img {
    max-width: 70%;
    height: 50vh;
    object-fit: contain;
}


.search-results {
    list-style: none;
    margin: 0;
    padding: 0;
}
</style>