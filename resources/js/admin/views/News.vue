<template>
  <div class="news-page">
    <el-card>
      <div class="news-header">
        <el-input v-model="search" placeholder="Tìm kiếm tiêu đề..." clearable class="search-input" @input="fetchNews" />
        <el-button type="primary" @click="openAdd">Thêm Tin tức</el-button>
      </div>
      <el-table :data="filteredNews" style="width: 100%" v-loading="loading">
        <el-table-column prop="id" label="#" width="60" />
        <el-table-column prop="image" label="Ảnh" width="80">
          <template #default="{ row }">
            <img v-if="row.image" :src="row.image" class="news-thumb" />
          </template>
        </el-table-column>
        <el-table-column prop="title" label="Tiêu đề" />
        <el-table-column label="Tác giả" width="120">
          <template #default="{ row }">
            {{ row.author_name || 'N/A' }}
          </template>
        </el-table-column>
        <el-table-column label="Chuyên mục" width="120">
          <template #default="{ row }">
            {{ row.category_name }}
          </template>
        </el-table-column>
        <el-table-column label="Thẻ (Tags)" width="150">
          <template #default="{ row }">
            <el-tag v-for="tag in row.tags" :key="tag.id" size="small" style="margin-right: 4px; margin-bottom: 4px;">{{ tag.name }}</el-tag>
          </template>
        </el-table-column>
        <el-table-column prop="views" label="Lượt xem" width="100" />
        <el-table-column prop="status" label="Trạng thái" width="100">
          <template #default="{ row }">
            <el-tag :type="row.status ? 'success' : 'info'">{{ row.status ? 'Hiện' : 'Ẩn' }}</el-tag>
          </template>
        </el-table-column>
        <el-table-column label="Hành động" width="160">
          <template #default="{ row }">
            <el-button size="small" @click="openEdit(row)">Sửa</el-button>
            <el-popconfirm title="Xác nhận xóa tin này?" @confirm="removeNews(row.id)">
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
          :total="totalNews"
          layout="total, prev, pager, next"
          background
        />
      </div>
    </el-card>

    <el-dialog :title="editNews ? 'Sửa Tin tức' : 'Thêm Tin tức'" v-model="showDialog" width="500px">
      <el-form :model="form" :rules="rules" ref="newsForm" label-width="100px">
        <el-form-item label="Tiêu đề" prop="title">
          <el-input v-model="form.title" />
        </el-form-item>
        <el-form-item label="Chuyên mục" prop="category_id">
          <el-select v-model="form.category_id">
            <el-option v-for="category in categories" :key="category.id" :label="category.name" :value="category.id" />
          </el-select>
        </el-form-item>
        <el-form-item label="Thẻ (Tags)" prop="tag_ids">
          <el-select v-model="form.tag_ids" multiple placeholder="Chọn thẻ">
            <el-option v-for="tag in allTags" :key="tag.id" :label="tag.name" :value="tag.id" />
          </el-select>
        </el-form-item>
        <el-form-item label="Ảnh" prop="image">
          <el-upload
            class="news-upload"
            action="/api/news/upload-image"
            :show-file-list="false"
            :on-success="handleUploadSuccess"
            :before-upload="beforeUpload"
            :headers="uploadHeaders"
            accept="image/*"
          >
            <img v-if="form.image" :src="form.image" class="news-image-preview" />
            <el-button v-else size="small" type="primary">Chọn ảnh</el-button>
          </el-upload>
        </el-form-item>
        <el-form-item label="Nội dung" prop="content">
          <el-input v-model="form.content" type="textarea" rows="4" />
        </el-form-item>
        <el-form-item label="Trạng thái" prop="status">
          <el-switch v-model="form.status" active-text="Hiện" inactive-text="Ẩn" />
        </el-form-item>
      </el-form>
      <template #footer>
        <el-button @click="showDialog = false">Hủy</el-button>
        <el-button type="primary" :loading="saving" @click="saveNews">Lưu</el-button>
      </template>
    </el-dialog>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import axios from 'axios'
import { ElMessage, ElMessageBox } from 'element-plus'
import { useImageUpload } from '../composables/useImageUpload'

const news = ref([])
const categories = ref([]);
const allTags = ref([]);
const loading = ref(false)
const showDialog = ref(false)
const saving = ref(false)
const editNews = ref(null)
const form = ref({ title: '', content: '', image: '', category_id: null, tag_ids: [], status: true })
const rules = {
  title: [{ required: true, message: 'Vui lòng nhập tiêu đề', trigger: 'blur' }],
  content: [{ required: true, message: 'Vui lòng nhập nội dung', trigger: 'blur' }],
  category_id: [{ required: true, message: 'Vui lòng chọn chuyên mục', trigger: 'change' }],
}
const search = ref('')

const currentPage = ref(1);
const pageSize = ref(10);
const totalNews = ref(0);

const uploadHeaders = computed(() => {
  if (typeof window !== 'undefined' && window.localStorage) {
    const token = localStorage.getItem('token')
    return token ? { Authorization: 'Bearer ' + token } : {}
  }
  return {}
})

const fetchNews = async (options = {}) => {
  loading.value = true
  const page = options.page ?? currentPage.value;
  const currentSearch = options.search ?? search.value;
  try {
    const res = await axios.get('/api/news', {
      params: {
        page: page,
        per_page: pageSize.value,
        search: currentSearch,
      }
    })
    news.value = res.data.data
    totalNews.value = res.data.total
    currentPage.value = res.data.current_page;
  } catch (e) {
    ElMessage.error('Lỗi khi tải dữ liệu tin tức!')
    console.error(e)
  } finally {
    loading.value = false
  }
}

