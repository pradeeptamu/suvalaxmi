<template>
    <div>
        <div id="bg">
            <img src="../../../../public/img/global/temple3.jpg" class="temple mt-5" alt="home page image">
        </div>
        <!--Search box-->
        <section class="row justify-content-center m-auto property_details_searchbar">
            <div class="col-12 col-sm-12 col-md-8 col-lg-8 text-center pt-2 margin-top-negative">
                <div class="row justify-content-center pt-2">
                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 mb-2">
                        <select class="form-control select-height" name="location" id="location" v-model="form.location">
                            <option v-for="location in locations" :value="location" :key="location.id">
                                {{ location }}
                            </option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 mb-2">
                        <select name="purpose" v-model="form.purpose" class="form-control select-height">
                            <option value="Sale">Sale</option>
                            <option value="Rent">Rent</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 mb-2">
                        <select name="category" v-model="form.category" class="form-control select-height">
                            <option value="House">House</option>
                            <option value="Land">Land</option>
                            <option value="Apartment">Apartment</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 mb-2">
                        <a href="#" id="nav-btn" @click.prevent="submitSearch()"
                            class="nav-link btn btn-info btn-sm text-white search-btn select-height"> <i
                                class="fas fa-search mr-1 fa-sm text-white "></i>&nbsp;Search</a>
                    </div>

                </div>
            </div>
        </section>
        <!--end of search box -->
        <!--categories-->
        <section class="wrapper">
            <div class="container-fostrap">
                <p class="categories-title font-weight-bold mt-5">CATEGORIES</p>
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="card" @click.prevent="submitCategory('house')">
                                    <img src="../../../../public/img/global/house1.png" class="img-card"
                                        alt="find home image">
                                    <div class="centered font-weight-bold text-white">House</div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="card" @click.prevent="submitCategory('land')">
                                    <img src="../../../../public/img/global/land.png" class="img-card"
                                        alt="find land image">
                                    <div class="centered font-weight-bold text-white">Land</div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="card" @click.prevent="submitCategory('apartment')">
                                    <img src="../../../../public/img/global/apartment.png" class="img-card"
                                        alt="find apartment image">
                                    <div class="centered font-weight-bold text-white">Apartment</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--end of categories -->

        <!--Trending Properties Title-->
        <section class="section-padding" id="trending">
            <div class="trending-properties">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7  col-md-7 col-sm-6">
                            <p class="trending-properties-title font-weight-bold">TRENDING PROPERTIES</p>
                            <hr width="15%" align="left" size="30">
                        </div>
                    </div>
                </div>
            </div>
            <!--End of Trending Properties title-->
            <!--Trending Properties-->
            <!--<div class="property-slider">-->
            <div class="container">
                <div class="owl-carousel owl-theme" id="owl-demo">
                    <div class="card card-sm single-property-slide" v-for="trending in trendingProperty">
                        <router-link :to="{ name: 'singleproperty', params: { id: trending.id } }">
                            <div class="sale-rent">
                                <template v-if="trending.purpose == 'sell'">
                                    <span class="sale">For Sale</span>
                                </template>
                                <template v-if="trending.purpose == 'rent'">
                                    <span class="rent">For Rent</span>
                                </template>
                            </div>
                            <div class="time">
                                <span>{{ trending.views }} views</span>
                            </div>
                            <img class="card-img-top" alt="trending-image" :src="getPropertyImage(trending.thumbnail)">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 pb-2 d-flex flex-column">
                                        <h5 class="card-title"> {{ trending.title.substring(0, 24) + ".." }}</h5>
                                        <p>{{ trending.address }},{{ trending.location }}</p>
                                    </div>
                                </div>
                                <div class="row area">
                                    <div class="col-12">
                                        <p class="category"><b>{{ trending.category }}</b></p>
                                    </div>
                                </div>
                                <div class="row area">
                                    <div class="col-12">
                                        <p><b>NPR. {{ trending.price }}
                                                <template v-if="trending.price_unit != null">/{{ trending.price_unit }}
                                                </template>
                                            </b></p>
                                    </div>
                                </div>
                                <div class="row area mt-3">
                                    <div class="col-12 p-0 d-flex">
                                        <i class="col-3 fas fa-shower card-icon">
                                            <span>{{ trending.bathroom }}</span>
                                        </i>
                                        <i class="col-3 fas fa-bed pr-0 card-icon">
                                            <span>{{ trending.bedroom }}</span>
                                        </i>
                                        <i class="pl-0 col-6 fas fa-clock card-icon">
                                            <span>{{ trending.time }}</span>
                                        </i>
                                    </div>
                                </div>
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>
        </section>
        <!--end of trending properties carousel -->

        <!-- submit property -->
        <section class="section-padding" id="search-box">
            <div class="submit-property mb-4" align="center">
                <h6 class="submit-question " align="center">Looking to Buy a new property or Sell an existing one?<br>
                    Real Homes provides an awesome solution!</h6>
                <a href="#" class="btn btn-info btn-sm text-white mt-1" @click.prevent="submitproperty()">SUBMIT
                    PROPERTY</a> &nbsp
                <a href="#" class="btn btn-outline-info btn-sm mt-1" @click.prevent="browse()"> BROWSE PROPERTY</a>
            </div>
        </section>
        <!-- end of submit property -->

        <!--latest properties -->
        <section class="latest-properties mb-6">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6  col-md-6 col-sm-6">
                        <p class="trending-properties-title font-weight-bold mt-2 pt-5">LATEST PROPERTIES</p>
                        <hr width="15%" align="left" size="30">
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 trending-menu mt-2 pt-5">
                        <div class="row">

                            <div class="col-12 font-weight-bold trending-item">
                                <div>
                                    <div @click="showHouse" class="trending-link">HOUSE</div>
                                </div>
                                <div>
                                    <div @click="showLand" class="trending-link trending-link-land">LAND</div>
                                </div>
                                <div>
                                    <div @click="showApartment" class="trending-link ">APARTMENT</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- latest properties: house -->
            <div v-show="ishouse">
                <div class="container">
                    <div class="row pt-3">
                        <div class="col-xl-3 col-md-6 col-lg-4 p-2" v-for="(property, index) in latestProperties.house"
                            :key="property.id">
                            <router-link :to="{ name: 'singleproperty', params: { id: property.id } }">
                                <div class="props card">
                                    <div class="sale-rent">
                                        <template v-if="property.purpose == 'sell'">
                                            <span class="sale">For Sale</span>
                                        </template>
                                        <template v-if="property.purpose == 'rent'">
                                            <span class="rent">For Rent</span>
                                        </template>
                                    </div>
                                    <div class="time">
                                        <span>{{ property.views }} views</span>
                                    </div>
                                    <img class="card-img-top" alt="image" :src="getPropertyImage(property.thumbnail)">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 pb-2 d-flex flex-column">
                                                <h5 class="card-title"> {{ property.title.substring(0, 25) + ".." }}</h5>
                                                <p>{{ property.address }},{{ property.location }}</p>
                                            </div>
                                        </div>
                                        <div class="row area">
                                            <div class="col-12">
                                                <p class="category"><b>{{ property.category }}</b></p>
                                            </div>
                                        </div>
                                        <div class="row area">
                                            <div class="col-12">
                                                <p><b>NPR. {{ property.price }}
                                                        <template v-if="property.price_unit != null">
                                                            /{{ property.price_unit }}
                                                        </template>
                                                    </b></p>
                                            </div>
                                        </div>
                                        <div class="row area mt-3">
                                            <div class="col-12 p-0 d-flex">
                                                <i class="col-3 fas fa-shower card-icon">
                                                    <span>{{ property.bathroom }}</span>
                                                </i>
                                                <i class="col-3 fas fa-bed pr-0 card-icon">
                                                    <span>{{ property.bedroom }}</span>
                                                </i>
                                                <i class="pl-0 col-6 fas fa-clock card-icon">
                                                    <span>{{ property.time }}</span>
                                                </i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </router-link>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4 p-2 view-all">
                            <div class="card" @click.prevent="submitCategory('house')">

                                <div class="arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                                <h2>View All</h2>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- latest properties: land -->
            <div v-show="island">
                <div class="container">
                    <div class="row pt-3">
                        <div class="col-xl-3 col-md-6 col-lg-4 p-2" v-for="(property, index) in latestProperties.land"
                            :key="property.id">
                            <router-link :to="{ name: 'singleproperty', params: { id: property.id } }">
                                <div class="props card">
                                    <div class="sale-rent">
                                        <template v-if="property.purpose == 'sell'">
                                            <span class="sale">For Sale</span>
                                        </template>
                                        <template v-if="property.purpose == 'rent'">
                                            <span class="rent">For Rent</span>
                                        </template>
                                    </div>
                                    <div class="time">
                                        <span>{{ property.views }} views</span>
                                    </div>
                                    <img class="card-img-top" alt="image" :src="getPropertyImage(property.thumbnail)">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 pb-2 d-flex flex-column">
                                                <h5 class="card-title"> {{ property.title.substring(0, 25) + ".." }}</h5>
                                                <p>{{ property.address }},{{ property.location }}</p>
                                            </div>
                                        </div>
                                        <div class="row area">
                                            <div class="col-12">
                                                <p class="category"><b>{{ property.category }}</b></p>
                                            </div>
                                        </div>
                                        <div class="row area">
                                            <div class="col-12">
                                                <p><b>NPR. {{ property.price }}
                                                        <template v-if="property.price_unit != null">/
                                                            {{ property.price_unit }}
                                                        </template>
                                                    </b></p>
                                            </div>
                                        </div>
                                        <div class="row area mt-3">
                                            <div class="col-12 p-0 d-flex">
                                                <i class="col-3 fas fa-shower card-icon">
                                                    <span>{{ property.bathroom }}</span>
                                                </i>
                                                <i class="col-3 fas fa-bed pr-0 card-icon">
                                                    <span>{{ property.bedroom }}</span>
                                                </i>
                                                <i class="pl-0 col-6 fas fa-clock card-icon">
                                                    <span>{{ property.time }}</span>
                                                </i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </router-link>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4 p-2 view-all">
                            <div class="card" @click.prevent="submitCategory('land')">

                                <div class="arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                                <h2>View All</h2>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- latest properties: apartment -->
            <div v-show="isapartment">
                <div class="container">
                    <div class="row pt-3">
                        <div class="col-xl-3 col-md-6 col-lg-4 p-2" v-for="(property, index) in latestProperties.apartment"
                            :key="property.id">
                            <router-link :to="{ name: 'singleproperty', params: { id: property.id } }">
                                <div class="props card">
                                    <div class="sale-rent">
                                        <template v-if="property.purpose == 'sell'">
                                            <span class="sale">For Sale</span>
                                        </template>
                                        <template v-if="property.purpose == 'rent'">
                                            <span class="rent">For Rent</span>
                                        </template>
                                    </div>
                                    <div class="time">
                                        <span>{{ property.views }} views</span>
                                    </div>
                                    <img class="card-img-top" alt="image" :src="getPropertyImage(property.thumbnail)">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 pb-2 d-flex flex-column">
                                                <h5 class="card-title"> {{ property.title.substring(0, 25) + ".." }}</h5>
                                                <p>{{ property.address }},{{ property.location }}</p>
                                            </div>
                                        </div>
                                        <div class="row area">
                                            <div class="col-12">
                                                <p class="category"><b>{{ property.category }}</b></p>
                                            </div>
                                        </div>
                                        <div class="row area">
                                            <div class="col-12">
                                                <p><b>NPR. {{ property.price }}
                                                        <template v-if="property.price_unit != null">/
                                                            {{ property.price_unit }}
                                                        </template>
                                                    </b></p>
                                            </div>
                                        </div>
                                        <div class="row area mt-3">
                                            <div class="col-12 p-0 d-flex">
                                                <i class="col-3 fas fa-shower card-icon">
                                                    <span>{{ property.bathroom }}</span>
                                                </i>
                                                <i class="col-3 fas fa-bed pr-0 card-icon">
                                                    <span>{{ property.bedroom }}</span>
                                                </i>
                                                <i class="pl-0 col-6 fas fa-clock card-icon">
                                                    <span>{{ property.time }}</span>
                                                </i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </router-link>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4 p-2 view-all">
                            <div class="card" @click.prevent="submitCategory('apartment')">

                                <div class="arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                                <h2>View All</h2>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- end of latest-properties -->

        <!-- let us know -->
        <div class="container-fluid mt-5">
            <div class="row text-center let-us-know  pt-5 pb-5 ">
                <div class="col-lg-6 ">
                    <h6 class="letknow">Find a home that's right for you <br>
                        <span class="letusknow ml-5">Don't worry, we've done this many times</span>
                    </h6>
                </div>
                <div class="col-lg-6  let-us-know-btn">
                    <router-link to="/contact" tag="a" class="btn btn-info btn-sm text-white" style="padding: 13px"
                        active-class="active" exact>
                        LET US KNOW
                    </router-link>
                </div>
            </div>
        </div>
        <!-- end of let us know -->
    </div>
