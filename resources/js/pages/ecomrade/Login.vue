<template>
    <body class="sign-in-illustration">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-left">
                                    <h4 class="font-weight-bolder">Sign In</h4>
                                    <p class="mb-0">Login in your own ecomrade account</p>
                                </div>
                                <div class="card-body">
                                    <form @submit.prevent="submit">
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="Your phone number" v-model="fields.phone" aria-label="Phone"
                                                aria-describedby="phone-addon">
                                            <span v-if="errors.phone" class="error"> {{ errors.phone[0] }} </span>
                                        </div>
                                        <label class="label">Password</label>
                                        <div class="field has-addons">
                                            <div class="control is-expanded">
                                                <input v-if="showPassword" type="text" class="form-control form-control-lg"
                                                    v-model="fields.password" />
                                                <input v-else type="password" class="form-control form-control-lg"
                                                    v-model="fields.password">
                                                <span @click="toggleShow">
                                                    <span class="icon is-small is-right">
                                                        <i
                                                            :class="{ 'fa-eye-slash': showPassword, 'fa-eye': !showPassword }">
                                                        </i>
                                                    </span>
                                                </span>
                                                <span v-if="errors.password" class="error">{{ errors.password[0] }}</span>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Sign
                                                in</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Don't have an account?
                                        <router-link to="/register" class="text-primary text-gradient font-weight-bold">
                                            Sign Up
                                        </router-link>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div
                                class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center">

                                <div class="position-relative">
                                    <img style="border-radius: 10px;"
                                        class="max-width-500 w-100 position-relative z-index-2" src="/web/soc.webp">
                                </div>
                                <h4 class="mt-5 text-white font-weight-bolder">"Dear esteemed user"</h4>
                                <p class="text-white"> We collaborate with creative minds to make life easier for Kenyan
                                    comrades.</p>
                            </div>
                        </div>

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
            fields: {},
            errors: {},
            showPassword: false,
            password: null
        };
    },
    computed: {
        buttonLabel() {
            return (this.showPassword) ? "Hide" : "Show";
        }
    },
    methods: {
        submit() {
            axios
                .post("/api/login", this.fields)
                .then(() => {
                    this.$router
                        .push({ name: 'Home' })

                    localStorage.setItem("authenticated", "true");
                    console.log("authenticated:", localStorage.getItem("authenticated"));
                    this.$emit("updateSidebar");
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },


        toggleShow() {
            this.showPassword = !this.showPassword;
        },
    },
};
</script>