const fetchCategories = async () => {
  try {
    const response = await axios.get('/api/categories');
    categories.value = response.data;
  } catch (error) {
    ElMessage.error('Lỗi khi tải danh sách danh mục!');
    console.error(error);
  }
};

const fetchAllTags = async () => {
  try {
    const response = await axios.get('/api/tags');
    allTags.value = response.data;
  } catch (error) {
    ElMessage.error('Lỗi khi tải danh sách thẻ (tags)!');
    console.error(error);
  }
};

const filteredNews = computed(() => {
  if (!search.value) return news.value
  return news.value.filter(n =>
    n.title.toLowerCase().includes(search.value.toLowerCase())
  )
})

// Use image upload composable for news image
const {
  imageFile: newsImageFile,
  imagePreviewUrl: newsImagePreviewUrl,
  imageInputKey: newsImageInputKey,
  handleImageChange: handleNewsImageChange,
  removeImage: removeNewsImage,
  getImageUrl: getNewsImageUrl,
  appendImageToFormData: appendNewsImageToFormData,
  resetImageState: resetNewsImageState,
} = useImageUpload({
  maxSize: 2048,
  allowedTypes: ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'],
  storagePath: 'uploads/news',
});

const openAdd = () => {
  editNews.value = null;
  form.value = { title: '', content: '', category_id: null, tag_ids: [], status: true };
  resetNewsImageState();
  showDialog.value = true;
  // Set default category for new news items
  if (categories.value.length > 0) {
    form.value.category_id = categories.value[0].id;
  }
};

const openEdit = (newsItem) => {
  editNews.value = newsItem;
  form.value = { 
    title: newsItem.title, 
    content: newsItem.content, 
    category_id: newsItem.category_id,
    tag_ids: newsItem.tags ? newsItem.tags.map(tag => tag.id) : [],
    status: !!newsItem.status 
  };
  resetNewsImageState();
  newsImagePreviewUrl.value = getNewsImageUrl(newsItem.image);
  showDialog.value = true;
};

const saveNews = async () => {
  if (!newsForm.value) return;

  try {
    await newsForm.value.validate();
    saving.value = true;

    const formData = new FormData();
    
    // Append news image (if a new file is selected)
    if (newsImageFile.value) {
      formData.append('image', newsImageFile.value);
    } else if (editNews.value && editNews.value.image && !newsImagePreviewUrl.value) {
      // Case: Image was present, but is now removed
      formData.append('remove_image', 1);
    }

    // Append other fields
    for (const key in form.value) {
      if (key === 'status') {
        formData.append(key, form.value[key] ? 1 : 0);
      } else if (key === 'category_id') {
        if (form.value[key] !== null) {
          formData.append(key, form.value[key]);
        }
      } else if (key === 'tag_ids') {
        if (form.value[key] && form.value[key].length > 0) {
          form.value[key].forEach(tagId => {
            formData.append('tag_ids[]', tagId);
          });
        }
      } else if (key !== 'image') {
        if (form.value[key] !== null && form.value[key] !== undefined) {
          formData.append(key, form.value[key]);
        }
      }
    }

    let response;
    const apiUrl = editNews.value
      ? `/api/news/${editNews.value.id}`
      : '/api/news';

    if (editNews.value) {
      formData.append('_method', 'PUT');
      response = await axios.post(apiUrl, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
          'Authorization': `Bearer ${localStorage.getItem('token')}`
        },
      });
      ElMessage.success('Cập nhật tin tức thành công!');
    } else {
      response = await axios.post(apiUrl, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
          'Authorization': `Bearer ${localStorage.getItem('token')}`
        },
      });
      ElMessage.success('Thêm tin tức thành công!');
    }

    showDialog.value = false;
    fetchNews();
  } catch (error) {
    console.error('Error saving news:', error);
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
      ElMessage.error('Lỗi khi lưu tin tức!');
    }
  } finally {
    saving.value = false;
  }
};

const removeNews = async (id) => {
  try {
    await axios.delete(`/api/news/${id}`)
    ElMessage.success('Đã xóa tin!')
    fetchNews()
  } catch (e) {
    ElMessage.error('Không thể xóa tin!')
  }
}
const handleUploadSuccess = (res) => {
  form.value.image = res.url
}
const beforeUpload = (file) => {
  const isImage = file.type.startsWith('image/')
  const isLt2M = file.size / 1024 / 1024 < 2
  if (!isImage) ElMessage.error('Chỉ chọn file ảnh!')
  if (!isLt2M) ElMessage.error('Ảnh phải nhỏ hơn 2MB!')
  return isImage && isLt2M
}

const handlePageChange = (newPage) => {
  fetchNews({ page: newPage, search: search.value });
};

onMounted(() => {
  fetchNews();
  fetchCategories();
  fetchAllTags();
});
</script>

<style scoped>
.news-page {
  padding: 16px;
}
.news-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}
.search-input {
  width: 260px;
}
.news-image-preview {
  width: 100px;
  height: 100px;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 8px;
}
.news-thumb {
  width: 48px;
  height: 48px;
  object-fit: cover;
  border-radius: 6px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}
.pagination-container {
  margin-top: 16px;
  display: flex;
  justify-content: flex-end;
}
.news-upload .el-upload {
  border: 1px dashed var(--el-border-color);
  border-radius: 6px;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  transition: var(--el-transition-duration-fast);
}

.news-upload .el-upload:hover {
  border-color: var(--el-color-primary);
}

.el-icon.news-uploader-icon {
  font-size: 28px;
  color: #8c939d;
  width: 178px;
  height: 178px;
  text-align: center;
}

.news-image-preview {
  width: 178px;
  height: 178px;
  display: block;
  object-fit: cover;
}
</style> 