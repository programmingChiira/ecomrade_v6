<template>
    <body class="about-us">
        <section class="my-5 py-5">

            <div class="container">

                <div class="row justify-content-center my-2 py-1">
                    <div class="custom-search">

                        <input v-model="title" @input="searchpoll" type="text" class="custom-search-input"
                            placeholder="Search Poll | Argument..." name="searchpoll">
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
                                    <li style="color: #189483;" class="breadcrumb-item"><strong>Polls</strong></li>
                                </ol>
                                <div v-if="lastPage > 1" class="pagination">
                                    <button class="btn bg-gradient-primary btn-sm" style="margin: 4px;"
                                        v-if="currentPage > 1" @click="pollTitle(currentPage - 1)">&laquo; Prev</button>

                                    <button class="btn bg-gradient-primary btn-sm" style="margin: 4px;"
                                        v-if="currentPage < lastPage" @click="pollTitle(currentPage + 1)">
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
                                                <div class="form-check font-size-16"><input type="checkbox"
                                                        class="form-check-input" id="contacusercheck" /><label
                                                        class="form-check-label" for="contacusercheck"></label></div>
                                            </th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Argument</th>
                                            <th v-if="id == 1" scope="col">Edit</th>
                                            <th v-if="id == 1" scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(poll, index) in polls" :key="index">
                                            <th scope="row" class="ps-4">
                                                <div class="form-check font-size-16"><input type="checkbox"
                                                        class="form-check-input" id="contacusercheck1" /><label
                                                        class="form-check-label" for="contacusercheck1"></label></div>
                                            </th>
                                            <td><span class="badge badge-soft-success mb-0"> {{ poll.title }} </span>
                                            </td>
                                            <td> {{ poll.argument }} </td>
                                            <td v-if="id == 1">
                                                <router-link :to="{
                                                    name: 'EditPoll',
                                                    params: { slug: poll.slug },
                                                }"><i class="fa fa-edit" style="color: #189483;"></i>
                                                </router-link>
                                            </td>
                                            <td v-if="id == 1">
                                                <button type="button" @click="destroy(poll.id)"
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
                                <h5 v-if="!polls.length">Sorry, no item found!</h5>
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

