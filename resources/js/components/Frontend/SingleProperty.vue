<template>
    <div>
        <!-- Property header section with image-->
        <section class="property_details_header">
            <div class="row w-100 m-0 single-cover-image">
                <img src="/img/global/ktm.jpg" alt="banner image">
            </div>

        </section>
        <!-- End of property header section with image-->

        <div class="container">

            <!-- Search bar section-->
            <section class="row justify-content-center m-auto property_details_searchbar">
                <div
                    class="col-12 col-sm-12 col-md-10 col-lg-10 text-center bg-white mt-md-n5 mt-lg-n5 p-4 main_search_box">
                    <div class="row justify-content-center pt-2">
                        <div class="col-12 col-sm-6 col-md-3 col-lg-3 mb-2">
                            <select class="form-control select-height" name="location" id="location"
                                v-model="form.location">
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
                        <div class="col-12 col-sm-6 col-md-3 col-lg-3 mb-3">
                            <select name="category" v-model="form.category" class="form-control select-height">
                                <option value="House">House</option>
                                <option value="Land">Land</option>
                                <option value="Apartment">Apartment</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 col-lg-3 mb-2">
                            <button class="btn btn-outline-primary w-100" @click.prevent="submitSearch()">Search
                            </button>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End of search bar section-->

            <!-- Propety title section-->
            <section class="row w-100 mt-5 mb-5 ml-0 propety_details_title">
                <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                    <h3>{{ property.title }}
                        <i v-if="this.$store.getters.isLoggedIn" class="fa-heart card-heart fav"
                            :class="getClassFavorites()" @click="changeHeart($event, property.id)"></i>
                    </h3>
                    <h5>{{ property.address }}, {{ property.location }}</h5>
                </div>

                <div class="col-12 col-sm-6 col-md-6 col-lg-6 border-left">
                    <h3>For {{ property.purpose }}</h3>
                    <h5>Rs. {{ property.price }}</h5>
                </div>
            </section>
            <!-- End of propety title section-->


            <!-- Propety image gallery section-->
            <section class="row justify-content-center w-100 mt-3 mb-5 ml-0 property_details_images">

                <LightBox :thumbnails="lightbox.images.thumbnails" :largeImages="lightbox.images.large"
                    :thumbnailsPath="lightbox.thumbnailsPath" :largePath="lightbox.largePath" :captions="lightbox.captions"
                    class="lightBox" />

            </section>
            <!-- End of propety image gallery section-->

            <!-- Body section of property details -->
            <section class="row w-100 mt-3 ml-0 property_details_body">

                <!-- Property details -->
                <div class="col-12 col-sm-12 col-lg-8 w-100 full_details mb-5">

                    <!-- Core details -->
                    <h5 class="border-bottom mt-2 mb-3 pb-2">Property ID: {{ property.id }}</h5>
                    <div class="row m-auto basic_info">
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3 text-center">
                            <h6>Area</h6>
                            <img src="/img/singleproperty/area.png"><br>
                            <template v-if="property.area_total === null">
                                <h6 class="property-desc">no data</h6>
                            </template>
                            <template v-else>
                                <h6 class="property-desc">{{ property.area_total }}</h6>
                            </template>
                        </div>
                        <template v-if="!island">
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 text-center">
                                <h6>Bathroom</h6>
                                <img src="/img/singleproperty/bathroom.png"><br>
                                <template v-if="property.bathroom === null">
                                    <h6 class="property-desc">no data</h6>
                                </template>
                                <template v-else>
                                    <h6 class="property-desc">{{ property.bathroom }}</h6>
                                </template>
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 text-center">
                                <h6>Kitchen</h6>
                                <img src="/img/singleproperty/kitchen.png"><br>
                                <template v-if="property.kitchen === null">
                                    <h6 class="property-desc">no data</h6>
                                </template>
                                <template v-else>
                                    <h6 class="property-desc">{{ property.kitchen }}</h6>
                                </template>
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 text-center">
                                <h6>Parking</h6>
                                <img src="/img/singleproperty/parking.png"><br>
                                <template v-if="property.parking === null">
                                    <h6 class="property-desc">no data</h6>
                                </template>
                                <template v-else>
                                    <h6 class="property-desc">{{ property.parking }}</h6>
                                </template>
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 text-center">
                                <h6>Floors</h6>
                                <img src="/img/singleproperty/floor.png"><br>
                                <template v-if="property.no_floors === null">
                                    <h6 class="property-desc">no data</h6>
                                </template>
                                <template v-else>
                                    <h6 class="property-desc">{{ property.no_floors }}</h6>
                                </template>
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 text-center">
                                <h6>Bedroom</h6>
                                <img src="/img/singleproperty/bedroom.png"><br>
                                <template v-if="property.bedroom === null">
                                    <h6 class="property-desc">no data</h6>
                                </template>
                                <template v-else>
                                    <h6 class="property-desc">{{ property.bedroom }}</h6>
                                </template>
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 text-center">
                                <h6>Year Built</h6>
                                <img src="/img/singleproperty/year.png"><br>
                                <template v-if="property.built_year === null">
                                    <h6 class="property-desc">no data</h6>
                                </template>
                                <template v-else>
                                    <h6 class="property-desc">{{ property.built_year }}</h6>
                                </template>
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 text-center">
                                <h6>Living Room</h6>
                                <img src="/img/singleproperty/living.png"><br>
                                <template v-if="property.living_room === null">
                                    <h6 class="property-desc">no data</h6>
                                </template>
                                <template v-else>
                                    <h6 class="property-desc">{{ property.living_room }}</h6>
                                </template>
                            </div>
                        </template>
                    </div>
                    <!-- End of core details -->

                    <!-- Description -->
                    <h5 class="border-bottom mt-4 mb-3 pb-2">Description</h5>
                    <div class="row m-auto description">
                        <p>
                            {{ property.description }}
                        </p>
                    </div>
                    <!-- End of description -->

                    <!-- Additional features -->
                    <h5 class="border-bottom mt-4 mb-3 pb-2">Additional Features</h5>
                    <div class="additional_features mb-3">
                        <div class="row">
                            <div class="col-4">
                                Property Face
                            </div>
                            <div class="col-1">
                                :
                            </div>
                            <div class="col-6">
                                {{ property.face }}
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-4">
                                Road Type
                            </div>
                            <div class="col-1">
                                :
                            </div>
                            <div class="col-6">
                                {{ property.road_type }}
                            </div>
                        </div>

                        <template v-if="!island">
                            <div class="row mt-3">
                                <div class="col-4">
                                    Furniture Status
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                                <div class="col-6">
                                    {{ property.furnish_status }}
                                </div>
                            </div>
                        </template>

                    </div>
                    <!-- End of additional features -->

                    <!-- Amenities -->
                    <template v-if="!island">
                        <h5 class="border-bottom mt-4 mb-3 pb-2">Amenities</h5>
                        <div class="row m-auto pb-3 amenities">
                            <template v-if="amenities.length !== 0">
                                <div v-for="(amenity, index) in amenities" :key="amenity"
                                    class="col-6 col-sm-6 col-md-4 col-lg-3 text-center">
                                    <img :src="getAmenityPhoto(index)"><br>
                                    <h6>{{ amenity }}</h6>
                                </div>
                            </template>
                        </div>
                    </template>
                    <!-- End of amenities -->

                </div>
                <!-- End of property details -->

                <!-- Contact and enquiry -->
                <div class="col-12 col-sm-12 col-lg-3 mt-4 mt-sm-0 mt-md-0 mt-lg-0 contact_owner">
                    <h5 class="border-bottom text-center mt-2 mb-3 pb-2">Contact Information</h5>
                    <div class="row m-auto bg-white owner_info p-3">
                        <div><img :src="getOwnerPhoto()" class="owner-photo" alt="No Image"></div>
                        <div class="mb-2 mt-2">
                            <small>{{ property.owner_name }}</small>
                            <br>
                            <small>{{ property.owner_address }}</small>
                            <br>
                            <small>{{ property.owner_phone }}</small>
                        </div>
                    </div>

                    <div class="row mt-4"></div>

                    <div class="row justify-content-center m-auto">
                        <form @submit.prevent="createEnquiry()" class="w-100">
                            <div class="form-group">
                                <input type="text" v-model="form.name" class="form-control" name="name"
                                    placeholder="Your Name" :class="{ 'is-invalid': form.errors.has('name') }">
                                <div class="error" v-if="form.errors.has('name')" v-html="form.errors.get('name')" />

                            </div>
                            <div class="form-group">
                                <input type="email" v-model="form.email" class="form-control" name="email"
                                    placeholder="Email Address" :class="{ 'is-invalid': form.errors.has('email') }">
                                <div class="error" v-if="form.errors.has('email')" v-html="form.errors.get('email')" />

                            </div>
                            <div class="form-group">
                                <input type="text" v-model="form.mobile_number" class="form-control" name="mobile"
                                    placeholder="Mobile Number" :class="{ 'is-invalid': form.errors.has('mobile_number') }">
                                <div class="error" v-if="form.errors.has('mobile_number')"
                                    v-html="form.errors.get('mobile_number')" />

                            </div>
                            <div class="form-group">
                                <textarea type="text" v-model="form.message" class="form-control" name="message"
                                    placeholder="Message" :class="{ 'is-invalid': form.errors.has('message') }"></textarea>
                                <div class="error" v-if="form.errors.has('message')" v-html="form.errors.get('message')" />
                            </div>

                            <input type="hidden" v-model="form.owner_id" name="owner_id">
                            <input type="hidden" v-model="form.property_id" name="property_id">

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-outline-primary m-auto">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End of contact and enquiry -->

            </section>
            <!-- End of body section of property details -->

        </div>

        <!-- Similar property section -->
        <section class="row w-100 mt-5 mb-5 ml-0 similar_property">
            <div class="container ">
                <h3><strong>Similar Properties</strong></h3>
                <div class="row pt-3">
                    <div class="col-xl-3 col-md-6 col-lg-4 p-2" v-for="(similar, index) in similar_property"
                        :key="similar.id">
                        <router-link :to="{ name: 'singleproperty', params: { id: similar.id } }">
                            <div class="props card">
                                <div class="sale-rent">
                                    <template v-if="similar.purpose == 'sell'">
                                        <span class="sale">For Sale</span>
                                    </template>
                                    <template v-if="similar.purpose == 'rent'">
                                        <span class="rent">For Rent</span>
                                    </template>
                                </div>
                                <div class="time">
                                    <span>{{ similar.views }} views</span>
                                </div>
                                <img class="card-img-top" alt="image" :src="getSimilarPropertyImage(index)">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 pb-2 d-flex flex-column">
                                            <h5 class="card-title"> {{ similar.title.substring(0, 25) + ".." }}</h5>
                                            <span>{{ similar.address }},{{ similar.location }}</span>
                                        </div>
                                    </div>
                                    <div class="row area">
                                        <div class="col-12">
                                            <span class="category"><b>{{ similar.category }}</b></span>
                                        </div>
                                    </div>
                                    <div class="row area">
                                        <div class="col-12">
                                            <span><b>NPR. {{ similar.price }}</b></span>
                                        </div>
                                    </div>
                                    <div class="row area mt-3">
                                        <div class="col-12 p-0 d-flex">
                                            <i class="col-3 fas fa-shower card-icon">
                                                <span>{{ similar.bathroom }}</span>
                                            </i>
                                            <i class="col-3 fas fa-bed card-icon">
                                                <span>{{ similar.bedroom }}</span>
                                            </i>
                                            <i class="pl-0 col-6 fas fa-clock card-icon">
                                                <span>{{ similar.time }}</span>
                                            </i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>
        </section>
        <!-- End of similar property section -->

    </div>
