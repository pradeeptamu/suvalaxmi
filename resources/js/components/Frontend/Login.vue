<template>
    <div class="d-flex justify-content-center">
        <div class="main-section col-12 col-sm-6 text-center">

            <div class="user-img">
                <img src="../../../../public/img/global/girl.png" alt="dfughu">
            </div>

            <form @submit.prevent="authenticate">
                <div v-if="$route.query.account" class="text-center text-success">Your account has been activated.
                    Now you can proceed to login.
                </div>
                <div v-if="$route.query.reset" class="text-center text-success">Password reset is successful. Now
                    you can proceed to login.
                </div>

                <div class="input-group form-group mb-2">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="email" v-model="form.email" class="form-control" placeholder="Email Address" required>
                </div>
                <div class="input-group form-group mb-2">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                    <input type="password" v-model="form.password" class="form-control" placeholder="Password" required>
                </div>

                <!-- <div class="row align-items-center remember ml-1">
                    <input type="checkbox">&nbsp;Remember Me
                </div> -->
                <div class="form-group align-items-center mt-3">
                    <input type="submit" class="btn btn-primary btn-block" value="Login">
                </div>
                <div class="form-group row invalid-feedback d-block">
                    {{ error }}
                </div>
                <p class="password-reset mt-3">
                    <router-link :to="{ name: 'password-reset-form' }">
                        Forgot your password?
                    </router-link>
                </p>
            </form>
            <!-- <social-login class="social-login mb-3 in-registration-box" :url="url">
            </social-login> -->

            <p class="signup mt-3">Don't have an account?
                <router-link :to="{ name: 'register' }" class="signup-link">Signup</router-link>
            </p>
        </div>
    </div>
</template>

<script>

import { login } from "./helpers/auth";
// import SocialLogin from './helpers/SocialLogin.vue'

export default {
    name: 'login',
    // components: {
    //     SocialLogin
    // },
    data() {
        return {
            form: {
                email: '',
                password: ''
            },
            error: null,
            url: '',
            props: ['url'],
        };
    },
    methods: {
        authenticate() {
            this.$Progress.start();
            this.$store.dispatch('login');

            login(this.$data.form)
                .then((res) => {
                    if (res.status !== 421) {
                        if (res.status !== 420) {
                            if (res.status !== 422) {
                                if (res.access_token) {
                                    this.$Progress.finish();
                                    this.$store.commit("loginSuccess", res);
                                    this.$router.push('/CMS');
                                } else {
                                    this.error = 'Invalid Access Token';
                                }
                            } else {
                                this.error = 'Your account is not active yet. Please activate your account';
                            }
                        } else {
                            this.error = 'You are not a user';
                        }
                    } else {
                        this.$Progress.fail();
                        this.error = 'Invalid email or password';
                    }
                })
                .catch((error) => {
                    this.$Progress.fail();
                    this.$store.commit("loginFailed", { error });
                })
        }
    }
}
</script>

<style scoped lang="scss">
input {
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
}

.main-section {
    padding: 1rem 5rem;
    margin-top: 6rem;
    box-shadow: 0px 0px 6px #B4B4B4;
    margin-bottom: 2rem;

    img {
        height: 100px;
        width: 100px;
        transform: translate(0, -3rem);
    }
}


.form-group {
    align-items: center;

    .btn {
        background-color: #38A1DA;
        border: none;
    }

}

.or {
    font-size: 15px;
}

.input-group-text {
    background-color: #38A1DA;
    margin-right: 0.5rem;
    border: none;
    font-size: 1.5rem;
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