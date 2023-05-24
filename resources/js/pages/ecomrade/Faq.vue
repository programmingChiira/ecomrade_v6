<template>
    <body class="about-us">
        <div class="full-page-loader" v-if="loading">
            <img src="/triangle.svg" alt="Loader" />
        </div>
        <!-- -------- START HEADER 7 w/ text and video ------- -->
        <header class="bg-gradient-dark">
            <div class="page-header min-vh-55" style="background-image: url('web/faq.png');">
                <span class="mask bg-gradient-info opacity-8"></span>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 text-center mx-auto my-auto">
                            <h1 class="text-white">ecomrade</h1>
                            <p class="lead mb-4 text-white opacity-8">A Hub for Kenyan University Comrades.</p>
                            <router-link v-if="id == false" to="/register" class="dropdown-item py-2 ps-3 border-radius-md">
                                <button type="submit" class="btn bg-white text-dark">Create Account</button>
                            </router-link>
                            <h6 class="text-white mb-2 mt-5">Find us on</h6>
                            <div class="d-flex justify-content-center">
                                <a href="https://twitter.com/DennisChiira" target="_blank"><i class="fab fa-twitter text-lg text-white me-4"></i></a>
                                <a href="https://www.linkedin.com/company/cyberacademykenya/?viewAsMember=true" target="_blank"><i class="fab fa-linkedin text-lg text-white me-4"></i></a>
                                <a href="https://github.com/programmingChiira" target="_blank"><i class="fab fa-github text-lg text-white me-4"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="position-absolute w-100 z-index-1 bottom-0">
                    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
                        <defs>
                            <path id="gentle-wave"
                                d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                        </defs>
                        <g class="moving-waves">
                            <use xlink:href="#gentle-wave" x="48" y="-1" fill="rgba(255,255,255,0.40" />
                            <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.35)" />
                            <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.25)" />
                            <use xlink:href="#gentle-wave" x="48" y="8" fill="rgba(255,255,255,0.20)" />
                            <use xlink:href="#gentle-wave" x="48" y="13" fill="rgba(255,255,255,0.15)" />
                            <use xlink:href="#gentle-wave" x="48" y="16" fill="rgba(255,255,255,1" />
                        </g>
                    </svg>
                </div>
            </div>
        </header>
        <!-- -------- END HEADER 7 w/ text and video ------- -->
        <!-- Section with four info areas left & one card right with image and waves -->
        <section class="py-7">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">

                        <div class="row justify-content-start">

                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse"
                                            data-mdb-target="#flush-collapse-1" aria-expanded="false"
                                            aria-controls="flush-collapse-1">
                                            Who are we?
                                        </button>
                                    </h2>
                                    <div id="flush-collapse-1" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingOne" data-mdb-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <p style="color: black;">ecomrade is an online platform desgined and
                                                developed by a comrade to
                                                help make
                                                life of a comrade
                                                easier, buying, selling, and finding rentals around campus.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse"
                                            data-mdb-target="#flush-collapse-2" aria-expanded="false"
                                            aria-controls="flush-collapse-2">
                                            How can I sell?
                                        </button>
                                    </h2>
                                    <div id="flush-collapse-2" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingTwo" data-mdb-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <p style="color: black;">Selling on ecomrade is completely free for
                                                comrades. To achieve this, cick
                                                <router-link style="color: #17C1E8;text-decoration:underline;" to="/market">
                                                    Sell</router-link>, then the green 'New Product' button on your
                                                top
                                                right and fill the
                                                fields.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingThree">
                                        <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse"
                                            data-mdb-target="#flush-collapse-3" aria-expanded="false"
                                            aria-controls="flush-collapse-3">
                                            How to find rentals?
                                        </button>
                                    </h2>
                                    <div id="flush-collapse-3" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingThree" data-mdb-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <p style="color: black;">You can find affordable rentals and their pinned
                                                locations, owners' contacts. We
                                                recommend to visit
                                                the actual location of the rental without making any payments. Find
                                                rentals at
                                                <router-link style="color: #17C1E8;text-decoration:underline;" to="/rental">
                                                    Rentals</router-link>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingThree">
                                        <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse"
                                            data-mdb-target="#flush-collapse4" aria-expanded="false"
                                            aria-controls="flush-collapse4">
                                            How can I put up blogs?
                                        </button>
                                    </h2>
                                    <div id="flush-collapse4" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingThree" data-mdb-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <p style="color: black;">ecomrade allows students to display and share their
                                                creativity by use of blogs
                                                where they can write
                                                their own stories and expreiences at <router-link
                                                    style="color: #17C1E8;text-decoration:underline;" to="/blog">
                                                    Blogs</router-link>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingThree">
                                        <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse"
                                            data-mdb-target="#flush-collapse5" aria-expanded="false"
                                            aria-controls="flush-collapse5">
                                            Create my own polls?
                                        </button>
                                    </h2>
                                    <div id="flush-collapse5" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingThree" data-mdb-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <p style="color: black;">Poll allow the user to pose an argument anonymously
                                                and have others participate
                                                and vote
                                                anonymously, create one at <router-link
                                                    style="color: #17C1E8;text-decoration:underline;" to="/poll">
                                                    Polls</router-link>
                                            </p>
                                        </div>
                                    </div>
                                </div>


                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingThree">
                                        <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse"
                                            data-mdb-target="#flush-collapse6" aria-expanded="false"
                                            aria-controls="flush-collapse6">
                                            Create my club / society?
                                        </button>
                                    </h2>
                                    <div id="flush-collapse6" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingThree" data-mdb-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <p style="color: black;">Any user can create his / her society, club, group
                                                from where they can have users
                                                join them and
                                                particitate. Create your own club/society at <router-link
                                                    style="color: #17C1E8;text-decoration:underline;" to="/club">
                                                    Clubs</router-link>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4 ms-auto mt-lg-0 mt-4">
                        <div class="card shadow-lg">
                            <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                                <div class="d-block blur-shadow-image">
                                    <img src="/web/soc.webp" style="opacity: 1" alt="img-blur-shadow"
                                        class="img-fluid shadow rounded-3">
                                </div>
                                <div class="colored-shadow"
                                    style="background-image: url(&quot;web/soc.webp&quot;);opacity: 1;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="my-5 pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-5">
                        <div class="position-relative">
                            <img class="max-width-50 w-50 position-relative z-index-2" src="/assets/img/logo.png"
                                style="opacity: 1;width: 50px;" alt="image">
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
import Install from './Install.vue'

export default {

    components: {
        Footer,
        Install
    },
    emits: ["updateSidebar"],
    data() {
        return {
            posts: [],

            id: "",
            name: "",
            loading: true,
        };
    },

    mounted() {
        setTimeout(() => {
            this.loading = false;
        }, 2000);

        axios
            .get("/api/home-posts")
            .then((response) => (this.posts = response.data.data))
            .catch((error) => {
                console.log(error);
            });

        axios
            .get("/api/user")
            //.then((response) => (this.id = response.data.id))
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
