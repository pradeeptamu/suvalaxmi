import "./bootstrap";
import { createApp } from "vue";
import router from "./routes.js";
import App from "./components/App.vue";
// vuex
import store from "./store";
import { initialize } from "./general.js";
import VueProgressBar from "@aacassandra/vue3-progressbar";
const options = {
    color: "#38A1DA",
    failedColor: "#ff3333",
    thickness: "5px",
    location: "top",
};

//sweetalert
import swal from "sweetalert2";
const Toast = swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
});

const app = createApp(App);

app.config.globalProperties.$swal = Toast;
app.use(VueProgressBar, options);
app.use(store);
app.use(router);
initialize(store, router);

app.mount("#app");
