<template>
  <body class="index-page">
    <Loader />
    <section class="my-5 py-5">
      <div class="container">

        <div class="row justify-content-center my-2 py-2">
          <div class="custom-search">
          <!-- <Cache /> -->
            <input v-model="product_name" @input="search" type="text" class="custom-search-input"
              placeholder="Search market | Item | Category..." name="search">
            <br>
            <br>
            <div class="search-results-container" v-if="searchResults.length > 0"
              style="background-color: rgb(250, 250, 250); border: none; border-radius: 5px;">
              <br>
              <ul style="padding: 20px;" class="search-results">
                <li style="margin: 13px;" v-for="result in searchResults" :key="result.id">
                  <input style="background-color: rgb(250, 250, 250);border:none;color:#189483;" type="button"
                    @click="selectItem(result)" :value="result.product_name">
                  <hr class="horizontal dark my-1">
                </li>
              </ul>
            </div>

            <Install />

            <div class="profile-card-inf" style="display: flex;flex-wrap: wrap;float:right;">
              <div class="profile-card-inf__item">
                <router-link class="btn btn-sm" to="/viewCart">
                  <i style="color: black;font-size: 13px;" class="fa fa-random" aria-hidden="true"></i>
                  <sup style="background-color: #189483; color: white; border-radius: 50%; padding: 2px 5px;"> {{ cart
                  }}</sup>
                </router-link>
              </div>

              <div class="profile-card-inf__item">
                <button data-toggle="tooltip" data-placement="bottom" title="List" data-bs-toggle="modal"
                  data-bs-target="#exampleModal" class="btn btn-sm">
                  <i style="color: black;font-size: 13px;" class="fa fa-list"></i>
                </button>
              </div>

              <div class="profile-card-inf__item">
                <button data-toggle="tooltip" data-placement="bottom" title="Location" data-bs-toggle="modal"
                  data-bs-target="#exampleModal1" class="btn btn-sm">
                  <i style="color: black;font-size: 13px;" class="fa fa-map-marker"></i>
                </button>
              </div>

              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">
                        Product Categories
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div style="padding: 15px;" class="container row">
                      <ul>
                        <li style="display: inline;" v-for="category in categories" :key="category.id">
                          <input style="margin: 3px;" data-bs-dismiss="modal" type="button" name="search"
                            :value="category.name" @click="product_name = category.name">
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

              <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModal1Label"
                aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModal1Label">
                        Product Location
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div style="padding: 15px;" class="container row">
                      <ul>
                        <li style="display: inline;" v-for="location in locations" :key="location.id">
                          <input style="margin: 3px;" data-bs-dismiss="modal" type="button" name="search"
                            :value="location.name" @click="product_name = location.name">
                        </li>
                        <h5 v-if="!locations.length">Sorry, no item found!</h5>
                      </ul>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn bg-gradient-dark btn-sm" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>


            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-2 col-6">
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
              <div class="container">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                </ol>
              </div>
            </nav>
          </div>
          <div style="float:right;" class="col-md-9 col-6">
            <router-link v-if="id == false" to="/login" style="float: right;" class="text-info icon-move-right">
              <button type="button" class="btn bg-gradient-primary btn-sm">
                Sell
              </button>
            </router-link>

            <router-link v-else to="/createmarket" style="float: right;" class="text-info icon-move-right">
              <button type="button" class="btn bg-gradient-primary btn-sm">
                Sell
              </button>
            </router-link>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-4 col-sm-4 col-12" v-for="market in markets" :key="market.id">
            <div class="card card-plain card-blog">
              <div style="background-color: #E9ECEF;" class="card">

                <router-link :to="{
                  name: 'ViewMarket',
                  params: { slug: market.slug },
                }">
                  <img
                    v-if="market.image_1 == false || market.image_1 == null || market.image_1 == 'null' || market.image_1 == '' || market.image_1 == ' ' || market.image_1 == NULL"
                    loading="lazy" style="background-color: white;width: 100%;height: 200px; object-fit: cover;"
                    src="/web/img/no_img.jpg" class="card-img-top" width="100%">

                  <img v-else style="background-color: white;width: 100%;height: 200px; object-fit: cover;"
                    :src="'./img/market/' + market.image_1" class="card-img-top" width="100%">

                </router-link>

                <div class="card-body pt-0 px-0">
                  <div class="d-flex flex-row justify-content-between mb-0 px-3">
                    <h4>{{ market.product_name }}</h4>
                  </div>
                  <div class="d-flex flex-row justify-content-between mb-0 px-3">
                    <small class="text-muted mt-1">Price</small>
                    <h6>
                      <span
                        v-if="market.product_discount == 0 || market.product_discount == false || market.product_discount == null || market.product_discount == 'null' || market.product_discount == '' || market.product_discount == ' ' || market.product_discount == 'undefined'">Ksh.
                        {{ market.product_price }}</span>
                      <span v-else><span style="color: #189483;">Ksh. {{
                        market.product_price - market.product_discount
                      }}</span>
                      </span>
                    </h6>
                  </div>

                  <div class="d-flex flex-row justify-content-between mb-0 px-3">
                    <small class="text-muted mt-1">Status</small>
                    <h6>
                      <span style="color: red;"
                        v-if="market.availability == 'Out of stock' || market.availability == false || market.availability == null || market.availability == 'null' || market.availability == '' || market.availability == ' '">
                        Out Of Stock</span>
                      <span style="color: #189483;" v-else> Available</span>
                    </h6>
                  </div>

                  <div class="d-flex flex-row justify-content-between mb-0 px-3">
                    <h6>
                      <span style="color: red;"
                        v-if="market.location == 'undefined' || market.location == false || market.location == null || market.location == 'null' || market.location == '' || market.location == ' '">
                      </span>
                      <span style="color: #189483;" v-else> <a :href="market.location" target="_blank"></a></span>
                    </h6>
                  </div>

                  <div class="d-flex flex-row justify-content-between mb-0 px-3">
                    <span style="margin: 3px;" class="badge bg-dark ">
                      <i class="fa fa-comments-o"></i> {{ market.rating_count }}
                    </span>

                    <span style="margin: 3px;" class="badge bg-dark">
                      <div v-if="Math.round(market.avg_rating) === 0" class="stars">
                        <i class="fa fa-star"></i>
                      </div>
                      <div v-if="Math.round(market.avg_rating) === 1" class="stars">
                        <i style="color: orange;" class="fa fa-star"></i>
                      </div>
                      <div v-if="Math.round(market.avg_rating) === 2" class="stars">
                        <i style="color: orange;" class="fa fa-star"></i>
                        <i style="color: orange;" class="fa fa-star"></i>
                      </div>
                      <div v-if="Math.round(market.avg_rating) === 3" class="stars">
                        <i style="color: orange;" class="fa fa-star"></i>
                        <i style="color: orange;" class="fa fa-star"></i>
                        <i style="color: orange;" class="fa fa-star"></i>
                      </div>
                      <div v-if="Math.round(market.avg_rating) === 4" class="stars">
                        <i style="color: orange;" class="fa fa-star"></i>
                        <i style="color: orange;" class="fa fa-star"></i>
                        <i style="color: orange;" class="fa fa-star"></i>
                        <i style="color: orange;" class="fa fa-star"></i>
                      </div>
                      <div v-if="Math.round(market.avg_rating) === 5" class="stars">
                        <i style="color: orange;" class="fa fa-star"></i>
                        <i style="color: orange;" class="fa fa-star"></i>
                        <i style="color: orange;" class="fa fa-star"></i>
                        <i style="color: orange;" class="fa fa-star"></i>
                        <i style="color: orange;" class="fa fa-star"></i>
                      </div>
                    </span>
                  </div>


                  <div class="mx-3 mt-3 mb-2">
                    <form @submit.prevent="submit(market)">
                      <input class="form-control" type="hidden" v-model="market.user_id" />
                      <input class="form-control" type="hidden" v-model="market.id" />
                      <input class="form-control" type="hidden" v-model="market.product_name" />
                      <input class="form-control" type="hidden" v-model="market.product_category" />
                      <input class="form-control" type="hidden" v-model="market.image_1" />
                      <input class="form-control" type="hidden" v-model="market.slug" />
                      <input class="form-control" type="hidden" v-model="market.contact" />
                      <input class="form-control" type="hidden" v-model="market.product_price" />
                      <input class="form-control" type="hidden" v-model="market.product_discount" />

                      <router-link v-if="id == false" to="/login" style="font-size: 13px;"
                        class="btn bg-gradient-primary btn-sm btn-block">
                        <i style="color: white;font-size: 13px;" class="fa fa-random" aria-hidden="true"></i> <sup> 0</sup>
                      </router-link>

                      <button v-else style="font-size: 13px;" type="submit"
                        class="btn bg-gradient-primary btn-sm btn-block">
                        <i style="color: white;font-size: 13px;" class="fa fa-random" aria-hidden="true"></i> <sup> {{ market.cart_count }}</sup>
                      </button>

                    </form>

                  </div>
                  <div class="mx-3 mt-3 mb-2">
                    <button v-if="market.user_id == id || id == 1" type="button" @click="destroy(market.id)"
                      class="delete-btn" style="float: left;border:none;outline:none;background: none;">
                      <i class="fa fa-trash-o" style="color: red;"></i>
                    </button>

                    <router-link style="float: right;" v-if="market.user_id == id || id == 1" :to="{
                      name: 'EditMarket',
                      params: { slug: market.slug },
                    }"><i class="fa fa-edit" style="color: #189483;"></i>
                    </router-link>
                  </div>

                </div>
              </div>
            </div>
            <br />
          </div>
          <h5 v-if="!markets.length">Sorry, no item found!</h5>
        </div>

        <hr class="horizontal dark my-5">
      </div>





      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 ms-auto me-auto p-lg-6 mt-lg-0 mt-6">
            <div class="card card-background card-background-mask-primary tilt" data-tilt>
              <div class="full-background" style="background-image: url('web/logo.png');">
              </div>
              <div class="card-body pt-7 text-center">
                <h2 class="text-white up mb-0">Ecomrade</h2>
                <p>A Hub for Kenyan comrades.</p>
                <router-link style="background-color: white;color:grey;" v-if="id == false" to="/login"
                  class="btn btn-sm">
                  Sign-in
                </router-link>

                <router-link style="background-color: white;color:grey;" v-else to="/createmarket" class="btn btn-sm">
                  Sell
                </router-link>
              </div>
            </div>
          </div>
        </div>
      </div>

      <hr class="horizontal dark my-5">

      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-4 ms-auto me-auto p-lg-4 mt-lg-0 mt-4">
            <div class="card card-background card-background-mask-primary tilt" data-tilt>
              <div class="full-background" style="background-image: url('ecomrade_ui/assets/images/demos/denim.jpg')">
              </div>
              <div class="card-body pt-7 text-center">
                <h2 class="text-white up mb-0"> Market</h2>
                <p>Discover new opportunities with ecomrade's student e-marketplace.</p>

                <router-link style="background-color: white;color:grey;" v-if="id == false" to="/market"
                  class="btn btn-sm">
                  Find
                </router-link>

                <router-link style="background-color: white;color:grey;" v-else to="/createmarket" class="btn btn-sm">
                  Sell
                </router-link>
              </div>
            </div>
          </div>


          <div class="col-lg-4 ms-auto me-auto p-lg-4 mt-lg-0 mt-4">
            <div class="card card-background card-background-mask-primary tilt" data-tilt>
              <div class="full-background" style="background-image: url('web/rental.jpg')">
              </div>
              <div class="card-body pt-7 text-center">
                <h2 class="text-white up mb-0">Rentals</h2>
                <p>Locate affordable, safe and secure rental spaces around campus.</p>

                <router-link style="background-color: white;color:grey;" to="/rental" class="btn btn-sm">
                  Locate
                </router-link>
              </div>
            </div>
          </div>

          <div class="col-lg-4 ms-auto me-auto p-lg-4 mt-lg-0 mt-4">
            <div class="card card-background card-background-mask-primary tilt" data-tilt>
              <div class="full-background" style="background-image: url('img/blog.jpg')">
              </div>
              <div class="card-body pt-7 text-center">
                <h2 class="text-white up mb-0">Blogs</h2>
                <p>Comrades can now create or share their experiences and creativity via blogs.</p>

                <router-link style="background-color: white;color:grey;" v-if="id == false" to="/blog" class="btn btn-sm">
                  Read
                </router-link>

                <router-link style="background-color: white;color:grey;" v-else to="/createblog" class="btn btn-sm">
                  Be a Creator
                </router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-5">
      <div class="container">
        <div class="row">
          <div class="row text-center my-sm-5 mt-5">
            <div class="col-lg-6 mx-auto">
              <h4 class="text-primary text-gradient mb-0"> A Hub for Kenyan Comrade services</h4>
            </div>
          </div>
        </div>
      </div>
      <hr class="horizontal dark my-5">

      <div class="container mt-5">
        <div class="row">

          <div class="col-md-3 mx-auto mt-md-0 mt-5">
            <div class="position-sticky" style="top:100px !important">
              <h4 class="">What can you access on ecomrade?</h4>
              <p>From rentals to anonymous polls, ecomrade is an online platform where Kenyan comrades can participate
                in e-commerce, provide or access services. Its truly a hub for comrades.</p>
            </div>
          </div>


          <div class="col-md-8">
            <div class="row mt-4">
              <div class="col-md-6">
                <router-link to="/faq">
                  <div class="card move-on-hover">
                    <img class="w-100" style="opacity: 1;width: 100%;height:250px;object-fit: contain;" src="/img/faq.png"
                      alt="">
                  </div>
                  <div class="mt-2 ms-2">
                    <h6 class="mb-0">Got any questions?</h6>
                  </div>
                </router-link>
              </div>
              <div class="col-md-6 mt-md-0 mt-5">
                <router-link to="/contact">
                  <div class="card move-on-hover">
                    <img class="w-100" style="opacity: 1;width: 100%;height:250px;object-fit: contain;"
                      src="/img/contact.png" alt="">
                  </div>
                  <div class="mt-2 ms-2">
                    <h6 class="mb-0">Contact Us</h6>
                  </div>
                </router-link>
              </div>

            </div>


            <hr class="horizontal dark my-5">

            <h3 style="text-align: center;" class="text-primary text-gradient mb-0"> What can you do with ecomrade?
            </h3>

            <hr class="horizontal dark my-5">

            <div class="row mt-4">
              <div class="col-md-6 col-12">
                <router-link to="/market">
                  <div class="card move-on-hover">
                    <img class="w-100" style="opacity: 1;width: 100%;height:250px;object-fit: cover;"
                      src="/img/market.jpg" alt="">
                  </div>
                  <div class="mt-2 ms-2">
                    <h6 class="mb-0">Find products on e-market.</h6>
                  </div>
                </router-link>
              </div>
              <div class="col-md-6 col-12">
                <router-link to="/rental">
                  <div class="card move-on-hover">
                    <img class="w-100" style="opacity: 1;width: 100%;height:250px;object-fit: cover;"
                      src="/img/rental.webp" alt="">
                  </div>
                  <div class="mt-2 ms-2">
                    <h6 class="mb-0"> Locate available rentals.</h6>
                  </div>
                </router-link>
              </div>
              <hr class="horizontal dark my-5">
              <div class="col-md-6 col-12">
                <router-link to="/blog">
                  <div class="card move-on-hover">
                    <img class="w-100" style="opacity: 1;width: 100%;height:250px;object-fit: cover;" src="/img/blog.jpg"
                      alt="">
                  </div>
                  <div class="mt-2 ms-2">
                    <h6 class="mb-0">Creative blogs.</h6>
                  </div>
                </router-link>
              </div>
              <div class="col-md-6 col-12">
                <router-link to="/poll">
                  <div class="card move-on-hover">
                    <img class="w-100" style="opacity: 1;width: 100%;height:250px;object-fit: cover;" src="/img/poll.jpeg"
                      alt="">
                  </div>
                  <div class="mt-2 ms-2">
                    <h6 class="mb-0">Create & participate in polls.</h6>
                  </div>
                </router-link>
              </div>
              <hr class="horizontal dark my-5">
              <div class="col-md-6 col-12">
                <router-link to="/event">
                  <div class="card move-on-hover">
                    <img class="w-100" style="opacity: 1;width: 100%;height:250px;object-fit: cover;"
                      src="/img/event.webp" alt="">
                  </div>
                  <div class="mt-2 ms-2">
                    <h6 class="mb-0"> Events around you.</h6>
                  </div>
                </router-link>
                <br />
              </div>
              <div class="col-md-6 col-12">
                <router-link to="/club">
                  <div class="card move-on-hover">
                    <img class="w-100" style="opacity: 1;width: 100%;height:250px;object-fit: cover;" src="/img/clb.jpg"
                      alt="">
                  </div>
                  <div class="mt-2 ms-2">
                    <h6 class="mb-0"> Clubs and societies.</h6>
                  </div>
                </router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr class="horizontal dark my-5">
    </section>


    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 ms-auto me-auto p-lg-6 mt-lg-0 mt-6">
          <div class="card card-background card-background-mask-primary tilt" data-tilt>
            <div class="full-background" style="background-image: url('/img/poll.jpeg')">
            </div>
            <div class="card-body pt-7 text-center">
              <h2 class="text-white up mb-0"> Polls</h2>
              <p>You can now run anonymous polls on our platform</p>
              <router-link to="/createpoll" class="btn btn-outline-white mt-5 up btn-round">
                Run / create
              </router-link>
            </div>
          </div>
        </div>

        <div class="col-lg-6 ms-auto me-auto p-lg-6 mt-lg-0 mt-6">
          <div class="card card-background card-background-mask-primary tilt" data-tilt>
            <div class="full-background" style="background-image: url('web/club.jpeg')">
            </div>
            <div class="card-body pt-7 text-center">
              <h2 class="text-white up mb-0"> Clubs / Society</h2>
              <p>Comrades can now promote fellow comrades in the nduthi sector.</p>
              <router-link to="/club" class="btn btn-outline-white mt-5 up btn-round">
                Request
              </router-link>
            </div>
          </div>
        </div>

      </div>
      <hr class="horizontal dark my-5">
    </div>

    <!-- -------- END Content Presentation Docs ------- -->


    <section class="py-7">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mx-auto text-center">
            <h2 class="mb-0"> Blogs</h2>
            <p class="lead">Enjoy creative blogs from creative comrades </p>
          </div>
        </div>
        <div class="row mt-6">
          <div class="col-lg-4 col-md-8">
            <div class="card card-plain">
              <div class="card-body">
                <div class="author">
                  <div class="name">
                    <h6 class="mb-0 font-weight-bolder"> Focus </h6>
                    <div class="stats">
                      <i class="far fa-clock"></i> Timely
                    </div>
                  </div>
                </div>
                <p>Creating blogs on ecomrade is easy and straightforward. Just sign up, create a profile,
                  and start sharing your unique perspectives and experiences with other campus students.
                </p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-8 ms-md-auto">
            <div class="card bg-gradient-primary">
              <div class="card-body">
                <div class="author align-items-center">
                  <div class="name">
                    <h6 class="text-white mb-0 font-weight-bolder">Denchi</h6>
                    <div class="stats text-white">
                      <i class="far fa-clock"></i> Focused
                    </div>
                  </div>
                </div>
                <p style="color: white;">With ecomrade, you can stay up to date with the latest news and opinions from
                  fellow students.
                  Read informative and entertaining blogs on a variety of topics, from fashion to politics.
                </p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-8">
            <div class="card card-plain">
              <div class="card-body">
                <div class="author">
                  <div class="name">
                    <h6 class="mb-0 font-weight-bolder">MacSilas</h6>
                    <div class="stats">
                      <i class="far fa-clock"></i> Cold
                    </div>
                  </div>
                </div>
                <p>At ecomrade, you have the power to shape the conversation by rating and commenting on blogs. Show your
                  support
                  for inspiring writers and start a dialogue with like-minded students.
                </p>
              </div>
            </div>
          </div>

        </div>
        <hr class="horizontal dark my-5">
      </div>
    </section>

    <!-- -------- START Content Presentation Docs ------- -->
    <div class="container">
      <div class="row">
        <div class="col-lg-6 mx-auto text-center">
          <h2 class="mb-0"> Polls</h2>
          <p class="lead">Run poll, get an idea of what others think of your argument</p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4">
          <div class="info-horizontal bg-gradient-primary border-radius-xl p-5">
            <div class="description ps-5">
              <h5 class="text-white">Getting Started</h5>
              <p style="color: white;">Have your voice heard on ecomrade by creating anonymous polls.
                Choose from a variety of topics and see what your fellow students really think.
              </p>
              <router-link to="/" class="text-white icon-move-right">
                Let's start
                <i class="fas fa-arrow-right text-sm ms-1"></i>
              </router-link>
            </div>
          </div>
        </div>
        <div class="col-lg-4 px-lg-1 mt-lg-0 mt-4">
          <div class="info-horizontal bg-gray-100 border-radius-xl p-5">
            <div class="description ps-5">
              <h5>Plugins</h5>
              <p>With ecomrade, you can vote on polls and have your say in important
                campus discussions. See how your opinion compares to your peers.
              </p>
              <router-link to="/" class="text-primary icon-move-right">
                Read more
                <i class="fas fa-arrow-right text-sm ms-1"></i>
              </router-link>
            </div>
          </div>
        </div>

        <div class="col-lg-4 mt-lg-0 mt-4">
          <div class="info-horizontal bg-gray-100 border-radius-xl p-5">
            <div class="description ps-5">
              <h5>Utility Classes</h5>
              <p>Get involved in campus issues with ecomrade's anonymous polls. See the results
                in real-time and join the conversation about what matters most to you.
              </p>
              <router-link to="/" class="text-primary icon-move-right">
                Read more
                <i class="fas fa-arrow-right text-sm ms-1"></i>
              </router-link>
            </div>
          </div>
        </div>
      </div>
      <hr class="horizontal dark my-5">
    </div>

    <section class="my-5">
      <div class="container">
        <div class="row">
          <div class="col-md-7 col-12 my-auto">
            <h3 class="text-gradient text-primary mb-0"> Events</h3>
            <p> Events, parties around campus. Via ecomrade, comrades can now have access to public or private events.</p>
            <div class="github-buttons">
              <router-link to="/event" rel="nofollow" class="btn bg-gradient-primary mb-5 mb-sm-0">View</router-link>
              <div class="github-button">
                <span></span>
              </div>
            </div>
          </div>
          <div class="col-md-5 col-12 my-auto">
            <img class="w-100 border-radius-lg shadow-lg" style="opacity: 1;" src="/web/img/events.jpg"
              alt="Product Image">
          </div>
        </div>
      </div>
      <hr class="horizontal dark my-5">
    </section>


    <!-- START Section Content W/ 2 images aside of icon title description -->
    <section class="pt-lg-7 pt-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-5 col-md-8 order-2 order-md-2 order-lg-1">
            <div class="position-relative ms-lg-5 mb-0 mb-md-7 mb-lg-0 d-none d-md-block d-lg-block d-xl-block h-75">
              <div class="bg-gradient-primary w-100 h-100 border-radius-xl position-absolute d-lg-block d-none"></div>
              <img src="/web/club.jpeg" style="opacity: 1;"
                class="w-100 border-radius-xl mt-6 ms-lg-5 position-relative z-index-5" alt="">
            </div>
          </div>
          <div class="col-lg-5 col-md-12 ms-auto order-1 order-md-1 order-lg-1">
            <div class="p-3 pt-0">
              <div class="icon icon-shape bg-gradient-primary rounded-circle shadow text-center mb-4">
                <i class="ni ni-building"></i>
              </div>
              <h4 class="text-gradient text-primary mb-0"> Clubs</h4>
              <h4 class="mb-4"><a href="https://twitter.com/dnyivn" target="blank" rel="nofollow"> & Societies</a></h4>
              <p>Comrades can now create / join clubs or societies, interact, share ideas and concepts.</p>
              <router-link to="/club" target="blank" rel="nofollow" class="text-dark icon-move-right">Check
                <i class="fas fa-arrow-right text-sm ms-1"></i>
              </router-link>
            </div>
          </div>
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
import Install from './Install.vue'
import Cache from './Cache.vue'
import Loader from './Loader.vue'

