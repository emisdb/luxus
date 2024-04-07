import ExampleIndex from '@/components/hic/ExampleComponent.vue';
import SearchIndex from '@/components/hic/SearchComponent.vue';
import AdvSearchIndex from '@/components/hic/SearchAdvancedComponent.vue';
import ElementSearchIndex from '@/components/hic/SearchElementComponent.vue';
import NovSearchIndex from '@/components/nov/SearchAdvancedComponent.vue';
import FormIndex from '@/components/nov/FormComponent.vue';
import LoginIndex from '@/components/nov/LoginComponent.vue';
import RegisterIndex from '@/components/nov/RegisterComponent.vue';
import TestIndex from '@/components/nov/TestComponent.vue';

export default [
    { path: '/hic/home', component: ExampleIndex },
    { path: '/hic', component: ExampleIndex },
    { path: '/hic/stand', component: AdvSearchIndex },
    { path: '/hic/misc', component: SearchIndex },
    { path: '/hic/search', component: ElementSearchIndex },
    { path: '/noveo', component: NovSearchIndex },
    { path: '/noveo/login', component: LoginIndex },
    { path: '/noveo/reg', component: RegisterIndex },
    { path: '/noveo/add', component: FormIndex },
    { path: '/noveo/test', component: TestIndex },
    {
        path: '/noveo/edit/:id',
        name: 'EditTask',
        component: FormIndex,
        props: true // Pass route.params as props to the component
    },
]
