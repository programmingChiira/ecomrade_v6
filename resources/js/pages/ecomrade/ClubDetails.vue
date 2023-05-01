<template>
  <body class="index-page">
    <section class="my-5 py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-9">
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
              <div class="container">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                  <li class="breadcrumb-item"><router-link to="/club">Club</router-link></li>
                  <li style="color: #189483;" class="breadcrumb-item"><strong>View</strong></li>
                </ol>
              </div>
            </nav>
          </div>
        </div>
        <br />

        <div class="row g-6 mb-6 align-items-center justify-content-center">
          <div class="col-xl-3 col-sm-6 col-12">
            <div style="background-color: #E9ECEF;" class="card shadow border-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <span class="h6 font-semibold text-muted text-sm d-block mb-2">Users</span>
                    <span class="h3 font-bold mb-0">{{ clubuser.club_users_count }}</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-tertiary text-white text-lg rounded-circle">
                      <i class="bi bi-credit-card"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 col-12">
            <div style="background-color: #E9ECEF;" class="card shadow border-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <span class="h6 font-semibold text-muted text-sm d-block mb-2"> Articles</span>
                    <span class="h3 font-bold mb-0"> {{ clubarticle.club_articles_count }}</span>
                  </div>
                  <div class="col-auto">

                    <router-link style="margin: 4px;" class="text-info" :to="{
                      name: 'CreateBlogClub',
                      params: { slug: slug },
                    }">
                      <div style="text-align: center;"
                        class="icon icon-shape bg-primary text-white text-lg rounded-circle">
                        <i class="fa fa-plus"></i>
                      </div>
                    </router-link>
                  </div>
                </div>

                <div class="mt-2 mb-0 text-sm">
                  <router-link style="margin: 4px;" class="text-info" :to="{
                    name: 'SeeBlogClub',
                    params: { slug: slug },
                  }">
                    <button data-toggle="tooltip" data-placement="bottom" title="Articles"
                      type="button" class="btn bg-gradient-primary btn-block btn-sm">
                      <small> Articles</small>
                    </button>
                  </router-link>
                </div>

              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12">
            <div style="background-color: #E9ECEF;" class="card shadow border-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <span class="h6 font-semibold text-muted text-sm d-block mb-2"> Products</span>
                    <span class="h3 font-bold mb-0">{{ clubmarket.club_markets_count }}</span>
                  </div>
                  <div style="text-align: center;" class="col-auto">
                    <router-link class="text-info" :to="{
                      name: 'CreateMarketClub',
                      params: { slug: slug },
                    }">
                      <div class="icon icon-shape bg-info text-white text-lg rounded-circle">
                        <i class="fa fa-plus"></i>
                      </div>
                    </router-link>
                  </div>
                </div>

                <div class="mt-2 mb-0 text-sm">
                  <router-link class="text-info" :to="{
                    name: 'SeeMarketClub',
                    params: { slug: slug },
                  }">
                    <button data-toggle="tooltip" data-placement="bottom" title="Blogs"
                      type="button" class="btn bg-gradient-primary btn-block btn-sm">
                      <small> Products</small>
                    </button>
                  </router-link>
                </div>

              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12">
            <div style="background-color: #E9ECEF;" class="card shadow border-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <span class="h6 font-semibold text-muted text-sm d-block mb-2">Events</span>
                    <span class="h3 font-bold mb-0">{{ clubevent.club_events_count }}</span>
                  </div>
                  <div style="text-align: center;" class="col-auto">

                    <router-link class="text-info" :to="{
                      name: 'CreateEventClub',
                      params: { slug: slug },
                    }">
                      <div class="icon icon-shape bg-warning text-white text-lg rounded-circle">
                        <i class="fa fa-plus"></i>
                      </div>
                    </router-link>
                  </div>
                </div>

                <div class="mt-2 mb-0 text-sm">
                  <router-link class="text-info" :to="{
                    name: 'SeeEventClub',
                    params: { slug: slug },
                  }">
                    <button data-toggle="tooltip" data-placement="bottom" title="Events"
                      type="button" class="btn bg-gradient-primary btn-block btn-sm">
                      <small> Events</small>
                    </button>
                  </router-link>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 col-12">
            <div style="background-color: #E9ECEF;" class="card shadow border-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <span class="h6 font-semibold text-muted text-sm d-block mb-2">Polls</span>
                    <span class="h3 font-bold mb-0">{{ clubpoll.club_polls_count }}</span>
                  </div>
                  <div style="text-align:center;" class="col-auto">
                    <router-link class="text-info" :to="{
                      name: 'CreatePollClub',
                      params: { slug: slug },
                    }">
                      <div class="icon icon-shape bg-danger text-white text-lg rounded-circle">
                        <i class="fa fa-plus"></i>
                      </div>
                    </router-link>

                  </div>
                </div>

                <div class="mt-2 mb-0 text-sm">
                  <router-link class="text-info" :to="{
                    name: 'SeePollClub',
                    params: { slug: slug },
                  }">
                    <button data-toggle="tooltip" data-placement="bottom" title="Polls"
                      type="button" class="btn bg-gradient-primary btn-block btn-sm">
                      <small> Polls</small>
                    </button>
                  </router-link>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 col-12">
            <div style="background-color: #E9ECEF;" class="card shadow border-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <span class="h6 font-semibold text-muted text-sm d-block mb-2">Resources</span>
                    <span class="h3 font-bold mb-0">{{ clubresource.club_resources_count }}</span>
                  </div>
                  <div style="text-align: center;" class="col-auto">
                    <router-link class="text-info" :to="{
                      name: 'CreateResourceClub',
                      params: { slug: slug },
                    }">
                      <div class="icon icon-shape bg-success text-white text-lg rounded-circle">
                        <i class="fa fa-plus"></i>
                      </div>
                    </router-link>

                  </div>
                </div>

                <div class="mt-2 mb-0 text-sm">
                  <router-link class="text-info" :to="{
                    name: 'SeeResourceClub',
                    params: { slug: slug },
                  }">
                    <button data-toggle="tooltip" data-placement="bottom" title="Resources"
                      type="button" class="btn bg-gradient-primary btn-block btn-sm">
                      <small> Resources</small>
                    </button>
                  </router-link>
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
import Footer from './Footer.vue';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
export default {
  components: {
    Footer
  },
  emits: ["updateSidebar"],
  props: ["slug"],
  data() {
    return {
      club: {},
      clubarticle: {},
      clubmarket: {},
      clubevent: {},
      clubpoll: {},
      clubresource: {},
      clubuser: {},
      id: "",
      fields: {
        message: "",
        post_category: "",
      },
      name: "",
      url1: "",
      clubchats: [],
      messageCount: 0,
    };
  },
  computed: {
    roomId: {
      get() {
        return this.club.id;
      },
      set(value) {
        this.club.id = value;
      }
    },
  },
  methods: {

    grabFile1(event) {
      this.fields.file1 = event.target.files[0];
      this.url1 = URL.createObjectURL(event.target.files[0]);
      URL.revokeObjectURL(event.target.files[0]);
    },

    submit() {
      // if (this.fields.message.trim() === '') return;
      const formData = new FormData();
      formData.append('message', this.fields.message);
      formData.append('room_id', this.roomId);
      formData.append("file1", this.fields.file1);
      formData.append('_method', 'POST');

      axios.post('/api/clubchats', formData, {
        headers: { 'content-type': 'multipart/form-data' },
      })
        .then(() => {

          this.fields.message = '';
          this.fields.file1 = '';

          axios.get('/api/clubchats')
            .then(({ data }) => {
              this.clubchats = data.data;
            });

          axios.get(`/api/clubs/${this.$route.params.slug}`)
            .then(({ data }) => {
              this.messageCount = data.message_count;
            });

          Pusher.logToConsole = true;
          const pusher = new Pusher('9820769533922d6161b6', {
            cluster: 'ap2',
          });
          const channel = pusher.subscribe('my-club-channel');
          const chat = channel.bind('my-club-event', (data) => {
            //this.clubchats.push(data);
          });

          document.querySelector('#exampleModal button[data-bs-dismiss="modal"]').click();
        })
        .catch((error) => {
          console.error(error);
          this.errors = error.response.data.errors;
          this.success = false;
        });

      this.$nextTick(() => {
        this.$refs.chatContent.scrollTop = this.$refs.chatContent.scrollHeight;
      });

      let timerInterval
      Swal.fire({
        title: 'Processing...',
        html: '',
        timer: 2000,
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
          console.log('I was closed by the timer')
        }
      })

    },

    scrollToLastMessage() {
      const chatContent = this.$refs.chatContent;
      chatContent.scrollTop = chatContent.scrollHeight;
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
            .delete("/api/clubchats/" + id)
            .then((response) => {
              Swal.fire(
                'Deleted!',
                'Information has been successfully deleted.',
                'success'
              );
              // Fire.$emit('AfterCreate');
              axios.get("/api/clubchats").then(({
                data
              }) => (this.clubchats = data.data))
            }).catch((error) => {
              Swal.fire("Failed!", error.message, "warning");
            });

          axios.get(`/api/clubs/${this.$route.params.slug}`)
            .then(response => {
              //console.log(JSON.stringify(response));
              this.club = response.data.data;
              this.messageCount = response.data.message_count;
            });
        }
      })
    },
  },
  mounted() {
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
          this.$router.push({ name: "Login" });
        }
      });

    axios
      .get("/api/clubs/" + this.slug)
      .then(response => {
        //console.log(JSON.stringify(response));
        this.club = response.data.data;
      })
      .catch((error) => {
        //console.log(error);
      });

    axios
      .get("/api/clubarticles/" + this.slug)
      .then(response => {
        //console.log(JSON.stringify(response));
        this.clubarticle = response.data.data;
      })
      .catch((error) => {
        //console.log(error);
      });

    axios
      .get("/api/clubmarkets/" + this.slug)
      .then(response => {
        //console.log(JSON.stringify(response));
        this.clubmarket = response.data.data;
      })
      .catch((error) => {
        //console.log(error);
      });

    axios
      .get("/api/clubevents/" + this.slug)
      .then(response => {
        //console.log(JSON.stringify(response));
        this.clubevent = response.data.data;
      })
      .catch((error) => {
        //console.log(error);
      });

    axios
      .get("/api/clubpolls/" + this.slug)
      .then(response => {
        //console.log(JSON.stringify(response));
        this.clubpoll = response.data.data;
      })
      .catch((error) => {
        //console.log(error);
      });

    axios
      .get("/api/clubresources/" + this.slug)
      .then(response => {
        //console.log(JSON.stringify(response));
        this.clubresource = response.data.data;
      })
      .catch((error) => {
        //console.log(error);
      });

      axios
      .get("/api/clubusers/" + this.slug)
      .then(response => {
        //console.log(JSON.stringify(response));
        this.clubuser = response.data.data;
      })
      .catch((error) => {
        //console.log(error);
      });

    axios.get('/api/clubchats')
      .then(({ data }) => {
        this.clubchats = data.data;
      });

    Pusher.logToConsole = true;
    const pusher = new Pusher('9820769533922d6161b6', {
      cluster: 'ap2',
    });
    const channel = pusher.subscribe('my-club-channel');
    const chat = channel.bind('my-club-event', (data) => {
      this.clubchats.push(data);
    });
  },
};
</script>


