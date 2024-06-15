
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

import { InertiaProgress } from '@inertiajs/progress'
InertiaProgress.init()

//ziggy
import { ZiggyVue } from 'ziggy-js';// Import Ziggy for Vue 3

//sweet alert2
 import Swal from 'sweetalert2'
window.Swal=Swal//use sweet alert globally


//sweet alret 2 toastr
window.Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
    }
    });





//for inertia
createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
    .use(ZiggyVue)
      .use(plugin)
      .mount(el)
  },
})

