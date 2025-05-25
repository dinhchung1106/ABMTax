<template>
  <div class="courses-page">
    <el-card>
      <div class="courses-header">
        <el-input v-model="search" placeholder="Tìm kiếm tên khóa học..." clearable class="search-input" @input="fetchCourses" />
        <el-button type="primary" @click="openAdd">Thêm Khóa học</el-button>
      </div>
      <el-table :data="filteredCourses" style="width: 100%" v-loading="loading">
        <el-table-column prop="id" label="#" width="60" />
        <el-table-column prop="image" label="Ảnh" width="80">
          <template #default="{ row }">
            <img v-if="row.image_url" :src="row.image_url" class="course-thumb" />
            <span v-else>Không ảnh</span>
          </template>
        </el-table-column>
        <el-table-column prop="name" label="Tên khóa học" />
        <el-table-column prop="fee" label="Học phí" width="120">
          <template #default="{ row }">
            {{ row.fee ? Number(row.fee).toLocaleString() + ' đ' : '' }}
          </template>
        </el-table-column>
        <el-table-column prop="start_date" label="Khai giảng" width="120" />
        <el-table-column prop="status" label="Trạng thái" width="100">
          <template #default="{ row }">
            <el-tag :type="row.status === 1 ? 'success' : (row.status === 2 ? 'danger' : 'info')">
              {{ row.status === 1 ? 'Mở đăng ký' : (row.status === 2 ? 'Đã đóng' : 'Nháp') }}
            </el-tag>
          </template>
        </el-table-column>
        <el-table-column label="Hành động" width="220">
          <template #default="{ row }">
            <el-button size="small" @click="openEdit(row)">Sửa</el-button>
            <el-popconfirm title="Xác nhận xóa khóa học này?" @confirm="removeCourse(row.id)">
              <template #reference>
                <el-button size="small" type="danger">Xóa</el-button>
              </template>
            </el-popconfirm>
            <el-button size="small" type="info" @click="openLessons(row)">Bài học</el-button>
          </template>
        </el-table-column>
      </el-table>
      <div class="pagination-container">
        <el-pagination
          @current-change="handlePageChange"
          :current-page="currentPage"
          :page-size="pageSize"
          :total="totalCourses"
          layout="total, prev, pager, next"
          background
        />
      </div>
    </el-card>

    <el-dialog :title="editCourse ? 'Sửa Khóa học' : 'Thêm Khóa học'" v-model="showDialog" width="50%">
      <el-form :model="form" :rules="rules" ref="formRef" label-width="110px">
        <el-form-item label="Tên khóa học" prop="name">
          <el-input v-model="form.name" />
        </el-form-item>
        <el-form-item label="Mô tả" prop="description" class="description-editor-item">
          <ckeditor :editor="ClassicEditor" v-model="form.description" :config="editorConfig"></ckeditor>
        </el-form-item>
        <el-form-item label="Học phí" prop="fee">
          <el-input 
            v-model="form.fee" 
            type="number" 
            min="0" 
            step="1000"
            @input="form.fee = parseFloat($event.target.value) || 0"
          />
        </el-form-item>
        <el-form-item label="Khai giảng" prop="start_date">
          <el-date-picker v-model="form.start_date" type="date" placeholder="Chọn ngày" format="YYYY-MM-DD" value-format="YYYY-MM-DD" />
        </el-form-item>
        <el-form-item label="Lịch học" prop="schedule">
          <el-input v-model="form.schedule" />
        </el-form-item>
        <el-form-item label="Giảm giá" prop="discount_type">
          <el-select v-model="form.discount_type" placeholder="Chọn loại giảm giá" style="width: 120px; margin-right: 10px;">
            <el-option label="Số tiền" value="fixed" />
            <el-option label="Phần trăm" value="percentage" />
          </el-select>
          <el-input 
            v-model.number="form.discount_value" 
            type="number" 
            min="0" 
            style="width: 150px;" 
            :placeholder="form.discount_type === 'percentage' ? 'Nhập %' : 'Nhập số tiền'"
            :step="form.discount_type === 'percentage' ? 1 : 1000"
          />
        </el-form-item>
        <el-form-item label="Ảnh" prop="image">
          <input type="file" accept="image/*" @change="onFileChange($event, 'image')" :key="mainImageInputKey"/>
          <img :src="mainImagePreviewUrl || (editCourse && editCourse.image_url) || '/uploads/no-image-available.png'" 
               alt="preview" 
               style="max-width: 100px; margin-top: 6px; cursor: pointer;" 
               @error="mainImagePreviewUrl = ''" 
               @click="viewImage([mainImagePreviewUrl || (editCourse && editCourse.image_url) || '/uploads/no-image-available.png'], 0)"/>
          <el-button v-if="mainImagePreviewUrl || (editCourse && editCourse.image)" type="text" @click="removeMainImage()">[x]</el-button>
        </el-form-item>
        <el-form-item label="Trạng thái" prop="status">
          <el-select v-model="form.status" placeholder="Chọn trạng thái">
            <el-option :value="1" label="Mở đăng ký" />
            <el-option :value="2" label="Đã đóng" />
            <el-option :value="3" label="Nháp" />
          </el-select>
        </el-form-item>
      </el-form>
      <template #footer>
        <el-button @click="showDialog = false">Hủy</el-button>
        <el-button type="primary" :loading="saving" @click="saveCourse">Lưu</el-button>
      </template>
    </el-dialog>

    <course-sessions-dialog v-if="showLessonsDialog" :course="selectedCourse" @close="showLessonsDialog=false" />
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import axios from 'axios'
import { ElMessage, ElMessageBox } from 'element-plus'
import CourseSessionsDialog from '../components/CourseSessionsDialog.vue'
import { useImageUpload } from '../composables/useImageUpload'
import { Ckeditor } from '@ckeditor/ckeditor5-vue'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import { ElImageViewer } from 'element-plus'