</template>

<script>

import LightBox from './helpers/LightBox.vue';
import Form from 'vform'


export default {
    name: "single-property",
    data() {
        return {
            property: {},
            val: '',
            locations: {},
            similar_property: {},
            form: new Form({
                name: '',
                email: '',
                mobile_number: '',
                message: '',
                owner_id: '',
                property_id: '',
                location: 'Kathmandu',
                purpose: 'Sale',
                category: 'House'
            }),
            lightbox: {
                images: {
                    thumbnails: [],
                    large: []
                },
                captions: [],
                thumbnailsPath: "/img/property/",
                largePath: "/img/property/"
            },
            island: false,
            amenities: []
        };
    },
    created() {
        window.scrollTo(0, 0);
        axios.put('/api/getviews/' + this.$route.params.id)
            .then((data) => {

            })
            .catch(() => {

            });
        this.loadLocations();
    },

    beforeMount() {
        this.getData(this.$route.params.id);
    },

    mounted() {

    },

    watch: {
        '$route.params.id'(newId, oldId) {
            this.getData(newId);
            this.amenities = [];
        }
    },
    methods: {
        //loading locations
        loadLocations: async function () {
            try {
                await axios.get('/api/location').then((data) => {
                    this.locations = data.data;
                });
            } catch (error) {
                console.log(error);
            }
        },
        //search
        submitSearch() {
            this.$router.push({
                name: 'property',
                params: { category: this.form.category, purpose: this.form.purpose, location: this.form.location }
            });
        },
        //method for favorites
        getClassFavorites() {
            let vm = this.$store.getters.currentUser.id;
            axios.get('/api/getFavorites/' + vm + '/' + this.property.id).then((data) => {
                this.val = data.data;
            }).catch(() => {
            });
            return {
                'fas': this.val,
                'far': !this.val
            }
        }
        ,

        changeHeart(e, id) {
            if (this.$store.getters.isLoggedIn) {
                let vm = this.$store.getters.currentUser.id;
                if (e.target.classList.contains('far')) {
                    e.target.classList.remove('far');
                    e.target.classList.add('fas');

                    axios.post('/api/userfavorite', {
                        user_id: vm,
                        prop_id: id
                    })
                        .then(() => {
                            this.$swal.fire({
                                icon: 'success',
                                title: 'Property Added to Favorites !!!'
                            });
                        });

                } else {
                    //when solid
                    e.target.classList.add('far');
                    e.target.classList.remove('fas');
                    axios.delete('/api/deleteFavorites/' + vm + '/' + id)
                        .then(() => {
                            this.$swal.fire({
                                icon: 'warning',
                                title: 'Property removed from Favorites !!!'
                            });
                        });

                }
            } else {
                this.$swal.fire({
                    icon: 'warning',
                    title: 'You Must Login First !!!'
                });
            }
        }
        ,//end of favorite section
        getData(id) {
            this.scrollToTop();
            axios.get('/api/singleproperty/' + id)
                .then((data) => {
                    this.property = data.data;

                    if (data.data.category === 'land') {
                        this.island = true;
                    }

                    let images = data.data.images.split(',');
                    let array = [];
                    for (let i = 0; i < images.length; i++) {
                        array.push(images[i]);
                    }

                    this.lightbox.images.thumbnails = array;
                    this.lightbox.images.large = array;

                    let category = data.data.category;

                    if (category !== 'land') {
                        if (data.data.amenities !== '') {
                            let temp = data.data.amenities.split(',');
                            for (let i = 0; i < temp.length; i++) {
                                this.amenities.push(temp[i]);
                            }
                        }
                    }


                    axios.get('/api/similarProperty/' + category + '/' + id)
                        .then((data) => {
                            this.similar_property = data.data;
                        })
                        .catch(() => {

                        });
                })
                .catch(() => {

                });


        },
        getAmenityPhoto(index) {
            return "/img/singleproperty/" + this.amenities[index] + ".png";
        },
        getOwnerPhoto() {
            return "/img/profile/" + this.property.owner_photo;
        },
        getSimilarPropertyImage(index) {
            return "/img/thumbnail/" + this.similar_property[index].images.split(',', 1);
        },
        createEnquiry() {
            this.form.owner_id = this.property.owner_id;
            this.form.property_id = this.property.property_id;
            this.form.post('/api/enquiry')
                .then(() => {
                    this.form.reset();
                    this.$swal.fire({
                        icon: "success",
                        title: "Enquiry has been sent !!!",
                    });
                })

                .catch(() => {
                    console.log('error');
                });
        },
        scrollToTop() {
            window.scrollTo(0, 0);
        }
    },
    components: {
        LightBox
    }
};
</script>

