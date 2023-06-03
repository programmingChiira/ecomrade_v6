<template>
  <div>
    <div class="container position-sticky z-index-sticky top-0">
      <div class="row">
        <div class="col-12">
          <nav
            class="navbar navbar-expand-lg  blur blur-rounded top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
            <div class="container-fluid px-0">
              <router-link to="/" class="navbar-brand font-weight-bolder" @click="visible = !visible">
                ecomrade
              </router-link>

              
              <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                  <span class="navbar-toggler-bar bar1"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </span>
              </button>
              <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" :class="!visible ? 'collapse' : ''"
                id="navigation">
                <ul class="navbar-nav navbar-nav-hover ms-lg-12 ps-lg-5 w-100">
                  <li style="margin-top: 5px;margin:5px" class="nav-item">
                    <router-link to="/" class="font-weight-bolder" :class="{ active: $route.path === '/' }"
                      @click="visible = !visible">
                      Home
                    </router-link>
                  </li>

                  <li style="margin-top: 5px;margin:5px" class="nav-item">
                    <router-link to="/market" class="font-weight-bolder" :class="{ active: $route.path === '/market' }"
                      @click="visible = !visible">
                      Market
                    </router-link>
                  </li>

                  <li style="margin-top: 5px;margin:5px" class="nav-item">
                    <router-link to="/rental" class="font-weight-bolder" :class="{ active: $route.path === '/rental' }"
                      @click="visible = !visible">
                      Rentals
                    </router-link>
                  </li>

                  <li style="margin-top: 5px;margin:5px" class="nav-item">
                    <router-link to="/blog" class="font-weight-bolder" :class="{ active: $route.path === '/blog' }"
                      @click="visible = !visible">
                      Blogs
                    </router-link>
                  </li>

                  <li style="background-color: none;" class="nav-item dropdown dropdown-hover ">
                    <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center font-weight-bolder"
                      href="javascript:;" id="dropdownMenuDocs" data-bs-toggle="dropdown" aria-expanded="false">
                      Xtras <i style="margin: 2px;" class="fa fa-caret-down	"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-animation dropdown-lg mt-0 mt-lg-3 p-3 border-radius-lg"
                      aria-labelledby="dropdownMenuDocs">
                      <div class="d-none d-lg-block">
                        <ul class="list-group">
                          <li class="nav-item list-group-item border-0 p-0">

                            <router-link to="/poll" class="dropdown-item py-2 ps-3 border-radius-md"
                              :class="{ active: $route.path === '/poll' }" @click="visible = !visible">
                              <div class="d-flex">
                                <div>
                                  <h6
                                    class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">
                                    Polls</h6>
                                  <span class="text-sm">Create polls.</span>
                                </div>
                              </div>
                            </router-link>
                          </li>

                          <li class="nav-item list-group-item border-0 p-0">
                            <router-link to="/event" class="dropdown-item py-2 ps-3 border-radius-md"
                              :class="{ active: $route.path === '/event' }" @click="visible = !visible">
                              <div class="d-flex">
                                <div>
                                  <h6
                                    class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">
                                    Events</h6>
                                  <span class="text-sm">Events happening around Campus.</span>
                                </div>
                              </div>
                            </router-link>
                          </li>

                          <li class="nav-item list-group-item border-0 p-0">
                            <router-link to="/club" class="dropdown-item py-2 ps-3 border-radius-md"
                              :class="{ active: $route.path === '/club' }" @click="visible = !visible">
                              <div class="d-flex">
                                <div>
                                  <h6
                                    class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">
                                    Clubs / Societies</h6>
                                  <span class="text-sm">ecomrade clubs and society. </span>
                                </div>
                              </div>
                            </router-link>
                          </li>

                          <li class="nav-item list-group-item border-0 p-0">
                            <router-link to="/resource" class="dropdown-item py-2 ps-3 border-radius-md"
                              :class="{ active: $route.path === '/resource' }" @click="visible = !visible">
                              <div class="d-flex">
                                <div>
                                  <h6
                                    class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">
                                    Learning resources</h6>
                                  <span class="text-sm">ecomrade learning resources. </span>
                                </div>
                              </div>
                            </router-link>
                          </li>


                        </ul>
                      </div>

                      <div class="row d-lg-none">
                        <div class="col-md-12 g-0">

                          <router-link to="/poll" class="dropdown-item py-2 ps-3 border-radius-md"
                            :class="{ active: $route.path === '/poll' }" @click="visible = !visible">
                            <div class="d-flex">
                              <div>
                                <h6
                                  class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">
                                  Polls</h6>
                                <span class="text-sm">Run anonymous polls.</span>
                              </div>
                            </div>
                          </router-link>

                          <router-link to="/event" class="dropdown-item py-2 ps-3 border-radius-md"
                            :class="{ active: $route.path === '/event' }" @click="visible = !visible">
                            <div class="d-flex">
                              <div>
                                <h6
                                  class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">
                                  Events</h6>
                                <span class="text-sm">Events happening around Campus.</span>
                              </div>
                            </div>
                          </router-link>

                          <router-link to="/club" class="dropdown-item py-2 ps-3 border-radius-md"
                            :class="{ active: $route.path === '/club' }" @click="visible = !visible">
                            <div class="d-flex">
                              <div>
                                <h6
                                  class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">
                                  Clubs / Societies</h6>
                                <span class="text-sm">ecomrade clubs and society.</span>
                              </div>
                            </div>
                          </router-link>

                          <router-link to="/resource" class="dropdown-item py-2 ps-3 border-radius-md"
                            :class="{ active: $route.path === '/resource' }" @click="visible = !visible">
                            <div class="d-flex">
                              <div>
                                <h6
                                  class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">
                                  Learning resources</h6>
                                <span class="text-sm">ecomrade learning resources.</span>
                              </div>
                            </div>
                          </router-link>

                        </div>
                      </div>
                    </div>
                  </li>
                  <li style="margin-top: 5px;margin:5px" class="nav-item">
                    <router-link to="/faq" class="font-weight-bolder" :class="{ active: $route.path === '/faq' }"
                      @click="visible = !visible">
                      F.A.Q
                    </router-link>
                  </li>

                  <li style="margin-top: 5px;margin:5px" class="nav-item">
                    <router-link to="/contact" class="font-weight-bolder" :class="{ active: $route.path === '/contact' }"
                      @click="visible = !visible">
                      Contact
                    </router-link>
                  </li>

                  <li v-if="id == false" class="nav-item ms-lg-auto">

                  </li>

                  <li v-else class="nav-item ms-lg-auto">
                    <router-link class="nav-link font-weight-bolder" title="My profile" @click="visible = !visible" :to="{
                      name: 'Prof',
                      params: { slug: slug },
                    }">
                      <i class="fa fa-user me-1"></i> {{ name }}
                    </router-link>
                  </li>

                  <li v-if="id == false" class="nav-item ms-lg-auto">
                    <router-link to="/login" class="nav-link font-weight-bolder" @click="visible = !visible">
                      <i class="fa fa-sign-in me-1"></i>
                      <p class="d-inline text-sm z-index-1 font-weight-bold"> LOGIN</p>
                    </router-link>
                  </li>
                </ul>

              </div>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>
      </div>
    </div>

    <transition name="fade">
      <router-view></router-view>
    </transition>
  </div>
