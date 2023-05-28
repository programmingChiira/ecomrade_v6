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
                                    <li class="breadcrumb-item"><router-link to="/blog">Blog</router-link></li>
                                    <li style="color: #189483;" class="breadcrumb-item"><strong>{{ club.name }}
                                            Articles</strong></li>
                                </ol>
                            </div>
                        </nav>
                    </div>
                </div>

                <div class="container2">
                    <div style="background-color: #E9ECEF;" class="card" v-for="post in posts" :key="post.id"
                        v-show="post.club_id == club.id">
                        <div class="card__header">
                            <img style="background-color: white;width: 100%;height: 200px; object-fit: cover;"
                                v-if="post.image_1 == false || post.image_1 == null || post.image_1 == 'null' || post.image_1 == '' || post.image_1 == ' ' || post.image_1 == NULL"
                                loading="lazy" src="/web/img/no_img.jpg" class="card__image" width="600">

                            <img v-else style="background-color: white;width: 100%;height: 200px; object-fit: cover;"
                                :src="'./img/blog/' + post.image_1" class="card__image" width="600">

                        </div>
                        <div class="card__body">
                            <span class="tag tag-blue">{{ post.post_category }}</span>
                            <h4>{{ post.title }}</h4>
                            <p>" {{ truncateText(post.body) }} "</p>
                        </div>
                        <div class="card__footer">
                            <div class="user">
                                <div class="user__info">
                                    <h5>Written By {{ post.user_name }}</h5>
                                    <small> {{ post.created_at }} </small>
                                </div>
                            </div>
                        </div>


                        <div class="d-flex flex-row justify-content-between mb-0 px-3">
                            <span style="margin: 3px;" class="badge bg-dark ">
                                <i class="fa fa-comments-o"></i> {{ post.rating_count }}
                            </span>
                        </div>

                        <br />

                        <div class="d-flex flex-row justify-content-between mb-0 px-3">
                            <button v-if="post.user_id == id" type="button" @click="destroy(post.id)" class="delete-btn"
                                style="float: left;border:none;outline:none;background: none;">
                                <i class="fa fa-trash-o" style="color: red;"></i>
                            </button>

                            <router-link class="btn bg-gradient-primary btn-sm" :to="{
                                name: 'ViewBlog',
                                params: { slug: post.slug },
                            }">VIEW </router-link>

                            <router-link style="float: right;" v-if="post.user_id == id" :to="{
                                name: 'EditBlog',
                                params: { slug: post.slug },
                            }"><i class="fa fa-edit" style="color:#189483;"></i>
                            </router-link>
                        </div>
                        <br />
                    </div>
                    <h5 style="text-align: left;" v-if="!posts.length">Sorry, no item found!</h5>
                </div>

            </div>
            <hr class="horizontal dark my-5">
        </section>

        <Footer />
    </body>
</template>

<script>
import Footer from './Footer.vue';
import Loader from './Loader.vue';
export default {
    components: {
        Footer,
        Loader,
    },
    emits: ["updateSidebar"],
    props: ["slug"],
    data() {
        return {

            showInput: 0,

            disappear2: true,
            input2: false,
            disappear3: false,
            input3: false,
            disappear4: false,
            input4: false,
            disappear5: false,
            input5: false,

            file1: null,
            file2: null,
            file3: null,
            file4: null,

            club: {},
            success: false,
            fields: {
                post_category: "",
            },
            errors: {},
            url1: "",
            url2: "",
            url3: "",
            url4: "",
            url5: "",
            categories: [],

            id: "",
            name: "",

            posts: [],
            currentPage: 1,
            lastPage: 1,

            title: '',
            searchResults: [],
            //market: {},

            success: false,
            errors: {},
            url: "",
            user_id: "",
            links: [],
        };
    },

    created() {
        this.postName(this.currentPage);
    },

    computed: {
        clubId: {
            get() {
                return this.club.id;
            },
            set(value) {
                this.club.id = value;
            }
        },

        clubName: {
            get() {
                return this.club.name;
            },
            set(value) {
                this.club.name = value;
            }
        },

        marketName: {
            get() {
                return this.fields.title = this.market.title;
            },
            set(value) {
                this.fields.title = value;
            }
        },
    },
    methods: {

        truncateText(posts) {
            const truncatedText = posts.slice(0, 40) + '...'
            return truncatedText
        },

        searchpost() {
            if (this.title.length > 2) {

                axios.get('/api/searchpost', { params: { q: this.title } })
                    .then(response => {
                        this.searchResults = response.data;
                    });
            } else {
                this.searchResults = [];
            }
        },

        selectItem(item) {
            this.title = item.title;
            this.searchResults = [];
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
            this.input2 = 2;
            this.input3 = 3;
            this.input4 = 4;
            this.input5 = 5;
            this.input6 = 6;
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

        submit() {
            const fd = new FormData();
            fd.append("title", this.fields.title);
            fd.append("post_category", this.fields.post_category);
            fd.append("body", this.fields.body);
            fd.append("club_id", this.clubId);
            fd.append("club_name", this.clubName);
            fd.append("file1", this.fields.file1);
            fd.append("file2", this.fields.file2);
            fd.append("file3", this.fields.file3);
            fd.append("file4", this.fields.file4);
            fd.append("file5", this.fields.file5);


            fd.append("_method", "POST");


            axios
                .post("/api/club_posts", fd, {
                    headers: { "content-type": "multipart/form-data" },
                })
                .then(() => {
                    this.fields = {};
                    this.url1 = null;
                    this.url2 = null;
                    this.url3 = null;
                    this.url4 = null;
                    this.url5 = null;
                    this.success = true;
                    this.errors = {};

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
                            this.$router.push({ name: "Post" });
                        }
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

        postName(page) {
            axios
                .get('/api/posts?page=' + page, {
                    params: {
                        search: this.title,
                    },
                })
                .then((response) => {
                    this.posts = response.data.data;
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
                .get("/api/posts", {
                    params: {
                        page: page,
                        search: this.title,
                    },
                })
                .then((response) => {
                    this.posts = response.data.data;
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
                    this.$router.push({ name: "Login" });
                }
            });

        axios
            .get("/api/clubs/" + this.slug)
            .then(response => {
                this.club = response.data.data;
                this.messageCount = response.data.message_count;
            })
            .catch((error) => {
                console.log(error);
            });

        axios
            .get("/api/categories")
            .then((response) => (this.categories = response.data))
            .catch((error) => {
                console.log(error);
            });

    },
};
</script>

<style scoped>
.container2 {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin-block: 2rem;
    gap: 2rem;
}

img {
    max-width: 100%;
    display: block;
    object-fit: cover;
}

.card {
    display: flex;
    flex-direction: column;
    width: clamp(20rem, calc(20rem + 2vw), 22rem);
    overflow: hidden;
    box-shadow: 0 .1rem 1rem rgba(0, 0, 0, 0.1);
    border-radius: 1em;
}



.card__body {
    padding: 1rem;
    display: flex;
    flex-direction: column;
    gap: .5rem;
}


.tag {
    align-self: flex-start;
    padding: .25em .75em;
    border-radius: 1em;
    font-size: .75rem;
}

.tag+.tag {
    margin-left: .5em;
}

.tag-blue {
    background: #56CCF2;
    background: linear-gradient(to bottom, #2F80ED, #56CCF2);
    color: #fafafa;
}

.card__body h4 {
    font-size: 1.5rem;
    text-transform: capitalize;
}

.card__footer {
    display: flex;
    padding: 1rem;
    margin-top: auto;
}
</style>