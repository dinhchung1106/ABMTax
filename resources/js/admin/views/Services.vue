<template>
  <div class="services-page">
    <el-card>
      <h2>Quản lý dịch vụ</h2>
      <div class="services-header">
        <el-input v-model="search" placeholder="Tìm kiếm tên dịch vụ..." clearable class="search-input" @input="fetchServices" />
        <el-button type="primary" @click="openAdd">Thêm Dịch vụ</el-button>
      </div>
      <el-table :data="filteredServices" style="width: 100%" v-loading="loading">
        <el-table-column prop="id" label="#" width="60" />
        <el-table-column prop="name" label="Tên dịch vụ" />
        <el-table-column prop="slug" label="Slug" />
        <el-table-column label="Ảnh chính" width="100">
          <template #default="{ row }">
            <img :src="row.image ? `/storage/${row.image}` : '/uploads/no-image-available.png'" alt="Main Image" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px; cursor: pointer;" @click="viewImage([row.image ? `/storage/${row.image}` : '/uploads/no-image-available.png'], 0)" />
          </template>
        </el-table-column>
        <el-table-column label="Ảnh banner" width="100">
          <template #default="{ row }">
            <img :src="row.image_banner ? `/storage/${row.image_banner}` : '/uploads/no-image-available.png'" alt="Banner Image" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px; cursor: pointer;" @click="viewImage([row.image_banner ? `/storage/${row.image_banner}` : '/uploads/no-image-available.png'], 0)" />
          </template>
        </el-table-column>
        <el-table-column label="Ảnh slider" width="100">
          <template #default="{ row }">
            <span v-if="row.image_slider && row.image_slider.length > 0" style="cursor: pointer; text-decoration: underline;" @click="viewImage(row.image_slider.map(img => `/storage/${img}`), 0)">{{ row.image_slider.length }} tệp</span>
            <span v-else style="cursor: pointer; text-decoration: underline;" @click="viewImage(['/uploads/no-image-available.png'], 0)">0 tệp</span>
          </template>
        </el-table-column>
        <el-table-column prop="price" label="Giá" width="120">
          <template #default="{ row }">
            {{ row.price ? row.price.toLocaleString() + ' đ' : '' }}
          </template>
        </el-table-column>
        <el-table-column prop="status" label="Trạng thái" width="100">
          <template #default="{ row }">
            <el-tag :type="row.status ? 'success' : 'info'">{{ row.status ? 'Hiện' : 'Ẩn' }}</el-tag>
          </template>
        </el-table-column>
        <el-table-column label="Hành động" width="160">
          <template #default="{ row }">
            <el-button size="small" @click="openEdit(row)">Sửa</el-button>
            <el-popconfirm title="Xác nhận xóa dịch vụ này?" @confirm="removeService(row.id)">
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
          :total="totalServices"
          layout="total, prev, pager, next"
          background
        />
      </div>
    </el-card>

    <el-dialog :title="editService ? 'Sửa Dịch vụ' : 'Thêm Dịch vụ'" v-model="showDialog" width="800px">
      <el-form :model="form" :rules="rules" ref="serviceForm" label-width="120px" v-if="showDialog">
        <el-form-item label="Tên dịch vụ" prop="name">
          <el-input v-model="form.name" />
        </el-form-item>
        <el-form-item label="Mô tả" prop="description" class="description-editor-item">
          <ckeditor :editor="ClassicEditor" v-model="form.description" :config="editorConfig"></ckeditor>
        </el-form-item>
        <el-form-item label="Giá" prop="price">
          <el-input v-model.number="form.price" type="number" min="0" />
        </el-form-item>
        <el-form-item label="Trạng thái" prop="status">
          <el-switch v-model="form.status" active-text="Hiện" inactive-text="Ẩn" />
        </el-form-item>

        <el-form-item label="Ảnh đại diện">
          <input type="file" accept="image/*" @change="onFileChange($event, 'image')" :key="mainImageInputKey"/>
          <img :src="mainImagePreviewUrl || (editService && editService.image ? `/storage/${editService.image}` : '/uploads/no-image-available.png')" alt="preview" style="max-width: 100px; margin-top: 6px; cursor: pointer;" @error="mainImagePreviewUrl = ''" @click="viewImage([mainImagePreviewUrl || (editService && editService.image ? `/storage/${editService.image}` : '/uploads/no-image-available.png')], 0)"/>
          <el-button v-if="mainImagePreviewUrl || (editService && editService.image)" type="text" @click="removeMainImage()">[x]</el-button>
        </el-form-item>
        <el-form-item label="Banner">
          <input type="file" accept="image/*" @change="onFileChange($event, 'image_banner')" :key="bannerImageInputKey"/>
          <img v-if="bannerImagePreviewUrl" :src="bannerImagePreviewUrl" alt="preview" style="max-width: 100px; margin-top: 6px; cursor: pointer;" @error="bannerImagePreviewUrl = ''" @click="viewImage([bannerImagePreviewUrl], 0)"/>
          <el-button v-if="bannerImagePreviewUrl" type="text" @click="removeBannerImage()">[x]</el-button>
        </el-form-item>
        <el-form-item label="Slider (nhiều ảnh)">
          <input type="file" accept="image/*" multiple @change="onFileChange($event, 'image_slider')" :key="sliderInputKey"/>
          <el-button v-if="preview.image_slider.length > 0" type="text" @click="clearFile('image_slider_all')">Clear All</el-button>
          <div style="display: flex; gap: 6px; flex-wrap: wrap; margin-top: 6px;">
            <div v-for="(img, idx) in preview.image_slider" :key="idx" style="position: relative;">
                <img :src="img" alt="slider" style="max-width: 60px; border-radius: 4px; cursor: pointer;" @click="viewImage(preview.image_slider, idx)"/>
                <el-button type="text" @click="clearFile('image_slider', idx)" style="position: absolute; top: -10px; right: -10px; padding: 0; height: 20px; width: 20px; line-height: 20px; text-align: center; background: rgba(255, 255, 255, 0.8); border-radius: 50%;">x</el-button>
            </div>
          </div>
        </el-form-item>
      </el-form>
      <template #footer>
        <el-button @click="showDialog = false">Hủy</el-button>
        <el-button type="primary" :loading="saving" @click="saveService">Lưu</el-button>
      </template>
    </el-dialog>
    <el-image-viewer v-if="imageViewerVisible" :url-list="imageViewerUrlList" :initial-index="imageViewerInitialIndex" @close="imageViewerVisible = false" />
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import axios from 'axios'
import { ElMessage } from 'element-plus'
import { Ckeditor } from '@ckeditor/ckeditor5-vue'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import { ElImageViewer } from 'element-plus'
import { useImageUpload } from '../composables/useImageUpload'

