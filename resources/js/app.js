import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.Echo.channel('admin.orders')
    .listen('.order.created', (e) => {
        alert(`طلب جديد، اضغط هنا لعرضه: ${e.order.link}`);
    });
