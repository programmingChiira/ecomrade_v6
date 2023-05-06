<template>
  <body class="index-page">
    <section class="my-5 py-5">
      <div class="container">
        <div class="row no-gutters  d-flex justify-content-center">
          <div class="page-content page-container" id="page-content">
            <div class="col-md-12">
              <div class="card card-bordered">
                <div style="background-color: #E9ECEF;border-radius: 5px;" class="card-header">
                  <router-link :to="{
                    name: 'ClubDetails',
                    params: { slug: slug },
                  }">

                    <img
                      v-if="club.image_1 == false || club.image_1 == null || club.image_1 == 'null' || club.image_1 == '' || club.image_1 == ' ' || club.image_1 == NULL"
                      loading="lazy"
                      style="width: 50px; height: 50px; border-radius: 75px; border: 1px solid black;object-fit: cover;"
                      src="/web/img/no_img.jpg">


                    <img loading="lazy" v-else :src="'./img/clubs/' + club.image_1"
                      style="width: 50px; height: 50px; border-radius: 75px; border: 1px solid black;object-fit: cover;">

                  </router-link>
                  <button style="border:none;outline:none;background: none;" @click="scrollToLastMessage"
                    data-abc="true"><i class="fa fa-arrow-circle-down" style="font-size:24px"></i></button>
                </div>


                <div class="ps-container ps-theme-default ps-active-y" id="chat-content" ref="chatContent"
                  style="overflow-y: scroll !important; height: 55vh !important;">
                  <div v-for="(chat, index) in clubchats" :key="index">
                    <div style="display: flex; flex-direction: column;">
                      <div v-if="chat.user_id != id && club.id == chat.room_id"
                        style="align-self: flex-start;max-width:70%;">
                        <div class="media media-chat">
                          <div class="media-body">
                            <span
                              v-if="chat.image_1 == false || chat.image_1 == null || chat.image_1 == 'null' || chat.image_1 == '' || chat.image_1 == ' ' || chat.image_1 == NULL || chat.image_1 == 'undefined'">
                            </span>
                            <a v-else href="#" title="Post" data-toggle="tooltip" data-placement="bottom"
                              data-bs-toggle="modal" :data-bs-target="'#exampleModal1-' + index">
                              <img loading="lazy"
                                style="background-color: white;width: 100%;height: 300px; object-fit: cover;border-radius: 5px;"
                                :src="'./img/chatroom/' + chat.image_1">
                            </a>
                            <div class="modal fade" :id="'exampleModal1-' + index" tabindex="-1"
                              :aria-labelledby="'exampleModal1Label-' + index" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">
                                      Image
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                      aria-label="Close"></button>
                                  </div>

                                  <div class="container row">
                                    <img loading="lazy"
                                      style="background-color: white;width: 100%;height: 70vh; object-fit: contain;border-radius: 5px;"
                                      :src="'./img/chatroom/' + chat.image_1">
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn bg-gradient-dark btn-sm"
                                      data-bs-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <p class="message" style="color: black;">{{ chat.message }} </p>
                            <h6 style="font-size: 10px;"><time datetime="2018"> {{ chat.created_at }} </time></h6>
                          </div>
                        </div>
                      </div>
                      <div v-else-if="club.id == chat.room_id" style="align-self: flex-end;max-width:70%;">
                        <div class="media media-chat">
                          <div class="media-body">
                            <span
                              v-if="chat.image_1 == false || chat.image_1 == null || chat.image_1 == 'null' || chat.image_1 == '' || chat.image_1 == ' ' || chat.image_1 == NULL || chat.image_1 == 'undefined'">
                            </span>
                            <a v-else href="#" data-toggle="tooltip" data-placement="bottom" title="Post"
                              data-bs-toggle="modal" :data-bs-target="'#exampleModal' + index">
                              <img loading="lazy"
                                style="background-color: white;width: 100%;height: 300px; object-fit: cover;border-radius: 5px;"
                                :src="'./img/chatroom/' + chat.image_1">
                            </a>
                            <div class="modal fade" :id="'exampleModal' + index" tabindex="-1"
                              aria-labelledby="exampleModal2Label" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModal2Label">
                                      Image
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                      aria-label="Close"></button>
                                  </div>

                                  <div class="container row">
                                    <img loading="lazy"
                                      style="background-color: white;width: 100%;height: 70vh; object-fit: contain;border-radius: 5px;"
                                      :src="'./img/chatroom/' + chat.image_1">
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn bg-gradient-dark btn-sm"
                                      data-bs-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <p class="message" style="color: black;background-color: #48b0f7;"> {{ chat.message }} </p>
                            <h6 style="font-size: 10px;"><time datetime="2018"> {{ chat.created_at }} </time></h6>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <br /><br /><br />

                  <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                    <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                  </div>
                  <div class="ps-scrollbar-y-rail" style="top: 0px; height: 0px; right: 2px;">
                    <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 2px;"></div>
                  </div>
                </div>


                <form v-if="club.subscribed == true" @submit.prevent="submit">
                  <h5 style="padding: 10px;text-align:center;" v-if="messageCount <= 0">Sorry, no chats found!</h5>
                  <div class="publisher bt-1 border-light">
                    <img loading="lazy" class="avatar avatar-xs" src="/img/user.png" alt="...">
                    <input type="hidden" v-model="roomId1">
                    <input type="hidden" v-model="userId1">
                    <input class="publisher-input" type="text" v-model="fields.message" placeholder="Text...">
                    <button type="button" style="outline: none;" data-toggle="tooltip" data-placement="bottom"
                      title="Post Image" data-bs-toggle="modal" data-bs-target="#exampleModal"
                      class="publisher-btn file-group">
                      <i class="fa fa-paperclip file-browser"></i>
                    </button>

                    <button type="submit" class="publisher-btn text-info" data-abc="true"
                      style="border:none;outline:none;background: none;">
                      <i class="fa fa-paper-plane"></i>
                    </button>
                  </div>
                </form>

                <form v-if="club.subscribed == false" @submit.prevent="subscribe">
                  <div class="publisher bt-1 border-light">
                    <input type="hidden" v-model="roomId2">
                    <input type="hidden" v-model="userId2">
                    <button type="submit" class="btn bg-gradient-primary btn-block btn-sm">
                      JOIN ROOM TO CHAT
                    </button>
                  </div>
                </form>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" ref="modal"
                  aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                          Upload image
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>

                      <form @submit.prevent="submit">

                        <div style="padding: 15px;" class="container row">

                          <label for="image"><span>Image : </span></label>
                          <input class="form-control" type="file" @input="grabFile1">

                          <div class="preview row">
                            <img loading="lazy" style="width: 100%;" :src="url1" alt="" />
                          </div>
                          <br />
                          <div class="publisher bt-1 border-light">
                            <input type="hidden" v-model="roomId1">
                            <input type="hidden" v-model="userId1">
                            <input class="publisher-input" type="text" v-model="fields.message" placeholder="Text...">

                          </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn bg-gradient-dark btn-sm" data-bs-dismiss="modal">Close</button>

                          <button type="submit" class="btn bg-gradient-primary btn-sm" data-abc="true">
                            <i style="color: white;" class="fa fa-paper-plane"></i>
                          </button>
                        </div>
                      </form>
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
      clubchats: [],
      clubchat: {},
      id: "",
      fields: {
        message: "",
        post_category: "",
      },
      name: "",
      url1: "",
      messageCount: 0,
    };
  },
  computed: {
    roomId1: {
      get() {
        return this.club.id;
      },
      set(value) {
        this.club.id = value;
      }
    },

    userId1: {
      get() {
        return this.id;
      },
      set(value) {
        this.id = value;
      }
    },

    roomId2: {
      get() {
        return this.club.id;
      },
      set(value) {
        this.club.id = value;
      }
    },

    userId2: {
      get() {
        return this.id;
      },
      set(value) {
        this.id = value;
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
      formData.append('room_id', this.roomId1);
      formData.append('user_id', this.userId1);
      formData.append("file1", this.fields.file1);
      formData.append('_method', 'POST');

      axios.post('/api/clubchats', formData, {
        headers: { 'content-type': 'multipart/form-data' },
      })
        .then(() => {

          this.fields.message = '';
          this.fields.file1 = '';

          axios
            .get("/api/clubs/" + this.slug)
            .then(response => {
              //console.log(JSON.stringify(response));
              this.club = response.data.data;
              this.clubchats = response.data.messages;
              this.messageCount = response.data.message_count;
            })
            .catch((error) => {
              //console.log(error);
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
          Swal.fire({
            icon: 'error',
            title: 'You have to join room!',
            text: 'For permissions to chat',
            footer: ''
          })
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

    subscribe() {
      // if (this.fields.message.trim() === '') return;
      const formData = new FormData();
      formData.append('user_id', this.userId2);
      formData.append('room_id', this.roomId2);
      formData.append('_method', 'POST');

      axios.post('/api/subscribetoclubchatroom', formData, {
        headers: { 'content-type': 'multipart/form-data' },
      })
        .then(() => {

          this.fields.message = '';
          this.fields.file1 = '';

          axios
            .get("/api/clubs/" + this.slug)
            .then(response => {
              //console.log(JSON.stringify(response));
              this.club = response.data.data;
              this.clubchats = response.data.messages;
              this.messageCount = response.data.message_count;
            })
            .catch((error) => {
              //console.log(error);
            });

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
              axios
                .get("/api/clubs/" + this.slug)
                .then(response => {
                  //console.log(JSON.stringify(response));
                  this.club = response.data.data;
                  this.clubchats = response.data.messages;
                  this.messageCount = response.data.message_count;
                })
                .catch((error) => {
                  //console.log(error);
                });
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
        this.clubchats = response.data.messages;
        this.messageCount = response.data.message_count;
      })
      .catch((error) => {
        //console.log(error);
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