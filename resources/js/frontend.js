import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

//sweet alert2
import Swal from 'sweetalert2'
window.Swal=Swal//use sweet alert globally


//for inertia
createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
})


