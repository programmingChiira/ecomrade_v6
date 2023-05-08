<template>
    <body class="about-us">
        <div class="full-page-loader" v-if="loading">
            <img src="/triangle.svg" alt="Loader" />
        </div>
        <section class="my-5 py-5">
            <div class="wrapperr">
                <div style="background-color: #E9ECEF;" class="profile-card js-profile-card">
                    <div class="profile-card__img">
                        <a data-bs-toggle="modal" data-bs-target="#exampleModal" href="javascript:;">
                            <img v-if="user.profile_pic == false || user.profile_pic == null || user.profile_pic == 'null' || user.profile_pic == '' || user.profile_pic == ' '"
                                src="/web/img/no_img.jpg" alt="profile card">
                            <img v-else :src="'./img/profiles/' + user.profile_pic" alt="profile card">
                        </a>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-sm-3 col-6 mx-auto">
                                <!-- Button trigger modal -->
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"> Profile Pic</h5>
                                                <button type="button" class="btn-close btn bg-gradient-dark"
                                                    data-bs-dismiss="modal" aria-label="Close"> X </button>
                                            </div>
                                            <div class="modal-body">
                                                <img style="width: 100%;"
                                                    v-if="user.profile_pic == false || user.profile_pic == null || user.profile_pic == 'null' || user.profile_pic == '' || user.profile_pic == ' '"
                                                    src="/web/img/no_img.jpg" alt="profile card">
                                                <img style="width: 100%;" v-else :src="'./img/profiles/' + user.profile_pic"
                                                    alt="profile card">


                                                <div class="profile-card-loc">
                                                    <span class="profile-card-loc__txt">
                                                        <span
                                                            v-if="user.personal_description == false || user.personal_description == null || user.personal_description == 'null' || user.personal_description == '' || user.personal_description == ' '">
                                                            "No Personal description" :-
                                                        </span>
                                                        <span v-else> " <i>{{ user.personal_description }}</i> "
                                                            :-</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="background-color: #E9ECEF;" class="profile-card__cnt js-profile-cnt">
                        <div class="profile-card__name"> {{ user.name }}</div>

                        <div class="profile-card__txt">
                            <span
                                v-if="user.title == false || user.title == null || user.title == 'null' || user.title == '' || user.title == ' ' || user.title == 'undefined'">
                            </span>

                            <strong v-else>{{ user.title }}</strong>
                        </div>


                        <div class="profile-card-loc">
                            <span class="profile-card-loc__txt">
                                <span
                                    v-if="user.campus == false || user.campus == null || user.campus == 'null' || user.campus == '' || user.campus == ' '">
                                </span>
                                <span v-else>{{ user.campus }} ,</span><br>

                                <span
                                    v-if="user.campus_area == false || user.campus_area == null || user.campus_area == 'null' || user.campus_area == '' || user.campus_area == ' '">
                                </span>
                                <span v-else>{{ user.campus_area }}</span>
                            </span>
                        </div>

                        <div v-show="user.id !== id" class="profile-card-ctr">
                            <form @submit.prevent="sendConnection">
                                <input class="form-control" type="hidden" v-model="receiverId" />
                                <input class="form-control" type="hidden" v-model="receiverSlug" />
                                <input class="form-control" type="hidden" v-model="receiverName" />
                                <input class="form-control" type="hidden" v-model="receiverImage" />
                                <button
                                    v-show="user.sendNotConnected == false && user.receiveNotConnected == false && user.sendConnected == false && user.receiveConnected == false && user.id != id"
                                    type="submit" class="btn bg-gradient-primary btn-sm me-2">
                                    Connect
                                </button>

                                <button
                                    v-show="user.sendNotConnected == true || user.receiveNotConnected == true && user.id != id"
                                    type="button" class="btn btn-warning btn-sm me-2">
                                    Pending <i class="fa fa-cog fa-spin"
                                        style="font-size:14px;color:#171515;padding: 4px;"></i>
                                </button>

                                <button
                                    v-show="user.sendConnected == true || user.receiveConnected == true && user.id != id"
                                    type="button" class="btn btn-success btn-sm me-2">
                                    Connected <i class="fa fa-certificate"
                                        style="font-size:14px;color:#171515;padding: 4px;"></i>
                                </button>

                                <router-link :title="'Chat with ' + user.name"
                                    v-show="user.sendConnected == true || user.receiveConnected == true && user.id != id"
                                    class="nav-link font-weight-bolder" :to="{
                                        name: 'ChatUser',
                                        params: { slug: slug },
                                    }">
                                    <i style="color: #gray;" class="fa fa-envelope"></i>
                                </router-link>
                            </form>
                        </div>

                        <div class="d-flex justify-content-between" style="margin: 5px;">
                            <a v-show="user.id === id" data-bs-toggle="modal" data-bs-target="#ellipsis"
                                href="javascript:;">
                                <i class="fa fa-ellipsis-h"></i><sup><i
                                        v-show="user.sendNotConnectedCount > 0 || user.receiveNotConnectedCount > 0"
                                        class="fa fa-circle" style="font-size:10px;color:red"></i></sup>
                            </a>

                            <div class="modal fade" id="ellipsis" tabindex="-1" aria-labelledby="ellipsisLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ellipsisLabel"> Connection info</h5>
                                            <button type="button" class="btn btn-sm" data-bs-dismiss="modal"
                                                aria-label="Close"> <i style="font-size: 12px;" class="fa fa-times"></i>
                                            </button>
                                        </div>
                                        <div style="text-align: left;" class="modal-body">

                                            <button v-show="user.id === id" title="Search comrade"
                                                style="outline:none;background: none;border:none;" type="button"
                                                data-bs-dismiss="modal" aria-label="Close">
                                                <router-link to="/searchuser">
                                                    <i style="margin: 10px;color: #1CC0A0;" class="fa fa-search"></i> Search
                                                    for Comrades
                                                </router-link>
                                            </button>
                                            <hr class="horizontal dark my-2" />
                                            <button v-show="user.id === id" title="Connect requests you have sent"
                                                style="outline:none;background: none;border:none;" type="button"
                                                data-bs-dismiss="modal" aria-label="Close">
                                                <router-link to="/viewSentConnect">
                                                    <i style="margin: 10px;color:#00acee;" class="fa fa-paper-plane">
                                                        <sup><i v-show="user.sendNotConnectedCount > 0" class="fa fa-circle"
                                                                style="font-size:10px;color:red"></i></sup>
                                                    </i>
                                                    Sent requests
                                                </router-link>
                                            </button>
                                            <hr class="horizontal dark my-2" />
                                            <button v-show="user.id === id" title="Connect requests you have received"
                                                style="outline:none;background: none;border:none;" type="button"
                                                data-bs-dismiss="modal" aria-label="Close">
                                                <router-link to="/viewReceivedConnect">
                                                    <i style="margin: 10px;" class="fa fa-bell">
                                                        <sup><i v-show="user.receiveNotConnectedCount > 0"
                                                                class="fa fa-circle"
                                                                style="font-size:10px;color:red"></i></sup>
                                                    </i>
                                                    Received requests
                                                </router-link>
                                            </button>
                                            <hr class="horizontal dark my-2" />
                                            <button v-show="user.id === id" title="My friends"
                                                style="outline:none;background: none;border:none;" type="button"
                                                data-bs-dismiss="modal" aria-label="Close">
                                                <router-link to="/viewAcceptedConnect">
                                                    <i style="margin: 10px;" class="fa fa-user-friends"></i> My connections
                                                    ( {{ user.connectedUsersCount }} )
                                                </router-link>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <router-link v-show="user.id === id" class="nav-link font-weight-bolder"
                                :to="'/editProfile' + slug">
                                <i style="margin: 10px;-webkit-animation: fa-spin 3s infinite linear;animation: fa-spin 3s infinite linear;"
                                    class="fa fa-cog"></i>
                            </router-link>
                        </div>


                        <hr class="horizontal dark my-5" />

                        <div class="d-flex justify-content-between" style="margin: 5px;">
                            <a :href="user.facebook" target="_blank">
                                <i style="color: #3b5998;" class="fa fa-facebook-f"></i>
                            </a>

                            <a :href="user.twitter" target="_blank">
                                <i style="color: #00acee;" class="fa fa-twitter"></i>
                            </a>

                            <a :href="user.instagram" target="_blank">
                                <i style="color: #285AEB;" class="fa fa-instagram"></i>
                            </a>

                            <a :href="user.github" target="_blank">
                                <i style="color: #171515;" class="fa fa-github"></i>
                            </a>

                            <a :href="user.youtube" target="_blank">
                                <i style="color: #FF0000;" class="fa fa-youtube-play"></i>
                            </a>
                        </div>

                        <hr class="horizontal dark my-5" />

                        <div class="profile-card-inf">
                            <div class="profile-card-inf__item">
                                <router-link style="background-color: white;" class="btn btn-sm" :to="{
                                    name: 'Profile',
                                    params: { slug: slug },
                                }"><i style="font-size: 12px;" class="fa fa-user-friends"></i>
                                </router-link>
                            </div>

                            <div class="profile-card-inf__item">
                                <router-link style="background-color: white;" class="btn btn-sm" :to="{
                                    name: 'ProdProfile',
                                    params: { slug: slug },
                                }"><i style="font-size: 12px;" class="fa fa-store"></i>
                                </router-link>
                            </div>

                            <div class="profile-card-inf__item">
                                <router-link style="background-color: white;" class="btn btn-sm" :to="{
                                    name: 'BlogProfile',
                                    params: { slug: slug },
                                }">
                                    <i style="font-size: 12px;" class="fa fa-blog"></i>
                                </router-link>
                            </div>

                            <div class="profile-card-inf__item">
                                <router-link class="btn bg-gradient-primary btn-sm" :to="{
                                    name: 'PollProfile',
                                    params: { slug: slug },
                                }">
                                    <i style="font-size: 12px;" class="fa fa-poll"></i>
                                </router-link>
                            </div>
                        </div>

                        <hr class="horizontal dark my-5" />

                        <div v-if="type == 'admin' && user.id === id" class="profile-card-inf">
                            <router-link class="profile-card-inf__item" to="/dashboard">
                                <i style="color: #3b5998;" class="fa fa-dashboard"></i>
                                <p>Dash</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admuser">
                                <i style="color: #3b5998;" class="fa fa-user"></i>
                                <p>Users</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admmarket">
                                <i style="color: #3b5998;" class="fa fa-store"></i>
                                <p>Prods</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admmarketreport">
                                <i style="color: #d60d0d;" class="fa fa-warning"></i>
                                <p>Prod Reports</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admmarketcat">
                                <i style="color: #3b5998;" class="fa fa-list-alt"></i>
                                <p>Prod Cat</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admmarketsubcat">
                                <i style="color: #3b5998;" class="fa fa-list-alt"></i>
                                <p>Prod Sub-Cat</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admrental">
                                <i style="color: #3b5998;" class="fa fa-home"></i>
                                <p>Rentals</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admrentalbooking">
                                <i style="color: #0dd649f3;" class="fa fa-calendar"></i>
                                <p>Rental Bookings</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admrentalreport">
                                <i style="color: #d60d0d;" class="fa fa-warning"></i>
                                <p>Rental Reports</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admrentalcat">
                                <i style="color: #3b5998;" class="fa fa-list-alt"></i>
                                <p>Rentals Cat</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admblog">
                                <i style="color: #3b5998;" class="fa fa-blog"></i>
                                <p>Blogs</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admBlogCat">
                                <i style="color: #3b5998;" class="fa fa-list-alt"></i>
                                <p>Blog Cat</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admlocation">
                                <i style="color: #3b5998;" class="fa fa-map-marker"></i>
                                <p>Locations</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admpoll">
                                <i style="color: #3b5998;" class="fa fa-poll"></i>
                                <p>Polls</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admevent">
                                <i style="color: #3b5998;" class="fa fa-calendar"></i>
                                <p>Events</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admeventbooking">
                                <i style="color: #0dd649f3;" class="fa fa-calendar"></i>
                                <p>Event Bookings</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admeventreport">
                                <i style="color: #d60d0d;" class="fa fa-warning"></i>
                                <p>Event Reports</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admclub">
                                <i style="color: #3b5998;" class="fa fa-users"></i>
                                <p>Societies</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admfeed">
                                <i style="color: #3b5998;" class="fa fa-comments-o"></i>
                                <p>Feedback</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admresource">
                                <i style="color: #3b5998;" class="fa fa-book"></i>
                                <p>Resources</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admyear">
                                <i style="color: #3b5998;" class="fa fa-calendar"></i>
                                <p>Years</p>
                            </router-link>

                            <router-link v-if="type == 'admin'" class="profile-card-inf__item" to="/admcourse">
                                <i style="color: #3b5998;" class="fa fa-file"></i>
                                <p>Cources</p>
                            </router-link>

                            <router-link v-if="id == 1" class="profile-card-inf__item" to="/push">
                                <i style="color: #3b5998;" class="fa fa-telegram"></i>
                                <p>Push</p>
                            </router-link>
                        </div>
                        <a v-show="user.id === id" title="Logout" href="#" class="nav-link font-weight-bolder"
                            @click="logout">
                            <i style="color: red;float: right;" class="fa fa-power-off me-1"></i>
                        </a>
                    </div>

                </div>

            </div>
        </section>

        <div class="container">
            <div class="main-body">

                <!-- Breadcrumb -->
                <h4 style="text-align: center;">{{ user.name }}'s polls</h4>
                <br /><br />
                <!-- /Breadcrumb -->

                <div class="row align-items-center">
                    <div class="page-content">
                        <div class="container">
                            <div class="product-details-top">
                                <div class="row">
                                    <div style="margin: 10px;" class="col-md-12" v-for="(poll, index) in polls" :key="index"
                                        v-show="user.id == poll.user_id && poll.show_owner == 'Yes'">
                                        <div style="background-color: #E9ECEF;" class="wrapper">
                                            <div v-if="poll.voter_id_count >= 1">
                                                <button data-toggle="tooltip" data-placement="bottom"
                                                    title="You have already voted" style="font-size: 13px;float:right;"
                                                    type="submit" class="btn btn-success btn-sm">
                                                    Voted
                                                </button>
                                            </div>
                                            <h4>
                                                <router-link :to="{
                                                    name: 'ViewPoll',
                                                    params: { slug: poll.slug },
                                                }">
                                                    {{ poll.title }}
                                                </router-link>
                                            </h4>
                                            <header> {{ poll.argument }} <br></header>


                                            <div
                                                v-if="poll.option_1 == false || poll.option_1 == null || poll.option_1 == 'null' || poll.option_1 == '' || poll.option_1 == ' ' || poll.option_1 == NULL || poll.option_1 == 'undefined'">
                                            </div>
                                            <div class="poll-area" v-else>
                                                <label style="background-color: white;" for="opt-1" class="opt-1">
                                                    <div class="option-wrapper">
                                                        <button style="background: none;border:none;" data-toggle="tooltip"
                                                            data-placement="bottom" title="Report Post"
                                                            data-bs-toggle="modal"
                                                            :data-bs-target="'#exampleModal1-' + index">
                                                            <span
                                                                v-if="poll.image_1 == false || poll.image_1 == null || poll.image_1 == 'null' || poll.image_1 == '' || poll.image_1 == ' ' || poll.image_1 == NULL || poll.image_1 == 'undefined'"></span>
                                                            <img v-else class="option-image"
                                                                :src="'./img/poll/' + poll.image_1" alt="Option Image">
                                                        </button>


                                                        <div class="modal fade" :id="'exampleModal1-' + index" tabindex="-1"
                                                            :aria-labelledby="'exampleModal1Label-' + index"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">
                                                                            {{ poll.option_1 }}</h5>
                                                                        <button type="button"
                                                                            class="btn-close btn bg-gradient-dark"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <i class="fa fa-times"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <img style="width: 100%;"
                                                                            v-if="poll.image_1 == false || poll.image_1 == null || poll.image_1 == 'null' || poll.image_1 == '' || poll.image_1 == ' ' || poll.image_1 == NULL || poll.image_1 == 'undefined'"
                                                                            src="/web/img/no_img.jpg" alt="profile card">
                                                                        <img style="width: 100%;" v-else
                                                                            :src="'./img/poll/' + poll.image_1"
                                                                            alt="profile card">
                                                                        <br /><br />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="option-content">
                                                            <div class="row">
                                                                <span class="percent">{{ poll.option_1 }}</span>
                                                            </div>
                                                            <div class="progress" id="pstyle1"
                                                                :style="{ '--w': poll.vote_count && !isNaN(poll.vote_count) ? Math.round((poll.option_1_count * 100) / poll.vote_count) : 0 }">
                                                            </div>
                                                            <div class="row">
                                                                <span class="percent">( {{ poll.option_1_count }} ) {{
                                                                    poll.vote_count && !isNaN(poll.vote_count) ?
                                                                    Math.round((poll.option_1_count * 100) /
                                                                        poll.vote_count) + '%' : 'N/A' }}</span>
                                                            </div>
                                                            <div v-if="poll.voter_id_count >= 1">

                                                            </div>
                                                            <div v-else>
                                                                <form @submit.prevent="submit1(poll)">
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.user_id" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.id" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.title" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.option_1" />
                                                                    <button data-toggle="tooltip" data-placement="bottom"
                                                                        title="Vote" style="font-size: 13px;float:right;"
                                                                        type="submit"
                                                                        class="btn bg-gradient-primary btn-sm">
                                                                        Vote
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </label>
                                            </div>

                                            <div
                                                v-if="poll.option_2 == false || poll.option_2 == null || poll.option_2 == 'null' || poll.option_2 == '' || poll.option_2 == ' ' || poll.option_2 == NULL || poll.option_2 == 'undefined'">
                                            </div>
                                            <div class="poll-area" v-else>
                                                <label style="background-color: white;" for="opt-2" class="opt-2">
                                                    <div class="option-wrapper">
                                                        <button style="background: none;border:none;" data-toggle="tooltip"
                                                            data-placement="bottom" title="Report Post"
                                                            data-bs-toggle="modal"
                                                            :data-bs-target="'#exampleModal2-' + index">
                                                            <span
                                                                v-if="poll.image_2 == false || poll.image_2 == null || poll.image_2 == 'null' || poll.image_2 == '' || poll.image_2 == ' ' || poll.image_2 == NULL || poll.image_2 == 'undefined'"></span>
                                                            <img v-else class="option-image"
                                                                :src="'./img/poll/' + poll.image_2" alt="Option Image">
                                                        </button>

                                                        <div class="modal fade" :id="'exampleModal2-' + index" tabindex="-1"
                                                            :aria-labelledby="'exampleModal2Label-' + index"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">
                                                                            {{ poll.option_2 }}</h5>
                                                                        <button type="button"
                                                                            class="btn-close btn bg-gradient-dark"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <i class="fa fa-times"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <img style="width: 100%;"
                                                                            v-if="poll.image_2 == false || poll.image_2 == null || poll.image_2 == 'null' || poll.image_2 == '' || poll.image_2 == ' ' || poll.image_2 == NULL || poll.image_2 == 'undefined'"
                                                                            src="/web/img/no_img.jpg" alt="profile card">
                                                                        <img style="width: 100%;" v-else
                                                                            :src="'./img/poll/' + poll.image_2"
                                                                            alt="profile card">
                                                                        <br /><br />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="option-content">
                                                            <div class="row">
                                                                <span class="percent">{{ poll.option_2 }}</span>
                                                            </div>
                                                            <div class="progress" id="pstyle2"
                                                                :style="{ '--w': poll.vote_count && !isNaN(poll.vote_count) ? Math.round((poll.option_2_count * 100) / poll.vote_count) : 0 }">
                                                            </div>
                                                            <div class="row">
                                                                <span class="percent">( {{ poll.option_2_count }} ) {{
                                                                    poll.vote_count && !isNaN(poll.vote_count) ?
                                                                    Math.round((poll.option_2_count * 100) /
                                                                        poll.vote_count) + '%' : 'N/A' }}</span>

                                                            </div>
                                                            <div v-if="poll.voter_id_count >= 1">

                                                            </div>
                                                            <div v-else>
                                                                <form @submit.prevent="submit2(poll)">
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.user_id" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.id" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.title" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.option_2" />
                                                                    <button data-toggle="tooltip" data-placement="bottom"
                                                                        title="Vote" style="font-size: 13px;float:right;"
                                                                        type="submit"
                                                                        class="btn bg-gradient-primary btn-sm">
                                                                        Vote
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </label>
                                            </div>

                                            <div
                                                v-if="poll.option_3 == false || poll.option_3 == null || poll.option_3 == 'null' || poll.option_3 == '' || poll.option_3 == ' ' || poll.option_3 == NULL || poll.option_3 == 'undefined'">
                                            </div>
                                            <div class="poll-area" v-else>
                                                <label style="background-color: white;" for="opt-1" class="opt-1">
                                                    <div class="option-wrapper">
                                                        <button style="background: none;border:none;" data-toggle="tooltip"
                                                            data-placement="bottom" title="Report Post"
                                                            data-bs-toggle="modal"
                                                            :data-bs-target="'#exampleModal3-' + index">
                                                            <span
                                                                v-if="poll.image_3 == false || poll.image_3 == null || poll.image_3 == 'null' || poll.image_3 == '' || poll.image_3 == ' ' || poll.image_3 == NULL || poll.image_3 == 'undefined'"></span>
                                                            <img v-else class="option-image"
                                                                :src="'./img/poll/' + poll.image_3" alt="Option Image">
                                                        </button>

                                                        <div class="modal fade" :id="'exampleModal3-' + index" tabindex="-1"
                                                            :aria-labelledby="'exampleModal3Label-' + index"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">
                                                                            {{ poll.option_3 }}</h5>
                                                                        <button type="button"
                                                                            class="btn-close btn bg-gradient-dark"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <i class="fa fa-times"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <img style="width: 100%;"
                                                                            v-if="poll.image_3 == false || poll.image_3 == null || poll.image_3 == 'null' || poll.image_3 == '' || poll.image_3 == ' ' || poll.image_3 == NULL || poll.image_3 == 'undefined'"
                                                                            src="/web/img/no_img.jpg" alt="profile card">
                                                                        <img style="width: 100%;" v-else
                                                                            :src="'./img/poll/' + poll.image_3"
                                                                            alt="profile card">
                                                                        <br /><br />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="option-content">
                                                            <div class="row">
                                                                <span class="percent">{{ poll.option_3 }}</span>
                                                            </div>
                                                            <div class="progress" id="pstyle3"
                                                                :style="{ '--w': poll.vote_count && !isNaN(poll.vote_count) ? Math.round((poll.option_3_count * 100) / poll.vote_count) : 0 }">
                                                            </div>
                                                            <div class="row">
                                                                <span class="percent">( {{ poll.option_3_count }} ) {{
                                                                    poll.vote_count && !isNaN(poll.vote_count) ?
                                                                    Math.round((poll.option_3_count * 100) /
                                                                        poll.vote_count) + '%' : 'N/A' }}</span>
                                                            </div>
                                                            <div v-if="poll.voter_id_count >= 1">

                                                            </div>
                                                            <div v-else>
                                                                <form @submit.prevent="submit3(poll)">
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.user_id" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.id" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.title" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.option_3" />
                                                                    <button data-toggle="tooltip" data-placement="bottom"
                                                                        title="Vote" style="font-size: 13px;float:right;"
                                                                        type="submit"
                                                                        class="btn bg-gradient-primary btn-sm">
                                                                        Vote
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </label>
                                            </div>

                                            <div
                                                v-if="poll.option_4 == false || poll.option_4 == null || poll.option_4 == 'null' || poll.option_4 == '' || poll.option_4 == ' ' || poll.option_4 == NULL || poll.option_4 == 'undefined'">
                                            </div>
                                            <div class="poll-area" v-else>
                                                <label style="background-color: white;" for="opt-1" class="opt-1">
                                                    <div class="option-wrapper">
                                                        <button style="background: none;border:none;" data-toggle="tooltip"
                                                            data-placement="bottom" title="Report Post"
                                                            data-bs-toggle="modal"
                                                            :data-bs-target="'#exampleModal4-' + index">
                                                            <span
                                                                v-if="poll.image_4 == false || poll.image_4 == null || poll.image_4 == 'null' || poll.image_4 == '' || poll.image_4 == ' ' || poll.image_4 == NULL || poll.image_4 == 'undefined'"></span>
                                                            <img v-else class="option-image"
                                                                :src="'./img/poll/' + poll.image_4" alt="Option Image">
                                                        </button>

                                                        <div class="modal fade" :id="'exampleModal4-' + index" tabindex="-1"
                                                            :aria-labelledby="'exampleModal4Label-' + index"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">
                                                                            {{ poll.option_4 }}</h5>
                                                                        <button type="button"
                                                                            class="btn-close btn bg-gradient-dark"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <i class="fa fa-times"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <img style="width: 100%;"
                                                                            v-if="poll.image_4 == false || poll.image_4 == null || poll.image_4 == 'null' || poll.image_4 == '' || poll.image_4 == ' ' || poll.image_4 == NULL || poll.image_4 == 'undefined'"
                                                                            src="/web/img/no_img.jpg" alt="profile card">
                                                                        <img style="width: 100%;" v-else
                                                                            :src="'./img/poll/' + poll.image_4"
                                                                            alt="profile card">
                                                                        <br /><br />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="option-content">
                                                            <div class="row">
                                                                <span class="percent">{{ poll.option_4 }}</span>
                                                            </div>
                                                            <div class="progress" id="pstyle4"
                                                                :style="{ '--w': poll.vote_count && !isNaN(poll.vote_count) ? Math.round((poll.option_4_count * 100) / poll.vote_count) : 0 }">
                                                            </div>
                                                            <div class="row">
                                                                <span class="percent">( {{ poll.option_4_count }} ) {{
                                                                    poll.vote_count && !isNaN(poll.vote_count) ?
                                                                    Math.round((poll.option_4_count * 100) /
                                                                        poll.vote_count) + '%' : 'N/A' }}</span>
                                                            </div>
                                                            <div v-if="poll.voter_id_count >= 1">

                                                            </div>
                                                            <div v-else>
                                                                <form @submit.prevent="submit4(poll)">
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.user_id" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.id" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.title" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.option_4" />
                                                                    <button data-toggle="tooltip" data-placement="bottom"
                                                                        title="Vote" style="font-size: 13px;float:right;"
                                                                        type="submit"
                                                                        class="btn bg-gradient-primary btn-sm">
                                                                        Vote
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </label>
                                            </div>


                                            <div
                                                v-if="poll.option_5 == false || poll.option_5 == null || poll.option_5 == 'null' || poll.option_5 == '' || poll.option_5 == ' ' || poll.option_5 == NULL || poll.option_5 == 'undefined'">
                                            </div>
                                            <div class="poll-area" v-else>
                                                <label style="background-color: white;" for="opt-1" class="opt-1">
                                                    <div class="option-wrapper">
                                                        <button style="background: none;border:none;" data-toggle="tooltip"
                                                            data-placement="bottom" title="Report Post"
                                                            data-bs-toggle="modal"
                                                            :data-bs-target="'#exampleModal5-' + index">
                                                            <span
                                                                v-if="poll.image_5 == false || poll.image_5 == null || poll.image_5 == 'null' || poll.image_5 == '' || poll.image_5 == ' ' || poll.image_5 == NULL || poll.image_5 == 'undefined'"></span>
                                                            <img v-else class="option-image"
                                                                :src="'./img/poll/' + poll.image_5" alt="Option Image">
                                                        </button>

                                                        <div class="modal fade" :id="'exampleModal5-' + index" tabindex="-1"
                                                            :aria-labelledby="'exampleModal5Label-' + index"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">
                                                                            {{ poll.option_5 }}</h5>
                                                                        <button type="button"
                                                                            class="btn-close btn bg-gradient-dark"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <i class="fa fa-times"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <img style="width: 100%;"
                                                                            v-if="poll.image_5 == false || poll.image_5 == null || poll.image_5 == 'null' || poll.image_5 == '' || poll.image_5 == ' ' || poll.image_5 == NULL || poll.image_5 == 'undefined'"
                                                                            src="/web/img/no_img.jpg" alt="profile card">
                                                                        <img style="width: 100%;" v-else
                                                                            :src="'./img/poll/' + poll.image_5"
                                                                            alt="profile card">
                                                                        <br /><br />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="option-content">
                                                            <div class="row">
                                                                <span class="percent">{{ poll.option_5 }}</span>
                                                            </div>
                                                            <div class="progress" id="pstyle5"
                                                                :style="{ '--w': poll.vote_count && !isNaN(poll.vote_count) ? Math.round((poll.option_5_count * 100) / poll.vote_count) : 0 }">
                                                            </div>
                                                            <div class="row">
                                                                <span class="percent">( {{ poll.option_5_count }} ) {{
                                                                    poll.vote_count && !isNaN(poll.vote_count) ?
                                                                    Math.round((poll.option_5_count * 100) /
                                                                        poll.vote_count) + '%' : 'N/A' }}</span>
                                                            </div>
                                                            <div v-if="poll.voter_id_count >= 1">

                                                            </div>
                                                            <div v-else>
                                                                <form @submit.prevent="submit5(poll)">
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.user_id" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.id" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.title" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.option_5" />
                                                                    <button data-toggle="tooltip" data-placement="bottom"
                                                                        title="Vote" style="font-size: 13px;float:right;"
                                                                        type="submit"
                                                                        class="btn bg-gradient-primary btn-sm">
                                                                        Vote
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </label>
                                            </div>


                                            <div
                                                v-if="poll.option_6 == false || poll.option_6 == null || poll.option_6 == 'null' || poll.option_6 == '' || poll.option_6 == ' ' || poll.option_6 == NULL || poll.option_6 == 'undefined'">
                                            </div>
                                            <div class="poll-area" v-else>
                                                <label style="background-color: white;" for="opt-1" class="opt-1">
                                                    <div class="option-wrapper">
                                                        <button style="background: none;border:none;" data-toggle="tooltip"
                                                            data-placement="bottom" title="Report Post"
                                                            data-bs-toggle="modal"
                                                            :data-bs-target="'#exampleModal6-' + index">
                                                            <span
                                                                v-if="poll.image_6 == false || poll.image_6 == null || poll.image_6 == 'null' || poll.image_6 == '' || poll.image_6 == ' ' || poll.image_6 == NULL || poll.image_6 == 'undefined'"></span>
                                                            <img v-else class="option-image"
                                                                :src="'./img/poll/' + poll.image_6" alt="Option Image">
                                                        </button>

                                                        <div class="modal fade" :id="'exampleModal6-' + index" tabindex="-1"
                                                            :aria-labelledby="'exampleModal6Label-' + index"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">
                                                                            {{ poll.option_6 }}</h5>
                                                                        <button type="button"
                                                                            class="btn-close btn bg-gradient-dark"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <i class="fa fa-times"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <img style="width: 100%;"
                                                                            v-if="poll.image_6 == false || poll.image_6 == null || poll.image_6 == 'null' || poll.image_6 == '' || poll.image_6 == ' ' || poll.image_6 == NULL || poll.image_6 == 'undefined'"
                                                                            src="/web/img/no_img.jpg" alt="profile card">
                                                                        <img style="width: 100%;" v-else
                                                                            :src="'./img/poll/' + poll.image_6"
                                                                            alt="profile card">
                                                                        <br /><br />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="option-content">
                                                            <div class="row">
                                                                <span class="percent">{{ poll.option_6 }}</span>
                                                            </div>
                                                            <div class="progress" id="pstyle6"
                                                                :style="{ '--w': poll.vote_count && !isNaN(poll.vote_count) ? Math.round((poll.option_6_count * 100) / poll.vote_count) : 0 }">
                                                            </div>
                                                            <div class="row">
                                                                <span class="percent">( {{ poll.option_6_count }} ) {{
                                                                    poll.vote_count && !isNaN(poll.vote_count) ?
                                                                    Math.round((poll.option_6_count * 100) /
                                                                        poll.vote_count) + '%' : 'N/A' }}</span>
                                                            </div>
                                                            <div v-if="poll.voter_id_count >= 1">

                                                            </div>
                                                            <div v-else>
                                                                <form @submit.prevent="submit6(poll)">
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.user_id" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.id" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.title" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.option_6" />
                                                                    <button data-toggle="tooltip" data-placement="bottom"
                                                                        title="Vote" style="font-size: 13px;float:right;"
                                                                        type="submit"
                                                                        class="btn bg-gradient-primary btn-sm">
                                                                        Vote
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </label>
                                            </div>



                                            <div
                                                v-if="poll.option_7 == false || poll.option_7 == null || poll.option_7 == 'null' || poll.option_7 == '' || poll.option_7 == ' ' || poll.option_7 == NULL || poll.option_7 == 'undefined'">
                                            </div>
                                            <div class="poll-area" v-else>
                                                <label style="background-color: white;" for="opt-1" class="opt-1">
                                                    <div class="option-wrapper">
                                                        <button style="background: none;border:none;" data-toggle="tooltip"
                                                            data-placement="bottom" title="Report Post"
                                                            data-bs-toggle="modal"
                                                            :data-bs-target="'#exampleModal7-' + index">
                                                            <span
                                                                v-if="poll.image_7 == false || poll.image_7 == null || poll.image_7 == 'null' || poll.image_7 == '' || poll.image_7 == ' ' || poll.image_7 == NULL || poll.image_7 == 'undefined'"></span>
                                                            <img v-else class="option-image"
                                                                :src="'./img/poll/' + poll.image_7" alt="Option Image">
                                                        </button>

                                                        <div class="modal fade" :id="'exampleModal7-' + index" tabindex="-1"
                                                            :aria-labelledby="'exampleModal7Label-' + index"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">
                                                                            {{ poll.option_7 }}</h5>
                                                                        <button type="button"
                                                                            class="btn-close btn bg-gradient-dark"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <i class="fa fa-times"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <img style="width: 100%;"
                                                                            v-if="poll.image_7 == false || poll.image_7 == null || poll.image_7 == 'null' || poll.image_7 == '' || poll.image_7 == ' ' || poll.image_7 == NULL || poll.image_7 == 'undefined'"
                                                                            src="/web/img/no_img.jpg" alt="profile card">
                                                                        <img style="width: 100%;" v-else
                                                                            :src="'./img/poll/' + poll.image_7"
                                                                            alt="profile card">
                                                                        <br /><br />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="option-content">
                                                            <div class="row">
                                                                <span class="percent">{{ poll.option_7 }}</span>
                                                            </div>
                                                            <div class="progress" id="pstyle7"
                                                                :style="{ '--w': poll.vote_count && !isNaN(poll.vote_count) ? Math.round((poll.option_7_count * 100) / poll.vote_count) : 0 }">
                                                            </div>
                                                            <div class="row">
                                                                <span class="percent">( {{ poll.option_7_count }} ) {{
                                                                    poll.vote_count && !isNaN(poll.vote_count) ?
                                                                    Math.round((poll.option_7_count * 100) /
                                                                        poll.vote_count) + '%' : 'N/A' }}</span>
                                                            </div>
                                                            <div v-if="poll.voter_id_count >= 1">

                                                            </div>
                                                            <div v-else>
                                                                <form @submit.prevent="submit7(poll)">
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.user_id" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.id" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.title" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.option_7" />
                                                                    <button data-toggle="tooltip" data-placement="bottom"
                                                                        title="Vote" style="font-size: 13px;float:right;"
                                                                        type="submit"
                                                                        class="btn bg-gradient-primary btn-sm">
                                                                        Vote
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </label>
                                            </div>


                                            <div
                                                v-if="poll.option_8 == false || poll.option_8 == null || poll.option_8 == 'null' || poll.option_8 == '' || poll.option_8 == ' ' || poll.option_8 == NULL || poll.option_8 == 'undefined'">
                                            </div>
                                            <div class="poll-area" v-else>
                                                <label style="background-color: white;" for="opt-1" class="opt-1">
                                                    <div class="option-wrapper">
                                                        <button style="background: none;border:none;" data-toggle="tooltip"
                                                            data-placement="bottom" title="Report Post"
                                                            data-bs-toggle="modal"
                                                            :data-bs-target="'#exampleModal8-' + index">
                                                            <span
                                                                v-if="poll.image_8 == false || poll.image_8 == null || poll.image_8 == 'null' || poll.image_8 == '' || poll.image_8 == ' ' || poll.image_8 == NULL || poll.image_8 == 'undefined'"></span>
                                                            <img v-else class="option-image"
                                                                :src="'./img/poll/' + poll.image_8" alt="Option Image">
                                                        </button>

                                                        <div class="modal fade" :id="'exampleModal8-' + index" tabindex="-1"
                                                            :aria-labelledby="'exampleModal8Label-' + index"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">
                                                                            {{ poll.option_8 }}</h5>
                                                                        <button type="button"
                                                                            class="btn-close btn bg-gradient-dark"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <i class="fa fa-times"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <img style="width: 100%;"
                                                                            v-if="poll.image_8 == false || poll.image_8 == null || poll.image_8 == 'null' || poll.image_8 == '' || poll.image_8 == ' ' || poll.image_8 == NULL || poll.image_8 == 'undefined'"
                                                                            src="/web/img/no_img.jpg" alt="profile card">
                                                                        <img style="width: 100%;" v-else
                                                                            :src="'./img/poll/' + poll.image_8"
                                                                            alt="profile card">
                                                                        <br /><br />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="option-content">
                                                            <div class="row">
                                                                <span class="percent">{{ poll.option_8 }}</span>
                                                            </div>
                                                            <div class="progress" id="pstyle8"
                                                                :style="{ '--w': poll.vote_count && !isNaN(poll.vote_count) ? Math.round((poll.option_8_count * 100) / poll.vote_count) : 0 }">
                                                            </div>
                                                            <div class="row">
                                                                <span class="percent">( {{ poll.option_8_count }} ) {{
                                                                    poll.vote_count && !isNaN(poll.vote_count) ?
                                                                    Math.round((poll.option_8_count * 100) /
                                                                        poll.vote_count) + '%' : 'N/A' }}</span>
                                                            </div>
                                                            <div v-if="poll.voter_id_count >= 1">

                                                            </div>
                                                            <div v-else>
                                                                <form @submit.prevent="submit8(poll)">
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.user_id" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.id" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.title" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.option_8" />
                                                                    <button data-toggle="tooltip" data-placement="bottom"
                                                                        title="Vote" style="font-size: 13px;float:right;"
                                                                        type="submit"
                                                                        class="btn bg-gradient-primary btn-sm">
                                                                        Vote
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </label>
                                            </div>


                                            <div
                                                v-if="poll.option_9 == false || poll.option_9 == null || poll.option_9 == 'null' || poll.option_9 == '' || poll.option_9 == ' ' || poll.option_9 == NULL || poll.option_9 == 'undefined'">
                                            </div>
                                            <div class="poll-area" v-else>
                                                <label style="background-color: white;" for="opt-1" class="opt-1">
                                                    <div class="option-wrapper">
                                                        <button style="background: none;border:none;" data-toggle="tooltip"
                                                            data-placement="bottom" title="Report Post"
                                                            data-bs-toggle="modal"
                                                            :data-bs-target="'#exampleModal9-' + index">
                                                            <span
                                                                v-if="poll.image_9 == false || poll.image_9 == null || poll.image_9 == 'null' || poll.image_9 == '' || poll.image_9 == ' ' || poll.image_9 == NULL || poll.image_9 == 'undefined'"></span>
                                                            <img v-else class="option-image"
                                                                :src="'./img/poll/' + poll.image_9" alt="Option Image">
                                                        </button>

                                                        <div class="modal fade" :id="'exampleModal9-' + index" tabindex="-1"
                                                            :aria-labelledby="'exampleModal9Label-' + index"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">
                                                                            {{ poll.option_9 }}</h5>
                                                                        <button type="button"
                                                                            class="btn-close btn bg-gradient-dark"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <i class="fa fa-times"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <img style="width: 100%;"
                                                                            v-if="poll.image_9 == false || poll.image_9 == null || poll.image_9 == 'null' || poll.image_9 == '' || poll.image_9 == ' ' || poll.image_9 == NULL || poll.image_9 == 'undefined'"
                                                                            src="/web/img/no_img.jpg" alt="profile card">
                                                                        <img style="width: 100%;" v-else
                                                                            :src="'./img/poll/' + poll.image_9"
                                                                            alt="profile card">
                                                                        <br /><br />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="option-content">
                                                            <div class="row">
                                                                <span class="percent">{{ poll.option_9 }}</span>
                                                            </div>
                                                            <div class="progress" id="pstyle9"
                                                                :style="{ '--w': poll.vote_count && !isNaN(poll.vote_count) ? Math.round((poll.option_9_count * 100) / poll.vote_count) : 0 }">
                                                            </div>
                                                            <div class="row">
                                                                <span class="percent">( {{ poll.option_9_count }} ) {{
                                                                    poll.vote_count && !isNaN(poll.vote_count) ?
                                                                    Math.round((poll.option_9_count * 100) /
                                                                        poll.vote_count) + '%' : 'N/A' }}</span>
                                                            </div>
                                                            <div v-if="poll.voter_id_count >= 1">

                                                            </div>
                                                            <div v-else>
                                                                <form @submit.prevent="submit9(poll)">
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.user_id" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.id" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.title" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.option_9" />
                                                                    <button data-toggle="tooltip" data-placement="bottom"
                                                                        title="Vote" style="font-size: 13px;float:right;"
                                                                        type="submit"
                                                                        class="btn bg-gradient-primary btn-sm">
                                                                        Vote
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </label>
                                            </div>


                                            <div
                                                v-if="poll.option_10 == false || poll.option_10 == null || poll.option_10 == 'null' || poll.option_10 == '' || poll.option_10 == ' ' || poll.option_10 == NULL || poll.option_10 == 'undefined'">
                                            </div>
                                            <div class="poll-area" v-else>
                                                <label style="background-color: white;" for="opt-1" class="opt-1">
                                                    <div class="option-wrapper">
                                                        <button style="background: none;border:none;" data-toggle="tooltip"
                                                            data-placement="bottom" title="Report Post"
                                                            data-bs-toggle="modal"
                                                            :data-bs-target="'#exampleModal10-' + index">
                                                            <span
                                                                v-if="poll.image_10 == false || poll.image_10 == null || poll.image_10 == 'null' || poll.image_10 == '' || poll.image_10 == ' ' || poll.image_10 == NULL || poll.image_10 == 'undefined'"></span>
                                                            <img v-else class="option-image"
                                                                :src="'./img/poll/' + poll.image_10" alt="Option Image">
                                                        </button>

                                                        <div class="modal fade" :id="'exampleModal10-' + index"
                                                            tabindex="-1" :aria-labelledby="'exampleModal10Label-' + index"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">
                                                                            {{ poll.option_10 }}</h5>
                                                                        <button type="button"
                                                                            class="btn-close btn bg-gradient-dark"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <i class="fa fa-times"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <img style="width: 100%;"
                                                                            v-if="poll.image_10 == false || poll.image_10 == null || poll.image_10 == 'null' || poll.image_10 == '' || poll.image_10 == ' ' || poll.image_10 == NULL || poll.image_10 == 'undefined'"
                                                                            src="/web/img/no_img.jpg" alt="profile card">
                                                                        <img style="width: 100%;" v-else
                                                                            :src="'./img/poll/' + poll.image_10"
                                                                            alt="profile card">
                                                                        <br /><br />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="option-content">
                                                            <div class="row">
                                                                <span class="percent">{{ poll.option_10 }}</span>
                                                            </div>
                                                            <div class="progress" id="pstyle10"
                                                                :style="{ '--w': poll.vote_count && !isNaN(poll.vote_count) ? Math.round((poll.option_10_count * 100) / poll.vote_count) : 0 }">
                                                            </div>
                                                            <div class="row">
                                                                <span class="percent">( {{ poll.option_10_count }} ) {{
                                                                    poll.vote_count && !isNaN(poll.vote_count) ?
                                                                    Math.round((poll.option_10_count * 100) /
                                                                        poll.vote_count) + '%' : 'N/A' }}</span>
                                                            </div>
                                                            <div v-if="poll.voter_id_count >= 1">

                                                            </div>
                                                            <div v-else>
                                                                <form @submit.prevent="submit10(poll)">
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.user_id" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.id" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.title" />
                                                                    <input class="form-control" type="hidden"
                                                                        v-model="poll.option_10" />
                                                                    <button data-toggle="tooltip" data-placement="bottom"
                                                                        title="Vote" style="font-size: 13px;float:right;"
                                                                        type="submit"
                                                                        class="btn bg-gradient-primary btn-sm">
                                                                        Vote
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </label>
                                            </div>


                                            <h5> {{ poll.vote_count }} Votes</h5>

                                            <div class="mx-3 mt-3 mb-2">
                                                <button v-if="poll.user_id == id || id == 1" type="button"
                                                    @click="destroy(poll.id)" class="delete-btn"
                                                    style="float: left;border:none;outline:none;background: none;">
                                                    <i class="fa fa-trash-o" style="color: red;"></i>
                                                </button>

                                                <router-link style="float: right;" v-if="poll.user_id == id || id == 1" :to="{
                                                    name: 'EditPoll',
                                                    params: { slug: poll.slug },
                                                }"><i class="fa fa-edit" style="color: #189483;"></i>
                                                </router-link>
                                            </div>


                                        </div>
                                    </div>
                                    <h5 v-if="!polls.length">Sorry, no item found!</h5>
                                </div><!-- End .row -->

                                <br /><br />
                                <div v-if="lastPage > 1" class="pagination">
                                    <button class="btn bg-gradient-primary btn-sm" style="margin: 4px;"
                                        v-if="currentPage > 1" @click="pollTitle(currentPage - 1)">&laquo; Prev</button>

                                    <button class="btn bg-gradient-primary btn-sm" style="margin: 4px;"
                                        v-if="currentPage < lastPage" @click="pollTitle(currentPage + 1)">Next
                                        &raquo;</button>
                                </div>

                            </div><!-- End .product-details-top -->
                            <hr class="mt-3 mb-5">
                        </div><!-- End .container -->
                    </div>
                </div>
            </div>
        </div>
        <Footer />
    </body>
