<template>
    <div class="modal-dialog text-center">
        <div class="col-sm-11 main-section">
            <div class="modal-content">

                <h4 class="mt-5">Password Reset Form</h4>

                <form @submit.prevent="sendRequest" class="col-12 mt-3 mb-5">

                    <div class="input-group form-group">
                        <input type="email"
                               id="email"
                               name="email"
                               v-model="form.email"
                               class="form-control"
                               placeholder="Enter your Email Address"
                               :class="{ 'is-invalid': form.errors.has('email') }">
                        <has-error :form="form" field="email"></has-error>
                    </div>

                    <p><router-link :to="{ name:'login' }">Let me Login</router-link></p>

                    <div class="form-group align-items-center mt-3" >
                        <input type="submit" class="btn btn-primary btn-block" value="Send Reset Link">
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
        name: 'request-password-reset',
        data(){
            return{
                form: new Form({
                    email: ''
                }),
                message: '',
                error: ''
            }
        },
        mounted() {

        },
        methods: {
            sendRequest(){
                this.$Progress.start();
                this.error = '';
                this.form.post('/api/password_reset/email_verify')
                    .then(() => {
                        Toast.fire({
                            type: 'success',
                            title: 'Password reset request sent!!!'
                        });
                        this.message = 'A link to reset your password has been sent to your email.';
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.message = '';
                        this.error = 'Invalid Email Address';
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
        background-color: #38A1DA;
        border: none;
    }

    .input-group-text i {
        color: #fff;
    }

</style>