</template>

<script>
import Form from "vform";
import { nextTick } from 'vue';
export default {
    data() {
        return {
            ishouse: true,
            island: false,
            isapartment: false,
            locations: '',
            latestProperties: {
                land: {},
                house: {},
                apartment: {}
            },
            trendingProperty: [],
            form: new Form({
                location: 'Kathmandu',
                purpose: 'Sale',
                category: 'House'
            }),
        }
    },
    created() {
        window.scrollTo(0, 0);
        axios.get('/api/latestproperty')
            .then((data) => {
                this.latestProperties.land = data.data[0];
                this.latestProperties.house = data.data[1];
                this.latestProperties.apartment = data.data[2];
                console.log(data.data)
            })
            .catch(() => {

            });
        axios.get('/api/location').then((data) => {
            this.locations = data.data;
        });
    },
    mounted() {
        var vm = this;
        axios.get('/api/trending')
            .then((res) => {
                vm.trendingProperty = res.data;
                nextTick(() => {
                    vm.installOwlCarousel();
                });
            })
            .catch((err) => {
                if (err) console.log(err);
            });
    },
    methods: {
        //redirect to property page section
        submitSearch() {
            this.$router.push({
                name: 'property',
                params: { category: this.form.category, purpose: this.form.purpose, location: this.form.location }
            });
        },
        submitCategory(name) {
            this.$router.push({ name: 'property', params: { category: name } });
        },
        //end of redirect page
        getLatestPropertyImage(cat, index) {
            if (cat === 'house') {
                return "/img/thumbnail/" + this.latestProperties.house[index].images.split(',', 1);
            } else if (cat === 'land') {
                return "/img/thumbnail/" + this.latestProperties.land[index].images.split(',', 1);
            } else {
                return "/img/thumbnail/" + this.latestProperties.apartment[index].images.split(',', 1);
            }
            return "/img/singleproperty/house-2.png";
        },
        showHouse() {
            this.ishouse = true;
            this.island = false;
            this.isapartment = false;
        },
        showLand() {
            this.ishouse = false;
            this.island = true;
            this.isapartment = false;
        },
        showApartment() {
            this.ishouse = false;
            this.island = false;
            this.isapartment = true;
        },
        getPropertyImage(src) {
            return "/img/thumbnail/1ed3c4ec6c368c65d77ad2a4de23a709.jpeg";
        },
        installOwlCarousel: function () {
            jQuery(document).ready(function () {
                jQuery("#owl-demo").owlCarousel({
                    autoplay: false,
                    loop: true,
                    autoplayTimeout: 2000,
                    autoplayHoverPause: true,
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 1,
                            nav: true
                        },
                        768: {
                            items: 2,
                            nav: true
                        },
                        1024: {
                            items: 3,
                            nav: true
                        },
                        1100: {
                            items: 4,
                            nav: true
                        },
                    }
                });
            });
        },
        submitproperty() {
            if (this.$store.getters.isLoggedIn) {
                this.$router.push({ name: 'addproperty' });
            }
            else {
                this.$swal.fire({
                    icon: 'warning',
                    title: 'You must login to add property'
                });
            }
        },
        browse() {
            this.$router.push({ name: 'property' });
        }
    }
};
</script>


