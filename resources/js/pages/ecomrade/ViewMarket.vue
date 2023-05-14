<template>
    <body class="index-page">
        <div class="full-page-loader" v-if="loading">
            <img src="/triangle.svg" alt="Loader" />
        </div>
        <section class="my-5 py-5">
            <div class="container mt-5 mb-5">

                <div class="row">
                    <div class="col-md-4 col-10">
                        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                            <div class="container">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                                    <li class="breadcrumb-item"><router-link to="/market">Market</router-link></li>
                                    <li style="color: #189483;" class="breadcrumb-item"><strong>View</strong></li>
                                </ol>
                            </div>
                        </nav>
                    </div>
                    <div style="float:right;" class="col-md-8 col-2">
                        <router-link v-if="id == false" to="/login" style="float: right;" class="text-info icon-move-right">
                            <button data-toggle="tooltip" data-placement="bottom" title="Sell my products / services"
                                type="button" class="btn bg-gradient-primary btn-sm">
                                <i class="fa fa-plus"></i>
                            </button>
                        </router-link>

                        <router-link v-else to="/createmarket" style="float: right;" class="text-info icon-move-right">
                            <button data-toggle="tooltip" data-placement="bottom" title="Sell my products / services"
                                type="button" class="btn bg-gradient-primary btn-sm">
                                <i class="fa fa-plus"></i>
                            </button>
                        </router-link>
                    </div>
                </div>


                <div class="row d-flex justify-content-center">
                    <div class="col-md-10">
                        <div style="background-color: #E9ECEF;" class="card">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="images p-3">
                                        <div>

                                            <img v-if="market.image_1 == false || market.image_1 == null || market.image_1 == 'null' || market.image_1 == '' || market.image_1 == ' ' || market.image_1 == NULL || market.image_1 == 'undefined'"
                                                loading="lazy" style="width: 100%;height: 450px; object-fit: contain;"
                                                id="main-image" src="/web/img/no_img.jpg" class="card-img-top" width="380">

                                            <img v-else style="width: 100%;height: 450px; object-fit: contain;"
                                                id="main-image" :src="'./img/market/' + market.image_1" class="card-img-top"
                                                width="380" @click="activateImageView">

                                        </div>
                                        <div class="thumbnail text-center">
                                            <span
                                                v-if="market.image_1 == false || market.image_1 == null || market.image_1 == 'null' || market.image_1 == '' || market.image_1 == ' ' || market.image_1 == NULL || market.image_1 == 'undefined'">

                                            </span>
                                            <span v-else>
                                                <a>
                                                    <img style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                                                        :src="'./img/market/' + market.image_1" onclick="change_image(this)"
                                                        class="card-img-top" width="70">
                                                </a>
                                            </span>

                                            <span
                                                v-if="market.image_2 == false || market.image_2 == null || market.image_2 == 'null' || market.image_2 == '' || market.image_2 == ' ' || market.image_2 == NULL || market.image_2 == 'undefined'">

                                            </span>
                                            <span v-else>
                                                <a>
                                                    <img style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                                                        :src="'./img/market/' + market.image_2" onclick="change_image(this)"
                                                        class="card-img-top" width="70">
                                                </a>
                                            </span>

                                            <span
                                                v-if="market.image_3 == false || market.image_3 == null || market.image_3 == 'null' || market.image_3 == '' || market.image_3 == ' ' || market.image_3 == NULL || market.image_3 == 'undefined'">

                                            </span>
                                            <span v-else>
                                                <a>
                                                    <img style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                                                        :src="'./img/market/' + market.image_3" onclick="change_image(this)"
                                                        class="card-img-top" width="70">
                                                </a>
                                            </span>

                                            <span
                                                v-if="market.image_4 == false || market.image_4 == null || market.image_4 == 'null' || market.image_4 == '' || market.image_4 == ' ' || market.image_4 == NULL || market.image_4 == 'undefined'">

                                            </span>
                                            <span v-else>
                                                <a>
                                                    <img style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                                                        :src="'./img/market/' + market.image_4" onclick="change_image(this)"
                                                        class="card-img-top" width="70">
                                                </a>
                                            </span>

                                            <span
                                                v-if="market.image_5 == false || market.image_5 == null || market.image_5 == 'null' || market.image_5 == '' || market.image_5 == ' ' || market.image_5 == NULL || market.image_5 == 'undefined'">

                                            </span>
                                            <span v-else>
                                                <a>
                                                    <img style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                                                        :src="'./img/market/' + market.image_5" onclick="change_image(this)"
                                                        class="card-img-top" width="70">
                                                </a>
                                            </span>

                                            <span
                                                v-if="market.image_6 == false || market.image_6 == null || market.image_6 == 'null' || market.image_6 == '' || market.image_6 == ' ' || market.image_6 == NULL || market.image_6 == 'undefined'">

                                            </span>
                                            <span v-else>
                                                <a>
                                                    <img style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                                                        :src="'./img/market/' + market.image_6" onclick="change_image(this)"
                                                        class="card-img-top" width="70">
                                                </a>
                                            </span>

                                            <span
                                                v-if="market.image_7 == false || market.image_7 == null || market.image_7 == 'null' || market.image_7 == '' || market.image_7 == ' ' || market.image_7 == NULL || market.image_7 == 'undefined'">

                                            </span>
                                            <span v-else>
                                                <a>
                                                    <img style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                                                        :src="'./img/market/' + market.image_7" onclick="change_image(this)"
                                                        class="card-img-top" width="70">
                                                </a>
                                            </span>

                                        </div>

                                        <div class="full-image-page" v-if="imageLoading">

                                            <div class="thumbnail text-center">
                                                <i style="font-size: 12px;border: white 1px solid; border-radius: 5px;color: white;padding: 10px;float: right;margin: 5px;"
                                                    class="fa fa-times" @click="deactivateImageView"></i>

                                                <img style="width: 100%;object-fit: contain;" id="main-view"
                                                    :src="'./img/market/' + market.image_1"
                                                    @click="deactivateImageView">

                                                <div class="thumbnail text-center">
                                                    <span
                                                        v-if="market.image_1 == false || market.image_1 == null || market.image_1 == 'null' || market.image_1 == '' || market.image_1 == ' ' || market.image_1 == NULL || market.image_1 == 'undefined'">

                                                    </span>
                                                    <span v-else>
                                                        <a>
                                                            <img style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                                                                :src="'./img/market/' + market.image_1"
                                                                onclick="change_view(this)" class="card-img-top"
                                                                width="70">
                                                        </a>
                                                    </span>

                                                    <span
                                                        v-if="market.image_2 == false || market.image_2 == null || market.image_2 == 'null' || market.image_2 == '' || market.image_2 == ' ' || market.image_2 == NULL || market.image_2 == 'undefined'">

                                                    </span>
                                                    <span v-else>
                                                        <a>
                                                            <img style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                                                                :src="'./img/market/' + market.image_2"
                                                                onclick="change_view(this)" class="card-img-top"
                                                                width="70">
                                                        </a>
                                                    </span>

                                                    <span
                                                        v-if="market.image_3 == false || market.image_3 == null || market.image_3 == 'null' || market.image_3 == '' || market.image_3 == ' ' || market.image_3 == NULL || market.image_3 == 'undefined'">

                                                    </span>
                                                    <span v-else>
                                                        <a>
                                                            <img style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                                                                :src="'./img/market/' + market.image_3"
                                                                onclick="change_view(this)" class="card-img-top"
                                                                width="70">
                                                        </a>
                                                    </span>

                                                    <span
                                                        v-if="market.image_4 == false || market.image_4 == null || market.image_4 == 'null' || market.image_4 == '' || market.image_4 == ' ' || market.image_4 == NULL || market.image_4 == 'undefined'">

                                                    </span>
                                                    <span v-else>
                                                        <a>
                                                            <img style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                                                                :src="'./img/market/' + market.image_4"
                                                                onclick="change_view(this)" class="card-img-top"
                                                                width="70">
                                                        </a>
                                                    </span>

                                                    <span
                                                        v-if="market.image_5 == false || market.image_5 == null || market.image_5 == 'null' || market.image_5 == '' || market.image_5 == ' ' || market.image_5 == NULL || market.image_5 == 'undefined'">

                                                    </span>
                                                    <span v-else>
                                                        <a>
                                                            <img style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                                                                :src="'./img/market/' + market.image_5"
                                                                onclick="change_view(this)" class="card-img-top"
                                                                width="70">
                                                        </a>
                                                    </span>

                                                    <span
                                                        v-if="market.image_6 == false || market.image_6 == null || market.image_6 == 'null' || market.image_6 == '' || market.image_6 == ' ' || market.image_6 == NULL || market.image_6 == 'undefined'">

                                                    </span>
                                                    <span v-else>
                                                        <a>
                                                            <img style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                                                                :src="'./img/market/' + market.image_6"
                                                                onclick="change_view(this)" class="card-img-top"
                                                                width="70">
                                                        </a>
                                                    </span>

                                                    <span
                                                        v-if="market.image_7 == false || market.image_7 == null || market.image_7 == 'null' || market.image_7 == '' || market.image_7 == ' ' || market.image_7 == NULL || market.image_7 == 'undefined'">

                                                    </span>
                                                    <span v-else>
                                                        <a>
                                                            <img style="border: solid 1px black;border-radius: 5px;margin: 3px;width: 60px;height: 80px; object-fit: contain;"
                                                                :src="'./img/market/' + market.image_7"
                                                                onclick="change_view(this)" class="card-img-top"
                                                                width="70">
                                                        </a>
                                                    </span>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product p-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <router-link data-toggle="tooltip" data-placement="bottom" title="Back"
                                                    to="/market" class="btn bg-gradient-primary btn-sm me-2">
                                                    <i class="fa fa-long-arrow-left"></i>
                                                </router-link>
                                            </div>
                                            <router-link to="/login" v-if="id == false" data-toggle="tooltip"
                                                data-placement="bottom" title="Report Post"
                                                class="btn bg-gradient-danger btn-sm me-2">
                                                <i style="font-size: 13px;" class="fa fa-flag"></i>
                                            </router-link>

                                            <button v-else data-toggle="tooltip" data-placement="bottom" title="Report Post"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                class="btn bg-gradient-danger btn-sm me-2">
                                                <i style="font-size: 13px;" class="fa fa-flag"></i>
                                            </button>

                                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Report this
                                                                product
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form @submit.prevent="sendReport">
                                                            <div class="modal-body">
                                                                <select v-model="market_issue" class="form-select mt-3">
                                                                    <option>Scam</option>
                                                                    <hr class="horizontal dark my-2">
                                                                    <option>Inappropriate</option>
                                                                    <hr class="horizontal dark my-2">
                                                                    <option>Harmful</option>
                                                                </select>
                                                                <label>Select Issue :</label>

                                                                <textarea name="message" v-model="market_complaint"
                                                                    class="form-control mt-3" id="message" rows="6"
                                                                    placeholder="you can add more details / complains here..."></textarea>
                                                                <label> Additional details</label>

                                                                <input class="form-control" type="hidden"
                                                                    v-model="userId" />
                                                                <input class="form-control" type="hidden"
                                                                    v-model="marketId" />
                                                                <input class="form-control" type="hidden"
                                                                    v-model="marketName" />
                                                                <input class="form-control" type="hidden"
                                                                    v-model="marketCat" />
                                                                <input class="form-control" type="hidden"
                                                                    v-model="marketImage" />
                                                                <input class="form-control" type="hidden"
                                                                    v-model="marketSlug" />
                                                                <input class="form-control" type="hidden"
                                                                    v-model="marketContact" />
                                                                <input class="form-control" type="hidden"
                                                                    v-model="marketPrice" />
                                                                <input class="form-control" type="hidden"
                                                                    v-model="marketDiscount" />
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
                                        <div class="mt-4 mb-3"> <span class="text-uppercase text-muted brand"> {{
                                            market.product_category
                                        }} </span>
                                            <h5 class="text-uppercase"> {{ market.product_name }}</h5>

                                            <div class="d-flex flex-row">
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
                                            </div>

                                            <!-- <div class="d-flex flex-row">                                            
                                                <span style="margin: 4px;" class="badge bg-dark "> <i class="fa fa-comments-o"></i> 23 </span>
                                            </div> -->

                                            <div class="price d-flex flex-row align-items-center"
                                                v-if="market.product_discount == 0 || market.product_discount == false || market.product_discount == null || market.product_discount == 'null' || market.product_discount == '' || market.product_discount == 'NULL'">
                                                <h4 class="act-price">Ksh. {{ market.product_price }} </h4>
                                            </div>

                                            <div class="price d-flex flex-row align-items-center" v-else>
                                                <h4 style="margin: 5px;" class="act-price"> Ksh. {{
                                                    market.product_price - market.product_discount
                                                }} </h4>
                                                <div class="ml-2">
                                                    <small class="dis-price">Ksh. {{ market.product_price }} </small>
                                                </div>
                                            </div>
                                        </div>

                                        <ul
                                            v-if="market.product_description_1 == 0 || market.product_description_1 == false || market.product_description_1 == null || market.product_description_1 == 'null' || market.product_description_1 == '' || market.product_description_1 == 'NULL' || market.product_description_1 == 'undefined'">
                                        </ul>
                                        <ul v-else>
                                            <li> {{ market.product_description_1 }}</li>
                                        </ul>

                                        <ul
                                            v-if="market.product_description_2 == 0 || market.product_description_2 == false || market.product_description_2 == null || market.product_description_2 == 'null' || market.product_description_2 == '' || market.product_description_2 == 'NULL' || market.product_description_2 == 'undefined'">
                                        </ul>
                                        <ul v-else>
                                            <li> {{ market.product_description_2 }}</li>
                                        </ul>

                                        <ul
                                            v-if="market.product_description_3 == 0 || market.product_description_3 == false || market.product_description_3 == null || market.product_description_3 == 'null' || market.product_description_3 == '' || market.product_description_3 == 'NULL' || market.product_description_3 == 'undefined'">
                                        </ul>
                                        <ul v-else>
                                            <li> {{ market.product_description_3 }}</li>
                                        </ul>

                                        <ul
                                            v-if="market.product_description_4 == 0 || market.product_description_4 == false || market.product_description_4 == null || market.product_description_4 == 'null' || market.product_description_4 == '' || market.product_description_4 == 'NULL' || market.product_description_4 == 'undefined'">
                                        </ul>
                                        <ul v-else>
                                            <li> {{ market.product_description_4 }}</li>
                                        </ul>

                                        <ul
                                            v-if="market.product_description_5 == 0 || market.product_description_5 == false || market.product_description_5 == null || market.product_description_5 == 'null' || market.product_description_5 == '' || market.product_description_5 == 'NULL' || market.product_description_5 == 'undefined'">
                                        </ul>
                                        <ul v-else>
                                            <li> {{ market.product_description_5 }}</li>
                                        </ul>

                                        <ul
                                            v-if="market.product_description_6 == 0 || market.product_description_6 == false || market.product_description_6 == null || market.product_description_6 == 'null' || market.product_description_6 == '' || market.product_description_6 == 'NULL' || market.product_description_6 == 'undefined'">
                                        </ul>
                                        <ul v-else>
                                            <li> {{ market.product_description_6 }}</li>
                                        </ul>

                                        <ul
                                            v-if="market.product_description_7 == 0 || market.product_description_7 == false || market.product_description_7 == null || market.product_description_7 == 'null' || market.product_description_7 == '' || market.product_description_7 == 'NULL' || market.product_description_7 == 'undefined'">
                                        </ul>
                                        <ul v-else>
                                            <li> {{ market.product_description_7 }}</li>
                                        </ul>

                                        <div class="container mt-4 align-items-center"
                                            style="display: flex;justify-content: center;flex-wrap: wrap;align-items: flex-start;">

                                            <router-link to="/login" v-if="id == false" data-toggle="tooltip"
                                                data-placement="bottom" title="Place in a call"
                                                class="btn bg-gradient-primary btn-sm me-2">
                                                <i style="font-size: 14px;" class="fa fa-volume-control-phone"></i>
                                            </router-link>

                                            <a v-else data-toggle="tooltip" data-placement="bottom" title="Place in a call"
                                                :href="'tel:' + market.contact" class="btn bg-gradient-primary btn-sm me-2">
                                                <i style="font-size: 14px;" class="fa fa-volume-control-phone"></i>
                                            </a>

                                            <form @submit.prevent="send">
                                                <input class="form-control" type="hidden" v-model="userId" />
                                                <input class="form-control" type="hidden" v-model="marketId" />
                                                <input class="form-control" type="hidden" v-model="marketName" />
                                                <input class="form-control" type="hidden" v-model="marketCat" />
                                                <input class="form-control" type="hidden" v-model="marketImage" />
                                                <input class="form-control" type="hidden" v-model="marketSlug" />
                                                <input class="form-control" type="hidden" v-model="marketContact" />
                                                <input class="form-control" type="hidden" v-model="marketPrice" />
                                                <input class="form-control" type="hidden" v-model="marketDiscount" />
                                                <router-link to="/login" v-if="id == false" data-toggle="tooltip"
                                                    data-placement="bottom" title="Add to compare" type="submit"
                                                    style="font-size: 13px;" class="btn bg-gradient-primary btn-sm me-2">
                                                    <i style="color: white;font-size: 13px;" class="fa fa-random" aria-hidden="true"> </i> <sup> 0</sup>
                                                </router-link>

                                                <button v-else data-toggle="tooltip" data-placement="bottom"
                                                    title="Add to compare" type="submit" style="font-size: 13px;"
                                                    class="btn bg-gradient-primary btn-sm me-2">
                                                    <i style="color: white;font-size: 13px;" class="fa fa-random" aria-hidden="true"> </i> <sup> {{ marketNameCount }}</sup>
                                                </button>
                                            </form>

                                            <a data-toggle="tooltip" data-placement="bottom" title="Share on Twitter"
                                                :href="'https://twitter.com/intent/tweet?text=Hi%20there,%20check%20out%20' + market.product_name + '%20at%20ecormade,click%20&url=https%3A%2F%2Fwww.ecomrade.co.ke/viewMarket' + market.slug + '%20to%20view.%20ecomrade%20is%20a%20hub%20for%20Kenyan%20comrades,%20rentals,%20e-market.%20%23comrade%20%23university%20%23ecommerce%20%23NikujaribuTu%20%23programming%20%23Azimio%20%23Gachagua%20%23Ruto'"
                                                class="btn btn-info btn-sm me-2" target="_blank">
                                                <i style="color: white;font-size: 13px;" class="fab fa-twitter me-1"></i>
                                            </a>
                                            <a data-toggle="tooltip" data-placement="bottom" title="Share on Facebook"
                                                :href="'https://www.facebook.com/sharer/sharer.php?u=https://www.ecomrade.co.ke/viewMarket' + market.slug"
                                                style="background-color: #3b5998;" class="btn btn-primary btn-sm me-2"
                                                target="_blank">
                                                <i style="color: white;font-size: 13px;" class="fab fa-facebook-square me-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br />

                <div class="col-12">
                    <div class="position-relative border-radius-xl overflow-hidden shadow-lg mb-7">
                        <div class="container border-bottom">
                            <div class="row justify-space-between py-2">
                                <div class="col-lg-3">
                                    <div class="nav-wrapper position-relative end-0">
                                        <ul class="nav nav-pills nav-fill flex-row p-1" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab"
                                                    href="#preview-btn-icon" role="tab" aria-selected="true">
                                                    <i class="fas fa-info-circle text-sm me-2"></i> More Info
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab"
                                                    href="#code-btn-icon" role="tab" aria-selected="false">
                                                    <i class="fas fa-star text-sm me-2"></i> Rate
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content tab-space">
                            <div class="tab-pane active" id="preview-btn-icon">
                                <div style="padding: 20px;">
                                    <p
                                        v-if="market.product_more_info == 0 || market.product_more_info == false || market.product_more_info == null || market.product_more_info == 'null' || market.product_more_info == '' || market.product_more_info == 'NULL' || market.product_more_info == 'undefined'">
                                    </p>
                                    <p v-else> {{ market.product_more_info }} </p>
                                </div>

                            </div>
                            <div class="tab-pane" id="code-btn-icon">
                                <div class="" id="candidateRatingModal" tabindex="-1" role="dialog"
                                    aria-labelledby="candidateRatingModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            </div>
                                            <div class="modal-body">
                                                <div class="rating rating-stars-container">
                                                    <div class="rating-stars"> Rate This Product : <br />
                                                        <span style="font-size: 25px;" v-for="star in stars" :key="star"
                                                            @click="setRating(star)"
                                                            :class="{ 'selected': star <= rating }">
                                                            &#9733;
                                                        </span>
                                                    </div>

                                                    <form @submit.prevent="submit">

                                                        <input class="form-control" type="hidden" v-model="ratingValue" />

                                                        <input class="form-control" type="hidden" v-model="senderName" />

                                                        <input class="form-control" type="hidden" v-model="senderId" />

                                                        <input class="form-control" type="hidden" v-model="userId" />

                                                        <input class="form-control" type="hidden" v-model="marketId" />

                                                        <input class="form-control" type="hidden" v-model="marketName" />

                                                        <input class="form-control" type="hidden" v-model="marketCat" />

                                                        <div class="mx-3 mt-3 mb-2">
                                                            <textarea name="message" v-model="comment" class="form-control"
                                                                id="message" rows="6"
                                                                placeholder="Comment Here ...."></textarea>
                                                        </div>

                                                        <div class="mx-3 mt-3 mb-2">
                                                            <router-link v-if="id == false" to="/login"
                                                                class="btn bg-gradient-primary btn-sm">
                                                                <small>
                                                                    Submit
                                                                </small>
                                                            </router-link>

                                                            <button v-else type="submit"
                                                                class="btn bg-gradient-primary btn-sm">
                                                                <small>
                                                                    Submit
                                                                </small>
                                                            </button>
                                                        </div>

                                                    </form>
                                                </div>

                                                <div style="padding: 20px;" class="card mt-2">
                                                    <h6>Reviews</h6>
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
                                                    <hr>
                                                    <div v-for="(review, index) in marketreviews" :key="review.id"
                                                        class="comment-section">
                                                        <div v-if="review.marketId == market.id"
                                                            class="d-flex justify-content-between align-items-center">
                                                            <div class="d-flex flex-row align-items-center">
                                                                <div class="d-flex flex-column ml-1 comment-profile">
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
                                                                            <i style="color: orange;"
                                                                                class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                        </span>
                                                                        <span v-if="review.ratingValue == 2">
                                                                            <i style="color: orange;"
                                                                                class="fa fa-star"></i>
                                                                            <i style="color: orange;"
                                                                                class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                        </span>
                                                                        <span v-if="review.ratingValue == 3">
                                                                            <i style="color: orange;"
                                                                                class="fa fa-star"></i>
                                                                            <i style="color: orange;"
                                                                                class="fa fa-star"></i>
                                                                            <i style="color: orange;"
                                                                                class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                        </span>
                                                                        <span v-if="review.ratingValue == 4">
                                                                            <i style="color: orange;"
                                                                                class="fa fa-star"></i>
                                                                            <i style="color: orange;"
                                                                                class="fa fa-star"></i>
                                                                            <i style="color: orange;"
                                                                                class="fa fa-star"></i>
                                                                            <i style="color: orange;"
                                                                                class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                        </span>
                                                                        <span v-if="review.ratingValue == 5">
                                                                            <i style="color: orange;"
                                                                                class="fa fa-star"></i>
                                                                            <i style="color: orange;"
                                                                                class="fa fa-star"></i>
                                                                            <i style="color: orange;"
                                                                                class="fa fa-star"></i>
                                                                            <i style="color: orange;"
                                                                                class="fa fa-star"></i>
                                                                            <i style="color: orange;"
                                                                                class="fa fa-star"></i>
                                                                        </span>

                                                                        <span style="margin: 4px;" class="text-muted"> (
                                                                            {{ review.created_at }} )</span>
                                                                    </div>
                                                                    <span class="username"> {{ review.senderName }} :- "
                                                                        {{ review.comment }} "
                                                                        <button v-if="review.senderId == id" type="button"
                                                                            @click="destroy(review.id)" class="delete-btn"
                                                                            style="float: right;border:none;outline:none;background: none;">
                                                                            <i class="fa fa-trash-o"
                                                                                style="color: red;"></i>
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
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="horizontal dark my-5">
            </div>



            <div class="container">
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <h4 class="text-primary text-gradient mb-0"> Similar Prods</h4>
                    </div>
                </div>
            </div>
            <hr class="horizontal dark my-2">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-4 col-12" v-for="marketing in markets" :key="marketing.id"
                        v-show="marketing.product_category == market.product_category && marketing.id != market.id">
                        <div style="background-color: #E9ECEF;" class="card">
                            <router-link :to="{
                                name: 'ViewProd',
                                params: { slug: marketing.slug },
                            }">
                                <img v-if="marketing.image_1 == false || marketing.image_1 == null || marketing.image_1 == 'null' || marketing.image_1 == '' || marketing.image_1 == ' ' || marketing.image_1 == NULL"
                                    loading="lazy"
                                    style="background-color: white;width: 100%;height: 200px; object-fit: cover;"
                                    src="/web/img/no_img.jpg" class="card-img-top" width="100%">

                                <img v-else style="background-color: white;width: 100%;height: 200px; object-fit: cover;"
                                    :src="'./img/market/' + marketing.image_1" class="card-img-top" width="100%">

                            </router-link>

                            <div class="card-body pt-0 px-0">
                                <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                    <h4>{{ marketing.product_name }}</h4>
                                </div>
                                <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                    <small class="text-muted mt-1">Cost</small>
                                    <h6>
                                        <span
                                            v-if="marketing.product_discount == 0 || marketing.product_discount == false || marketing.product_discount == null || marketing.product_discount == 'null' || marketing.product_discount == '' || marketing.product_discount == ' '">Ksh.
                                            {{ marketing.product_price }}</span>
                                        <span v-else><span style="text-decoration: line-through;color: #189483;">Ksh. {{
                                            marketing.product_price - marketing.product_discount
                                        }}</span> Ksh. {{ marketing.product_price }}</span>
                                    </h6>
                                </div>

                                <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                    <small class="text-muted mt-1">Status</small>
                                    <h6>
                                        <span style="color: red;"
                                            v-if="marketing.availability == 'unavailable' || marketing.availability == false || marketing.availability == null || marketing.availability == 'null' || marketing.availability == '' || marketing.availability == ' '">
                                            Out Of Order</span>
                                        <span style="color: #189483;" v-else> Available</span>
                                    </h6>
                                </div>

                                <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                    <small class="text-muted mt-1">Location</small>
                                    <h6>
                                        <span style="color: red;"
                                            v-if="marketing.location == false || marketing.location == null || marketing.location == 'null' || marketing.location == '' || marketing.location == ' '">
                                            Not Provided</span>
                                        <span style="color: #189483;" v-else> {{ marketing.location }}</span>
                                    </h6>
                                </div>

                                <div class="d-flex flex-row justify-content-between mb-0 px-3">
                                    <span style="margin: 3px;" class="badge bg-dark ">
                                        <i class="fa fa-comments-o"></i> {{ marketing.rating_count }}
                                    </span>

                                    <span style="margin: 3px;" class="badge bg-dark">
                                        <div v-if="Math.round(marketing.avg_rating) === 0" class="stars">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div v-if="Math.round(marketing.avg_rating) === 1" class="stars">
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div v-if="Math.round(marketing.avg_rating) === 2" class="stars">
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div v-if="Math.round(marketing.avg_rating) === 3" class="stars">
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div v-if="Math.round(marketing.avg_rating) === 4" class="stars">
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div v-if="Math.round(marketing.avg_rating) === 5" class="stars">
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: orange;" class="fa fa-star"></i>
                                            <i style="color: orange;" class="fa fa-star"></i>
                                        </div>
                                    </span>
                                </div>


                                <div class="mx-3 mt-3 mb-2">
                                    <form @submit.prevent="submiting(marketing)">
                                        <input class="form-control" type="hidden" v-model="marketing.user_id" />
                                        <input class="form-control" type="hidden" v-model="marketing.id" />
                                        <input class="form-control" type="hidden" v-model="marketing.product_name" />
                                        <input class="form-control" type="hidden" v-model="marketing.product_category" />
                                        <input class="form-control" type="hidden" v-model="marketing.image_1" />
                                        <input class="form-control" type="hidden" v-model="marketing.slug" />
                                        <input class="form-control" type="hidden" v-model="marketing.contact" />
                                        <input class="form-control" type="hidden" v-model="marketing.product_price" />
                                        <input class="form-control" type="hidden" v-model="marketing.product_discount" />
                                        <button data-toggle="tooltip" data-placement="bottom" title="Add to compare"
                                            style="font-size: 13px;" type="submit"
                                            class="btn bg-gradient-primary btn-sm btn-block">
                                            Compare <sup> ( {{ marketing.cart_count }} )</sup>
                                        </button>
                                    </form>

                                </div>

                            </div>
                        </div>
                        <br />
                    </div>
                    <h5 v-if="!markets.length">Sorry, no item found!</h5>
                </div>
            </div>
        </section>
        <Footer />
    </body>
