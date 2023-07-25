<template>
    <div>

        <div class="container-fluid my-4 border border-color bg-light">

            <div class="col-12 mt-3 bg-color">

                <div class="d-flex flex-row justify-content-around align-items-center">

                    <div class="d-flex flex-column justify-content-center align-items-center  text-white my-3 ">

                        <div class="font-weight-bold">{{properties.length}}</div>

                        <div>Active Properties</div>

                    </div>

                    <div class="d-flex flex-column justify-content-center align-items-center  text-white my-3">

                        <div class="font-weight-bold">{{favourites.length}}</div>

                        <div>Favorites</div>

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

                        <router-link to="/CMS/allproperties">
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

                        <router-link to="/CMS/allfavorites">
                            <div class="card card-common">

                                <div class="card-body">

                                    <div class="d-flex flex-column justify-content-center align-items-center">

                                        <i class="fas fa-thumbs-up fa-2x text-primary"></i>

                                        <div class="text-secondary mt-2">

                                            <h5>Favorites</h5>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </router-link>

                    </div>
                    <div class="col-xl-4 col-md-6 col-sm-6 p-2">

                        <router-link :to="{ name: 'allfrontenquiries'}">
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
        name: "Dashboard.vue",
        components: {},
        data() {
            return {
                enquiries: {},
                properties: {},
                favourites: {},
                owner_id: this.$store.getters.currentUser.id,
            }
        },
        created() {
            axios.get('/api/allfrontenquiries/' + this.owner_id)
                .then((data) => {
                    this.enquiries = data.data;
                })
                .catch(() => {

                });

            axios.get("/api/getPropertyByUserId/" + this.owner_id)
                .then((data) => {
                    this.properties = data.data.data;
                });

            axios.get("/api/userfavorite/" + this.owner_id)
                .then((data) => {
                    this.favourites = data.data;
                });

        }
    }
</script>

<style scoped>
    a {
        text-decoration: none;
    }
</style>