const services = ref([])
const loading = ref(false)
const showDialog = ref(false)
const saving = ref(false)
const editService = ref(null)
const form = ref({ name: '', description: '', price: '', status: true })
const rules = {
  name: [{ required: true, message: 'Vui lòng nhập tên dịch vụ', trigger: 'blur' }],
  price: [{ type: 'number', min: 0, message: 'Giá phải >= 0', trigger: 'blur' }],
}
const search = ref('')

const currentPage = ref(1);
const pageSize = ref(10);
const totalServices = ref(0);

const preview = ref({ image_slider: [] })
const fileInputs = ref({ image_slider: [] })

const editorConfig = ref({
  // The configuration of the editor.
  // You can add more configuration options here.
  // Set the minimum height of the editing area.
  // The 'minHeight' property is often used for this.
  minHeight: '100px' // Adjust the height as needed
});

const imageViewerVisible = ref(false);
const imageViewerUrlList = ref([]);
const imageViewerInitialIndex = ref(0);

const sliderInputKey = ref(0);

// Use image upload composable for main image
const {
  imageFile: mainImageFile,
  imagePreviewUrl: mainImagePreviewUrl,
  imageInputKey: mainImageInputKey,
  handleImageChange: handleMainImageChange,
  removeImage: removeMainImage,
  getImageUrl: getMainImageUrl,
  appendImageToFormData: appendMainImageToFormData,
  resetImageState: resetMainImageState,
} = useImageUpload({
  maxSize: 2048,
  allowedTypes: ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'],
  storagePath: 'uploads/services',
});

// Use image upload composable for banner image
const {
  imageFile: bannerImageFile,
  imagePreviewUrl: bannerImagePreviewUrl,
  imageInputKey: bannerImageInputKey,
  handleImageChange: handleBannerImageChange,
  removeImage: removeBannerImage,
  getImageUrl: getBannerImageUrl,
  appendImageToFormData: appendBannerImageToFormData,
  resetImageState: resetBannerImageState,
} = useImageUpload({
  maxSize: 2048,
  allowedTypes: ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'],
  storagePath: 'uploads/services/banners',
});

function onFileChange(e, type) {
  if (type === 'image_slider') {
    fileInputs.value.image_slider = Array.from(e.target.files)
    preview.value.image_slider = fileInputs.value.image_slider.map(f => URL.createObjectURL(f))
  } else {
    const file = e.target.files[0]
    if (type === 'image') {
      mainImageFile.value = file
      mainImagePreviewUrl.value = file ? URL.createObjectURL(file) : ''
    } else if (type === 'image_banner') {
      bannerImageFile.value = file
      bannerImagePreviewUrl.value = file ? URL.createObjectURL(file) : ''
    }
  }
}

const fetchServices = async (options = {}) => {
  loading.value = true
  const page = options.page ?? currentPage.value;
  const currentSearch = options.search ?? search.value;
  try {
    const res = await axios.get('/api/services', {
      params: {
        page: page,
        per_page: pageSize.value,
        search: currentSearch,
      }
    })
    services.value = res.data.data
    totalServices.value = res.data.total
    currentPage.value = res.data.current_page; // Update currentPage based on response
  } catch (e) {
    ElMessage.error('Lỗi khi tải dữ liệu dịch vụ!')
    console.error(e)
  } finally {
    loading.value = false
  }
}