</template>

<script>
import axios from 'axios';
import Footer from './Footer.vue'

export default {

    components: {
        Footer
    },
    emits: ["updateSidebar"],
    props: ["slug"],
    data() {
        return {
            reviewCount: 0,
            rating: 0,
            market: {},
            markets: [],
            marketreviews: {},
            id: "",
            name: "",
            avgRating: 0,
            commentCount: 0,
            marketNameCount: 0,
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
                return this.market.user_id;
            },
            set(value) {
                this.market.user_id = value;
            }
        },

        marketId: {
            get() {
                return this.market.id;
            },
            set(value) {
                this.market.id = value;
            }
        },

        marketSlug: {
            get() {
                return this.market.slug;
            },
            set(value) {
                this.market.slug = value;
            }
        },

        marketContact: {
            get() {
                return this.market.contact;
            },
            set(value) {
                this.market.contact = value;
            }
        },

        marketPrice: {
            get() {
                return this.market.product_price;
            },
            set(value) {
                this.market.product_price = value;
            }
        },

        marketDiscount: {
            get() {
                return this.market.product_discount;
            },
            set(value) {
                this.market.product_discount = value;
            }
        },

        marketName: {
            get() {
                return this.market.product_name;
            },
            set(value) {
                this.market.product_name = value;
            }
        },

        marketImage: {
            get() {
                return this.market.image_1;
            },
            set(value) {
                this.market.image_1 = value;
            }
        },

        marketCat: {
            get() {
                return this.market.product_category;
            },
            set(value) {
                this.market.product_category = value;
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

        submit() {

            const fd = new FormData();
            fd.append("ratingValue", this.ratingValue);
            fd.append("senderName", this.senderName);
            fd.append("senderId", this.senderId);
            fd.append("userId", this.userId);
            fd.append("marketId", this.marketId);
            fd.append("marketName", this.marketName);
            fd.append("marketCat", this.marketCat);
            fd.append("comment", this.comment);

            fd.append("_method", "POST");


            axios
                .post("/api/marketreviews", fd, {
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

                    axios.get('/api/marketreviews')
                        .then(response => {
                            this.marketreviews = response.data.data;
                        });

                    axios.get(`/api/markets/${this.$route.params.slug}`)
                        .then(response => {
                            console.log(JSON.stringify(response));
                            this.market = response.data.data;
                            this.avgRating = response.data.avg_rate;
                            this.commentCount = response.data.comment_count;
                            this.marketNameCount = response.data.marketName_count;
                        });
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    this.success = false;
                });
        },

        submiting(market) {
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

                    axios.get('/api/marketings')
                        .then(response => {
                            this.markets = response.data.data;
                        })
                        .catch(error => {
                            console.log(error);
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

        send() {

            const fd = new FormData();
            fd.append("user_id", this.userId);
            fd.append("id", this.marketId);
            fd.append("product_name", this.marketName);
            fd.append("product_category", this.marketCat);
            fd.append("image_1", this.marketImage);
            fd.append("slug", this.marketSlug);
            fd.append("contact", this.marketContact);
            fd.append("product_price", this.marketPrice);
            fd.append("product_discount", this.marketDiscount);

            fd.append("_method", "POST");


            axios
                .post("/api/carts", fd, {
                    headers: { "content-type": "multipart/form-data" },
                })
                .then(() => {
                    let timerInterval

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

                    this.ratingValue = '';
                    this.comment = '';

                    axios.get('/api/marketreviews')
                        .then(response => {
                            this.marketreviews = response.data.data;
                        });

                    axios.get(`/api/markets/${this.$route.params.slug}`)
                        .then(response => {
                            console.log(JSON.stringify(response));
                            this.market = response.data.data;
                            this.avgRating = response.data.avg_rate;
                            this.commentCount = response.data.comment_count;
                            this.marketNameCount = response.data.marketName_count;
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
            fd.append("id", this.marketId);
            fd.append("product_name", this.marketName);
            fd.append("product_category", this.marketCat);
            fd.append("image_1", this.marketImage);
            fd.append("slug", this.marketSlug);
            fd.append("contact", this.marketContact);
            fd.append("product_price", this.marketPrice);
            fd.append("product_discount", this.marketDiscount);

            fd.append("market_issue", this.market_issue);
            fd.append("market_complaint", this.market_complaint);

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
                    this.marketIssue = '';
                    this.marketComplaint = '';
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
                        .delete("/api/marketreviews/" + id)
                        .then((response) => {
                            Swal.fire(
                                'Deleted!',
                                'Information has been successfully deleted.',
                                'success'
                            );
                            // Fire.$emit('AfterCreate');
                            axios.get("/api/marketreviews").then(({
                                data
                            }) => (this.marketreviews = data.data))
                        }).catch((error) => {
                            Swal.fire("Failed!", error.message, "warning");
                        });

                    axios.get(`/api/markets/${this.$route.params.slug}`)
                        .then(response => {
                            console.log(JSON.stringify(response));
                            this.market = response.data.data;
                            this.avgRating = response.data.avg_rate;
                            this.commentCount = response.data.comment_count;
                            this.marketNameCount = response.data.marketName_count;
                        });
                }
            })
        },

        getProduct() {
            axios.get("/api/markets/" + this.$route.params.id)
                .then(response => {
                    this.market = response.data;
                    this.reviewCount = response.data.marketreviews.length;
                });
        },

        productName(page) {
            axios
                .get('/api/marketings?page=' + page, {
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
                .get("/api/markets", {
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

        axios.get(`/api/markets/${this.$route.params.slug}`)
            .then(response => {
                console.log(JSON.stringify(response));
                this.market = response.data.data;
                this.avgRating = response.data.avg_rate;
                this.commentCount = response.data.comment_count;
                this.marketNameCount = response.data.marketName_count;
            });

        axios.get('/api/marketreviews')
            .then(response => {
                this.marketreviews = response.data.data;
            });

    },
};
</script>

<style scoped>
.card-container {
    height: auto;
    /* set to a fixed value that is large enough to contain all the card elements */
    display: flex;
    flex-wrap: wrap;
}


.card-placeholder {
    width: 100%;
    height: auto;
    padding-bottom: 100%;
    /* set the padding to a value that will maintain the aspect ratio of the card */
    background-color: #ddd;
    margin-bottom: 20px;
    border: #00a8cc solid 1px;
    border-radius: 5px;
}

.card {
    border: none;
    margin-bottom: 20px;
}

.product {
    background-color: #eee;
    height: 100%;
}

.brand {
    font-size: 13px
}

.act-price {
    color: #189483;
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
    border: 2px solid #189483;
    display: inline-block;
    color: #189483;
    border-radius: 3px;
    text-transform: uppercase
}

label.radio input:checked+span {
    border-color: #189483;
    background-color: #189483;
    color: #fff
}

.btn-danger {
    background-color: #189483 !important;
    border-color: #189483 !important
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
}</style>