import { getAdmin } from "./components/backend/helpers/auth";
import { getUser } from "./components/Frontend/helpers/auth";
import { createStore } from "vuex";

const admin = getAdmin();
const user = getUser();

const store = createStore({
    state: {
        // Your state properties
        currentUser: user,
        currentAdmin: admin,
        isLoggedIn: !!user, //!! cast user into boolean if no object
        isAdminLoggedIn: !!admin,
        loading: false,
        auth_error: null,
        userType: "",
        componentName: "",
        editModeCMS: false,
    },
    getters: {
        isLoading(state) {
            return state.loading;
        },
        isLoggedIn(state) {
            return state.isLoggedIn;
        },
        isAdminLoggedIn(state) {
            return state.isAdminLoggedIn;
        },
        currentUser(state) {
            return state.currentUser;
        },
        currentAdmin(state) {
            return state.currentAdmin;
        },
        authError(state) {
            return state.auth_error;
        },
        getComponentName(state) {
            return state.componentName;
        },
        isEdit(state) {
            return state.editModeCMS;
        },
    },
    mutations: {
        login(state) {
            state.loading = true;
            state.auth_error = null;
        },
        loginSuccess(state, payload) {
            state.auth_error = null;
            state.loading = false;
            if (payload.user.type === "admin") {
                state.isAdminLoggedIn = true;
                state.currentAdmin = Object.assign({}, payload.user, {
                    token: payload.access_token,
                });
                localStorage.setItem(
                    "admin",
                    JSON.stringify(state.currentAdmin)
                );
            } else {
                state.isLoggedIn = true;
                state.currentUser = Object.assign({}, payload.user, {
                    token: payload.access_token,
                });
                localStorage.setItem("user", JSON.stringify(state.currentUser));
            }
        },
        loginFailed(state, payload) {
            state.loading = false;
            state.auth_error = payload.error;
        },
        logoutAdmin(state) {
            localStorage.removeItem("admin");
            state.isAdminLoggedIn = false;
            state.currentAdmin = null;
        },
        logout(state) {
            localStorage.removeItem("user");
            state.isLoggedIn = false;
            state.currentUser = null;
        },
        setComponentName(state, payload) {
            state.componentName = payload;
        },
        setEditMode(state, payload) {
            state.editModeCMS = payload;
        },
    },
    actions: {
        login(context) {
            context.commit("login");
        },
        setComponentName(state, payload) {
            state.commit("setComponentName", payload);
        },
        setEditMode(state, payload) {
            state.commit("setEditMode", payload);
        },
    },
});

export default store;
