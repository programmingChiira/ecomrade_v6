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
                    <div class="col-md-4 col-10">
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

                    <div style="float:right;" class="col-md-8 col-2">
                        <router-link :to="{ name: 'CreateCourse' }" style="float: right;">
                            <button type="button" class="btn bg-gradient-primary btn-sm">
                                <i class="fa fa-plus"></i>
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