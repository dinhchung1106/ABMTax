<template>
  <div class="users-page">
    <el-card v-loading="permissionsLoading">
      <div class="users-header">
        <el-input v-model="search" placeholder="Tìm kiếm tên hoặc email..." clearable class="search-input" @input="fetchUsers" />
        <el-button type="primary" @click="openAdd" v-if="hasPermission('create_user')">Thêm User</el-button>
      </div>
      <el-table :data="filteredUsers" style="width: 100%" v-loading="loading">
        <el-table-column prop="id" label="#" width="60" />
        <el-table-column label="Avatar" width="80">
          <template #default="{ row }">
            <img :src="row.image ? `/storage/${row.image}` : '/uploads/no-image-available.png'" alt="Main Image" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px; cursor: pointer;" @click="viewImage([row.image ? `/storage/${row.image}` : '/uploads/no-image-available.png'], 0)" />
          </template>
        </el-table-column>
        <el-table-column prop="name" label="Tên" />
        <el-table-column prop="email" label="Email" />
        <el-table-column prop="phone" label="Số điện thoại" />
        <el-table-column prop="address" label="Địa chỉ" />
        <el-table-column prop="date_of_birth" label="Ngày sinh" width="120">
          <template #default="{ row }">
            {{ row.date_of_birth ? formatDate(row.date_of_birth) : '' }}
          </template>
        </el-table-column>
        <el-table-column label="Vai trò" width="150">
          <template #default="{ row }">
            <el-tag v-for="role in row.roles" :key="role.id" size="small" style="margin-right: 4px;">{{ role.name }}</el-tag>
          </template>
        </el-table-column>
        <el-table-column prop="created_at" label="Ngày tạo" width="160">
          <template #default="{ row }">
            {{ formatDate(row.created_at) }}
          </template>
        </el-table-column>
        <el-table-column label="Hành động" width="160">
          <template #default="{ row }">
            <el-button size="small" @click="openEdit(row)" v-if="hasPermission('edit_user')">Sửa</el-button>
            <el-popconfirm title="Xác nhận xóa user này?" @confirm="removeUser(row.id)" v-if="hasPermission('delete_user')">
              <template #reference>
                <el-button size="small" type="danger">Xóa</el-button>
              </template>
            </el-popconfirm>
          </template>
        </el-table-column>
      </el-table>
      <div class="pagination-container">
        <el-pagination
          @current-change="handlePageChange"
          :current-page="currentPage"
          :page-size="pageSize"
          :total="totalUsers"
          layout="total, prev, pager, next"
          background
        />
      </div>
    </el-card>

    <el-dialog :title="editUser ? 'Sửa User' : 'Thêm User'" v-model="showDialog" width="600px">
      <el-form :model="form" :rules="rules" ref="formRef" label-width="120px">
        <el-form-item label="Avatar" prop="image">
          <input type="file" accept="image/*" @change="onFileChange($event, 'image')" :key="imageInputKey"/>
          <img :src="preview.image || (editUser && editUser.image ? `/storage/${editUser.image}` : '/uploads/no-image-available.png')" alt="preview" style="max-width: 100px; margin-top: 6px; cursor: pointer;" @error="preview.image = ''" @click="viewImage([preview.image || (editUser && editUser.image ? `/storage/${editUser.image}` : '/uploads/no-image-available.png')], 0)"/>
          <el-button v-if="preview.image || (editUser && editUser.image)" type="text" @click="clearFile('image')">[x]</el-button>
        </el-form-item>
        <el-form-item label="Tên" prop="name">
          <el-input v-model="form.name" autocomplete="off" />
        </el-form-item>
        <el-form-item label="Email" prop="email">
          <el-input v-model="form.email" autocomplete="off" />
        </el-form-item>
        <el-form-item label="Mật khẩu" prop="password">
          <el-input v-model="form.password" type="password" autocomplete="new-password" :placeholder="editUser ? 'Để trống nếu không đổi' : ''" />
        </el-form-item>
        <el-form-item label="Số điện thoại" prop="phone">
          <el-input v-model="form.phone" />
        </el-form-item>
        <el-form-item label="Địa chỉ" prop="address">
          <el-input v-model="form.address" type="textarea" :rows="2" />
        </el-form-item>
        <el-form-item label="Ngày sinh" prop="date_of_birth">
          <el-date-picker
            v-model="form.date_of_birth"
            type="date"
            placeholder="Chọn ngày"
            format="DD/MM/YYYY"
            value-format="YYYY-MM-DD"
          />
        </el-form-item>
        <el-form-item label="Vai trò" prop="roles">
          <el-select v-model="form.roles" multiple placeholder="Chọn vai trò" style="width: 100%;">
            <el-option v-for="role in rolesList" :key="role.id" :label="role.name" :value="role.name"></el-option>
          </el-select>
        </el-form-item>
      </el-form>
      <template #footer>
        <el-button @click="showDialog = false">Hủy</el-button>
        <el-button type="primary" :loading="saving" @click="saveUser">Lưu</el-button>
      </template>
    </el-dialog>

    <el-image-viewer
      v-if="showViewer"
      :url-list="previewImages"
      :initial-index="previewIndex"
      @close="showViewer = false"
    />
  </div>
