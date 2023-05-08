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
                                    <li class="breadcrumb-item"><router-link to="/event">Events</router-link></li>
                                    <li style="color: #189483;" class="breadcrumb-item"><strong>{{ club.name }} Events</strong></li>
                                </ol>
                            </div>
                        </nav>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-6" v-for="event in events" :key="event.id" v-show="event.club_id == club.id">
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
                                            <h4 style="padding: 10px;">{{ event.title }}
                                            </h4>
                                        </div>

                                        <div class="d-flex flex-column">
                                            <h5 class="text-muted mb-1">Entry</h5>
                                            <div class="d-flex flex-row">
                                                <div class="d-flex flex-column ml-1">
                                                    <small style="text-decoration: underline;color:#189483;" class="ghj"> {{
                                                        event.entry }}</small>
                                                </div>
                                            </div>
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
                                            <button v-if="event.user_id == id" type="button" @click="destroy(event.id)"
                                                class="delete-btn"
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
                                            <router-link style="float: right;" v-if="event.user_id == id" :to="{
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

            </div>
            <hr class="horizontal dark my-5">
        </section>

        <Footer />
    </body>
</template>

<script>
import Footer from './Footer.vue';
export default {
    components: {
        Footer
    },
    emits: ["updateSidebar"],
    props: ["slug"],
    data() {
        return {

            showInput: 0,

            disappear2: true,
            input2: false,
            disappear3: false,
            input3: false,
            disappear4: false,
            input4: false,
            disappear5: false,
            input5: false,

            file1: null,
            file2: null,
            file3: null,
            file4: null,

            club: {},
            success: false,
            fields: {
                event_category: "",
            },
            errors: {},
            url1: "",
            url2: "",
            url3: "",
            url4: "",
            url5: "",
            categories: [],

            id: "",
            name: "",

            events: [],
            currentPage: 1,
            lastPage: 1,

            title: '',
            searchResults: [],
            //market: {},

            success: false,
            errors: {},
            url: "",
            user_id: "",
            links: [],
        };
    },

    created() {
        this.eventName(this.currentPage);
    },

    methods: {

        selectItem(item) {
            this.title = item.title;
            this.searchResults = [];
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


        eventName(page) {
            axios
                .get('/api/events?page=' + page, {
                    params: {
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

        axios
            .get("/api/categories")
            .then((response) => (this.categories = response.data))
            .catch((error) => {
                console.log(error);
            });

    },
};
</script>