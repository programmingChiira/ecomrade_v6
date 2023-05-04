<template>
    <body class="index-page">
        <section class="my-5 py-5">
            <div class="container">

                <div class="row">
                    <div class="col-md-4 col-10">
                        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                            <div class="container">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><router-link to="/market">Market</router-link></li>
                                    <li style="color: #189483;" class="breadcrumb-item"><strong>{{ club.name }}
                                            Products</strong></li>
                                </ol>
                            </div>
                        </nav>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-4 col-sm-6 col-12" v-for="market in markets" :key="market.id" v-show="club.id == market.club_id">
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
                                        <button v-if="market.user_id == id" type="button" @click="destroy(market.id)"
                                            class="delete-btn"
                                            style="float: left;border:none;outline:none;background: none;">
                                            <i class="fa fa-trash-o" style="color: red;"></i>
                                        </button>

                                        <router-link style="float: right;" v-if="market.user_id == id" :to="{
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

            club: {},
            success: false,
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
            //.then((response) => (this.id = response.data.id))
            .then(response => {
                this.id = response.data.id
                this.name = response.data.name
                this.slug = response.data.slug
            })
            .catch((error) => {
                if (error.response.status === 401) {
                    this.$emit("updateSidebar");
                    localStorage.removeItem("authenticated");
                }
            });

        axios
            .get("/api/clubs/" + this.slug)
            .then(response => {
                this.club = response.data.data;
                this.messageCount = response.data.message_count;
            })
            .catch((error) => {
                console.log(error);
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
.container2 {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin-block: 2rem;
    gap: 2rem;
}

img {
    max-width: 100%;
    display: block;
    object-fit: cover;
}

.card {
    display: flex;
    flex-direction: column;
    width: clamp(20rem, calc(20rem + 2vw), 22rem);
    overflow: hidden;
    box-shadow: 0 .1rem 1rem rgba(0, 0, 0, 0.1);
    border-radius: 1em;
}



.card__body {
    padding: 1rem;
    display: flex;
    flex-direction: column;
    gap: .5rem;
}


.tag {
    align-self: flex-start;
    padding: .25em .75em;
    border-radius: 1em;
    font-size: .75rem;
}

.tag+.tag {
    margin-left: .5em;
}

.tag-blue {
    background: #56CCF2;
    background: linear-gradient(to bottom, #2F80ED, #56CCF2);
    color: #fafafa;
}

.card__body h4 {
    font-size: 1.5rem;
    text-transform: capitalize;
}

.card__footer {
    display: flex;
    padding: 1rem;
    margin-top: auto;
}
</style>