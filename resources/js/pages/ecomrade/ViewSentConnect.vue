<template>
    <body class="about-us">
        <section class="py-7">
            <div class="container mt-5 mb-5">
                <div class="d-flex justify-content-center row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4 col-10">
                                <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                                    <div class="container">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                                            <li class="breadcrumb-item"><router-link to="/">Sent</router-link></li>
                                            <li style="color: #189483;" class="breadcrumb-item"><strong>Connects</strong>
                                            </li>
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
                                                                class="form-check-label" for="contacusercheck"></label>
                                                        </div>
                                                    </th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">View Profile</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Withdraw</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="connection in connections" :key="connection.id"
                                                    v-show="connection.sender_id == id && connection.status == 'Pending'">
                                                    <th scope="row" class="ps-4">
                                                        <div class="form-check font-size-16"><input type="checkbox"
                                                                class="form-check-input" id="contacusercheck1" /><label
                                                                class="form-check-label" for="contacusercheck1"></label>
                                                        </div>
                                                    </th>
                                                    <td><span class="badge badge-soft-success mb-0">{{
                                                        connection.receiver_name }}</span></td>
                                                    <td>
                                                        <router-link class="btn btn-sm" :to="{
                                                            name: 'Profile',
                                                            params: { slug: connection.receiver_slug },
                                                        }">
                                                            <i class="fa fa-user me-1"></i>
                                                        </router-link>
                                                    </td>
                                                    <td>
                                                        {{ connection.status }} ...
                                                    </td>
                                                    <td>
                                                        <button type="button" @click="destroy(connection.id)"
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