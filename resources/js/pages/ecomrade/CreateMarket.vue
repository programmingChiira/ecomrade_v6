<template>
    <body class="index-page">
        <Loader />
        <section class="my-6 py-6">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-10">
                        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                            <div class="container">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <router-link to="/">Home</router-link>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <router-link to="/market">Market</router-link>
                                    </li>
                                    <li style="color: #189483" class="breadcrumb-item">
                                        <strong>New</strong>
                                    </li>
                                </ol>
                            </div>
                        </nav>
                    </div>
                </div>

                <div class="row align-items-center justify-content-center">
                    <div style="padding: 10px" class="col-lg-12 col-sm-12">
                        <form @submit.prevent="submit">
                            <div v-if="step === 1">
                                <h4>Product Info</h4>
                                <label for="product_name"><span>Product Name<span style="color: red">
                                            *
                                        </span></span></label>
                                <input class="form-control" type="text" id="product_name" v-model="prodName" required />
                                <span v-if="errors.product_name" class="error">{{ errors.product_name[0] }}</span>
                                <br />

                                <label for="product_price"><span>Product Price<span style="color: red">
                                            *
                                        </span></span></label>
                                <input class="form-control" type="number" id="product_price" v-model="prodPrice" required />
                                <span v-if="errors.product_price" class="error">{{ errors.product_price[0] }}</span>
                                <br />

                                <label for="product_discount"><span>Price Discount</span></label>
                                <input class="form-control" type="number" id="product_discount" v-model="prodDiscount" />
                                <span v-if="errors.product_discount" class="error">{{ errors.product_discount[0] }}</span>
                                <br />

                                <label for="status">Select Category </label>
                                <select class="form-control" v-model="selectedCategory">
                                    <option value="">Select a Category</option>
                                    <option :value="marketcategory.name" v-for="marketcategory in marketcategories"
                                        :key="marketcategory.id">
                                        {{ marketcategory.name }}
                                    </option>
                                </select>
                                <span v-if="errors.product_category" class="error">{{ errors.product_category[0] }}</span>
                                <br />

                                <label for="status">Select Sub-Category</label>
                                <select class="form-control" v-model="selectedSubCategory" required>
                                    <option value="">
                                        Select a Sub-Category
                                    </option>
                                    <option v-for="marketsubcategory in marketsubcategories" :key="marketsubcategory.id"
                                        :value="marketsubcategory.name">
                                        {{ marketsubcategory.name }}
                                    </option>
                                </select>
                                <span v-if="errors.product_sub_category" class="error">{{ errors.product_sub_category[0]
                                }}</span>
                                <br />

                                <input class="form-control" type="hidden" id="product_price" v-model="prodCat" />

                                <input class="form-control" type="hidden" id="product_price" v-model="prodSubCat" />

                                <label for="size"><span>Product Size(Drop)</span></label>
                                <select class="form-control" type="text" id="size" v-model="prodSize">
                                    <option>Small</option>
                                    <option>Medium</option>
                                    <option>Large</option>
                                </select>
                                <span v-if="errors.size" class="error">{{
                                    errors.size[0]
                                }}</span>
                                <br />

                                <label for="size"><span>Product Size</span></label>
                                <input class="form-control" type="text" id="size" v-model="prodSize" />
                                <span v-if="errors.size" class="error">{{
                                    errors.size[0]
                                }}</span>
                                <br />

                                <label for="gender"><span> Target audience</span></label>
                                <select class="form-control" type="text" id="gender" v-model="prodGender">
                                    <option>Children</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Unisex</option>
                                </select>
                                <span v-if="errors.gender" class="error">{{
                                    errors.gender[0]
                                }}</span>
                                <br />

                                <label for="color"><span>Product Color</span></label>
                                <input class="form-control" type="text" id="color" v-model="prodColor" />
                                <span v-if="errors.color" class="error">{{
                                    errors.color[0]
                                }}</span>
                                <br />

                                <label for="availability"><span>Product Availability<span style="color: red">
                                            *
                                        </span></span></label>
                                <select class="form-control" type="text" id="availability" v-model="prodAvail" required>
                                    <option>Available</option>
                                    <option>Out of stock</option>
                                </select>
                                <span v-if="errors.availability" class="error">{{ errors.availability[0] }}</span>
                                <br />

                                <label for="contact"><span>Product / Service<span style="color: red">
                                            *
                                        </span></span></label>
                                <select class="form-control" v-model="prodService" required>
                                    <option value="Product">Product</option>
                                    <option value="Service">Service</option>
                                </select>
                                <span v-if="errors.product_service" class="error">{{ errors.product_service[0] }}</span>
                                <br />

                                <label for="rental_area"><span>Product Location<span style="color: red">
                                            *
                                        </span></span></label>
                                <select class="form-control" type="text" id="rental_area" v-model="prodLocation" required>
                                    <option v-for="location in locations" :key="location.id">
                                        {{ location.name }}
                                    </option>
                                </select>
                                <span v-if="errors.rental_area" class="error">{{
                                    errors.rental_area[0]
                                }}</span>
                                <br />

                                <button class="btn btn-sm" @click.prevent="nextStep">
                                    Next
                                </button>
                            </div>

                            <div v-if="step === 2">
                                <h4>Product Images</h4>
                                <label for="image"><span>Image 1
                                        <span style="color: red">
                                            *
                                        </span></span></label>
                                <input class="form-control" type="file" id="image" @input="grabFile1" required />
                                <span v-if="errors.file" class="error">{{
                                    errors.file[0]
                                }}</span>
                                <div class="preview row">
                                    <div class="col-6 col-md-6"></div>
                                    <img :src="url1" alt="" />
                                </div>
                                <br />

                                <label v-if="input2 === 2" for="image"><span>Image 2</span></label>
                                <input v-if="input2 === 2" class="form-control" type="file" id="image" @input="grabFile2" />
                                <span v-if="errors.file" class="error">{{
                                    errors.file[0]
                                }}</span>
                                <div v-if="input2 === 2" class="preview row">
                                    <div class="col-6 col-md-6"></div>
                                    <img :src="url2" alt="" />
                                </div>
                                <hr />

                                <label v-if="input3 === 3" for="image"><span>Image 3</span></label>
                                <input v-if="input3 === 3" class="form-control" type="file" id="image" @input="grabFile3" />
                                <span v-if="errors.file" class="error">{{
                                    errors.file[0]
                                }}</span>
                                <div v-if="input3 === 3" class="preview row">
                                    <div class="col-6 col-md-6"></div>
                                    <img :src="url3" alt="" />
                                </div>
                                <hr />

                                <label v-if="input4 === 4" for="image"><span>Image 4</span></label>
                                <input v-if="input4 === 4" class="form-control" type="file" id="image" @input="grabFile4" />
                                <span v-if="errors.file" class="error">{{
                                    errors.file[0]
                                }}</span>
                                <div v-if="input4 === 4" class="preview row">
                                    <div class="col-6 col-md-6"></div>
                                    <img :src="url4" alt="" />
                                </div>
                                <hr />

                                <label v-if="input5 === 5" for="image"><span>Image 5</span></label>
                                <input v-if="input5 === 5" class="form-control" type="file" id="image" @input="grabFile5" />
                                <span v-if="errors.file" class="error">{{
                                    errors.file[0]
                                }}</span>
                                <div v-if="input5 === 5" class="preview row">
                                    <div class="col-6 col-md-6"></div>
                                    <img :src="url5" alt="" />
                                </div>
                                <hr />

                                <label v-if="input6 === 6" for="image"><span>Image 6</span></label>
                                <input v-if="input6 === 6" class="form-control" type="file" id="image" @input="grabFile6" />
                                <span v-if="errors.file" class="error">{{
                                    errors.file[0]
                                }}</span>
                                <div v-if="input6 === 6" class="preview row">
                                    <div class="col-6 col-md-6"></div>
                                    <img :src="url6" alt="" />
                                </div>
                                <hr />

                                <label v-if="input7 === 7" for="image"><span>Image 7</span></label>
                                <input v-if="input7 === 7" class="form-control" type="file" id="image" @input="grabFile7" />
                                <span v-if="errors.file" class="error">{{
                                    errors.file[0]
                                }}</span>
                                <div v-if="input7 === 7" class="preview row">
                                    <div class="col-6 col-md-6"></div>
                                    <img :src="url7" alt="" />
                                </div>
                                <hr />
                                
                                <label v-if="input8 === 8" for="image"><span>Image 8</span></label>
                                <input v-if="input8 === 8" class="form-control" type="file" id="image" @input="grabFile8" />
                                <span v-if="errors.file" class="error">{{
                                    errors.file[0]
                                }}</span>
                                <div v-if="input8 === 8" class="preview row">
                                    <div class="col-6 col-md-6"></div>
                                    <img :src="url8" alt="" />
                                </div>
                                <hr />
                                
                                <label v-if="input9 === 9" for="image"><span>Image 9</span></label>
                                <input v-if="input9 === 9" class="form-control" type="file" id="image" @input="grabFile9" />
                                <span v-if="errors.file" class="error">{{
                                    errors.file[0]
                                }}</span>
                                <div v-if="input9 === 9" class="preview row">
                                    <div class="col-6 col-md-6"></div>
                                    <img :src="url9" alt="" />
                                </div>
                                <hr />
                                
                                <label v-if="input10 === 10" for="image"><span>Image 10</span></label>
                                <input v-if="input10 === 10" class="form-control" type="file" id="image" @input="grabFile10" />
                                <span v-if="errors.file" class="error">{{
                                    errors.file[0]
                                }}</span>
                                <div v-if="input10 === 10" class="preview row">
                                    <div class="col-6 col-md-6"></div>
                                    <img :src="url10" alt="" />
                                </div>
                                <hr />
                                
                                <label v-if="input11 === 11" for="image"><span>Image 11</span></label>
                                <input v-if="input11 === 11" class="form-control" type="file" id="image" @input="grabFile11" />
                                <span v-if="errors.file" class="error">{{
                                    errors.file[0]
                                }}</span>
                                <div v-if="input11 === 11" class="preview row">
                                    <div class="col-6 col-md-6"></div>
                                    <img :src="url11" alt="" />
                                </div>
                                <hr />
                                
                                <label v-if="input12 === 12" for="image"><span>Image 12</span></label>
                                <input v-if="input12 === 12" class="form-control" type="file" id="image" @input="grabFile12" />
                                <span v-if="errors.file" class="error">{{
                                    errors.file[0]
                                }}</span>
                                <div v-if="input12 === 12" class="preview row">
                                    <div class="col-6 col-md-6"></div>
                                    <img :src="url12" alt="" />
                                </div>
                                <hr />
                                
                                <label v-if="input13 === 13" for="image"><span>Image 13</span></label>
                                <input v-if="input13 === 13" class="form-control" type="file" id="image" @input="grabFile13" />
                                <span v-if="errors.file" class="error">{{
                                    errors.file[0]
                                }}</span>
                                <div v-if="input13 === 13" class="preview row">
                                    <div class="col-6 col-md-6"></div>
                                    <img :src="url13" alt="" />
                                </div>
                                <hr />
                                
                                <label v-if="input14 === 14" for="image"><span>Image 14</span></label>
                                <input v-if="input14 === 14" class="form-control" type="file" id="image" @input="grabFile14" />
                                <span v-if="errors.file" class="error">{{
                                    errors.file[0]
                                }}</span>
                                <div v-if="input14 === 14" class="preview row">
                                    <div class="col-6 col-md-6"></div>
                                    <img :src="url14" alt="" />
                                </div>
                                <hr />
                                
                                <label v-if="input15 === 15" for="image"><span>Image 15</span></label>
                                <input v-if="input15 === 15" class="form-control" type="file" id="image" @input="grabFile15" />
                                <span v-if="errors.file" class="error">{{
                                    errors.file[0]
                                }}</span>
                                <div v-if="input15 === 15" class="preview row">
                                    <div class="col-6 col-md-6"></div>
                                    <img :src="url15" alt="" />
                                </div>
                                <hr />
                                
                                <label v-if="input16 === 16" for="image"><span>Image 16</span></label>
                                <input v-if="input16 === 16" class="form-control" type="file" id="image" @input="grabFile16" />
                                <span v-if="errors.file" class="error">{{
                                    errors.file[0]
                                }}</span>
                                <div v-if="input16 === 16" class="preview row">
                                    <div class="col-6 col-md-6"></div>
                                    <img :src="url16" alt="" />
                                </div>
                                <hr />
                                
                                <label v-if="input17 === 17" for="image"><span>Image 17</span></label>
                                <input v-if="input17 === 17" class="form-control" type="file" id="image" @input="grabFile17" />
                                <span v-if="errors.file" class="error">{{
                                    errors.file[0]
                                }}</span>
                                <div v-if="input17 === 17" class="preview row">
                                    <div class="col-6 col-md-6"></div>
                                    <img :src="url17" alt="" />
                                </div>
                                <hr />
                                
                                <label v-if="input18 === 18" for="image"><span>Image 18</span></label>
                                <input v-if="input18 === 18" class="form-control" type="file" id="image" @input="grabFile18" />
                                <span v-if="errors.file" class="error">{{
                                    errors.file[0]
                                }}</span>
                                <div v-if="input18 === 18" class="preview row">
                                    <div class="col-6 col-md-6"></div>
                                    <img :src="url18" alt="" />
                                </div>
                                <hr />
                                
                                <label v-if="input19 === 19" for="image"><span>Image 19</span></label>
                                <input v-if="input19 === 19" class="form-control" type="file" id="image" @input="grabFile19" />
                                <span v-if="errors.file" class="error">{{
                                    errors.file[0]
                                }}</span>
                                <div v-if="input19 === 19" class="preview row">
                                    <div class="col-6 col-md-6"></div>
                                    <img :src="url19" alt="" />
                                </div>
                                <hr />
                                
                                <label v-if="input20 === 20" for="image"><span>Image 20</span></label>
                                <input v-if="input20 === 20" class="form-control" type="file" id="image" @input="grabFile20" />
                                <span v-if="errors.file" class="error">{{
                                    errors.file[0]
                                }}</span>
                                <div v-if="input20 === 20" class="preview row">
                                    <div class="col-6 col-md-6"></div>
                                    <img :src="url20" alt="" />
                                </div>
                                <hr />
                                
                                <label v-if="input21 === 21" for="image"><span>Image 21</span></label>
                                <input v-if="input21 === 21" class="form-control" type="file" id="image" @input="grabFile21" />
                                <span v-if="errors.file" class="error">{{
                                    errors.file[0]
                                }}</span>
                                <div v-if="input21 === 21" class="preview row">
                                    <div class="col-6 col-md-6"></div>
                                    <img :src="url21" alt="" />
                                </div>
                                <hr />
                                
                                <label v-if="input22 === 22" for="image"><span>Image 22</span></label>
                                <input v-if="input22 === 22" class="form-control" type="file" id="image" @input="grabFile22" />
                                <span v-if="errors.file" class="error">{{
                                    errors.file[0]
                                }}</span>
                                <div v-if="input22 === 22" class="preview row">
                                    <div class="col-6 col-md-6"></div>
                                    <img :src="url22" alt="" />
                                </div>
                                <hr />
                                
                                <label v-if="input23 === 23" for="image"><span>Image 23</span></label>
                                <input v-if="input23 === 23" class="form-control" type="file" id="image" @input="grabFile23" />
                                <span v-if="errors.file" class="error">{{
                                    errors.file[0]
                                }}</span>
                                <div v-if="input23 === 23" class="preview row">
                                    <div class="col-6 col-md-6"></div>
                                    <img :src="url23" alt="" />
                                </div>
                                <hr />
                                
                                <label v-if="input24 === 24" for="image"><span>Image 24</span></label>
                                <input v-if="input24 === 24" class="form-control" type="file" id="image" @input="grabFile24" />
                                <span v-if="errors.file" class="error">{{
                                    errors.file[0]
                                }}</span>
                                <div v-if="input24 === 24" class="preview row">
                                    <div class="col-6 col-md-6"></div>
                                    <img :src="url24" alt="" />
                                </div>
                                <hr />
                                
                                <label v-if="input25 === 25" for="image"><span>Image 25</span></label>
                                <input v-if="input25 === 25" class="form-control" type="file" id="image" @input="grabFile25" />
                                <span v-if="errors.file" class="error">{{
                                    errors.file[0]
                                }}</span>
                                <div v-if="input25 === 25" class="preview row">
                                    <div class="col-6 col-md-6"></div>
                                    <img :src="url25" alt="" />
                                </div>
                                <hr />
                                

                                <h4 v-if="input26 === 26" style="color: #189483">
                                    Sorry ! you've maxed out on image upload.
                                </h4>

                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear2" type="button"
                                    @click="showInput2">
                                    Add Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear3" type="button"
                                    @click="showInput3">
                                    Add Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear4" type="button"
                                    @click="showInput4">
                                    Add Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear5" type="button"
                                    @click="showInput5">
                                    Add Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear6" type="button"
                                    @click="showInput6">
                                    Add Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear7" type="button"
                                    @click="showInput7">
                                    Add Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear7" type="button"
                                    @click="showInput7">
                                    Add Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear8" type="button"
                                    @click="showInput8">
                                    Add Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear9" type="button"
                                    @click="showInput9">
                                    Add Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear10" type="button"
                                    @click="showInput10">
                                    Add Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear11" type="button"
                                    @click="showInput11">
                                    Add Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear12" type="button"
                                    @click="showInput12">
                                    Add Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear13" type="button"
                                    @click="showInput13">
                                    Add Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear14" type="button"
                                    @click="showInput14">
                                    Add Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear15" type="button"
                                    @click="showInput15">
                                    Add Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear16" type="button"
                                    @click="showInput16">
                                    Add Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear17" type="button"
                                    @click="showInput17">
                                    Add Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear18" type="button"
                                    @click="showInput18">
                                    Add Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear19" type="button"
                                    @click="showInput19">
                                    Add Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear20" type="button"
                                    @click="showInput20">
                                    Add Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear21" type="button"
                                    @click="showInput21">
                                    Add Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear22" type="button"
                                    @click="showInput22">
                                    Add Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear23" type="button"
                                    @click="showInput23">
                                    Add Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear24" type="button"
                                    @click="showInput24">
                                    Add Image
                                </button>
                                <button class="btn bg-gradient-primary btn-sm" v-if="disappear25" type="button"
                                    @click="showInput25">
                                    Add Image
                                </button>
                                <br />
                                <button class="btn btn-sm" @click.prevent="prevStep">
                                    Prev
                                </button>
                                <button class="btn btn-sm" @click.prevent="nextStep">
                                    Next
                                </button>
                            </div>

                            <div v-if="step === 3">
                                <h4>Product Description</h4>
                                <label for="product_description_1"><span>Product Description 1<span style="color: red">
                                            *
                                        </span></span></label>
                                <input class="form-control" type="text" id="product_description_1" v-model="prodDesc1"
                                    required />
                                <span v-if="errors.product_description_1" class="error">{{ errors.product_description_1[0]
                                }}</span>
                                <br />

                                <label for="product_description_2"><span>Product Description 2<span style="color: red">
                                            *
                                        </span></span></label>
                                <input class="form-control" type="text" id="product_description_2" v-model="prodDesc2"
                                    required />
                                <span v-if="errors.product_description_2" class="error">{{ errors.product_description_2[0]
                                }}</span>
                                <br />

                                <label for="product_description_3"><span>Product Description 3<span style="color: red">
                                            *
                                        </span></span></label>
                                <input class="form-control" type="text" id="product_description_3" v-model="prodDesc3"
                                    required />
                                <span v-if="errors.product_description_3" class="error">{{ errors.product_description_3[0]
                                }}</span>
                                <br />

                                <label for="product_description_4"><span>Product Description 4</span></label>
                                <input class="form-control" type="text" id="product_description_4" v-model="prodDesc4" />
                                <span v-if="errors.product_description_4" class="error">{{ errors.product_description_4[0]
                                }}</span>
                                <br />

                                <label for="product_description_5"><span>Product Description 5</span></label>
                                <input class="form-control" type="text" id="product_description_5" v-model="prodDesc5" />
                                <span v-if="errors.product_description_5" class="error">{{ errors.product_description_5[0]
                                }}</span>
                                <br />

                                <label for="product_description_6"><span>Product Description 6</span></label>
                                <input class="form-control" type="text" id="product_description_6" v-model="prodDesc6" />
                                <span v-if="errors.product_description_6" class="error">{{ errors.product_description_6[0]
                                }}</span>
                                <br />

                                <label for="product_description_7"><span>Product Description 7</span></label>
                                <input class="form-control" type="text" id="product_description_7" v-model="prodDesc7" />
                                <span v-if="errors.product_description_7" class="error">{{ errors.product_description_7[0]
                                }}</span>
                                <br />

                                <label for="product_more_info"><span> More Info</span></label>
                                <textarea class="form-control" type="text" id="product_more_info" v-model="prodMoreInfo"
                                    rows="6" placeholder="More Info ..."></textarea>
                                <span v-if="errors.product_more_info" class="error">{{ errors.product_more_info[0] }}</span>
                                <br />
                                <button class="btn btn-sm" @click.prevent="prevStep">
                                    Prev
                                </button>
                                <button class="btn btn-sm" @click.prevent="nextStep">
                                    Next
                                </button>
                            </div>

                            <div v-if="step === 4">
                                <h4>Seller contacts</h4>
                                <label for="size"><span>Seller Contact(Drop)</span></label>
                                <select class="form-control" type="text" id="contact" v-model="prodContact">
                                    <option>{{ phone }}</option>
                                </select>
                                <br />
                                <label for="contact"><span>Seller Contact
                                        <span style="color: red">
                                            *
                                        </span></span></label>
                                <input class="form-control" type="text" id="contact" v-model="prodContact" required />
                                <span v-if="errors.contact" class="error">{{
                                    errors.contact[0]
                                }}</span>
                                <br />
                                <button class="btn btn-sm" @click.prevent="prevStep">
                                    Prev
                                </button>
                                <button v-if="!isSubmitting" style="margin: 5px; float: right"
                                    class="btn bg-gradient-primary btn-sm" type="submit">
                                    Submit
                                </button>
                                <i v-if="isSubmitting" style="
                                        -webkit-animation: fa-spin 3s infinite
                                            linear;
                                        animation: fa-spin 2s infinite linear;
                                        font-size: 17px;
                                        color: #189483;
                                        float: right;
                                    " class="fa fa-graduation-cap"></i>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <hr class="horizontal dark my-5" />
        </section>

        <Footer />
    </body>
