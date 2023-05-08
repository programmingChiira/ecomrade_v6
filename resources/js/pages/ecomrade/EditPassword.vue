<template>
    <body class="index-page">
        <div class="full-page-loader" v-if="loading">
            <img src="/triangle.svg" alt="Loader" />
        </div>
        <section class="my-5 py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-10">
                        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                            <div class="container">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                                    <li style="color: #189483;" class="breadcrumb-item"><strong>Update password</strong>
                                    </li>
                                </ol>
                            </div>
                        </nav>
                    </div>
                </div>

                <div class="row align-items-center  justify-content-center">

                    <div style="padding: 10px;" class="col-lg-12 col-sm-12">
                        <form @submit.prevent="submit">
                            <!-- Title -->

                            <div v-if="step === 1">


                                <label for="newPassword"><span>New password</span></label>
                                <span style="float: right" @click="toggleShowNew"><span class="icon is-small is-right">
                                        <i class="fas"
                                            :class="{ 'fa-eye-slash': showPasswordNew, 'fa-eye': !showPasswordNew }">
                                        </i>
                                    </span>
                                </span>
                                <input v-if="showPasswordNew" type="text" class="form-control form-control-lg"
                                    v-model="fields.newPassword" />
                                <input v-else type="password" class="form-control form-control-lg"
                                    v-model="fields.newPassword">
                                <span v-if="errors.newPassword" class="error">{{ errors.newPassword[0] }}</span>
                                <br />

                                <label for="password"><span>Current password</span></label>
                                <span style="float: right" @click="toggleShow"><span class="icon is-small is-right">
                                        <i class="fas" :class="{ 'fa-eye-slash': showPassword, 'fa-eye': !showPassword }">
                                        </i>
                                    </span>
                                </span>
                                <input v-if="showPassword" type="text" class="form-control form-control-lg"
                                    v-model="passwordValue" />
                                <input v-else type="password" class="form-control form-control-lg" v-model="passwordValue">
                                <span v-if="errors.password" class="error">{{ errors.password[0] }}</span>
                                <br />

                                <label for="confirmPassword"><span>Confirm current password</span></label>
                                <span style="float: right;" @click="toggleShowConfirm"><span class="icon is-small is-right">
                                        <i class="fas"
                                            :class="{ 'fa-eye-slash': showPasswordConfirm, 'fa-eye': !showPasswordConfirm }"></i>
                                    </span>
                                </span>
                                <input v-if="showPasswordConfirm" type="text" class="form-control form-control-lg"
                                    v-model="password_confirmationValue" />
                                <input v-else type="password" class="form-control form-control-lg"
                                    v-model="password_confirmationValue">
                                <span v-if="errors.password" class="error">{{ errors.password[0] }}</span>

                                <br />
                                <button style="margin: 5px;" class="btn bg-gradient-primary btn-sm" type="submit">Submit
                                </button>
                            </div>
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
    props: ["slug"],
    data() {
        return {
            step: 1,
            success: false,
            fields: {
                category_id: "",
            },
            errors: {},
            url: "",
            categories: [],

            users: [],
            title: "",
            links: [],

            id: "",
            name: "",
            showPassword: false,
            showPasswordNew: false,
            password: null,
            showPasswordConfirm: false,
            loading: true,
        };
    },

    methods: {

        nextStep() {
            this.step++;
        },
        prevStep() {
            this.step--;
        },

        submit() {
            let timerInterval
            Swal.fire({
                title: 'Processing',
                html: ' ',
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

                    const fd = new FormData();
                    fd.append("password", this.fields.newPassword);
                    fd.append("current_password", this.passwordValue);
                    fd.append("password_confirmation", this.password_confirmationValue);

                    fd.append("_method", "PUT");

                    axios
                        .post(`/api/userpasswords/${this.slug}`, fd, {
                            headers: {
                                "content-type": "multipart/form-data",
                            },
                        })
                        .then((res) => {
                            this.$emit("showEditSuccess");
                        })
                        .catch((error) => {
                            this.errors = error.response.data.errors;
                            if (error.response.status === 403) {
                                console.log('All is not well')
                            }
                        });
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('All is well')
                }
            })
        },

        toggleShowNew() {
            this.showPasswordNew = !this.showPasswordNew;
        },

        toggleShow() {
            this.showPassword = !this.showPassword;
        },

        toggleShowConfirm() {
            this.showPasswordConfirm = !this.showPasswordConfirm;
        },

    },

    computed: {

        isPasswordConfirmed() {
            return this.fields.newPassword === this.fields.confirmPassword
        },
        buttonLabel() {
            return (this.showPassword) ? "Hide" : "Show";
        },

        buttonLabelNew() {
            return (this.showPasswordNew) ? "Hide" : "Show";
        },

        buttonLabelConfirm() {
            return (this.showPasswordConfirm) ? "Hide" : "Show";
        },

        passwordValue: {
            get() {
                return this.fields.password;
            },
            set(value) {
                this.fields.password = value;
            }
        },

        password_confirmationValue: {
            get() {
                return this.fields.password_confirmation;
            },
            set(value) {
                this.fields.password_confirmation = value;
            }
        }
    },

    mounted() {
        setTimeout(() => {
            this.loading = false;
        }, 2000);

        axios
            .get("/api/user")
            .then((response) => (this.name = response.data.name))
            .catch((error) => {
                if (error.response.status === 401) {
                    this.$emit("updateSidebar");
                    localStorage.removeItem("authenticated");
                    this.$router.push({ name: "Login" });
                }
            });

        axios
            .get("/api/users/" + this.slug)
            .then((response) => {
                this.fields = response.data.data;
            })
            .catch((error) => {
                if (error.response.status === 403) {
                    this.$router.push({ name: "Blog" });
                }
            });

    },
};
</script>

<style scoped>
.create-post {
    background-color: #fff;
    padding: 0 3vw;
}

.container input,
textarea,
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 20px;
    font-size: 16px;
}

h1 {
    text-align: center;
    padding: 60px 0 50px 0;
}

.add-post-btn {
    background-color: black;
    color: white;
    border: none;
    cursor: pointer;
    transition: 0.3s ease;
}

.add-post-btn:hover {
    transform: translateY(-4px);
}

.preview img {
    max-width: 70%;
    height: 50vh;
    object-fit: contain;
}
</style>