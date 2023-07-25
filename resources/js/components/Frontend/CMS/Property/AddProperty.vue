<template>
    <div>
        <!--Title -->
        <div class="container-fluid mt-4 border bg-light">
            <div class="col-12">
                <div class="mt-4 mb-3">
                    <div class="section-title text-dark">
                        <template v-if="$store.getters.isEdit">
                            <h3 class="font-weight-bold">Update a Property</h3>
                        </template>
                        <template v-else>
                            <h3 class="font-weight-bold">Add a Property</h3>
                        </template>
                    </div>
                </div>
            </div>
        </div>
        <form @submit.prevent="$store.getters.isEdit ? editProperty($route.params.id) : createProperty()">
            <!-- Property Category Section Starts -->
            <div class="container-fluid my-2 border bg-light">
                <div class="col-12">
                    <div class="my-2 mb-3">
                        <!-- Sell or Buy Starts-->
                        <div class="section-title text-dark">
                            <h5 class="font-weight-bold">I want to : </h5>
                        </div>
                        <div id="sellRent">
                            <div class="form-check form-check-inline">
                                <input type="radio" value="sell" class="form-check-input" id="sell" name="purpose"
                                    v-model="form.purpose" v-bind:checked="checked" />
                                <label class="form-check-label" for="rent">Sell</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" value="rent" class="form-check-input" id="rent" name="sellRent"
                                    v-model="form.purpose">
                                <label class="form-check-label" for="rent">Rent</label>
                            </div>
                        </div>
                        <!-- Sell Buy Ends -->
                        <!-- Property Type Starts-->
                        <div class="section-title text-dark mt-3">
                            <h6 class="font-weight-bold">Property Type : </h6>
                        </div>
                        <div id="property-type" class="d-flex flex-row my-3">
                            <input class="form-check-input" type="radio" value="residential" id="residential" name="type"
                                v-model="form.type" v-bind:checked="checked">
                            <label class="form-check-label py-1 px-2  " for="residential">
                                <i class="fas fa-home"></i>
                                Residential
                            </label>
                            <input class="form-check-input" type="radio" value="commercial" id="commercial" name="type"
                                v-model="form.type" />
                            <label class="form-check-label py-1 px-2 ml-3" for="commercial">
                                <i class="fas fa-industry"></i>
                                Commercial
                            </label>
                        </div>
                        <!-- Property Type Ends -->
                        <!-- Property Category Starts-->
                        <div class="section-title text-dark mt-2">
                            <h6 class="font-weight-bold">Property Category : </h6>
                        </div>
                        <div id="property-category" class="d-flex flex-row my-3">
                            <input class="form-check-input" type="radio" value="house" name="category" id="house"
                                v-model="form.category" v-on:click="toggleThree('house')" v-bind:checked="checked" />
                            <label
                                class="form-check-label py-2 px-3 d-flex flex-column align-items-center justify-content-center"
                                for="house">
                                <i class="fas fa-home"></i>
                                House
                            </label>
                            <input class="form-check-input" type="radio" value="land" id="land" name="category"
                                v-on:click="toggleThree('land')" v-model="form.category" v-bind:checked="unchecked" />
                            <label
                                class="form-check-label py-2 px-3 ml-3 d-flex flex-column align-items-center justify-content-center"
                                for="land">
                                <i class="fas fa-layer-group"></i>
                                Land
                            </label>
                            <input class="form-check-input" type="radio" value="apartment" id="apartment" name="category"
                                v-on:click="toggleThree('house')" v-model="form.category" v-bind:checked="unchecked" />
                            <label
                                class="form-check-label py-2 px-3 ml-3 d-flex flex-column align-items-center justify-content-center"
                                for="apartment">
                                <i class="fas fa-industry"></i>
                                Apartment
                            </label>
                        </div>
                        <!-- Property Category Section Ends -->
                    </div>
                </div>
            </div>
            <!-- Category Section Ends -->

            <!-- Property Category Section Starts In Case of Home-->
            <!-- Address Section Starts -->
            <div class="container-fluid my-2 py-3 border bg-light">
                <div class="col-12">
                    <div class="my-2">
                        <!-- Address Starts-->
                        <div class="section-title text-dark mt-2">
                            <h5 class="font-weight-bold">Address Details:</h5>
                        </div>
                        <div class="form-row my-3">
                            <div class="col-sm-6 col-md-5 col-lg-4 mb-3">
                                <label for="address" class="font-weight-light">Address:</label>
                                <input type="text" v-model="form.address" class="form-control" placeholder="Eg: New Road"
                                    name="address" id="address" :class="{ 'is-invalid': form.errors.has('address') }">
                                <has-error :form="form" field="address"></has-error>
                            </div>
                            <div class="col-sm-6 col-md-5 col-lg-4">
                                <label for="location" class="font-weight-light">Property Location :</label>
                                <select class="form-control" name="location" id="location"
                                    :class="{ 'is-invalid': form.errors.has('location') }" v-model="form.location">
                                    <option value="" disabled="dropzone">Select a district</option>
                                    <option v-for="location in locations" :value="location" :key="location.id">
                                        {{ location }}
                                    </option>
                                </select>
                                <has-error :form="form" field="location"></has-error>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Address Section Ends -->
            <div class="container-fluid my-2 py-3 border bg-light">
                <div class="col-12">
                    <div class="my-2">
                        <!-- Total Area Starts-->
                        <div class="section-title text-dark mt-2">
                            <h5 class="font-weight-bold">Area (in aana) : </h5>
                        </div>
                        <div class="form-row my-3 d-flex flex-row">
                            <div class="col-sm-6 col-md-5 col-lg-4 mb-3">
                                <label for="totalArea" class="font-weight-light">Total Area :</label>
                                <input type="number" v-model="form.area_total" class="form-control"
                                    placeholder="Total area in number" id="totalArea" name="area_total"
                                    :class="{ 'is-invalid': form.errors.has('area_total') }">
                                <has-error :form="form" field="area_total"></has-error>
                            </div>
                            <div v-show="house" class="col-sm-6 col-md-5 col-lg-4">
                                <label for="builtUpArea" class="font-weight-light">Built up Area :</label>
                                <input type="number" v-model="form.area_built" class="form-control"
                                    placeholder="Enter the built Up Area" id="builtUpArea" name="area_built"
                                    :class="{ 'is-invalid': form.errors.has('area_built') }">
                                <has-error :form="form" field="area_built"></has-error>

                            </div>
                        </div>
                        <!-- Total Area Ends -->
                        <!-- Property Face Starts-->
                        <div class="section-title text-dark mt-2">
                            <h6>Property Face : </h6>
                        </div>
                        <div class="form-row my-3">
                            <div class="col-sm-6 col-md-5 col-lg-4">
                                <select class="form-control" v-model="form.face" id="propertyFace" name="face"
                                    :class="{ 'is-invalid': form.errors.has('face') }">

                                    <option value="" disabled="disabled">Select property face</option>
                                    <option value="east">East</option>
                                    <option value="west">West</option>
                                    <option value="north">North</option>
                                    <option value="south">South</option>
                                    <option value="north-east">North-East</option>
                                    <option value="north-west">North-West</option>
                                    <option value="south-east">South-East</option>
                                    <option value="south-west">South-West</option>
                                </select>
                                <has-error :form="form" field="face"></has-error>
                            </div>
                        </div>
                        <!-- Property Face Ends -->
                        <!-- Road Section Starts-->
                        <div class="section-title text-dark mt-2">
                            <h5 class="font-weight-bold">Road Details: </h5>
                        </div>
                        <div class="form-row my-3">
                            <!-- Road Size -->
                            <div class="col-sm-6 col-md-3 col-lg-3 mb-3">
                                <label for="roadSize" class="font-weight-light">Road Size :</label>
                                <input type="number" class="form-control" v-model="form.road_size"
                                    placeholder="Road Size (in meters)" id="roadSize" name="road_size"
                                    :class="{ 'is-invalid': form.errors.has('road_size') }">
                                <has-error :form="form" field="road_size"></has-error>
                                Eg: 3

                            </div>
                            <!-- Road Type -->
                            <div class="col-sm-6 col-md-3 col-lg-3">
                                <label for="roadType" class="font-weight-light">Road Type :</label>
                                <select class="form-control" v-model="form.road_type" id="roadType" name="road_type"
                                    :class="{ 'is-invalid': form.errors.has('road_type') }">

                                    <option value="" disabled="dropzone">Select Road type</option>
                                    <option value="gravelled">Gravelled</option>
                                    <option value="paved">Paved</option>
                                    <option value="blacktopped">Blacktopped</option>
                                    <option value="soil-stabilized">Soil Stabilized</option>
                                </select>
                                <has-error :form="form" field="road_type"></has-error>
                            </div>
                        </div>
                        <!-- Road Section Ends-->
                        <!-- In case of land, these section is not shown start -->
                        <!-- v-if="HouseOrLand()" -->
                        <has-error :form="form" field="span"></has-error>
                        <div v-show="house">
                            <!-- Building Details -->
                            <div class="section-title text-dark">
                                <h5 class="font-weight-bold">Building Details : </h5>
                            </div>
                            <div class="form-row my-3">
                                <!-- Built Year -->
                                <div class="col-sm-6 col-md-5 col-lg-3 mb-2">
                                    <label for="builtYear" class="font-weight-light">Built Year :</label>
                                    <select class="form-control" v-model="form.built_year" id="builtYear" name="built_year"
                                        :class="{ 'is-invalid': form.errors.has('built_year') }">
                                        <option value="" disabled="disabled">Select a year</option>
                                        <option value="2010">2010</option>
                                        <option value="2011">2011</option>
                                        <option value="2012">2012</option>
                                        <option value="2013">2013</option>
                                        <option value="2014">2014</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                    </select>
                                    <has-error :form="form" field="built_year"></has-error>
                                </div>
                                <!-- Built Year Ends -->
                                <!-- Total Floors -->
                                <div class="col-sm-6 col-md-5 col-lg-3 mb-2">
                                    <label for="totalFloors" class="font-weight-light">Total Floors :</label>
                                    <input type="number" v-model="form.floors" class="form-control" placeholder="Eg. 6"
                                        id="totalFloors" name="floors" :class="{ 'is-invalid': form.errors.has('floors') }">
                                    <has-error :form="form" field="floors"></has-error>
                                </div>
                                <!-- Total Floors Ends -->
                                <!-- Furnished Starts -->
                                <div class="col-sm-6 col-md-5 col-lg-3 mb-2">
                                    <label for="furnished" class="font-weight-light">Furnishing Status :</label>
                                    <select class="form-control" v-model="form.furnish_status" id="furnished"
                                        name="furnish_status" :class="{ 'is-invalid': form.errors.has('furnish_status') }">
                                        <option value="" disabled="disabled">Select One</option>
                                        <option value="unfurnished">Unfurnished</option>
                                        <option value="semi-furnished">Semi Furnished</option>
                                        <option value="furnished">Furnished</option>
                                    </select>
                                    <has-error :form="form" field="furnish_status"></has-error>
                                </div>
                                <!-- Furnished Ends -->
                            </div>
                            <!-- Building Details Ends -->
                            <!-- Features Section Starts -->
                            <div class="my-3">
                                <div class="section-title text-dark">
                                    <h5 class="font-weight-bold">Features (in numbers) : </h5>
                                </div>
                                <div class="form-row my-3 d-flex flex-row">
                                    <div class="col-sm-5 col-md-4 col-lg-2 mb-3">
                                        <input type="number" v-model="form.kitchen" class="form-control"
                                            placeholder="Kitchen" id="kitchen" name="kitchen"
                                            :class="{ 'is-invalid': form.errors.has('kitchen') }">
                                        <has-error :form="form" field="kitchen"></has-error>
                                    </div>
                                    <div class="col-sm-5 col-md-4 col-lg-2 mb-3">
                                        <input type="number" v-model="form.bedroom" class="form-control"
                                            placeholder="Bedroom" id="bedroom" name="bedroom"
                                            :class="{ 'is-invalid': form.errors.has('bedroom') }">
                                        <has-error :form="form" field="bedroom"></has-error>
                                    </div>
                                    <div class="col-sm-5 col-md-4 col-lg-2 mb-3">
                                        <input type="number" v-model="form.bathroom" class="form-control"
                                            placeholder="Bathroom" id="bathroom" name="bathroom"
                                            :class="{ 'is-invalid': form.errors.has('bathroom') }">
                                        <has-error :form="form" field="bathroom"></has-error>
                                    </div>
                                    <div class="col-sm-5 col-md-4 col-lg-2 mb-3">
                                        <input type="number" v-model="form.living_room" class="form-control"
                                            placeholder="Living Room" id="livingRoom" name="living_room"
                                            :class="{ 'is-invalid': form.errors.has('living_room') }">
                                        <has-error :form="form" field="living_room"></has-error>
                                    </div>
                                    <div class="col-sm-5 col-md-4 col-lg-2 mb-3">
                                        <input type="number" v-model="form.parking" class="form-control"
                                            placeholder="Parking" id="parking" name="parking"
                                            :class="{ 'is-invalid': form.errors.has('parking') }">
                                        <has-error :form="form" field="parking"></has-error>
                                    </div>
                                </div>
                            </div>
                            <!-- Features Section Ends -->
                            <!-- Amenities Section Starts -->
                            <div class="my-2">
                                <!-- Address Starts-->
                                <div class="section-title text-dark mt-2">
                                    <h5 class="font-weight-bold">Amenities : </h5>
                                </div>
                                <div class=" mr-1">
                                    <div class="form-row my-3 d-flex justify-content-start text-center" id="amenities">
                                        <div>
                                            <input class="form-check-input" v-model="form.amenities" type="checkbox"
                                                value="lawn" id="lawn" name="lawn">
                                            <label class="form-check-label py-2 px-2 ml-3 mb-2" for="lawn">
                                                <small>Lawn</small>
                                            </label>
                                        </div>
                                        <div>
                                            <input class="form-check-input" v-model="form.amenities" type="checkbox"
                                                value="garage" id="garage" name="garage">
                                            <label class="form-check-label py-2 px-2 ml-3 mb-2" for="garage">
                                                <small>Garage</small>
                                            </label>
                                        </div>
                                        <div>
                                            <input class="form-check-input" v-model="form.amenities" type="checkbox"
                                                value="frontyard" id="frontyard" name="frontyard">
                                            <label class="form-check-label py-2 px-2 ml-3 mb-2" for="frontyard">
                                                <small>Frontyard</small>
                                            </label>
                                        </div>
                                        <div>
                                            <input class="form-check-input" v-model="form.amenities" type="checkbox"
                                                value="backyard" id="backyard" name="backyard">
                                            <label class="form-check-label py-2 px-2 ml-3 mb-2" for="backyard">
                                                <small>Backyard</small>
                                            </label>
                                        </div>
                                        <div>
                                            <input class="form-check-input" v-model="form.amenities" type="checkbox"
                                                value="balcony" id="balcony" name="balcony">
                                            <label class="form-check-label py-2 px-2 ml-3 mb-2" for="balcony">
                                                <small>Balcony</small>
                                            </label>
                                        </div>
                                        <div>
                                            <input class="form-check-input" v-model="form.amenities" type="checkbox"
                                                value="swimming-pool" id="swimmingPool" name="pool">
                                            <label class="form-check-label py-2 px-2 ml-3 mb-2" for="swimmingPool">
                                                <small>Swimming Pool</small>
                                            </label>
                                        </div>
                                        <div>
                                            <input class="form-check-input" v-model="form.amenities" type="checkbox"
                                                value="tv-cable" id="tvCable" name="cable">
                                            <label class="form-check-label py-2 px-2 ml-3 mb-2" for="tvCable">
                                                <small>TV Cable</small>
                                            </label>
                                        </div>
                                        <div>
                                            <input class="form-check-input" v-model="form.amenities" type="checkbox"
                                                value="washing-machine" id="washingMachine" name="washing_machine">
                                            <label class="form-check-label py-2 px-2 ml-3 mb-2" for="washingMachine">
                                                <small>Washing Machine</small>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Amenities Section Ends -->
                        </div>
                        <!-- In case of land, these section is not shown Ends -->
                    </div>
                </div>
            </div>
            <!-- Property Category Section Ends in case of Home -->
            <!-- Drag and Drop Photos Section Starts -->
            <div class="container-fluid my-2 py-3 border bg-light">
                <div class="col-12">
                    <div class="my-3">
                        <div class="section-title text-dark">
                            <h5 class="font-weight-bold">Upload Photos : </h5>
                        </div>
                        <div class="form-row my-4">
                            <!-- Drag and Dropzone for Uploading Images -->
                            <div class="col-10 justify-content-center" :class="{ 'is-invalid': form.errors.has('images') }">

                                <div class="helper"></div>
                                <div class="drop display-inline align-center" @dragover.prevent @drop="onDrop">
                                    <div class="helper"></div>
                                    <label v-if="!image" class="btn display-inline">
                                        SELECT OR DROP AN IMAGE
                                        <input type="file" name="images" @change="onChange" multiple>

                                    </label>
                                    <div class="hidden display-inline align-center" v-else v-bind:class="{ 'image': true }">
                                        <img :src="image" alt="" class="img" />
                                        <br>
                                        <br>
                                        <button class="btn" @click="removeFile">REMOVE</button>
                                        {{ imageCount }} Files Chosen<br>
                                    </div>
                                </div>
                                <!--end of image upload section-->
                                <span v-if="!image" style="color:red;">*Image Field is required</span>
                                <has-error :form="form" field="images"></has-error>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Drag and Drop Photos Section Ends -->
            <!-- Property Details Section Starts -->
            <div class="container-fluid my-2 py-3 border bg-light">
                <div class="col-12">
                    <div class="my-2">
                        <!-- Property Title -->
                        <div class="section-title text-dark">
                            <h5 class="font-weight-bold">Property Title : </h5>
                        </div>
                        <div class="form-row my-3">
                            <div class="col-sm-6 col-md-5 col-lg-4">
                                <input type="text" class="form-control" v-model="form.title" placeholder="Property Title"
                                    id="propertyTitle" name="title" :class="{ 'is-invalid': form.errors.has('title') }">
                                <has-error :form="form" field="title"></has-error>
                            </div>
                        </div>
                        <!-- Property Description -->
                        <div class="section-title text-dark">
                            <h5 class="font-weight-bold">Property Description : </h5>
                        </div>
                        <div class="form-row my-3">
                            <div class="col-sm-10 col-md-9 col-lg-8">
                                <textarea v-model="form.description" class="form-control"
                                    placeholder="Few descriptions about your property" name="description" rows="6"
                                    :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                                <has-error :form="form" field="description"></has-error>
                            </div>
                        </div>
                        <!-- Price Details -->
                        <div class="section-title text-dark">
                            <h5 class="font-weight-bold">Price Amount : </h5>
                        </div>
                        <div class="form-row my-3">
                            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                                <label for="perUnit" class="font-weight-light">Cost Price</label>
                                <input type="number" v-model="form.price" class="form-control" placeholder="Property Price"
                                    id="propertyPrice" name="price" :class="{ 'is-invalid': form.errors.has('price') }">
                                <has-error :form="form" field="price"></has-error>
                            </div>
                            <div v-show="land" class="col-sm-6 col-md-4 col-lg-3">
                                <label for="perUnit" class="font-weight-light">Measurement Unit</label>
                                <select class="form-control" v-model="form.price_unit" id="perUnit" name="price_unit"
                                    :class="{ 'is-invalid': form.errors.has('price_unit') }">
                                    <option value="" disabled="disabled">Select Per unit</option>
                                    <option value="sqFt">Per Sq.ft</option>
                                    <option value="Ropani">Per Ropani</option>
                                    <option value="Aana">Per Aana</option>
                                    <option value="Paisa">Per Paisa</option>
                                    <option value="Daam">Per Daam</option>
                                    <option value="Bigha">Per Bigha</option>
                                    <option value="Acres">Per Acres</option>
                                </select>
                                <has-error :form="form" field="price_unit"></has-error>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Property Details Section Ends -->
            <!-- Owner Details Section Starts -->
            <div class="container-fluid my-2 py-3 border bg-light">
                <div class="col-12">
                    <div class="my-2">
                        <div class="form-row my-3">
                            <input type="hidden" v-model="form.owner_id" class="form-control" id="ownerEmail"
                                name="owner_id" :class="{ 'is-invalid': form.errors.has('owner_id') }">
                            <has-error :form="form" field="owner_id"></has-error>
                            <!-- Owner Information Section Ends -->
                            <div class="my-2 col-12">
                                <template v-if="$store.getters.isEdit">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Update Property">
                                </template>
                                <template v-else>
                                    <input type="submit" name="submit" class="btn btn-primary" value="Add Property">
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Owner Details Section Ends -->
        </form>
    </div>