<style scoped>
/* Style the scrollbar */

::-webkit-scrollbar {
  width: 10px;
}

/* Style the scrollbar track */
::-webkit-scrollbar-track {
  background-color: #f5f5f5;
}

/* Style the scrollbar thumb */
::-webkit-scrollbar-thumb {
  background-color: #ccc;
  border-radius: 10px;
}

/* Style the scrollbar thumb on hover */
::-webkit-scrollbar-thumb:hover {
  background-color: #999;
}


.card-bordered {
  border: 1px solid #ebebeb;
}

.card {
  border: 0;
  border-radius: 0px;
  margin-bottom: 30px;
  -webkit-box-shadow: 0 2px 3px rgba(0, 0, 0, 0.03);
  box-shadow: 0 2px 3px rgba(0, 0, 0, 0.03);
  -webkit-transition: .5s;
  transition: .5s;
}

.padding {
  padding: 3rem !important
}

.card-header:first-child {
  border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
}


.card-header {
  display: -webkit-box;
  display: flex;
  -webkit-box-pack: justify;
  justify-content: space-between;
  -webkit-box-align: center;
  align-items: center;
  padding: 15px 20px;
  border-bottom: 1px solid rgba(77, 82, 89, 0.07);
}

.card-header .card-title {
  padding: 0;
  border: none;
}