export default {

    components: {
        Footer
    },
    emits: ["updateSidebar"],
    data() {
        return {
            polls: [],
            currentPage: 1,
            lastPage: 1,

            title: '',
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

            poll_category: "",
            id: "",
            name: "",
        };
    },

    created() {
        this.pollTitle(this.currentPage);
    },

    computed: {
        pollName: {
            get() {
                return this.fields.title = this.poll.title;
            },
            set(value) {
                this.fields.title = value;
            }
        },
    },

    methods: {
        searchpoll() {
            if (this.title.length > 2) {

                axios.get('/api/searchpoll', { params: { q: this.title } })
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

        submit1(poll) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#189483',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Proceed to vote'
            }).then((result) => {

                // Send request to the server
                if (result.value) {
                    axios
                        .post("/api/votes", { "user_id": poll.user_id, "id": poll.id, "title": poll.title, "option": poll.option_1 }, {
                            headers: { "content-type": "multipart/form-data" },
                        })
                        .then(() => {
                            this.fields = {};
                            this.url = null;
                            this.fields.category_id = "";
                            this.success = true;
                            this.errors = {};

                            axios.get('/api/polls')
                                .then(response => {
                                    this.polls = response.data.data;
                                })
                                .catch(error => {
                                    console.log(error);
                                });

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '<strong> Voted</strong>',
                                showConfirmButton: false,
                                timer: 1500
                            })


                            setTimeout(() => {
                                this.success = false;
                            }, 2500);

                        })
                        .catch((error) => {
                            this.errors = error.response.data.errors;
                            this.success = false;
                        });
                }
            })

        },

        submit2(poll) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#189483',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Proceed to vote'
            }).then((result) => {

                // Send request to the server
                if (result.value) {
                    axios
                        .post("/api/votes", { "user_id": poll.user_id, "id": poll.id, "title": poll.title, "option": poll.option_2 }, {
                            headers: { "content-type": "multipart/form-data" },
                        })
                        .then(() => {
                            this.fields = {};
                            this.url = null;
                            this.fields.category_id = "";
                            this.success = true;
                            this.errors = {};

                            axios.get('/api/polls')
                                .then(response => {
                                    this.polls = response.data.data;
                                })
                                .catch(error => {
                                    console.log(error);
                                });

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '<strong> Voted</strong>',
                                showConfirmButton: false,
                                timer: 1500
                            })


                            setTimeout(() => {
                                this.success = false;
                            }, 2500);

                        })
                        .catch((error) => {
                            this.errors = error.response.data.errors;
                            this.success = false;
                        });
                }
            })

        },

        submit3(poll) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#189483',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Proceed to vote'
            }).then((result) => {

                // Send request to the server
                if (result.value) {
                    axios
                        .post("/api/votes", { "user_id": poll.user_id, "id": poll.id, "title": poll.title, "option": poll.option_3 }, {
                            headers: { "content-type": "multipart/form-data" },
                        })
                        .then(() => {
                            this.fields = {};
                            this.url = null;
                            this.fields.category_id = "";
                            this.success = true;
                            this.errors = {};

                            axios.get('/api/polls')
                                .then(response => {
                                    this.polls = response.data.data;
                                })
                                .catch(error => {
                                    console.log(error);
                                });

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '<strong> Voted</strong>',
                                showConfirmButton: false,
                                timer: 1500
                            })


                            setTimeout(() => {
                                this.success = false;
                            }, 2500);

                        })
                        .catch((error) => {
                            this.errors = error.response.data.errors;
                            this.success = false;
                        });
                }
            })

        },

        submit4(poll) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#189483',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Proceed to vote'
            }).then((result) => {

                // Send request to the server
                if (result.value) {
                    axios
                        .post("/api/votes", { "user_id": poll.user_id, "id": poll.id, "title": poll.title, "option": poll.option_4 }, {
                            headers: { "content-type": "multipart/form-data" },
                        })
                        .then(() => {
                            this.fields = {};
                            this.url = null;
                            this.fields.category_id = "";
                            this.success = true;
                            this.errors = {};

                            axios.get('/api/polls')
                                .then(response => {
                                    this.polls = response.data.data;
                                })
                                .catch(error => {
                                    console.log(error);
                                });

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '<strong> Voted</strong>',
                                showConfirmButton: false,
                                timer: 1500
                            })


                            setTimeout(() => {
                                this.success = false;
                            }, 2500);

                        })
                        .catch((error) => {
                            this.errors = error.response.data.errors;
                            this.success = false;
                        });
                }
            })

        },

        submit5(poll) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#189483',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Proceed to vote'
            }).then((result) => {

                // Send request to the server
                if (result.value) {
                    axios
                        .post("/api/votes", { "user_id": poll.user_id, "id": poll.id, "title": poll.title, "option": poll.option_5 }, {
                            headers: { "content-type": "multipart/form-data" },
                        })
                        .then(() => {
                            this.fields = {};
                            this.url = null;
                            this.fields.category_id = "";
                            this.success = true;
                            this.errors = {};

                            axios.get('/api/polls')
                                .then(response => {
                                    this.polls = response.data.data;
                                })
                                .catch(error => {
                                    console.log(error);
                                });

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '<strong> Voted</strong>',
                                showConfirmButton: false,
                                timer: 1500
                            })


                            setTimeout(() => {
                                this.success = false;
                            }, 2500);

                        })
                        .catch((error) => {
                            this.errors = error.response.data.errors;
                            this.success = false;
                        });
                }
            })

        },

        submit6(poll) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#189483',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Proceed to vote'
            }).then((result) => {

                // Send request to the server
                if (result.value) {
                    axios
                        .post("/api/votes", { "user_id": poll.user_id, "id": poll.id, "title": poll.title, "option": poll.option_6 }, {
                            headers: { "content-type": "multipart/form-data" },
                        })
                        .then(() => {
                            this.fields = {};
                            this.url = null;
                            this.fields.category_id = "";
                            this.success = true;
                            this.errors = {};

                            axios.get('/api/polls')
                                .then(response => {
                                    this.polls = response.data.data;
                                })
                                .catch(error => {
                                    console.log(error);
                                });

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '<strong> Voted</strong>',
                                showConfirmButton: false,
                                timer: 1500
                            })


                            setTimeout(() => {
                                this.success = false;
                            }, 2500);

                        })
                        .catch((error) => {
                            this.errors = error.response.data.errors;
                            this.success = false;
                        });
                }
            })

        },

        submit7(poll) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#189483',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Proceed to vote'
            }).then((result) => {

                // Send request to the server
                if (result.value) {
                    axios
                        .post("/api/votes", { "user_id": poll.user_id, "id": poll.id, "title": poll.title, "option": poll.option_7 }, {
                            headers: { "content-type": "multipart/form-data" },
                        })
                        .then(() => {
                            this.fields = {};
                            this.url = null;
                            this.fields.category_id = "";
                            this.success = true;
                            this.errors = {};

                            axios.get('/api/polls')
                                .then(response => {
                                    this.polls = response.data.data;
                                })
                                .catch(error => {
                                    console.log(error);
                                });

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '<strong> Voted</strong>',
                                showConfirmButton: false,
                                timer: 1500
                            })


                            setTimeout(() => {
                                this.success = false;
                            }, 2500);

                        })
                        .catch((error) => {
                            this.errors = error.response.data.errors;
                            this.success = false;
                        });
                }
            })

        },

        submit8(poll) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#189483',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Proceed to vote'
            }).then((result) => {

                // Send request to the server
                if (result.value) {
                    axios
                        .post("/api/votes", { "user_id": poll.user_id, "id": poll.id, "title": poll.title, "option": poll.option_8 }, {
                            headers: { "content-type": "multipart/form-data" },
                        })
                        .then(() => {
                            this.fields = {};
                            this.url = null;
                            this.fields.category_id = "";
                            this.success = true;
                            this.errors = {};

                            axios.get('/api/polls')
                                .then(response => {
                                    this.polls = response.data.data;
                                })
                                .catch(error => {
                                    console.log(error);
                                });

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '<strong> Voted</strong>',
                                showConfirmButton: false,
                                timer: 1500
                            })


                            setTimeout(() => {
                                this.success = false;
                            }, 2500);

                        })
                        .catch((error) => {
                            this.errors = error.response.data.errors;
                            this.success = false;
                        });
                }
            })

        },

        submit9(poll) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#189483',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Proceed to vote'
            }).then((result) => {

                // Send request to the server
                if (result.value) {
                    axios
                        .post("/api/votes", { "user_id": poll.user_id, "id": poll.id, "title": poll.title, "option": poll.option_9 }, {
                            headers: { "content-type": "multipart/form-data" },
                        })
                        .then(() => {
                            this.fields = {};
                            this.url = null;
                            this.fields.category_id = "";
                            this.success = true;
                            this.errors = {};

                            axios.get('/api/polls')
                                .then(response => {
                                    this.polls = response.data.data;
                                })
                                .catch(error => {
                                    console.log(error);
                                });

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '<strong> Voted</strong>',
                                showConfirmButton: false,
                                timer: 1500
                            })


                            setTimeout(() => {
                                this.success = false;
                            }, 2500);

                        })
                        .catch((error) => {
                            this.errors = error.response.data.errors;
                            this.success = false;
                        });
                }
            })

        },

        submit10(poll) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#189483',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Proceed to vote'
            }).then((result) => {

                // Send request to the server
                if (result.value) {
                    axios
                        .post("/api/votes", { "user_id": poll.user_id, "id": poll.id, "title": poll.title, "option": poll.option_10 }, {
                            headers: { "content-type": "multipart/form-data" },
                        })
                        .then(() => {
                            this.fields = {};
                            this.url = null;
                            this.fields.category_id = "";
                            this.success = true;
                            this.errors = {};

                            axios.get('/api/polls')
                                .then(response => {
                                    this.polls = response.data.data;
                                })
                                .catch(error => {
                                    console.log(error);
                                });

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '<strong> Voted</strong>',
                                showConfirmButton: false,
                                timer: 1500
                            })


                            setTimeout(() => {
                                this.success = false;
                            }, 2500);

                        })
                        .catch((error) => {
                            this.errors = error.response.data.errors;
                            this.success = false;
                        });
                }
            })

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
                        .delete("/api/polls/" + id)
                        .then((response) => {
                            Swal.fire(
                                'Deleted!',
                                'Information has been successfully deleted.',
                                'success'
                            );
                            // Fire.$emit('AfterCreate');
                            axios.get('/api/polls').then(response => {
                                this.polls = response.data.data;
                            });
                        }).catch((error) => {
                            Swal.fire("Failed!", error.message, "warning");
                        });
                }
            })
        },

        pollTitle(page) {
            axios
                .get('/api/polls?page=' + page, {
                    params: {
                        search: this.title,
                    },
                })
                .then((response) => {
                    this.polls = response.data.data;
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
                .get("/api/polls", {
                    params: {
                        page: page,
                        search: this.title,
                    },
                })
                .then((response) => {
                    this.polls = response.data.data;
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
            })
            .catch((error) => {
                if (error.response.status === 401) {
                    this.$emit("updateSidebar");
                    localStorage.removeItem("authenticated");
                }
            });

        axios.get('/api/polls')
            .then(response => {
                this.polls = response.data.data;
            })
            .catch(error => {
                console.log(error);
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

.option-wrapper {
    display: flex;
    align-items: center;
}

.option-image {
    flex: 0 0 auto;
    margin-right: 16px;
    width: 100px;
    height: 100px;
    object-fit: cover;
    background-color: white;
    border-radius: 50%;
    overflow: hidden;
}

.option-content {
    flex: 1 1 auto;
    display: flex;
    flex-direction: column;
}

.wrapper {
    padding: 30px;
    background: #fff;
    width: 100%;
    box-shadow: 1px 1px 5px 1px rgba(0, 0, 0, 0.1);
}

.wrapper header {
    font-size: 22px;
    font-weight: 600;
}

.wrapper .poll-area {
    margin: 20px 0 15px 0;
}

.poll-area label {
    display: block;
    margin-bottom: 10px;
    padding: 8px 15px;
    border: 2px solid #e6e6e6;
    transition: all 0.2s ease;
    border-radius: 10px;
}

label.opt-1.selected {
    border: 2px solid #cf2d00;
}

label.opt-2.selected {
    border: 2px solid #4bcc00;
}

label.opt-3.selected {
    border: 2px solid #cfbd00;
}

label.opt-4.selected {
    border: 2px solid #01638c;
}

label.opt-5.selected {
    border: 2px solid #0f018c;
}

label.opt-6.selected {
    border: 2px solid #42018c;
}

label.opt-7.selected {
    border: 2px solid #8c0165;
}

label.opt-8.selected {
    border: 2px solid #000000;
}

label.opt-9.selected {
    border: 2px solid #996633;
}

label.opt-10.selected {
    border: 2px solid #006600;
}

div#pstyle1::after {
    background: #cf2d00 !important;
}

div#pstyle2::after {
    background: #4bcc00 !important;
}

div#pstyle3::after {
    background: #cfbd00 !important;
}

div#pstyle4::after {
    background: #01638c !important;
}

div#pstyle5::after {
    background: #0f018c !important;
}