</template>
  
<script>
export default {
  emits: ["updateSidebar"],
  data() {
    return {
      visible: false,
      overlayVisibility: false,
      loggedIn: false,
      editSuccess: false,

      success: false,
      fields: {
        category_id: "",
      },

      id: "",
      name: "",
      slug: "",
      phone: "",
      type: "",
    };
  },
  methods: {
    ShowOverlay() {
      this.overlayVisibility = true;
    },

    hideOverlay() {
      this.overlayVisibility = false;
    },

    updateSidebar() {
      this.loggedIn = !this.loggedIn;
    },

    showEditSuccess() {
      this.editSuccess = true;
    },

    close() { },

    logout() {
      axios
        .post("/api/logout")
        .then((response) => {
          this.$router
            .push({ name: 'Login' })
            .then(() => { this.$router.go() })
          localStorage.removeItem("authenticated");
          this.$emit("updateSidebar");
          window.location.reload();
        })
        .catch((error) => console.log(error));
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
        this.phone = response.data.phone
        this.type = response.data.type
      })
      .catch((error) => {
        if (error.response.status === 401) {
          this.$emit("updateSidebar");
          localStorage.removeItem("authenticated");
        }
      });

    if (localStorage.getItem("authenticated")) {
      this.loggedIn = true;
    } else {
      this.loggedIn = false;
    }
  },
};
</script>
  
<style scoped>
.showOverlay {
  width: 100%;
  z-index: 5;
}

.nav-link.active {
  color: #189483;
  position: relative;
}

.active {
  color: #189483;
  position: relative;
}</style>
  