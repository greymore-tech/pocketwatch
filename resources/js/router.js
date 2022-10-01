import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);
window.Vue = require('vue');


import ExampleComponent from './components/ExampleComponent.vue'
import Home from './components/Home.vue'
// import Passport from './components/Passport.vue'


Vue.component('passport-clients',require('./components/passport/Clients.vue').default);
Vue.component('passport-authorized-clients',require('./components/passport/AuthorizedClients.vue').default);
Vue.component('passport-personal-access-tokens',require('./components/passport/PersonalAccessTokens.vue').default);

const routes = [
    {
      path: '/home',
      component: Home
    },
    {
      path: '/page',
      meta:{ title: 'Page Name | Section Name'},
      component: ExampleComponent,
      name: 'Page Name | Section Name'
    },
    // {
    //   path: '/home/auction-manager',
    //   component: AuctionManagerDash
    // },
    // {
    //     path: '/home/auction-manager/old-data-entry',
    //     meta:{ title: 'Auction Manager | Past Record Entry Module'},
    //     component: AuctionManagerOldDataEntry,
    //     name: 'Auction Manager | Past Record Entry Module'
    // },
    // Misc Routes
    {
        path:'/EmptyCanvas', 
        component:ExampleComponent
    },
    {
        path:'*',
        component:ExampleComponent
    }

]


const router = new VueRouter({
    mode: 'history',
    routes, // short for `routes: routes`
    linkActiveClass: 'active'
  });

export default router;