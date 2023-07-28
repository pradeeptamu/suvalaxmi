<template>
    <!-- FOOTER -->
    <footer>
        <div class="container text-white pb-3 pt-3">
            <div class="row text-white">
                <div class="col-lg-4 col-md-4 col-sm-12 real-estate">
                    <h6 class="heading-footer">SuvaLaxmi RealEstate</h6>
                    <i class="fa fa-envelope mr-3 line-height-footer"></i>suvalaxmirealestate@gmail.com<br>

                    <i class="fa fa-map-marker mr-3 line-height-footer"></i>Paknajol, Kathmandu<br>
                    <i class="fa fa-phone mr-2 line-height-footer"></i>+977 9851214726<br>
                    <i class="fa fa-phone mr-2 line-height-footer"></i>+01 4701833<br>
                    <div class="icon mt-3">
                        <i class="fab fa-facebook fa-lg mr-4"></i>
                        <i class="fab fa-instagram fa-lg mr-4"></i>
                        <i class="fab fa-twitter fa-md lg-3 mr-4"></i>
                        <i class="fab fa-pinterest fa-lg mr-4"></i>
                    </div>
                    <hr class="footer-hr" width="40%">
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 useful-links">
                    <h6 class="heading-footer">USEFUL LINKS</h6>
                    <router-link to="/property" tag="a" class="text-white line-height-footer" active-class="active" exact>
                        Property
                    </router-link><br />
                    <router-link to="/about" tag="a" class="text-white line-height-footer" active-class="active" exact>
                        About Us
                    </router-link><br />
                    <router-link to="/contact" tag="a" class="text-white line-height-footer" active-class="active" exact>
                        Contact Us
                    </router-link><br />
                    <router-link to="/privacy-policy" tag="a" class="text-white line-height-footer" active-class="active"
                        exact>
                        Privacy Policy
                    </router-link><br />
                    <!--<router-link to="/login" tag="a" class="text-white line-height-footer" active-class="active" exact>-->
                    <!--Become a member-->
                    <!--</router-link><br/>-->
                    <hr class="footer-hr" width="40%">
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12">
                    <h6 class="heading-footer text-center" style="font-size:1rem;">Keep up to date with new updates</h6>
                    <form @submit.prevent="subscribe" class="text-center">
                        <input type="email" class="subscribe w-100" name="email" v-model="form.email"
                            placeholder="Enter your email address...." :class="{ 'is-invalid': form.errors.has('email') }">
                        <div class="error" v-if="form.errors.has('email')" v-html="form.errors.get('email')" />

                        <br>
                        <button type="submit" class="mt-3 btn subscribe-btn">SUBSCRIBE</button>
                    </form>
                </div>
            </div>
            <hr>
            <p class="Copyright text-center">2019 Copyright All Right Reserved By SuvaLaxmi RealEstate Pvt.Ltd. Website
                Powered By
                Pradeep Gurung</p>
        </div>
    </footer>
    <!-- END OF FOOTER -->
</template>

<script>
import Form from "vform";

export default {
    name: "Footer",
    data() {
        return {
            form: new Form({
                email: ''
            }),
        }
    },

    methods: {
        subscribe() {
            this.form.post('/api/newsletter')
                .then(() => {
                    this.form.reset();
                    Toast.fire({
                        type: 'success',
                        title: 'Thank You For Your Subscription!!!'
                    });
                })

                .catch((e) => {
                    console.log(e);
                });
        },
    }
}
</script>

<style scoped>
.error {
    color: #dc3545;
}

footer {
    background-color: #435061;
}

.subscribe-btn {
    padding: 0.5rem 4rem;
    border: 1px solid;
    color: white;
}

.subscribe {
    border: 1px;
    border-radius: 25px;
    padding: 10px 20px;
    outline: none;
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);

}

/*mediaqueries*/
@media (max-width: 576px) {
    footer {
        text-align: center;
    }

    footer .useful-links {
        margin-top: 1rem;
    }

    footer .subscribe {
        margin-top: 1rem;
    }

    footer .list-inline .list-inline-item .list-link {
        margin-right: 0px;
    }
}

@media (min-width: 577px) and (max-width: 768px) {
    footer {
        text-align: center;
    }

    footer .useful-links {
        margin-top: 1rem;
    }

    footer .subscribe {
        margin-top: 1rem;
    }
}

@media (min-width: 768px) {

    .heading-footer {
        font-size: 1.5rem;
        line-height: 3rem;
        margin-top: 3rem;
    }

    .icon {
        margin-top: 3rem !important;
    }

    .line-height-footer {
        line-height: 2rem;
    }

    .footer-hr {
        display: none;
    }
}
</style>