div#pstyle6::after {
    background: #42018c !important;
}

div#pstyle7::after {
    background: #8c0165 !important;
}

div#pstyle8::after {
    background: #000000 !important;
}

div#pstyle9::after {
    background: #996633 !important;
}

div#pstyle10::after {
    background: #006600 !important;
}

label.opt-1.selected .row .circle {
    border-color: #cf2d00 !important;
}

label.opt-2.selected .row .circle {
    border-color: #4bcc00 !important;
}

label.opt-3.selected .row .circle {
    border-color: #cfbd00 !important;
}

label.opt-4.selected .row .circle {
    border-color: #01638c !important;
}

label.opt-5.selected .row .circle {
    border-color: #0f018c !important;
}

label.opt-6.selected .row .circle {
    border-color: #42018c !important;
}

label.opt-7.selected .row .circle {
    border-color: #8c0165 !important;
}

label.opt-8.selected .row .circle {
    border-color: #000000 !important;
}

label.opt-9.selected .row .circle {
    border-color: #996633 !important;
}

label.opt-10.selected .row .circle {
    border-color: #006600 !important;
}

label.opt-1 .row .circle::after {
    background: #cf2d00 !important;
}

label.opt-2 .row .circle::after {
    background: #4bcc00 !important;
}

label.opt-3 .row .circle::after {
    background: #cfbd00 !important;
}

