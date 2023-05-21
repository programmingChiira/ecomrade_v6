<template>
    <body class="sign-in-illustration">
        <div class="full-page-loader" v-if="loading">
            <img src="/triangle.svg" alt="Loader" />
        </div>
        <section class="my-5 py-5">
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div
                            class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto"
                        >
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-left">
                                    <h4 class="font-weight-bolder">Sign Up</h4>
                                    <p class="mb-0">
                                        Create your own ecomrade account
                                    </p>
                                </div>
                                <div class="card-body">
                                    <form @submit.prevent="submit">
                                        <div class="mb-3">
                                            <label> Name :</label>
                                            <input
                                                type="text"
                                                class="form-control form-control-lg"
                                                placeholder="Enter your name"
                                                aria-label="Name"
                                                aria-describedby="name-addon"
                                                id="name"
                                                v-model="nameValue"
                                            />
                                            <span
                                                v-if="errors.name"
                                                class="error"
                                                >{{ errors.name[0] }}</span
                                            >
                                        </div>

                                        <div class="mb-3">
                                            <label> Phone No. :</label>
                                            <input
                                                type="text"
                                                class="form-control form-control-lg"
                                                placeholder="Enter your Phone"
                                                aria-label="Name"
                                                aria-describedby="name-addon"
                                                id="name"
                                                v-model="phoneValue"
                                            />
                                            <span
                                                v-if="errors.phone"
                                                class="error"
                                                >{{ errors.phone[0] }}</span
                                            >
                                        </div>

                                        <div class="mb-3">
                                            <label> Gender :</label>
                                            <select
                                                class="form-control form-control-lg"
                                                v-model="genderValue"
                                            >
                                                <option>Female</option>
                                                <option>Male</option>
                                            </select>
                                            <span
                                                v-if="errors.gender"
                                                class="error"
                                                >{{ errors.gender[0] }}</span
                                            >
                                        </div>

                                        <div class="mb-3">
                                            <label> Location :</label>
                                            <select
                                                class="form-control form-control-lg"
                                                v-model="campusArea"
                                            >
                                                <option
                                                    v-for="location in locations"
                                                    :key="location.id"
                                                >
                                                    {{ location.name }}
                                                </option>
                                            </select>
                                            <span
                                                v-if="errors.campus_area"
                                                class="error"
                                                >{{
                                                    errors.campus_area[0]
                                                }}</span
                                            >
                                        </div>

                                        <div class="mb-3">
                                            <label> Email :</label>
                                            <input
                                                type="email"
                                                class="form-control form-control-lg"
                                                placeholder="Enter your email"
                                                aria-label="Name"
                                                aria-describedby="name-addon"
                                                id="email"
                                                v-model="emailValue"
                                            />
                                            <span
                                                v-if="errors.email"
                                                class="error"
                                                >{{ errors.email[0] }}</span
                                            >
                                        </div>

                                        <div class="mb-3">
                                            <input
                                                type="hidden"
                                                class="form-control form-control-lg"
                                                placeholder="Enter your slug"
                                                aria-label="Slug"
                                                aria-describedby="name-addon"
                                                id="slug"
                                                v-model="slugValue"
                                            />
                                            <span
                                                v-if="errors.slug"
                                                class="error"
                                                >{{ errors.slug[0] }}</span
                                            >
                                        </div>

                                        <label class="label">Password</label>
                                        <span
                                            style="float: right"
                                            @click="toggleShow"
                                            ><span
                                                class="icon is-small is-right"
                                            >
                                                <i
                                                    class="fas"
                                                    :class="{
                                                        'fa-eye-slash':
                                                            showPassword,
                                                        'fa-eye': !showPassword,
                                                    }"
                                                >
                                                </i>
                                            </span>
                                        </span>
                                        <div class="field has-addons">
                                            <div class="control is-expanded">
                                                <input
                                                    v-if="showPassword"
                                                    type="text"
                                                    class="form-control form-control-lg"
                                                    v-model="passwordValue"
                                                />
                                                <input
                                                    v-else
                                                    type="password"
                                                    class="form-control form-control-lg"
                                                    v-model="passwordValue"
                                                />
                                                <span
                                                    v-if="errors.password"
                                                    class="error"
                                                    >{{
                                                        errors.password[0]
                                                    }}</span
                                                >
                                            </div>
                                        </div>

                                        <label class="label"
                                            >Password Confirm:</label
                                        >
                                        <span
                                            style="float: right"
                                            @click="toggleShowConfirm"
                                            ><span
                                                class="icon is-small is-right"
                                            >
                                                <i
                                                    class="fas"
                                                    :class="{
                                                        'fa-eye-slash':
                                                            showPasswordConfirm,
                                                        'fa-eye':
                                                            !showPasswordConfirm,
                                                    }"
                                                ></i>
                                            </span>
                                        </span>
                                        <div class="field has-addons">
                                            <div class="control is-expanded">
                                                <input
                                                    v-if="showPasswordConfirm"
                                                    type="text"
                                                    class="form-control form-control-lg"
                                                    v-model="
                                                        password_confirmationValue
                                                    "
                                                />
                                                <input
                                                    v-else
                                                    type="password"
                                                    class="form-control form-control-lg"
                                                    v-model="
                                                        password_confirmationValue
                                                    "
                                                />
                                                <span
                                                    v-if="errors.password"
                                                    class="error"
                                                    >{{
                                                        errors.password[0]
                                                    }}</span
                                                >
                                            </div>
                                        </div>

                                        <div v-if="errors">
                                            <h6
                                                style="
                                                    color: red;
                                                    font-size: 12px;
                                                "
                                            >
                                                {{ errors }} :- Please check your format.
                                            </h6>
                                        </div>

                                        <br />

                                        <ul>
                                            <li>
                                                <router-link
                                                    to="/terms"
                                                    class="mb-4 text-sm mx-auto text-primary text-gradient font-weight-bold"
                                                >
                                                    Terms & conditions
                                                </router-link>
                                            </li>
                                            <li>
                                                <router-link
                                                    to="/privacy"
                                                    class="mb-4 text-sm mx-auto text-primary text-gradient font-weight-bold"
                                                >
                                                    Privacy policy
                                                </router-link>
                                            </li>
                                        </ul>

                                        <label class="label">
                                            By signing up, I agree with terms,
                                            conditions, & privacy
                                        </label>

                                        <div class="text-center">
                                            <button
                                                v-if="!isSubmitting"
                                                type="submit"
                                                class="btn btn-sm bg-gradient-primary btn-sm w-100 mt-4 mb-0"
                                            >
                                                Sign Up
                                            </button>
                                            <br/>
                                            <i
                                                v-if="isSubmitting"
                                                style="
                                                    -webkit-animation: fa-spin
                                                        3s infinite linear;
                                                    animation: fa-spin 2s
                                                        infinite linear;
                                                    font-size: 17px;
                                                    color: #189483 ;
                                                "
                                                class="fa fa-graduation-cap"
                                            ></i>
                                        </div>
                                    </form>
                                </div>
                                <div
                                    class="card-footer text-center pt-0 px-lg-2 px-1"
                                >
                                    <p class="mb-4 text-sm mx-auto">
                                        Already have an account?
                                        <router-link
                                            to="/login"
                                            class="text-primary text-gradient font-weight-bold"
                                        >
                                            Sign In
                                        </router-link>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column"
                        >
                            <div
                                class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center"
                            >
                                <div class="position-relative">
                                    <img
                                        style="border-radius: 10px"
                                        class="max-width-500 w-100 position-relative z-index-2"
                                        src="/web/faq.png"
                                    />
                                </div>
                                <h4 class="mt-5 text-white font-weight-bolder">
                                    "Dear esteemed user"
                                </h4>
                                <p class="text-white">
                                    We collaborate with creative minds to make
                                    life easier for Kenyan comrades.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="horizontal dark my-5" />
        </section>

        <Footer />
    </body>