</template>

<script>
import Footer from "./Footer.vue";
import Loader from "./Loader.vue";

export default {
    components: {
        Footer,
        Loader,
    },
    data() {
        return {
            step: 1,
            showInput: 0,

            disappear2: true,
            input2: false,
            disappear3: false,
            input3: false,
            disappear4: false,
            input4: false,
            disappear5: false,
            input5: false,
            disappear6: false,
            input6: false,
            disappear7: false,
            input7: false,
            disappear8: false,
            input8: false,
            disappear9: false,
            input9: false,
            disappear10: false,
            input10: false,
            disappear11: false,
            input11: false,
            disappear12: false,
            input12: false,
            disappear13: false,
            input13: false,
            disappear14: false,
            input14: false,
            disappear15: false,
            input15: false,
            disappear16: false,
            input16: false,
            disappear17: false,
            input17: false,
            disappear18: false,
            input18: false,
            disappear19: false,
            input19: false,
            disappear20: false,
            input20: false,
            disappear21: false,
            input21: false,
            disappear22: false,
            input22: false,
            disappear23: false,
            input23: false,
            disappear24: false,
            input24: false,
            disappear25: false,
            input25: false,
            disappear26: false,
            

            file1: null,
            file2: null,
            file3: null,
            file4: null,
            file5: null,
            file6: null,
            file7: null,
            file8: null,
            file9: null,
            file10: null,
            file11: null,
            file12: null,
            file13: null,
            file14: null,
            file15: null,
            file16: null,
            file17: null,
            file18: null,
            file19: null,
            file20: null,
            file21: null,
            file22: null,
            file23: null,
            file24: null,
            file25: null,

            fields: {
                slug: "",
                image_1: "",
                image_2: "",
                image_3: "",
                image_4: "",
                image_5: "",
                image_6: "",
                image_7: "",
                image_8: "",
                image_9: "",
                image_10: "",
                image_11: "",
                image_12: "",
                image_13: "",
                image_14: "",
                image_15: "",
                image_16: "",
                image_17: "",
                image_18: "",
                image_19: "",
                image_20: "",
                image_21: "",
                image_22: "",
                image_23: "",
                image_24: "",
                image_25: "",
                product_name: "",
                product_category: "",
                product_sub_category: "",
                product_description_1: "",
                product_description_2: "",
                product_description_3: "",
                product_description_4: "",
                product_description_5: "",
                product_description_6: "",
                product_description_7: "",
                product_more_info: "",
                size: "",
                gender: "",
                color: "",
                location: "",
                availability: "",
                contact: "",
                product_price: "",
                product_discount: "",
                product_service: "",
                selectedCategory: "",
                name: "",
            },
            marketcategories: {},
            marketsubcategories: {},
            selectedCategory: "",
            name: "",

            fields: {
                //category_id: '',
            },
            success: false,
            errors: {},
            url1: "",
            url2: "",
            url3: "",
            url4: "",
            url5: "",
            url6: "",
            url7: "",
            url8: "",
            url9: "",
            url10: "",
            url11: "",
            url12: "",
            url13: "",
            url14: "",
            url15: "",
            url16: "",
            url17: "",
            url18: "",
            url19: "",
            url20: "",
            url21: "",
            url22: "",
            url23: "",
            url24: "",
            url25: "",

            markets: [],
            title: "",
            links: [],
            phone: "",
            locations: {},
            isSubmitting: false,

            // id: "",
            // name: "",
        };
    },

    methods: {
        nextStep() {
            this.step++;
        },
        prevStep() {
            this.step--;
        },

        showInput2() {
            this.disappear2 = false;
            this.disappear3 = true;
            this.input2 = 2;
        },
        showInput3() {
            this.disappear2 = false;
            this.disappear3 = false;
            this.disappear4 = true;
            this.input2 = 2;
            this.input3 = 3;
        },
        showInput4() {
            this.disappear2 = false;
            this.disappear3 = false;
            this.disappear4 = false;
            this.disappear5 = true;
            this.input2 = 2;
            this.input3 = 3;
            this.input4 = 4;
        },
        showInput5() {
            this.disappear2 = false;
            this.disappear3 = false;
            this.disappear4 = false;
            this.disappear5 = false;
            this.disappear6 = true;
            this.input2 = 2;
            this.input3 = 3;
            this.input4 = 4;
            this.input5 = 5;
        },
        showInput6() {
            this.disappear2 = false;
            this.disappear3 = false;
            this.disappear4 = false;
            this.disappear5 = false;
            this.disappear6 = false;
            this.disappear7 = true;
            this.input2 = 2;
            this.input3 = 3;
            this.input4 = 4;
            this.input5 = 5;
            this.input6 = 6;
        },
        showInput7() {
            this.disappear2 = false;
            this.disappear3 = false;
            this.disappear4 = false;
            this.disappear5 = false;
            this.disappear6 = false;
            this.disappear7 = false;
            this.disappear8 = true;
            this.input2 = 2;
            this.input3 = 3;
            this.input4 = 4;
            this.input5 = 5;
            this.input6 = 6;
            this.input7 = 7;
            this.input8 = 8;
        },

        showInput8() {
            this.disappear2 = false;
            this.disappear3 = false;
            this.disappear4 = false;
            this.disappear5 = false;
            this.disappear6 = false;
            this.disappear7 = false;
            this.disappear8 = false;
            this.disappear9 = true;
            this.input2 = 2;
            this.input3 = 3;
            this.input4 = 4;
            this.input5 = 5;
            this.input6 = 6;
            this.input7 = 7;
            this.input8 = 8;
            this.input9 = 9;
        },

        showInput9() {
            this.disappear2 = false;
            this.disappear3 = false;
            this.disappear4 = false;
            this.disappear5 = false;
            this.disappear6 = false;
            this.disappear7 = false;
            this.disappear8 = false;
            this.disappear9 = false;
            this.disappear10 = true;
            this.input2 = 2;
            this.input3 = 3;
            this.input4 = 4;
            this.input5 = 5;
            this.input6 = 6;
            this.input7 = 7;
            this.input8 = 8;
            this.input9 = 9;
            this.input10 = 10;
        },

        showInput10() {
            this.disappear2 = false;
            this.disappear3 = false;
            this.disappear4 = false;
            this.disappear5 = false;
            this.disappear6 = false;
            this.disappear7 = false;
            this.disappear8 = false;
            this.disappear9 = false;
            this.disappear10 = false;
            this.disappear11 = true;
            this.input2 = 2;
            this.input3 = 3;
            this.input4 = 4;
            this.input5 = 5;
            this.input6 = 6;
            this.input7 = 7;
            this.input8 = 8;
            this.input9 = 9;
            this.input10 = 10;
            this.input11 = 11;
        },

        showInput11() {
            this.disappear2 = false;
            this.disappear3 = false;
            this.disappear4 = false;
            this.disappear5 = false;
            this.disappear6 = false;
            this.disappear7 = false;
            this.disappear8 = false;
            this.disappear9 = false;
            this.disappear10 = false;
            this.disappear11 = false;
            this.disappear12 = true;
            this.input2 = 2;
            this.input3 = 3;
            this.input4 = 4;
            this.input5 = 5;
            this.input6 = 6;
            this.input7 = 7;
            this.input8 = 8;
            this.input9 = 9;
            this.input10 = 10;
            this.input11 = 11;
            this.input12 = 12;
        },

        showInput12() {
            this.disappear2 = false;
            this.disappear3 = false;
            this.disappear4 = false;
            this.disappear5 = false;
            this.disappear6 = false;
            this.disappear7 = false;
            this.disappear8 = false;
            this.disappear9 = false;
            this.disappear10 = false;
            this.disappear11 = false;
            this.disappear12 = false;
            this.disappear13 = true;
            this.input2 = 2;
            this.input3 = 3;
            this.input4 = 4;
            this.input5 = 5;
            this.input6 = 6;
            this.input7 = 7;
            this.input8 = 8;
            this.input9 = 9;
            this.input10 = 10;
            this.input11 = 11;
            this.input12 = 12;
            this.input13 = 13;
        },

        showInput13() {
            this.disappear2 = false;
            this.disappear3 = false;
            this.disappear4 = false;
            this.disappear5 = false;
            this.disappear6 = false;
            this.disappear7 = false;
            this.disappear8 = false;
            this.disappear9 = false;
            this.disappear10 = false;
            this.disappear11 = false;
            this.disappear12 = false;
            this.disappear13 = false;
            this.disappear14 = true;
            this.input2 = 2;
            this.input3 = 3;
            this.input4 = 4;
            this.input5 = 5;
            this.input6 = 6;
            this.input7 = 7;
            this.input8 = 8;
            this.input9 = 9;
            this.input10 = 10;
            this.input11 = 11;
            this.input12 = 12;
            this.input13 = 13;
            this.input14 = 14;
        },

        showInput14() {
            this.disappear2 = false;
            this.disappear3 = false;
            this.disappear4 = false;
            this.disappear5 = false;
            this.disappear6 = false;
            this.disappear7 = false;
            this.disappear8 = false;
            this.disappear9 = false;
            this.disappear10 = false;
            this.disappear11 = false;
            this.disappear12 = false;
            this.disappear13 = false;
            this.disappear14 = false;
            this.disappear15 = true;
            this.input2 = 2;
            this.input3 = 3;
            this.input4 = 4;
            this.input5 = 5;
            this.input6 = 6;
            this.input7 = 7;
            this.input8 = 8;
            this.input9 = 9;
            this.input10 = 10;
            this.input11 = 11;
            this.input12 = 12;
            this.input13 = 13;
            this.input14 = 14;
            this.input15 = 15;
        },

        showInput15() {
            this.disappear2 = false;
            this.disappear3 = false;
            this.disappear4 = false;
            this.disappear5 = false;
            this.disappear6 = false;
            this.disappear7 = false;
            this.disappear8 = false;
            this.disappear9 = false;
            this.disappear10 = false;
            this.disappear11 = false;
            this.disappear12 = false;
            this.disappear13 = false;
            this.disappear14 = false;
            this.disappear15 = false;
            this.disappear16 = true;
            this.input2 = 2;
            this.input3 = 3;
            this.input4 = 4;
            this.input5 = 5;
            this.input6 = 6;
            this.input7 = 7;
            this.input8 = 8;
            this.input9 = 9;
            this.input10 = 10;
            this.input11 = 11;
            this.input12 = 12;
            this.input13 = 13;
            this.input14 = 14;
            this.input15 = 15;
            this.input16 = 16;
        },

        showInput16() {
            this.disappear2 = false;
            this.disappear3 = false;
            this.disappear4 = false;
            this.disappear5 = false;
            this.disappear6 = false;
            this.disappear7 = false;
            this.disappear8 = false;
            this.disappear9 = false;
            this.disappear10 = false;
            this.disappear11 = false;
            this.disappear12 = false;
            this.disappear13 = false;
            this.disappear14 = false;
            this.disappear15 = false;
            this.disappear16 = false;
            this.disappear17 = true;
            this.input2 = 2;
            this.input3 = 3;
            this.input4 = 4;
            this.input5 = 5;
            this.input6 = 6;
            this.input7 = 7;
            this.input8 = 8;
            this.input9 = 9;
            this.input10 = 10;
            this.input11 = 11;
            this.input12 = 12;
            this.input13 = 13;
            this.input14 = 14;
            this.input15 = 15;
            this.input16 = 16;
            this.input17 = 17;
        },

        showInput17() {
            this.disappear2 = false;
            this.disappear3 = false;
            this.disappear4 = false;
            this.disappear5 = false;
            this.disappear6 = false;
            this.disappear7 = false;
            this.disappear8 = false;
            this.disappear9 = false;
            this.disappear10 = false;
            this.disappear11 = false;
            this.disappear12 = false;
            this.disappear13 = false;
            this.disappear14 = false;
            this.disappear15 = false;
            this.disappear16 = false;
            this.disappear17 = false;
            this.disappear18 = true;
            this.input2 = 2;
            this.input3 = 3;
            this.input4 = 4;
            this.input5 = 5;
            this.input6 = 6;
            this.input7 = 7;
            this.input8 = 8;
            this.input9 = 9;
            this.input10 = 10;
            this.input11 = 11;
            this.input12 = 12;
            this.input13 = 13;
            this.input14 = 14;
            this.input15 = 15;
            this.input16 = 16;
            this.input17 = 17;
            this.input18 = 18;
        },

        showInput18() {
            this.disappear2 = false;
            this.disappear3 = false;
            this.disappear4 = false;
            this.disappear5 = false;
            this.disappear6 = false;
            this.disappear7 = false;
            this.disappear8 = false;
            this.disappear9 = false;
            this.disappear10 = false;
            this.disappear11 = false;
            this.disappear12 = false;
            this.disappear13 = false;
            this.disappear14 = false;
            this.disappear15 = false;
            this.disappear16 = false;
            this.disappear17 = false;
            this.disappear18 = false;
            this.disappear19 = true;
            this.input2 = 2;
            this.input3 = 3;
            this.input4 = 4;
            this.input5 = 5;
            this.input6 = 6;
            this.input7 = 7;
            this.input8 = 8;
            this.input9 = 9;
            this.input10 = 10;
            this.input11 = 11;
            this.input12 = 12;
            this.input13 = 13;
            this.input14 = 14;
            this.input15 = 15;
            this.input16 = 16;
            this.input17 = 17;
            this.input18 = 18;
            this.input19 = 19;
        },

        showInput19() {
            this.disappear2 = false;
            this.disappear3 = false;
            this.disappear4 = false;
            this.disappear5 = false;
            this.disappear6 = false;
            this.disappear7 = false;
            this.disappear8 = false;
            this.disappear9 = false;
            this.disappear10 = false;
            this.disappear11 = false;
            this.disappear12 = false;
            this.disappear13 = false;
            this.disappear14 = false;
            this.disappear15 = false;
            this.disappear16 = false;
            this.disappear17 = false;
            this.disappear18 = false;
            this.disappear19 = false;
            this.disappear20 = true;
            this.input2 = 2;
            this.input3 = 3;
            this.input4 = 4;
            this.input5 = 5;
            this.input6 = 6;
            this.input7 = 7;
            this.input8 = 8;
            this.input9 = 9;
            this.input10 = 10;
            this.input11 = 11;
            this.input12 = 12;
            this.input13 = 13;
            this.input14 = 14;
            this.input15 = 15;
            this.input16 = 16;
            this.input17 = 17;
            this.input18 = 18;
            this.input19 = 19;
            this.input20 = 20;
        },

        showInput20() {
            this.disappear2 = false;
            this.disappear3 = false;
            this.disappear4 = false;
            this.disappear5 = false;
            this.disappear6 = false;
            this.disappear7 = false;
            this.disappear8 = false;
            this.disappear9 = false;
            this.disappear10 = false;
            this.disappear11 = false;
            this.disappear12 = false;
            this.disappear13 = false;
            this.disappear14 = false;
            this.disappear15 = false;
            this.disappear16 = false;
            this.disappear17 = false;
            this.disappear18 = false;
            this.disappear19 = false;
            this.disappear20 = false;
            this.disappear21 = true;
            this.input2 = 2;
            this.input3 = 3;
            this.input4 = 4;
            this.input5 = 5;
            this.input6 = 6;
            this.input7 = 7;
            this.input8 = 8;
            this.input9 = 9;
            this.input10 = 10;
            this.input11 = 11;
            this.input12 = 12;
            this.input13 = 13;
            this.input14 = 14;
            this.input15 = 15;
            this.input16 = 16;
            this.input17 = 17;
            this.input18 = 18;
            this.input19 = 19;
            this.input20 = 20;
            this.input21 = 21;
        },

        showInput21() {
            this.disappear2 = false;
            this.disappear3 = false;
            this.disappear4 = false;
            this.disappear5 = false;
            this.disappear6 = false;
            this.disappear7 = false;
            this.disappear8 = false;
            this.disappear9 = false;
            this.disappear10 = false;
            this.disappear11 = false;
            this.disappear12 = false;
            this.disappear13 = false;
            this.disappear14 = false;
            this.disappear15 = false;
            this.disappear16 = false;
            this.disappear17 = false;
            this.disappear18 = false;
            this.disappear19 = false;
            this.disappear20 = false;
            this.disappear21 = false;
            this.disappear22 = true;
            this.input2 = 2;
            this.input3 = 3;
            this.input4 = 4;
            this.input5 = 5;
            this.input6 = 6;
            this.input7 = 7;
            this.input8 = 8;
            this.input9 = 9;
            this.input10 = 10;
            this.input11 = 11;
            this.input12 = 12;
            this.input13 = 13;
            this.input14 = 14;
            this.input15 = 15;
            this.input16 = 16;
            this.input17 = 17;
            this.input18 = 18;
            this.input19 = 19;
            this.input20 = 20;
            this.input21 = 21;
            this.input22 = 22;
        },

        showInput22() {
            this.disappear2 = false;
            this.disappear3 = false;
            this.disappear4 = false;
            this.disappear5 = false;
            this.disappear6 = false;
            this.disappear7 = false;
            this.disappear8 = false;
            this.disappear9 = false;
            this.disappear10 = false;
            this.disappear11 = false;
            this.disappear12 = false;
            this.disappear13 = false;
            this.disappear14 = false;
            this.disappear15 = false;
            this.disappear16 = false;
            this.disappear17 = false;
            this.disappear18 = false;
            this.disappear19 = false;
            this.disappear20 = false;
            this.disappear21 = false;
            this.disappear22 = false;
            this.disappear23 = true;
            this.input2 = 2;
            this.input3 = 3;
            this.input4 = 4;
            this.input5 = 5;
            this.input6 = 6;
            this.input7 = 7;
            this.input8 = 8;
            this.input9 = 9;
            this.input10 = 10;
            this.input11 = 11;
            this.input12 = 12;
            this.input13 = 13;
            this.input14 = 14;
            this.input15 = 15;
            this.input16 = 16;
            this.input17 = 17;
            this.input18 = 18;
            this.input19 = 19;
            this.input20 = 20;
            this.input21 = 21;
            this.input22 = 22;
            this.input23 = 23;
        },

        showInput23() {
            this.disappear2 = false;
            this.disappear3 = false;
            this.disappear4 = false;
            this.disappear5 = false;
            this.disappear6 = false;
            this.disappear7 = false;
            this.disappear8 = false;
            this.disappear9 = false;
            this.disappear10 = false;
            this.disappear11 = false;
            this.disappear12 = false;
            this.disappear13 = false;
            this.disappear14 = false;
            this.disappear15 = false;
            this.disappear16 = false;
            this.disappear17 = false;
            this.disappear18 = false;
            this.disappear19 = false;
            this.disappear20 = false;
            this.disappear21 = false;
            this.disappear22 = false;
            this.disappear23 = false;
            this.disappear24 = true;
            this.input2 = 2;
            this.input3 = 3;
            this.input4 = 4;
            this.input5 = 5;
            this.input6 = 6;
            this.input7 = 7;
            this.input8 = 8;
            this.input9 = 9;
            this.input10 = 10;
            this.input11 = 11;
            this.input12 = 12;
            this.input13 = 13;
            this.input14 = 14;
            this.input15 = 15;
            this.input16 = 16;
            this.input17 = 17;
            this.input18 = 18;
            this.input19 = 19;
            this.input20 = 20;
            this.input21 = 21;
            this.input22 = 22;
            this.input23 = 23;
            this.input24 = 24;
        },

        showInput24() {
            this.disappear2 = false;
            this.disappear3 = false;
            this.disappear4 = false;
            this.disappear5 = false;
            this.disappear6 = false;
            this.disappear7 = false;
            this.disappear8 = false;
            this.disappear9 = false;
            this.disappear10 = false;
            this.disappear11 = false;
            this.disappear12 = false;
            this.disappear13 = false;
            this.disappear14 = false;
            this.disappear15 = false;
            this.disappear16 = false;
            this.disappear17 = false;
            this.disappear18 = false;
            this.disappear19 = false;
            this.disappear20 = false;
            this.disappear21 = false;
            this.disappear22 = false;
            this.disappear23 = false;
            this.disappear24 = false;
            this.disappear25 = true;
            this.input2 = 2;
            this.input3 = 3;
            this.input4 = 4;
            this.input5 = 5;
            this.input6 = 6;
            this.input7 = 7;
            this.input8 = 8;
            this.input9 = 9;
            this.input10 = 10;
            this.input11 = 11;
            this.input12 = 12;
            this.input13 = 13;
            this.input14 = 14;
            this.input15 = 15;
            this.input16 = 16;
            this.input17 = 17;
            this.input18 = 18;
            this.input19 = 19;
            this.input20 = 20;
            this.input21 = 21;
            this.input22 = 22;
            this.input23 = 23;
            this.input24 = 24;
            this.input25 = 25;
        },

        showInput25() {
            this.disappear2 = false;
            this.disappear3 = false;
            this.disappear4 = false;
            this.disappear5 = false;
            this.disappear6 = false;
            this.disappear7 = false;
            this.disappear8 = false;
            this.disappear9 = false;
            this.disappear10 = false;
            this.disappear11 = false;
            this.disappear12 = false;
            this.disappear13 = false;
            this.disappear14 = false;
            this.disappear15 = false;
            this.disappear16 = false;
            this.disappear17 = false;
            this.disappear18 = false;
            this.disappear19 = false;
            this.disappear20 = false;
            this.disappear21 = false;
            this.disappear22 = false;
            this.disappear23 = false;
            this.disappear24 = false;
            this.disappear25 = false;
            this.disappear26 = true;
            this.input2 = 2;
            this.input3 = 3;
            this.input4 = 4;
            this.input5 = 5;
            this.input6 = 6;
            this.input7 = 7;
            this.input8 = 8;
            this.input9 = 9;
            this.input10 = 10;
            this.input11 = 11;
            this.input12 = 12;
            this.input13 = 13;
            this.input14 = 14;
            this.input15 = 15;
            this.input16 = 16;
            this.input17 = 17;
            this.input18 = 18;
            this.input19 = 19;
            this.input20 = 20;
            this.input21 = 21;
            this.input22 = 22;
            this.input23 = 23;
            this.input24 = 24;
            this.input25 = 25;
            this.input26 = 26;
        },

        grabFile1(event) {
            this.fields.file1 = event.target.files[0];
            this.url1 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        grabFile2(event) {
            this.fields.file2 = event.target.files[0];
            this.url2 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        grabFile3(event) {
            this.fields.file3 = event.target.files[0];
            this.url3 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        grabFile4(event) {
            this.fields.file4 = event.target.files[0];
            this.url4 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        grabFile5(event) {
            this.fields.file5 = event.target.files[0];
            this.url5 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        grabFile6(event) {
            this.fields.file6 = event.target.files[0];
            this.url6 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        grabFile7(event) {
            this.fields.file7 = event.target.files[0];
            this.url7 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        grabFile8(event) {
            this.fields.file8 = event.target.files[0];
            this.url8 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        grabFile9(event) {
            this.fields.file9 = event.target.files[0];
            this.url9 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        grabFile10(event) {
            this.fields.file10 = event.target.files[0];
            this.url10 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        grabFile11(event) {
            this.fields.file11 = event.target.files[0];
            this.url11 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        grabFile12(event) {
            this.fields.file12 = event.target.files[0];
            this.url12 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        grabFile13(event) {
            this.fields.file13 = event.target.files[0];
            this.url13 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        grabFile14(event) {
            this.fields.file14 = event.target.files[0];
            this.url14 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        grabFile15(event) {
            this.fields.file15 = event.target.files[0];
            this.url15 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        grabFile16(event) {
            this.fields.file16 = event.target.files[0];
            this.url16 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        grabFile17(event) {
            this.fields.file17 = event.target.files[0];
            this.url17 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        grabFile18(event) {
            this.fields.file18 = event.target.files[0];
            this.url18 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        grabFile19(event) {
            this.fields.file19 = event.target.files[0];
            this.url19 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        grabFile20(event) {
            this.fields.file20 = event.target.files[0];
            this.url20 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        grabFile21(event) {
            this.fields.file21 = event.target.files[0];
            this.url21 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        grabFile22(event) {
            this.fields.file22 = event.target.files[0];
            this.url22 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        grabFile23(event) {
            this.fields.file23 = event.target.files[0];
            this.url23 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        grabFile24(event) {
            this.fields.file24 = event.target.files[0];
            this.url24 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        grabFile25(event) {
            this.fields.file25 = event.target.files[0];
            this.url25 = URL.createObjectURL(event.target.files[0]);
            URL.revokeObjectURL(event.target.files[0]);
        },

        submit() {
            this.isSubmitting = true;
            const fd = new FormData();
            fd.append("product_name", this.fields.product_name);
            fd.append("product_category", this.fields.product_category);
            fd.append("product_sub_category", this.fields.product_sub_category);
            fd.append(
                "product_description_1",
                this.fields.product_description_1
            );
            fd.append(
                "product_description_2",
                this.fields.product_description_2
            );
            fd.append(
                "product_description_3",
                this.fields.product_description_3
            );
            fd.append(
                "product_description_4",
                this.fields.product_description_4
            );
            fd.append(
                "product_description_5",
                this.fields.product_description_5
            );
            fd.append(
                "product_description_6",
                this.fields.product_description_6
            );
            fd.append(
                "product_description_7",
                this.fields.product_description_7
            );
            fd.append("product_more_info", this.fields.product_more_info);
            fd.append("size", this.fields.size);
            fd.append("gender", this.fields.gender);
            fd.append("color", this.fields.color);
            fd.append("location", this.fields.location);
            fd.append("availability", this.fields.availability);
            fd.append("contact", this.fields.contact);
            fd.append("product_price", this.fields.product_price);
            fd.append("product_discount", this.fields.product_discount);
            fd.append("product_service", this.fields.product_service);
            fd.append("file1", this.fields.file1);
            fd.append("file2", this.fields.file2);
            fd.append("file3", this.fields.file3);
            fd.append("file4", this.fields.file4);
            fd.append("file5", this.fields.file5);
            fd.append("file6", this.fields.file6);
            fd.append("file7", this.fields.file7);
            fd.append("file8", this.fields.file8);
            fd.append("file9", this.fields.file9);
            fd.append("file10", this.fields.file10);
            fd.append("file11", this.fields.file11);
            fd.append("file12", this.fields.file12);
            fd.append("file13", this.fields.file13);
            fd.append("file14", this.fields.file14);
            fd.append("file15", this.fields.file15);
            fd.append("file16", this.fields.file16);
            fd.append("file17", this.fields.file17);
            fd.append("file18", this.fields.file18);
            fd.append("file19", this.fields.file19);
            fd.append("file20", this.fields.file20);
            fd.append("file21", this.fields.file21);
            fd.append("file22", this.fields.file22);
            fd.append("file23", this.fields.file23);
            fd.append("file24", this.fields.file24);
            fd.append("file25", this.fields.file25);

            fd.append("_method", "POST");

            axios
                .post("/api/markets", fd, {
                    headers: { "content-type": "multipart/form-data" },
                })
                .then(() => {
                    this.fields = {};
                    this.url1 = null;
                    this.url2 = null;
                    this.url3 = null;
                    this.url4 = null;
                    this.url5 = null;
                    this.url6 = null;
                    this.url7 = null;
                    this.url8 = null;
                    this.url9 = null;
                    this.url10 = null;
                    this.url11 = null;
                    this.url12 = null;
                    this.url13 = null;
                    this.url14 = null;
                    this.url15 = null;
                    this.url16 = null;
                    this.url17 = null;
                    this.url18 = null;
                    this.url19 = null;
                    this.url20 = null;
                    this.url21 = null;
                    this.url22 = null;
                    this.url23 = null;
                    this.url24 = null;
                    this.url25 = null;
                    this.fields.selectedCategory = "";
                    this.success = true;
                    this.errors = {};

                    let timerInterval;
                    Swal.fire({
                        title: "Processing",
                        html: " ",
                        timer: 1000,
                        timerProgressBar: true,

                        didOpen: () => {
                            Swal.showLoading();
                            const b =
                                Swal.getHtmlContainer().querySelector("b");
                            timerInterval = setInterval(() => {
                                if (b) {
                                    b.textContent = Swal.getTimerLeft();
                                }
                            }, 100);
                        },
                        willClose: () => {
                            clearInterval(timerInterval);
                        },
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            this.isSubmitting = true;
                            console.log("All is well");
                            this.$router.push({ name: "Market" });
                            this.isSubmitting = true;
                        }
                    });

                    setTimeout(() => {
                        this.success = false;
                    }, 2500);
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    this.success = false;
                    this.isSubmitting = false;
                });
        },
    },

    watch: {
        selectedCategory: function (arg) {
            axios
                .get("/api/marketsubcategories?name=" + this.selectedCategory)
                .then((response) => {
                    console.log(response.data);
                    this.marketsubcategories = response.data.data;
                });
        },
    },

    mounted() {
        axios
            .get("/api/user")
            .then((response) => {
                this.id = response.data.id;
                this.name = response.data.name;
                this.phone = response.data.phone;
            })
            .catch((error) => {
                if (error.response.status === 401) {
                    this.$emit("updateSidebar");
                    localStorage.removeItem("authenticated");
                    this.$router.push({ name: "Login" });
                }
            });

        axios.get("/api/marketcategories").then((response) => {
            this.marketcategories = response.data.data;
        });

        axios.get("/api/locations").then((response) => {
            this.locations = response.data.data;
        });
    },

    computed: {
        prodName: {
            get() {
                return this.fields.product_name;
            },
            set(value) {
                this.fields.product_name = value;
            },
        },

        prodCat: {
            get() {
                return (this.fields.product_category = this.selectedCategory);
            },
            set(value) {
                this.fields.product_category = value;
            },
        },

        prodSubCat: {
            get() {
                return (this.fields.product_sub_category =
                    this.selectedSubCategory);
            },
            set(value) {
                this.fields.product_sub_category = value;
            },
        },

        selectedSubCategory: {
            get() {
                return this.fields.product_sub_category;
            },
            set(value) {
                this.fields.product_sub_category = value;
            },
        },

        prodDesc1: {
            get() {
                return this.fields.product_description_1;
            },
            set(value) {
                this.fields.product_description_1 = value;
            },
        },

        prodDesc2: {
            get() {
                return this.fields.product_description_2;
            },
            set(value) {
                this.fields.product_description_2 = value;
            },
        },

        prodDesc3: {
            get() {
                return this.fields.product_description_3;
            },
            set(value) {
                this.fields.product_description_3 = value;
            },
        },

        prodDesc4: {
            get() {
                return this.fields.product_description_4;
            },
            set(value) {
                this.fields.product_description_4 = value;
            },
        },

        prodDesc5: {
            get() {
                return this.fields.product_description_5;
            },
            set(value) {
                this.fields.product_description_5 = value;
            },
        },

        prodDesc6: {
            get() {
                return this.fields.product_description_6;
            },
            set(value) {
                this.fields.product_description_6 = value;
            },
        },

        prodDesc7: {
            get() {
                return this.fields.product_description_7;
            },
            set(value) {
                this.fields.product_description_7 = value;
            },
        },

        prodMoreInfo: {
            get() {
                return this.fields.product_more_info;
            },
            set(value) {
                this.fields.product_more_info = value;
            },
        },

        prodSize: {
            get() {
                return this.fields.size;
            },
            set(value) {
                this.fields.size = value;
            },
        },

        prodGender: {
            get() {
                return this.fields.gender;
            },
            set(value) {
                this.fields.gender = value;
            },
        },

        prodColor: {
            get() {
                return this.fields.color;
            },
            set(value) {
                this.fields.color = value;
            },
        },

        prodLocation: {
            get() {
                return this.fields.location;
            },
            set(value) {
                this.fields.location = value;
            },
        },

        prodAvail: {
            get() {
                return this.fields.availability;
            },
            set(value) {
                this.fields.availability = value;
            },
        },

        prodContact: {
            get() {
                return this.fields.contact;
            },
            set(value) {
                this.fields.contact = value;
            },
        },

        prodPrice: {
            get() {
                return this.fields.product_price;
            },
            set(value) {
                this.fields.product_price = value;
            },
        },

        prodDiscount: {
            get() {
                return this.fields.product_discount;
            },
            set(value) {
                this.fields.product_discount = value;
            },
        },

        prodService: {
            get() {
                return this.fields.product_service;
            },
            set(value) {
                this.fields.product_service = value;
            },
        },

        slugValue: {
            get() {
                let result = "";
                let characters =
                    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
                let charactersLength = characters.length;
                for (let i = 0; i < 100; i++) {
                    result += characters.charAt(
                        Math.floor(Math.random() * charactersLength)
                    );
                }
                return (this.fields.slug =
                    result + "-" + this.fields.product_name);
            },
            set(value) {
                this.fields.slug = value;
            },
        },
    },
};
</script>

<style scoped></style>
