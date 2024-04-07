import { createRouter, createWebHistory } from 'vue-router'

import ExampleComponent from '@/components/hic/ExampleComponent.vue'

const routes = [
    {
        path: '/dashboard',
        name: 'example.index',
        component: ExampleComponent
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
})
