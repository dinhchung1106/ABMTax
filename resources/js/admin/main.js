import { createApp } from 'vue'
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import App from './App.vue'
import router from './router'
import * as ElementPlusIconsVue from '@element-plus/icons-vue'
import 'normalize.css'
import axios from 'axios'

const app = createApp(App)

// Register all icons
for (const [key, component] of Object.entries(ElementPlusIconsVue)) {
    app.component(key, component)
}

app.use(ElementPlus)
app.use(router)

const token = localStorage.getItem('token')
if (token) {
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
}

app.mount('#app') 