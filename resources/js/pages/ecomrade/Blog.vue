<template>
  <body class="index-page">
    <section class="my-5 py-5">
      <div class="container">
        <div class="row justify-content-center my-2 py-1">
          <div class="custom-search">
            <input v-model="title" @input="searchpost" type="text" class="custom-search-input"
              placeholder="Search blog | Category..." name="searchpost">
            <br>
            <br>
            <div class="search-results-container" v-if="searchResults.length > 0"
              style="background-color: rgb(250, 250, 250); border: none; border-radius: 5px;">
              <br>
              <ul style="padding: 20px;" class="search-results">
                <li style="margin: 13px;" v-for="result in searchResults" :key="result.id">
                  <input style="background-color: rgb(250, 250, 250);border:none;color:#189483;" type="button"
                    @click="selectItem(result)" :value="result.title">
                  <hr class="horizontal dark my-1">
                </li>
              </ul>
            </div>
            <span style="float:right;margin:6px;">

              <button data-toggle="tooltip" data-placement="bottom" title="Blog list" data-bs-toggle="modal"
                data-bs-target="#exampleModal" class="btn btn-sm">
                <i style="font-size: 13px;" class="fa fa-list"></i>
              </button>

              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">
                        Blog Categories
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div style="padding: 15px;" class="container row">
                      <ul>
                        <li style="display: inline;" v-for="category in categories" :key="category.id">
                          <input data-bs-dismiss="modal" class="btn btn-sm" type="button" name="search"
                            :value="category.name" @click="title = category.name">
                        </li>
                        <h5 v-if="!categories.length">Sorry, no item found!</h5>
                      </ul>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn bg-gradient-dark btn-sm" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            </span>

          </div>
        </div>

        <div class="row">
          <div class="col-md-4 col-10">
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
              <div class="container">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                  <li style="color: #189483;" class="breadcrumb-item"><strong>Blog</strong></li>
                </ol>
                <div v-if="lastPage > 1" class="pagination">
                  <button class="btn bg-gradient-primary btn-sm" style="margin: 4px;" v-if="currentPage > 1"
                    @click="postName(currentPage - 1)">&laquo; Prev</button>

                  <button class="btn bg-gradient-primary btn-sm" style="margin: 4px;" v-if="currentPage < lastPage"
                    @click="postName(currentPage + 1)">
                    Next &raquo;</button>
                </div>
              </div>
            </nav>
          </div>
          <div style="float:right;" class="col-md-8 col-2">
            <router-link v-if="id == true" to="/createblog" style="float: right;" class="text-info icon-move-right">
              <button data-toggle="tooltip" data-placement="bottom" title="Create blog" type="button"
                class="btn bg-gradient-primary btn-sm">
                <i class="fa fa-plus"></i>
              </button>
            </router-link>

            <router-link v-else-if="id == false" to="/login" style="float: right;" class="text-info icon-move-right">
              <button data-toggle="tooltip" data-placement="bottom" title="Create blog" type="button"
                class="btn bg-gradient-primary btn-sm">
                <i class="fa fa-plus"></i>
              </button>
            </router-link>
          </div>
        </div>

        <div class="container2">
          <div style="background-color: #E9ECEF;" class="card" v-for="post in posts" :key="post.id">
            <div class="card__header">
              <img style="background-color: white;width: 100%;height: 200px; object-fit: cover;"
                v-if="post.image_1 == false || post.image_1 == null || post.image_1 == 'null' || post.image_1 == '' || post.image_1 == ' ' || post.image_1 == NULL"
                loading="lazy" src="/web/img/no_img.jpg" class="card__image" width="600">

              <img v-else style="background-color: white;width: 100%;height: 200px; object-fit: cover;" :src="'./img/blog/' + post.image_1"
                class="card__image" width="600">

            </div>
            <div class="card__body">
              <span class="tag tag-blue">{{ post.post_category }}</span>
              <h4>{{ post.title }}</h4>
              <p>" {{ truncateText(post.body) }} "</p>
            </div>
            <div class="card__footer">
              <div class="user">
                <div class="user__info">
                  <h5>Written By {{ post.user_name }}</h5>
                  <small> {{ post.created_at }} </small>
                </div>
              </div>
            </div>


            <div class="d-flex flex-row justify-content-between mb-0 px-3">
              <span style="margin: 3px;" class="badge bg-dark ">
                <i class="fa fa-comments-o"></i> {{ post.rating_count }}
              </span>

              <span style="margin: 3px;" class="badge bg-dark">
                <div v-if="Math.round(post.avg_rating) === 0" class="stars">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
                <div v-if="Math.round(post.avg_rating) === 1" class="stars">
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
                <div v-if="Math.round(post.avg_rating) === 2" class="stars">
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
                <div v-if="Math.round(post.avg_rating) === 3" class="stars">
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
                <div v-if="Math.round(post.avg_rating) === 4" class="stars">
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
                <div v-if="Math.round(post.avg_rating) === 5" class="stars">
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i style="color: orange;" class="fa fa-star"></i>
                </div>
              </span>
            </div>

            <br />

            <div class="d-flex flex-row justify-content-between mb-0 px-3">
              <router-link class="btn bg-gradient-primary btn-block btn-sm" :to="{
                name: 'ViewBlog',
                params: { slug: post.slug },
              }">VIEW </router-link>
            </div>
            <div class="d-flex flex-row justify-content-between mb-0 px-3">
              <button v-if="post.user_id == id || id == 1" type="button" @click="destroy(post.id)" class="delete-btn"
                style="float: left;border:none;outline:none;background: none;">
                <i class="fa fa-trash-o" style="color: red;"></i>
              </button>

              <router-link style="float: right;" v-if="post.user_id == id || id == 1" :to="{
                name: 'EditBlog',
                params: { slug: post.slug },
              }"><i class="fa fa-edit" style="color:#189483;"></i>
              </router-link>
            </div>
            
            <br />
          </div>
          <h5 v-if="!posts.length">Sorry, no item found!</h5>
        </div>

        <br /><br />
        <div v-if="lastPage > 1" class="pagination">
          <button class="btn bg-gradient-primary btn-sm" style="margin: 4px;" v-if="currentPage > 1"
            @click="postName(currentPage - 1)">&laquo; Prev</button>

          <button class="btn bg-gradient-primary btn-sm" style="margin: 4px;" v-if="currentPage < lastPage"
            @click="postName(currentPage + 1)">Next &raquo;</button>
        </div>

      </div>
      <hr class="horizontal dark my-5">
    </section>
    <!-- END Section Content -->

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
      posts: [],
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

      post_category: "",
      id: "",
      name: "",
    };
  },

  created() {
    this.postName(this.currentPage);
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

    truncateText(posts) {
      const truncatedText = posts.slice(0, 40) + '...'
      return truncatedText
    },
    searchpost() {
      if (this.title.length > 2) {

        axios.get('/api/searchpost', { params: { q: this.title } })
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
        .post("/api/posts", this.fields, {
          headers: { "content-type": "multipart/form-data" },
        })
        .then(() => {
          this.fields = {};
          this.url = null;
          this.fields.category_id = "";
          this.success = true;
          this.errors = {};

          axios.get("/api/posts").then(({
            data
          }) => (this.posts = data.data));

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
            .delete("/api/posts/" + id)
            .then((response) => {
              Swal.fire(
                'Deleted!',
                'Information has been successfully deleted.',
                'success'
              );
              // Fire.$emit('AfterCreate');
              axios.get('/api/posts').then(response => {
                this.posts = response.data.data;
              });
            }).catch((error) => {
              Swal.fire("Failed!", error.message, "warning");
            });
        }
      })
    },

    postName(page) {
      axios
        .get('/api/posts?page=' + page, {
          params: {
            search: this.title,
          },
        })
        .then((response) => {
          this.posts = response.data.data;
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
        .get("/api/posts", {
          params: {
            page: page,
            search: this.title,
          },
        })
        .then((response) => {
          this.posts = response.data.data;
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

    axios
      .get("/api/categories")
      .then((response) => (this.categories = response.data))
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>

<style scoped>
.container2 {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  margin-block: 2rem;
  gap: 2rem;
}

img {
  max-width: 100%;
  display: block;
  object-fit: cover;
}

.card {
  display: flex;
  flex-direction: column;
  width: clamp(25rem, calc(25rem + 2vw), 25rem);
  overflow: hidden;
  box-shadow: 0 .1rem 1rem rgba(0, 0, 0, 0.1);
  border-radius: 1em;
}



.card__body {
  padding: 1rem;
  display: flex;
  flex-direction: column;
  gap: .5rem;
}


.tag {
  align-self: flex-start;
  padding: .25em .75em;
  border-radius: 1em;
  font-size: .75rem;
}

.tag+.tag {
  margin-left: .5em;
}

.tag-blue {
  background: #56CCF2;
  background: linear-gradient(to bottom, #2F80ED, #56CCF2);
  color: #fafafa;
}

.card__body h4 {
  font-size: 1.5rem;
  text-transform: capitalize;
}

.card__footer {
  display: flex;
  padding: 1rem;
  margin-top: auto;
}
</style>