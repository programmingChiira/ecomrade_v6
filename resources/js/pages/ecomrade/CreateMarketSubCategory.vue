<template>
    <body class="index-page">
        <section class="my-5 py-5">

            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-9">
                        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                            <div class="container">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                                    <li class="breadcrumb-item"><router-link to="/market">Market</router-link></li>
                                    <li style="color: #189483;" class="breadcrumb-item"><strong>Sub-Category</strong></li>
                                </ol>
                            </div>
                        </nav>
                    </div>
                </div>

                <div class="row align-items-center  justify-content-center">

                    <div style="padding: 10px;" class="col-lg-12 col-sm-12">
                        <form @submit.prevent="submit">

                            <label for="getmarketcategories"><span>Choose a category:</span></label>
                            <select class="form-control" v-model="catValue" id="getmarketcategories">
                                <option disabled value="">Select option</option>
                                <option :value="marketcategory.name" v-for="marketcategory in getmarketcategories"
                                    :key="marketcategory.id">
                                    {{ marketcategory.name }}
                                </option>
                            </select>
                            <span v-if="errors.category_id" class="error">{{
                                errors.category_id[0]
                            }}</span>


                            <label for="name"><span>Name</span></label>
                            <input class="form-control" type="text" id="name" v-model="nameValue" />
                            <span v-if="errors.name" class="error">{{ errors.name[0] }}</span>
                            <span v-if="errors.slug" class="error">{{ errors.slug[0] }}</span>
                            <br />

                            <button style="float: right;" type="submit" class="btn bg-gradient-primary">
                                Submit
                            </button>
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
    data() {
        return {
            field: {
                name: '',
                slug: '',
            },
            getmarketcategories: [],
            errors: {},
            success: false,
        };
    },
    methods: {
        submit() {
            axios
                .post("/api/marketsubcategories/create", this.field)
                .then(() => {
                    this.field = {};
                    this.errors = {};
                    this.success = true;

                    let timerInterval
                    Swal.fire({
                        title: 'Processing',
                        html: '',
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
                            this.$router.push({ name: "AdmMarketSubCat" });
                        }
                    })

                    setInterval(() => {
                        this.success = false;
                    }, 2500);
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },

        fetchCategories() {
            axios
                .get("/api/getmarketcategories")
                .then((response) => (this.getmarketcategories = response.data))
                .catch((error) => {
                    console.log(error);
                });
        },
    },

    computed: {
        nameValue: {
            get() {
                return this.field.name;
            },
            set(value) {
                this.field.name = value;
            }
        },

        catValue: {
            get() {
                return this.field.category_id;
            },
            set(value) {
                this.field.category_id = value;
            }
        },
    },

    mounted() {
        axios
            .get("/api/getmarketcategories")
            .then((response) => (this.getmarketcategories = response.data))
            .catch((error) => {
                console.log(error);
            });
    },
};
</script>