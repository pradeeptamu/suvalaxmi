<template>
    <!-- Navigation-->

    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="logo">
            <router-link to="/" tag="a" class="nav-link logo p-0" active-class="active" exact>
                <img src="../../../../../public/img/global/logo.png" alt="find apartment image">
            </router-link>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-4">
                    <router-link to="/" tag="a" class="nav-link" active-class="active" exact>
                        Home
                    </router-link>
                </li>
                <li class="nav-item mr-4">
                    <router-link to="/property" tag="a" class="nav-link" active-class="active" exact>
                        Buy
                    </router-link>
                </li>
                <li class="nav-item mr-4">
                    <router-link to="/property" tag="a" class="nav-link" active-class="active" exact>
                        Rent
                    </router-link>
                </li>
                <li class="nav-item mr-4">
                    <router-link to="/property" tag="a" class="nav-link" active-class="active" exact>
                        Property
                    </router-link>
                </li>
                <li class="nav-item mr-4">
                    <router-link to="/contact" tag="a" class="nav-link" active-class="active" exact>
                        Contact
                    </router-link>
                </li>
                <li class="nav-item mr-4">
                    <router-link to="/about" tag="a" class="nav-link" active-class="active" exact>
                        About Us
                    </router-link>
                </li>
                <li class="nav-item mr-4" v-if="!currentUser">
                    <router-link to="/login" id="nav-btn" tag="a"
                        class="nav-link btn btn-info btn-sm text-white font-weight-lighter" active-class="active" exact
                        title="login">
                        Post Property
                    </router-link>

                </li>
                <template v-else>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ currentUser.name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <router-link to="/cms" tag="a" class="dropdown-item" active-class="active" exact>
                                <i class="fas fa-user theme"> </i>
                                Profile
                            </router-link>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" @click.prevent="logout" href="#">
                                <i class="fas fa-power-off red"> </i>
                                Logout
                            </a>
                        </div>
                    </li>
                </template>

            </ul>
        </div>
    </nav>
    <!-- End of Navigation-->
</template>

<script>
export default {
    name: "Header",
    data() {
        return {
            loggedIn: false,
            search: ''
        }
    },
    methods: {
        logout() {
            this.$store.commit('logout');
            this.$router.push('/');
        },
    },
    computed: {
        currentUser() {
            return this.$store.getters.currentUser;
        }
    }

}
</script>

<style scoped lang="scss">
.navbar-default .navbar-nav>li>a {
    color: #fff;
    padding: 10px 20px;
    text-transform: uppercase;
    background-color: transparent;
}

.logo {
    height: 4rem;
    width: 10rem;

    img {
        height: 100%;
    }
}

.nav-link {
    color: black;
    font-weight: bold;
    font-size: 16px;
    font-family: Titillium web;
    text-transform: uppercase;

    @media (max-width: 1024px) {
        font-size: 14px;
    }
}

.nav-link i {
    color: #38A1DA;
}

#nav-btn {
    background-color: #38A1DA;
    border: none;
    font-size: 1rem;
}

.navbar.navbar-light .navbar-nav .nav-item .nav-link:hover {
    color: #38A1DA;
}

.navbar-light .navbar-nav .nav-item .nav-link:focus {
    color: #38A1DA;
}

.navbar-light .navbar-nav .nav-item:active .nav-link {
    color: #38A1DA;
}

@media (min-width: 992px) {
    .navbar-expand-lg .navbar-nav .dropdown-menu {
        border: none;
        box-shadow: none;
        background: ghostwhite;
        right: 0;
        left: auto !important;
    }
}

#navcollapse a:active {
    color: #38A1DA;
}

.navbar {
    padding: 1rem 4rem;
    position: sticky;
    top: 0;
    z-index: 99;

    @media (max-width: 768px) {
        padding: 1rem 2rem;
    }
}
</style>