</template>

<script setup>
import { ref, computed, onMounted, nextTick, watch } from 'vue'
import { ElMessage, ElMessageBox } from 'element-plus'
import { Plus } from '@element-plus/icons-vue'
import api from '@/api'
import { usePermissions } from '../composables/usePermissions'
import { ElImageViewer } from 'element-plus'
import axios from 'axios'
import { useImageUpload } from '../composables/useImageUpload'

const users = ref([])
const loading = ref(false)
const showDialog = ref(false)
const saving = ref(false)
const editUser = ref(null)
const showViewer = ref(false)
const previewImages = ref([])
const previewIndex = ref(0)
const form = ref({
  name: '',
  email: '',
  password: '',
  roles: [],
  phone: '',
  address: '',
  date_of_birth: '',
  image: ''
})
const rolesList = ref([])
const formRef = ref(null)

const rules = {
  name: [{ required: true, message: 'Vui lòng nhập tên', trigger: 'blur' }],
  email: [
    { required: true, message: 'Vui lòng nhập email', trigger: 'blur' },
    { type: 'email', message: 'Vui lòng nhập email hợp lệ', trigger: ['blur', 'change'] },
  ],
  password: [
    { 
      trigger: 'blur',
      validator: (rule, value, callback) => {
        if (value && value.length < 8) {
          callback(new Error('Mật khẩu phải có ít nhất 8 ký tự'))
          return
        }
        if (!editUser.value && !value) {
          callback(new Error('Vui lòng nhập mật khẩu'))
          return
        }
        callback()
      }
    }
  ],
  roles: [{ required: true, message: 'Vui lòng chọn vai trò', trigger: 'change' }],
  phone: [
    { pattern: /^[0-9]{10,11}$/, message: 'Số điện thoại không hợp lệ', trigger: 'blur' }
  ],
  date_of_birth: [
    { type: 'date', message: 'Ngày sinh không hợp lệ', trigger: 'change' }
  ]
}

const search = ref('')

const { hasPermission, loading: permissionsLoading } = usePermissions()

const uploadUrl = '/api/users/upload-image'
const uploadHeaders = {
  Authorization: `Bearer ${localStorage.getItem('token')}`
}

const preview = ref({ image: '' })
const fileInputs = ref({ image: null })
const imageInputKey = ref(0)

// Use image upload composable for user avatar
const {
  imageFile: avatarFile,
  imagePreviewUrl: avatarPreviewUrl,
  imageInputKey: avatarInputKey,
  handleImageChange: handleAvatarChange,
  removeImage: removeAvatar,
  getImageUrl: getAvatarUrl,
  appendImageToFormData: appendAvatarToFormData,
  resetImageState: resetAvatarState,
} = useImageUpload({
  maxSize: 2048,
  allowedTypes: ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'],
  storagePath: 'uploads/avatars',
});

function onFileChange(e, type) {
  const file = e.target.files[0]
  fileInputs.value[type] = file
  preview.value[type] = file ? URL.createObjectURL(file) : ''
}

const clearFile = (type) => {
  fileInputs.value[type] = null
  preview.value[type] = ''
  if (type === 'image') {
    imageInputKey.value++
  }
}

const formatDate = (date) => {
  if (!date) return '';
  const d = new Date(date);
  return d.toLocaleDateString('vi-VN', {
    year: 'numeric',
    month: '2-digit',
    day: '2-digit'
  });
}

const currentPage = ref(1);
const pageSize = ref(10);
const totalUsers = ref(0);

const fetchUsers = async (options = {}) => {
  loading.value = true
  const page = options.page ?? currentPage.value;
  const currentSearch = options.search ?? search.value;
  try {
    const response = await api.get('/users', {
      params: {
        page: page,
        per_page: pageSize.value,
        search: currentSearch,
      }
    })
    users.value = response.data.data
    totalUsers.value = response.data.total
    currentPage.value = response.data.current_page;
  } catch (e) {
    ElMessage.error('Lỗi khi tải dữ liệu người dùng!')
    console.error(e)
  } finally {
    loading.value = false
  }
}

const handlePageChange = (newPage) => {
  fetchUsers({ page: newPage, search: search.value });
};

const fetchRoles = async () => {
  try {
    const response = await api.get('/roles')
    rolesList.value = response.data.map(role => ({
      id: role.id,
      name: role.name
    }))
  } catch (e) {
    ElMessage.error('Lỗi khi tải danh sách vai trò!')
    console.error('Error fetching roles:', e)
  }
}