const filteredServices = computed(() => {
  // Filtering will now be handled by the backend API
  return services.value;
})

const openAdd = () => {
  editService.value = null
  form.value = { name: '', description: '', price: '', status: true }
  resetMainImageState();
  resetBannerImageState();
  fileInputs.value = { image_slider: [] }
  preview.value = { image_slider: [] }
  showDialog.value = true
}
const openEdit = (service) => {
  editService.value = service
  form.value = { name: service.name, description: service.description, price: service.price, status: !!service.status }
  resetMainImageState();
  resetBannerImageState();
  mainImagePreviewUrl.value = getMainImageUrl(service.image);
  bannerImagePreviewUrl.value = getBannerImageUrl(service.image_banner);
  fileInputs.value = { image_slider: [] }
  preview.value = {
    image_slider: Array.isArray(service.image_slider) ? service.image_slider.map(img => getMainImageUrl(img)) : []
  }
  showDialog.value = true
}
const saveService = async () => {
  if (!formRef.value) return;

  try {
    await formRef.value.validate();
    saving.value = true;

    const formData = new FormData();
    
    // Append main image
    appendMainImageToFormData(formData, 'image');
    
    // Append banner image
    appendBannerImageToFormData(formData, 'image_banner');

    // Append slider images
    if (fileInputs.value.image_slider.length > 0) {
      fileInputs.value.image_slider.forEach((file, index) => {
        formData.append(`image_slider[${index}]`, file);
      });
    }

    // Handle other fields
    for (const key in form.value) {
      if (key === 'status') {
        formData.append(key, form.value[key] ? 1 : 0);
      } else if (!['image', 'image_banner', 'image_slider'].includes(key)) {
        if (form.value[key] !== null && form.value[key] !== undefined) {
          formData.append(key, form.value[key]);
        }
      }
    }

    // Handle image removal
    if (editService.value) {
      if (!mainImageFile.value && !editService.value.image) {
        formData.append('remove_image', 1);
      }
      if (!bannerImageFile.value && !editService.value.image_banner) {
        formData.append('remove_image_banner', 1);
      }
      if (preview.value.image_slider.length === 0 && (!editService.value.image_slider || editService.value.image_slider.length === 0)) {
        formData.append('remove_image_slider', 1);
      }
    }

    let response;
    const apiUrl = editService.value
      ? `/services/${editService.value.id}`
      : '/services';

    if (editService.value) {
      formData.append('_method', 'PUT');
      response = await axios.post(apiUrl, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });
      ElMessage.success('Cập nhật dịch vụ thành công!');
    } else {
      response = await axios.post(apiUrl, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });
      ElMessage.success('Thêm dịch vụ thành công!');
    }

    showDialog.value = false;
    fetchServices();
  } catch (error) {
    console.error('Error saving service:', error);
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
      ElMessage.error('Lỗi khi lưu dịch vụ!');
    }
  } finally {
    saving.value = false;
  }
}
const removeService = async (id) => {
  try {
    await axios.delete(`/api/services/${id}`)
    ElMessage.success('Đã xóa dịch vụ!')
    fetchServices({ page: currentPage.value, search: search.value })
  } catch (e) {
    ElMessage.error('Không thể xóa dịch vụ!')
  }
}
const clearFile = (type, idx) => {
  if (type === 'image_slider') {
    preview.value.image_slider.splice(idx, 1)
    fileInputs.value.image_slider.splice(idx, 1);
    if (fileInputs.value.image_slider.length === 0) {
      sliderInputKey.value++;
    }
  } else if (type === 'image_slider_all') {
    fileInputs.value.image_slider = [];
    preview.value.image_slider = [];
    sliderInputKey.value++; // Reset the native input display
  } else {
    if (type === 'image') {
      mainImageFile.value = null;
      mainImagePreviewUrl.value = null;
      mainImageInputKey.value++;
    } else if (type === 'image_banner') {
      bannerImageFile.value = null;
      bannerImagePreviewUrl.value = null;
      bannerImageInputKey.value++;
    }
  }
}
const viewImage = (urlList, initialIndex = 0) => {
  console.log('Viewing image(s):', urlList, 'starting from index:', initialIndex);
  imageViewerUrlList.value = urlList;
  imageViewerInitialIndex.value = initialIndex;
  imageViewerVisible.value = true;
}

const handlePageChange = (newPage) => {
  fetchServices({ page: newPage, search: search.value });
};

onMounted(() => fetchServices({ page: 1 }));
</script>

<style scoped>
.services-page {
  padding: 16px;
}
.services-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}
.search-input {
  width: 260px;
}

/* Adjust line spacing within CKEditor */
.description-editor-item .ck-editor__editable p {
  margin-bottom: 0.5em; /* Adjust this value as needed */
}

.pagination-container {
  margin-top: 16px;
  display: flex;
  justify-content: flex-end;
}
</style> 