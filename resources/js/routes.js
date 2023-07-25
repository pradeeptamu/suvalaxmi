import { createWebHistory, createRouter } from "vue-router";

const Dashboard = () => import("./components/Backend/Dashboard.vue");
const Profile = () => import("./components/backend/Profile.vue");
const Users = () => import("./components/backend/Users.vue");
const NotFound = () => import("./components/NotFound.vue");
const Home = () => import("./components/Frontend/Home.vue");
const Property = () => import("./components/Frontend/Property.vue");
const Propertyback = () => import("./components/backend/Propertyback.vue");
const Layout = () => import("./components/Frontend/layout/Layout.vue");
const Login = () => import("./components/Frontend/Login.vue");
const Register = () => import("./components/Frontend/Register.vue");
const ConfirmAccount = () =>
    import("./components/Frontend/helpers/ConfirmAccount.vue");
const PasswordResetForm = () =>
    import("./components/Frontend/helpers/PasswordResetForm.vue");
const ResetPassword = () =>
    import("./components/Frontend/helpers/ResetPassword.vue");
const SingleProperty = () => import("./components/Frontend/SingleProperty.vue");
const Contact = () => import("./components/Frontend/Contact.vue");
const About = () => import("./components/Frontend/About.vue");
const Privacy = () => import("./components/Frontend/Privacy.vue");

// backend
const AdminLogin = () => import("./components/backend/Login.vue");
const AdminDashboard = () => import("./components/backend/AdminDashboard.vue");
const Enquiry = () => import("./components/backend/Enquiry.vue");
//CMS

const CMSLayout = () =>
    import("./components/Frontend/CMS/layout/CMSLayout.vue");
const CMSDashboard = () => import("./components/Frontend/CMS/Dashboard.vue");
const CMSAddProperty = () =>
    import("./components/Frontend/CMS/Property/AddProperty.vue");
const CMSAllProperties = () =>
    import("./components/Frontend/CMS/Property/AllProperties.vue");
const CMSAllFavorites = () =>
    import("./components/Frontend/CMS/Property/AllFavorites.vue");
const CMSProfile = () => import("./components/Frontend/CMS/Profile.vue");
const FrontEnquiry = () =>
    import("./components/Frontend/CMS/Enquiry/FrontEnquiry.vue");

const routes = [
    {
        path: "/",
        name: "home",
        component: Home,
    },
    {
        path: "/Property/:category?/:purpose?/:location?",
        name: "property",
        component: Property,
        props: true,
    },
    {
        path: "/singleProperty/:id",
        name: "singleproperty",
        component: SingleProperty,
    },
    {
        path: "/contact",
        name: "Contact",
        component: Contact,
    },
    {
        path: "/about",
        name: "About",
        component: About,
    },
    {
        path: "/privacy-policy",
        name: "Privacy",
        component: Privacy,
    },

    {
        path: "/:pathMatch(.*)*", //if none of these components matched Not found loads
        component: NotFound,
    },
    {
        path: "/auth/:provider/callback",
        component: {
            template: '<div class="auth-component"></div>',
        },
    },
    {
        path: "/login",
        name: "login",
        component: Login,
    },
    {
        path: "/confirm/:token",
        name: "confirm",
        component: ConfirmAccount,
        meta: {
            noLogin: true,
        },
    },
    {
        path: "/register",
        name: "register",
        component: Register,
    },
    {
        path: "/password-reset-form",
        name: "password-reset-form",
        component: PasswordResetForm,
        meta: {
            noLogin: true,
        },
    },
    {
        path: "/password-reset/:token",
        name: "password-reset",
        component: ResetPassword,
        meta: {
            noLogin: true,
        },
    },

    //below routes for CMS
    {
        path: "/CMS",
        name: "CMS",
        redirect: { name: "cmsdashboard" },
        component: CMSLayout,
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                path: "dashboard",
                name: "cmsdashboard",
                component: CMSDashboard,
            },
            {
                path: "addproperty/:id?",
                name: "addproperty",
                component: CMSAddProperty,
            },
            {
                path: "allproperties",
                name: "allproperties",
                component: CMSAllProperties,
            },
            {
                path: "allfavorites",
                name: "allfavorites",
                component: CMSAllFavorites,
            },
            {
                path: "allfrontenquiries/:id?",
                name: "allfrontenquiries",
                component: FrontEnquiry,
            },
            {
                path: "cmsprofile",
                name: "cmsprofile",
                component: CMSProfile,
            },
        ],
    },

    // backend routes
    {
        path: "/laxmiavsuadmin/login",
        name: "admin-login",
        component: AdminLogin,
    },
    {
        path: "/laxmiavsuadmin",
        component: AdminDashboard,
        redirect: { name: "admin-dashboard" },
        meta: {
            requiresAdminAuth: true,
        },
        children: [
            {
                path: "/laxmiavsuadmin/dashboard",
                name: "admin-dashboard",
                component: Dashboard,
                meta: {
                    auth: undefined,
                },
            },
            {
                path: "/laxmiavsuadmin/propertyback",
                name: "admin-propertyback",

                component: Propertyback,
                meta: {
                    auth: false,
                },
            },
            {
                path: "/laxmiavsuadmin/profile",
                name: "admin-profile",

                component: Profile,
                meta: {
                    auth: false,
                },
            },
            {
                path: "/laxmiavsuadmin/users",
                name: "admin-users",

                component: Users,
                meta: {
                    auth: false,
                },
            },
            {
                path: "/laxmiavsuadmin/enquiry",
                name: "admin-enquiry",
                component: Enquiry,
                meta: {
                    auth: false,
                },
            },
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
