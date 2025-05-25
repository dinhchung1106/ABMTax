<template>
  <div class="roles-management-page">
    <el-card>
      <h2>Quản lý Vai trò & Quyền hạn</h2>
      
      <!-- Section for Role Management -->
      <div class="roles-section">
        <h3>Vai trò</h3>
        <el-button type="primary" @click="openAddRoleDialog">Thêm Vai trò</el-button>
        <el-table :data="roles" v-loading="loadingRoles" style="width: 100%; margin-top: 16px;">
          <el-table-column prop="id" label="ID" width="60"></el-table-column>
          <el-table-column prop="name" label="Tên Vai trò"></el-table-column>
          <el-table-column label="Quyền hạn">
             <template #default="{ row }">
                <el-tag v-for="(permission, index) in row.permissions" :key="index" size="small" style="margin-right: 4px; margin-bottom: 4px;">{{ permission.name }}</el-tag>
                <span v-if="!row.permissions || row.permissions.length === 0">Không có quyền nào</span>
            </template>
          </el-table-column>
          <el-table-column label="Hành động" width="180">
            <template #default="{ row }">
              <el-button size="small" @click="openEditRoleDialog(row)">Sửa</el-button>
              <el-popconfirm title="Xác nhận xóa vai trò này?" @confirm="deleteRole(row.id)">
                <template #reference>
                  <el-button size="small" type="danger">Xóa</el-button>
                </template>
              </el-popconfirm>
            </template>
          </el-table-column>
        </el-table>
      </div>

      <!-- Dialog for Add/Edit Role -->
      <el-dialog :title="editRole ? 'Sửa Vai trò' : 'Thêm Vai trò'" v-model="showRoleDialog" width="600px">
        <el-form :model="roleForm" :rules="roleRules" ref="roleFormRef" label-width="120px">
          <el-form-item label="Tên Vai trò" prop="name">
            <el-input v-model="roleForm.name"></el-input>
          </el-form-item>
           <el-form-item label="Quyền hạn">
              <div class="permissions-container" style="padding: 10px; border: 1px solid #eee; border-radius: 4px;">
                <el-checkbox-group v-model="roleForm.permissions" class="permissions-grid">
                    <div v-for="(permissionsInGroup, groupName) in groupedPermissions" :key="groupName">
                      <h4>{{ groupName.charAt(0).toUpperCase() + groupName.slice(1) }}</h4>
                      <el-checkbox v-for="permissionName in permissionsInGroup" :key="permissionName" :label="permissionName">{{ permissionName }}</el-checkbox>
                    </div>
                </el-checkbox-group>
              </div>
           </el-form-item>
        </el-form>
        <template #footer>
          <el-button @click="showRoleDialog = false">Hủy</el-button>
          <el-button type="primary" :loading="savingRole" @click="saveRole">Lưu</el-button>
        </template>
      </el-dialog>

      <!-- Section for Permission List (Optional, for reference) -->
      <!-- You might want a separate page for managing permissions if needed -->
      <!-- <div class="permissions-section" style="margin-top: 32px;">
        <h3>Danh sách Quyền hạn</h3>
        <el-table :data="permissions" v-loading="loadingPermissions" style="width: 100%;">
             <el-table-column prop="id" label="ID" width="60"></el-table-column>
             <el-table-column prop="name" label="Tên Quyền hạn"></el-table-column>
        </el-table>
      </div> -->

    </el-card>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { ElMessage, ElMessageBox } from 'element-plus';

const roles = ref([]);
const permissions = ref([]);
const groupedPermissions = ref({});
const loadingRoles = ref(false);
const loadingPermissions = ref(false);
const showRoleDialog = ref(false);
const roleForm = ref({ name: '', permissions: [] });
const roleRules = { name: [{ required: true, message: 'Vui lòng nhập tên vai trò', trigger: 'blur' }] };
const roleFormRef = ref(null);
const editRole = ref(null);
const savingRole = ref(false);

const fetchRoles = async () => {
  loadingRoles.value = true;
  try {
    const response = await axios.get('/api/roles');
    roles.value = response.data;
  } catch (error) {
    ElMessage.error('Lỗi khi tải danh sách vai trò!');
    console.error(error);
  } finally {
    loadingRoles.value = false;
  }
};

