<template>
    <body class="index-page">
        <loader/>
        <section class="my-5 py-5">
            <div class="container">

                <div class="row">
                    <div class="col-md-4 col-9">
                        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                            <div class="container">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><router-link to="/resource">Resources</router-link></li>
                                    <li style="color: #189483;" class="breadcrumb-item"><strong>{{ club.name }}
                                            Resources</strong></li>
                                </ol>
                            </div>
                        </nav>
                    </div>
                </div>

                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-12" v-for="resource in resources"
                            :key="resource.id" v-show="resource.club_id == club.id">
                            <div style="background-color: #E9ECEF;" class="card shadow">
                                <!-- <img src="img/no_img.png" class="card-img-top" alt="..."> -->

                                <img v-if="isImage(resource.resource_1)" loading="lazy"
                                    style="background-color: white;width: 100%;height: 200px; object-fit: cover;"
                                    src="/img/image.webp" class="card-img-top" width="100%">

                                <img v-else style="background-color: white;width: 100%;height: 200px; object-fit: contain;"
                                    src="/img/pdf.png" class="card-img-top" width="100%">

                                <div class="card-body">
                                    <h5 class="card-title"> {{ truncateText(resource.title) }} </h5>
                                </div>
                                <div class="card-body card-p">
                                    <div class="d-flex flex-row justify-content-between">
                                        <div class="d-flex flex-column">
                                            <div class="col col-xs-6">
                                                <i class="far fa-comments"></i> {{ resource.rating_count }}
                                            </div>
                                        </div>

                                        <div class="d-flex flex-column">
                                            <div class="col col-xs-6">
                                                <span style="margin: 3px;" class="badge bg-dark">
                                                    <div v-if="Math.round(resource.avg_rating) === 0" class="stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <div v-if="Math.round(resource.avg_rating) === 1" class="stars">
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <div v-if="Math.round(resource.avg_rating) === 2" class="stars">
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <div v-if="Math.round(resource.avg_rating) === 3" class="stars">
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <div v-if="Math.round(resource.avg_rating) === 4" class="stars">
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <div v-if="Math.round(resource.avg_rating) === 5" class="stars">
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                    </div>
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card-body card-p">
                                    <div class="d-flex flex-row justify-content-between">
                                        <div class="d-flex flex-column">
                                            <div class="col col-xs-6">
                                                <button v-if="resource.user_id == id" type="button"
                                                    @click="destroy(resource.id)" class="delete-btn"
                                                    style="float: left;border:none;outline:none;background: none;">
                                                    <i class="fa fa-trash-o" style="color: red;"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <div class="col col-xs-6">
                                                <router-link :to="{
                                                    name: 'ViewResource',
                                                    params: { slug: resource.slug },
                                                }">
                                                    <button type="button" class="btn bg-gradient-primary btn-sm "><small>
                                                            View
                                                        </small></button>
                                                </router-link>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <div class="col col-xs-6">
                                                <router-link style="float: right;" v-if="resource.user_id == id" :to="{
                                                    name: 'EditResource',
                                                    params: { slug: resource.slug },
                                                }"><i class="fa fa-edit" style="color: #189483;"></i>
                                                </router-link>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <br />
                        </div>
                        <h5 v-if="!resources.length">Sorry, no item found!</h5>
                    </div>
                    <br /><br />
                    <div v-if="lastPage > 1" class="pagination">
                        <button class="btn bg-gradient-primary btn-sm" style="margin: 4px;" v-if="currentPage > 1"
                            @click="resourceTitle(currentPage - 1)">&laquo; Prev</button>

                        <button class="btn bg-gradient-primary btn-sm" style="margin: 4px;" v-if="currentPage < lastPage"
                            @click="resourceTitle(currentPage + 1)">
                            Next &raquo;</button>
                    </div>
                </div>

            </div>
            <hr class="horizontal dark my-5">
        </section>

        <Footer />
    </body>
</template>

<script>
import Footer from './Footer.vue';
import Loader from './Loader.vue';
export default {
    components: {
        Footer,
        Loader,
    },
    emits: ["updateSidebar"],
    props: ["slug"],
    data() {
        return {
            club: {},
            resources: [],
            currentPage: 1,
            lastPage: 1,

            title: '',
            searchResults: [],
            //resource: {},

            success: false,
            fields: {
                category_id: "",
            },
            errors: {},
            url: "",
            user_id: "",
            links: [],
            courses: [],
            years: [],

            resource_category: "",
            id: "",
            name: "",
        };
    },

    created() {
        this.resourceTitle(this.currentPage);
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

        resourceName: {
            get() {
                return this.fields.title = this.resource.title;
            },
            set(value) {
                this.fields.title = value;
            }
        },
    },
    methods: {


        truncateText(posts) {
            const truncatedText = posts.slice(0, 10) + '...'
            return truncatedText
        },

        isImage(filename) {
            const extension = filename.split('.').pop().toLowerCase();
            return ['jpg', 'jpeg', 'png', 'gif'].includes(extension);
        },
        searchresource() {
            if (this.title.length > 2) {

                axios.get('/api/searchresource', { params: { q: this.title } })
                    .then(response => {
                        this.searchResults = response.data;
                    });
            } else {
                this.searchResults = [];
            }
        },

        selectItem(item) {
            this.title = item.title;
            this.searchResults = [];
        },
        submit() {
            axios
                .post("/api/resources", this.fields, {
                    headers: { "content-type": "multipart/form-data" },
                })
                .then(() => {
                    this.fields = {};
                    this.url = null;
                    this.fields.category_id = "";
                    this.success = true;
                    this.errors = {};

                    axios.get("/api/resources").then(({
                        data
                    }) => (this.resources = data.data));

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
                        .delete("/api/resources/" + id)
                        .then((response) => {
                            Swal.fire(
                                'Deleted!',
                                'Information has been successfully deleted.',
                                'success'
                            );
                            // Fire.$emit('AfterCreate');
                            axios.get('/api/resources').then(response => {
                                this.resources = response.data.data;
                            });
                        }).catch((error) => {
                            Swal.fire("Failed!", error.message, "warning");
                        });
                }
            })
        },

        resourceTitle(page) {
            axios
                .get('/api/resources?page=' + page, {
                    params: {
                        search: this.title,
                    },
                })
                .then((response) => {
                    this.resources = response.data.data;
                    this.currentPage = response.data.current_page;
                    this.lastPage = response.data.last_page;
                })
                .catch((error) => {
                    console.log(error);
                });

        },

    },

    watch: {
        title(page) {
            axios
                .get("/api/resources", {
                    params: {
                        page: page,
                        search: this.title,
                    },
                })
                .then((response) => {
                    this.resources = response.data.data;
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

        axios.get('/api/courses')
            .then(response => {
                this.courses = response.data.data;
            });

        axios.get('/api/years')
            .then(response => {
                this.years = response.data.data;
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