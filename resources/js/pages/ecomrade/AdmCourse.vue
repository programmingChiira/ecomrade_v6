<template>

    <body class="about-us">
        <section class="my-5 py-5">

            <div class="container">

                <div class="row justify-content-center my-2 py-1">
                    <div class="custom-search">
                        <input type="text" class="custom-search-input" placeholder="Search market | Item | Category...">
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
                                    <li style="color: #189483;" class="breadcrumb-item"><strong>Courses</strong></li>
                                </ol>
                            </div>
                        </nav>
                    </div>

                    <div style="float:right;" class="col-md-8 col-3">
                        <router-link :to="{ name: 'CreateCourse' }" style="float: right;">
                            <button type="button" class="btn bg-gradient-primary btn-sm">
                                Add
                            </button>
                        </router-link>
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
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th v-if="id == 1" scope="col">Edit</th>
                                            <th v-if="id == 1" scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(courses, index) in courses" :key="courses.id">
                                            <th scope="row" class="ps-4">
                                                <div class="form-check font-size-16">
                                                    <input type="checkbox" class="form-check-input"
                                                        id="contacusercheck1" />
                                                    <label class="form-check-label" for="contacusercheck1"></label>
                                                </div>
                                            </th>
                                            <td>
                                                <a href="#" class="text-body">{{ index + 1 }}</a>
                                            </td>
                                            <td>
                                                <span class="badge badge-soft-success mb-0">{{ courses.name }}</span>
                                            </td>
                                            <td v-if="id == 1">
                                                <router-link class="edit-link"
                                                    :to="{ name: 'PolishCourse', params: { id: courses.id } }">
                                                    <i class="fa fa-edit"></i>
                                                </router-link>


                                            </td>
                                            <td v-if="id == 1">
                                                <button type="button" @click="destroy(courses.id)" class="delete-btn"
                                                    style="border:none;outline:none;background: none;">
                                                    <i class="fa fa-trash-o" style="color: red;"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                <h5 v-if="!courses.length">Sorry, no item found!</h5>
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
    data() {
        return {
            courses: {},
            success: false,
        };
    },

    methods: {
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
                        .delete("/api/courses/" + id)
                        .then((response) => {
                            this.success = true;
                            Swal.fire(
                                'Deleted!',
                                'Information has been successfully deleted.',
                                'success'
                            );
                            setInterval(() => {
                                this.success = false;
                            }, 2500);
                            // Fire.$emit('AfterCreate');
                            axios.get('/api/courses')
                                .then(response => {
                                    this.courses = response.data.data;
                                });
                        }).catch((error) => {
                            Swal.fire("Failed!", error.message, "warning");
                            console.log(error);
                        });
                }
            })
        },
        fetchCategories() {
            axios
                .get("/api/courses")
                .then((response) => (this.courses = response.data))
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted() {
        axios.get('/api/courses')
            .then(response => {
                this.courses = response.data.data;
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