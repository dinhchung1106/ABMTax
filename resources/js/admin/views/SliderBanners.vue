<template>
  <div class="slider-banners-page">
    <el-card v-loading="loading || permissionsLoading">
      <div class="header">
        <h2>Quản lý Slider Banner</h2>
        <el-button type="primary" @click="openAddDialog" v-if="hasPermission('create_slider_banner')">Thêm Banner</el-button>
      </div>

      <el-table :data="banners" style="width: 100%">
        <el-table-column prop="order" label="Thứ tự" width="80" sortable />
        <el-table-column label="Ảnh" width="120">
          <template #default="{ row }">
            <img :src="row.image || '/uploads/no-image-available.png'" alt="Banner Image" style="width: 100px; height: 50px; object-fit: cover; cursor: pointer;" @click="viewImage([row.image || '/uploads/no-image-available.png'], 0)" />
          </template>
        </el-table-column>
        <el-table-column prop="title" label="Tiêu đề" />
        <el-table-column prop="description" label="Mô tả" />
        <el-table-column label="Link">
          <template #default="{ row }">
            <a v-if="row.link" :href="row.link" target="_blank" style="color: #409EFF; text-decoration: none;">{{ row.link }}</a>
            <span v-else>Không có</span>
          </template>
        </el-table-column>
        <el-table-column prop="button_text" label="Text Button" width="120" />
        <el-table-column label="Trạng thái" width="100">
          <template #default="{ row }">
            <el-tag :type="row.status ? 'success' : 'info'">{{ row.status ? 'Hiện' : 'Ẩn' }}</el-tag>
          </template>
        </el-table-column>
        <el-table-column label="Hành động" width="150">
          <template #default="{ row }">
            <el-button size="small" @click="openEditDialog(row)" v-if="hasPermission('edit_slider_banner')">Sửa</el-button>
            <el-popconfirm title="Xác nhận xóa banner này?" @confirm="deleteBanner(row.id)" v-if="hasPermission('delete_slider_banner')">
              <template #reference>
                <el-button size="small" type="danger">Xóa</el-button>
              </template>
            </el-popconfirm>
          </template>
        </el-table-column>
      </el-table>

      <el-dialog :title="isEdit ? 'Sửa Banner' : 'Thêm Banner'" v-model="dialogVisible" width="600px">
        <el-form :model="form" :rules="rules" ref="formRef" label-width="120px">
          <el-form-item label="Tiêu đề" prop="title">
            <el-input v-model="form.title" />
          </el-form-item>
          <el-form-item label="Mô tả" prop="description">
            <el-input v-model="form.description" type="textarea" :rows="2" />
          </el-form-item>
          <el-form-item label="Ảnh Banner" prop="image">
            <input type="file" accept="image/*" @change="handleImageChange" :key="imageInputKey" />
            <span style="font-size: 0.9em; color: #666; margin-left: 10px;">(Kích thước đề xuất: 1690x600)</span>
            <img v-if="imagePreviewUrl" :src="imagePreviewUrl" alt="Image Preview" style="max-width: 200px; margin-top: 10px;" />
            <el-button v-if="imagePreviewUrl" type="text" @click="removeImage">Xóa ảnh</el-button>
          </el-form-item>
          <el-form-item label="Link" prop="link">
            <el-input v-model="form.link" placeholder="http:// hoặc https://" />
          </el-form-item>
          <el-form-item label="Text Button" prop="button_text">
            <el-input v-model="form.button_text" />
          </el-form-item>
          <el-form-item label="Thứ tự" prop="order">
            <el-input-number v-model="form.order" :min="0" />
          </el-form-item>
          <el-form-item label="Trạng thái" prop="status">
            <el-switch v-model="form.status" active-text="Hiện" inactive-text="Ẩn" />
          </el-form-item>
        </el-form>
        <template #footer>
          <span class="dialog-footer">
            <el-button @click="dialogVisible = false">Hủy</el-button>
            <el-button type="primary" @click="saveBanner" :loading="saving">Lưu</el-button>
          </span>
        </template>
      </el-dialog>
    </el-card>

    <el-image-viewer
      v-if="showViewer"
      :url-list="previewImages"
      :initial-index="previewIndex"
      @close="showViewer = false"
    />

  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import api from '@/api'; // Assuming you have an api.js for axios instance
import { ElMessage, ElMessageBox } from 'element-plus';
import { usePermissions } from '../composables/usePermissions';
import { ElImageViewer } from 'element-plus';
import { useImageUpload } from '../composables/useImageUpload';

