<template>
    <body class="index-page">
        <loader/>
        <section class="my-5 py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-10">
                        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                            <div class="container">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                                    <li class="breadcrumb-item"><router-link to="/event">Event</router-link></li>
                                    <li style="color: #189483;" class="breadcrumb-item"><strong>View</strong></li>
                                </ol>
                            </div>
                        </nav>
                    </div>
                    <div style="float:right;" class="col-md-8 col-2">
                        <router-link v-if="id == false" to="/login" style="float: right;" class="text-info icon-move-right">
                            <button data-toggle="tooltip" data-placement="bottom" title="Create events" type="button"
                                class="btn bg-gradient-primary btn-sm">
                                <i class="fa fa-plus"></i>
                            </button>
                        </router-link>

                        <router-link v-else to="/createEvent" style="float: right;" class="text-info icon-move-right">
                            <button data-toggle="tooltip" data-placement="bottom" title="Create events" type="button"
                                class="btn bg-gradient-primary btn-sm">
                                <i class="fa fa-plus"></i>
                            </button>
                        </router-link>
                    </div>
                </div>

                <div class="row no-gutters  d-flex justify-content-center">
                    <div class="col-md-12 pr-2">
                        <div style="background-color: #E9ECEF;" class="card">
                            <div class="demo">
                                <div>

                                    <img v-if="event.image_1 == false || event.image_1 == null || event.image_1 == 'null' || event.image_1 == '' || event.image_1 == ' ' || event.image_1 == NULL || event.image_1 == 'undefined'"
                                        loading="lazy"
                                        style="width: 100%;height: 450px; object-fit: contain;border-radius: 10px;"
                                        id="main-image" src="/web/img/no_img.jpg" width="550">

                                    <img v-else style="width: 100%;height: 60vh; object-fit: contain;border-radius: 5px;"
                                        id="main-image" :src="'./img/event/' + event.image_1"
                                        @click="activateImageView">
                                </div>

                                <div
                                    class="similar-products mt-2 d-flex flex-row text-center d-flex justify-content-center">
                                    <span
                                        v-if="event.image_1 == false || event.image_1 == null || event.image_1 == 'null' || event.image_1 == '' || event.image_1 == ' ' || event.image_1 == NULL || event.image_1 == 'undefined'">
                                    </span>
                                    <span v-else>
                                        <a>
                                            <img style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                                                :src="'./img/event/' + event.image_1" onclick="change_image(this)"
                                                class="card-img-top" width="70">
                                        </a>

                                    </span>

                                    <span
                                        v-if="event.image_2 == false || event.image_2 == null || event.image_2 == 'null' || event.image_2 == '' || event.image_2 == ' ' || event.image_2 == NULL || event.image_2 == 'undefined'">
                                    </span>
                                    <span v-else>
                                        <a>
                                            <img style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                                                :src="'./img/event/' + event.image_2" onclick="change_image(this)"
                                                class="card-img-top" width="70">
                                        </a>
                                    </span>

                                    <span
                                        v-if="event.image_3 == false || event.image_3 == null || event.image_3 == 'null' || event.image_3 == '' || event.image_3 == ' ' || event.image_3 == NULL || event.image_3 == 'undefined'">
                                    </span>
                                    <span v-else>
                                        <a>
                                            <img style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                                                :src="'./img/event/' + event.image_3" onclick="change_image(this)"
                                                class="card-img-top" width="70">
                                        </a>
                                    </span>

                                    <span
                                        v-if="event.image_4 == false || event.image_4 == null || event.image_4 == 'null' || event.image_4 == '' || event.image_4 == ' ' || event.image_4 == NULL || event.image_4 == 'undefined'">
                                    </span>
                                    <span v-else>
                                        <a>
                                            <img style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                                                :src="'./img/event/' + event.image_4" onclick="change_image(this)"
                                                class="card-img-top" width="70">
                                        </a>
                                    </span>

                                    <span
                                        v-if="event.image_5 == false || event.image_5 == null || event.image_5 == 'null' || event.image_5 == '' || event.image_5 == ' ' || event.image_5 == NULL || event.image_5 == 'undefined'">
                                    </span>
                                    <span v-else>
                                        <a>
                                            <img style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                                                :src="'./img/event/' + event.image_5" onclick="change_image(this)"
                                                class="card-img-top" width="70">
                                        </a>
                                    </span>



                                </div>

                                <div class="full-image-page" v-if="imageLoading">

                                    <div class="thumbnail text-center">
                                        <i style="font-size: 12px;border: white 1px solid; border-radius: 5px;color: white;padding: 10px;float: right;margin: 5px;"
                                            class="fa fa-times" @click="deactivateImageView"></i>

                                        <img style="width: 100%;height: 70vh; object-fit: contain;border-radius: 5px;"
                                            id="main-view" :src="'./img/event/' + event.image_1"
                                            @click="deactivateImageView">

                                        <span
                                            v-if="event.image_1 == false || event.image_1 == null || event.image_1 == 'null' || event.image_1 == '' || event.image_1 == ' ' || event.image_1 == NULL || event.image_1 == 'undefined'">
                                        </span>
                                        <span v-else>
                                            <a>
                                                <img style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                                                    :src="'./img/event/' + event.image_1" onclick="change_view(this)"
                                                    class="card-img-top" width="70">
                                            </a>

                                        </span>

                                        <span
                                            v-if="event.image_2 == false || event.image_2 == null || event.image_2 == 'null' || event.image_2 == '' || event.image_2 == ' ' || event.image_2 == NULL || event.image_2 == 'undefined'">
                                        </span>
                                        <span v-else>
                                            <a>
                                                <img style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                                                    :src="'./img/event/' + event.image_2" onclick="change_view(this)"
                                                    class="card-img-top" width="70">
                                            </a>
                                        </span>

                                        <span
                                            v-if="event.image_3 == false || event.image_3 == null || event.image_3 == 'null' || event.image_3 == '' || event.image_3 == ' ' || event.image_3 == NULL || event.image_3 == 'undefined'">
                                        </span>
                                        <span v-else>
                                            <a>
                                                <img style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                                                    :src="'./img/event/' + event.image_3" onclick="change_view(this)"
                                                    class="card-img-top" width="70">
                                            </a>
                                        </span>

                                        <span
                                            v-if="event.image_4 == false || event.image_4 == null || event.image_4 == 'null' || event.image_4 == '' || event.image_4 == ' ' || event.image_4 == NULL || event.image_4 == 'undefined'">
                                        </span>
                                        <span v-else>
                                            <a>
                                                <img style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                                                    :src="'./img/event/' + event.image_4" onclick="change_view(this)"
                                                    class="card-img-top" width="70">
                                            </a>
                                        </span>

                                        <span
                                            v-if="event.image_5 == false || event.image_5 == null || event.image_5 == 'null' || event.image_5 == '' || event.image_5 == ' ' || event.image_5 == NULL || event.image_5 == 'undefined'">
                                        </span>
                                        <span v-else>
                                            <a>
                                                <img style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                                                    :src="'./img/event/' + event.image_5" onclick="change_view(this)"
                                                    class="card-img-top" width="70">
                                            </a>
                                        </span>

                                    </div>
                                </div>
                                <br />

                                <router-link v-if="id == false" to="/login" style="float: right;" data-toggle="tooltip"
                                    data-placement="bottom" title="Report Post" class="btn bg-gradient-danger btn-sm me-2">
                                    <i style="font-size: 13px;" class="fa fa-flag"></i>
                                </router-link>

                                <button v-else style="float: right;" data-toggle="tooltip" data-placement="bottom"
                                    title="Report Post" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    class="btn bg-gradient-danger btn-sm me-2">
                                    <i style="font-size: 13px;" class="fa fa-flag"></i>
                                </button>

                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Report this
                                                    Event
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form @submit.prevent="sendReport">
                                                <div class="modal-body">
                                                    <select v-model="event_issue" class="form-select mt-3">
                                                        <option>False advertisng</option>
                                                        <hr class="horizontal dark my-2">
                                                        <option>Theft</option>
                                                        <hr class="horizontal dark my-2">
                                                        <option>Inadequate services</option>
                                                    </select>
                                                    <label>Select Issue :</label>

                                                    <textarea name="message" v-model="event_complaint"
                                                        class="form-control mt-3" id="message" rows="6"
                                                        placeholder="you can add more details / complains here..."></textarea>
                                                    <label> Additional details</label>

                                                    <input class="form-control" type="hidden" v-model="userId" />
                                                    <input class="form-control" type="hidden" v-model="eventId" />
                                                    <input class="form-control" type="hidden" v-model="eventTitle" />
                                                    <input class="form-control" type="hidden" v-model="eventImage" />
                                                    <input class="form-control" type="hidden" v-model="eventSlug" />
                                                    <input class="form-control" type="hidden" v-model="eventContact" />
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn bg-gradient-dark btn-sm"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn bg-gradient-primary btn-sm"
                                                        data-bs-dismiss="modal">Send</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br />

                        <div style="background-color: #E9ECEF;" class="card">
                            <div class="d-flex flex-row align-items-center">
                                <div class="p-ratings">
                                    <span style="margin: 3px;" class="badge bg-dark">
                                        <div v-if="Math.round(avgRating) === 0" class="stars">
                                            <i style="color: white;" class="fa fa-star"></i>
                                            <i style="color: white;" class="fa fa-star"></i>
                                            <i style="color: white;" class="fa fa-star"></i>
                                            <i style="color: white;" class="fa fa-star"></i>
                                            <i style="color: white;" class="fa fa-star"></i>
                                        </div>
                                        <div v-if="Math.round(avgRating) === 1" class="stars">
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: white;" class="fa fa-star"></i>
                                            <i style="color: white;" class="fa fa-star"></i>
                                            <i style="color: white;" class="fa fa-star"></i>
                                            <i style="color: white;" class="fa fa-star"></i>
                                        </div>
                                        <div v-if="Math.round(avgRating) === 2" class="stars">
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: white;" class="fa fa-star"></i>
                                            <i style="color: white;" class="fa fa-star"></i>
                                            <i style="color: white;" class="fa fa-star"></i>
                                        </div>
                                        <div v-if="Math.round(avgRating) === 3" class="stars">
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: white;" class="fa fa-star"></i>
                                            <i style="color: white;" class="fa fa-star"></i>
                                        </div>
                                        <div v-if="Math.round(avgRating) === 4" class="stars">
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: white;" class="fa fa-star"></i>
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
                            </div>

                            <div class="d-flex justify-content-between">
                                <div class="try">
                                    <div class="about">
                                        <h4 class="font-weight-bold"> {{ event.title }} (
                                            <span style="color: orange;font-size:15px;" v-if="daysRemaining == 0">
                                                Today</span>
                                            <span style="color: #189483;font-size:15px;" v-else-if="daysRemaining == 1">
                                                Tomorrow</span>
                                            <span style="color: #189483;font-size:15px;" v-else-if="daysRemaining > 1"> In
                                                {{
                                                    daysRemaining }} days</span>
                                            <span style="color: red;font-size:15px;" v-else-if="daysRemaining < 0"> Happened
                                            </span>
                                            )
                                        </h4>
                                    </div>
                                    <hr>
                                    <div class="about">
                                        <h6 class="font-weight-bold"> Mode : <span style="color:#189483;"> {{ event.mode }}
                                            </span>
                                        </h6>
                                    </div>

                                    <div class="about">
                                        <h6 class="font-weight-bold"> Entry : <span style="color:#189483;"> {{ event.entry
                                        }}
                                            </span></h6>
                                    </div>

                                    <div v-if="event.entry == 'Pay'" class="about">
                                        <h6 class="font-weight-bold"> Entry Fee : <span style="color:#189483;"> Ksh. {{
                                            event.entry_cost }} </span></h6>
                                    </div>
                                    <hr>
                                    <div class="product-description">
                                        <div class="mt-2">
                                            <h3 class="font-weight-bold">Description</h3>
                                            <p>{{ event.description }}</p>
                                        </div>
                                        <div class="mt-2">
                                            <h3 class="font-weight-bold">Requirements</h3>
                                            <ul
                                                v-if="event.requirement_1 == 0 || event.requirement_1 == false || event.requirement_1 == null || event.requirement_1 == 'null' || event.requirement_1 == '' || event.requirement_1 == 'NULL' || event.requirement_1 == 'undefined'">
                                            </ul>
                                            <ul v-else>
                                                <li> {{ event.requirement_1 }}</li>
                                            </ul>
                                            <br />

                                            <ul
                                                v-if="event.requirement_2 == 0 || event.requirement_2 == false || event.requirement_2 == null || event.requirement_2 == 'null' || event.requirement_2 == '' || event.requirement_2 == 'NULL' || event.requirement_2 == 'undefined'">
                                            </ul>
                                            <ul v-else>
                                                <li> {{ event.requirement_2 }}</li>
                                            </ul>
                                            <br />

                                            <ul
                                                v-if="event.requirement_3 == 0 || event.requirement_3 == false || event.requirement_3 == null || event.requirement_3 == 'null' || event.requirement_3 == '' || event.requirement_3 == 'NULL' || event.requirement_3 == 'undefined'">
                                            </ul>
                                            <ul v-else>
                                                <li> {{ event.requirement_3 }}</li>
                                            </ul>
                                            <br />

                                            <ul
                                                v-if="event.requirement_4 == 0 || event.requirement_4 == false || event.requirement_4 == null || event.requirement_4 == 'null' || event.requirement_4 == '' || event.requirement_4 == 'NULL' || event.requirement_4 == 'undefined'">
                                            </ul>
                                            <ul v-else>
                                                <li> {{ event.requirement_4 }}</li>
                                            </ul>
                                            <br />

                                            <ul
                                                v-if="event.requirement_5 == 0 || event.requirement_5 == false || event.requirement_5 == null || event.requirement_5 == 'null' || event.requirement_5 == '' || event.requirement_5 == 'NULL' || event.requirement_5 == 'undefined'">
                                            </ul>
                                            <ul v-else>
                                                <li> {{ event.requirement_5 }}</li>
                                            </ul>
                                            <br />
                                        </div>
                                    </div>
                                </div>

                                <div class="try">
                                    <router-link to="/login" v-if="id == false" data-toggle="tooltip"
                                        data-placement="bottom" title="Place in a call"
                                        class="btn bg-gradient-primary btn-sm me-2">
                                        <i style="font-size: 14px;" class="fa fa-volume-control-phone"></i>
                                    </router-link>

                                    <a v-else data-toggle="tooltip" data-placement="bottom" title="Place in a call"
                                        :href="'tell:' + event.contact" class="btn bg-gradient-primary btn-sm me-2">
                                        <i style="font-size: 14px;" class="fa fa-volume-control-phone"></i>
                                    </a>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div style="height: 40vh;background-color: #E9ECEF;" class="card mt-2">
                            <div class="rating rating-stars-container">
                                <div class="rating-stars"> Book for this event : <br /><br />
                                    <i style="font-size: 24px;" class="fa fa-calendar"></i> <span style="font-size: 24px;">
                                        <strong> : {{ event.date }}</strong></span>
                                    <br />
                                    <i style="font-size: 24px;" class="fa fa-clock"></i> <span style="font-size: 24px;">
                                        <strong> : {{ event.time }}</strong></span>
                                </div>

                                <form @submit.prevent="submitBooking">

                                    <input class="form-control" type="hidden" v-model="senderName" />

                                    <input class="form-control" type="hidden" v-model="senderId" />

                                    <input class="form-control" type="hidden" v-model="userId" />

                                    <input class="form-control" type="hidden" v-model="eventId" />

                                    <input class="form-control" type="hidden" v-model="eventImage" />

                                    <input class="form-control" type="hidden" v-model="eventTitle" />

                                    <input class="form-control" type="hidden" v-model="eventDescription" />

                                    <input class="form-control" type="hidden" v-model="eventDate" />

                                    <input class="form-control" type="hidden" v-model="eventTime" />

                                    <div class="mx-3 mt-3 mb-2">
                                        <router-link v-if="senderId == false" to="/login"
                                            class="btn bg-gradient-primary btn-sm">
                                            <small>
                                                Book Event
                                            </small>
                                        </router-link>

                                        <div v-else>
                                            <button v-if="booked == false" type="submit"
                                                class="btn bg-gradient-primary btn-sm">
                                                <small>
                                                    Book Event
                                                </small>
                                            </button>

                                            <button v-if="booked == true" type="button" class="btn btn-danger btn-sm">
                                                <small>
                                                    Event Booked
                                                </small>
                                            </button>
                                        </div>


                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div style="background-color: #E9ECEF;" class="card mt-2">
                            <div class="rating rating-stars-container">
                                <div class="rating-stars"> Rate this event : <br />
                                    <span style="font-size: 25px;" v-for="star in stars" :key="star"
                                        @click="setRating(star)" :class="{ 'selected': star <= rating }">
                                        &#9733;
                                    </span>
                                </div>
                                <form @submit.prevent="submit">

                                    <input class="form-control" type="hidden" v-model="ratingValue" />

                                    <input class="form-control" type="hidden" v-model="senderName" />

                                    <input class="form-control" type="hidden" v-model="senderId" />

                                    <input class="form-control" type="hidden" v-model="userId" />

                                    <input class="form-control" type="hidden" v-model="eventId" />

                                    <input class="form-control" type="hidden" v-model="eventTitle" />

                                    <div class="mx-3 mt-3 mb-2">
                                        <textarea name="message" v-model="comment" class="form-control" id="message"
                                            rows="6" placeholder="Comment Here ...."></textarea>
                                    </div>

                                    <div class="mx-3 mt-3 mb-2">
                                        <router-link v-if="id == false" to="/login" class="btn bg-gradient-primary btn-sm">
                                            <small>
                                                Submit
                                            </small>
                                        </router-link>

                                        <button v-else type="submit" class="btn bg-gradient-primary btn-sm">
                                            <small>
                                                Submit
                                            </small>
                                        </button>
                                    </div>

                                </form>
                            </div>
                            <h6>Reviews</h6>

                            <div class="badges">
                                <span style="margin: 3px;" class="badge bg-dark ">
                                    <i class="fa fa-comments-o"></i> {{ commentCount }}
                                </span>
                                <span style="margin: 3px;" class="badge bg-dark">
                                    <div v-if="Math.round(avgRating) === 0" class="stars">
                                        <i style="color: white;" class="fa fa-star"></i>
                                        <i style="color: white;" class="fa fa-star"></i>
                                        <i style="color: white;" class="fa fa-star"></i>
                                        <i style="color: white;" class="fa fa-star"></i>
                                        <i style="color: white;" class="fa fa-star"></i>
                                    </div>
                                    <div v-if="Math.round(avgRating) === 1" class="stars">
                                        <i style="color: orange;" class="fa fa-star"></i>
                                        <i style="color: white;" class="fa fa-star"></i>
                                        <i style="color: white;" class="fa fa-star"></i>
                                        <i style="color: white;" class="fa fa-star"></i>
                                        <i style="color: white;" class="fa fa-star"></i>
                                    </div>
                                    <div v-if="Math.round(avgRating) === 2" class="stars">
                                        <i style="color: orange;" class="fa fa-star"></i>
                                        <i style="color: orange;" class="fa fa-star"></i>
                                        <i style="color: white;" class="fa fa-star"></i>
                                        <i style="color: white;" class="fa fa-star"></i>
                                        <i style="color: white;" class="fa fa-star"></i>
                                    </div>
                                    <div v-if="Math.round(avgRating) === 3" class="stars">
                                        <i style="color: orange;" class="fa fa-star"></i>
                                        <i style="color: orange;" class="fa fa-star"></i>
                                        <i style="color: orange;" class="fa fa-star"></i>
                                        <i style="color: white;" class="fa fa-star"></i>
                                        <i style="color: white;" class="fa fa-star"></i>
                                    </div>
                                    <div v-if="Math.round(avgRating) === 4" class="stars">
                                        <i style="color: orange;" class="fa fa-star"></i>
                                        <i style="color: orange;" class="fa fa-star"></i>
                                        <i style="color: orange;" class="fa fa-star"></i>
                                        <i style="color: orange;" class="fa fa-star"></i>
                                        <i style="color: white;" class="fa fa-star"></i>
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


                            <hr>

                            <div style="height: 40vh;width: 100%;overflow-y: auto;">
                                <div v-for="(review, index) in eventreviews" :key="review.id" class="comment-section">
                                    <div v-if="review.eventId == event.id"
                                        class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex flex-row align-items-center">
                                            <div class="d-flex flex-column ml-1 comment-profile">
                                                <div class="comment-ratings">
                                                    <span
                                                        v-if="review.ratingValue == 0 || review.ratingValue == false || review.ratingValue == null || review.ratingValue == 'null' || review.ratingValue == '' || review.ratingValue == 'NULL' || review.ratingValue == 'undefined'">
                                                        <i style="color: grey;" class="fa fa-star"></i>
                                                        <i style="color: grey;" class="fa fa-star"></i>
                                                        <i style="color: grey;" class="fa fa-star"></i>
                                                        <i style="color: grey;" class="fa fa-star"></i>
                                                        <i style="color: grey;" class="fa fa-star"></i>
                                                    </span>
                                                    <span v-if="review.ratingValue == 1">
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: grey;" class="fa fa-star"></i>
                                                        <i style="color: grey;" class="fa fa-star"></i>
                                                        <i style="color: grey;" class="fa fa-star"></i>
                                                        <i style="color: grey;" class="fa fa-star"></i>
                                                    </span>
                                                    <span v-if="review.ratingValue == 2">
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: grey;" class="fa fa-star"></i>
                                                        <i style="color: grey;" class="fa fa-star"></i>
                                                        <i style="color: grey;" class="fa fa-star"></i>
                                                    </span>
                                                    <span v-if="review.ratingValue == 3">
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: grey;" class="fa fa-star"></i>
                                                        <i style="color: grey;" class="fa fa-star"></i>
                                                    </span>
                                                    <span v-if="review.ratingValue == 4">
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: grey;" class="fa fa-star"></i>
                                                    </span>
                                                    <span v-if="review.ratingValue == 5">
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                        <i style="color: orange;" class="fa fa-star"></i>
                                                    </span>

                                                    <span style="margin: 4px;" class="text-muted"> (
                                                        {{ review.created_at }} )</span>
                                                </div>
                                                <span class="username"> {{ review.senderName }} :- "
                                                    {{ review.comment }} "
                                                    <button v-if="review.senderId == id" type="button"
                                                        @click="destroy(review.id)" class="delete-btn"
                                                        style="float: right;border:none;outline:none;background: none;">
                                                        <i class="fa fa-trash-o" style="color: red;"></i>
                                                    </button>
                                                </span>
                                            </div>

                                        </div>
                                        <hr class="horizontal dark my-5">
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
import axios from 'axios';
import Footer from './Footer.vue'
import Loader from './Loader.vue'

