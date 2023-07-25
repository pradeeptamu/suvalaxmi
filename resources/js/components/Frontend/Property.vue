<template>
    <div>
        <div class="container-fluid">
            <div class="row mt-4">
                <!-- Property header section with image-->
                <section class="property_details_header">
                    <img :src="getCoverImage()" class="img-header">
                    <div class="title">
                        “Jata bikash Utai basai”
                    </div>
                </section>
                <!-- End of property header section with image-->
            </div>

            <div class="row justify-content-center property-container">
                <div class="col-xs-12 col-xl-3 p-0">
                    <h5 class="filter desktop-toggle">FILTER BY </h5>
                    <h5 class="mobile-toggle" @click="toggleMobile">FILTER BY </h5>
                    <div class="mobile-filter">
                        <ul class="list-filter">
                            <li class="mobile-sort">
                                <span @click="toggle">Sort
                                    <i class="fas fa-chevron-down slide-down-hover"></i>
                                </span>
                                <h6 class="mt-2" style="display:none">
                                    <label class="container">
                                        Highest Price
                                        <input type="radio" id="highest" :value="high" @change="changeValue('sort')"
                                            v-model="sort">
                                    </label>
                                    <label class="container">
                                        Lowest Price
                                        <input type="radio" id="lowest" :value="low" @change="changeValue('sort')"
                                            v-model="sort">
                                    </label>
                                    <label class="container">
                                        Latest
                                        <input type="radio" id="latests" :value="latest" @change="changeValue('sort')"
                                            v-model="sort">
                                    </label>
                                    <label class="container">
                                        Oldest
                                        <input type="radio" id="oldest" :value="oldest" @change="changeValue('sort')"
                                            v-model="sort">
                                    </label>
                                </h6>
                            </li>
                            <li>
                                <span @click="toggle">Property Purposes
                                    <i class="fas fa-chevron-down slide-down-hover"></i>
                                </span>

                                <h6 class="mt-2" style="display:none">

                                    <ul class="toggleBtns">
                                        <li class="mr-2">
                                            <button class="btn btn-outline-primary btn-sm"
                                                v-bind:class="{ active: isActive }" v-on:click="toggleSaleRent('sale')">For
                                                Sale
                                            </button>
                                        </li>
                                        <li>
                                            <button class="btn btn-outline-primary btn-sm"
                                                v-bind:class="{ active: isInactive }"
                                                v-on:click="toggleSaleRent('rent')">For
                                                Rent
                                            </button>
                                        </li>
                                    </ul>
                                </h6>
                            </li>
                            <li>
                                <span @click="toggle">Property Categories
                                    <i class="fas fa-chevron-down slide-down-hover"></i>
                                </span>

                                <h6 class="mt-2" style="display:none">
                                    <ul class="toggleBtns" id="categ">
                                        <li class="mr-2" v-for="roadType in categories" :value="roadType"
                                            :key="roadType.id">

                                            <button :id="'cus_' + roadType.value"
                                                class="btn btn-outline-primary btn-sm roadBtn"
                                                @click="toggleCategories($event)">
                                                {{ roadType.value }}
                                            </button>
                                        </li>
                                    </ul>
                                </h6>
                            </li>
                            <li>
                                <span @click="toggle">Property Type
                                    <i class="fas fa-chevron-down slide-down-hover"></i>
                                </span>

                                <h6 class="mt-2" style="display:none">
                                    <ul class="toggleBtns">
                                        <li class="mr-2">
                                            <button class="btn btn-outline-primary btn-sm"
                                                v-bind:class="{ active: resActive }"
                                                v-on:click="toggleResCom('residential')">
                                                Residential
                                            </button>
                                        </li>
                                        <li>
                                            <button class="btn btn-outline-primary btn-sm"
                                                v-bind:class="{ active: comActive }"
                                                v-on:click="toggleResCom('commercial')">
                                                Commercial
                                            </button>
                                        </li>
                                    </ul>
                                </h6>
                            </li>
                            <li>
                                <span @click="toggle">Property Location
                                    <i class="fas fa-chevron-down slide-down-hover"></i>
                                </span>

                                <div class="mt-2" style="display:none">
                                    <div class="d-flex flex-row input-group">
                                        <select class="form-control" name="location" id="location"
                                            :class="{ 'is-invalid': form.errors.has('location') }" v-model="form.location"
                                            @change="changeValue('location')">
                                            <option value="nolocation" selected>No Selection</option>
                                            <option v-for="location in locations" :value="location" :key="location.id">
                                                {{ location }}
                                            </option>
                                        </select>
                                        <div class="input-group-prepend" v-bind:class="{ 'hideShow': firstHidden }"
                                            @click.prevent="clearSelected('location')">
                                            <div class="input-group-text">
                                                <a href="javascript:;" class="border"><i class="fas fa-times"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <span @click="toggle">Max Price
                                    <i class="fas fa-chevron-down slide-down-hover"></i>
                                </span>

                                <h6 class="mt-2" style="display:none">
                                    <ul class="toggleBtns" id="crore">
                                        <li class="mr-2" v-for="crore in crores" :value="crore" :key="crore.id">

                                            <button class="btn btn-outline-primary btn-sm croreBtn"
                                                @click="toggleCrore($event)">
                                                {{ crore.value }}
                                            </button>
                                        </li>
                                    </ul>
                                </h6>
                            </li>
                            <li>
                                <span @click="toggle">Min Built Year
                                    <i class="fas fa-chevron-down slide-down-hover"></i>
                                </span>
                                <p class="mt-2" style="display:none">
                                    <input type="text" class="form-control" placeholder="Built Year(BS)"
                                        v-model="form.built_year" v-on:keyup="changeValue('year')">
                                </p>
                            </li>
                            <li>
                                <span @click="toggle">Road Type
                                    <i class="fas fa-chevron-down slide-down-hover"></i></span>

                                <h6 class="mt-2" style="display:none">
                                    <ul class="toggleBtns" id="road">
                                        <li class="mr-2" v-for="roadType in roadTypes" :value="roadType" :key="roadType.id">
                                            <button class="btn btn-outline-primary btn-sm roadBtn"
                                                @click="toggleRoadType($event)">
                                                {{ roadType.value }}
                                            </button>
                                        </li>
                                    </ul>
                                </h6>
                            </li>
                        </ul>
                        <h5 class="filter">Filter Tags:</h5>
                        <div class="tags">
                            <div v-for="(item, index) in filterValue" class="filter-tags" :key="index">
                                <span class="badge badge-pill badge-primary  p-2 m-1">{{ item }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-xl-9 mobile-padding">
                    <div class="filter-header-container">
                        <div class="filter-header">
                            <h2 class="search-title" v-show="isActive && !isInactive">Properties For Sale</h2>
                            <h2 class="search-title" v-show="!isActive && isInactive">Properties For Rent</h2>
                            <h2 class="search-title" v-show="!isActive && !isInactive">All Properties</h2>
                        </div>

                        <div class="input-group  dropdown-sort">
                            <select name="sortBy" class="form-control" @change="changeValue('sort')" v-model="sort">
                                <option value="nosort" disabled selected>SORT BY</option>
                                <option value="high">HIGHEST PRICE</option>
                                <option value="low">LOWEST PRICE</option>
                                <option value="latest">LATEST</option>
                                <option value="oldest">OLDEST</option>
                            </select>
                            <div class="input-group-prepend" v-bind:class="{ 'hideShow': hidden }"
                                @click.prevent="clearSelectSort('sort')">
                                <div class="input-group-text">
                                    <a href="javascript:;" class="border"><i class="fas fa-times"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!--filter properties -->
                    <!--css loader-->
                    <div :class="{ 'lds-facebook': loader }" v-show="loader" class="mb-5">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>

                    <!--end of css loader        -->
                    <!--empty result-->
                    <div v-if="properties.data == 0">
                        No Result Found
                    </div>

                    <!--end of empty result-->
                    <section class="section-padding" v-show="!loader" id="latest">
                        <div class="container">
                            <div class="row pt-3">
                                <div class="col-md-6 col-lg-4 p-2" v-for="(property, index) in properties.data"
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
                                            <img class="card-img-top" alt="image"
                                                :src="getPropertyImage(property.thumbnail)">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 pb-2 d-flex flex-column">
                                                        <h5 class="card-title">
                                                            {{ property.title.substring(0, 25) + ".." }}</h5>
                                                        <span>{{ property.address }},{{ property.location }}</span>
                                                    </div>
                                                </div>
                                                <div class="row area">
                                                    <div class="col-12">
                                                        <span class="category"><b>{{ property.category }}</b></span>
                                                    </div>
                                                </div>
                                                <div class="row area">
                                                    <div class="col-12">
                                                        <span><b>NPR. {{ property.price }}
                                                                <template v-if="property.price_unit != null">/
                                                                    {{ property.price_unit }}
                                                                </template></b></span>
                                                    </div>
                                                </div>
                                                <div class="row area mt-3 mb-2">
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

                            </div>
                        </div>
                    </section>
                    <!-- end of filter-properties -->

                    <!--pagination start-->
                    <!-- <pagination :data="properties" @pagination-change-page="getResults" class="pagination-property">
                    </pagination> -->

                    <!-- <vue-awesome-paginate v-model="properties" :on-click="getResults" /> -->

                    <div v-show="properties">
                        <paginate :page-count="properties.last_page" :click-handler="getResults" :prev-text="'Prev'"
                            :next-text="'Next'" :container-class="'pagination'">
                        </paginate>
                    </div>
                    <!--pagination end-->
                </div>
            </div>
            <!-- let us know -->
            <!-- end of let us know -->
        </div>
        <div class="container-fluid mt-5">
            <div class="row text-center let-us-know  pt-5 pb-5 ">
                <div class="col-lg-6 ">
                    <h6 class="letknow">Find a home that's right for you <br>
                        <span class="letusknow ml-5">Don't worry, we've done this a million times</span>
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

    </div>
</template>
<script>
import debounce from 'lodash/debounce';
import Form from 'vform';
import Paginate from 'vuejs-paginate-next';


export default {
    name: "Property.vue",
    components: {
        Paginate
    },
    data() {
        return {
            firstHidden: true,
            hidden: true,
            val: '',
            isActive: false, //Sell Rent Toggle
            isInactive: false,   //Sell Rent Toggle
            resActive: false,    //Residential Toggle
            comActive: false,    //Commercial Toggle
            filterValue: {},
            year: '',
            loader: false,
            sort: 'nosort',
            noresult: false,
            high: 'high',
            low: 'low',
            latest: 'latest',
            oldest: 'oldest',
            categories: [
                { value: 'House' },
                { value: 'Land' },
                { value: 'Apartment' }
            ],    //Commercial Toggle
            crores: [
                { value: '1 Cr.' },
                { value: '2 Cr.' },
                { value: '5 Cr.' },
                { value: '10 Cr.' },
                { value: '20 Cr.' },
                { value: '50 Cr.' },
                { value: '100 Cr.' }
            ],
            roadTypes: [
                { value: 'Gravelled' },
                { value: 'Paved' },
                { value: 'Blacktopped' },
                { value: 'Alley' },
                { value: 'Soil Stabilized' }
            ],
            image: '',
            properties: {},
            propAlt: {},
            owner: {},
            status: '',
            locations: {},
            purposes: 'Buy',
            form: new Form({
                location: '',
                built_year: '',
            }),
        }
    },
    created() {
        window.scrollTo(0, 0);
        this.year = new Date().getFullYear() - 1900;
        this.loadProperties();
        this.loadLocations();
    },
    mounted() {
        //for redirect to specific category
        let para = this.$route.params.category;

        if (para) {
            let tag = 'cus_' + para.charAt(0).toUpperCase() + para.slice(1);
            document.getElementById(tag).click();
            this.addToFilter('category', para.toLowerCase());
        }
        let search = this.$route.params.location;

        if (search) {
            this.addToFilter('location', search.toLowerCase());
            this.firstHidden = false;
        }
        let purpose = this.$route.params.purpose;
        if (purpose) {
            this.toggleSaleRent(purpose.toLowerCase());
        }
    },
    methods: {
        //reset data
        resetData() {
            Object.assign(this.$data, this.$options.data.call(this));
        },
        // Getting SVG file for cancel button in Filter Section
        getCancelSvgImage() {
            return "images/cross-sign.svg";
        },
        loadLocations: async function () {
            try {
                await axios.get('/api/location').then((data) => {
                    this.locations = data.data;
                });
            } catch (error) {
                console.log(error);
            }
        },
        //get owner id and check logged or not
        checkLoggedIn() {
            return this.$store.getters.isLoggedIn;
        },
        //clear all selected options
        clearSelected(id) {
            this.removeFilter('location');
            this.form.location = "No Selection";
            this.firstHidden = true;
        }
        , clearSelectSort() {
            this.removeFilter('sort');
            this.sort = "nosort";
            this.hidden = true;
        },
        removeElement: function (index) {
            this.filterValue.splice(index, 1);
        },

        //method for favorites
        getClassFavorites() {
            axios.get('/api/getFavorites/' + 1 + '/' + 1).then((data) => {
                this.val = data.data;
            }).catch(() => {
            });
            return {
                'fas': this.val,
                'far': !this.val
            }
        }
        ,
        changeHeart(e) {
            if (e.target.classList.contains('far')) {
                e.target.classList.remove('far');
                e.target.classList.add('fas');

                axios.post('/api/userfavorite', {
                    user_id: 1,
                    prop_id: 1
                })
                    .then(() => {
                        Toast.fire({
                            type: 'success',
                            title: 'Property Added to Favorites !!!'
                        });
                    });

            } else {
                //when solid
                e.target.classList.add('far');
                e.target.classList.remove('fas');
                axios.delete('/api/deleteFavorites/' + 1 + '/' + 1)
                    .then(() => {
                        Toast.fire({
                            type: 'warning',
                            title: 'Property removed from Favorites !!!'
                        });
                    });

            }
        }
        ,//end of favorite section


        //filter section starts
        changeValue(str) {
            if (str === 'location') {
                if (this.form.location === 'nolocation') {
                    this.removeFilter('location');
                    this.firstHidden = true;
                } else {
                    this.addToFilter('location', this.form.location);
                    this.firstHidden = false;
                }

            } else if (str === 'sort') {
                if (this.sort === 'nosort') {
                    this.removeFilter('sort');
                    this.hidden = true;
                } else {
                    this.addToFilter('sort', this.sort);
                    this.hidden = false;
                }
            } else if (str === 'year') {

                if (this.form.built_year.length === 0) {
                    this.removeFilter('built_year');
                } else {
                    this.addToFilter('built_year', this.form.built_year);
                }
            }
        }
        ,
        addToFilter(key, value) {
            this.filterValue[key] = value;
            this.submitFilter();
            this.loader = true;
        }
        ,
        removeTag(key) {
            delete this.filterValue[key];
            switch (key) {
                case 'purpose':
                    this.isActive = false;
                    this.isInactive = false;
                    break;
                case 'type':
                    this.resActive = false;
                    this.comActive = false;
                    break;
                case 'category':
                    let select = event.target.parentNode;
                    select.removeChild(select.childNodes[0])
                    let el = document.getElementById('categ');
                    let child = el.childNodes;
                    // Remove active class from all other crores buttons
                    for (var i = 0; i < child.length; i++) {
                        el.childNodes[i].childNodes[0].classList.remove('active');
                    }
                    break;
                case 'road_type':
                    let select1 = event.target;
                    select1.parentNode.removeChild(select1);
                    this.tagRemoveHelper('road');
                    break;
                case 'price':
                    let select2 = event.target;
                    select2.parentNode.removeChild(select2);
                    this.tagRemoveHelper('corer');
                    break;

            }
        }
        ,
        tagRemoveHelper(element) {
            var el = document.getElementById(element);
            let child = el.childNodes;
            // Remove active class from all other crores buttons
            for (var i = 0; i < child.length; i++) {
                el.childNodes[i].childNodes[0].classList.remove('active');
            }
        }
        ,
        removeFilter(key) {
            delete this.filterValue[key];
            this.submitFilter();
            this.loader = true;
        }
        ,
        //wait for 2 seconds so that user is still inputting data
        //after 2 second only api request is send
        submitFilter: debounce(function () {
            console.log(this.filterValue)
            let val = JSON.stringify(this.filterValue);
            console.log(val)
            axios.get('/api/getFilter/' + val)
                .then((data) => {
                    this.loader = false;
                    this.properties = data.data;

                }).catch(() => {
                })
        }, 1000)
        ,
        //end of filter section
        toggleSaleRentRender(e) {
            if (e === 'sale') {
                this.isActive = true;
                this.isInactive = false;
                this.sellRent = 'sell';
                this.addToFilter('purpose', 'sell');
            } else if (e === 'rent') {

                this.isInactive = true;
                this.isActive = false;
                this.sellRent = 'rent';
                this.addToFilter('purpose', 'rent');
            }
        },

        // Filter Toggle Section Starts
        toggleSaleRent(e) {
            if (e == 'sale') {
                if (this.isActive) {
                    this.isActive = false;
                    this.removeFilter('purpose');
                } else {
                    this.isActive = true;
                    this.isInactive = false;
                    this.sellRent = 'sell';
                    this.addToFilter('purpose', 'sell');
                }
            } else if (e == 'rent') {
                if (this.isInactive) {
                    this.isInactive = false;
                    this.removeFilter('purpose');
                } else {
                    this.isInactive = true;
                    this.isActive = false;
                    this.sellRent = 'rent';
                    this.addToFilter('purpose', 'rent');
                }
            }
        }
        ,
        toggleResCom(e) {
            if (e == 'residential') {
                if (this.resActive) {
                    this.resActive = false;
                    this.removeFilter('type');
                } else {
                    this.resActive = true;
                    this.comActive = false;
                    this.addToFilter('type', 'residential');
                }
            } else if (e == 'commercial') {
                if (this.comActive) {
                    this.comActive = false;
                    this.removeFilter('type');
                } else {
                    this.comActive = true;
                    this.resActive = false;
                    this.addToFilter('type', 'commercial');
                }
            }
        }
        ,
        toggleCrore(event) {
            let val;
            switch (event.target.textContent) {
                case '1 Cr.':
                    val = 100000000;
                    break;
                case '2 Cr.':
                    val = 200000000;
                    break;
                case '5 Cr.':
                    val = 500000000;
                    break;
                case '10 Cr.':
                    val = 1000000000;
                    break;
                case '20 Cr.':
                    val = 2000000000;
                    break;
                case '50 Cr.':
                    val = 5000000000;
                    break;
                case '100 Cr.':
                    val = 10000000000;
                    break;
            }
            this.addToFilter('price', val);
            let parent = event.target.parentElement.parentElement;
            let el = event.target;
            let children = parent.childNodes;
            if (el.classList.contains('active')) {
                el.classList.remove('active');
                this.removeFilter('price');
                this.getClass(false);
            } else {
                // Remove active class from all other crores buttons
                for (var i = 1; i < children.length - 1; i++) {
                    children[i].childNodes[0].classList.remove('active');
                }
                el.classList.add('active');
                this.getClass(true);
            }
        }
        ,
        toggleRoadType(event) {
            const e = event.target;
            this.addToFilter('road_type', e.textContent);
            const parent = e.parentElement.parentElement;
            const children = parent.childNodes;
            console.log(children)
            if (e.classList.contains('active')) {
                e.classList.remove('active');
                this.getClass(false);
                this.removeFilter('road_type');
            } else {
                for (var i = 1; i < children.length - 1; i++) {
                    children[i].childNodes[0].classList.remove('active');
                }
                e.classList.add('active');
                this.getClass(true);
            }
        }

        ,
        toggleCategories(e) {
            this.addToFilter('category', e.target.textContent);
            let parent = e.target.parentElement.parentElement;
            let el = e.target;
            let children = parent.childNodes;
            if (el.classList.contains('active')) {
                el.classList.remove('active');
                this.getClass(false);
                this.removeFilter('category');
            } else {
                for (var i = 1; i < children.length - 1; i++) {
                    children[i].childNodes[0].classList.remove('active');
                }
                el.classList.add('active');
                this.getClass(true);
            }
        }
        ,
        getClass(val) {
            return {
                active: !val,
                'text-dark': val
            }
        }
        ,
        // Filter Toggle Section Ends
        getCoverImage() {
            return "/img/global/ktm.jpg";
        }
        //method for filter
        ,
        getResults(page = 1) {
            const windowHeight = window.innerHeight;
            const scrollPosition = Math.round(windowHeight * 0.6);
            window.scrollTo(0, scrollPosition);
            this.loader = true;
            let val = JSON.stringify(this.filterValue);
            axios.get('/api/getFilter/' + val + '?page=' + page)
                .then(response => {
                    this.properties = response.data;
                    this.loader = false;
                });

        }
        ,
        loadProperties() {
            axios.get('/api/property')
                .then(response => {
                    this.properties = response.data;
                });
        }
        ,
        getPropertyImage(src) {
            return "/img/thumbnail/1ed3c4ec6c368c65d77ad2a4de23a709.jpeg";

        },
        toggle(event) {
            parent = event.target.parentElement;
            if (parent.tagName === 'SPAN') {
                parent = parent.parentElement;
            }
            let val = parent.childNodes[1].style.display;

            if (val === "none") {
                parent.childNodes[1].style.display = "block";
            } else {
                parent.childNodes[1].style.display = "none";
            }
        },

        toggleMobile(event) {
            parent = event.target.parentElement;
            let val = parent.childNodes[4].style.display;
            if (val === "block") {
                parent.childNodes[4].style.display = "none";
            } else {
                parent.childNodes[4].style.display = "block";
            }
        }
    }
}
</script>

<style lang="scss" scoped>
//paginate
.pagination {
    list-style: none;
    display: flex;
    cursor: pointer;
    justify-content: center;
    margin-top: 2rem;

}

.area {
    b {
        color: #435061;
    }
}

.mobile-padding {
    @media only screen and (max-width: 500px) {
        padding: 0;
    }
}

.mobile-filter {
    @media only screen and (max-width: 768px) {
        display: none;
    }

    display: block;
}

.desktop-toggle {
    @media only screen and (max-width: 768px) {
        display: none;
    }
}

.mobile-sort {
    @media only screen and (min-width: 900px) {
        display: none;
    }

    input {
        opacity: 0;
    }
}

.mobile-toggle {
    background: #38A1DA;
    color: white;
    text-align: center;
    padding: 1rem;

    @media only screen and (min-width: 800px) {
        display: none;
    }
}

.tags {
    display: flex;
    padding: 0 20px;
    flex-wrap: wrap;

    .filter-tags {
        margin-bottom: 5px;

        span {
            font-size: 12px;
            font-weight: 200;
        }
    }
}

.filter-header-container {
    display: flex;
    justify-content: space-between;
    padding-right: 10px;

    @media only screen and (max-width: 768px) {
        display: none;
    }

}

.filter {
    padding: 0 20px;
}

.toggleBtns {
    button {
        font-size: 14px;
    }
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

.hideShow {
    display: none;
}

/*css loader*/

.property-container {
    padding: 10vh 5vh;
}

.lds-facebook {
    display: block;
    position: relative;
    width: 64px;
    height: 64px;
    margin: auto;
    top: 10%;
}

.lds-facebook div {
    display: inline-block;
    position: absolute;
    left: 6px;
    width: 13px;
    background: #38A1DA;
    animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
}

.lds-facebook div:nth-child(1) {
    left: 6px;
    animation-delay: -0.24s;
}

.lds-facebook div:nth-child(2) {
    left: 26px;
    animation-delay: -0.12s;
}

.lds-facebook div:nth-child(3) {
    left: 45px;
    animation-delay: 0s;
}

@keyframes lds-facebook {
    0% {
        top: 6px;
        height: 51px;
    }

    50%,
    100% {
        top: 19px;
        height: 26px;
    }
}

/* Buy Sell Button */
.toggleBtns {
    padding: 0;
}

.toggleBtns li {
    list-style: none;
    display: inline-block;
}

.toggleBtns li .btn-outline-primary:hover {
    color: white !important;
}

/*this section is for image header*/
.property_details_header {
    width: 100%;
    background: black;
    height: 50vh;

    @media only screen and (max-width: 1100px) {
        height: 35vh;
    }

    img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        object-position: top;
        opacity: 0.6;
    }

    .title {
        position: relative;
        top: -35vh;
        font-size: 8vh;
        font-weight: bold;
        color: whitesmoke;
        display: flex;
        justify-content: center;
        width: 100%;
        text-shadow: 4px 3px 0 #000;

        @media only screen and (max-width: 1100px) {
            top: -15vh;
            font-size: 4vh;
        }
    }
}

.property_details_searchbar {
    width: 100%;
    position: relative;
    top: -2px;
}

.property_details_searchbar .main_search_box {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.property_details_searchbar .main_search_box select {
    border: gray solid 0.5px;
    border-radius: 0;
}

.property_details_searchbar .main_search_box button {
    border-radius: 0;
}

/*this section is for horizontal ruler*/
.horizontal1 {
    top: 10%;
}

/*this section is for filter */

.slide-down-hover {
    color: #31A2E1;
}

.list-filter {
    padding: 20px;
    list-style-type: none;
}

/*---------------this section is for card display in right side*/

.card-body {
    padding-top: 8px;
    padding-bottom: 8px;

}

.search-title,
.dropdown-sort {
    display: inline;
}

.search-title {
    color: #435061;
    margin-left: 1vh;
    font-weight: bold;
}

.dropdown-sort {
    width: 14em;
    background: #ebecf0;
    border: none;
    display: flex;

    @media only screen and (max-width: 768px) {
        display: none;
    }
}

.card-container {
    img {
        height: 50%;
        object-fit: cover;
    }
}

.card-container:hover {
    transform: translate(0, -10px);
    box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    transition: all ease .8s;
}

.card-title {
    color: #435061;
    font-size: 18px;
    font-weight: bold;
}

.card-price,
.card-heart {
    color: #31A2E1;
}

.description-1,
.description-2 {
    display: inline;
    color: #435061;
}

.description-2 {
    font-weight: bold;

}

h2 {
    font-weight: bold;
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
    font-family: titillium web !important;
}
</style>