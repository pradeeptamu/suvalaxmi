//this guard for router checking correct authentication
export function initialize(store, router) {
    // for denying access to login page after logged in
    router.beforeEach((to, from, next) => {
        const requiresAdminAuth = to.matched.some(
            (record) => record.meta.requiresAdminAuth
        );
        const requiresAuth = to.matched.some(
            (record) => record.meta.requiresAuth
        );
        const currentAdmin = store.state.currentAdmin;
        const currentUser = store.state.currentUser;
        //redierection for admin
        //interceptors for each routing
        //this is global guard
        //guard can be for component and per route as well
        if (requiresAdminAuth)
            if (requiresAdminAuth && !currentAdmin) {
                next("/laxmiavsuadmin/login");
            } else if (to.path == "/laxmiavsuadmin/login" && currentAdmin) {
                next("/laxmiavsuadmin/dashboard");
            } else {
                next();
            }

        //redirection for user
        if (requiresAuth && !currentUser) {
            next("/login");
            return;
        } else if (to.path == "/login" && currentUser) {
            next("/cms");
            return;
        } else if (to.path == "/register" && currentUser) {
            next("/cms");
            return;
        } else {
            next();
        }
    });

    if (store.getters.currentAdmin) {
        setAuthorization(store.getters.currentAdmin.token);
    }
}

export function setAuthorization(token) {
    axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
}
