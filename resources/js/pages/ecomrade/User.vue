<template>
    <body class="about-us">
        <Loader/>
        <section class="my-5 py-5">
            <div class="wrapperr">
                <div style="background-color: #E9ECEF;" class="profile-card js-profile-card">
                    <div class="profile-card__img">
                        <a data-bs-toggle="modal" data-bs-target="#exampleModal" href="javascript:;">
                            <img v-if="user.profile_pic == false || user.profile_pic == null || user.profile_pic == 'null' || user.profile_pic == '' || user.profile_pic == ' '"
                                src="/web/img/no_img.jpg" alt="profile card">
                            <img v-else :src="'./img/profiles/' + user.profile_pic" alt="profile card">
                        </a>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-sm-3 col-6 mx-auto">
                                <!-- Button trigger modal -->
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"> Profile Pic</h5>
                                                <button type="button" class="btn-close btn bg-gradient-dark"
                                                    data-bs-dismiss="modal" aria-label="Close"> <i style="font-size: 12px;"
                                                        class="fa fa-times"></i> </button>
                                            </div>
                                            <div class="modal-body">
                                                <img style="width: 100%;"
                                                    v-if="user.profile_pic == false || user.profile_pic == null || user.profile_pic == 'null' || user.profile_pic == '' || user.profile_pic == ' '"
                                                    src="/web/img/no_img.jpg" alt="profile card">
                                                <img style="width: 100%;" v-else :src="'./img/profiles/' + user.profile_pic"
                                                    alt="profile card">


                                                <div class="profile-card-loc">
                                                    <span class="profile-card-loc__txt">
                                                        <span
                                                            v-if="user.personal_description == false || user.personal_description == null || user.personal_description == 'null' || user.personal_description == '' || user.personal_description == ' '">
                                                            "No Personal description" :-
                                                        </span>
                                                        <span v-else> " <i>{{ user.personal_description }}</i> "
                                                            :-</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="background-color: #E9ECEF;" class="profile-card__cnt js-profile-cnt">
                        <div class="profile-card__name"> {{ user.name }}</div>

                        <div class="profile-card__txt">
                            <span
                                v-if="user.title == false || user.title == null || user.title == 'null' || user.title == '' || user.title == ' ' || user.title == 'undefined'">
                            </span>

                            <strong v-else>{{ user.title }}</strong>
                        </div>


                        <div class="profile-card-loc">
                            <span class="profile-card-loc__txt">
                                <span
                                    v-if="user.campus == false || user.campus == null || user.campus == 'null' || user.campus == '' || user.campus == ' '">
                                </span>
                                <span v-else>{{ user.campus }} ,</span><br>

                                <span
                                    v-if="user.campus_area == false || user.campus_area == null || user.campus_area == 'null' || user.campus_area == '' || user.campus_area == ' '">
                                </span>
                                <span v-else>{{ user.campus_area }}</span>
                            </span>
                        </div>

                        <div v-show="user.id !== id" class="profile-card-ctr">
                            <form @submit.prevent="sendConnection">
                                <input class="form-control" type="hidden" v-model="receiverId" />
                                <input class="form-control" type="hidden" v-model="receiverSlug" />
                                <input class="form-control" type="hidden" v-model="receiverName" />
                                <input class="form-control" type="hidden" v-model="receiverImage" />
                                <button
                                    v-show="user.sendNotConnected == false && user.receiveNotConnected == false && user.sendConnected == false && user.receiveConnected == false && user.id != id"
                                    type="submit" class="btn bg-gradient-primary btn-sm me-2">
                                    Connect
                                </button>

                                <button
                                    v-show="user.sendNotConnected == true || user.receiveNotConnected == true && user.id != id"
                                    type="button" class="btn btn-warning btn-sm me-2">
                                    Pending <i class="fa fa-cog fa-spin"
                                        style="font-size:14px;color:#171515;padding: 4px;"></i>
                                </button>

                                <button
                                    v-show="user.sendConnected == true || user.receiveConnected == true && user.id != id"
                                    type="button" class="btn btn-success btn-sm me-2">
                                    Connected <i class="fa fa-certificate"
                                        style="font-size:14px;color:#171515;padding: 4px;"></i>
                                </button>

                                <router-link :title="'Chat with ' + user.name"
                                    v-show="user.sendConnected == true || user.receiveConnected == true && user.id != id"
                                    class="nav-link font-weight-bolder" :to="{
                                        name: 'ChatUser',
                                        params: { slug: slug },
                                    }">
                                    <i style="color: #gray;" class="fa fa-envelope"></i>
                                </router-link>
                            </form>
                        </div>

                        <div class="d-flex justify-content-between" style="margin: 5px;">
                            <a v-show="user.id === id" data-bs-toggle="modal" data-bs-target="#ellipsis"
                                href="javascript:;">
                                <i class="fa fa-ellipsis-h"></i><sup><i
                                        v-show="user.sendNotConnectedCount > 0 || user.receiveNotConnectedCount > 0"
                                        class="fa fa-circle" style="font-size:10px;color:red"></i></sup>
                            </a>

                            <div class="modal fade" id="ellipsis" tabindex="-1" aria-labelledby="ellipsisLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ellipsisLabel"> Connection info</h5>
                                            <button type="button" class="btn btn-sm" data-bs-dismiss="modal"
                                                aria-label="Close"> <i style="font-size: 12px;" class="fa fa-times"></i>
                                            </button>
                                        </div>
                                        <div style="text-align: left;" class="modal-body">

                                            <button v-show="user.id === id" title="Search comrade"
                                                style="outline:none;background: none;border:none;" type="button"
                                                data-bs-dismiss="modal" aria-label="Close">
                                                <router-link to="/searchuser">
                                                    <i style="margin: 10px;color: #1CC0A0;" class="fa fa-search"></i> Search
                                                    for Comrades
                                                </router-link>
                                            </button>
                                            <hr class="horizontal dark my-2" />
                                            <button v-show="user.id === id" title="Connect requests you have sent"
                                                style="outline:none;background: none;border:none;" type="button"
                                                data-bs-dismiss="modal" aria-label="Close">
                                                <router-link to="/viewSentConnect">
                                                    <i style="margin: 10px;color:#00acee;" class="fa fa-paper-plane">
                                                        <sup><i v-show="user.sendNotConnectedCount > 0" class="fa fa-circle"
                                                                style="font-size:10px;color:red"></i></sup>
                                                    </i>
                                                    Sent requests
                                                </router-link>
                                            </button>
                                            <hr class="horizontal dark my-2" />
                                            <button v-show="user.id === id" title="Connect requests you have received"
                                                style="outline:none;background: none;border:none;" type="button"
                                                data-bs-dismiss="modal" aria-label="Close">
                                                <router-link to="/viewReceivedConnect">
                                                    <i style="margin: 10px;" class="fa fa-bell">
                                                        <sup><i v-show="user.receiveNotConnectedCount > 0"
                                                                class="fa fa-circle"
                                                                style="font-size:10px;color:red"></i></sup>
                                                    </i>
                                                    Received requests
                                                </router-link>
                                            </button>
                                            <hr class="horizontal dark my-2" />
                                            <button v-show="user.id === id" title="My friends"
                                                style="outline:none;background: none;border:none;" type="button"
                                                data-bs-dismiss="modal" aria-label="Close">
                                                <router-link to="/viewAcceptedConnect">
                                                    <i style="margin: 10px;" class="fa fa-user-friends"></i> My connections
                                                    ( {{ user.connectedUsersCount }} )
                                                </router-link>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <router-link v-show="user.id === id" class="nav-link font-weight-bolder"
                                :to="'/editProfile' + slug">
                                <i style="margin: 10px;-webkit-animation: fa-spin 3s infinite linear;animation: fa-spin 3s infinite linear;"
                                    class="fa fa-cog"></i>
                            </router-link>
                        </div>


                        <hr class="horizontal dark my-5" />

                        <div class="d-flex justify-content-between" style="margin: 5px;">
                            <a :href="user.linkedin" target="_blank">
                                <i style="color: #0072b1;" class="fa fa-linkedin"></i>
                            </a>

                            <a :href="user.twitter" target="_blank">
                                <i style="color: #00acee;" class="fa fa-twitter"></i>
                            </a>

                            <a :href="user.instagram" target="_blank">
                                <i style="color: #285AEB;" class="fa fa-instagram"></i>
                            </a>

                            <a :href="user.github" target="_blank">
                                <i style="color: #171515;" class="fa fa-github"></i>
                            </a>

                            <a :href="user.youtube" target="_blank">
                                <i style="color: #FF0000;" class="fa fa-youtube-play"></i>
                            </a>
                        </div>

                        <hr class="horizontal dark my-5" />

                        <div class="profile-card-inf">
                            <div class="profile-card-inf__item">
                                <router-link title="Connections" class="btn bg-gradient-primary btn-sm" :to="{
                                    name: 'Profile',
                                    params: { slug: slug },
                                }"><i style="font-size: 12px;" class="fa fa-user-friends"></i>
                                </router-link>
                            </div>

                            <div class="profile-card-inf__item">
                                <router-link title="Store" style="background-color: white;" class="btn btn-sm" :to="{
                                    name: 'ProdProfile',
                                    params: { slug: slug },
                                }"><i style="font-size: 12px;" class="fa fa-store"></i>
                                </router-link>
                            </div>

                            <div class="profile-card-inf__item">
                                <router-link title="Articles" style="background-color: white;" class="btn btn-sm" :to="{
                                    name: 'BlogProfile',
                                    params: { slug: slug },
                                }">
                                    <i style="font-size: 12px;" class="fa fa-blog"></i>
                                </router-link>
                            </div>

                            <div class="profile-card-inf__item">
                                <router-link title="Poll" style="background-color: white;" class="btn btn-sm" :to="{
                                    name: 'PollProfile',
                                    params: { slug: slug },
                                }">
                                    <i style="font-size: 12px;" class="fa fa-poll"></i>
                                </router-link>
                            </div>
                        </div>

                        <hr class="horizontal dark my-5" />

                        <div v-if="type == 'admin' && user.id === id" class="profile-card-inf">
                            <router-link class="profile-card-inf__item" to="/dashboard">
                                <i style="color: #3b5998;" class="fa fa-dashboard"></i>
                                <p>Dash</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admuser">
                                <i style="color: #3b5998;" class="fa fa-user"></i>
                                <p>Users</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admmarket">
                                <i style="color: #3b5998;" class="fa fa-store"></i>
                                <p>Prods</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admmarketreport">
                                <i style="color: #d60d0d;" class="fa fa-warning"></i>
                                <p>Prod Reports</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admmarketcat">
                                <i style="color: #3b5998;" class="fa fa-list-alt"></i>
                                <p>Prod Cat</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admmarketsubcat">
                                <i style="color: #3b5998;" class="fa fa-list-alt"></i>
                                <p>Prod Sub-Cat</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admrental">
                                <i style="color: #3b5998;" class="fa fa-home"></i>
                                <p>Rentals</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admrentalbooking">
                                <i style="color: #0dd649f3;" class="fa fa-calendar"></i>
                                <p>Rental Bookings</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admrentalreport">
                                <i style="color: #d60d0d;" class="fa fa-warning"></i>
                                <p>Rental Reports</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admrentalcat">
                                <i style="color: #3b5998;" class="fa fa-list-alt"></i>
                                <p>Rentals Cat</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admblog">
                                <i style="color: #3b5998;" class="fa fa-blog"></i>
                                <p>Blogs</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admBlogCat">
                                <i style="color: #3b5998;" class="fa fa-list-alt"></i>
                                <p>Blog Cat</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admlocation">
                                <i style="color: #3b5998;" class="fa fa-map-marker"></i>
                                <p>Locations</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admpoll">
                                <i style="color: #3b5998;" class="fa fa-poll"></i>
                                <p>Polls</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admevent">
                                <i style="color: #3b5998;" class="fa fa-calendar"></i>
                                <p>Events</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admeventbooking">
                                <i style="color: #0dd649f3;" class="fa fa-calendar"></i>
                                <p>Event Bookings</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admeventreport">
                                <i style="color: #d60d0d;" class="fa fa-warning"></i>
                                <p>Event Reports</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admclub">
                                <i style="color: #3b5998;" class="fa fa-users"></i>
                                <p>Societies</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admfeed">
                                <i style="color: #3b5998;" class="fa fa-comments-o"></i>
                                <p>Feedback</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admresource">
                                <i style="color: #3b5998;" class="fa fa-book"></i>
                                <p>Resources</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admyear">
                                <i style="color: #3b5998;" class="fa fa-calendar"></i>
                                <p>Years</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admcourse">
                                <i style="color: #3b5998;" class="fa fa-file"></i>
                                <p>Cources</p>
                            </router-link>

                            <router-link v-if="id == 1" class="profile-card-inf__item" to="/push">
                                <i style="color: #3b5998;" class="fa fa-telegram"></i>
                                <p>Push</p>
                            </router-link>
                        </div>
                        <a v-show="user.id === id" title="Logout" href="#" class="nav-link font-weight-bolder"
                            @click="logout">
                            <i style="color: red;float: right;" class="fa fa-power-off me-1"></i>
                        </a>
                    </div>

                </div>

            </div>
        </section>

        <div class="container">
            <div class="main-body">

                <!-- Breadcrumb -->
                <h4 style="text-align: center;">{{ user.name }}'s connections</h4>
                <br /><br />
                <!-- /Breadcrumb -->

                <div class="layout">
                    <div class="row">
                        <div class="col-md-4 col-12" v-for="connection in connections" :key="connection.id">
                            <div class="profile"
                                v-show="connection.sender_id == user.id && connection.status == 'Connected'">
                                <div class="profile__picture"><img src="/avatar.webp" alt="comrade" /></div>
                                <div class="profile__header">
                                    <div class="profile__account">
                                        <h4 class="profile__username">{{ connection.receiver_name }}</h4>
                                    </div>
                                </div>
                                <div class="profile__stats">
                                    <div class="profile__stat">
                                        <div class="profile__value">
                                            <div class="profile__key">
                                                <router-link class="btn bg-gradient-primary btn-sm"
                                                    :to="{ name: 'Profile', params: { slug: connection.receiver_slug } }">
                                                    View profile
                                                </router-link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile"
                                v-show="connection.receiver_id == user.id && connection.status == 'Connected'">
                                <div class="profile__picture"><img src="/avatar.webp" alt="comrade" /></div>
                                <div class="profile__header">
                                    <div class="profile__account">
                                        <h4 class="profile__username">{{ connection.sender_name }}</h4>
                                    </div>
                                </div>
                                <div class="profile__stats">
                                    <div class="profile__stat">
                                        <div class="profile__value">
                                            <div class="profile__key">
                                                <router-link class="btn bg-gradient-primary btn-sm"
                                                    :to="{ name: 'Profile', params: { slug: connection.sender_slug } }">
                                                    View profile
                                                </router-link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <Footer />
    </body>
