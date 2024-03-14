import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import ExampleIndex from '@/components/ExampleComponent.vue';
import SearchIndex from '@/components/SearchComponent.vue';
import AdvSearchIndex from '@/components/SearchAdvancedComponent.vue';


// Create the Vue Router instance
const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/home', component: ExampleIndex },
        { path: '/', component: ExampleIndex },
        { path: '/stand', component: AdvSearchIndex },
        { path: '/misc', component: SearchIndex },
        // Add more routes as needed for other pages
    ],
});
const app = createApp({});
//app.component('ex-component', ExampleIndex )
//app.component('search-component', SearchIndex )

app.use(router);

// Mount the app to the HTML element with the id 'app'
app.mount('#app');
