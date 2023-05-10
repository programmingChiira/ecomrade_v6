<template>
  <body class="index-page">
    <div class="full-page-loader" v-if="loading">
      <img src="/triangle.svg" alt="Loader" />
    </div>
    <section class="my-5 py-5">
      <div class="container py-4">
        <div class="row text-center">
          <div class="col-lg-8 mx-auto"><a class="category-link mb-3 d-inline-block" href="#!">Inspire</a>
            <h5>{{ post.title }}</h5>
            <ul class="list-inline mb-5">
              <li class="list-inline-item mx-2"><a class="text-uppercase text-muted reset-anchor" href="#!">BY {{
                post.user_name
              }}</a></li>
            </ul>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 col-5">
            <div class="badges text-right">
              <span style="margin: 3px;" class="badge bg-dark ">
                <i class="fa fa-comments-o"></i> {{ commentCount }}
              </span>
            </div>
          </div>
          <div style="float:right;" class="col-md-8 col-7">
            <router-link v-if="id == false" to="/login" style="float: right;" class="text-info icon-move-right">
              <button type="button" class="btn bg-gradient-primary btn-sm">
                <i class="fa fa-plus"></i>
              </button>
            </router-link>

            <router-link v-else to="/createblog" style="float: right;" class="text-info icon-move-right">
              <button type="button" class="btn bg-gradient-primary btn-sm">
                <i class="fa fa-plus"></i>
              </button>
            </router-link>
          </div>
        </div>


        <div style="background-color: #E9ECEF;" class="text-center p-4">
          <img
            v-if="post.image_1 == false || post.image_1 == null || post.image_1 == 'null' || post.image_1 == '' || post.image_1 == ' ' || post.image_1 == NULL || post.image_1 == 'undefined'"
            loading="lazy" style="width: 100%; height: 40vh; object-fit: cover;" id="main-image" src="/web/img/no_img.jpg"
            class="card-img-top" width="380">

          <img v-else style="width: 100%; height: 40vh; object-fit: contain;" id="main-image"
            :src="'./img/blog/' + post.image_1" class="card-img-top" width="550" @click="activateImageView">
        </div>
        <br />
        <div class="thumbnail text-center">
          <span
            v-if="post.image_1 == false || post.image_1 == null || post.image_1 == 'null' || post.image_1 == '' || post.image_1 == ' ' || post.image_1 == NULL || post.image_1 == 'undefined'">

          </span>
          <span v-else>
            <img
              v-if="post.image_1 == false || post.image_1 == null || post.image_1 == 'null' || post.image_1 == '' || post.image_1 == ' ' || post.image_1 == NULL || post.image_1 == 'undefined'"
              loading="lazy"
              style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
              src="/web/img/no_img.jpg" class="card-img-top" onclick="change_image(this)" width="70">
            <img v-else
              style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
              :src="'./img/blog/' + post.image_1" onclick="change_image(this)" class="card-img-top" width="70">
          </span>

          <span
            v-if="post.image_2 == false || post.image_2 == null || post.image_2 == 'null' || post.image_2 == '' || post.image_2 == ' ' || post.image_2 == NULL || post.image_2 == 'undefined'">

          </span>
          <span v-else>
            <img
              v-if="post.image_2 == false || post.image_2 == null || post.image_2 == 'null' || post.image_2 == '' || post.image_2 == ' ' || post.image_2 == NULL || post.image_2 == 'undefined'"
              loading="lazy"
              style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
              src="/web/img/no_img.jpg" class="card-img-top" onclick="change_image(this)" width="70">
            <img v-else
              style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
              :src="'./img/blog/' + post.image_2" onclick="change_image(this)" class="card-img-top" width="70">
          </span>

          <span
            v-if="post.image_3 == false || post.image_3 == null || post.image_3 == 'null' || post.image_3 == '' || post.image_3 == ' ' || post.image_3 == NULL || post.image_3 == 'undefined'">

          </span>
          <span v-else>
            <img
              v-if="post.image_3 == false || post.image_3 == null || post.image_3 == 'null' || post.image_3 == '' || post.image_3 == ' ' || post.image_3 == NULL || post.image_3 == 'undefined'"
              loading="lazy"
              style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
              src="/web/img/no_img.jpg" class="card-img-top" onclick="change_image(this)" width="70">
            <img v-else
              style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
              :src="'./img/blog/' + post.image_3" onclick="change_image(this)" class="card-img-top" width="70">
          </span>

          <span
            v-if="post.image_4 == false || post.image_4 == null || post.image_4 == 'null' || post.image_4 == '' || post.image_4 == ' ' || post.image_4 == NULL || post.image_4 == 'undefined'">

          </span>
          <span v-else>
            <img
              v-if="post.image_4 == false || post.image_4 == null || post.image_4 == 'null' || post.image_4 == '' || post.image_4 == ' ' || post.image_4 == NULL || post.image_4 == 'undefined'"
              loading="lazy"
              style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
              src="/web/img/no_img.jpg" class="card-img-top" onclick="change_image(this)" width="70">
            <img v-else
              style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
              :src="'./img/blog/' + post.image_4" onclick="change_image(this)" class="card-img-top" width="70">
          </span>

          <span
            v-if="post.image_5 == false || post.image_5 == null || post.image_5 == 'null' || post.image_5 == '' || post.image_5 == ' ' || post.image_5 == NULL || post.image_5 == 'undefined'">

          </span>
          <span v-else>
            <img
              v-if="post.image_5 == false || post.image_5 == null || post.image_5 == 'null' || post.image_5 == '' || post.image_5 == ' ' || post.image_5 == NULL || post.image_5 == 'undefined'"
              loading="lazy"
              style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
              src="/web/img/no_img.jpg" class="card-img-top" onclick="change_image(this)" width="70">
            <img v-else
              style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
              :src="'./img/blog/' + post.image_5" onclick="change_image(this)" class="card-img-top" width="70">
          </span>

        </div>


        <div class="full-image-page" v-if="imageLoading">

          <div class="thumbnail text-center">
            <i style="font-size: 12px;border: white 1px solid; border-radius: 5px;color: white;padding: 10px;float: right;margin: 5px;"
              class="fa fa-times" @click="deactivateImageView"></i>

            <img style="width: 100%; height: 80vh; object-fit: contain;" id="main-view"
              :src="'./img/blog/' + post.image_1" class="card-img-top" width="750" @click="deactivateImageView">

            <span
              v-if="post.image_1 == false || post.image_1 == null || post.image_1 == 'null' || post.image_1 == '' || post.image_1 == ' ' || post.image_1 == NULL || post.image_1 == 'undefined'">

            </span>
            <span v-else>

              <img
                style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                :src="'./img/blog/' + post.image_1" onclick="change_view(this)" class="card-img-top" width="70">
            </span>

            <span
              v-if="post.image_2 == false || post.image_2 == null || post.image_2 == 'null' || post.image_2 == '' || post.image_2 == ' ' || post.image_2 == NULL || post.image_2 == 'undefined'">

            </span>
            <span v-else>
              <img
                style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                :src="'./img/blog/' + post.image_2" onclick="change_view(this)" class="card-img-top" width="70">
            </span>

            <span
              v-if="post.image_3 == false || post.image_3 == null || post.image_3 == 'null' || post.image_3 == '' || post.image_3 == ' ' || post.image_3 == NULL || post.image_3 == 'undefined'">

            </span>
            <span v-else>
              <img
                style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                :src="'./img/blog/' + post.image_3" onclick="change_view(this)" class="card-img-top" width="70">
            </span>

            <span
              v-if="post.image_4 == false || post.image_4 == null || post.image_4 == 'null' || post.image_4 == '' || post.image_4 == ' ' || post.image_4 == NULL || post.image_4 == 'undefined'">

            </span>
            <span v-else>
              <img
                style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                :src="'./img/blog/' + post.image_4" onclick="change_view(this)" class="card-img-top" width="70">
            </span>

            <span
              v-if="post.image_5 == false || post.image_5 == null || post.image_5 == 'null' || post.image_5 == '' || post.image_5 == ' ' || post.image_5 == NULL || post.image_5 == 'undefined'">

            </span>
            <span v-else>

              <img
                style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                :src="'./img/blog/' + post.image_5" onclick="change_view(this)" class="card-img-top" width="70">
            </span>

          </div>
        </div>
        <hr class="horizontal dark my-5">

        <div class="row gy-5">
          <div class="col-lg-9">
            <h4 style="text-decoration: underline;">{{ post.title }}</h4>
            <p class="lead drop-caps mb-3">{{
              post.body
            }}</p>

            <div class="row">
              <div class="col-lg-6 mb-4"><a class="glightbox product-view" href="#" data-gallery="gallery"
                  data-glightbox="Image one"></a></div>
            </div>

            <figure class="bg-light p-4 p-lg-5 text-center mb-5">
              <blockquote class="blockquote">
                <p class="h4 mb-5">Design is the fundamental soul of a human-made creation that ends up expressing
                  itself in successive outer layers of the product or service.</p>
              </blockquote>
              <figcaption class="blockquote-footer">
                <cite class="fst-normal" title="Source Title">Steve Jobs</cite>
              </figcaption>
            </figure>
            <div class="d-flex align-items-center flex-column flex-sm-row mb-5 p-4 bg-light">
              <h3 class="h4 mb-3 mb-sm-0">Share ecomrade</h3>
              <ul class="list-inline mb-0 ms-0 ms-sm-3">
                <li class="list-inline-item me-1 my-1">
                  <a href="https://twitter.com/intent/tweet?text=ecormade,%20a%20hub%20for%20Kenyan%20comrades,%20rentals,%20market.%20%23comrade%20%23university%20%23ecommerce&url=https%3A%2F%2Fwww.ecomrade.co.ke"
                    class="btn btn-info mb-0 me-2" target="_blank">
                    <i class="fab fa-twitter me-1"></i> Tweet
                  </a>
                </li>
                <li class="list-inline-item me-1 my-1">
                  <a style="background-color: #3b5998;"
                    href="https://www.facebook.com/sharer/sharer.php?u=https://www.ecomrade.co.ke"
                    class="btn btn-primary mb-0 me-2" target="_blank">
                    <i class="fab fa-facebook-square me-1"></i> Share
                  </a>
                </li>
              </ul>
            </div>
            <!-- Leave comment-->

            <div class="rating-stars"> Rate This Post : <br />
              <span class="pointer" style="font-size: 25px;" v-for="star in stars" :key="star" @click="setRating(star)"
                :class="{ 'selected': star <= rating }">
                &#9733;
              </span>
            </div>
            <form @submit.prevent="submit" class="mb-5">
              <div class="row gy-3">
                <input class="form-control" type="hidden" v-model="ratingValue" />

                <input class="form-control" type="hidden" v-model="senderName" />

                <input class="form-control" type="hidden" v-model="senderId" />

                <input class="form-control" type="hidden" v-model="userId" />

                <input class="form-control" type="hidden" v-model="postId" />

                <input class="form-control" type="hidden" v-model="postName" />

                <input class="form-control" type="hidden" v-model="postCat" />
                <div class="col-lg-12">
                  <textarea name="message" v-model="comment" class="form-control" id="message" rows="6"
                    placeholder="Comment Here ...."></textarea>
                </div>
                <div class="col-lg-12">
                  <router-link v-if="id == false" class="btn btn-primary" to="/login">Send</router-link>
                  <button v-else class="btn btn-primary" type="submit">Send</button>
                </div>
              </div>
            </form>
            <!-- Post comments-->
            <h3 class="h4 mb-4">Reviews</h3>
            <div class="badges">
              <span style="margin: 3px;" class="badge bg-dark ">
                <i class="fa fa-comments-o"></i> {{ commentCount }}
              </span>
              <span style="margin: 3px;" class="badge bg-dark">
                <div v-if="Math.round(avgRating) === 0" class="stars">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
                <div v-if="Math.round(avgRating) === 1" class="stars">
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
                <div v-if="Math.round(avgRating) === 2" class="stars">
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
                <div v-if="Math.round(avgRating) === 3" class="stars">
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
                <div v-if="Math.round(avgRating) === 4" class="stars">
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
                <div v-if="Math.round(avgRating) === 5" class="stars">
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i style="color: orange;" class="fa fa-star"></i>
                  <i style="color: orange;" class="fa fa-star"></i>
                </div>
              </span>
            </div>
            <br />

            <ul style="height: 40vh;width: 100%;overflow-y: auto;" class="list-unstyled comments">
              <li v-for="(review, index) in postreviews" :key="review.id">
                <div class="d-flex mb-4" v-if="review.postId == post.id">
                  <div class="comment-ratings">
                    <span
                      v-if="review.ratingValue == 0 || review.ratingValue == false || review.ratingValue == null || review.ratingValue == 'null' || review.ratingValue == '' || review.ratingValue == 'NULL' || review.ratingValue == 'undefined'">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </span>
                    <span v-if="review.ratingValue == 1">
                      <i style="color: orange;" class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </span>
                    <span v-if="review.ratingValue == 2">
                      <i style="color: orange;" class="fa fa-star"></i>
                      <i style="color: orange;" class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </span>
                    <span v-if="review.ratingValue == 3">
                      <i style="color: orange;" class="fa fa-star"></i>
                      <i style="color: orange;" class="fa fa-star"></i>
                      <i style="color: orange;" class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </span>
                    <span v-if="review.ratingValue == 4">
                      <i style="color: orange;" class="fa fa-star"></i>
                      <i style="color: orange;" class="fa fa-star"></i>
                      <i style="color: orange;" class="fa fa-star"></i>
                      <i style="color: orange;" class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </span>
                    <span v-if="review.ratingValue == 5">
                      <i style="color: orange;" class="fa fa-star"></i>
                      <i style="color: orange;" class="fa fa-star"></i>
                      <i style="color: orange;" class="fa fa-star"></i>
                      <i style="color: orange;" class="fa fa-star"></i>
                      <i style="color: orange;" class="fa fa-star"></i>
                    </span>
                  </div>
                  <div class="ms-3">
                    <p class="small mb-0 text-primary fw-normal">{{ review.created_at }}
                      <button v-if="review.senderId == id" type="button" @click="destroy(review.id)" class="delete-btn"
                        style="float: right;border:none;outline:none;background: none;">
                        <i class="fa fa-trash-o" style="color: red;"></i>
                      </button>
                      <hr class="horizontal dark my-2">
                    </p>
                    <h5>{{ review.senderName }}</h5>
                    <p class="text-muted text-sm mb-2">{{ review.comment }}</p>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <!-- Blog sidebar-->
          <div class="col-lg-3">
            <!-- About category-->
            <div class="card bg-light mb-4 py-lg-4">
              <div class="card-body text-center">
                <h2 class="h3 mb-3">About me</h2>
                <router-link to="/profile">
                  🥳
                </router-link>
                <p class="text-sm text-muted">Hello, am {{ post.user_name }}.
                  View my
                  <router-link style="color: #17C1E8;text-decoration:underline;" :to="'/profile' + post.user_slug">
                    profile
                  </router-link> to know more about me, and below are my social media links for more interaction.
                </p>
              </div>
            </div>
            <!-- Recent posts-->
            <div class="card mb-4">
              <div class="card-body p-0">
                <h2 style="padding: 8px;" class="h5 mb-3">Recent posts</h2>
                <div v-for="similar in posts" :key="similar.id" class="d-flex mb-3">
                  <div class="ms-3">
                    <h6>
                      <router-link class="reset-anchor" :to="{
                        name: 'ViewBlog',
                        params: { slug: similar.slug },
                      }">
                        {{ similar.title }}
                      </router-link>
                    </h6>
                    <p class="text-sm text-muted lh-sm mb-0">{{ truncateText(similar.body) }}</p>
                    <hr class="horizontal dark my-1">
                  </div>

                </div>
              </div>
            </div>
            <!-- Categories-->
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
  props: ["slug"],
  data() {
    return {
      post: {},
      posts: {},
      relatedPosts: [],

      reviewCount: 0,
      rating: 0,
      postreviews: {},
      id: "",
      name: "",
      avgRating: 0,
      commentCount: 0,
      loading: true,
      imageLoading: false
    };
  },

  computed: {
    stars() {
      return Array.from({ length: 5 }, (_, i) => i + 1);
    },

    ratingValue: {
      get() {
        return this.rating;
      },
      set(value) {
        this.rating = value;
      }
    },

    senderName: {
      get() {
        return this.name;
      },
      set(value) {
        this.name = value;
      }
    },

    senderId: {
      get() {
        return this.id;
      },
      set(value) {
        this.id = value;
      }
    },

    userId: {
      get() {
        return this.post.user_id;
      },
      set(value) {
        this.post.user_id = value;
      }
    },

    postId: {
      get() {
        return this.post.id;
      },
      set(value) {
        this.post.id = value;
      }
    },

    postSlug: {
      get() {
        return this.post.slug;
      },
      set(value) {
        this.post.slug = value;
      }
    },

    postName: {
      get() {
        return this.post.title;
      },
      set(value) {
        this.post.title = value;
      }
    },

    postCat: {
      get() {
        return this.post.post_category;
      },
      set(value) {
        this.post.post_category = value;
      }
    },
  },

  methods: {

    activateImageView() {
      this.imageLoading = true;
    },

    deactivateImageView() {
      this.imageLoading = false;
    },

    truncateText(posts) {
      const truncatedText = posts.slice(0, 30) + '...'
      return truncatedText
    },

    setRating(rating) {
      this.rating = rating;
    },

    submit() {

      const fd = new FormData();
      fd.append("ratingValue", this.ratingValue);
      fd.append("senderName", this.senderName);
      fd.append("senderId", this.senderId);
      fd.append("userId", this.userId);
      fd.append("postId", this.postId);
      fd.append("postName", this.postName);
      fd.append("postCat", this.postCat);
      fd.append("comment", this.comment);

      fd.append("_method", "POST");


      axios
        .post("/api/postreviews", fd, {
          headers: { "content-type": "multipart/form-data" },
        })
        .then(() => {
          let timerInterval
          Swal.fire({
            title: 'Processing',
            html: ' ',
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

          setTimeout(() => {
            this.success = false;
          }, 2500);

          this.ratingValue = '';
          this.comment = '';

          axios.get('/api/postreviews')
            .then(response => {
              this.postreviews = response.data.data;
            });

          axios.get(`/api/posts/${this.$route.params.slug}`)
            .then(response => {
              console.log(JSON.stringify(response));
              this.post = response.data.data;
              this.avgRating = response.data.avg_rate;
              this.commentCount = response.data.comment_count;
              this.postNameCount = response.data.postName_count;
            });
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          this.success = false;
        });
    },

    sendReport() {

      const fd = new FormData();
      fd.append("user_id", this.userId);
      fd.append("id", this.postId);
      fd.append("product_name", this.postName);
      fd.append("product_category", this.postCat);
      fd.append("image_1", this.postImage);
      fd.append("slug", this.postSlug);
      fd.append("contact", this.postContact);
      fd.append("product_price", this.postPrice);
      fd.append("product_discount", this.postDiscount);

      fd.append("post_issue", this.post_issue);
      fd.append("post_complaint", this.post_complaint);

      fd.append("_method", "POST");


      axios
        .post("/api/reports", fd, {
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
          this.postIssue = '';
          this.postComplaint = '';
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
            .delete("/api/postreviews/" + id)
            .then((response) => {
              Swal.fire(
                'Deleted!',
                'Information has been successfully deleted.',
                'success'
              );
              // Fire.$emit('AfterCreate');
              axios.get("/api/postreviews").then(({
                data
              }) => (this.postreviews = data.data))
            }).catch((error) => {
              Swal.fire("Failed!", error.message, "warning");
            });

          axios.get(`/api/posts/${this.$route.params.slug}`)
            .then(response => {
              console.log(JSON.stringify(response));
              this.post = response.data.data;
              this.avgRating = response.data.avg_rate;
              this.commentCount = response.data.comment_count;
            });
        }
      })
    },
  },

  mounted() {
    setTimeout(() => {
      this.loading = false;
    }, 2000);

    axios
      .get("/api/user")
      //.then((response) => (this.id = response.data.id))
      .then(response => {
        this.id = response.data.id
        this.name = response.data.name
        this.slug = response.data.slug
      })
      .catch((error) => {
        if (error.response.status === 401) {
          this.$emit("updateSidebar");
          localStorage.removeItem("authenticated");
        }
      });

    axios
      .get("/api/posts/" + this.slug)
      .then(response => {
        console.log(JSON.stringify(response));
        this.post = response.data.data;
        this.avgRating = response.data.avg_rate;
        this.commentCount = response.data.comment_count;
      })
      .catch((error) => {
        console.log(error);
      });

    axios.get("/api/posts").then(({
      data
    }) => (this.posts = data.data));

    // axios.get(`/api/posts/${this.$route.params.slug}`)
    //       .then(response => {
    //           console.log(JSON.stringify(response));
    //           this.post = response.data.data;
    //           this.avgRating = response.data.avg_rate;
    //           this.commentCount = response.data.comment_count;
    //       });

    axios.get('/api/postreviews')
      .then(response => {
        this.postreviews = response.data.data;
      });
  },
};
</script>