</template>
<script>
import Form from 'vform'
export default {
    name: "AddProperty.vue",
    data() {
        return {
            category: 'house',
            checked: true,
            unchecked: false,
            house: true,
            land: false,
            image: '',
            editMode: this.$store.getters.isEdit,
            editId: '',
            propeties: {},
            locations: {},
            imageCount: 0,
            form: new Form({
                id: '',
                purpose: 'sell',
                type: 'residential',
                category: 'house',
                address: '',
                location: '',
                road: '',
                images: [],
                title: '',
                description: '',
                area_total: '',
                area_built: '',
                face: '',
                road_size: '',
                road_type: '',
                price: '',
                price_unit: '',
                owner_id: this.$store.getters.currentUser.id,
                built_year: '',
                furnish_status: '',
                kitchen: '',
                bedroom: '',
                bathroom: '',
                living_room: '',
                parking: '',
                amenities: [],
                floors: ''
            }),
        }
    },
    components: {},
    created() {

        axios.get('/api/location').then((data) => {
            this.locations = data.data;
        });


        //this code is for edit
        //if parameter passed as id then
        //we retrieved required data and fill based on category
        //image also loaded
        if (typeof this.$route.params.id !== 'undefined') {
            this.$store.dispatch('setEditMode', true);
            axios.get('/api/property/' + this.$route.params.id)
                .then((data) => {
                    let id = data.data.id;
                    let object1 = data.data;
                    if (data.data.category !== 'land') {
                        axios.get("/api/propertyHouse/" + id).then(({ data }) => {
                            this.form.furnish_status = data[0].furnish_status;
                            this.form.built_year = data[0].built_year;
                            this.form.kitchen = data[0].kitchen;
                            this.form.bedroom = data[0].bedroom;
                            this.form.bathroom = data[0].bathroom;
                            this.form.living_room = data[0].living_room;
                            this.form.parking = data[0].parking,
                                this.form.floors = data[0].no_floors;
                            this.form.amenities = (data[0].amenities.split(","));
                        });
                    } else {
                        this.house = false;
                        this.land = true;
                    }
                    this.form.fill(object1);
                    if (data.data.category == 'land') {
                        this.form.amenities = [];
                    }

                    this.getPreviewImage();
                })
                .catch(() => {
                })
        }

    },
    // updated() {
    //     this.$swal.$on('resetProperty', () => {
    //         this.form.reset();
    //         this.removeFile();
    //     });
    // },
    destroyed() {
        this.form.reset();
    },
    methods: {
        getPreviewImage() {
            let arrImg = this.form.images.split(",");
            this.image = "/img/property/" + arrImg[0];
            this.imageCount = arrImg.length;
        },
        toggleThree(e) {
            if (e == 'land') {
                this.house = false;
                this.land = true;
            } else {
                this.land = false;
                this.house = true;
            }
        },
        createProperty() {
            console.log(this.form)

            // this.$Progress.start();
            this.form.post('/api/property')
                .then(() => {
                    // console.log(this.form)
                    this.form.reset();
                    this.removeFile();
                    this.$swal.fire({
                        icon: 'success',
                        title: 'Property Created Successfully !!!'
                    });
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$swal.fire(
                        'Validation Failed',
                        'Please fill all the fields Properly  !!!',
                        'warning'
                    )
                })
        },//end of function
        editProperty(id) {
            // this.$Progress.start();
            this.form.put('/api/property/' + id)
                .then((id) => {
                    //success
                    this.$swal.fire(
                        'Updated!',
                        'Information has been updated.',
                        'success'
                    );
                    // this.$Progress.finish();
                    this.form.reset();
                    this.$router.push({ name: 'allproperties' });
                })
                .catch(() => {
                    //fail
                    // this.$Progress.fail();//changes the color of vue progress bar
                })
        },
        imageSave(files) {
            //using base64 for converting image into text and vice versa
            //let files = e.target.files;
            this.imageCount = files.length;
            for (var i = 0; i < files.length; i++) {
                let reader = new FileReader();
                let file = files[i];
                if (!file.type.match('image.*')) {
                    this.form.images = [];
                    alert('Select an image');
                    return;
                }
                reader.onloadend = (file) => {
                    this.form.images.push(reader.result);
                    //stores image in format of text
                }
                reader.readAsDataURL(file);
            }
        },
        onDrop: function (e) {
            e.stopPropagation();//stops bubble propogation
            e.preventDefault();
            var files = e.dataTransfer.files;
            this.imageSave(files);
            this.createFile(files[0]);
        },
        onChange(e) {
            var files = e.target.files;
            this.imageSave(files);
            this.createFile(files[0]);
        },
        createFile(file) {
            if (!file.type.match('image.*')) {
                alert('Select an image');
                return;
            }
            var img = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = function (e) {
                vm.image = e.target.result;
            }
            reader.readAsDataURL(file);
        },
        removeFile() {
            this.form.images = [];
            this.image = '';//image preview variable
            this.imageCount = 0;
        }

    }
}
</script>
<style scoped>
.btn_remove {
    background-color: #d3394c;
    border: 0;
    color: #fff;
    cursor: pointer;
    display: inline-block;
    font-weight: bold;
    padding: 15px 35px;
    position: relative;
}

