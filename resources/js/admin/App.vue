<template>
  <component v-if="isReady" :is="layout">
    <router-view />
  </component>
</template>

<script setup>
import { computed, ref, onBeforeMount } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import AdminLayout from './layouts/AdminLayout.vue'
import AuthLayout from './layouts/AuthLayout.vue'

const route = useRoute()
const router = useRouter()
const isReady = ref(false)

const layout = computed(() => {
  if (route.meta.layout === 'auth') return AuthLayout
  return AdminLayout
})

onBeforeMount(async () => {
  await router.isReady()
  isReady.value = true
})
</script>

<style>
.layout-container {
    height: 100vh;
}

.el-header {
    background-color: #fff;
    border-bottom: 1px solid #dcdfe6;
    padding: 0 20px;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 100%;
}

.el-menu-vertical {
    height: 100%;
    border-right: none;
}

.el-dropdown-link {
    cursor: pointer;
    display: flex;
    align-items: center;
}
</style> 