label.opt-4 .row .circle::after {
    background: #01638c !important;
}

label.opt-5 .row .circle::after {
    background: #0f018c !important;
}

label.opt-6 .row .circle::after {
    background: #42018c !important;
}

label.opt-7 .row .circle::after {
    background: #8c0165 !important;
}

label.opt-8 .row .circle::after {
    background: #000000 !important;
}

label.opt-9 .row .circle::after {
    background: #996633 !important;
}

label.opt-10 .row .circle::after {
    background: #006600 !important;
}

label .row {
    display: flex;
    pointer-events: none;
    justify-content: space-between;
}

label .row .column {
    display: flex;
    align-items: center;
}

label .row .circle {
    height: 19px;
    width: 19px;
    display: block;
    border: 2px solid #ccc;
    border-radius: 50%;
    margin-right: 10px;
    position: relative;
}

label .row .circle::after {
    content: "";
    height: 11px;
    width: 11px;
    border-radius: inherit;
    position: absolute;
    left: 2px;
    top: 2px;
    display: none;
}

.poll-area label:hover .row .circle::after {
    display: block;
    background: #e6e6e6;
}

label.selected .row .circle::after {
    display: block;
}

label .row span {
    font-size: 16px;
    font-weight: 500;
}

label .row .percent {
    display: show;
}

label .progress {
    height: 7px;
    width: 100%;
    position: relative;
    background: #f0f0f0;
    margin: 8px 0 3px 0;
    border-radius: 30px;
    pointer-events: none;
}

label .progress:after {
    position: absolute;
    content: "";
    height: 100%;
    background: #ccc;
    width: calc(1% * var(--w));
    border-radius: inherit;
    transition: all 0.2s ease;
}

label.selectall .progress,
label.selectall .row .percent {
    display: block;
}

input[type="radio"],
input[type="checkbox"] {
    display: none;
}
</style>