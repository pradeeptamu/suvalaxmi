<template>
    <Header />
    <router-view />
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