</template>

<script>
import Footer from './Footer.vue'
import Loader from './Loader.vue'

export default {

    components: {
        Footer,
        Loader,
    },
    props: ["slug"],
    data() {
        return {
            //
            user: {},
            id: "",
            name: "",
            type: "",
            connections: [],
            users: [],
        };
    },

    computed: {
        receiverId: {
            get() {
                return this.user.id;
            },
            set(value) {
                this.user.id = value;
            }
        },

        receiverSlug: {
            get() {
                return this.user.slug;
            },
            set(value) {
                this.user.slug = value;
            }
        },

        receiverName: {
            get() {
                return this.user.name;
            },
            set(value) {
                this.user.name = value;
            }
        },

        receiverImage: {
            get() {
                return this.user.profile_pic;
            },
            set(value) {
                this.user.profile_pic = value;
            }
        },
    },

    methods: {
        sendConnection() {

            const fd = new FormData();
            fd.append("receiver_id", this.receiverId);
            fd.append("receiver_slug", this.receiverSlug);
            fd.append("receiver_name", this.receiverName);
            fd.append("receiver_image", this.receiverImage);

            fd.append("_method", "POST");


            axios
                .post("/api/connects", fd, {
                    headers: { "content-type": "multipart/form-data" },
                })
                .then(() => {
                    let timerInterval
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: '<strong> Well received</strong>',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    setTimeout(() => {
                        this.success = false;
                    }, 2500);

                    var modal = document.querySelector('#exampleModal');
                    modal.parentNode.removeChild(modal);

                    this.ratingValue = '';
                    this.rentalIssue = '';
                    this.rentalComplaint = '';

                    axios
                        .get("/api/users/" + this.slug)
                        .then((response) => (this.user = response.data.data))
                        .catch((error) => {
                            console.log(error);
                        });

                    axios
                        .get("/api/connections")
                        .then((response) => (this.connections = response.data.data))
                        .catch((error) => {
                            console.log(error);
                        });


                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    this.success = false;
                });
        },

        logout() {
            Swal.fire({
                title: 'LOGOUT',
                text: "Are you sure!",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'LOGOUT!'
            }).then((result) => {

                // Send request to the server
                if (result.value) {
                    axios
                        .post("/api/logout")
                        .then((response) => {
                            this.$router
                                .push({ name: 'Login' })
                                .then(() => { this.$router.go() })
                            localStorage.removeItem("authenticated");
                            this.$emit("updateSidebar");
                            window.location.reload();
                        })
                        .catch((error) => console.log(error));
                }
            })

        },
    },
    mounted() {
        axios
            .get("/api/users/" + this.slug)
            .then((response) => (this.user = response.data.data))
            .catch((error) => {
                console.log(error);
            });

        axios
            .get("/api/users")
            .then((response) => {
                this.users = response.data.data;
            })
            .catch((error) => {
                console.log(error);
            });

        axios
            .get("/api/connections")
            .then((response) => (this.connections = response.data.data))
            .catch((error) => {
                console.log(error);
            });

        axios
            .get("/api/user")
            .then(response => {
                this.id = response.data.id
                this.name = response.data.name
                this.type = response.data.type
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
@import url('https://fonts.googleapis.com/css?family=Quicksand:400,500,700&subset=latin-ext');

body {
    font-family: 'Quicksand', sans-serif;
}

a,
a:hover {
    text-decoration: none;
}

.icon {
    display: inline-block;
    width: 1em;
    height: 1em;
    stroke-width: 0;
    stroke: currentColor;
    fill: currentColor;
}

.wrapperr {
    width: 100%;
    width: 100%;
    height: auto;
    min-height: 100vh;
    padding: 50px 20px;
    padding-top: 100px;
    display: flex;
    background-image: linear-gradient(-20deg, #ffff 0%, #fff 100%);
    display: flex;
    background-image: linear-gradient(-20deg, #ffff 0%, #fff 100%);
}

@media screen and (max-width: 768px) {
    .wrapperr {
        height: auto;
        min-height: 100vh;
        padding-top: 100px;
    }
}

.profile-card {
    width: 100%;
    min-height: 460px;
    margin: auto;
    box-shadow: 1px 1px 5px 1px rgba(0, 0, 0, 0.1);
    background: #fff;
    border-radius: 12px;
    max-width: 700px;
    position: relative;
}

.profile-card.active .profile-card__cnt {
    filter: blur(6px);
}

.profile-card.active .profile-card-message,
.profile-card.active .profile-card__overlay {
    opacity: 1;
    pointer-events: auto;
    transition-delay: 0.1s;
}

.profile-card.active .profile-card-form {
    transform: none;
    transition-delay: 0.1s;
}

.profile-card__img {
    width: 150px;
    height: 150px;
    margin-left: auto;
    margin-right: auto;
    transform: translateY(-50%);
    border-radius: 50%;
    overflow: hidden;
    position: relative;
    z-index: 4;
    box-shadow: 0px 0px 0px 3px #75D4C8;
}

@media screen and (max-width: 576px) {
    .profile-card__img {
        width: 120px;
        height: 120px;
    }
}

.profile-card__img img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.profile-card__cnt {
    margin-top: -35px;
    text-align: center;
    padding: 0 20px;
    padding-bottom: 40px;
    transition: all 0.3s;
}

.profile-card__name {
    font-weight: 700;
    font-size: 24px;
    color: #1CC0A0;
    margin-bottom: 15px;
}

.profile-card__txt {
    font-size: 18px;
    font-weight: 500;
    color: #324e63;
    margin-bottom: 15px;
}

.profile-card__txt strong {
    font-weight: 700;
}

.profile-card-loc {
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 18px;
    font-weight: 600;
}

.profile-card-loc__icon {
    display: inline-flex;
    font-size: 27px;
    margin-right: 10px;
}

.profile-card-inf {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    align-items: flex-start;
    margin-top: 35px;
}

.profile-card-inf__item {
    padding: 5px 9px;
    min-width: 100px;
}

@media screen and (max-width: 768px) {
    .profile-card-inf__item {
        padding: 5px 10px;
        min-width: 100px;
    }
}

.profile-card-inf__title {
    font-weight: 700;
    font-size: 27px;
    color: #324e63;
}

.profile-card-inf__txt {
    font-weight: 500;
    margin-top: 7px;
}

.profile-card-social {
    margin-top: 25px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
}

.profile-card-social__item {
    display: inline-flex;
    width: 55px;
    height: 55px;
    margin: 15px;
    border-radius: 50%;
    align-items: center;
    justify-content: center;
    color: #fff;
    background: #405de6;
    box-shadow: 0px 7px 30px rgba(43, 98, 169, 0.5);
    position: relative;
    font-size: 21px;
    flex-shrink: 0;
    transition: all 0.3s;
}

@media screen and (max-width: 768px) {
    .profile-card-social__item {
        width: 50px;
        height: 50px;
        margin: 10px;
    }
}

@media screen and (min-width: 768px) {
    .profile-card-social__item:hover {
        transform: scale(1.2);
    }
}

.profile-card-social__item.facebook {
    background: linear-gradient(45deg, #3b5998, #0078d7);
    box-shadow: 0px 4px 30px rgba(43, 98, 169, 0.5);
}

.profile-card-social__item.twitter {
    background: linear-gradient(45deg, #1da1f2, #0e71c8);
    box-shadow: 0px 4px 30px rgba(19, 127, 212, 0.7);
}

.profile-card-social__item.instagram {
    background: linear-gradient(45deg, #405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d);
    box-shadow: 0px 4px 30px rgba(120, 64, 190, 0.6);
}

.profile-card-social__item.behance {
    background: linear-gradient(45deg, #1769ff, #213fca);
    box-shadow: 0px 4px 30px rgba(27, 86, 231, 0.7);
}

.profile-card-social__item.github {
    background: linear-gradient(45deg, #333, #626b73);
    box-shadow: 0px 4px 30px rgba(63, 65, 67, 0.6);
}

.profile-card-social__item.codepen {
    background: linear-gradient(45deg, #324e63, #414447);
    box-shadow: 0px 4px 30px rgba(55, 75, 90, 0.6);
}

.profile-card-social__item.link {
    background: linear-gradient(45deg, #d5135a, #f05924);
    box-shadow: 0px 4px 30px rgba(223, 45, 70, 0.6);
}

.profile-card-social .icon-font {
    display: inline-flex;
}

.profile-card-ctr {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 40px;
}

@media screen and (max-width: 576px) {
    .profile-card-ctr {
        flex-wrap: wrap;
    }
}

.profile-card__button {
    background: none;
    border: none;
    font-family: 'Quicksand', sans-serif;
    font-weight: 700;
    font-size: 19px;
    margin: 15px 35px;
    padding: 15px 40px;
    min-width: 201px;
    border-radius: 50px;
    min-height: 55px;
    color: #fff;
    cursor: pointer;
    backface-visibility: hidden;
    transition: all 0.3s;
}

@media screen and (max-width: 768px) {
    .profile-card__button {
        min-width: 170px;
        margin: 15px 25px;
    }
}

@media screen and (max-width: 576px) {
    .profile-card__button {
        min-width: inherit;
        margin: 0;
        margin-bottom: 16px;
        width: 100%;
        max-width: 300px;
    }

    .profile-card__button:last-child {
        margin-bottom: 0;
    }
}

.profile-card__button:focus {
    outline: none !important;
}

@media screen and (min-width: 768px) {
    .profile-card__button:hover {
        transform: translateY(-5px);
    }
}

.profile-card__button:first-child {
    margin-left: 0;
}

.profile-card__button:last-child {
    margin-right: 0;
}

.profile-card__button.button--blue {
    background: linear-gradient(45deg, #1da1f2, #0e71c8);
    box-shadow: 0px 4px 30px rgba(19, 127, 212, 0.4);
}

.profile-card__button.button--blue:hover {
    box-shadow: 0px 7px 30px rgba(19, 127, 212, 0.75);
}

.profile-card__button.button--orange {
    background: linear-gradient(45deg, #d5135a, #f05924);
    box-shadow: 0px 4px 30px rgba(223, 45, 70, 0.35);
}

.profile-card__button.button--orange:hover {
    box-shadow: 0px 7px 30px rgba(223, 45, 70, 0.75);
}

.profile-card__button.button--gray {
    box-shadow: none;
    background: #dcdcdc;
    color: #142029;
}

.profile-card-message {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    padding-top: 130px;
    padding-bottom: 100px;
    opacity: 0;
    pointer-events: none;
    transition: all 0.3s;
}

.profile-card-form {
    box-shadow: 0 4px 30px rgba(15, 22, 56, 0.35);
    max-width: 80%;
    margin-left: auto;
    margin-right: auto;
    height: 100%;
    background: #fff;
    border-radius: 10px;
    padding: 35px;
    transform: scale(0.8);
    position: relative;
    z-index: 3;
    transition: all 0.3s;
}

@media screen and (max-width: 768px) {
    .profile-card-form {
        max-width: 90%;
        height: auto;
    }
}

@media screen and (max-width: 576px) {
    .profile-card-form {
        padding: 20px;
    }
}

.profile-card-form__bottom {
    justify-content: space-between;
    display: flex;
}

@media screen and (max-width: 576px) {
    .profile-card-form__bottom {
        flex-wrap: wrap;
    }
}

.profile-card textarea {
    width: 100%;
    resize: none;
    height: 210px;
    margin-bottom: 20px;
    border: 2px solid #dcdcdc;
    border-radius: 10px;
    padding: 15px 20px;
    color: #324e63;
    font-weight: 500;
    font-family: 'Quicksand', sans-serif;
    outline: none;
    transition: all 0.3s;
}

.profile-card textarea:focus {
    outline: none;
    border-color: #8a979e;
}

.profile-card__overlay {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    pointer-events: none;
    opacity: 0;
    background: rgba(22, 33, 72, 0.35);
    border-radius: 12px;
    transition: all 0.3s;
}

@import url("https://fonts.googleapis.com/css?family=Montserrat:400,600,700");


@keyframes popUp {
    from {
        transform: scale(0);
        opacity: 0;
    }

    to {
        transform: scale(1);
        opacity: 1;
    }
}

@keyframes slideUp {
    from {
        transform: translateY(5px);
        opacity: 0;
    }

    to {
        transform: translateY(0px);
        opacity: 1;
    }
}

.profile {
    animation: popUp ease-in-out 350ms;
    background: #ffffff;
    border-radius: 25px;
    box-shadow: 0 0 40px 0px rgba(0, 0, 0, 0.17);
    margin-top: 40px;
    padding: 28px 30px 30px 35px;
    position: relative;
    max-width: 500px;
}

.profile__account {
    align-self: center;
    display: flex;
    flex: 1;
    justify-content: flex-end;
    padding-left: 135px;
}

.profile__button {
    border-radius: 50px;
    border: 1px solid #000000;
    color: #000000;
    display: block;
    font-family: "Montserrat", sans-serif;
    font-size: 13px;
    padding: 10px;
    text-align: center;
    text-decoration: none;
    transition: ease-in-out 250ms background, ease-in-out 250ms color;
}

.profile__button:hover {
    background: #000000;
    color: #ffffff;
}

.profile__edit {
    flex: none;
    margin-left: 30px;
    width: 140px;
}

.profile__header {
    display: flex;
    margin-bottom: 20px;
}

.profile__icon {
    flex: none;
    font-size: 1.5em;
    margin-right: 10px;
    padding-top: 3px;
}

.profile__icon--gold {
    color: #eab100;
}

.profile__icon--blue {
    color: #8faae8;
}

.profile__icon--pink {
    color: #ff86af;
}

.profile__key {
    font-family: "Montserrat", sans-serif;
    font-size: 13px;
    font-weight: 400;
    text-align: center;
}

.profile__picture {
    background: #ffffff;
    border-radius: 100px;
    border: 10px solid #ffffff;
    height: 125px;
    position: absolute;
    top: -40px;
    width: 125px;
}

.profile__picture:before {
    border-radius: 100px;
    box-shadow: 0 0 40px 0px rgba(0, 0, 0, 0.17);
    content: "";
    height: calc(100% + 20px);
    left: -10px;
    position: absolute;
    top: -10px;
    width: calc(100% + 20px);
    z-index: -1;
}

.profile__picture img {
    border-radius: 100px;
    height: 100%;
    width: 100%;
}

.profile__stat {
    animation: slideUp ease-in-out 350ms forwards;
    border-right: 1px solid #e9e9e9;
    display: flex;
    flex: 1;
    justify-content: center;
    opacity: 0;
    padding: 10px 4px;
    transform: translateY(5px);
}

.profile__stat:last-of-type {
    border-right: none;
}

.profile__stat:nth-child(1) {
    animation-delay: 400ms;
}

.profile__stat:nth-child(2) {
    animation-delay: 500ms;
}

.profile__stat:nth-child(3) {
    animation-delay: 600ms;
}

.profile__stats {
    display: flex;
}

.profile__username {
    font-family: "Montserrat", sans-serif;
    font-weight: 600;
    margin: 0;
    text-align: right;
}

.profile__value {
    font-family: "Montserrat", sans-serif;
    font-size: 28px;
    font-weight: 700;
    text-align: center;
}
</style>