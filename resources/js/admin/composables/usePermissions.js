import { ref, onMounted } from 'vue'
import api from '@/api'

export function usePermissions() {
  const permissions = ref([])
  const loading = ref(true)

  const fetchPermissions = async () => {
    try {
      loading.value = true
      const response = await api.get('/permissions')
      permissions.value = response.data
    } catch (error) {
      console.error('Error fetching permissions:', error)
    } finally {
      loading.value = false
    }
  }

  const hasPermission = (permission) => {
    if (loading.value) {
      return false
    }
    const has = permissions.value.includes(permission)
    return has
  }

  // Fetch permissions immediately
  fetchPermissions()

  return {
    permissions,
    hasPermission,
    loading
  }
} 