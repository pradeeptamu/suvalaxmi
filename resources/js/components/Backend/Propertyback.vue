<template>

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Properties Table</h3>

                        <div class="card-tools">

                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Purpose</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Location</th>
                                <th>Price</th>
                                <th>Per Unit</th>
                                <th>Registered At</th>
                                <th>Modify</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="property in properties.data" :key="property.id">
                                <td>{{property.id}}</td>
                                <td>{{property.purpose}}</td>
                                <td>{{property.type}}</td>
                                <td>{{property.category}}</td>
                                <td>{{property.location}}</td>
                                <td>{{property.price }}</td>
                                <td>{{property.price_unit }}</td>
                                <td>{{property.created_at}}</td>
                                <td>
                                    <a href="#" @click="viewModal(property)">
                                        <i class="fa fa-eye blue"></i>
                                    </a>
                                    <a href="#" @click="deleteProperty(property.id)">
                                        <i class="fa fa-trash red"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <pagination :data="properties" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!--<div v-if="!$gate.isAdminOrAuthor()">-->
        <!--<not-found></not-found>-->
        <!--</div>-->
        <!-- Modal -->
        <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="showModalLabel">Properties Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover table-sm">
                            <thead>
                            <tr>
                                <th>Particulars</th>
                                <th>Details</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{form.id}}</td>
                            </tr>
                            <tr>
                                <th>Purpose</th>
                                <td>{{form.purpose}}</td>
                            </tr>
                            <tr>
                                <th>Type</th>
                                <td>{{form.type}}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{form.status}}</td>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <td>{{form.category}}</td>
                            </tr>
                            <tr>
                                <th>Location</th>
                                <td>{{form.location}}</td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td>{{form.price }}</td>
                            </tr>
                            <tr>
                                <th>Per Unit</th>
                                <td>{{form.price_unit }}</td>
                            </tr>
                            <tr>
                                <th>Registered At</th>
                                <td>{{form.created_at}}</td>
                            </tr>

                            <tr>
                                <th>Total Images</th>
                                <td>{{getImageCount()}}</td>
                            </tr>
                            <tr>
                                <th>Title</th>
                                <td>{{form.title}}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{{form.description}}</td>
                            </tr>
                            <tr>
                                <th>Area Total</th>
                                <td>{{form.area_total}} Aana</td>
                            </tr>
                            <tr>
                                <th>Area Built</th>
                                <td>{{form.area_built}} Aana</td>
                            </tr>
                            <tr>
                                <th>Face</th>
                                <td>{{form.face}}</td>
                            </tr>
                            <tr>
                                <th>Road Size</th>
                                <td>{{form.road_size}} Meters</td>
                            </tr>
                            <tr>
                                <th>Road Type</th>
                                <td>{{form.road_type}}</td>
                            </tr>
                            <tr>
                                <th>Name(Owner of Property)</th>
                                <td>{{owner.name}}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{owner.phone}}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{owner.email}}</td>
                            </tr>

                            <template v-if="form.category!='land'">
                            <tr>
                                <th>Built Year  </th>
                                <td>{{propAlt.built_year}}  </td>
                            </tr>
                            <tr>
                                <th>Furnish Status</th>
                                <td>{{propAlt.furnish_status}} </td>
                            </tr>
                            <tr>
                                <th>Kitchen</th>
                                <td>{{propAlt.kitchen}} </td>
                            </tr>
                            <tr>
                                <th>Bedroom</th>
                                <td>{{propAlt.bedroom}}</td>
                            </tr>
                            <tr>
                                <th>Bathroom</th>
                                <td>{{propAlt.bathroom}}   </td>
                            </tr>
                            <tr>
                                <th>Living Room  </th>
                                <td>{{propAlt.living_room}}</td>
                            </tr>
                            <tr>
                                <th>Parking</th>
                                <td>{{propAlt.parking}}</td>
                            </tr>
                            <tr>
                                <th>Amenities</th>
                                <td>{{propAlt.amenities}}</td>
                            </tr>
                            <tr>
                                <th>Floors  </th>
                                <td>{{propAlt.no_floors}}</td>
                            </tr>
                            </template>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i
                                class="fas fa-times-circle"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        name: "Propertyback.vue",
        data() {
            return {
                image: '',
                editMode: false,
                properties: {},
                propAlt: {},
                owner:{},
                form: new Form({
                    id: '',
                    purpose: '',
                    type: '',
                    category: '',
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
                    owner_id: '',
                    status:'',
                    created_at:''
                    // furnish_status: '',
                    // kitchen: '',
                    // bedroom: '',
                    // bathroom: '',
                    // living_room: '',
                    // parking: '',
                    // amenities: [],
                    // floors: ''
                }),
            }
        }, created() {
            // this.$store.dispatch('setComponentName','Property');
            // Fire.$on('searchProperty',() => {
            //     let query = this.$parent.search;
            //     axios.get('/api/findProperty?q=' + query)
            //         .then((data) => {
            //             this.properties = data.data;
            //         })
            //         .catch(() => {
            //
            //         })
            // });
            this.loadProperties();
            this.$on('AfterCreate', () => {
                this.loadProperties();
            });
        },
        methods: {
            getResults(page = 1) {
                axios.get('/api/property?page=' + page)
                    .then(response => {
                        this.properties = response.data;
                    });
            },
            getImageCount(){
              let arr=JSON.stringify(this.form.images);
              return arr.split(",").length;
            },
            loadProperties() {
                axios.get("/api/property").then(({data}) => (this.properties = data));
            },
            newModal() {

            },
            getName(){

            },
            viewModal(property) {
                this.form.reset();
                this.form.fill(property);
                axios.get("/api/propertyHouse/"+property.id).then(({data}) => (this.propAlt = data[0]));
                axios.get("/api/user/"+property.owner_id).then(({data}) => (this.owner = data));
                $('#showModal').modal('show');
            },
            deleteProperty(id) {
                swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    // Send request to the server
                    if (result.value) {
                        this.form.delete('/api/property/' + id).then(() => {
                            swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                            this.$emit('AfterCreate');
                        }).catch(() => {
                            swal("Failed!", "There was something wrong.", "warning");
                        });
                    }
                })
            }//end of deleteProperty
        }
    }

</script>