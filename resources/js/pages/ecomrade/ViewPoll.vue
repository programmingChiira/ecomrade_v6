<template>
    <body class="index-page">
        <section class="my-5 py-5">
            <div class="container">

                <div class="row">
                    <div class="row">
                        <div class="col-md-4 col-9">
                            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                                <div class="container">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                                        <li class="breadcrumb-item"><router-link to="/poll">Poll</router-link></li>
                                        <li style="color: #189483;" class="breadcrumb-item"><strong>View</strong></li>
                                    </ol>
                                </div>
                            </nav>
                        </div>

                    </div>
                </div>

                <div class="row align-items-center">
                    <div class="page-content">
                        <div class="container">
                            <div class="product-details-top">
                                <div class="row">

                                    <div style="margin: 10px;" class="col-md-12">
                                        <div style="background-color: #E9ECEF;" class="wrapper">
                                            <div v-if="poll.voter_id_count >= 1">
                                                <button data-toggle="tooltip" data-placement="bottom"
                                                    title="You have already voted" style="font-size: 13px;float:right;"
                                                    type="submit" class="btn btn-success btn-sm">
                                                    Voted
                                                </button>
                                            </div>
                                            <h4>
                                                <h5>
                                                    {{ poll.title }}
                                                </h5>
                                            </h4>
                                            <header> {{ poll.argument }} <br></header>
                                            <div
                                                v-if="poll.option_1 == false || poll.option_1 == null || poll.option_1 == 'null' || poll.option_1 == '' || poll.option_1 == ' ' || poll.option_1 == NULL || poll.option_1 == 'undefined'">
                                            </div>
                                            <div class="poll-area" v-else>
                                                <label style="background-color: white;" for="opt-1" class="opt-1">
                                                    <div class="option-wrapper">
                                                        <button style="background: none;border:none;" data-toggle="tooltip"
                                                            data-placement="bottom" title="View file"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                            <span
                                                                v-if="poll.image_1 == false || poll.image_1 == null || poll.image_1 == 'null' || poll.image_1 == '' || poll.image_1 == ' ' || poll.image_1 == NULL || poll.image_1 == 'undefined'"></span>
                                                            <img v-else class="option-image"
                                                                :src="'./img/poll/' + poll.image_1" alt="Option Image">
                                                        </button>


                                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
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
                                                <label style="background-color: white;" for="opt-1" class="opt-1">
                                                    <div class="option-wrapper">
                                                        <button style="background: none;border:none;" data-toggle="tooltip"
                                                            data-placement="bottom" title="View file"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                                            <span
                                                                v-if="poll.image_2 == false || poll.image_2 == null || poll.image_2 == 'null' || poll.image_2 == '' || poll.image_2 == ' ' || poll.image_2 == NULL || poll.image_2 == 'undefined'"></span>
                                                            <img v-else class="option-image"
                                                                :src="'./img/poll/' + poll.image_2" alt="Option Image">
                                                        </button>

                                                        <div class="modal fade" id="exampleModal2" tabindex="-1"
                                                            aria-labelledby="exampleModal2Label" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModal2Label">
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
                                                            data-placement="bottom" title="View file"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModal3">
                                                            <span
                                                                v-if="poll.image_3 == false || poll.image_3 == null || poll.image_3 == 'null' || poll.image_3 == '' || poll.image_3 == ' ' || poll.image_3 == NULL || poll.image_3 == 'undefined'"></span>
                                                            <img v-else class="option-image"
                                                                :src="'./img/poll/' + poll.image_3" alt="Option Image">
                                                        </button>

                                                        <div class="modal fade" id="exampleModal3" tabindex="-1"
                                                            aria-labelledby="exampleModal3Label" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModal3Label">
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
                                                            data-placement="bottom" title="View file"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModal4">
                                                            <span
                                                                v-if="poll.image_4 == false || poll.image_4 == null || poll.image_4 == 'null' || poll.image_4 == '' || poll.image_4 == ' ' || poll.image_4 == NULL || poll.image_4 == 'undefined'"></span>
                                                            <img v-else class="option-image"
                                                                :src="'./img/poll/' + poll.image_4" alt="Option Image">
                                                        </button>

                                                        <div class="modal fade" id="exampleModal4" tabindex="-1"
                                                            aria-labelledby="exampleModal4Label" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModal4Label">
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
                                                            data-placement="bottom" title="View file"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModal5">
                                                            <span
                                                                v-if="poll.image_5 == false || poll.image_5 == null || poll.image_5 == 'null' || poll.image_5 == '' || poll.image_5 == ' ' || poll.image_5 == NULL || poll.image_5 == 'undefined'"></span>
                                                            <img v-else class="option-image"
                                                                :src="'./img/poll/' + poll.image_5" alt="Option Image">
                                                        </button>

                                                        <div class="modal fade" id="exampleModal5" tabindex="-1"
                                                            aria-labelledby="exampleModal5Label" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModal5Label">
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
                                                            data-placement="bottom" title="View file"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModal6">
                                                            <span
                                                                v-if="poll.image_6 == false || poll.image_6 == null || poll.image_6 == 'null' || poll.image_6 == '' || poll.image_6 == ' ' || poll.image_6 == NULL || poll.image_6 == 'undefined'"></span>
                                                            <img v-else class="option-image"
                                                                :src="'./img/poll/' + poll.image_6" alt="Option Image">
                                                        </button>

                                                        <div class="modal fade" id="exampleModal6" tabindex="-1"
                                                            aria-labelledby="exampleModal6Label" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModal6Label">
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
                                                            data-placement="bottom" title="View file"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModal7">
                                                            <span
                                                                v-if="poll.image_7 == false || poll.image_7 == null || poll.image_7 == 'null' || poll.image_7 == '' || poll.image_7 == ' ' || poll.image_7 == NULL || poll.image_7 == 'undefined'"></span>
                                                            <img v-else class="option-image"
                                                                :src="'./img/poll/' + poll.image_7" alt="Option Image">
                                                        </button>

                                                        <div class="modal fade" id="exampleModal7" tabindex="-1"
                                                            aria-labelledby="exampleModal7Label" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModal7Label">
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
                                                            data-placement="bottom" title="View file"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModal8">
                                                            <span
                                                                v-if="poll.image_8 == false || poll.image_8 == null || poll.image_8 == 'null' || poll.image_8 == '' || poll.image_8 == ' ' || poll.image_8 == NULL || poll.image_8 == 'undefined'"></span>
                                                            <img v-else class="option-image"
                                                                :src="'./img/poll/' + poll.image_8" alt="Option Image">
                                                        </button>

                                                        <div class="modal fade" id="exampleModal8" tabindex="-1"
                                                            aria-labelledby="exampleModal8Label" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModal8Label">
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
                                                            data-placement="bottom" title="View file"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModal9">
                                                            <span
                                                                v-if="poll.image_9 == false || poll.image_9 == null || poll.image_9 == 'null' || poll.image_9 == '' || poll.image_9 == ' ' || poll.image_9 == NULL || poll.image_9 == 'undefined'"></span>
                                                            <img v-else class="option-image"
                                                                :src="'./img/poll/' + poll.image_9" alt="Option Image">
                                                        </button>

                                                        <div class="modal fade" id="exampleModal9" tabindex="-1"
                                                            aria-labelledby="exampleModal9Label" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModal9Label">
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
                                                            data-placement="bottom" title="View file"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModal10">
                                                            <span
                                                                v-if="poll.image_10 == false || poll.image_10 == null || poll.image_10 == 'null' || poll.image_10 == '' || poll.image_10 == ' ' || poll.image_10 == NULL || poll.image_10 == 'undefined'"></span>
                                                            <img v-else class="option-image"
                                                                :src="'./img/poll/' + poll.image_10" alt="Option Image">
                                                        </button>

                                                        <div class="modal fade" id="exampleModal10" tabindex="-1"
                                                            aria-labelledby="exampleModal10Label" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModal10Label">
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

                                                <router-link style="float: right;" v-if="poll.user_id == id" :to="{
                                                    name: 'EditPoll',
                                                    params: { slug: poll.slug },
                                                }"><i class="fa fa-edit" style="color: #189483;"></i>
                                                </router-link>
                                            </div>


                                        </div>
                                    </div>

                                </div><!-- End .row -->

                            </div><!-- End .product-details-top -->
                            <hr class="mt-3 mb-5">
                        </div><!-- End .container -->
                    </div>
                </div>
            </div>
            <hr class="horizontal dark my-5">
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
            poll: {},
            pollreviews: {},
            id: "",
            name: "",
        };
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

                            axios.get(`/api/polls/${this.$route.params.slug}`)
                                .then(response => {
                                    console.log(JSON.stringify(response));
                                    this.poll = response.data.data;
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

                            axios.get(`/api/polls/${this.$route.params.slug}`)
                                .then(response => {
                                    console.log(JSON.stringify(response));
                                    this.poll = response.data.data;
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

                            axios.get(`/api/polls/${this.$route.params.slug}`)
                                .then(response => {
                                    console.log(JSON.stringify(response));
                                    this.poll = response.data.data;
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

                            axios.get(`/api/polls/${this.$route.params.slug}`)
                                .then(response => {
                                    console.log(JSON.stringify(response));
                                    this.poll = response.data.data;
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

                            axios.get(`/api/polls/${this.$route.params.slug}`)
                                .then(response => {
                                    console.log(JSON.stringify(response));
                                    this.poll = response.data.data;
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

                            axios.get(`/api/polls/${this.$route.params.slug}`)
                                .then(response => {
                                    console.log(JSON.stringify(response));
                                    this.poll = response.data.data;
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

                            axios.get(`/api/polls/${this.$route.params.slug}`)
                                .then(response => {
                                    console.log(JSON.stringify(response));
                                    this.poll = response.data.data;
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

                            axios.get(`/api/polls/${this.$route.params.slug}`)
                                .then(response => {
                                    console.log(JSON.stringify(response));
                                    this.poll = response.data.data;
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

                            axios.get(`/api/polls/${this.$route.params.slug}`)
                                .then(response => {
                                    console.log(JSON.stringify(response));
                                    this.poll = response.data.data;
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

                            axios.get(`/api/polls/${this.$route.params.slug}`)
                                .then(response => {
                                    console.log(JSON.stringify(response));
                                    this.poll = response.data.data;
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
                        .delete("/api/polls/" + id)
                        .then((response) => {
                            Swal.fire(
                                'Deleted!',
                                'Information has been successfully deleted.',
                                'success'
                            );
                            // Fire.$emit('AfterCreate');
                            axios.get('/api/polls').then(response => {
                                this.polls = response.data.data;
                            });
                        }).catch((error) => {
                            Swal.fire("Failed!", error.message, "warning");
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
                }
            });

        axios.get(`/api/polls/${this.$route.params.slug}`)
            .then(response => {
                console.log(JSON.stringify(response));
                this.poll = response.data.data;
            });

    },
};
</script>

<style>
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