</template>

<script>
import Footer from "./Footer.vue";

export default {
    components: {
        Footer,
    },
    data() {
        return {
            fields: {
                name: "",
                email: "",
                phone: "",
                gender: "",
                campus_area: "",
                slug: "",
                password: "",
            },
            errors: "",
            name: "",
            locations: {},
            showPassword: false,
            password: null,
            showPasswordConfirm: false,
            loading: true,
            isSubmitting: false,
        };
    },
    methods: {
        submit() {
            this.isSubmitting = true;
            axios
                .post("/api/register", this.fields)
                .then(() => {
                    this.isSubmitting = true;
                    this.$router.push({ name: "Login" });
                    this.isSubmitting = true;
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    this.isSubmitting = false;
                });
        },
        fetchCategories() {
            axios
                .get("/api/locations")
                .then((response) => (this.locations = response.data))
                .catch((error) => {
                    console.log(error);
                });
        },

        toggleShow() {
            this.showPassword = !this.showPassword;
        },

        toggleShowConfirm() {
            this.showPasswordConfirm = !this.showPasswordConfirm;
        },
    },
    computed: {
        buttonLabel() {
            return this.showPassword ? "Hide" : "Show";
        },

        buttonLabelConfirm() {
            return this.showPasswordConfirm ? "Hide" : "Show";
        },

        nameValue: {
            get() {
                return this.fields.name;
            },
            set(value) {
                this.fields.name = value;
            },
        },

        phoneValue: {
            get() {
                return this.fields.phone;
            },
            set(value) {
                this.fields.phone = value;
            },
        },

        genderValue: {
            get() {
                return this.fields.gender;
            },
            set(value) {
                this.fields.gender = value;
            },
        },

        campusArea: {
            get() {
                return this.fields.campus_area;
            },
            set(value) {
                this.fields.campus_area = value;
            },
        },

        emailValue: {
            get() {
                return this.fields.email;
            },
            set(value) {
                this.fields.email = value;
            },
        },

        // slugValue: {
        //     get() {
        //         return this.fields.slug;
        //     },
        //     set(value) {
        //         this.fields.slug = value;
        //     }
        // },
        slugValue: {
            get() {
                let result = "";
                let characters =
                    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
                let charactersLength = characters.length;
                for (let i = 0; i < 100; i++) {
                    result += characters.charAt(
                        Math.floor(Math.random() * charactersLength)
                    );
                }
                return (this.fields.slug = result + "-" + this.fields.name);
            },
            set(value) {
                this.fields.slug = value;
            },
        },

        passwordValue: {
            get() {
                return this.fields.password;
            },
            set(value) {
                this.fields.password = value;
            },
        },

        password_confirmationValue: {
            get() {
                return this.fields.password_confirmation;
            },
            set(value) {
                this.fields.password_confirmation = value;
            },
        },
    },
    mounted() {
        setTimeout(() => {
            this.loading = false;
        }, 2000);

        axios.get("/api/locations").then((response) => {
            this.locations = response.data.data;
        });
    },
};
</script>
