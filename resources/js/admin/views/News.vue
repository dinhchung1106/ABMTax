<template>
  <div class="news-page">
    <el-card>
      <div class="news-header">
        <el-input v-model="search" placeholder="Tìm kiếm tiêu đề..." clearable class="search-input" @input="fetchNews" />
        <el-button type="primary" @click="openAdd">Thêm Tin tức</el-button>
      </div>
      <el-table :data="filteredNews" style="width: 100%" v-loading="loading">
        <el-table-column prop="id" label="#" width="60" />
        <el-table-column prop="title" label="Tiêu đề" />
        <el-table-column prop="slug" label="Slug" />
        <el-table-column label="Ảnh" width="100">
          <template #default="{ row }">
            <img :src="row.image ? `/storage/${row.image}` : '/uploads/no-image-available.png'" alt="News Image" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px; cursor: pointer;" @click="viewImage([row.image ? `/storage/${row.image}` : '/uploads/no-image-available.png'], 0)" />
          </template>
        </el-table-column>
        <el-table-column prop="category_name" label="Danh mục" width="120" />
        <el-table-column prop="author_name" label="Tác giả" width="120" />
        <el-table-column prop="views" label="Lượt xem" width="100" />
        <el-table-column prop="status" label="Trạng thái" width="100">
          <template #default="{ row }">
            <el-tag :type="row.status ? 'success' : 'info'">{{ row.status ? 'Hiện' : 'Ẩn' }}</el-tag>
          </template>
        </el-table-column>
        <el-table-column label="Hành động" width="160">
          <template #default="{ row }">
            <el-button size="small" @click="openEdit(row)">Sửa</el-button>
            <el-popconfirm title="Xác nhận xóa tin tức này?" @confirm="removeNews(row.id)">
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

    <el-dialog
      v-model="showDialog"
      :title="editNews ? 'Chỉnh sửa tin tức' : 'Thêm tin tức mới'"
      width="50%"
      :close-on-click-modal="false"
      :close-on-press-escape="false"
      :show-close="false"
    >
      <el-form
        ref="newsForm"
        :model="form"
        :rules="rules"
        label-width="120px"
        class="news-form"
      >
        <el-form-item label="Tiêu đề" prop="title">
          <el-input v-model="form.title" />
        </el-form-item>
        <el-form-item label="Nội dung" prop="content" class="content-editor-item">
          <ckeditor :editor="ClassicEditor" v-model="form.content" :config="editorConfig"></ckeditor>
        </el-form-item>
        <el-form-item label="Danh mục" prop="category_id">
          <el-select v-model="form.category_id" placeholder="Chọn danh mục">
            <el-option
              v-for="category in categories"
              :key="category.id"
              :label="category.name"
              :value="category.id"
            />
          </el-select>
        </el-form-item>
        <el-form-item label="Tags" prop="tag_ids">
          <el-select
            v-model="form.tag_ids"
            multiple
            filterable
            allow-create
            default-first-option
            placeholder="Chọn hoặc tạo tags mới"
          >
            <el-option
              v-for="tag in tags"
              :key="tag.id"
              :label="tag.name"
              :value="tag.id"
            />
          </el-select>
        </el-form-item>
        <el-form-item label="SEO Keywords" prop="seo_keywords">
          <el-input v-model="form.seo_keywords" />
        </el-form-item>
        <el-form-item label="Lượt xem" prop="views">
          <el-input-number v-model="form.views" :min="0" :step="1" style="width: 100%;" />
        </el-form-item>
        <el-form-item label="Trạng thái" prop="status">
          <el-switch v-model="form.status" active-text="Hiện" inactive-text="Ẩn" />
        </el-form-item>

        <el-form-item label="Ảnh đại diện">
          <input type="file" accept="image/*" @change="onFileChange($event, 'image')" :key="mainImageInputKey"/>
          <img :src="mainImagePreviewUrl || (editNews && editNews.image ? `/storage/${editNews.image}` : '/uploads/no-image-available.png')" alt="preview" style="max-width: 100px; margin-top: 6px; cursor: pointer;" @error="mainImagePreviewUrl = ''" @click="viewImage([mainImagePreviewUrl || (editNews && editNews.image ? `/storage/${editNews.image}` : '/uploads/no-image-available.png')], 0)"/>
          <el-button v-if="mainImagePreviewUrl || (editNews && editNews.image)" type="text" @click="removeMainImage()">[x]</el-button>
        </el-form-item>
      </el-form>
      <template #footer>
        <el-button @click="showDialog = false">Hủy</el-button>
        <el-button type="primary" :loading="saving" @click="saveNews">Lưu</el-button>
      </template>
    </el-dialog>
    <el-image-viewer v-if="imageViewerVisible" :url-list="imageViewerUrlList" :initial-index="imageViewerInitialIndex" @close="imageViewerVisible = false" />
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import axios from 'axios'
import { ElMessage, ElMessageBox } from 'element-plus'
import { useImageUpload } from '../composables/useImageUpload'
import { Ckeditor } from '@ckeditor/ckeditor5-vue'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import { ElImageViewer } from 'element-plus'

const news = ref([])
const categories = ref([]);
const allTags = ref([]);
const loading = ref(false)
const showDialog = ref(false)
const saving = ref(false)
const editNews = ref(null)
const form = ref({ title: '', content: '', image: '', category_id: null, tag_ids: [], status: true, seo_keywords: '', views: 0 })
const newsForm = ref(null)
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

const editorConfig = ref({ minHeight: '200px' })

const openAdd = () => {
  editNews.value = null;
  form.value = { title: '', content: '', category_id: null, tag_ids: [], status: true, seo_keywords: '', views: 0 };
  resetNewsImageState();
  showDialog.value = true;
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
    status: !!newsItem.status,
    seo_keywords: newsItem.seo_keywords || '',
    views: newsItem.views || 0,
    image: newsItem.image || ''
  };
  resetNewsImageState();
  newsImagePreviewUrl.value = getNewsImageUrl(newsItem.image);
  showDialog.value = true;
};

const saveNews = async () => {
  if (!newsForm.value) {
    ElMessage.error('Form không tồn tại!');
    return;
  }

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
    } else if (editNews.value && editNews.value.image) {
      // Keep existing image
      formData.append('image', editNews.value.image);
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
      } else if (key !== 'image') { // Skip image field as it's handled separately
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

const handlePageChange = (newPage) => {
  fetchNews({ page: newPage, search: search.value });
};

const imageViewerVisible = ref(false);
const imageViewerUrlList = ref([]);
const imageViewerInitialIndex = ref(0);

const viewImage = (urlList, initialIndex = 0) => {
  console.log('Viewing image(s):', urlList, 'starting from index:', initialIndex);
  imageViewerUrlList.value = urlList;
  imageViewerInitialIndex.value = initialIndex;
  imageViewerVisible.value = true;
}

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

/* Adjust line spacing within CKEditor */
.content-editor-item .ck-editor__editable p {
  margin-bottom: 0.5em; /* Adjust this value as needed */
}

.news-image-preview {
  width: 178px;
  height: 178px;
  display: block;
  object-fit: cover;
}
</style> 