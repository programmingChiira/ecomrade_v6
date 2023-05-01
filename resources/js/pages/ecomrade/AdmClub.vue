<template>
    <body class="about-us">
        <section class="my-5 py-5">

            <div class="container">

                <div class="row justify-content-center my-2 py-1">
                    <div class="custom-search">
                        <input v-model="name" @input="searchclub" type="text" class="custom-search-input"
                            placeholder="Search Club | Society..." name="searchclub">
                        <br>
                        <br>
                        <div class="search-results-container" v-if="searchResults.length > 0"
                            style="background-color: rgb(250, 250, 250); border: none; border-radius: 5px;">
                            <br>
                            <ul style="padding: 20px;" class="search-results">
                                <li style="margin: 13px;" v-for="result in searchResults" :key="result.id">
                                    <input style="background-color: rgb(250, 250, 250);border:none;color:#189483;"
                                        type="button" @click="selectItem(result)" :value="result.name">
                                    <hr class="horizontal dark my-1">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <br />

                <div class="row">
                    <div class="col-md-4 col-9">
                        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                            <div class="container">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                                    <li class="breadcrumb-item"><router-link to="/dashboard">Dash</router-link></li>
                                    <li style="color: #189483;" class="breadcrumb-item"><strong>Clubs</strong></li>
                                </ol>
                                <div v-if="lastPage > 1" class="pagination">
                                    <button class="btn bg-gradient-primary btn-sm" style="margin: 4px;"
                                        v-if="currentPage > 1" @click="clubName(currentPage - 1)">&laquo; Prev</button>

                                    <button class="btn bg-gradient-primary btn-sm" style="margin: 4px;"
                                        v-if="currentPage < lastPage" @click="clubName(currentPage + 1)">Next
                                        &raquo;</button>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="">
                            <div class="table-responsive">
                                <table class="table project-list-table table-nowrap align-middle table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="ps-4" style="width: 50px;">
                                                <div class="form-check font-size-16"><input type="checkbox"
                                                        class="form-check-input" id="contacusercheck" /><label
                                                        class="form-check-label" for="contacusercheck"></label></div>
                                            </th>
                                            <th scope="col">Logo</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">View</th>
                                            <th scope="col">Room</th>
                                            <th scope="col">Description</th>
                                            <th v-if="id == 1" scope="col">Edit</th>
                                            <th v-if="id == 1" scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="club in clubs" :key="club.id">
                                            <th scope="col" class="ps-4" style="width: 50px;">
                                                <div class="form-check font-size-16"><input type="checkbox"
                                                        class="form-check-input" id="contacusercheck" /><label
                                                        class="form-check-label" for="contacusercheck"></label></div>
                                            </th>
                                            <td>
                                                <img v-if="club.image_1 == false || club.image_1 == null || club.image_1 == 'null' || club.image_1 == '' || club.image_1 == ' ' || club.image_1 == NULL"
                                                    class="avatar-sm rounded-circle me-2" src="/web/img/no_img.jpg" alt="Image Title" />
                                                <img v-else class="avatar-sm rounded-circle me-2" :src="'./img/clubs/' + club.image_1"
                                                    alt="Image Title" />
                                            </td>
                                            <td>
                                                <span class="badge badge-soft-success mb-0"> {{ club.name }} </span>
                                            </td>
                                            <td>
                                                <router-link class="btn btn-sm" :to="{
                                                    name: 'ClubDetails',
                                                    params: { slug: club.slug },
                                                  }">
                                                    View Club
                                                  </router-link>
                                            </td>
                                            <td>
                                                <router-link class="btn btn-sm" :to="{
                                                    name: 'ViewClub',
                                                    params: { slug: club.slug },
                                                  }">
                                                    Chat room
                                                  </router-link>
                                            </td>
                                            <td>
                                                {{ club.description }}
                                            </td>
                                            <td v-if="id == 1">
                                                <router-link style="text-align: center;" :to="{
                                                    name: 'EditClub',
                                                    params: { slug: club.slug },
                                                }"><i class="fa fa-edit" style="color: black;"></i>
                                                </router-link>
                                            </td>
                                            <td v-if="id == 1">
                                                <button type="button" @click="destroy(club.id)" class="delete-btn"
                                                    style="text-align: center;border:none;outline:none;background: none;">
                                                    <i class="fa fa-trash-o" style="color: red;"></i>
                                                </button>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h5 v-if="!clubs.length">Sorry, no item found!</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <Footer />
    </body>
</template>

