<template>
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- SEARCH FORM -->

            <!--<div class="input-group input-group-sm">-->
            <!--<input class="form-control form-control-navbar" type="search" @keyup="searchFor" placeholder="Search"-->
            <!--aria-label="Search" v-model="search">-->
            <!--<div class="input-group-append">-->
            <!--<button class="btn btn-navbar" @click="searchFor()">-->
            <!--<i class="fas fa-search"></i>-->
            <!--</button>-->
            <!--</div>-->
            <!--</div>-->

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img :src="currentPhoto()" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">
                            {{ currentUser.name }}
                        </a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <router-link :to="{ name: 'admin-dashboard' }" tag="a" class="nav-link" active-class="active"
                                exact>
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link :to="{ name: 'admin-users' }" tag="a" class="nav-link" active-class="active" exact>
                                <i class="nav-icon fas fa-users"></i>
                                <p>Users</p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link :to="{ name: 'admin-propertyback' }" tag="a" class="nav-link" active-class="active"
                                exact>
                                <i class="nav-icon fas fa-home"></i>
                                <p>Property</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'admin-profile' }" tag="a" class="nav-link" active-class="active"
                                exact>
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Profile
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link :to="{ name: 'admin-enquiry' }" tag="a" class="nav-link" active-class="active"
                                exact>
                                <i class="nav-icon fas fa-inbox"></i>
                                <p>
                                    Enquiry
                                </p>
                            </router-link>
                        </li>


                        <li class="nav-item">
                            <a href="#" @click.prevent="logout" class="nav-link"><i
                                    class="nav-icon fas fa-sign-out-alt"></i>Logout</a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">


            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <router-view></router-view>
                    <!-- set progressbar -->
                    <vue-progress-bar></vue-progress-bar>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>

    </div>
</template>

<script>
// import _ from 'lodash';

export default {
    name: 'admin-dashboard',
    data() {
        return {
            search: ''
        }
    },
    methods: {
        logout() {
            this.$store.commit('logoutAdmin');
            this.$router.push({ name: 'admin-login' });
        },
        currentPhoto() {
            return "/img/" + this.$store.getters.currentAdmin.photo;
        },
        //search subscribed by child component and calling them based on component state
        searchUser() {
            Fire.$emit('searchUser');
        },
        searchProperty() {
            Fire.$emit('searchProperty');
        }
        ,
        // searchFor: _.debounce(function () {
        //     if (this.$store.getters.getComponentName == 'Users') {
        //         this.searchUser();
        //     } else {
        //         this.searchProperty();
        //     }
        // }, 1000)
    },
    created() {

    },
    computed: {
        currentUser() {
            return this.$store.getters.currentAdmin;
        }
    }
}
</script>

<style scoped>
.wrapper {
    z-index: 0;
}
</style>