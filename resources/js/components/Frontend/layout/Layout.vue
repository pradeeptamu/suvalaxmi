<template>
    <div>
        <Header></Header>
        <router-view></router-view>
        <Footer />
    </div>
</template>


<script>
import Header from './Header.vue'
import Footer from './Footer.vue'
export default {
    name: "Layout.vue",
    components: {
        Header,
        Footer
    },
    data() {
        return {
            search: ''
        }
    }
}
</script>


<style>
html,
body {
    color: #707070;
}
</style>