<style>
.pointer {
  cursor: pointer;
}

.card {
  border: none
}

.product {
  background-color: #eee;
  height: 100%;
}

.brand {
  font-size: 13px
}

.act-price {
  color: red;
  font-weight: 700
}

.dis-price {
  text-decoration: line-through
}

.about {
  font-size: 14px
}

.color {
  margin-bottom: 10px
}

label.radio {
  cursor: pointer
}

label.radio input {
  position: absolute;
  top: 0;
  left: 0;
  visibility: hidden;
  pointer-events: none
}

label.radio span {
  padding: 2px 9px;
  border: 2px solid #ff0000;
  display: inline-block;
  color: #ff0000;
  border-radius: 3px;
  text-transform: uppercase
}

label.radio input:checked+span {
  border-color: #ff0000;
  background-color: #ff0000;
  color: #fff
}

.btn-danger {
  background-color: #ff0000 !important;
  border-color: #ff0000 !important
}

.btn-danger:hover {
  background-color: #da0606 !important;
  border-color: #da0606 !important
}

.btn-danger:focus {
  box-shadow: none
}

.cart i {
  margin-right: 10px
}


.rating span {
  cursor: pointer;
  padding: 0 5px;
}

.selected {
  color: orange;
}

.rating-stars-container {
  text-align: center;
}

.rating-stars {
  display: inline-block;
  margin: 20px;
}

.rating-star {
  font-size: 44px;
  cursor: pointer;
}

.bottom-message {
  font-size: 0.85em;
}

.sr-navigator-container.visible-sm-block {
  margin-top: 30px;
}

.notes-container {
  margin: auto;
  margin-top: 20px;
  width: 50%;
}

#myNotesView {
  display: block;
}

.notes-buttons {
  margin-top: 10px;
}

@media (max-width: 767px) {
  .notes-container {
    width: 100%;
  }
}

.btn-ls-blue {
  background-color: #4984a3;
  border: none;
  -o-transition: background-color 0.215s;
  -moz-transition: background-color 0.215s;
  -webkit-transition: background-color 0.215s;
  transition: background-color 0.215s;
}

.btn-ls-blue:hover,
.btn-ls-blue:active,
.btn-ls-blue:focus,
.btn-ls-blue.active {
  background-color: #00a8cc;
}

.hide {
  display: none;
}
</style>