.btn_remove:hover {
    background-color: #722040;
}

input[type="file"] {
    position: absolute;
    opacity: 0;
    z-index: -1;
}

.helper {
    /*height: 100%;*/
    display: inline-block;
    vertical-align: middle;
    width: 0;
}

.hidden {
    display: none !important;
}

.hidden.image {
    display: inline-block !important;
}

.display-inline {
    display: inline-block;
    vertical-align: middle;
    height: 80%;
    width: 40%;
}

.img {
    border: 1px solid #f6f6f6;
    display: inline-block;
    height: 100%;
    width: 100%;
}

.drop {
    background-color: #f2f2f2;
    border: 4px dashed #ccc;
    background-color: #f6f6f6;
    border-radius: 2px;
    height: 100%;
    max-height: 400px;
    max-width: 600px;
    width: 100%;
}

/*Sidebar Sticky*/
#sticky-sidebar {
    position: sticky;
    top: 80px;
}

.nav-item .nav-item .nav-link {
    font-size: 0.9em;
}

.noBuildingDetails {
    display: none;
}

.show {
    display: block;
}

.hide {
    display: none;
}

/*Sidebar Sticky*/
#sticky-sidebar {
    position: sticky;
    top: 80px;
}

.nav-item .nav-item .nav-link {
    font-size: 0.9em;
}

