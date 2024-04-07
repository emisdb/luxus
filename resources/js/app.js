import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import Routes from './routes.js'

// Create the Vue Router instance
const router = createRouter({
    history: createWebHistory(),
    routes: Routes,
});
const app = createApp({});
//app.component('ex-component', ExampleIndex )
//app.component('search-component', SearchIndex )

app.use(router);

// Mount the app to the HTML element with the id 'app'
app.mount('#app');
export default router;
