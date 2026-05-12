import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";

// Tailwind CSS
import "./assets/style.css";

// Create Vue app
const app = createApp(App);

// Use Router
app.use(router);

// Mount
app.mount("#app");