h4.card-title {
  font-size: 17px;
}

.card-header>*:last-child {
  margin-right: 0;
}

.ps-container {
  position: relative;
}

.ps-container {
  -ms-touch-action: auto;
  touch-action: auto;
  overflow: hidden !important;
  -ms-overflow-style: none;
}

.media-chat {
  padding-right: 64px;
  margin-bottom: 0;
}

.media {
  padding: 16px 12px;
  -webkit-transition: background-color .2s linear;
  transition: background-color .2s linear;
}

.media .avatar {
  flex-shrink: 0;
}

.avatar {
  position: relative;
  display: inline-block;
  width: 36px;
  height: 36px;
  line-height: 36px;
  text-align: center;
  border-radius: 100%;
  background-color: #f5f6f7;
  color: #1a1b1d;
  text-transform: uppercase;
}

.media-chat .media-body {
  -webkit-box-flex: initial;
  flex: initial;
  display: table;
}

.media-body {
  min-width: 0;
}

.media-chat .media-body p {
  position: relative;
  padding: 6px 8px;
  margin: 4px 0;
  border-radius: 3px;
  font-weight: 500;
  color: black;
}

.media>* {
  margin: 0 8px;
}

.media-chat .media-body p.meta {
  padding: 0;
  opacity: .8;
}

