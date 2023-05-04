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
                                    <li class="breadcrumb-item"><router-link to="/market">Market</router-link></li>
                                    <li style="color: #189483;" class="breadcrumb-item"><strong>Category</strong></li>
                                </ol>
                            </div>
                        </nav>
                    </div>
                </div>

                <div class="row align-items-center  justify-content-center">

                    <div style="padding: 10px;" class="col-lg-12 col-sm-12">
                        <form @submit.prevent="submit">
                            <label for="name"><span>Name</span></label>
                            <input class="form-control" type="text" id="name" v-model="nameValue" />
                            <span v-if="errors.name" class="error">{{ errors.name[0] }}</span>
                            <input type="hidden" class="form-control form-control-lg" placeholder="Enter your slug"
                                aria-label="Slug" aria-describedby="name-addon" id="slug" v-model="slugValue" />
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
            errors: {},
            success: false,
        };
    },
    methods: {
        submit() {
            axios
                .post("/api/marketcategories/create", this.field)
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
                            this.$router.push({ name: "AdmMarketCat" });
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

        slugValue: {
            get() {
                let result = '';
                let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                let charactersLength = characters.length;
                for (let i = 0; i < 70; i++) {
                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                }
                return this.field.slug = result + '-' + this.field.name;
            },
            set(value) {
                this.field.slug = value;
            }
        },
    },
};
</script>