<template>
    <body class="index-page">
        <Loader />
        <section class="my-5 py-5">

            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-10">
                        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                            <div class="container">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                                    <li class="breadcrumb-item"><router-link to="/resource">Register</router-link></li>
                                    <li style="color: #189483;" class="breadcrumb-item"><strong>Urls</strong></li>
                                </ol>
                            </div>
                        </nav>
                    </div>
                </div>

                <div class="row align-items-center  justify-content-center">

                    <div style="padding: 10px;" class="col-lg-12 col-sm-12">
                        <form>

                            <button @click="registerURLS" style="margin: 5px;" class="btn bg-gradient-primary btn-sm"
                                type="button">
                                Register Url
                            </button>

                            <br /><br />
                            <strong style="color: black;" v-if="response">Url: <span style="color:#189483;">{{
                                response }}</span></strong>
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
import Loader from './Loader.vue'

export default {

    components: {
        Footer,
        Loader,
    },
    data() {
        return {
            response: null,
            field: {
                amount: '',
                account: '',
                slug: '',
            },
            errors: {},
            success: false,
            isSubmitting: false,
        };
    },
    methods: {

        registerURLS() {
            axios
                .post('/api/register-urls')
                .then((response) => {
                    // Log the response to the console
                    console.log(response.data.response);

                    // Update the component's data with the response
                    this.response = response.data.response;
                })
                .catch((error) => {
                    console.error(error);
                    alert('Failed to register URLs');
                });
        },
    },

    computed: {
        amountValue: {
            get() {
                return this.field.amount;
            },
            set(value) {
                this.field.amount = value;
            }
        },

        accountValue: {
            get() {
                return this.field.account;
            },
            set(value) {
                this.field.account = value;
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
                return this.field.slug = result + '-' + this.field.year;
            },
            set(value) {
                this.field.slug = value;
            }
        },
    },

    mounted() {
        setTimeout(() => {
            this.loading = false;
        }, 2000);
    },
};
</script>