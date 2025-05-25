<template>
  <div class="admin-profile-page">
    <el-card v-loading="loading || savingProfile">
      <h2>Chỉnh sửa thông tin cá nhân</h2>

      <el-form :model="profileForm" :rules="profileRules" ref="profileFormRef" label-width="150px" style="max-width: 600px; margin-top: 20px;">
        <el-form-item label="Tên" prop="name">
          <el-input v-model="profileForm.name"></el-input>
        </el-form-item>

        <el-form-item label="Email" prop="email">
          <el-input v-model="profileForm.email"></el-input>
        </el-form-item>

        <el-form-item label="Điện thoại" prop="phone">
          <el-input v-model="profileForm.phone"></el-input>
        </el-form-item>

        <el-form-item label="Địa chỉ" prop="address">
          <el-input v-model="profileForm.address"></el-input>
        </el-form-item>

        <el-form-item label="Ngày sinh" prop="date_of_birth">
          <el-date-picker v-model="profileForm.date_of_birth" type="date" placeholder="Chọn ngày"></el-date-picker>
        </el-form-item>

        <el-form-item label="Ảnh đại diện" prop="image">
          <input type="file" accept="image/*" @change="onFileChange($event, 'image')" :key="imageInputKey"/>
          <img :src="preview.image || profileForm.image || '/uploads/no-image-available.png'" alt="preview" style="max-width: 100px; margin-top: 6px; cursor: pointer;" @error="preview.image = ''; profileForm.image = ''" />
          <el-button v-if="preview.image || profileForm.image" type="text" @click="clearFile('image')">[x]</el-button>
        </el-form-item>

        <el-form-item label="Mật khẩu mới" prop="password">
          <el-input type="password" v-model="profileForm.password" placeholder="Để trống nếu không đổi mật khẩu" show-password autocomplete="new-password"></el-input>
        </el-form-item>

        <el-form-item label="Xác nhận mật khẩu mới" prop="password_confirmation">
          <el-input type="password" v-model="profileForm.password_confirmation" placeholder="Nhập lại mật khẩu mới" show-password></el-input>
        </el-form-item>

        <el-form-item label="Vai trò">
            <el-tag
                v-for="(role, index) in profileForm.roles"
                :key="index"
                size="small"
                style="margin-right: 4px; margin-bottom: 4px;"
            >{{ typeof role === 'object' ? role.name : role }}</el-tag>
            <span v-if="!profileForm.roles || profileForm.roles.length === 0">Không có vai trò nào</span>
        </el-form-item>

        <el-form-item>
          <el-button type="primary" @click="saveProfile" :loading="savingProfile">Lưu thay đổi</el-button>
        </el-form-item>
      </el-form>

    </el-card>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { ElMessage } from 'element-plus';
import { Plus } from '@element-plus/icons-vue'; // Import Plus icon
import { useImageUpload } from '../composables/useImageUpload';

const profileForm = ref({
  name: '',
  email: '',
  phone: '',
  address: '',
  date_of_birth: null,
  image: '',
  password: '',
  password_confirmation: '',
  roles: [], // Added roles field (array of role objects/names)
});

// Add validation rules
const profileRules = ref({
  name: [{ required: true, message: 'Vui lòng nhập tên', trigger: 'blur' }],
  email: [
    { required: true, message: 'Vui lòng nhập email', trigger: 'blur' },
    { type: 'email', message: 'Định dạng email không hợp lệ', trigger: ['blur', 'change'] }
  ],
  password: [
    { min: 8, message: 'Mật khẩu phải có ít nhất 8 ký tự', trigger: 'blur' },
     { // Custom validation for password confirmation
        validator: (rule, value, callback) => {
            if (profileForm.value.password !== profileForm.value.password_confirmation) {
                callback(new Error('Xác nhận mật khẩu không khớp'));
            } else {
                callback();
            }
        }, trigger: 'blur'
     }
  ],
  password_confirmation: [
     { // Custom validation to require password confirmation only if password is entered
        validator: (rule, value, callback) => {
            if (profileForm.value.password && !value) {
                callback(new Error('Vui lòng xác nhận mật khẩu'));
            } else if (value && profileForm.value.password !== value) {
                 callback(new Error('Xác nhận mật khẩu không khớp'));
            } else {
                callback();
            }
        }, trigger: 'blur'
     }
  ]
  // Add more rules for phone, address, date_of_birth if needed
});

const profileFormRef = ref(null);
const savingProfile = ref(false);
const loading = ref(false);

const preview = ref({ image: '' }); // Ref for image preview URL
const fileInputs = ref({ image: null }); // Ref for the selected file object
const imageInputKey = ref(0); // Key to force update file input

