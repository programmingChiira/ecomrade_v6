<template>
  <body class="index-page">
    <section class="my-5 py-5">
      <div class="container">

        <div class="row justify-content-center my-2 py-1">
          <div class="custom-search">
            <input v-model="name" @input="searchclub" type="text" class="custom-search-input"
              placeholder="Search Club | Society..." name="searchclub">
            <br>
            <br>
            <div class="search-results-container" v-if="searchResults.length > 0"
              style="background-color: rgb(250, 250, 250); border: none; border-radius: 5px;">
              <br>
              <ul style="padding: 20px;" class="search-results">
                <li style="margin: 13px;" v-for="result in searchResults" :key="result.id">
                  <input style="background-color: rgb(250, 250, 250);border:none;color:#189483;" type="button"
                    @click="selectItem(result)" :value="result.name">
                  <hr class="horizontal dark my-1">
                </li>
              </ul>
            </div>

          </div>
        </div>

        <div class="row">
          <div class="row">
            <div class="col-md-4 col-9">
              <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                <div class="container">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                    <li style="color: #189483;" class="breadcrumb-item"><strong>Clubs</strong></li>
                  </ol>
                  <div v-if="lastPage > 1" class="pagination">
                    <button class="btn bg-gradient-primary btn-sm" style="margin: 4px;" v-if="currentPage > 1"
                      @click="clubName(currentPage - 1)">&laquo; Prev</button>
        
                    <button class="btn bg-gradient-primary btn-sm" style="margin: 4px;" v-if="currentPage < lastPage"
                      @click="clubName(currentPage + 1)">Next &raquo;</button>
                  </div>
                </div>
              </nav>
            </div>
            <div style="float:right;" class="col-md-8 col-3">
              <router-link to="/createclub" style="float: right;" class="text-info icon-move-right">
                <button data-toggle="tooltip" data-placement="bottom" title="Create club / society" type="button"
                  class="btn bg-gradient-primary btn-sm">
                  Add
                </button>
              </router-link>
            </div>
          </div>
        </div>

        <section>
          <div class="container py-2">
            <article class="postcard light blue" v-for="club in clubs" :key="club.id">
              <a class="postcard__img_link">
                <img
                  v-if="club.image_1 == false || club.image_1 == null || club.image_1 == 'null' || club.image_1 == '' || club.image_1 == ' ' || club.image_1 == NULL"
                  class="postcard__img" src="/web/img/no_img.jpg" alt="Image Title" />
                <img v-else class="postcard__img" :src="'./img/clubs/' + club.image_1" alt="Image Title" />
              </a>
              <div class="postcard__text t-dark">
                <h1 class="postcard__title blue"><a> {{ club.name }} </a></h1>
                <div class="postcard__subtitle small">
                  <time datetime="2020-05-25 12:00:00">
                    <i class="fas fa-calendar-alt mr-2"></i> {{ club.created_at }}
                  </time>
                </div>
                <div class="postcard__bar"></div>
                <div class="postcard__preview-txt"> {{ club.description }} </div>

                <div class="mx-3 mt-3 mb-2">


                  <!--  -->
                </div>
                <ul class="postcard__tagbox">
                  <li v-if="club.user_id == id || id == 1" style="margin: 10px;" class="tag__item">
                    <button type="button" @click="destroy(club.id)" class="delete-btn"
                      style="float: left;border:none;outline:none;background: none;">
                      <i class="fa fa-trash-o" style="color: red;"></i>
                    </button>
                  </li>

                  <li style="margin: 10px;" class="tag__item">
                    <router-link :to="{
                      name: 'ClubDetails',
                      params: { slug: club.slug },
                    }">
                      View Club
                    </router-link>
                  </li>

                  <li style="margin: 10px;" class="tag__item">
                    <router-link :to="{
                      name: 'ViewClub',
                      params: { slug: club.slug },
                    }">
                      Chat room
                    </router-link>
                  </li>

                  <li v-if="club.user_id == id || id == 1" style="margin: 10px;" class="tag__item">
                    <router-link style="float: right;" :to="{
                      name: 'EditClub',
                      params: { slug: club.slug },
                    }"><i class="fa fa-edit" style="color: black;"></i>
                    </router-link>
                  </li>
                  
                </ul>
              </div>
            </article>
            <h5 v-if="!clubs.length">Sorry, no item found!</h5>
          </div>
          <br /><br />
          <div v-if="lastPage > 1" class="pagination">
            <button class="btn bg-gradient-primary btn-sm" style="margin: 4px;" v-if="currentPage > 1"
              @click="clubName(currentPage - 1)">&laquo; Prev</button>

            <button class="btn bg-gradient-primary btn-sm" style="margin: 4px;" v-if="currentPage < lastPage"
              @click="clubName(currentPage + 1)">Next &raquo;</button>
          </div>
        </section>
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
      clubs: [],
      currentPage: 1,
      lastPage: 1,

      name: '',
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

      club_category: "",
      id: "",
    };
  },

  created() {
    this.clubName(this.currentPage);

  },

  computed: {
    marketName: {
      get() {
        return this.fields.name = this.market.name;
      },
      set(value) {
        this.fields.name = value;
      }
    },
  },

  methods: {
    
    searchclub() {
      if (this.name.length > 2) {

        axios.get('/api/searchclub', { params: { q: this.name } })
          .then(response => {
            this.searchResults = response.data;
          });
      } else {
        this.searchResults = [];
      }
    },

    selectItem(item) {
      this.name = item.name;
      this.searchResults = [];
    },
    submit() {
      axios
        .post("/api/clubs", this.fields, {
          headers: { "content-type": "multipart/form-data" },
        })
        .then(() => {
          this.fields = {};
          this.url = null;
          this.fields.category_id = "";
          this.success = true;
          this.errors = {};

          axios.get("/api/clubs").then(({
            data
          }) => (this.clubs = data.data));

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
            .delete("/api/clubs/" + id)
            .then((response) => {
              Swal.fire(
                'Deleted!',
                'Information has been successfully deleted.',
                'success'
              );
              // Fire.$emit('AfterCreate');
              axios.get('/api/clubs').then(response => {
                this.clubs = response.data.data;
              });
            }).catch((error) => {
              Swal.fire("Failed!", error.message, "warning");
            });
        }
      })
    },

    clubName(page) {
      axios
        .get('/api/clubs?page=' + page, {
          params: {
            search: this.name,
          },
        })
        .then((response) => {
          this.clubs = response.data.data;
          this.currentPage = response.data.current_page;
          this.lastPage = response.data.last_page;
        })
        .catch((error) => {
          console.log(error);
        });

    },

  },

  watch: {
    name(page) {
      axios
        .get("/api/clubs", {
          params: {
            page: page,
            search: this.name,
          },
        })
        .then((response) => {
          this.clubs = response.data.data;
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
.dark {
  background: #110f16;
}

.light {
  background: #f3f5f7;
}

a,
a:hover {
  text-decoration: none;
  transition: color 0.3s ease-in-out;
}

#pageHeaderTitle {
  margin: 2rem 0;
  text-transform: uppercase;
  text-align: center;
  font-size: 2.5rem;
}

/* Cards */
.postcard {
  flex-wrap: wrap;
  display: flex;
  box-shadow: 0 4px 21px -12px rgba(0, 0, 0, 0.66);
  border-radius: 10px;
  margin: 0 0 2rem 0;
  overflow: hidden;
  position: relative;
  color: #fff;
}

.postcard.dark {
  background-color: #18151f;
}

.postcard.light {
  background-color: #e1e5ea;
}

.postcard .t-dark {
  color: #18151f;
}

.postcard a {
  color: inherit;
}

.postcard h1,
.postcard .h1 {
  margin-bottom: 0.5rem;
  font-weight: 500;
  line-height: 1.2;
}

.postcard .small {
  font-size: 80%;
}

.postcard .postcard__title {
  font-size: 1.75rem;
}

.postcard .postcard__img {
  max-height: 180px;
  width: 100%;
  object-fit: cover;
  position: relative;
}

.postcard .postcard__img_link {
  display: contents;
}

.postcard .postcard__bar {
  width: 50px;
  height: 10px;
  margin: 10px 0;
  border-radius: 5px;
  background-color: #424242;
  transition: width 0.2s ease;
}

.postcard .postcard__text {
  padding: 1.5rem;
  position: relative;
  display: flex;
  flex-direction: column;
}

.postcard .postcard__preview-txt {
  overflow: hidden;
  text-overflow: ellipsis;
  text-align: justify;
  height: 100%;
}

.postcard .postcard__tagbox {
  display: flex;
  flex-flow: row wrap;
  font-size: 14px;
  margin: 20px 0 0 0;
  padding: 0;
  justify-content: center;
}

.postcard .postcard__tagbox .tag__item {
  display: inline-block;
  background: rgba(83, 83, 83, 0.4);
  border-radius: 3px;
  padding: 2.5px 10px;
  margin: 0 5px 5px 0;
  cursor: default;
  user-select: none;
  transition: background-color 0.3s;
}

.postcard .postcard__tagbox .tag__item:hover {
  background: rgba(83, 83, 83, 0.8);
}

.postcard:before {
  content: "";
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background-image: linear-gradient(-70deg, #424242, transparent 50%);
  opacity: 1;
  border-radius: 10px;
}

.postcard:hover .postcard__bar {
  width: 100px;
}

@media screen and (min-width: 769px) {
  .postcard {
    flex-wrap: inherit;
  }

  .postcard .postcard__title {
    font-size: 2rem;
  }

  .postcard .postcard__tagbox {
    justify-content: start;
  }

  .postcard .postcard__img {
    max-width: 300px;
    max-height: 100%;
    transition: transform 0.3s ease;
  }

  .postcard .postcard__text {
    padding: 3rem;
    width: 100%;
  }

  .postcard .media.postcard__text:before {
    content: "";
    position: absolute;
    display: block;
    background: #18151f;
    top: -20%;
    height: 130%;
    width: 55px;
  }

  .postcard:hover .postcard__img {
    transform: scale(1.1);
  }

  .postcard:nth-child(2n+1) {
    flex-direction: row;
  }

  .postcard:nth-child(2n+0) {
    flex-direction: row-reverse;
  }

  .postcard:nth-child(2n+1) .postcard__text::before {
    left: -12px !important;
    transform: rotate(4deg);
  }

  .postcard:nth-child(2n+0) .postcard__text::before {
    right: -12px !important;
    transform: rotate(-4deg);
  }
}

@media screen and (min-width: 1024px) {
  .postcard__text {
    padding: 2rem 3.5rem;
  }

  .postcard__text:before {
    content: "";
    position: absolute;
    display: block;
    top: -20%;
    height: 130%;
    width: 55px;
  }

  .postcard.dark .postcard__text:before {
    background: #18151f;
  }

  .postcard.light .postcard__text:before {
    background: #e1e5ea;
  }
}

/* COLORS */
.postcard .postcard__tagbox .green.play:hover {
  background: #79dd09;
  color: black;
}

.green .postcard__title:hover {
  color: #79dd09;
}

.green .postcard__bar {
  background-color: #79dd09;
}

.green::before {
  background-image: linear-gradient(-30deg, rgba(121, 221, 9, 0.1), transparent 50%);
}

.green:nth-child(2n)::before {
  background-image: linear-gradient(30deg, rgba(121, 221, 9, 0.1), transparent 50%);
}

.postcard .postcard__tagbox .blue.play:hover {
  background: #0076bd;
}

.blue .postcard__title:hover {
  color: #0076bd;
}

.blue .postcard__bar {
  background-color: #0076bd;
}

.blue::before {
  background-image: linear-gradient(-30deg, rgba(0, 118, 189, 0.1), transparent 50%);
}

.blue:nth-child(2n)::before {
  background-image: linear-gradient(30deg, rgba(0, 118, 189, 0.1), transparent 50%);
}

.postcard .postcard__tagbox .red.play:hover {
  background: #bd150b;
}

.red .postcard__title:hover {
  color: #bd150b;
}

.red .postcard__bar {
  background-color: #bd150b;
}

.red::before {
  background-image: linear-gradient(-30deg, rgba(189, 21, 11, 0.1), transparent 50%);
}

.red:nth-child(2n)::before {
  background-image: linear-gradient(30deg, rgba(189, 21, 11, 0.1), transparent 50%);
}

.postcard .postcard__tagbox .yellow.play:hover {
  background: #bdbb49;
  color: black;
}

.yellow .postcard__title:hover {
  color: #bdbb49;
}

.yellow .postcard__bar {
  background-color: #bdbb49;
}

.yellow::before {
  background-image: linear-gradient(-30deg, rgba(189, 187, 73, 0.1), transparent 50%);
}

.yellow:nth-child(2n)::before {
  background-image: linear-gradient(30deg, rgba(189, 187, 73, 0.1), transparent 50%);
}

@media screen and (min-width: 769px) {
  .green::before {
    background-image: linear-gradient(-80deg, rgba(121, 221, 9, 0.1), transparent 50%);
  }

  .green:nth-child(2n)::before {
    background-image: linear-gradient(80deg, rgba(121, 221, 9, 0.1), transparent 50%);
  }

  .blue::before {
    background-image: linear-gradient(-80deg, rgba(0, 118, 189, 0.1), transparent 50%);
  }

  .blue:nth-child(2n)::before {
    background-image: linear-gradient(80deg, rgba(0, 118, 189, 0.1), transparent 50%);
  }

  .red::before {
    background-image: linear-gradient(-80deg, rgba(189, 21, 11, 0.1), transparent 50%);
  }

  .red:nth-child(2n)::before {
    background-image: linear-gradient(80deg, rgba(189, 21, 11, 0.1), transparent 50%);
  }

  .yellow::before {
    background-image: linear-gradient(-80deg, rgba(189, 187, 73, 0.1), transparent 50%);
  }

  .yellow:nth-child(2n)::before {
    background-image: linear-gradient(80deg, rgba(189, 187, 73, 0.1), transparent 50%);
  }
}
</style>