/*Main container box layouts*/
.main-container .container-fluid {
    -webkit-box-shadow: 0px 0px 20px 2px rgba(0, 0, 0, 0.37);
    -moz-box-shadow: 0px 0px 20px 2px rgba(0, 0, 0, 0.37);
    box-shadow: 0px 0px 20px 2px rgba(0, 0, 0, 0.37);
}

#sellRent input:checked+.circle {
    background-color: #007bff;
    color: white;
    border-radius: 5px;
}

/*Property Type*/
#property-type input[type="radio"] {
    display: none;
}

/*#38A1DA*/
#property-type input+label {
    border: 1px solid #EBECF0;
    color: black;
    border-radius: 5px;
}

#property-type input:checked+label {
    background-color: #007bff;
    background-color: #38A1DA;
    color: white;
    border-radius: 5px;
}

#property-type input:hover+label {
    border: 1px solid rgba(255, 0, 0, .2);
    -webkit-background-clip: padding-box;
    /* for Safari */
    background-clip: padding-box;
    /* for IE9+, Firefox 4+, Opera, Chrome */
}

/*Property Category*/
#property-category input[type="radio"] {
    display: none;
}

#property-category input+label {
    border: 1px solid #EBECF0;
    color: black;
    border-radius: 5px;
}

#property-category input:checked+label {
    background-color: #38A1DA;
    color: white;
    border-radius: 5px;
}

#property-category input:hover+label {
    border: 1px solid rgba(255, 0, 0, .2);
    -webkit-background-clip: padding-box;
    /* for Safari */
    background-clip: padding-box;
    /* for IE9+, Firefox 4+, Opera, Chrome */
}

/*Amenities box layout*/
#amenities input[type="checkbox"] {
    display: none;
}

#amenities input+label {
    border: 1px solid rgba(0, 0, 0, .2);
    /*	border: 1px solid #EBECF0;*/
    color: black;
    border-radius: 5px;
    width: 120px;
}

#amenities input:checked+label {
    background-color: #38A1DA;
    color: white;
    border-radius: 5px;
}

#amenities input:hover+label {
    border: 1px solid rgba(255, 0, 0, .2);
    -webkit-background-clip: padding-box;
    /* for Safari */
    background-clip: padding-box;
    /* for IE9+, Firefox 4+, Opera, Chrome */
}

/*Photos drag and drop to upload*/
.dropzone {
    border: 1px dashed #ccc;
    height: 100px;
}

.dropzone.dragover {
    border-color: #000;
    color: #000;
}
</style>
