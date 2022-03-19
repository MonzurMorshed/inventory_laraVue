// const ItemList = () => import('./components/list.vue')
import ItemList from './components/List.vue';

export const routes = [{
        name: 'item',
        path: '/',
        component: ItemList
    }
];