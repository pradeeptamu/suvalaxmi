<template>
    <div class="col-12 col-lg-3 col-xl-2 border-right" id="sidebar">

        <div class="user-details row my-3">

            <div class="avatar" id="sidebar-img">
                <div class="image h-100">
                    <img :src="getAvatarImage()" class="img-rounded w-100 h-100" style="object-fit: cover">
                </div>
            </div>
            <div class="d-flex align-items-center font-weight-bold text-dark" id="sidebar-name">
                {{ getUsername() }}
            </div>
        </div>
        <hr width="100%">
        <ul class="nav flex-column">

            <li class="nav-item active">
                <router-link to="/CMS" tag="a" class="nav-link font-weight-bold" exact>
                    Dashboard
                </router-link>
                <!-- <a class="nav-link font-weight-bold text-primary" href="dashboard.html">Dashboard</a> -->
            </li>
            <li class="nav-item border-top">
                <router-link to="/CMS/allproperties" tag="a" class="nav-link text-dark font-weight-bold" exact>
                    Properties
                </router-link>
                <ul class="nav flex-column ml-3">
                    <li class="nav-item" @click="setEdit">
                        <router-link to="/CMS/addproperty" tag="a" class="nav-link text-dark pt-0" exact>
                            Add New Property
                        </router-link>
                        <!-- <a class="nav-link text-dark pt-0" href="/addproperty">Add New Property</a> -->
                    </li>
                    <li class="nav-item">
                        <router-link to="/CMS/allproperties" tag="a" class="nav-link text-dark pt-0" exact>
                            All Properties
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/CMS/allfavorites" tag="a" class="nav-link text-dark pt-0" exact>
                            Favorites
                        </router-link>
                    </li>

                </ul>
            </li>
            <li class="nav-item border-top">
                <a class="nav-link text-dark font-weight-bold" href="javascript:;">Enquiry</a>
                <ul class="nav flex-column ml-3">
                    <li class="nav-item">
                        <router-link :to="{ name: 'allfrontenquiries' }" tag="a" class="nav-link pt-0" exact>
                            All Enquiry
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="nav-item border-top">
                <router-link :to="{ name: 'cmsprofile' }" tag="a" class="nav-link text-dark font-weight-bold" exact>
                    Profile
                </router-link>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "Sidebar",
    data() {
        return {
            photo: '',
        }
    },

    methods: {
        getAvatarImage() {
            axios.get("/api/profile/" + this.$store.getters.currentUser.id)
                .then((res) => {
                    this.photo = res.data.photo;
                });
            if (this.photo.length >= 1) {
                return "/img/profile/" + this.photo;
            } else {
                return "/img/profileimg.jpg";
            }

        },
        getUsername() {
            return this.$store.getters.currentUser.name;
        },
        setEdit() {
            this.$swal.$emit('resetProperty');
            this.$store.dispatch('setEditMode', false);
        }
    }
}
</script>

<style scoped>
.user-details {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.avatar {
    border-radius: 50%;
    height: 8rem;
    width: 8rem;
    overflow: hidden;
    padding: 0;
}
</style>