<style lang="scss" scoped>
.owner-photo {
    height: 7rem;
    width: 7rem;
    border-radius: 50%;
    margin-right: 2rem;
    object-fit: cover;
    object-position: top;
}

.error {
    color: #dc3545;
}

li {
    margin-bottom: 10px;

    span {
        display: flex;
        justify-content: space-between;
        font-size: 16px;
    }
}

.card {
    box-shadow: none !important;
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

a {
    color: #707070;

    i {
        color: #38A1DA;
    }
}

.property-desc {
    background: #38A1DA;
    color: white;
    padding: 5px;
}

.single-cover-image {
    height: 55vh;

    @media only screen and (max-width: 1025px) {
        height: 35vh;
    }

    img {
        object-fit: cover;
        object-position: top;
    }
}

.light-box {
    &__thumbnail {
        margin: 20px;
        width: 200px;
    }

    img {
        max-width: 100%;
    }
}

.fav {
    color: #25aae1;
    cursor: pointer;
}

// header
.property_details_header {
    height: auto;
    width: 100%;

    img {
        height: 100%;
        width: 100%;
    }
}

// seacrhbar
.property_details_searchbar {
    width: 100%;

    .main_search_box {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-radius: 5px;

        select {
            border: 1px solid #ebebeb;
            border-radius: 5px;
        }

        button {
            border-radius: 5px;
            border: 1px solid #ebebeb;
        }
    }
}

// body part
.property_details_body {

    // property deatils
    .full_details {
        background: ghostwhite;
        /*box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);*/

        // info
        .basic_info {
            h6 {
                margin-top: 1rem;
            }

            img {
                width: 3rem;
                height: 3rem;
                margin-top: .5rem;
                margin-bottom: 1rem;
            }
        }

        // amenities
        .amenities {
            h6 {
                margin-top: 1rem;
            }

            img {
                width: 4rem;
                height: 4rem;
                margin-top: .5rem;
                margin-bottom: 1rem;
            }
        }
    }

    // enquiry form
    .contact_owner {

        background: ghostwhite;
        height: 100%;

        @media only screen and (min-width: 992px) {
            margin-left: 3vw;
        }

        input,
        textarea,
        button {
            border-radius: 0;
        }
    }
}

// for small screens only
@media only screen and (max-width: 600px) {

    // removing all box shadow

    .property_details_searchbar {
        .main_search_box {
            box-shadow: none;
        }
    }

    .property_details_body {
        .full_details {
            box-shadow: none;
        }

        .contact_owner {
            box-shadow: none;

            .owner_info {
                box-shadow: none;
            }
        }
    }
}

@media only screen and (min-width: 992px) {

    .container {
        max-width: 90%;
    }

    .contact_owner {
        flex: 0 0 29% !important;

    }

    .col-lg-3 {
        max-width: 30% !important;
    }

    a {
        text-decoration: none;
    }
}

.card-body {
    color: #435061;

    .card-title {
        font-weight: bold;
    }

    .card-price {
        font-weight: bold;
        color: #3490dc;
    }
}

.propety_details_title {
    h3 {
        color: rgba(0, 0, 0, 0.8);
        font-weight: bold;
    }

    .border-left {
        display: flex;
        flex-direction: column;
        align-items: flex-end;

        @media only screen and (max-width: 768px) {
            align-items: flex-start;
        }
    }
}
</style>