</template>

<script>
import Footer from './Footer.vue'

export default {

    components: {
        Footer
    },
    props: ["slug"],
    data() {
        return {
            //
            user: {},
            id: "",
            name: "",
            type: "",
            polls: [],
            connections: [],
            users: [],
            loading: true,
        };
    },

    created() {
        this.pollTitle(this.currentPage);
    },

    computed: {
        receiverId: {
            get() {
                return this.user.id;
            },
            set(value) {
                this.user.id = value;
            }
        },

        receiverSlug: {
            get() {
                return this.user.slug;
            },
            set(value) {
                this.user.slug = value;
            }
        },

        receiverName: {
            get() {
                return this.user.name;
            },
            set(value) {
                this.user.name = value;
            }
        },

        receiverImage: {
            get() {
                return this.user.profile_pic;
            },
            set(value) {
                this.user.profile_pic = value;
            }
        },
    },

    methods: {

        submit1(poll) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#189483',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Proceed to vote'
            }).then((result) => {

                // Send request to the server
                if (result.value) {
                    axios
                        .post("/api/votes", { "user_id": poll.user_id, "id": poll.id, "title": poll.title, "option": poll.option_1 }, {
                            headers: { "content-type": "multipart/form-data" },
                        })
                        .then(() => {
                            this.fields = {};
                            this.url = null;
                            this.fields.category_id = "";
                            this.success = true;
                            this.errors = {};

                            axios.get('/api/polls')
                                .then(response => {
                                    this.polls = response.data.data;
                                })
                                .catch(error => {
                                    console.log(error);
                                });

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '<strong> Voted</strong>',
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
                }
            })

        },

        submit2(poll) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#189483',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Proceed to vote'
            }).then((result) => {

                // Send request to the server
                if (result.value) {
                    axios
                        .post("/api/votes", { "user_id": poll.user_id, "id": poll.id, "title": poll.title, "option": poll.option_2 }, {
                            headers: { "content-type": "multipart/form-data" },
                        })
                        .then(() => {
                            this.fields = {};
                            this.url = null;
                            this.fields.category_id = "";
                            this.success = true;
                            this.errors = {};

                            axios.get('/api/polls')
                                .then(response => {
                                    this.polls = response.data.data;
                                })
                                .catch(error => {
                                    console.log(error);
                                });

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '<strong> Voted</strong>',
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
                }
            })

        },

        submit3(poll) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#189483',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Proceed to vote'
            }).then((result) => {

                // Send request to the server
                if (result.value) {
                    axios
                        .post("/api/votes", { "user_id": poll.user_id, "id": poll.id, "title": poll.title, "option": poll.option_3 }, {
                            headers: { "content-type": "multipart/form-data" },
                        })
                        .then(() => {
                            this.fields = {};
                            this.url = null;
                            this.fields.category_id = "";
                            this.success = true;
                            this.errors = {};

                            axios.get('/api/polls')
                                .then(response => {
                                    this.polls = response.data.data;
                                })
                                .catch(error => {
                                    console.log(error);
                                });

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '<strong> Voted</strong>',
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
                }
            })

        },

        submit4(poll) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#189483',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Proceed to vote'
            }).then((result) => {

                // Send request to the server
                if (result.value) {
                    axios
                        .post("/api/votes", { "user_id": poll.user_id, "id": poll.id, "title": poll.title, "option": poll.option_4 }, {
                            headers: { "content-type": "multipart/form-data" },
                        })
                        .then(() => {
                            this.fields = {};
                            this.url = null;
                            this.fields.category_id = "";
                            this.success = true;
                            this.errors = {};

                            axios.get('/api/polls')
                                .then(response => {
                                    this.polls = response.data.data;
                                })
                                .catch(error => {
                                    console.log(error);
                                });

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '<strong> Voted</strong>',
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
                }
            })

        },

        submit5(poll) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#189483',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Proceed to vote'
            }).then((result) => {

                // Send request to the server
                if (result.value) {
                    axios
                        .post("/api/votes", { "user_id": poll.user_id, "id": poll.id, "title": poll.title, "option": poll.option_5 }, {
                            headers: { "content-type": "multipart/form-data" },
                        })
                        .then(() => {
                            this.fields = {};
                            this.url = null;
                            this.fields.category_id = "";
                            this.success = true;
                            this.errors = {};

                            axios.get('/api/polls')
                                .then(response => {
                                    this.polls = response.data.data;
                                })
                                .catch(error => {
                                    console.log(error);
                                });

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '<strong> Voted</strong>',
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
                }
            })

        },

        submit6(poll) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#189483',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Proceed to vote'
            }).then((result) => {

                // Send request to the server
                if (result.value) {
                    axios
                        .post("/api/votes", { "user_id": poll.user_id, "id": poll.id, "title": poll.title, "option": poll.option_6 }, {
                            headers: { "content-type": "multipart/form-data" },
                        })
                        .then(() => {
                            this.fields = {};
                            this.url = null;
                            this.fields.category_id = "";
                            this.success = true;
                            this.errors = {};

                            axios.get('/api/polls')
                                .then(response => {
                                    this.polls = response.data.data;
                                })
                                .catch(error => {
                                    console.log(error);
                                });

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '<strong> Voted</strong>',
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
                }
            })

        },

        submit7(poll) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#189483',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Proceed to vote'
            }).then((result) => {

                // Send request to the server
                if (result.value) {
                    axios
                        .post("/api/votes", { "user_id": poll.user_id, "id": poll.id, "title": poll.title, "option": poll.option_7 }, {
                            headers: { "content-type": "multipart/form-data" },
                        })
                        .then(() => {
                            this.fields = {};
                            this.url = null;
                            this.fields.category_id = "";
                            this.success = true;
                            this.errors = {};

                            axios.get('/api/polls')
                                .then(response => {
                                    this.polls = response.data.data;
                                })
                                .catch(error => {
                                    console.log(error);
                                });

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '<strong> Voted</strong>',
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
                }
            })

        },

        submit8(poll) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#189483',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Proceed to vote'
            }).then((result) => {

                // Send request to the server
                if (result.value) {
                    axios
                        .post("/api/votes", { "user_id": poll.user_id, "id": poll.id, "title": poll.title, "option": poll.option_8 }, {
                            headers: { "content-type": "multipart/form-data" },
                        })
                        .then(() => {
                            this.fields = {};
                            this.url = null;
                            this.fields.category_id = "";
                            this.success = true;
                            this.errors = {};

                            axios.get('/api/polls')
                                .then(response => {
                                    this.polls = response.data.data;
                                })
                                .catch(error => {
                                    console.log(error);
                                });

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '<strong> Voted</strong>',
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
                }
            })

        },

        submit9(poll) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#189483',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Proceed to vote'
            }).then((result) => {

                // Send request to the server
                if (result.value) {
                    axios
                        .post("/api/votes", { "user_id": poll.user_id, "id": poll.id, "title": poll.title, "option": poll.option_9 }, {
                            headers: { "content-type": "multipart/form-data" },
                        })
                        .then(() => {
                            this.fields = {};
                            this.url = null;
                            this.fields.category_id = "";
                            this.success = true;
                            this.errors = {};

                            axios.get('/api/polls')
                                .then(response => {
                                    this.polls = response.data.data;
                                })
                                .catch(error => {
                                    console.log(error);
                                });

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '<strong> Voted</strong>',
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
                }
            })

        },

        submit10(poll) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#189483',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Proceed to vote'
            }).then((result) => {

                // Send request to the server
                if (result.value) {
                    axios
                        .post("/api/votes", { "user_id": poll.user_id, "id": poll.id, "title": poll.title, "option": poll.option_10 }, {
                            headers: { "content-type": "multipart/form-data" },
                        })
                        .then(() => {
                            this.fields = {};
                            this.url = null;
                            this.fields.category_id = "";
                            this.success = true;
                            this.errors = {};

                            axios.get('/api/polls')
                                .then(response => {
                                    this.polls = response.data.data;
                                })
                                .catch(error => {
                                    console.log(error);
                                });

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '<strong> Voted</strong>',
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
                }
            })

        },

        sendConnection() {

            const fd = new FormData();
            fd.append("receiver_id", this.receiverId);
            fd.append("receiver_slug", this.receiverSlug);
            fd.append("receiver_name", this.receiverName);
            fd.append("receiver_image", this.receiverImage);

            fd.append("_method", "POST");


            axios
                .post("/api/connects", fd, {
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
                    this.rentalIssue = '';
                    this.rentalComplaint = '';

                    axios
                        .get("/api/users/" + this.slug)
                        .then((response) => (this.user = response.data.data))
                        .catch((error) => {
                            console.log(error);
                        });

                    axios
                        .get("/api/connections")
                        .then((response) => (this.connections = response.data.data))
                        .catch((error) => {
                            console.log(error);
                        });


                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    this.success = false;
                });
        },

        pollTitle(page) {
            axios
                .get('/api/polls?page=' + page, {
                    params: {
                        search: this.title,
                    },
                })
                .then((response) => {
                    this.polls = response.data.data;
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
                .get("/api/polls", {
                    params: {
                        page: page,
                        search: this.title,
                    },
                })
                .then((response) => {
                    this.polls = response.data.data;
                    this.currentPage = response.data.current_page;
                    this.lastPage = response.data.last_page;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },

    mounted() {
        setTimeout(() => {
            this.loading = false;
        }, 2000);

        axios
            .get("/api/users/" + this.slug)
            .then((response) => (this.user = response.data.data))
            .catch((error) => {
                console.log(error);
            });

        axios
            .get("/api/users")
            .then((response) => {
                this.users = response.data.data;
            })
            .catch((error) => {
                console.log(error);
            });

        axios.get('/api/polls')
            .then(response => {
                this.polls = response.data.data;
            })
            .catch(error => {
                console.log(error);
            });

        axios
            .get("/api/connections")
            .then((response) => (this.connections = response.data.data))
            .catch((error) => {
                console.log(error);
            });

        axios
            .get("/api/user")
            .then(response => {
                this.id = response.data.id
                this.name = response.data.name
                this.type = response.data.type
            })
            .catch((error) => {
                if (error.response.status === 401) {
                    this.$emit("updateSidebar");
                    localStorage.removeItem("authenticated");
                }
            });
    },
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css?family=Quicksand:400,500,700&subset=latin-ext');

body {
    font-family: 'Quicksand', sans-serif;
    color: #324e63;
}

a,
a:hover {
    text-decoration: none;
}

.icon {
    display: inline-block;
    width: 1em;
    height: 1em;
    stroke-width: 0;
    stroke: currentColor;
    fill: currentColor;
}

.wrapperr {
    width: 100%;
    width: 100%;
    height: auto;
    min-height: 100vh;
    padding: 50px 20px;
    padding-top: 100px;
    display: flex;
    background-image: linear-gradient(-20deg, #ffff 0%, #fff 100%);
    display: flex;
    background-image: linear-gradient(-20deg, #ffff 0%, #fff 100%);
}

@media screen and (max-width: 768px) {
    .wrapperr {
        height: auto;
        min-height: 100vh;
        padding-top: 100px;
    }
}

.profile-card {
    width: 100%;
    min-height: 460px;
    margin: auto;
    box-shadow: 1px 1px 5px 1px rgba(0, 0, 0, 0.1);
    background: #fff;
    border-radius: 12px;
    max-width: 700px;
    position: relative;
}

.profile-card.active .profile-card__cnt {
    filter: blur(6px);
}

.profile-card.active .profile-card-message,
.profile-card.active .profile-card__overlay {
    opacity: 1;
    pointer-events: auto;
    transition-delay: 0.1s;
}

.profile-card.active .profile-card-form {
    transform: none;
    transition-delay: 0.1s;
}

.profile-card__img {
    width: 150px;
    height: 150px;
    margin-left: auto;
    margin-right: auto;
    transform: translateY(-50%);
    border-radius: 50%;
    overflow: hidden;
    position: relative;
    z-index: 4;
    box-shadow: 0px 0px 0px 3px #75D4C8;
}

@media screen and (max-width: 576px) {
    .profile-card__img {
        width: 120px;
        height: 120px;
    }
}

.profile-card__img img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.profile-card__cnt {
    margin-top: -35px;
    text-align: center;
    padding: 0 20px;
    padding-bottom: 40px;
    transition: all 0.3s;
}

.profile-card__name {
    font-weight: 700;
    font-size: 24px;
    color: #1CC0A0;
    margin-bottom: 15px;
}

.profile-card__txt {
    font-size: 18px;
    font-weight: 500;
    color: #324e63;
    margin-bottom: 15px;
}

.profile-card__txt strong {
    font-weight: 700;
}

.profile-card-loc {
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 18px;
    font-weight: 600;
}

.profile-card-loc__icon {
    display: inline-flex;
    font-size: 27px;
    margin-right: 10px;
}

.profile-card-inf {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    align-items: flex-start;
    margin-top: 35px;
}

.profile-card-inf__item {
    padding: 5px 18px;
    min-width: 100px;
}

@media screen and (max-width: 768px) {
    .profile-card-inf__item {
        padding: 5px 20px;
        min-width: 100px;
    }
}

.profile-card-inf__title {
    font-weight: 700;
    font-size: 27px;
    color: #324e63;
}

.profile-card-inf__txt {
    font-weight: 500;
    margin-top: 7px;
}

.profile-card-social {
    margin-top: 25px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
}

.profile-card-social__item {
    display: inline-flex;
    width: 55px;
    height: 55px;
    margin: 15px;
    border-radius: 50%;
    align-items: center;
    justify-content: center;
    color: #fff;
    background: #405de6;
    box-shadow: 0px 7px 30px rgba(43, 98, 169, 0.5);
    position: relative;
    font-size: 21px;
    flex-shrink: 0;
    transition: all 0.3s;
}

@media screen and (max-width: 768px) {
    .profile-card-social__item {
        width: 50px;
        height: 50px;
        margin: 10px;
    }
}

@media screen and (min-width: 768px) {
    .profile-card-social__item:hover {
        transform: scale(1.2);
    }
}

.profile-card-social__item.facebook {
    background: linear-gradient(45deg, #3b5998, #0078d7);
    box-shadow: 0px 4px 30px rgba(43, 98, 169, 0.5);
}

.profile-card-social__item.twitter {
    background: linear-gradient(45deg, #1da1f2, #0e71c8);
    box-shadow: 0px 4px 30px rgba(19, 127, 212, 0.7);
}

.profile-card-social__item.instagram {
    background: linear-gradient(45deg, #405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d);
    box-shadow: 0px 4px 30px rgba(120, 64, 190, 0.6);
}

.profile-card-social__item.behance {
    background: linear-gradient(45deg, #1769ff, #213fca);
    box-shadow: 0px 4px 30px rgba(27, 86, 231, 0.7);
}

.profile-card-social__item.github {
    background: linear-gradient(45deg, #333, #626b73);
    box-shadow: 0px 4px 30px rgba(63, 65, 67, 0.6);
}

.profile-card-social__item.codepen {
    background: linear-gradient(45deg, #324e63, #414447);
    box-shadow: 0px 4px 30px rgba(55, 75, 90, 0.6);
}

.profile-card-social__item.link {
    background: linear-gradient(45deg, #d5135a, #f05924);
    box-shadow: 0px 4px 30px rgba(223, 45, 70, 0.6);
}

.profile-card-social .icon-font {
    display: inline-flex;
}

.profile-card-ctr {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 40px;
}

@media screen and (max-width: 576px) {
    .profile-card-ctr {
        flex-wrap: wrap;
    }
}

.profile-card__button {
    background: none;
    border: none;
    font-family: 'Quicksand', sans-serif;
    font-weight: 700;
    font-size: 19px;
    margin: 15px 35px;
    padding: 15px 40px;
    min-width: 201px;
    border-radius: 50px;
    min-height: 55px;
    color: #fff;
    cursor: pointer;
    backface-visibility: hidden;
    transition: all 0.3s;
}

@media screen and (max-width: 768px) {
    .profile-card__button {
        min-width: 170px;
        margin: 15px 25px;
    }
}

@media screen and (max-width: 576px) {
    .profile-card__button {
        min-width: inherit;
        margin: 0;
        margin-bottom: 16px;
        width: 100%;
        max-width: 300px;
    }

    .profile-card__button:last-child {
        margin-bottom: 0;
    }
}

.profile-card__button:focus {
    outline: none !important;
}

@media screen and (min-width: 768px) {
    .profile-card__button:hover {
        transform: translateY(-5px);
    }
}

.profile-card__button:first-child {
    margin-left: 0;
}

.profile-card__button:last-child {
    margin-right: 0;
}

.profile-card__button.button--blue {
    background: linear-gradient(45deg, #1da1f2, #0e71c8);
    box-shadow: 0px 4px 30px rgba(19, 127, 212, 0.4);
}

.profile-card__button.button--blue:hover {
    box-shadow: 0px 7px 30px rgba(19, 127, 212, 0.75);
}

.profile-card__button.button--orange {
    background: linear-gradient(45deg, #d5135a, #f05924);
    box-shadow: 0px 4px 30px rgba(223, 45, 70, 0.35);
}

.profile-card__button.button--orange:hover {
    box-shadow: 0px 7px 30px rgba(223, 45, 70, 0.75);
}

.profile-card__button.button--gray {
    box-shadow: none;
    background: #dcdcdc;
    color: #142029;
}

.profile-card-message {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    padding-top: 130px;
    padding-bottom: 100px;
    opacity: 0;
    pointer-events: none;
    transition: all 0.3s;
}

.profile-card-form {
    box-shadow: 0 4px 30px rgba(15, 22, 56, 0.35);
    max-width: 80%;
    margin-left: auto;
    margin-right: auto;
    height: 100%;
    background: #fff;
    border-radius: 10px;
    padding: 35px;
    transform: scale(0.8);
    position: relative;
    z-index: 3;
    transition: all 0.3s;
}

@media screen and (max-width: 768px) {
    .profile-card-form {
        max-width: 90%;
        height: auto;
    }
}

@media screen and (max-width: 576px) {
    .profile-card-form {
        padding: 20px;
    }
}

.profile-card-form__bottom {
    justify-content: space-between;
    display: flex;
}

@media screen and (max-width: 576px) {
    .profile-card-form__bottom {
        flex-wrap: wrap;
    }
}

.profile-card textarea {
    width: 100%;
    resize: none;
    height: 210px;
    margin-bottom: 20px;
    border: 2px solid #dcdcdc;
    border-radius: 10px;
    padding: 15px 20px;
    color: #324e63;
    font-weight: 500;
    font-family: 'Quicksand', sans-serif;
    outline: none;
    transition: all 0.3s;
}

.profile-card textarea:focus {
    outline: none;
    border-color: #8a979e;
}

.profile-card__overlay {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    pointer-events: none;
    opacity: 0;
    background: rgba(22, 33, 72, 0.35);
    border-radius: 12px;
    transition: all 0.3s;
}

.option-wrapper {
    display: flex;
    align-items: center;
}

.option-image {
    flex: 0 0 auto;
    margin-right: 16px;
    width: 100px;
    height: 100px;
    object-fit: cover;
    background-color: white;
    border-radius: 50%;
    overflow: hidden;
}

.option-content {
    flex: 1 1 auto;
    display: flex;
    flex-direction: column;
}

.wrapper {
    padding: 30px;
    background: #fff;
    width: 100%;
    box-shadow: 1px 1px 5px 1px rgba(0, 0, 0, 0.1);
}

.wrapper header {
    font-size: 22px;
    font-weight: 600;
}

.wrapper .poll-area {
    margin: 20px 0 15px 0;
}

.poll-area label {
    display: block;
    margin-bottom: 10px;
    padding: 8px 15px;
    border: 2px solid #e6e6e6;
    transition: all 0.2s ease;
    border-radius: 10px;
}

label.opt-1.selected {
    border: 2px solid #cf2d00;
}

label.opt-2.selected {
    border: 2px solid #4bcc00;
}

label.opt-3.selected {
    border: 2px solid #cfbd00;
}

label.opt-4.selected {
    border: 2px solid #01638c;
}

label.opt-5.selected {
    border: 2px solid #0f018c;
}

label.opt-6.selected {
    border: 2px solid #42018c;
}

label.opt-7.selected {
    border: 2px solid #8c0165;
}

label.opt-8.selected {
    border: 2px solid #000000;
}

label.opt-9.selected {
    border: 2px solid #996633;
}

label.opt-10.selected {
    border: 2px solid #006600;
}

div#pstyle1::after {
    background: #cf2d00 !important;
}

div#pstyle2::after {
    background: #4bcc00 !important;
}

div#pstyle3::after {
    background: #cfbd00 !important;
}

div#pstyle4::after {
    background: #01638c !important;
}

div#pstyle5::after {
    background: #0f018c !important;
}

div#pstyle6::after {
    background: #42018c !important;
}

div#pstyle7::after {
    background: #8c0165 !important;
}

div#pstyle8::after {
    background: #000000 !important;
}

div#pstyle9::after {
    background: #996633 !important;
}

div#pstyle10::after {
    background: #006600 !important;
}

label.opt-1.selected .row .circle {
    border-color: #cf2d00 !important;
}

label.opt-2.selected .row .circle {
    border-color: #4bcc00 !important;
}

label.opt-3.selected .row .circle {
    border-color: #cfbd00 !important;
}

label.opt-4.selected .row .circle {
    border-color: #01638c !important;
}

label.opt-5.selected .row .circle {
    border-color: #0f018c !important;
}

label.opt-6.selected .row .circle {
    border-color: #42018c !important;
}

label.opt-7.selected .row .circle {
    border-color: #8c0165 !important;
}

label.opt-8.selected .row .circle {
    border-color: #000000 !important;
}

label.opt-9.selected .row .circle {
    border-color: #996633 !important;
}

label.opt-10.selected .row .circle {
    border-color: #006600 !important;
}

label.opt-1 .row .circle::after {
    background: #cf2d00 !important;
}

label.opt-2 .row .circle::after {
    background: #4bcc00 !important;
}

label.opt-3 .row .circle::after {
    background: #cfbd00 !important;
}

label.opt-4 .row .circle::after {
    background: #01638c !important;
}

label.opt-5 .row .circle::after {
    background: #0f018c !important;
}

label.opt-6 .row .circle::after {
    background: #42018c !important;
}

label.opt-7 .row .circle::after {
    background: #8c0165 !important;
}

label.opt-8 .row .circle::after {
    background: #000000 !important;
}

label.opt-9 .row .circle::after {
    background: #996633 !important;
}

label.opt-10 .row .circle::after {
    background: #006600 !important;
}

label .row {
    display: flex;
    pointer-events: none;
    justify-content: space-between;
}

label .row .column {
    display: flex;
    align-items: center;
}

label .row .circle {
    height: 19px;
    width: 19px;
    display: block;
    border: 2px solid #ccc;
    border-radius: 50%;
    margin-right: 10px;
    position: relative;
}

label .row .circle::after {
    content: "";
    height: 11px;
    width: 11px;
    border-radius: inherit;
    position: absolute;
    left: 2px;
    top: 2px;
    display: none;
}

.poll-area label:hover .row .circle::after {
    display: block;
    background: #e6e6e6;
}

label.selected .row .circle::after {
    display: block;
}

label .row span {
    font-size: 16px;
    font-weight: 500;
}

label .row .percent {
    display: show;
}

label .progress {
    height: 7px;
    width: 100%;
    position: relative;
    background: #f0f0f0;
    margin: 8px 0 3px 0;
    border-radius: 30px;
    pointer-events: none;
}

label .progress:after {
    position: absolute;
    content: "";
    height: 100%;
    background: #ccc;
    width: calc(1% * var(--w));
    border-radius: inherit;
    transition: all 0.2s ease;
}

label.selectall .progress,
label.selectall .row .percent {
    display: block;
}

input[type="radio"],
input[type="checkbox"] {
    display: none;
}
</style>