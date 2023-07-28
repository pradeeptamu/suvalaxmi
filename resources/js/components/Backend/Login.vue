<template>
    <div class="modal-dialog text-center d-flex justify-content-center">
        <div class="col-12 col-sm-6 main-section">
            <div class="modal-content">
                <div class="col-12 mb-4 mt-4">
                    <h4 class="login_title">ADMIN LOGIN</h4>
                </div>
                <form @submit.prevent="authenticate" class=" col-12 mt-n2 mb-4">
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="email" v-model="form.email" class="form-control" placeholder="Email Address" required>
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" v-model="form.password" class="form-control" placeholder="Password" required>
                    </div>

                    <div class="form-group align-items-center mt-3">
                        <input type="submit" class="btn btn-primary btn-block" value="Login">
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
import { login } from "./helpers/auth";
export default {
    name: 'admin-login',
    data() {
        return {
            form: {
                email: '',
                password: ''
            },
            error: null
        };
    },
    methods: {
        authenticate() {
            this.$Progress.start();
            this.$store.dispatch('login');

            login(this.$data.form)
                .then((res) => {
                    if (res.message !== 'Invalid credentials') {
                        if (res.message !== 'Invalid authority') {
                            if (res.access_token) {
                                this.$Progress.finish();
                                this.$store.commit("loginSuccess", res);
                                this.$router.push({ name: 'admin-dashboard' });

                            } else {
                                this.error = 'Invalid Access Token';
                            }

                        } else {
                            this.error = 'Insufficient permission!! Not an admin';
                        }
                    } else {
                        this.error = 'Invalid email or password';
                        this.$Progress.fail();
                    }

                })
                .catch((error) => {
                    this.$store.commit("loginFailed", { error });
                    this.$Progress.fail();
                })
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

.login_title {
    font-size: 35px;
    font-weight: bolder;
    letter-spacing: 4px;
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