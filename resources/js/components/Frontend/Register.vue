<template>
    <div class="modal-dialog text-center ">
        <div class="col-sm-11 main-section">
            <div class="modal-content">

                <div class="col-12 user-img">
                    <img :src="getPhoto()" alt="dfughu">
                </div>

                <form @submit.prevent="registerUser" class="col-12 mt-n3">

                    <div class="input-group form-group">
                        <input type="text" v-model="form.name" class="form-control" placeholder="Full Name">
                    </div>

                    <div class="input-group form-group">
                        <input type="email" v-model="form.email" class="form-control" placeholder="Email">
                    </div>

                    <div class="input-group form-group">
                        <input type="password" v-model="form.password" class="form-control" placeholder="Password"
                            name="password">
                    </div>

                    <div class="input-group form-group">
                        <input type="password" v-model="form.password_confirmation" class="form-control"
                            name="password_confirmation" placeholder="Confirm Password">
                    </div>

                    <div class="input-group form-group">
                        <input type="text" v-model="form.address" class="form-control" placeholder="Address">
                    </div>

                    <div class="input-group form-group">
                        <input type="number" v-model="form.phone" class="form-control" placeholder="Phone">
                    </div>

                    <div class="input-group form-group">
                        <input type="file" @change="updatePhoto" name="photo" placeholder="Photo">
                    </div>

                    <div v-if="validationErrors">
                        <ul class="alert alert-danger">
                            <li v-for="(value, key, index) in validationErrors">{{ value }}</li>
                        </ul>
                    </div>

                    <div class="form-group align-items-center mt-3">
                        <input type="submit" value="Signup" class="btn btn-primary btn-block ">
                    </div>

                </form>
                <social-login class="social-login mb-3 in-registration-box" :url="url">
                </social-login>

                <p class="signup mt-3">Already have an account?
                    <router-link :to="{ name: 'login' }" class="login-link">Login</router-link>
                </p>

            </div>
        </div>
    </div>
</template>

<script>
import Form from 'vform'
export default {
    name: 'user-register',
    data() {
        return {
            validationErrors: '',
            url: '',
            props: ['url'],
            form: new Form({
                name: '',
                email: '',
                phone: '',
                password: '',
                password_confirmation: '',
                address: '',
                photo: ''
            }),
        }
    },
    methods: {
        getPhoto() {
            let photo = (this.form.photo.length > 200) ? this.form.photo : "/img/global/girl.png";
            return photo;
        },
        updatePhoto(e) {
            let file = e.target.files[0];
            let reader = new FileReader();
            let limit = 1024 * 1024 * 2;
            if (!file.type.match('image.*')) {
                this.form.photo = [];
                swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Please upload image only',
                })
                return false;
            }
            if (file['size'] > limit) {
                swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'You are uploading a large file',
                })
                return false;
            }
            reader.onloadend = (file) => {
                this.form.photo = reader.result;

            }
            reader.readAsDataURL(file);
        },
        registerUser() {
            this.$Progress.start();
            this.form.post('/api/user')
                .then(() => {
                    this.message = 'Your account has been registered. Please, activate your account before login.'
                    this.form.reset();
                    Toast.fire({
                        type: 'success',
                        title: 'Your Account has been created!!!'
                    });
                    this.$Progress.finish();
                    this.$router.push({ name: 'login' });
                })
                .catch((error) => {
                    if (error.response.status == 422) {
                        this.validationErrors = error.response.data.errors;
                    }
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

.modal-dialog {
    margin-top: 6rem;
}

.modal-content {
    box-shadow: 0px 0px 6px #B4B4B4;
}

.modal-content img {
    height: 100px;
    width: 100px;
    transform: translate(0, -56px);
    border-radius: 50%;
}

.form-group .btn {
    background-color: #38A1DA;
    border: none;
}

.or {
    font-size: 15px;
}

.input-group-text {
    background-color: #38A1DA;
}

.input-group-text i {
    color: #fff;
}

.social-icon {
    color: #38A1DA;
}

.signup {
    font-size: 15px;
}

.signup .signup-link {
    color: #38A1DA;
}
</style>