<template>
    <body class="about-us">
        <div class="full-page-loader" v-if="loading">
            <img src="/triangle.svg" alt="Loader" />
          </div>
        <section class="py-7">
            <div class="container mt-5 mb-5">
                <div class="d-flex justify-content-center row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                                    <div class="container">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                                            <li class="breadcrumb-item"><router-link to="/">Received</router-link></li>
                                            <li style="color: #189483;" class="breadcrumb-item"><strong>Connects</strong>
                                            </li>
                                        </ol>
                                    </div>
                                </nav>
                            </div>
                        </div>


                        <div class="layout">
                            <div class="row">
                                <div v-for="connection in connections" :key="connection.id"
                                    v-show="connection.receiver_id == id && connection.status == 'Pending'"
                                    class="col-md-4 col-12">
                                    <div class="profile">
                                        <div class="profile__picture"><img src="/avatar.webp"
                                                alt="comrade" /></div>
                                        <div class="profile__header">
                                            <div class="profile__account">
                                                <h4 class="profile__username">{{ connection.sender_name }}</h4>
                                            </div>
                                        </div>
                                        <div class="profile__stats">
                                            <div class="profile__stat">

                                                <div class="profile__value">
                                                    <div class="profile__key">
                                                        <router-link :to="{
                                                            name: 'Profile',
                                                            params: { slug: connection.sender_slug },
                                                        }">
                                                            <h6><i class="fas fa-user"></i> View</h6>
                                                        </router-link>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="profile__stat">
                                                <div class="profile__icon">
                                                </div>
                                                <div class="profile__value">
                                                    <div class="profile__key">
                                                        <form @submit.prevent="accept(connection.id)">
                                                            <button type="submit"
                                                                class="delete-btn"
                                                                style="border:none;outline:none;background: none;">
                                                                <h6>
                                                                    <i class="fa fa-check" style="color: green;"></i> Accept
                                                                </h6>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="profile__stat">
                                                <div class="profile__value">
                                                    <div class="profile__key">
                                                        <button type="button" @click="destroy(connection.id)"
                                                            class="delete-btn"
                                                            style="border:none;outline:none;background: none;">
                                                            <h6>
                                                                <i class="fa fa-trash-o" style="color: red;"></i> Reject
                                                            </h6>
                                                        </button>
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
            </div>
        </section>

        <Footer />
    </body>
</template>


<script>
import Footer from './Footer.vue'

export default {

    components: {
        Footer
    },
    emits: ["updateSidebar"],
    data() {
        return {
            success: false,
            fields: {
                category_id: "",
            },
            errors: {},
            url: "",
            categories: [],

            connections: [],
            title: "",
            user_id: "",
            links: [],

            id: "",
            name: "",
        };
    },

    methods: {
        filterByCategory(name) {
            axios
                .get("/api/carts", {
                    params: {
                        category: name,
                    },
                })
                .then((response) => {
                    this.carts = response.data.data;
                    this.links = response.data.meta.links;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        truncateText(carts) {
            const truncatedText = carts.slice(0, 10) + '...'
            return truncatedText
        },

        changePage(link) {
            if (!link.url || link.active) {
                retun;
            }
            axios
                .get(link.url)
                .then((response) => {
                    this.carts = response.data.data;
                    this.links = response.data.meta.links;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        grabFile(e) {
            const file = e.target.files[0];
            this.fields.file = file;
            this.url = URL.createObjectURL(file);
            URL.revokeObjectURL(file);
        },

        accept(id) {
            let timerInterval
            Swal.fire({
                title: 'Processing',
                html: '',
                timer: 1000,
                timerProgressBar: true,

                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                        if (b) {
                            b.textContent = Swal.getTimerLeft()
                        }
                    }, 100)

                    const fd = new FormData();

                    fd.append("_method", "PUT");

                    axios
                        .post(`/api/connections/` + id, fd, {
                            headers: {
                                "content-type": "multipart/form-data",
                            },
                        })
                        .then((res) => {
                            this.$emit("showEditSuccess");
                            axios
                                .get("/api/connections")
                                .then((response) => (this.connections = response.data.data))
                                .catch((error) => {
                                    console.log(error);
                                });
                        })
                        .catch((error) => {
                            this.errors = error.response.data.errors;
                            if (error.response.status === 403) {
                            }
                        });
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('All is well')
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
                        .delete("/api/connections/" + id)
                        .then((response) => {
                            Swal.fire(
                                'Deleted!',
                                'Information has been successfully deleted.',
                                'success'
                            );
                            // Fire.$emit('AfterCreate');
                            axios
                                .get("/api/connections")
                                .then((response) => (this.connections = response.data.data))
                                .catch((error) => {
                                    console.log(error);
                                });
                        }).catch((error) => {
                            Swal.fire("Failed!", error.message, "warning");
                        });
                }
            })
        },

    },

    mounted() {

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