<style lang="scss" scoped>
.view-all {
    cursor: pointer;

    .card {
        height: 96%;
        display: flex;
        justify-content: center;
        align-items: center;

        .arrow {
            height: 3rem;
            width: 3rem;
            border-radius: 50%;
            border: 1px solid;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    }
}

.props {
    position: relative;
    overflow: hidden;
}

.category {
    text-transform: uppercase;
}

.time {
    span {
        padding: 2px 10px;
        color: white;
        position: absolute;
        font-size: 12px;
        outline: none;
        top: 1rem;
        right: 1rem;
        background: #38A1DA;
    }
}

.sale-rent {

    .sale,
    .rent {
        padding: 5px 40px;
        color: white;
        position: absolute;
        font-size: 12px;
        outline: none;
        top: 0.7rem;
        transform: rotate(321deg);
        left: -2rem;
    }

    .sale {
        background: #138655;
    }

    .rent {
        background: #BA1518;
    }
}

i {
    span {
        margin-left: 5px;
        color: black;
    }
}

.select-height {
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);

}

.search-btn {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #38A1DA;
}

.margin-top-negative {
    margin-top: -3vh;

    @media (min-width: 1200px) {
        margin-top: -6vh;
    }
}

.trending-item {
    display: flex;
    justify-content: flex-end;

    .trending-link-land {
        @media (max-width: 992px) {
            margin: 0 3vh;
        }

        @media (min-width: 992px) and (max-width: 1100px) {
            margin: 0 6vh;
        }

        @media (min-width: 1200px) {
            margin: 0 10vh;
        }
    }
}

