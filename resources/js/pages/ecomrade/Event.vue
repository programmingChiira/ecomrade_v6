<template>
    <body class="index-page">
        <Loader/>
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

                            <button data-toggle="tooltip" data-placement="bottom" title="Location" data-bs-toggle="modal"
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

                <div class="row">
                    <div class="row">
                        <div class="col-md-4 col-10">
                            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                                <div class="container">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                                        <li style="color: #189483;" class="breadcrumb-item"><strong>Events</strong></li>
                                    </ol>
                                </div>
                            </nav>
                        </div>
                        <div style="float:right;" class="col-md-8 col-2">
                            <router-link v-if="id == false" to="/login" style="float: right;"
                                class="text-info icon-move-right">
                                <button data-toggle="tooltip" data-placement="bottom" title="Create event" type="button"
                                    class="btn bg-gradient-primary btn-sm">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </router-link>

                            <router-link v-else to="/createEvent" style="float: right;" class="text-info icon-move-right">
                                <button data-toggle="tooltip" data-placement="bottom" title="Create event" type="button"
                                    class="btn bg-gradient-primary btn-sm">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </router-link>
                        </div>
                    </div>
                </div>

                    <div class="row justify-content-center my-2 py-1">
                        <div class="col-md-4 col-12" v-for="event in events" :key="event.id">
                            <div style="margin: 10px;background-color: #E9ECEF;" class="card">
                                <img v-if="event.image_1 == false || event.image_1 == null || event.image_1 == 'null' || event.image_1 == '' || event.image_1 == ' ' || event.image_1 == NULL"
                                    loading="lazy"
                                    style="background-color: white;width: 100%;height: 300px; object-fit: cover;"
                                    src="/web/img/no_img.jpg" class="card-img-top" width="100%">

                                <img v-else style="background-color: white;width: 100%;height: 300px; object-fit: cover;"
                                    :src="'./img/event/' + event.image_1" class="card-img-top" width="100%">


                                <div class="card-body pt-0 px-0">
                                    <br />

                                    <div class="d-flex flex-row justify-content-between p-3 mid">
                                        <div class="d-flex flex-column">
                                            <h4 style="padding: 10px;">{{ event.title }}</h4>
                                            <h4 style="padding: 10px;">
                                                (
                                                <span style="color: orange;font-size:15px;" v-if="event.diffInDays == 0">
                                                    Today</span>
                                                <span style="color: #189483;font-size:15px;"
                                                    v-else-if="event.diffInDays == 1"> Tomorrow</span>
                                                <span style="color: #189483;font-size:15px;"
                                                    v-else-if="event.diffInDays > 1">
                                                    In {{ event.diffInDays }} days</span>
                                                <span style="color: red;font-size:15px;" v-else-if="event.diffInDays < 0">
                                                    Already Happened</span>
                                                )
                                            </h4>

                                            <h5 class="text-muted mb-1">Entry 
                                                <small style="text-decoration: underline;color:#189483;" class="ghj">
                                                {{ event.entry }}
                                                </small>
                                            </h5>
                                            <div class="d-flex flex-row">
                                                <div class="d-flex flex-column ml-1">
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-column">
                                            
                                        </div>
                                    </div>

                                    <hr class="mt-2 mx-3">
                                    <div class="d-flex flex-row justify-content-between p-3 mid">
                                        <div class="d-flex flex-column">
                                            <strong class="text-muted mb-1">Time</strong>
                                            <div class="d-flex flex-row">
                                                <div class="d-flex flex-column ml-1">
                                                    <small style="text-decoration: underline;" class="ghj"> {{ event.time }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-column">
                                            <strong class="text-muted mb-1">Date</strong>
                                            <div class="d-flex flex-row">
                                                <div class="d-flex flex-column ml-1">
                                                    <small style="text-decoration: underline;" class="ghj"> {{ event.date }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-column">
                                            <strong class="text-muted mb-1">Mode</strong>
                                            <div class="d-flex flex-row">
                                                <div class="d-flex flex-column ml-1">
                                                    <small style="text-decoration: underline;" class="ghj"> {{ event.mode }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row justify-content-between p-3 mid">
                                        <div class="d-flex flex-column">
                                            <button v-if="event.user_id == id || id == 1" type="button"
                                                @click="destroy(event.id)" class="delete-btn"
                                                style="float: left;border:none;outline:none;background: none;">
                                                <i class="fa fa-trash-o" style="color: red;"></i>
                                            </button>
                                        </div>

                                        <div class="d-flex flex-column">
                                            <router-link :to="{
                                                name: 'ViewEvent',
                                                params: { slug: event.slug },
                                            }">
                                                <button type="button" class="btn bg-gradient-primary btn-sm "><small> View
                                                        More </small></button>
                                            </router-link>
                                        </div>

                                        <div class="d-flex flex-column">
                                            <router-link style="float: right;" v-if="event.user_id == id || id == 1" :to="{
                                                name: 'EditEvent',
                                                params: { slug: event.slug },
                                            }"><i class="fa fa-edit" style="color: #189483;"></i>
                                            </router-link>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <h5 v-if="!events.length">Sorry, no item found!</h5>
                    </div>

                    <br /><br />
                    <div v-if="lastPage > 1" class="pagination">
                        <button class="btn bg-gradient-primary btn-sm" style="margin: 4px;" v-if="currentPage > 1"
                            @click="eventTitle(currentPage - 1)">&laquo; Prev</button>

                        <button class="btn bg-gradient-primary btn-sm" style="margin: 4px;" v-if="currentPage < lastPage"
                            @click="eventTitle(currentPage + 1)">Next &raquo;</button>
                    </div>

            </div>
            <hr class="horizontal dark my-5">
        </section>
        <!-- END Section Content -->
        <!-- <div>
            <button class="btn bg-gradient-primary btn-sm" @click="getLocation">Get Location</button>
            <p>Latitude: {{ latitude }}</p>
            <p>Longitude: {{ longitude }}</p>
        </div> -->

        <!-- -------   START PRE-FOOTER 2 - simple social line w/ title & 3 buttons    -------- -->

        <Footer />
    </body>
</template>

<script>
import Footer from './Footer.vue'
import Loader from './Loader.vue'

import axios from 'axios';

import Cookies from 'js-cookie';

export default {

    components: {
        Footer,
        Loader,
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