import { createRouter, createWebHistory } from 'vue-router'
import CompanyInfoSettings from '../views/CompanyInfoSettings.vue'
import RolesManagement from '../views/RolesManagement.vue'
import AdminProfile from '../views/AdminProfile.vue'

const routes = [
    {
        path: '/admin',
        redirect: '/admin/dashboard'
    },
    {
        path: '/admin/dashboard',
        name: 'AdminDashboard',
        component: () => import('../views/Dashboard.vue')
    },
    {
        path: '/admin/users',
        name: 'Users',
        component: () => import('../views/Users.vue')
    },
    {
        path: '/admin/services',
        name: 'Services',
        component: () => import('../views/Services.vue')
    },
    {
        path: '/admin/news',
        name: 'News',
        component: () => import('../views/News.vue')
    },
    {
        path: '/admin/courses',
        name: 'Courses',
        component: () => import('../views/Courses.vue')
    },
    {
        path: '/admin/contacts',
        name: 'Contacts',
        component: () => import('../views/Contacts.vue')
    },
    {
        path: '/admin/login',
        name: 'AdminLogin',
        component: () => import('../views/Login.vue'),
        meta: { layout: 'auth' }
    },
    {
        path: '/admin/company-info',
        name: 'admin.company-info',
        component: CompanyInfoSettings
    },
    {
        path: '/admin/roles',
        name: 'admin.roles',
        component: RolesManagement
    },
    {
        path: '/admin/profile',
        name: 'AdminProfile',
        component: AdminProfile
    },
    {
        path: '/admin/slider-banners',
        name: 'admin.slider-banners',
        component: () => import('../views/SliderBanners.vue')
    },
    {
        path: '/admin/categories',
        name: 'admin.categories',
        component: () => import('../views/CategoryManagement.vue')
    },
    {
        path: '/admin/tags',
        name: 'admin.tags',
        component: () => import('../views/TagManagement.vue')
    },
    {
        path: '/admin/contacts',
        name: 'Contacts',
        component: () => import('../views/Contacts.vue')
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

// Navigation guard bảo vệ các route admin
router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('token')
    if (to.name !== 'AdminLogin' && to.path.startsWith('/admin') && !token) {
        next({ name: 'AdminLogin' })
    } else {
        next()
    }
})

export default router 