.section-padding {
    padding: 10px 0;
}

/*landing picture*/
.temple {
    height: 100%;
    width: 100%;
}

/*categories title*/
.categories-title {
    font-size: 1.2em;
}

/*categories vitra ko text*/
.centered {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 25px;
}

.wrapper {
    display: table;
    height: 100%;
    width: 100%;
}

.container-fostrap {
    display: table-cell;
    padding: 1em;
    text-align: center;
    vertical-align: middle;
}

/*buttons ma shadow*/
.btn {
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
}

/*horizontal ruler*/
hr {
    border: 1px solid #38A1DA;
    border-radius: 1px;
}

/*trending properties ko title*/
.trending-properties-title {
    font-size: 1.2rem;
}

.single-property-slide {
    padding: 0;

    @media (min-width: 768px) {
        margin-right: 20px;
    }

    @media (max-width: 767px) {
        margin-top: 25px;
    }

    img {
        height: 100%;
        width: 100%;
        object-fit: cover;
    }
}

h5 {
    color: #38A1DA;
}

/*let us know section*/
.letknow {
    font-size: 26px;
}

.letusknow {
    font-size: 18px;
}

.let-us-know {
    background-color: #D4E0E6;
}

/*cards*/
.card-icon {
    color: #38A1DA;
}

