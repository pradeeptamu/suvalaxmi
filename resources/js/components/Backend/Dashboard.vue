<template>
    <div>

        <div class="container-fluid my-4 border border-color color">

            <div class="col-12 mt-3 bg-color">

                <div class="d-flex flex-row justify-content-around align-items-center">

                    <div class="d-flex flex-column justify-content-center align-items-center  text-white my-3 ">

                        <div class="font-weight-bold">{{properties.length}}</div>

                        <div>Active Properties</div>

                    </div>

                    <div class="d-flex flex-column justify-content-center align-items-center  text-white my-3">

                        <div class="font-weight-bold">{{users.length}}</div>

                        <div>Users</div>

                    </div>

                    <div class="d-flex flex-column justify-content-center align-items-center  text-white my-3 ">

                        <div class="font-weight-bold">{{enquiries.length}}</div>

                        <div>Enquires</div>

                    </div>

                </div>

            </div>

            <div class="col-12 mx-1">

                <div class="row pt-md-3 mb-5">
                    <div class="col-xl-4 col-md-6 col-sm-6 p-2">

                        <router-link :to="{name: 'admin-propertyback'}">
                            <div class="card card-common">

                                <div class="card-body">

                                    <div class="d-flex flex-column justify-content-center align-items-center">

                                        <i class="fas fa-home fa-2x text-primary"></i>

                                        <div class="text-secondary mt-2">

                                            <h5>Properties</h5>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </router-link>

                    </div>
                    <div class="col-xl-4 col-md-6 col-sm-6 p-2">

                        <router-link :to="{name :'admin-users'}">
                            <div class="card card-common">

                                <div class="card-body">

                                    <div class="d-flex flex-column justify-content-center align-items-center">

                                        <i class="fas fa-users fa-2x text-primary"></i>

                                        <div class="text-secondary mt-2">

                                            <h5>Users</h5>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </router-link>

                    </div>
                    <div class="col-xl-4 col-md-6 col-sm-6 p-2">

                        <router-link :to="{ name: 'admin-enquiry'}">
                            <div class="card card-common">

                                <div class="card-body">

                                    <div class="d-flex flex-column justify-content-center align-items-center">

                                        <i class="fas fa-inbox fa-2x text-primary"></i>

                                        <div class="text-secondary mt-2">

                                            <h5>Enquiries</h5>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </router-link>
                    </div>

                </div>

            </div>

        </div>

    </div>
</template>


<script>
    export default {
        data() {
            return {
                enquiries: {},
                properties: {},
                users: {},
            }
        },
        created() {
            axios.get('/api/enquiry')
                .then((data) => {
                    this.enquiries = data.data;
                })

            axios.get('/api/property')
                .then(response => {
                    this.properties = response.data.data;
                });

            axios.get('/api/user')
                .then(response => {
                    this.users = response.data.data;
                });
        }
    }
</script>

<style>
    a{
        text-decoration: none !important;
    }
    .color{
        background: #38A1DA;
    }
</style>