const banners = ref([]);
const loading = ref(false);
const dialogVisible = ref(false);
const saving = ref(false);
const isEdit = ref(false);
const form = ref({
  title: '',
  description: '',
  image: null,
  link: '',
  button_text: '',
  status: true,
  order: 0,
});
const formRef = ref(null);
const editingBannerId = ref(null);

// Use the image upload composable
const {
  imageFile,
  imagePreviewUrl,
  imageInputKey,
  handleImageChange,
  removeImage,
  getImageUrl,
  appendImageToFormData,
  resetImageState,
} = useImageUpload({
  maxSize: 2048,
  allowedTypes: ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'],
  storagePath: 'uploads/banners',
});

const showViewer = ref(false);
const previewImages = ref([]);
const previewIndex = ref(0);

const rules = {
  image: [
    {
      required: true,
      validator: (rule, value, callback) => {
        if (!isEdit.value && !imageFile.value) {
          callback(new Error('Vui lòng chọn ảnh banner'));
          return;
        }
        if (isEdit.value && !form.value.image && !imageFile.value) {
             callback(new Error('Vui lòng chọn ảnh banner'));
             return;
        }
        callback();
      },
      trigger: 'change'
    }
  ],
  order: [{ required: true, message: 'Vui lòng nhập thứ tự', trigger: 'blur' }],
};

const { hasPermission, loading: permissionsLoading } = usePermissions();

const fetchBanners = async () => {
  loading.value = true;
  try {
    const response = await api.get('/slider-banners');
    // Assuming the API returns an array of banners directly in response.data
    banners.value = response.data;
  } catch (error) {
    ElMessage.error('Lỗi khi tải dữ liệu banner!');
    console.error('Error fetching banners:', error);
  } finally {
    loading.value = false;
  }
};

const openAddDialog = () => {
  isEdit.value = false;
  form.value = {
    title: '',
    description: '',
    image: null,
    link: '',
    button_text: '',
    status: true,
    order: 0,
  };
  resetImageState();
  editingBannerId.value = null;
  dialogVisible.value = true;
};

const openEditDialog = (banner) => {
  isEdit.value = true;
  form.value = {
    title: banner.title,
    description: banner.description,
    image: banner.image,
    link: banner.link,
    button_text: banner.button_text,
    status: !!banner.status,
    order: banner.order,
  };
  resetImageState();
  imagePreviewUrl.value = getImageUrl(banner.image);
  editingBannerId.value = banner.id;
  dialogVisible.value = true;
};

const saveBanner = async () => {
  if (!formRef.value) return;

  try {
    await formRef.value.validate();
    saving.value = true;

    const formData = new FormData();
    
    // Use the composable's method to append image
    appendImageToFormData(formData);

    // Handle other fields
    for (const key in form.value) {
      if (key === 'status') {
        formData.append(key, form.value[key] ? 1 : 0);
      } else if (key !== 'image') {
        if (form.value[key] !== null && form.value[key] !== undefined) {
          formData.append(key, form.value[key]);
        }
      }
    }

    // Handle image removal
    if (isEdit.value && form.value.image === null && !imageFile.value) {
      formData.append('remove_image', 1);
    }

    let response;
    const apiUrl = isEdit.value && editingBannerId.value
      ? `/slider-banners/${editingBannerId.value}`
      : '/slider-banners';

    if (isEdit.value && editingBannerId.value) {
      formData.append('_method', 'PUT');
      response = await api.post(apiUrl, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });
      ElMessage.success('Cập nhật banner thành công!');
    } else {
      response = await api.post(apiUrl, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });
      ElMessage.success('Thêm banner thành công!');
    }

    dialogVisible.value = false;
    fetchBanners();
  } catch (error) {
    console.error('Error saving banner:', error);
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
      ElMessage.error('Lỗi khi lưu banner!');
    }
  } finally {
    saving.value = false;
  }
};

const deleteBanner = async (id) => {
  try {
    await api.delete(`/slider-banners/${id}`);
    ElMessage.success('Đã xóa banner!');
    fetchBanners(); // Refresh list
  } catch (error) {
    ElMessage.error('Không thể xóa banner!');
    console.error('Error deleting banner:', error);
  }
};

const viewImage = (imageUrls, index) => {
  previewImages.value = imageUrls;
  previewIndex.value = index;
  showViewer.value = true;
};

onMounted(() => {
  fetchBanners();
});

// Add style for image in table if needed
</script>

<style scoped>
.slider-banners-page {
  padding: 20px;
}
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}
</style> 