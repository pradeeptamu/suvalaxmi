<template>
    <div class="modal-dialog text-center">
        <div class="col-sm-11 main-section">
            <div class="modal-content">

                <h4 class="mt-5">Reset Your Password Here</h4>

                <form @submit.prevent="resetPassword" class=" col-12 mt-3 mb-5">

                    <div class="input-group form-group">
                        <input type="password" v-model="form.password" class="form-control" placeholder="New Password" :class="{ 'is-invalid': form.errors.has('password') }">
                        <has-error :form="form" field="password"></has-error>
                    </div>

                    <div class="input-group form-group">
                        <input type="password" v-model="form.password_confirmation" class="form-control" placeholder="Confirm Password" :class="{ 'is-invalid': form.errors.has('password_confirmation') }">
                        <has-error :form="form" field="password_confirmation"></has-error>
                    </div>

                    <div class="form-group align-items-center mt-3" >
                        <input type="submit" class="btn btn-primary btn-block" value="Reset Password">
                    </div>

                    <div class="form-group row valid-feedback d-block">
                        {{ message }}
                    </div>

                    <div class="form-group row invalid-feedback d-block">
                        {{ error }}
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'password-reset',
        data(){
            return{
                form: new Form({
                    token: this.$route.params.token,
                    password: '',
                    password_confirmation: ''
                }),
                message: '',
                error: ''
            }
        },
        mounted() {

        },
        methods: {
            resetPassword(){
                this.$Progress.start();
                this.error = '';
                this.form.post('/api/password_reset')
                    .then(() => {
                        this.message = 'Password reset is successfully. Now you can login.';
                        this.$Progress.finish();
                        Toast.fire({
                            type: 'success',
                            title: 'Password reset successful!!!'
                        });
                        this.$router.push({ name: 'login', query: {reset: 'password-reset'} });
                    })
                    .catch(() => {
                        this.message = '';
                        this.error = 'Invalid token';
                        this.$Progress.fail();
                    });
            }
        }
    }
</script>

<style scoped>
    input {
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
    }

    .modal-dialog{
        margin-top: 5rem;
        margin-bottom: 5rem;
    }

    .modal-content {
        box-shadow: 0px 0px 6px gray;
    }

    .modal-content img {
        height: 100px;
        width: 100px;
        transform: translate(0, -56px);
    }

    .form-group .btn {
        background-color: #232323;
        border: none;
    }

    .input-group-text i {
        color: #fff;
    }

</style>