const fetchPermissions = async () => {
  loadingPermissions.value = true;
  try {
    const response = await axios.get('/api/permissions');
    console.log('API Permissions Response:', response.data); // Keep this log
    permissions.value = response.data;
    
    // Group permissions (updated for array of strings)
    const tempGroupedPermissions = permissions.value.reduce((acc, permissionName) => {
      if (typeof permissionName === 'string') {
        const parts = permissionName.split('_', 2);
        const groupName = parts.length > 1 ? parts[1] : 'General'; // Group by the part after the first underscore, default to 'General'
        if (!acc[groupName]) {
          acc[groupName] = [];
        }
        acc[groupName].push(permissionName);
      } else {
        console.warn('Skipping invalid permission data:', permissionName);
      }
      return acc;
    }, {});
    
    groupedPermissions.value = tempGroupedPermissions;
    console.log('Grouped Permissions:', groupedPermissions.value); // Add log for grouped permissions

  } catch (error) {
    ElMessage.error('Lỗi khi tải danh sách quyền hạn!');
    console.error(error);
  } finally {
    loadingPermissions.value = false;
  }
};

const openAddRoleDialog = () => {
  editRole.value = null;
  roleForm.value = { name: '', permissions: [] };
  showRoleDialog.value = true;
  if (roleFormRef.value) {
    roleFormRef.value.resetFields();
  }
};

const openEditRoleDialog = (role) => {
  editRole.value = role;
  // Map role permissions to form format (array of permission names)
  roleForm.value = {
    id: role.id,
    name: role.name,
    permissions: role.permissions ? role.permissions.map(p => p.name) : []
  };
  showRoleDialog.value = true;
  if (roleFormRef.value) {
    roleFormRef.value.resetFields();
  }
};

const saveRole = async () => {
  if (!roleFormRef.value) return;

  roleFormRef.value.validate(async (valid) => {
    if (valid) {
      savingRole.value = true;
      try {
        let response;
        if (editRole.value) {
          // Update role: PUT request to /api/roles/{id}
          response = await axios.put(`/api/roles/${roleForm.value.id}`, roleForm.value);
          ElMessage.success('Cập nhật vai trò thành công!');
        } else {
          // Create new role: POST request to /api/roles
          response = await axios.post('/api/roles', roleForm.value);
          ElMessage.success('Thêm vai trò thành công!');
        }
        showRoleDialog.value = false;
        fetchRoles(); // Refresh roles list after saving
      } catch (error) {
         // Handle validation errors from backend (status 400)
         if (error.response && error.response.status === 400) {
            const errors = error.response.data.errors; // Spatie validator returns errors under 'errors' key
             let errorMessage = 'Lỗi khi lưu vai trò:\n';
             for (const field in errors) {
                errorMessage += `${field}: ${errors[field].join(', ')}\n`;
             }
             ElMessage.error(errorMessage);
         } else {
            ElMessage.error(error.response?.data?.message || 'Lỗi khi lưu vai trò!');
         }
        console.error(error);
      } finally {
        savingRole.value = false;
      }
    }
  });
};

const deleteRole = async (roleId) => {
  // Add confirmation using ElMessageBox before deleting
  ElMessageBox.confirm(
    'Bạn có chắc chắn muốn xóa vai trò này không?',
    'Cảnh báo',
    {
      confirmButtonText: 'Xóa',
      cancelButtonText: 'Hủy',
      type: 'warning',
    }
  ).then(async () => {
    try {
      // Delete role: DELETE request to /api/roles/{id}
      await axios.delete(`/api/roles/${roleId}`);
      ElMessage.success('Xóa vai trò thành công!');
      fetchRoles(); // Refresh roles list after deleting
    } catch (error) {
      ElMessage.error(error.response?.data?.message || 'Lỗi khi xóa vai trò!');
      console.error(error);
    }
  }).catch(() => {
      // Catch cancel action
  });
};

onMounted(() => {
  fetchRoles();
  fetchPermissions(); // Fetch permissions to display in the form
});
</script>

<style scoped>
.roles-management-page {
  padding: 16px;
}

.roles-section h3, .permissions-section h3 {
    margin-bottom: 12px;
    border-bottom: 1px solid #eee;
    padding-bottom: 8px;
}

.el-tag {
    margin-right: 4px;
}

.permissions-container {
  /* Removed max-height and overflow */
}

.permissions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); /* Adjust column width as needed */
    gap: 8px;
    align-items: start; /* Align items to the start of their grid area */
}

.permissions-grid h4 {
  grid-column: 1 / -1; /* Make the group header span all columns */
  margin-top: 15px; /* Added some top margin for spacing */
  margin-bottom: 8px; /* Adjusted bottom margin */
  padding-bottom: 4px;
  border-bottom: 1px solid #eee; /* Add a subtle line below the group header */
}

.permissions-grid .el-checkbox {
  margin-right: 0; /* Remove default right margin from checkbox */
  margin-bottom: 5px; /* Add some bottom margin for spacing between checkboxes */
}

.permissions-grid .el-checkbox__label {
  word-break: break-all; /* Allow long permission names to wrap */
  white-space: normal; /* Allow label text to wrap */
}
</style> 