// Add Course status constants
const CourseStatus = {
    STATUS_OPEN: 1,
    STATUS_CLOSED: 2,
    STATUS_DRAFT: 3
}

const courses = ref([])
const loading = ref(false)
const showDialog = ref(false)
const saving = ref(false)
const editCourse = ref(null)
const formRef = ref(null)
const form = ref({
    name: '',
    description: '',
    fee: '',
    start_date: '',
    schedule: '',
    discount_type: 'fixed',
    discount_value: '',
    image: '',
    status: CourseStatus.STATUS_OPEN
})
const rules = {
  name: [{ required: true, message: 'Vui lòng nhập tên khóa học', trigger: 'blur' }],
  fee: [
    { required: true, message: 'Vui lòng nhập học phí', trigger: 'blur' },
    { 
      validator: (rule, value, callback) => {
        if (value === '' || value === null) {
          callback();
          return;
        }
        const num = parseFloat(value);
        if (isNaN(num) || num < 0) {
          callback(new Error('Học phí phải >= 0'));
        } else {
          callback();
        }
      },
      trigger: 'blur'
    }
  ],
  discount_value: [
    { 
      validator: (rule, value, callback) => {
        if (value === '' || value === null) {
          callback();
          return;
        }
        const num = parseFloat(value);
        if (isNaN(num) || num < 0) {
          callback(new Error('Giá trị giảm giá phải >= 0'));
        } else {
          callback();
        }
      },
      trigger: 'blur'
    }
  ]
}
const search = ref('')
const showLessonsDialog = ref(false)
const selectedCourse = ref(null)

const currentPage = ref(1);
const pageSize = ref(10);
const totalCourses = ref(0);

const uploadHeaders = computed(() => {
  if (typeof window !== 'undefined' && window.localStorage) {
    const token = localStorage.getItem('token')
    return token ? { Authorization: 'Bearer ' + token } : {}
  }
  return {}
})

const fetchCourses = async (options = {}) => {
  loading.value = true
  const page = options.page ?? currentPage.value;
  const currentSearch = options.search ?? search.value;
  try {
    const res = await axios.get('/api/courses', {
      params: {
        page: page,
        per_page: pageSize.value,
        search: currentSearch,
      }
    })
    courses.value = res.data.data
    totalCourses.value = res.data.total
    currentPage.value = res.data.current_page;
  } catch (e) {
    ElMessage.error('Lỗi khi tải dữ liệu khóa học!')
    console.error(e)
  } finally {
    loading.value = false
  }
}

const filteredCourses = computed(() => {
  // Filtering will now be handled by the backend API
  return courses.value;
})