a {
    text-decoration: none;
}

.card {
    background-color: #fff;
    border-radius: 2px;
    box-shadow: none;
    overflow: hidden;

    p {
        color: #435061;
        margin: 0 !important;
    }
}

.card:hover {
    box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.img-card {
    width: 100%;
    display: block;
    overflow: hidden;
}

.card-title {
    color: #435061;
    font-size: 18px;
    font-weight: bold;
}

.card-body {
    padding: 20px 15px !important;
}

.description-1,
.description-2 {
    display: inline;
    color: #435061;
}

.description-2 {
    font-weight: bold;

}

/*trending-properties ko menu*/

.trending-properties {
    padding-top: 30px;
}

.trending-menu .trending-item .trending-link:hover {
    color: #38A1DA;
    cursor: pointer;
}

.trending-menu .trending-item .trending-link:focus {
    color: #38A1DA;
}

.trending-menu .trending-item:active .trending-link {
    color: #38A1DA;
}

/*media queries*/

@media (min-width: 577px) and (max-width: 768px) {
    .property_details_searchbar {
        margin-left: 5rem;
    }

}

@media (min-width: 1200px) {

    /*let us know section ko button*/
    .let-us-know-btn {
        margin-left: -3rem;
    }
}

.container {
    max-width: 90%;
}
</style>