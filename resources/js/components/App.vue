<template>
    <Header />
    <router-view />
    <vue-progress-bar></vue-progress-bar>
    <Footer />
</template>

<script>
import Header from './Frontend/layout/Header.vue'
import Footer from './Frontend/layout/Footer.vue'
export default {
    components: {
        Header, Footer
    }
}
</script>