const filteredUsers = computed(() => {
  if (!search.value) return users.value
  const searchLower = search.value.toLowerCase()
  return users.value.filter(u =>
    u.name.toLowerCase().includes(searchLower) ||
    u.email.toLowerCase().includes(searchLower) ||
    (u.phone && u.phone.includes(search.value)) ||
    (u.address && u.address.toLowerCase().includes(searchLower))
  )
})

const openAdd = () => {
  editUser.value = null;
  form.value = { name: '', email: '', phone: '', address: '', date_of_birth: '', password: '', password_confirmation: '', status: true };
  resetAvatarState();
  showDialog.value = true;
};

const openEdit = (user) => {
  editUser.value = user;
  form.value = { 
    name: user.name, 
    email: user.email, 
    phone: user.phone, 
    address: user.address, 
    date_of_birth: user.date_of_birth, 
    password: '', 
    password_confirmation: '', 
    status: !!user.status,
    roles: user.roles.map(role => role.name)
  };
  preview.value = { 
    image: user.image ? `/storage/${user.image}` : '' 
  };
  showDialog.value = true;
};

const saveUser = async () => {
  if (!formRef.value) return;

  try {
    await formRef.value.validate();
    saving.value = true;

    const formData = new FormData();
    
    // Handle image upload
    if (fileInputs.value.image) {
      formData.append('image', fileInputs.value.image);
    }

    // Append other fields
    for (const key in form.value) {
      if (key === 'status') {
        formData.append(key, form.value[key] ? 1 : 0);
      } else if (key === 'roles') {
        // Handle roles array properly
        form.value[key].forEach(role => {
          formData.append('roles[]', role);
        });
      } else if (key !== 'image') {
        if (form.value[key] !== null && form.value[key] !== undefined) {
          formData.append(key, form.value[key]);
        }
      }
    }

    // Handle image removal
    if (editUser.value) {
      if (!fileInputs.value.image && !editUser.value.image) {
        formData.append('remove_image', 1);
      }
    }

    let response;
    const apiUrl = editUser.value
      ? `/api/users/${editUser.value.id}`
      : '/api/users';

    if (editUser.value) {
      formData.append('_method', 'PUT');
      response = await axios.post(apiUrl, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
          'Authorization': `Bearer ${localStorage.getItem('token')}`
        },
      });
      ElMessage.success('Cập nhật người dùng thành công!');
    } else {
      response = await axios.post(apiUrl, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
          'Authorization': `Bearer ${localStorage.getItem('token')}`
        },
      });
      ElMessage.success('Thêm người dùng thành công!');
    }

    showDialog.value = false;
    fetchUsers();
  } catch (error) {
    console.error('Error saving user:', error);
    if (error.response && error.response.status === 422) {
      const errors = error.response.data.errors;
      let errorMsg = 'Lỗi xác thực:<br>';
      for (const field in errors) {
        errorMsg += `- ${errors[field].join(', ')}<br>`;
      }
      ElMessageBox.alert(errorMsg, 'Lỗi', {
        dangerouslyUseHTMLString: true,
        confirmButtonText: 'OK',
      });
    } else {
      ElMessage.error('Lỗi khi lưu người dùng!');
    }
  } finally {
    saving.value = false;
  }
};

const removeUser = async (id) => {
  try {
    await api.delete(`/users/${id}`)
    ElMessage.success('Đã xóa user!')
    fetchUsers()
  } catch (e) {
    ElMessage.error('Không thể xóa user!')
  }
}

watch(showDialog, (newVal) => {
  if (!newVal) {
    form.value = {
      name: '',
      email: '',
      password: '',
      roles: [],
      phone: '',
      address: '',
      date_of_birth: '',
      image: ''
    }
    preview.value = { image: '' }
    fileInputs.value = { image: null }
    nextTick(() => {
      if (formRef.value) {
        formRef.value.clearValidate()
      }
    })
  }
})

const viewImage = (images, index) => {
  previewImages.value = images
  previewIndex.value = index
  showViewer.value = true
}

onMounted(() => {
  fetchUsers()
  fetchRoles()
})
</script>

<style scoped>
.users-page {
  padding: 16px;
}
.users-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}
.search-input {
  width: 260px;
}
.image-upload-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
}
.avatar-uploader {
  text-align: center;
}
.avatar-uploader .el-upload {
  border: 1px dashed var(--el-border-color);
  border-radius: 6px;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  transition: var(--el-transition-duration-fast);
}
.avatar-uploader .el-upload:hover {
  border-color: var(--el-color-primary);
}
.avatar-uploader-icon {
  font-size: 28px;
  color: #8c939d;
  width: 100px;
  height: 100px;
  text-align: center;
  line-height: 100px;
}
.avatar {
  width: 100px;
  height: 100px;
  display: block;
  object-fit: cover;
}
.clear-image-btn {
  margin-top: 8px;
}
.pagination-container {
  margin-top: 16px;
  display: flex;
  justify-content: flex-end;
}
.user-thumb {
  width: 48px;
  height: 48px;
  object-fit: cover;
  border-radius: 6px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}
</style> 