<template>
    <div class="pt-5">
        <div class="container">
            <div class="row  justify-content-center">
                <div class="col-md-12">
                    <a href="https://twitter.com/intent/tweet?text=ecormade,%20a%20hub%20for%20Kenyan%20comrades,%20rentals,%20market.%20%23comrade%20%23university%20%23ecommerce&url=https%3A%2F%2Fwww.ecomrade.co.ke" class="btn btn-info mb-0 me-2" target="_blank">
                        <i class="fab fa-twitter me-1"></i> Tweet
                    </a>
                    <a style="background-color: #3b5998;" href="https://www.facebook.com/sharer/sharer.php?u=https://www.ecomrade.co.ke" class="btn btn-primary mb-0 me-2" target="_blank">
                        <i class="fab fa-facebook-square me-1"></i> Share
                    </a>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer pt-5 mt-5">
        <hr class="horizontal dark mb-5">
        <div class="container">
            <div class=" row">
                <div class="col-md-3 mb-4 ms-auto">
                    <div>
                        <h6 class="text-gradient text-primary font-weight-bolder">Ecomrade</h6>
                    </div>
                    <div>
                        <h6 class="mt-3 mb-2 opacity-8">Social</h6>
                        <ul class="d-flex flex-row ms-n3 nav">

                            <li class="nav-item">
                                <a class="nav-link pe-1" href="https://twitter.com/DennisChiira" target="_blank">
                                    <i class="fab fa-twitter text-lg opacity-8"></i>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link pe-1" href="https://www.linkedin.com/company/cyberacademykenya/?viewAsMember=true" target="_blank">
                                    <i class="fab fa-linkedin text-lg opacity-8"></i>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link pe-1" href="https://github.com/programmingChiira" target="_blank">
                                    <i class="fab fa-github text-lg opacity-8"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>



                <div class="col-md-2 col-sm-6 col-6 mb-4">
                    <div>
                        <h6 class="text-gradient text-primary text-sm">Company</h6>
                        <ul class="flex-column ms-n3 nav">
                            <li class="nav-item">
                                <router-link class="nav-link" to="/market">
                                    Market
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link class="nav-link" to="/rental">
                                    Rental
                                </router-link>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="col-md-2 col-sm-6 col-6 mb-4">
                    <div>
                        <h6 class="text-gradient text-primary text-sm">Features</h6>
                        <ul class="flex-column ms-n3 nav">
                            <li class="nav-item">
                                <router-link class="nav-link" to="/register">
                                    Register
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link class="nav-link" to="/login">
                                    Login
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-2 col-sm-6 col-6 mb-4">
                    <div>
                        <h6 class="text-gradient text-primary text-sm">Help & Support</h6>
                        <ul class="flex-column ms-n3 nav">
                            <li class="nav-item">
                                <router-link class="nav-link" to="/contact">
                                    Contact Us
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link class="nav-link" to="/faq">
                                    F.A.Q
                                </router-link>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="col-md-2 col-sm-6 col-6 mb-4 me-auto">
                    <div>
                        <h6 class="text-gradient text-primary text-sm">Legal</h6>
                        <ul class="flex-column ms-n3 nav">
                            <li class="nav-item">
                                <router-link class="nav-link" to="#">
                                    Terms &amp; Conditions
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link class="nav-link" to="#">
                                    Privacy Policy
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link class="nav-link" to="#">
                                    Licenses (EULA)
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-12">
                    <div class="text-center">
                        <p class="my-4 text-sm">
                            All rights reserved Copyright, Ecomrade.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    name: 'Footer',
    data() {
        return {
            message: 'footer'
        }
    }
}
</script>