<template>
    <div style="height: 100vh;">
        <h5 class="text-center mt-5">Confirming your account. Please wait....</h5>
        <div v-if="loading" style="height: 100vh">
            <div style="margin-top: 5vh; margin-left: 50%">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
        <div class="text-danger text-center">{{ message }}</div>
    </div>
</template>

<script>
    export default {
        name: 'user-confirmation',
        data() {
            return {
                message: '',
                loading: true
            }
        },
        mounted() {
            axios.get('/api/register/activate/' + this.$route.params.token)
                .then(() => {
                    Toast.fire({
                        type: 'success',
                        title: 'Your Account has been activated!!!'
                    });
                    this.$router.push({ name: 'login', query: {account: 'activated'} });
                })
                .catch((error) => {
                    this.loading =false;
                    this.message = error.response.data.message;
                })
        }
    }
</script>