<script>
import Footer from './Footer.vue'

import axios from 'axios';

import Cookies from 'js-cookie';

export default {

    components: {
        Footer
    },
    emits: ["updateSidebar"],
    data() {
        return {
            clubs: [],
            currentPage: 1,
            lastPage: 1,

            name: '',
            searchResults: [],
            //market: {},

            success: false,
            fields: {
                category_id: "",
            },
            errors: {},
            url: "",
            user_id: "",
            links: [],
            categories: [],

            club_category: "",
            id: "",
        };
    },

    created() {
        this.clubName(this.currentPage);

    },

    computed: {
        marketName: {
            get() {
                return this.fields.name = this.market.name;
            },
            set(value) {
                this.fields.name = value;
            }
        },
    },

    methods: {

        searchclub() {
            if (this.name.length > 2) {

                axios.get('/api/searchclub', { params: { q: this.name } })
                    .then(response => {
                        this.searchResults = response.data;
                    });
            } else {
                this.searchResults = [];
            }
        },

        selectItem(item) {
            this.name = item.name;
            this.searchResults = [];
        },
        submit() {
            axios
                .post("/api/clubs", this.fields, {
                    headers: { "content-type": "multipart/form-data" },
                })
                .then(() => {
                    this.fields = {};
                    this.url = null;
                    this.fields.category_id = "";
                    this.success = true;
                    this.errors = {};

                    axios.get("/api/clubs").then(({
                        data
                    }) => (this.clubs = data.data));

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
                        .delete("/api/clubs/" + id)
                        .then((response) => {
                            Swal.fire(
                                'Deleted!',
                                'Information has been successfully deleted.',
                                'success'
                            );
                            // Fire.$emit('AfterCreate');
                            axios.get('/api/clubs').then(response => {
                                this.clubs = response.data.data;
                            });
                        }).catch((error) => {
                            Swal.fire("Failed!", error.message, "warning");
                        });
                }
            })
        },

        clubName(page) {
            axios
                .get('/api/clubs?page=' + page, {
                    params: {
                        search: this.name,
                    },
                })
                .then((response) => {
                    this.clubs = response.data.data;
                    this.currentPage = response.data.current_page;
                    this.lastPage = response.data.last_page;
                })
                .catch((error) => {
                    console.log(error);
                });

        },

    },

    watch: {
        name(page) {
            axios
                .get("/api/clubs", {
                    params: {
                        page: page,
                        search: this.name,
                    },
                })
                .then((response) => {
                    this.clubs = response.data.data;
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
            .then(response => {
                this.id = response.data.id
            })
            .catch((error) => {
                if (error.response.status === 401) {
                    this.$emit("updateSidebar");
                    localStorage.removeItem("authenticated");
                }
            });

        axios
            .get("/api/categories")
            .then((response) => (this.categories = response.data))
            .catch((error) => {
                console.log(error);
            });
    },
};
</script>

<style scoped>
.project-list-table {
    border-collapse: separate;
    border-spacing: 0 12px
}

.project-list-table tr {
    background-color: #fff
}

.table-nowrap td,
.table-nowrap th {
    white-space: nowrap;
}

.table-borderless>:not(caption)>*>* {
    border-bottom-width: 0;
}

.table>:not(caption)>*>* {
    padding: 0.75rem 0.75rem;
    background-color: var(--bs-table-bg);
    border-bottom-width: 1px;
    box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
}

.avatar-sm {
    height: 2rem;
    width: 2rem;
}

.rounded-circle {
    border-radius: 50% !important;
}

.me-2 {
    margin-right: 0.5rem !important;
}

img,
svg {
    vertical-align: middle;
}

a {
    color: #3b76e1;
    text-decoration: none;
}

.badge-soft-danger {
    color: #f56e6e !important;
    background-color: rgba(245, 110, 110, .1);
}

.badge-soft-success {
    color: #63ad6f !important;
    background-color: rgba(99, 173, 111, .1);
}

.badge-soft-primary {
    color: #3b76e1 !important;
    background-color: rgba(59, 118, 225, .1);
}

.badge-soft-info {
    color: #57c9eb !important;
    background-color: rgba(87, 201, 235, .1);
}

.avatar-title {
    align-items: center;
    background-color: #3b76e1;
    color: #fff;
    display: flex;
    font-weight: 500;
    height: 100%;
    justify-content: center;
    width: 100%;
}

.bg-soft-primary {
    background-color: rgba(59, 118, 225, .25) !important;
}
</style>