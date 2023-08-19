import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

// Import components
import App from './components/App.vue';

import CustomerList from './components/CustomerList.vue';
import CustomerForm from './components/CustomerForm.vue';
import Customer from './components/Customer.vue';

import ContractList from './components/ContractList.vue';
import ContractForm from './components/ContractForm.vue';
import Contract from './components/Contract.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [

        { path: '/', component: CustomerList },
        { path: '/customers/create', component: CustomerForm },
        { path: '/customers/:id', component: Customer },
        { path: '/customers/:id/edit', component: CustomerForm },
        
        { path: '/contracts/:customer_id', component: ContractList },
        { path: '/contracts/create/:customer_id', component: ContractForm },
        { path: '/contracts/:customer_id/:id', component: Contract },
        { path: '/contracts/:customer_id/:id/edit', component: ContractForm },
    ]
});

const app = createApp(App);
app.use(router);
app.mount('#app');