const {
  imageFile: mainImageFile,
  imagePreviewUrl: mainImagePreviewUrl,
  imageInputKey: mainImageInputKey,
  handleImageChange: onFileChange,
  removeImage: removeMainImage,
  getImageUrl: getMainImageUrl,
  appendImageToFormData: appendMainImageToFormData,
  resetImageState: resetMainImageState,
} = useImageUpload({
  maxSize: 4096, // 4MB
  allowedTypes: ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'],
  storagePath: 'uploads/courses',
});

const openAdd = () => {
  editCourse.value = null;
  form.value = { 
    name: '', 
    description: '', 
    fee: '', 
    start_date: '', 
    schedule: '', 
    discount_value: '',
    discount_type: '',
    image: '', 
    status: CourseStatus.STATUS_OPEN 
  };
  resetMainImageState();
  showDialog.value = true;
};

const openEdit = (course) => {
  editCourse.value = course;
  form.value = { 
    name: course.name || '', 
    description: course.description || '', 
    fee: course.fee || '', 
    start_date: course.start_date || '', 
    schedule: course.schedule || '', 
    discount_value: course.discount_value || '',
    discount_type: course.discount_type || '',
    status: course.status || CourseStatus.STATUS_OPEN,
    image: course.image || ''
  };
  resetMainImageState();
  mainImagePreviewUrl.value = course.image_url || '';
  showDialog.value = true;
};

const saveCourse = async () => {
    if (!formRef.value) return
    
    await formRef.value.validate(async (valid) => {
        if (valid) {
            try {
                saving.value = true;
                const formData = new FormData()
                
                // Debug log
                console.log('Form data before sending:', form.value)
                
                // Add all form fields to FormData
                Object.keys(form.value).forEach(key => {
                    if (form.value[key] !== null && form.value[key] !== undefined) {
                        if (key === 'image' && mainImageFile.value) {
                            formData.append(key, mainImageFile.value)
                            console.log('Adding image file:', mainImageFile.value)
                        } else {
                            formData.append(key, form.value[key])
                            console.log(`Adding field ${key}:`, form.value[key])
                        }
                    }
                })

                // Debug log for FormData
                for (let pair of formData.entries()) {
                    console.log(pair[0] + ': ' + pair[1])
                }

                let response;
                if (editCourse.value) {
                    // For PUT request, we need to use _method=PUT
                    formData.append('_method', 'PUT')
                    response = await axios.post(`/api/courses/${editCourse.value.id}`, formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'Accept': 'application/json'
                        }
                    })
                } else {
                    response = await axios.post('/api/courses', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'Accept': 'application/json'
                        }
                    })
                }
                
                ElMessage.success('Lưu khóa học thành công')
                showDialog.value = false
                fetchCourses()
            } catch (error) {
                console.error('Error saving course:', error)
                if (error.response?.data?.message) {
                    ElMessage.error(error.response.data.message)
                } else {
                    ElMessage.error('Có lỗi xảy ra khi lưu khóa học')
                }
            } finally {
                saving.value = false
            }
        }
    })
}

const removeCourse = async (id) => {
  try {
    await axios.delete(`/api/courses/${id}`)
    ElMessage.success('Đã xóa khóa học!')
    fetchCourses({ page: currentPage.value, search: search.value })
  } catch (e) {
    ElMessage.error('Không thể xóa khóa học!')
  }
}

const openLessons = (course) => {
  if (!course || !course.id) {
    ElMessage.error('Không tìm thấy thông tin khóa học')
    return
  }
  console.log('Opening lessons for course:', course)
  selectedCourse.value = course
  showLessonsDialog.value = true
}

const handlePageChange = (newPage) => {
  fetchCourses({ page: newPage, search: search.value });
};

const editorConfig = ref({ minHeight: '200px' })

onMounted(() => fetchCourses({ page: 1 }));
</script>

<style scoped>
.courses-page {
  padding: 16px;
}
.courses-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}
.search-input {
  width: 260px;
}
.course-thumb {
  width: 48px;
  height: 48px;
  object-fit: cover;
  border-radius: 6px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}
.course-image-preview {
  width: 100px;
  height: 100px;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 8px;
}
.pagination-container {
  margin-top: 16px;
  display: flex;
  justify-content: flex-end;
}
/* Adjust line spacing within CKEditor */
.description-editor-item .ck-editor__editable p {
  margin-bottom: 0.5em; /* Adjust this value as needed */
}
</style> 