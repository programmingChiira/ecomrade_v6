<template>
    <body class="about-us">
        <section class="my-5 py-5">

            <div class="container">

                <!-- Main content -->
                <div class="h-screen flex-grow-1 overflow-y-lg-auto">
                    <!-- Main -->
                    <main class="py-6 bg-surface-secondary">
                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-md-4 col-10">
                                    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                                        <div class="container">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                                                <li class="breadcrumb-item"><router-link to="/">Adm</router-link></li>
                                                <li style="color: #189483;" class="breadcrumb-item"><strong>Dash</strong>
                                                </li>
                                            </ol>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                            <!-- Card stats -->
                            <div class="row g-6 mb-6">
                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="card shadow border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <span
                                                        class="h6 font-semibold text-muted text-sm d-block mb-2">Users</span>
                                                    <span class="h3 font-bold mb-0"> {{ users.length }} </span>
                                                </div>
                                                <div style="text-align: center;" class="col-auto">
                                                    <router-link class="text-info" to="/admuser">
                                                        <div
                                                            class="icon icon-shape bg-tertiary text-white text-lg rounded-circle">
                                                            <i style="color: black;" class="fa fa-eye"></i>
                                                        </div>
                                                    </router-link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="card shadow border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <span
                                                        class="h6 font-semibold text-muted text-sm d-block mb-2">Products</span>
                                                    <span class="h3 font-bold mb-0">{{ markets.length }}</span>
                                                </div>
                                                <div style="text-align: center;" class="col-auto">
                                                    <router-link class="text-info" to="/admmarket">
                                                        <div
                                                            class="icon icon-shape bg-primary text-white text-lg rounded-circle">
                                                            <i class="fa fa-wallet"></i>
                                                        </div>
                                                    </router-link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="card shadow border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <span
                                                        class="h6 font-semibold text-muted text-sm d-block mb-2">Rentals</span>
                                                    <span class="h3 font-bold mb-0">{{ rentals.length }}</span>
                                                </div>
                                                <div style="text-align: center;" class="col-auto">
                                                    <router-link class="text-info" to="/admrental">
                                                        <div
                                                            class="icon icon-shape bg-info text-white text-lg rounded-circle">
                                                            <i class="fa fa-home"></i>
                                                        </div>
                                                    </router-link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="card shadow border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <span
                                                        class="h6 font-semibold text-muted text-sm d-block mb-2">Blogs</span>
                                                    <span class="h3 font-bold mb-0">{{ posts.length }}</span>
                                                </div>
                                                <div style="text-align: center;" class="col-auto">
                                                    <router-link class="text-info" to="/admblog">
                                                        <div
                                                            class="icon icon-shape bg-warning text-white text-lg rounded-circle">
                                                            <i class="fa fa-blog"></i>
                                                        </div>
                                                    </router-link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="card shadow border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <span
                                                        class="h6 font-semibold text-muted text-sm d-block mb-2">Polls</span>
                                                    <span class="h3 font-bold mb-0">{{ polls.length }}</span>
                                                </div>
                                                <div style="text-align: center;" class="col-auto">
                                                    <router-link class="text-info" to="/admpoll">
                                                        <div
                                                            class="icon icon-shape bg-primary text-white text-lg rounded-circle">
                                                            <i class="fa fa-bar-chart"></i>
                                                        </div>
                                                    </router-link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="card shadow border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <span
                                                        class="h6 font-semibold text-muted text-sm d-block mb-2">Events</span>
                                                    <span class="h3 font-bold mb-0">{{ events.length }}</span>
                                                </div>
                                                <div style="text-align: center;" class="col-auto">

                                                    <router-link class="text-info" to="/admevent">
                                                        <div
                                                            class="icon icon-shape bg-info text-white text-lg rounded-circle">
                                                            <i class="fa fa-users"></i>
                                                        </div>
                                                    </router-link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="card shadow border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <span
                                                        class="h6 font-semibold text-muted text-sm d-block mb-2">Clubs</span>
                                                    <span class="h3 font-bold mb-0">{{ clubs.length }}</span>
                                                </div>
                                                <div style="text-align: center;" class="col-auto">
                                                    <router-link class="text-info" to="/admclub">
                                                        <div
                                                            class="icon icon-shape bg-warning text-white text-lg rounded-circle">
                                                            <i class="fa fa-clover"></i>
                                                        </div>
                                                    </router-link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="card shadow border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <span
                                                        class="h6 font-semibold text-muted text-sm d-block mb-2">Resources</span>
                                                    <span class="h3 font-bold mb-0">{{ resources.length }}</span>
                                                </div>
                                                <div style="text-align: center;" class="col-auto">
                                                    <router-link class="text-info" to="/admresource">
                                                        <div
                                                            class="icon icon-shape bg-danger text-white text-lg rounded-circle">
                                                            <i class="fa fa-book"></i>
                                                        </div>
                                                    </router-link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </main>
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
            users: [],
            markets: [],
            rentals: [],
            posts: [],
            polls: [],
            events: [],
            clubs: [],
            resources: [],
        };
    },

    mounted() {
        axios.get('/api/users').then(response => {
            this.users = response.data.data;
        });

        axios.get('/api/markets').then(response => {
            this.markets = response.data.data;
        });

        axios.get('/api/rentals').then(response => {
            this.rentals = response.data.data;
        });

        axios.get('/api/posts').then(response => {
            this.posts = response.data.data;
        });

        axios.get('/api/polls').then(response => {
            this.polls = response.data.data;
        });

        axios.get('/api/events').then(response => {
            this.events = response.data.data;
        });

        axios.get('/api/clubs').then(response => {
            this.clubs = response.data.data;
        });

        axios.get('/api/resources').then(response => {
            this.resources = response.data.data;
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