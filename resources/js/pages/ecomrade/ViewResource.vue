<template>
    <body class="index-page">
        <section class="my-5 py-5">
            <div class="container py-4">
                <div class="row text-center">
                    <div class="col-lg-8 mx-auto"><a class="category-link mb-3 d-inline-block" href="#!">Inspire</a>
                        <h3>{{ resource.title }}</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-10">
                        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                            <div class="container">
                                <ol class="breadcrumb">
                                    <div class="badges text-right">
                                        <span style="margin: 3px;" class="badge bg-dark ">
                                            <i class="fa fa-comments-o"></i> {{ commentCount }}
                                        </span>
                                    </div>
                                </ol>
                            </div>
                        </nav>
                    </div>
                    <div style="float:right;" class="col-md-8 col-2">
                        <router-link v-if="id == true" to="/createresource" style="float: right;" class="text-info icon-move-right">
                            <button type="button" class="btn bg-gradient-primary btn-sm">
                                <i class="fa fa-plus"></i>
                            </button>
                        </router-link>

                        <router-link v-else-if="id == false" to="/login" style="float: right;" class="text-info icon-move-right">
                            <button type="button" class="btn bg-gradient-primary btn-sm">
                                <i class="fa fa-plus"></i>
                            </button>
                        </router-link>
                    </div>
                </div>

                <div class="row gallery">

                    <span
                        v-if="resource.resource_1 == false || resource.resource_1 == null || resource.resource_1 == 'null' || resource.resource_1 == '' || resource.resource_1 == ' ' || resource.resource_1 == NULL || resource.resource_1 == 'undefined'">

                    </span>
                    <div v-else class="col-lg-3 col-md-4 col-6 thumb">

                        <button style="border:none;outline:none;background: none;width: 100%;" data-toggle="tooltip"
                            data-placement="bottom" title="View resourse" data-bs-toggle="modal"
                            data-bs-target="#exampleModal1">
                            <img loading="lazy" style="width: 100%;object-fit: contain;" class="img-fluid img-thumbnail"
                                src="/img/file.jpg" alt="Random Image">
                            {{ resource.resource_1 }}
                        </button>
                        <br /><br />

                        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModal1Label"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 style="text-decoration: underline;" class="modal-title" id="exampleModal1Label">
                                            {{ resource.resource_1 }}
                                        </h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <p style="text-align: center;">Click to interact with the resource:</p>

                                    <div class="card-body card-p">
                                        <div style="padding: 10px;" class="d-flex flex-row justify-content-between">
                                            <div class="d-flex flex-column">
                                                <div class="col col-xs-6">
                                                    <a v-if="id == true" :href="'./img/resource/' + resource.resource_1" target="_blank"
                                                        class="btn bg-gradient-primary btn-sm">
                                                        Preview
                                                    </a>

                                                    <router-link v-else-if="id == false" to="/login">
                                                        <button class="btn bg-gradient-primary btn-sm" data-bs-dismiss="modal">
                                                            Preview
                                                        </button>
                                                    </router-link>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="col col-xs-6">
                                                    <a v-if="id == true" :href="'./img/resource/' + resource.resource_1" download="resource_1"
                                                        class="btn bg-gradient-primary btn-sm">
                                                        Download
                                                    </a>

                                                    <router-link v-else-if="id == false" to="/login">
                                                        <button class="btn bg-gradient-primary btn-sm" data-bs-dismiss="modal">
                                                            Download
                                                        </button>
                                                    </router-link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn bg-gradient-dark btn-sm" data-bs-dismiss="modal">
                                            Close
                                        </button>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <span
                        v-if="resource.resource_2 == false || resource.resource_2 == null || resource.resource_2 == 'null' || resource.resource_2 == '' || resource.resource_2 == ' ' || resource.resource_2 == NULL || resource.resource_2 == 'undefined'">

                    </span>
                    <div v-else class="col-lg-3 col-md-4 col-6 thumb">

                        <button style="border:none;outline:none;background: none;width: 100%;" data-toggle="tooltip"
                            data-placement="bottom" title="View resourse" data-bs-toggle="modal"
                            data-bs-target="#exampleModal2">
                            <img loading="lazy" style="width: 100%;object-fit: contain;" class="img-fluid img-thumbnail"
                                src="/img/file.jpg" alt="Random Image">
                            {{ resource.resource_2 }}
                        </button>
                        <br /><br />

                        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal2Label"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 style="text-decoration: underline;" class="modal-title" id="exampleModal1Label">
                                            {{ resource.resource_2 }}
                                        </h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <p style="text-align: center;">Click to interact with the resource:</p>

                                    <div class="card-body card-p">
                                        <div style="padding: 10px;" class="d-flex flex-row justify-content-between">
                                            <div class="d-flex flex-column">
                                                <div class="col col-xs-6">
                                                    <a :href="'./img/resource/' + resource.resource_2" target="_blank"
                                                        class="btn bg-gradient-primary btn-sm">
                                                        Preview
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="col col-xs-6">
                                                    <a :href="'./img/resource/' + resource.resource_2" download="resource_2"
                                                        class="btn bg-gradient-primary btn-sm">
                                                        Download
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn bg-gradient-dark btn-sm" data-bs-dismiss="modal">
                                            Close
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <span
                        v-if="resource.resource_3 == false || resource.resource_3 == null || resource.resource_3 == 'null' || resource.resource_3 == '' || resource.resource_3 == ' ' || resource.resource_3 == NULL || resource.resource_3 == 'undefined'">

                    </span>
                    <div v-else class="col-lg-3 col-md-4 col-6 thumb">

                        <button style="border:none;outline:none;background: none;width: 100%;" data-toggle="tooltip"
                            data-placement="bottom" title="View resourse" data-bs-toggle="modal"
                            data-bs-target="#exampleModal3">
                            <img loading="lazy" style="width: 100%;object-fit: contain;" class="img-fluid img-thumbnail"
                                src="/img/file.jpg" alt="Random Image">
                            {{ resource.resource_3 }}
                        </button>
                        <br /><br />

                        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModal3Label"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 style="text-decoration: underline;" class="modal-title" id="exampleModal1Label">
                                            {{ resource.resource_3 }}
                                        </h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <p style="text-align: center;">Click to interact with the resource:</p>

                                    <div class="card-body card-p">
                                        <div style="padding: 10px;" class="d-flex flex-row justify-content-between">
                                            <div class="d-flex flex-column">
                                                <div class="col col-xs-6">
                                                    <a :href="'./img/resource/' + resource.resource_3" target="_blank"
                                                        class="btn bg-gradient-primary btn-sm">
                                                        Preview
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="col col-xs-6">
                                                    <a :href="'./img/resource/' + resource.resource_3" download="resource_3"
                                                        class="btn bg-gradient-primary btn-sm">
                                                        Download
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn bg-gradient-dark btn-sm" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <span
                        v-if="resource.resource_4 == false || resource.resource_4 == null || resource.resource_4 == 'null' || resource.resource_4 == '' || resource.resource_4 == ' ' || resource.resource_4 == NULL || resource.resource_4 == 'undefined'">

                    </span>
                    <div v-else class="col-lg-3 col-md-4 col-6 thumb">

                        <button style="border:none;outline:none;background: none;width: 100%;" data-toggle="tooltip"
                            data-placement="bottom" title="View resourse" data-bs-toggle="modal"
                            data-bs-target="#exampleModal4">
                            <img loading="lazy" style="width: 100%;object-fit: contain;" class="img-fluid img-thumbnail"
                                src="/img/file.jpg" alt="Random Image">
                            {{ resource.resource_4 }}
                        </button>
                        <br /><br />

                        <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModal4Label"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 style="text-decoration: underline;" class="modal-title" id="exampleModal1Label">
                                            {{ resource.resource_4 }}
                                        </h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <p style="text-align: center;">Click to interact with the resource:</p>

                                    <div class="card-body card-p">
                                        <div style="padding: 10px;" class="d-flex flex-row justify-content-between">
                                            <div class="d-flex flex-column">
                                                <div class="col col-xs-6">
                                                    <a :href="'./img/resource/' + resource.resource_4" target="_blank"
                                                        class="btn bg-gradient-primary btn-sm">
                                                        Preview
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="col col-xs-6">
                                                    <a :href="'./img/resource/' + resource.resource_4" download="resource_4"
                                                        class="btn bg-gradient-primary btn-sm">
                                                        Download
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn bg-gradient-dark btn-sm" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <span
                    v-if="resource.resource_5 == false || resource.resource_5 == null || resource.resource_5 == 'null' || resource.resource_5 == '' || resource.resource_5 == ' ' || resource.resource_5 == NULL || resource.resource_5 == 'undefined'">

                </span>
                <div v-else class="col-lg-3 col-md-4 col-6 thumb">

                    <button style="border:none;outline:none;background: none;width: 100%;" data-toggle="tooltip"
                        data-placement="bottom" title="View resourse" data-bs-toggle="modal" data-bs-target="#exampleModal5">
                        <img loading="lazy" style="width: 100%;object-fit: contain;" class="img-fluid img-thumbnail"
                            src="/img/file.jpg" alt="Random Image">
                        {{ resource.resource_5 }}
                    </button>
                    <br /><br />

                    <div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModal5Label"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 style="text-decoration: underline;" class="modal-title" id="exampleModal1Label">
                                        {{ resource.resource_5 }}
                                    </h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <p style="text-align: center;">Click to interact with the resource:</p>

                                <div class="card-body card-p">
                                    <div style="padding: 10px;" class="d-flex flex-row justify-content-between">
                                        <div class="d-flex flex-column">
                                            <div class="col col-xs-6">
                                                <a :href="'./img/resource/' + resource.resource_5" target="_blank"
                                                    class="btn bg-gradient-primary btn-sm">
                                                    Preview
                                                </a>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <div class="col col-xs-6">
                                                <a :href="'./img/resource/' + resource.resource_5" download="resource_5"
                                                    class="btn bg-gradient-primary btn-sm">
                                                    Download
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn bg-gradient-dark btn-sm" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="horizontal dark my-5">

                <div class="row gy-5">
                    <div class="col-lg-12">
                        <h4 style="text-decoration: underline;">{{ resource.title }}</h4>
                        <p class="lead drop-caps mb-3">{{
                            resource.body
                        }}</p>

                        <div class="row">
                            <div class="col-lg-6 mb-4"><a class="glightbox product-view" href="#" data-gallery="gallery"
                                    data-glightbox="Image one"></a></div>
                        </div>


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

                        <div class="rating-stars"> Rate This Learning resource : <br />
                            <span class="pointer" style="font-size: 25px;" v-for="star in stars" :key="star"
                                @click="setRating(star)" :class="{ 'selected': star <= rating }">
                                &#9733;
                            </span>
                        </div>
                        <form @submit.prevent="submit" class="mb-5">
                            <div class="row gy-3">
                                <input class="form-control" type="hidden" v-model="ratingValue" />

                                <input class="form-control" type="hidden" v-model="senderName" />

                                <input class="form-control" type="hidden" v-model="senderId" />

                                <input class="form-control" type="hidden" v-model="userId" />

                                <input class="form-control" type="hidden" v-model="resourceId" />

                                <input class="form-control" type="hidden" v-model="resourceTitle" />

                                <input class="form-control" type="hidden" v-model="resourceCat" />
                                <div class="col-lg-12">
                                    <textarea name="message" v-model="comment" class="form-control" id="message" rows="6"
                                        placeholder="Comment Here ...."></textarea>
                                </div>
                                <div class="col-lg-12">
                                    <button class="btn btn-primary" type="submit">Send</button>
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
                            <li v-for="(review, index) in resourcereviews" :key="review.id">
                                <div class="d-flex mb-4" v-if="review.resourceId == resource.id">
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
                                            <button v-if="review.senderId == id" type="button" @click="destroy(review.id)"
                                                class="delete-btn"
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
            resource: {},
            resources: {},
            relatedPosts: [],

            reviewCount: 0,
            rating: 0,
            resourcereviews: {},
            id: "",
            name: "",
            avgRating: 0,
            commentCount: 0,
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
                return this.resource.user_id;
            },
            set(value) {
                this.resource.user_id = value;
            }
        },

        resourceId: {
            get() {
                return this.resource.id;
            },
            set(value) {
                this.resource.id = value;
            }
        },

        resourceSlug: {
            get() {
                return this.resource.slug;
            },
            set(value) {
                this.resource.slug = value;
            }
        },

        resourceTitle: {
            get() {
                return this.resource.title;
            },
            set(value) {
                this.resource.title = value;
            }
        },

        resourceCat: {
            get() {
                return this.resource.resource_category;
            },
            set(value) {
                this.resource.resource_category = value;
            }
        },
    },

    methods: {

        isImage(filename) {
            const extension = filename.split('.').pop().toLowerCase();
            return ['jpg', 'jpeg', 'png', 'gif'].includes(extension);
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
            fd.append("resourceId", this.resourceId);
            fd.append("resourceTitle", this.resourceTitle);
            fd.append("comment", this.comment);

            fd.append("_method", "POST");


            axios
                .post("/api/resourcereviews", fd, {
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

                    axios.get('/api/resourcereviews')
                        .then(response => {
                            this.resourcereviews = response.data.data;
                        });

                    axios.get(`/api/resources/${this.$route.params.slug}`)
                        .then(response => {
                            console.log(JSON.stringify(response));
                            this.resource = response.data.data;
                            this.avgRating = response.data.avg_rate;
                            this.commentCount = response.data.comment_count;
                            this.resourceTitleCount = response.data.resourceTitle_count;
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
            fd.append("id", this.resourceId);
            fd.append("product_name", this.resourceTitle);
            fd.append("product_category", this.resourceCat);
            fd.append("resource_1", this.resourceImage);
            fd.append("slug", this.resourceSlug);
            fd.append("contact", this.resourceContact);
            fd.append("product_price", this.resourcePrice);
            fd.append("product_discount", this.resourceDiscount);

            fd.append("resource_issue", this.resource_issue);
            fd.append("resource_complaint", this.resource_complaint);

            fd.append("_method", "POST");


            axios
                .resource("/api/reports", fd, {
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
                    this.resourceIssue = '';
                    this.resourceComplaint = '';
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
                        .delete("/api/resourcereviews/" + id)
                        .then((response) => {
                            Swal.fire(
                                'Deleted!',
                                'Information has been successfully deleted.',
                                'success'
                            );
                            // Fire.$emit('AfterCreate');
                            axios.get("/api/resourcereviews").then(({
                                data
                            }) => (this.resourcereviews = data.data))
                        }).catch((error) => {
                            Swal.fire("Failed!", error.message, "warning");
                        });

                    axios.get(`/api/resources/${this.$route.params.slug}`)
                        .then(response => {
                            console.log(JSON.stringify(response));
                            this.resource = response.data.data;
                            this.avgRating = response.data.avg_rate;
                            this.commentCount = response.data.comment_count;
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

        axios
            .get("/api/resources/" + this.slug)
            .then(response => {
                console.log(JSON.stringify(response));
                this.resource = response.data.data;
                this.avgRating = response.data.avg_rate;
                this.commentCount = response.data.comment_count;
            })
            .catch((error) => {
                console.log(error);
            });

        axios.get("/api/resources").then(({
            data
        }) => (this.resources = data.data));

        // axios.get(`/api/resources/${this.$route.params.slug}`)
        //       .then(response => {
        //           console.log(JSON.stringify(response));
        //           this.resource = response.data.data;
        //           this.avgRating = response.data.avg_rate;
        //           this.commentCount = response.data.comment_count;
        //       });

        axios.get('/api/resourcereviews')
            .then(response => {
                this.resourcereviews = response.data.data;
            });
    },
};
</script>

<style>
/* Only for demo purposes. */
/* Start Gallery CSS */

.thumb figure img {
    -webkit-filter: grayscale(100%);
    filter: grayscale(100%);
    -webkit-transition: .3s ease-in-out;
    transition: .3s ease-in-out;
}

.thumb figure:hover img {
    -webkit-filter: grayscale(0);
    filter: grayscale(0);
}



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