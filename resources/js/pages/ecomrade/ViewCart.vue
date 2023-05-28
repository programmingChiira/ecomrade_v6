<template>
    <body class="about-us">
        <Loader/>
        <section class="py-7">
            <div class="container mt-5 mb-5">
                <div class="d-flex justify-content-center row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4 col-10">
                                <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                                    <div class="container">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                                            <li style="color: #189483;" class="breadcrumb-item"><strong>Compare</strong>
                                            </li>
                                        </ol>
                                    </div>
                                </nav>
                            </div>
                            <div style="float:right;" class="col-md-8 col-2">
                                <router-link to="/createmarket" style="float: right;" class="text-info icon-move-right">
                                    <button data-toggle="tooltip" data-placement="bottom"
                                        title="Sell my products / services" type="button"
                                        class="btn bg-gradient-primary btn-sm">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </router-link>
                            </div>
                        </div>

                        <div v-for="cart in carts" :key="cart.id">
                            <div class="d-flex flex-row justify-content-between align-items-center p-2 bg-white mt-4 px-3 rounded"
                                v-if="cart.senderId == id">
                                <div class="mr-1">
                                    <!-- <img class="rounded" src="assets/img/logo.png" width="70"> -->

                                    <img v-if="cart.marketImg == false || cart.marketImg == null || cart.marketImg == 'null' || cart.marketImg == '' || cart.marketImg == ' ' || cart.marketImg == NULL"
                                        loading="lazy" src="/web/img/no_img.jpg" class="rounded" width="100">

                                    <img v-else :src="'./img/market/' + cart.marketImg" class="rounded" width="100">
                                    <br/>
                                    <span style="text-align: center;" class="font-weight-bold"> {{ cart.marketName }}</span>

                                </div>
                                <!-- <div class="d-flex flex-column align-items-center product-details">
                                    
                                </div> -->
                                <div class="price d-flex flex-row align-items-center"
                                    v-if="cart.marketDiscount == 0 || cart.marketDiscount == false || cart.marketDiscount == null || cart.marketDiscount == 'null' || cart.marketDiscount == '' || cart.marketDiscount == 'NULL'">
                                    <h4>Ksh. {{ cart.marketPrice }} </h4>
                                </div>

                                <div class="price d-flex flex-row align-items-center" v-else>
                                    <h6 style="margin: 5px;"> Ksh. {{
                                        cart.marketPrice - cart.marketDiscount
                                    }} </h6>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button type="button" @click="destroy(cart.id)" class="delete-btn"
                                        style="border:none;outline:none;background: none;">
                                        <i class="fa fa-trash-o" style="color: red;"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <h5 v-if="!carts.length">Sorry, no item found!</h5>
                    </div>
                </div>
            </div>
        </section>

        <Footer />
    </body>
</template>


<script>
import Footer from './Footer.vue'
import Loader from './Loader.vue'

export default {

    components: {
        Footer,
        Loader,
    },
    emits: ["updateSidebar"],
    data() {
        return {
            success: false,
            fields: {
                category_id: "",
            },
            errors: {},
            url: "",
            categories: [],

            carts: [],
            title: "",
            user_id: "",
            links: [],

            id: "",
            name: "",
        };
    },

    methods: {
        filterByCategory(name) {
            axios
                .get("/api/carts", {
                    params: {
                        category: name,
                    },
                })
                .then((response) => {
                    this.carts = response.data.data;
                    this.links = response.data.meta.links;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        truncateText(carts) {
            const truncatedText = carts.slice(0, 10) + '...'
            return truncatedText
        },

        changePage(link) {
            if (!link.url || link.active) {
                retun;
            }
            axios
                .get(link.url)
                .then((response) => {
                    this.carts = response.data.data;
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
                        .delete("/api/carts/" + id)
                        .then((response) => {
                            Swal.fire(
                                'Deleted!',
                                'Information has been successfully deleted.',
                                'success'
                            );
                            // Fire.$emit('AfterCreate');
                            axios.get("/api/carts").then(({
                                data
                            }) => (this.carts = data.data))
                        }).catch((error) => {
                            Swal.fire("Failed!", error.message, "warning");
                        });
                }
            })
        },

    },

    watch: {
        title() {
            axios
                .get("/api/carts", {
                    params: {
                        search: this.title,
                    },
                })
                .then((response) => {
                    this.carts = response.data.data;
                    this.links = response.data.meta.links;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },

    mounted() {
        axios
            .get("/api/carts")
            .then((response) => {
                this.carts = response.data.data;
                console.log(response.data.meta.links);
                this.links = response.data.meta.links;
            })
            .catch((error) => {
                console.log(error);
            });

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
    },
};
</script>
