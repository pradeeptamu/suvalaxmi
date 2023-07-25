<template>
    <div class="text-center">
        <h4>OR</h4>
        <h5>Sign in with...</h5>
        <button class="btn btn-outline-danger" @click="AuthProvider('google')"><i class="fab fa-google-plus"> Google</i></button>
        <button class="btn btn-outline-primary" @click="AuthProvider('facebook')"><i class="fab fa-facebook"> Facebook</i></button>
    </div>
</template>

<script>

    export default {

        props: {
            url: {
                type: String,
            }
        },
        methods: {
            AuthProvider(provider) {
                var self = this
                this.$auth.authenticate(provider).then(response =>{
                    self.SocialLogin(provider,response)
                })
            },

            SocialLogin(provider,response){
                this.$Progress.start();
                this.$http.post('/api/socialLogin/'+provider,response)
                    .then(res => {
                        this.$store.commit("loginSuccess", res.data);
                        this.$Progress.finish();
                        if(this.url){
                            this.$router.push(this.url);
                        }else{
                            this.$router.push('/');
                        }
                }).catch(err => {
                    this.$Progress.fail();
                    console.log(err);
                })
            },

        }
    }

</script>

<style scoped>
    i{
        font-size: 1.5em;
    }

</style>
