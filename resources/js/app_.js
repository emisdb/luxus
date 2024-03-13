import './bootstrap';
import { createApp } from 'vue';
import router from './router'

import ExampleIndex from '@/components/ExampleComponent.vue';

createApp({
    components: {
        ExampleIndex
    }
}).use(router).mount('#app')
