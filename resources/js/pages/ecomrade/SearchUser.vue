<template>
    <body class="about-us">
        <div class="full-page-loader" v-if="loading">
            <img src="/triangle.svg" alt="Loader" />
          </div>
        <section class="my-5 py-5">

            <div class="container">

                <div class="row justify-content-center my-2 py-1">
                    <div class="custom-search">
                        <input v-model="name" @input="searchuser" type="text" class="custom-search-input"
                            placeholder="Search For User | Role | Gender..." name="searchuser">
                        <br>
                        <br>
                        <div class="search-results-container" v-if="searchResults.length > 0"
                            style="background-color: rgb(250, 250, 250); border: none; border-radius: 5px;">
                            <br>
                            <ul style="padding: 20px;" class="search-results">
                                <li style="margin: 13px;" v-for="user in searchResults" :key="user.id">
                                    <input style="background-color: rgb(250, 250, 250);border:none;color:#189483;"
                                        type="button" @click="selectItem(user)" :value="user.name">
                                    <hr class="horizontal dark my-1">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <br/>

                <div class="row">
                    <div class="col-md-4 col-10">
                        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                            <div class="container">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                                    <li class="breadcrumb-item"><router-link to="/">Search</router-link></li>
                                    <li style="color: #189483;" class="breadcrumb-item"><strong>Users</strong></li>
                                </ol>
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
                                            <th scope="col">Name</th>
                                            <th scope="col">Campus</th>
                                            <th scope="col">Comrade profile</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="user in searchcomrades" :key="user.id" v-show="user.id != id">
                                            <th scope="row" class="ps-4">
                                                <div class="form-check font-size-16"><input type="checkbox"
                                                        class="form-check-input" id="contacusercheck1" /><label
                                                        class="form-check-label" for="contacusercheck1"></label></div>
                                            </th>
                                            <td><span class="badge badge-soft-success mb-0"> {{ user.name }} </span>
                                            </td>
                                            <td> {{ user.campus }} </td>
                                            <td>
                                                <router-link class="btn btn-sm" @click="visible = !visible" :to="{
                                                    name: 'Profile',
                                                    params: { slug: user.slug },
                                                  }">
                                                    <i class="fa fa-user me-1"></i>
                                                  </router-link>
                                            </td>
                                        </tr>
                                        <tr>
                                        </tr>
                                    </tbody>
                                </table>
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
            searchcomrades: [],
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
            links: [],

            id: "",
            loading: true,
        };
    },

    created() {
        this.userName(this.currentPage);

    },

    computed: {
        marketName: {
            get() {
                return this.fields.title = this.market.title;
            },
            set(value) {
                this.fields.title = value;
            }
        },
    },

    methods: {

        truncateText(searchcomrades) {
            const truncatedText = searchcomrades.slice(0, 10) + '...'
            return truncatedText
        },
        searchuser() {
            if (this.name.length > 2) {

                axios.get('/api/searchuser', { params: { q: this.name } })
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
                .user("/api/searchcomrades", this.fields, {
                    headers: { "content-type": "multipart/form-data" },
                })
                .then(() => {
                    this.fields = {};
                    this.success = true;
                    this.errors = {};

                    axios.get("/api/searchcomrades").then(({
                        data
                    }) => (this.searchcomrades = data.data));

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
                        .delete("/api/searchcomrades/" + id)
                        .then((response) => {
                            Swal.fire(
                                'Deleted!',
                                'Information has been successfully deleted.',
                                'success'
                            );
                            // Fire.$emit('AfterCreate');
                            axios.get('/api/searchcomrades').then(response => {
                                this.searchcomrades = response.data.data;
                            });
                        }).catch((error) => {
                            Swal.fire("Failed!", error.message, "warning");
                        });
                }
            })
        },

        userName(page) {
            axios
                .get('/api/searchcomrades?page=' + page, {
                    params: {
                        search: this.name,
                    },
                })
                .then((response) => {
                    this.searchcomrades = response.data.data;
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
                .get("/api/searchcomrades", {
                    params: {
                        page: page,
                        search: this.name,
                    },
                })
                .then((response) => {
                    this.searchcomrades = response.data.data;
                    this.currentPage = response.data.current_page;
                    this.lastPage = response.data.last_page;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },

    mounted() {
        setTimeout(() => {
      this.loading = false;
    }, 2000);

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