// Use image upload composable for profile image
const {
  imageFile: profileImageFile,
  imagePreviewUrl: profileImagePreviewUrl,
  imageInputKey: profileImageInputKey,
  handleImageChange: handleProfileImageChange,
  removeImage: removeProfileImage,
  getImageUrl: getProfileImageUrl,
  appendImageToFormData: appendProfileImageToFormData,
  resetImageState: resetProfileImageState,
} = useImageUpload({
  maxSize: 2048,
  allowedTypes: ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'],
  storagePath: 'uploads/users',
});

// Handle file change from input type=file
function onFileChange(e, type) {
  const file = e.target.files[0];
  if (file) {
    // Basic validation before processing (you might want to use beforeImageUpload logic here too)
    const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    const isImage = allowedTypes.includes(file.type);
    const isLt2M = file.size / 1024 / 1024 < 2; // Max 2MB

    if (!isImage) {
      ElMessage.error('Chỉ chấp nhận file JPG, PNG, GIF!');
      clearFile(type); // Clear the invalid file
      return;
    }
    if (!isLt2M) {
      ElMessage.error('Ảnh đại diện không được lớn hơn 2MB!');
      clearFile(type); // Clear the invalid file
      return;
    }

    fileInputs.value[type] = file;
    preview.value[type] = URL.createObjectURL(file);
  } else {
    clearFile(type);
  }
}

// Clear the selected file and preview
const clearFile = (type) => {
  fileInputs.value[type] = null;
  preview.value[type] = '';
  // Reset the file input element to allow selecting the same file again
  if (type === 'image') {
    imageInputKey.value++;
  }
  // Also clear the profileForm.image if it's the old image URL
  if (profileForm.value.image && !preview.value.image) {
      profileForm.value.image = '';
  }
};

const fetchAdminProfile = async () => {
  loading.value = true;
  try {
    const response = await axios.get('/api/me');
    // Assuming the /api/me endpoint returns user data directly
    const userData = response.data;

    // Populate the form with user data
    profileForm.value.name = userData.name;
    profileForm.value.email = userData.email;
    profileForm.value.phone = userData.phone || ''; // Handle nullable fields
    profileForm.value.address = userData.address || ''; // Handle nullable fields
    profileForm.value.date_of_birth = userData.date_of_birth ? new Date(userData.date_of_birth) : null; // Convert string to Date object
    profileForm.value.image = userData.image || ''; // Assuming 'image' is the field name for the profile picture URL
    profileForm.value.roles = userData.roles || []; // Assuming roles are returned

    // Set image preview if an image URL exists
    if (profileForm.value.image) {
       profileImagePreviewUrl.value = getProfileImageUrl(profileForm.value.image);
    } else {
       profileImagePreviewUrl.value = '';
    }

  } catch (error) {
    console.error('Error fetching profile:', error);
    ElMessage.error('Lỗi khi tải thông tin profile!');
  } finally {
    loading.value = false;
  }
};

const saveProfile = async () => {
  if (!profileFormRef.value) return;

  try {
    await profileFormRef.value.validate();
    savingProfile.value = true;

    const formData = new FormData();

    // Use the composable function to append the image data
    // It handles adding the new file, the existing URL, or the remove_image flag
    appendProfileImageToFormData(formData, 'image', profileForm.value.image);

    // Append other fields
    for (const key in profileForm.value) {
      if (key === 'status') {
        formData.append(key, profileForm.value[key] ? 1 : 0);
      } else if (key === 'date_of_birth') {
          // Format date_of_birth to YYYY-MM-DD string if it's a Date object
          if (profileForm.value[key] instanceof Date && !isNaN(profileForm.value[key])) {
              const date = profileForm.value[key];
              const formattedDate = date.getFullYear() + '-' +
                                  ('0' + (date.getMonth() + 1)).slice(-2) + '-' +
                                  ('0' + date.getDate()).slice(-2);
              formData.append(key, formattedDate);
          } else if (profileForm.value[key] !== null && profileForm.value[key] !== undefined) {
              // Append existing string date or other non-Date value if any
              formData.append(key, profileForm.value[key]);
          } else {
              formData.append(key, ''); // Append empty string for null/undefined
          }
      } else if (key !== 'image' && key !== 'roles') { // Exclude image, roles, and handled date_of_birth
        if (profileForm.value[key] !== null && profileForm.value[key] !== undefined) {
          formData.append(key, profileForm.value[key]);
        }
      }
    }

    // Add the _method field for PUT requests with FormData
    formData.append('_method', 'PUT');

    // Use the correct endpoint for updating profile information
    const response = await axios.post('/api/me', formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      },
    });

    ElMessage.success('Cập nhật profile thành công!');
    fetchAdminProfile();
  } catch (error) {
    console.error('Error saving profile:', error);
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
      ElMessage.error('Lỗi khi lưu profile!');
    }
  } finally {
    savingProfile.value = false;
  }
};

onMounted(() => {
  fetchAdminProfile(); // Fetch data when the component is mounted
});

</script>

<style scoped>
.admin-profile-page {
  padding: 20px;
}
</style> 