import axios from 'axios';


export default {

  components: {
    Footer,
    Install,
    Cache,
    Loader
  },
  emits: ["updateSidebar"],
  data() {
    return {
      markets: [],
      currentPage: 1,
      lastPage: 1,

      product_name: '',
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

      product_category: "",
      id: "",
      name: "",
      cart: 0,
      locations: {},
    };
  },

  created() {
    this.productName(this.currentPage);

    axios.get('/api/viewed-markets')
      .then(response => {
        this.viewedMarkets = response.data.data;
      });
  },

  computed: {
    marketName: {
      get() {
        return this.fields.product_name = this.market.product_name;
      },
      set(value) {
        this.fields.product_name = value;
      }
    },
  },

  methods: {
    search() {
      if (this.product_name.length > 2) {

        axios.get('/api/search', { params: { q: this.product_name } })
          .then(response => {
            this.searchResults = response.data;
          });
      } else {
        this.searchResults = [];
      }
    },

    selectItem(item) {
      this.product_name = item.product_name;
      this.searchResults = [];
    },
    submit(market) {
      axios
        .post("/api/carts", { "user_id": market.user_id, "id": market.id, "product_name": market.product_name, "product_category": market.product_category, "image_1": market.image_1, "slug": market.slug, "contact": market.contact, "product_price": market.product_price, "product_discount": market.product_discount }, {
          headers: { "content-type": "multipart/form-data" },
        })
        .then(() => {
          this.fields = {};
          this.url = null;
          this.fields.category_id = "";
          this.success = true;
          this.errors = {};

          axios.get('/api/home')
            .then(response => {
              this.markets = response.data.data;
            })
            .catch(error => {
              console.log(error);
            });

          axios
            .get("/api/user")
            .then(response => {
              this.cart = response.data.totalCartCount
            })
            .catch((error) => {
              if (error.response.status === 401) {
                this.$emit("updateSidebar");
                localStorage.removeItem("authenticated");
              }
            });

          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Added to <strong> Compare</strong>',
            showConfirmButton: false,
            timer: 1500
          })


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
            .delete("/api/markets/" + id)
            .then((response) => {
              Swal.fire(
                'Deleted!',
                'Information has been successfully deleted.',
                'success'
              );
              // Fire.$emit('AfterCreate');

              axios.get('/api/home')
                .then(response => {
                  this.markets = response.data.data;
                })
                .catch(error => {
                  console.log(error);
                });
            }).catch((error) => {
              Swal.fire("Failed!", error.message, "warning");
            });
        }
      })
    },

    productName(page) {
      axios
        .get('/api/home?page=' + page, {
          params: {
            search: this.product_name,
          },
        })
        .then((response) => {
          this.markets = response.data.data;
          this.currentPage = response.data.current_page;
          this.lastPage = response.data.last_page;
        })
        .catch((error) => {
          console.log(error);
        });

    },

  },

  watch: {
    product_name(page) {
      axios
        .get("/api/home", {
          params: {
            page: page,
            search: this.product_name,
          },
        })
        .then((response) => {
          this.markets = response.data.data;
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
        this.cart = response.data.totalCartCount
      })
      .catch((error) => {
        if (error.response.status === 401) {
          this.$emit("updateSidebar");
          localStorage.removeItem("authenticated");
        }
      });

    axios
      .get("/api/homemarketcategories")
      .then((response) => (this.categories = response.data))
      .catch((error) => {
        console.log(error);
      });

    axios.get('/api/locations')
      .then(response => {
        this.locations = response.data.data;
      });

      if (window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone) {
      this.isPWAInstalled = true;
    }
  },
};
</script>

<style>
.full-page-loader img {
  width: 40px;
  /* Set the width of the image */
  height: 40px;
  /* Set the height of the image */
}

.custom-search {
  position: relative;
}

.custom-search-input {
  width: 100%;
  border: 1px solid #ccc;
  border-radius: 100px;
  padding: 10px 100px 10px 20px;
  line-height: 1;
  box-sizing: border-box;
  outline: none;
}

.custom-search-botton {
  position: absolute;
  right: 3px;
  top: 3px;
  bottom: 43px;
  border: 0;
  background: none;
  color: #fff;
  outline: none;
  margin: 0;
  padding: 0 10px;
  border-radius: 100px;
}

.svg-icon.search-icon {
  display: inline-block;
  width: 27px;
  height: 27px;
}
</style>