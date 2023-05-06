<template>
    <body class="about-us">
        <section class="my-5 py-5">

            <div class="container">

                <div class="row justify-content-center my-2 py-1">
                    <div class="custom-search">
                        <input v-model="user_name" @input="searchuser" type="text" class="custom-search-input"
                            placeholder="Search For User | Role | Gender..." name="searchuser">
                        <br>
                        <br>
                        <div class="search-results-container" v-if="searchResults.length > 0"
                            style="background-color: rgb(250, 250, 250); border: none; border-radius: 5px;">
                            <br>
                            <ul style="padding: 20px;" class="search-results">
                                <li style="margin: 13px;" v-for="user in searchResults" :key="user.id">
                                    <input style="background-color: rgb(250, 250, 250);border:none;color:#189483;"
                                        type="button" @click="selectItem(user)" :value="user.user_name">
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
                                    <li class="breadcrumb-item"><router-link to="/dashboard">Dash</router-link></li>
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
                                            <th scope="col">Phone</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Youtube</th>
                                            <th scope="col">Instagram</th>
                                            <th scope="col">Twitter</th>
                                            <th scope="col">Facebook</th>
                                            <th scope="col">LinkedIn</th>
                                            <th scope="col">GitHub</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Area</th>
                                            <th scope="col">Campus</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">View User</th>
                                            <th v-if="id == 1" scope="col">Edit</th>
                                            <th v-if="id == 1" scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="user in users" :key="user.id">
                                            <th scope="row" class="ps-4">
                                                <div class="form-check font-size-16"><input type="checkbox"
                                                        class="form-check-input" id="contacusercheck1" /><label
                                                        class="form-check-label" for="contacusercheck1"></label></div>
                                            </th>
                                            <td><span class="badge badge-soft-success mb-0"> {{ user.name }} </span>
                                            </td>
                                            <td> {{ user.phone }} </td>
                                            <td> {{ user.email }} </td>
                                            <td> {{ user.type }} </td>
                                            <td> {{ user.youtube }} </td>
                                            <td> {{ user.Instagram }} </td>
                                            <td> {{ user.twitter }} </td>
                                            <td> {{ user.facebook }} </td>
                                            <td> {{ user.linkedin }} </td>
                                            <td> {{ user.github }} </td>
                                            <td> {{ user.title }} </td>
                                            <td> {{ user.personal_description }} </td>
                                            <td> {{ user.campus_area }} </td>
                                            <td> {{ user.campus }} </td>
                                            <td> {{ user.gender }} </td>
                                            <td>
                                                <router-link class="btn btn-sm" @click="visible = !visible" :to="{
                                                    name: 'Profile',
                                                    params: { slug: user.slug },
                                                  }">
                                                    <i class="fa fa-user me-1"></i>
                                                  </router-link>
                                            </td>
                                            <td v-if="id == 1">
                                                <router-link :to="{
                                                    name: 'EditProfile',
                                                    params: { slug: user.slug },
                                                }"><i class="fa fa-edit" style="color: #189483;"></i>
                                                </router-link>
                                            </td>
                                            <td v-if="id == 1">
                                                <button type="button"
                                                    @click="destroy(user.id)" class="delete-btn"
                                                    style="border:none;outline:none;background: none;">
                                                    <i class="fa fa-trash-o" style="color: red;"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                        </tr>
                                    </tbody>
                                </table>
                                <h5 v-if="!users.length">Sorry, no item found!</h5>
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
            users: [],
            currentPage: 1,
            lastPage: 1,

            user_name: '',
            searchResults: [],
            //market: {},

            success: false,
            fields: {
                category_id: "",
            },
            errors: {},
            links: [],

            id: "",
            name: "",
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

        truncateText(users) {
            const truncatedText = users.slice(0, 10) + '...'
            return truncatedText
        },
        searchuser() {
            if (this.user_name.length > 2) {

                axios.get('/api/searchuser', { params: { q: this.user_name } })
                    .then(response => {
                        this.searchResults = response.data;
                    });
            } else {
                this.searchResults = [];
            }
        },

        selectItem(item) {
            this.user_name = item.user_name;
            this.searchResults = [];
        },
        submit() {
            axios
                .user("/api/users", this.fields, {
                    headers: { "content-type": "multipart/form-data" },
                })
                .then(() => {
                    this.fields = {};
                    this.success = true;
                    this.errors = {};

                    axios.get("/api/users").then(({
                        data
                    }) => (this.users = data.data));

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
                        .delete("/api/users/" + id)
                        .then((response) => {
                            Swal.fire(
                                'Deleted!',
                                'Information has been successfully deleted.',
                                'success'
                            );
                            // Fire.$emit('AfterCreate');
                            axios.get('/api/users').then(response => {
                                this.users = response.data.data;
                            });
                        }).catch((error) => {
                            Swal.fire("Failed!", error.message, "warning");
                        });
                }
            })
        },

        userName(page) {
            axios
                .get('/api/users?page=' + page, {
                    params: {
                        search: this.user_name,
                    },
                })
                .then((response) => {
                    this.users = response.data.data;
                    this.currentPage = response.data.current_page;
                    this.lastPage = response.data.last_page;
                })
                .catch((error) => {
                    console.log(error);
                });

        },

    },

    watch: {
        user_name(page) {
            axios
                .get("/api/users", {
                    params: {
                        page: page,
                        search: this.user_name,
                    },
                })
                .then((response) => {
                    this.users = response.data.data;
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



.cls-1 {
    fill: #ffc541;
  }
  
  .cls-2 {
    fill: #4e4066;
  }
  
  .cls-3 {
    fill: #6f5b92;
  }
  
  .cls-4 {
    fill: #f78d5e;
  }
  
  .cls-5 {
    fill: #fa976c;
  }
  
  .cls-6,
  .cls-7,
  .cls-8 {
    fill: #b65c32;
  }
  
  .cls-10,
  .cls-6 {
    opacity: 0.6;
  }
  
  .cls-7 {
    opacity: 0.4;
  }
  
  .cls-9 {
    fill: #f4b73b;
  }
  
  .cls-11 {
    fill: #f9c358;
  }
  
  .cls-12 {
    fill: #9b462c;
  }
  
  .cls-13 {
    fill: #aa512e;
  }
  
  .cls-14 {
    fill: #7d6aa5;
  }
  
  
  /* animations */
  
  .wheel {
    animation: wheel-rotate 6s ease infinite;
    transform-origin: center;
    transform-box: fill-box;
  }
  
  @keyframes wheel-rotate {
    50% {
      transform: rotate(360deg);
      animation-timing-function: cubic-bezier(0.55, 0.085, 0.68, 0.53);
    }
  
    100% {
      transform: rotate(960deg)
    }
  }
  
  .clock-hand-1 {
    animation: clock-rotate 3s linear infinite;
    transform-origin: bottom;
    transform-box: fill-box;
  }
  
  .clock-hand-2 {
    animation: clock-rotate 6s linear infinite;
    transform-origin: bottom;
    transform-box: fill-box;
  }
  
  @keyframes clock-rotate {
    100% {
      transform: rotate(360deg)
    }
  }
  
  #box-top {
    animation: box-top-anim 2s linear infinite;
    transform-origin: right top;
    transform-box: fill-box;
  }
  
  @keyframes box-top-anim {
    50% {
      transform: rotate(-5deg)
    }
  }
  
  #umbrella {
    animation: umbrella-anim 6s linear infinite;
    transform-origin: center;
    transform-box: fill-box;
  }
  
  @keyframes umbrella-anim {
    25% {
      transform: translateY(10px) rotate(5deg);
    }
  
    75% {
      transform: rotate(-5deg);
    }
  }
  
  #cup {
    animation: cup-rotate 3s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite;
    transform-origin: top left;
    transform-box: fill-box;
  }
  
  @keyframes cup-rotate {
    50% {
      transform: rotate(-5deg)
    }
  }
  
  #pillow {
    animation: pillow-anim 3s linear infinite;
    transform-origin: center;
    transform-box: fill-box;
  }
  
  @keyframes pillow-anim {
    25% {
      transform: rotate(10deg) translateY(5px)
    }
  
    75% {
      transform: rotate(-10deg)
    }
  }
  
  #stripe {
    animation: stripe-anim 3s linear infinite;
    transform-origin: center;
    transform-box: fill-box;
  }
  
  @keyframes stripe-anim {
    25% {
      transform: translate(10px, 0) rotate(-10deg)
    }
  
    75% {
      transform: translateX(10px)
    }
  }
  
  #bike {
    animation: bike-anim 6s ease infinite;
  }
  
  @keyframes bike-anim {
    0% {
      transform: translateX(-1300px)
    }
  
    50% {
      transform: translateX(0);
      animation-timing-function: cubic-bezier(0.47, 0, 0.745, 0.715);
    }
  
    100% {
      transform: translateX(1300px)
    }
  }
  
  #rucksack {
    animation: ruck-anim 3s linear infinite;
    transform-origin: top;
    transform-box: fill-box;
  }
  
  @keyframes ruck-anim {
    50% {
      transform: rotate(5deg)
    }
  }
  
  .circle {
    animation: circle-anim ease infinite;
    transform-origin: center;
    transform-box: fill-box;
    perspective: 0px;
  }
  
  .circle.c1 {
    animation-duration: 2s
  }
  
  .circle.c2 {
    animation-duration: 3s
  }
  
  .circle.c3 {
    animation-duration: 1s
  }
  
  .circle.c4 {
    animation-duration: 1s
  }
  
  .circle.c5 {
    animation-duration: 2s
  }
  
  .circle.c6 {
    animation-duration: 3s
  }
  
  @keyframes circle-anim {
    50% {
      transform: scale(.2) rotateX(360deg) rotateY(360deg)
    }
  }
  
  .four,
  #ou {
    animation: four-anim cubic-bezier(0.39, 0.575, 0.565, 1) infinite;
  }
  
  .four.a {
    transform-origin: bottom left;
    animation-duration: 3s;
    transform-box: fill-box;
  }
  
  .four.b {
    transform-origin: bottom right;
    animation-duration: 3s;
    transform-box: fill-box;
  }
  
  #ou {
    animation-duration: 6s;
    transform-origin: center;
    transform-box: fill-box;
  }
  
  @keyframes four-anim {
    50% {
      transform: scale(.98)
    }
  }
</style>