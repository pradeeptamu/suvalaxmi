<template>
    <section class="latest-properties mb-5 mt-3">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="trending-properties-title mt-2 mb-1">ALL FAVORITES</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <hr width="100%" align="left" size="30" class="mt-0">
                </div>
            </div>
            <div class="latest-properties-card">
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-lg-4 p-2" v-for="prop in properties" :key="prop.id">
                        <router-link :to="{ name: 'singleproperty', params: { id: prop.id } }">
                            <div class="props card">
                                <div class="sale-rent">
                                    <template v-if="prop.purpose == 'sell'">
                                        <span class="sale">For Sale</span>
                                    </template>
                                    <template v-if="prop.purpose == 'rent'">
                                        <span class="rent">For Rent</span>
                                    </template>
                                </div>
                                <div class="time">
                                    <span>{{ prop.views }} views</span>
                                </div>
                                <img class="card-img-top" alt="image" :src="getImage(prop.thumbnail)">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 pb-2 d-flex flex-column">
                                            <h5 class="card-title"> {{ prop.title.substring(0, 22) + ".." }}</h5>
                                            <span>{{ prop.address }},{{ prop.location }}</span>
                                        </div>
                                    </div>
                                    <div class="row area">
                                        <div class="col-12">
                                            <span class="category"><b>{{ prop.category }}</b></span>
                                        </div>
                                    </div>
                                    <div class="row area">
                                        <div class="col-12">
                                            <span>
                                                <b>NPR. {{ prop.price }}
                                                    <template v-if="prop.price_unit != null">/
                                                        {{ prop.price_unit }}
                                                    </template>
                                                </b>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row area mt-3">
                                        <div class="col-12 p-0 d-flex">
                                            <i class="col-3 fas fa-shower card-icon">
                                                <span>{{ prop.bathroom }}</span>
                                            </i>
                                            <i class="col-3 fas fa-bed pr-0 card-icon">
                                                <span>{{ prop.bedroom }}</span>
                                            </i>
                                            <i class="col-6 fas fa-clock card-icon">
                                                <span>{{ prop.time }}</span>
                                            </i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </router-link>
                    </div>

                </div>
            </div>

        </div>
    </section>
</template>
<script>
export default {
    name: "AllFavorites.vue",
    data() {
        return {
            owner_id: this.$store.getters.currentUser.id,
            properties: {}
        }
    },
    created() {
        this.loadProperties();

    },
    methods: {
        getImage(val) {
            return "/img/thumbnail/" + val;
        },
        loadProperties() {
            let vm = this;
            axios.get("/api/userfavorite/" + this.owner_id)
                .then(function (data) {
                    vm.properties = data.data;
                });
        }
    }

}
</script>

<style scoped lang="scss">
/*all favorites*/
.latest-properties {
    background-color: #EAF0F3;
}

.latest-properties-card {
    background-color: #EAF0F3;
}

.trending-properties-title {
    font-size: 1.5rem;
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
    text-decoration: none;
    color: #707070;

    i {
        color: #38A1DA;
    }
}

hr {
    border: 0.5px solid #6c757d;
}
</style>
