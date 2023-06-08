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
                                    <li class="breadcrumb-item"><router-link to="/resource">Access</router-link></li>
                                    <li style="color: #189483;" class="breadcrumb-item"><strong>Tokem</strong></li>
                                </ol>
                            </div>
                        </nav>
                    </div>
                </div>

                <div class="row align-items-center  justify-content-center">

                    <div style="padding: 10px;" class="col-lg-12 col-sm-12">
                        <form @submit.prevent="submit">

                            <button style="margin: 5px;" class="btn bg-gradient-primary btn-sm" type="submit">
                                Access Token
                            </button>

                            <br/><br/>
                            <strong style="color: black;" v-if="accessToken">Access Token: <span style="color:#189483;">{{ accessToken }}</span></strong>
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
            accessToken: null,
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
        submit() {
            this.isSubmitting = true;
            axios
                .post("/api/getToken")
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
                            this.isSubmitting = true;
                            console.log('All is well');

                            axios.get('/api/get-token')
                                .then(response => {
                                    this.accessToken = response.data.access_token;
                                });
                        }
                    })

                    setInterval(() => {
                        this.success = false;
                    }, 2500);
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    this.isSubmitting = false;
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

        axios.get('/api/get-token')
            .then(response => {
                this.accessToken = response.data.access_token;
            });
    },
};
</script>