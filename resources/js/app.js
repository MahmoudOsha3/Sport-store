import './bootstrap';

import Alpine from 'alpinejs';
import { createApp } from 'vue'
import DetailsProducts from './components/DetailsProduct.vue'

window.Alpine = Alpine;

Alpine.start();

// window.Echo.channel('admin.orders')
//     .listen('.order.created', (e) => {
//         alert(`طلب جديد، اضغط هنا لعرضه: ${e.order.link}`);
//     }).subscription_succeeded(() => {
//         console.log('Subscribed to admin.orders');
//     });;


    window.Echo.channel('admin.orders')
    .notification((notification) => {
        console.log('Notification received', notification);
        alert(`طلب جديد، اضغط هنا لعرضه: ${notification.order.link}`) ;
    });


createApp(DetailsProducts).mount('#app')
