<template>
    <body class="about-us">
        <section class="my-5 py-5">

            <div class="container">

                <div class="row justify-content-center my-2 py-1">
                    <div class="custom-search">

                        <input v-model="title" @input="searchevent" type="text" class="custom-search-input"
                            placeholder="Search event | event location..." name="searchevent">
                        <br>
                        <br>

                        <div class="search-results-container" v-if="searchResults.length > 0"
                            style="background-color: rgb(250, 250, 250); border: none; border-radius: 5px;">
                            <br>
                            <ul style="padding: 20px;" class="search-results">
                                <li style="margin: 13px;" v-for="result in searchResults" :key="result.id">
                                    <input style="background-color: rgb(250, 250, 250);border:none;color:#189483;"
                                        type="button" @click="selectItem(result)" :value="result.title">
                                    <hr class="horizontal dark my-1">
                                </li>
                            </ul>
                        </div>

                        <span style="float:right;margin:6px;">

                            <button data-toggle="tooltip" data-placement="bottom" title="Event list" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" class="btn btn-sm">
                                <i style="font-size: 13px;" class="fa fa-map-marker"></i>
                            </button>

                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Event Location
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div style="padding: 15px;" class="container row">
                                            <ul>
                                                <li style="display: inline;" v-for="location in locations"
                                                    :key="location.id">
                                                    <input data-bs-dismiss="modal" class="btn btn-sm" type="button"
                                                        name="search" :value="location.name" @click="title = location.name">
                                                </li>
                                                <h5 v-if="!locations.length">Sorry, no item found!</h5>
                                            </ul>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn bg-gradient-dark btn-sm"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div>
                </div>

                <br />

                <div class="row">
                    <div class="col-md-4 col-10">
                        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                            <div class="container">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                                    <li class="breadcrumb-item"><router-link to="/dashboard">Dash</router-link></li>
                                    <li style="color: #189483;" class="breadcrumb-item"><strong>Events</strong></li>
                                </ol>
                                <div v-if="lastPage > 1" class="pagination">
                                    <button class="btn bg-gradient-primary btn-sm" style="margin: 4px;"
                                        v-if="currentPage > 1" @click="eventTitle(currentPage - 1)">&laquo;
                                        Prev</button>

                                    <button class="btn bg-gradient-primary btn-sm" style="margin: 4px;"
                                        v-if="currentPage < lastPage" @click="eventTitle(currentPage + 1)">
                                        Next &raquo;</button>
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
                                                <div class="form-check font-size-16">
                                                    <input type="checkbox" class="form-check-input" id="contacusercheck" />
                                                    <label class="form-check-label" for="contacusercheck"></label>
                                                </div>
                                            </th>
                                            <th scope="col">Logo</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Happening-In</th>
                                            <th scope="col">Time</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Mode</th>
                                            <th scope="col">View</th>
                                            <th v-if="id == 1" scope="col">Edit</th>
                                            <th v-if="id == 1" scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="event in events" :key="event.id">
                                            <th scope="row" class="ps-4">
                                                <div class="form-check font-size-16"><input type="checkbox"
                                                        class="form-check-input" id="contacusercheck1" /><label
                                                        class="form-check-label" for="contacusercheck1"></label></div>
                                            </th>
                                            <td>
                                                <img v-if="event.image_1 == false || event.image_1 == null || event.image_1 == 'null' || event.image_1 == '' || event.image_1 == ' ' || event.image_1 == NULL"
                                                    loading="lazy" src="/web/img/no_img.jpg"
                                                    class="avatar-sm rounded-circle me-2">

                                                <img v-else :src="'./img/event/' + event.image_1"
                                                    class="avatar-sm rounded-circle me-2">
                                            </td>
                                            <td><span class="badge badge-soft-success mb-0">{{ event.title }}</span></td>
                                            <td>
                                                (
                                                <span style="color: orange;font-size:15px;" v-if="event.diffInDays == 0">
                                                    Today</span>
                                                <span style="color: #189483;font-size:15px;"
                                                    v-else-if="event.diffInDays == 1"> Tomorrow</span>
                                                <span style="color: #189483;font-size:15px;"
                                                    v-else-if="event.diffInDays > 1">
                                                    In {{ event.diffInDays }} days</span>
                                                <span style="color: red;font-size:15px;" v-else-if="event.diffInDays < 0">
                                                    Already happened</span>
                                                )
                                            </td>
                                            <td>{{ event.time }}</td>
                                            <td>{{ event.date }}</td>
                                            <td>{{ event.mode }}</td>
                                            <td>
                                                <router-link :to="{
                                                    name: 'ViewEvent',
                                                    params: { slug: event.slug },
                                                }">
                                                    <button type="button" class="btn btn-sm ">
                                                        <small>
                                                            View More 
                                                        </small>
                                                    </button>
                                                </router-link>
                                            </td>
                                            <td v-if="id == 1">
                                                <router-link v-if="event.user_id == id" :to="{
                                                    name: 'EditEvent',
                                                    params: { slug: event.slug },
                                                }"><i class="fa fa-edit" style="color: #189483;"></i>
                                                </router-link>
                                            </td>
                                            <td v-if="id == 1">
                                                <button v-if="event.user_id == id" type="button" @click="destroy(event.id)"
                                                    class="delete-btn"
                                                    style="border:none;outline:none;background: none;">
                                                    <i class="fa fa-trash-o" style="color: red;"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                        </tr>
                                    </tbody>
                                </table>
                                <h5 v-if="!events.length">Sorry, no item found!</h5>
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
            events: [],
            currentPage: 1,
            lastPage: 1,

            title: '',
            searchResults: [],
            //event: {},

            success: false,
            fields: {
                category_id: "",
            },
            errors: {},
            url: "",
            user_id: "",
            links: [],
            categories: [],

            latitude: null,
            longitude: null,

            locations: {},

            post_category: "",
            id: "",
            name: "",
            slug: "",
            currentDateValue: new Date(),
        };
    },

    created() {
        this.eventTitle(this.currentPage);
    },

    methods: {

        searchevent() {
            if (this.title.length > 2) {

                axios.get('/api/searchevent', { params: { q: this.title } })
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
                .post("/api/events", this.fields, {
                    headers: { "content-type": "multipart/form-data" },
                })
                .then(() => {
                    this.fields = {};
                    this.url = null;
                    this.fields.category_id = "";
                    this.success = true;
                    this.errors = {};

                    axios.get("/api/events").then(({
                        data
                    }) => (this.events = data.data));

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
                        .delete("/api/events/" + id)
                        .then((response) => {
                            Swal.fire(
                                'Deleted!',
                                'Information has been successfully deleted.',
                                'success'
                            );
                            // Fire.$emit('AfterCreate');
                            axios.get('/api/events').then(response => {
                                this.events = response.data.data;
                            });
                        }).catch((error) => {
                            Swal.fire("Failed!", error.message, "warning");
                        });
                }
            })
        },


        eventTitle(page) {
            axios
                .get('/api/events?page=' + page, {
                    params: {
                        search: this.title,
                    },
                })
                .then((response) => {
                    this.events = response.data.data.map((event) => {
                        const eventDate = new Date(event.date);
                        const currentDate = this.currentDateValue;

                        const diffInMs = eventDate.getTime() - this.currentDateValue.getTime();
                        const diffInDays = Math.floor(diffInMs / (1000 * 60 * 60 * 24) + 1);
                        event.diffInDays = diffInDays;
                        return event;
                    });
                    this.currentPage = response.data.current_page;
                    this.lastPage = response.data.last_page;
                })
                .catch((error) => {
                    console.log(error);
                });
        },


        getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(position => {
                    this.latitude = position.coords.latitude
                    this.longitude = position.coords.longitude
                })
            } else {
                // geolocation is not supported by the browser
                alert('Geolocation is not supported by this browser.')
            }
        }

    },

    watch: {
        title(page) {
            axios
                .get("/api/events", {
                    params: {
                        page: page,
                        search: this.title,
                    },
                })
                .then((response) => {
                    this.events = response.data.data;
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
                this.name = response.data.name
                this.slug = response.data.slug
            })
            .catch((error) => {
                if (error.response.status === 401) {
                    this.$emit("updateSidebar");
                    localStorage.removeItem("authenticated");
                }
            });

        axios.get('/api/locations')
            .then(response => {
                this.locations = response.data.data;
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