export default {

    components: {
        Footer,
        Loader,
    },
    emits: ["updateSidebar"],
    props: ["slug"],
    data() {
        return {
            reviewCount: 0,
            rating: 0,
            event: {},
            events: [],
            eventreviews: {},
            id: "",
            name: "",
            slug: "",
            avgRating: 0,
            commentCount: 0,
            booked: "",
            eventTitleCount: 0,
            currentDateValue: new Date(),
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
                return this.event.user_id;
            },
            set(value) {
                this.event.user_id = value;
            }
        },

        eventId: {
            get() {
                return this.event.id;
            },
            set(value) {
                this.event.id = value;
            }
        },

        eventSlug: {
            get() {
                return this.event.slug;
            },
            set(value) {
                this.event.slug = value;
            }
        },

        eventContact: {
            get() {
                return this.event.contact;
            },
            set(value) {
                this.event.contact = value;
            }
        },

        eventTitle: {
            get() {
                return this.event.title;
            },
            set(value) {
                this.event.title = value;
            }
        },

        eventDescription: {
            get() {
                return this.event.description;
            },
            set(value) {
                this.event.description = value;
            }
        },

        currentDate() {
            return this.currentDateValue;
        },

        daysRemaining() {
            const eventDate = new Date(this.event.date);
            const diffInMs = eventDate.getTime() - this.currentDateValue.getTime();
            const diffInDays = Math.floor(diffInMs / (1000 * 60 * 60 * 24) + 1);
            return diffInDays;
        },

        eventDate: {
            get() {
                return this.event.date;
            },
            set(value) {
                this.event.date = value;
            }
        },

        eventSlug: {
            get() {
                return this.event.slug;
            },
            set(value) {
                this.event.slug = value;
            }
        },

        eventTime: {
            get() {
                return this.event.time;
            },
            set(value) {
                this.event.time = value;
            }
        },

        eventImage: {
            get() {
                return this.event.image_1;
            },
            set(value) {
                this.event.image_1 = value;
            }
        },
    },

    created() {
        this.productName(this.currentPage);
    },

    methods: {

        activateImageView() {
            this.imageLoading = true;
        },

        deactivateImageView() {
            this.imageLoading = false;
        },

        setRating(rating) {
            this.rating = rating;
        },

        updateCurrentDate() {
            this.currentDateValue = new Date();
        },

        submit() {

            const fd = new FormData();
            fd.append("ratingValue", this.ratingValue);
            fd.append("senderName", this.senderName);
            fd.append("senderId", this.senderId);
            fd.append("userId", this.userId);
            fd.append("eventId", this.eventId);
            fd.append("eventTitle", this.eventTitle);
            fd.append("comment", this.comment);

            fd.append("_method", "POST");


            axios
                .post("/api/eventreviews", fd, {
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

                    axios.get('/api/eventreviews')
                        .then(response => {
                            this.eventreviews = response.data.data;
                        });

                    axios.get(`/api/events/${this.$route.params.slug}`)
                        .then(response => {
                            console.log(JSON.stringify(response));
                            this.event = response.data.data;
                            this.avgRating = response.data.avg_rate;
                            this.commentCount = response.data.comment_count;
                            this.booked = response.data.booked;
                            this.eventTitleCount = response.data.eventTitle_count;
                        });
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    this.success = false;
                });
        },

        submitBooking() {
            const fd = new FormData();
            fd.append("ratingValue", this.ratingValue);
            fd.append("senderName", this.senderName);
            fd.append("senderId", this.senderId);
            fd.append("userId", this.userId);
            fd.append("eventId", this.eventId);
            fd.append("eventTitle", this.eventTitle);
            fd.append("eventSlug", this.eventSlug);
            fd.append("eventImage", this.eventImage);
            fd.append("eventDescription", this.eventDescription);
            fd.append("eventDate", this.eventDate);
            fd.append("eventTime", this.eventTime);

            fd.append("_method", "POST");

            Swal.fire({
                title: 'Book Event',
                showCancelButton: true,
                confirmButtonColor: '#009688',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, continue'
            }).then((result) => {

                // Send request to the server
                if (result.value) {
                    axios
                        .post("/api/eventbookings", fd, {
                            headers: { "content-type": "multipart/form-data" },
                        })
                        .then(() => {

                            let timerInterval

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '<strong> Sent </strong>',
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
                            Swal.fire({
                                icon: 'error',
                                title: 'You can only book once',
                                text: 'You already  booked for this event!',
                                footer: ''
                            })
                        });
                }
            })
        },

        sendReport() {

            const fd = new FormData();
            fd.append("user_id", this.userId);
            fd.append("id", this.eventId);
            fd.append("event_title", this.eventTitle);
            fd.append("image_1", this.eventImage);
            fd.append("slug", this.eventSlug);
            fd.append("contact", this.eventContact);
            fd.append("event_issue", this.event_issue);
            fd.append("event_complaint", this.event_complaint);

            fd.append("_method", "POST");


            axios
                .post("/api/eventreports", fd, {
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
                    this.eventIssue = '';
                    this.eventComplaint = '';
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
                        .delete("/api/eventreviews/" + id)
                        .then((response) => {
                            Swal.fire(
                                'Deleted!',
                                'Information has been successfully deleted.',
                                'success'
                            );
                            // Fire.$emit('AfterCreate');
                            axios.get("/api/eventreviews").then(({
                                data
                            }) => (this.eventreviews = data.data))
                        }).catch((error) => {
                            Swal.fire("Failed!", error.message, "warning");
                        });

                    axios.get(`/api/events/${this.$route.params.slug}`)
                        .then(response => {
                            console.log(JSON.stringify(response));
                            this.event = response.data.data;
                            this.avgRating = response.data.avg_rate;
                            this.commentCount = response.data.comment_count;
                            this.booked = response.data.booked;
                            this.eventTitleCount = response.data.eventTitle_count;
                        });
                }
            })
        },

        getProduct() {
            axios.get("/api/events/" + this.$route.params.id)
                .then(response => {
                    this.event = response.data;
                    this.reviewCount = response.data.eventreviews.length;
                });
        },

        productName(page) {
            axios
                .get('/api/eventings?page=' + page, {
                    params: {
                        search: this.title,
                    },
                })
                .then((response) => {
                    this.events = response.data.data;
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
                .get("/api/events", {
                    params: {
                        page: page,
                        search: this.title,
                    },
                })
                .then((response) => {
                    this.events = response.data.data;
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

        axios.get(`/api/events/${this.$route.params.slug}`)
            .then(response => {
                console.log(JSON.stringify(response));
                this.event = response.data.data;
                this.avgRating = response.data.avg_rate;
                this.commentCount = response.data.comment_count;
                this.booked = response.data.booked;
                this.eventTitleCount = response.data.eventTitle_count;
            });

        axios.get('/api/eventreviews')
            .then(response => {
                this.eventreviews = response.data.data;
            });

    },
};
</script>

<style scoped>
.card {
    background-color: #fff;
    padding: 14px;
    border: none
}

.demo {
    width: 100%
}

ul {
    list-style: none outside none;
    padding-left: 0;
    margin-bottom: 0
}

li {
    display: block;
    float: left;
    margin-right: 6px;
    cursor: pointer
}


.stars i {
    color: #f6d151
}

.stars span {
    font-size: 13px
}

hr {
    color: #d4d4d4
}

.badge {
    padding: 5px !important;
    padding-bottom: 6px !important
}

.badge i {
    font-size: 10px
}

.profile-image {
    width: 35px
}

.comment-ratings i {
    font-size: 13px
}

.username {
    font-size: 12px
}

.comment-profile {
    line-height: 17px
}

.date span {
    font-size: 12px
}

.p-ratings i {
    color: #f6d151;
    font-size: 12px
}

.btn-long {
    padding-left: 35px;
    padding-right: 35px
}

.buttons {
    margin-top: 15px
}

.buttons .btn {
    height: 46px
}

.buttons .cart {
    border-color: #ff7676;
    color: #ff7676
}

.buttons .cart:hover {
    background-color: #e86464 !important;
    color: #fff
}

.buttons .buy {
    color: #fff;
    background-color: #ff7676;
    border-color: #ff7676
}

.buttons .buy:focus,
.buy:active {
    color: #fff;
    background-color: #ff7676;
    border-color: #ff7676;
    box-shadow: none
}

.buttons .buy:hover {
    color: #fff;
    background-color: #e86464;
    border-color: #e86464
}

.buttons .wishlist {
    background-color: #fff;
    border-color: #ff7676
}

.buttons .wishlist:hover {
    background-color: #e86464;
    border-color: #e86464;
    color: #fff
}

.buttons .wishlist:hover i {
    color: #fff
}

.buttons .wishlist i {
    color: #ff7676
}

.comment-ratings i {
    color: #f6d151
}

.followers {
    font-size: 9px;
    color: #d6d4d4
}

.store-image {
    width: 42px
}

.dot {
    height: 10px;
    width: 10px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block;
    margin-right: 5px
}

.bullet-text {
    font-size: 12px
}

.my-color {
    margin-top: 10px;
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
    border: 2px solid #8f37aa;
    display: inline-block;
    color: #8f37aa;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    text-transform: uppercase;
    transition: 0.5s all
}

label.radio .red {
    background-color: red;
    border-color: red
}

label.radio .blue {
    background-color: blue;
    border-color: blue
}

label.radio .green {
    background-color: green;
    border-color: green
}

label.radio .orange {
    background-color: orange;
    border-color: orange
}

label.radio input:checked+span {
    color: #fff;
    position: relative
}

label.radio input:checked+span::before {
    opacity: 1;
    content: '\2713';
    position: absolute;
    font-size: 13px;
    font-weight: bold;
    left: 4px
}

.card-body {
    padding: 0.3rem 0.3rem 0.2rem
}
</style>