.media-meta-day {
  -webkit-box-pack: justify;
  justify-content: space-between;
  -webkit-box-align: center;
  align-items: center;
  margin-bottom: 0;
  color: #8b95a5;
  opacity: .8;
  font-weight: 400;
}

.media {
  padding: 16px 12px;
  -webkit-transition: background-color .2s linear;
  transition: background-color .2s linear;
}

.media-meta-day::before {
  margin-right: 16px;
}

.media-meta-day::before,
.media-meta-day::after {
  content: '';
  -webkit-box-flex: 1;
  flex: 1 1;
  border-top: 1px solid #ebebeb;
}

.media-meta-day::after {
  content: '';
  -webkit-box-flex: 1;
  flex: 1 1;
  border-top: 1px solid #ebebeb;
}

.media-meta-day::after {
  margin-left: 16px;
}

.media-chat.media-chat-reverse {
  float: right;
}

.media-chat {
  padding-right: 64px;
  margin-bottom: 0;
}

.media {
  padding: 16px 12px;
  -webkit-transition: background-color .2s linear;
  transition: background-color .2s linear;
}

.media-chat.media-chat-reverse .media-body p {
  float: right;
  clear: right;
  background-color: #48b0f7;
  color: #fff;
}

.media-chat .media-body p {
  position: relative;
  padding: 6px 8px;
  margin: 4px 0;
  background-color: #d2d2d3;
  border-radius: 3px;
}


.border-light {
  border-color: #f1f2f3 !important;
}

.bt-1 {
  border-top: 1px solid #ebebeb !important;
}

.publisher {
  position: relative;
  display: -webkit-box;
  display: flex;
  -webkit-box-align: center;
  align-items: center;
  padding: 12px 20px;
  background-color: #f9fafb;
}

.publisher>*:first-child {
  margin-left: 0;
}

.publisher>* {
  margin: 0 8px;
}

.publisher-input {
  -webkit-box-flex: 1;
  flex-grow: 1;
  border: none;
  outline: none !important;
  background-color: transparent;
}

button,
input,
optgroup,
select,
textarea {
  font-weight: 300;
}

.publisher-btn {
  background-color: transparent;
  border: none;
  color: #8b95a5;
  font-size: 16px;
  cursor: pointer;
  overflow: -moz-hidden-unscrollable;
  -webkit-transition: .2s linear;
  transition: .2s linear;
}

.file-group {
  position: relative;
  overflow: hidden;
}

.publisher-btn {
  background-color: transparent;
  border: none;
  color: #cac7c7;
  font-size: 16px;
  cursor: pointer;
  overflow: -moz-hidden-unscrollable;
  -webkit-transition: .2s linear;
  transition: .2s linear;
}

.file-group input[type="file"] {
  position: absolute;
  opacity: 0;
  z-index: -1;
  width: 20px;
}

.text-info {
  color: #48b0f7 !important;
}
</style>