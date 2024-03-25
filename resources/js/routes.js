import ExampleIndex from '@/components/hic/ExampleComponent.vue';
import SearchIndex from '@/components/hic/SearchComponent.vue';
import AdvSearchIndex from '@/components/hic/SearchAdvancedComponent.vue';
import ElementSearchIndex from '@/components/hic/SearchElementComponent.vue';

export default [
    { path: '/hic/home', component: ExampleIndex },
    { path: '/hic', component: ExampleIndex },
    { path: '/hic/stand', component: AdvSearchIndex },
    { path: '/hic/misc', component: SearchIndex },
    { path: '/hic/search', component: ElementSearchIndex },
    // Add more routes as needed for other pages
]
