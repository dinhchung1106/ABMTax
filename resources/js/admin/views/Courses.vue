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
            <img v-if="row.image" :src="row.image" class="course-thumb" />
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
            <el-tag :type="row.status ? 'success' : 'info'">{{ row.status ? 'Hiện' : 'Ẩn' }}</el-tag>
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

    <el-dialog :title="editCourse ? 'Sửa Khóa học' : 'Thêm Khóa học'" v-model="showDialog" width="500px">
      <el-form :model="form" :rules="rules" ref="courseForm" label-width="110px">
        <el-form-item label="Tên khóa học" prop="name">
          <el-input v-model="form.name" />
        </el-form-item>
        <el-form-item label="Mô tả" prop="description">
          <el-input v-model="form.description" type="textarea" rows="2" />
        </el-form-item>
        <el-form-item label="Học phí" prop="fee">
          <el-input v-model.number="form.fee" type="number" min="0" />
        </el-form-item>
        <el-form-item label="Khai giảng" prop="start_date">
          <el-date-picker v-model="form.start_date" type="date" placeholder="Chọn ngày" format="YYYY-MM-DD" value-format="YYYY-MM-DD" />
        </el-form-item>
        <el-form-item label="Lịch học" prop="schedule">
          <el-input v-model="form.schedule" />
        </el-form-item>
        <el-form-item label="Ưu đãi" prop="discount_info">
          <el-input v-model="form.discount_info" />
        </el-form-item>
        <el-form-item label="Ảnh" prop="image">
          <el-upload
            class="course-upload"
            action="/api/news/upload-image"
            :show-file-list="false"
            :on-success="handleUploadSuccess"
            :before-upload="beforeUpload"
            :headers="uploadHeaders"
            accept="image/*"
          >
            <img v-if="form.image" :src="form.image" class="course-image-preview" />
            <el-button v-else size="small" type="primary">Chọn ảnh</el-button>
          </el-upload>
        </el-form-item>
        <el-form-item label="Trạng thái" prop="status">
          <el-switch v-model="form.status" active-text="Hiện" inactive-text="Ẩn" />
        </el-form-item>
      </el-form>
      <template #footer>
        <el-button @click="showDialog = false">Hủy</el-button>
        <el-button type="primary" :loading="saving" @click="saveCourse">Lưu</el-button>
      </template>
    </el-dialog>

    <course-lessons-dialog v-if="showLessonsDialog" :course="selectedCourse" @close="showLessonsDialog=false" />
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import axios from 'axios'
import { ElMessage, ElMessageBox } from 'element-plus'
import CourseLessonsDialog from '../components/CourseLessonsDialog.vue'
import { useImageUpload } from '../composables/useImageUpload'

const courses = ref([])
const loading = ref(false)
const showDialog = ref(false)
const saving = ref(false)
const editCourse = ref(null)
const form = ref({ name: '', description: '', fee: '', start_date: '', schedule: '', discount_info: '', image: '', status: true })
const rules = {
  name: [{ required: true, message: 'Vui lòng nhập tên khóa học', trigger: 'blur' }],
  fee: [{ type: 'number', min: 0, message: 'Học phí phải >= 0', trigger: 'blur' }],
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

// Use image upload composable for course image
const {
  imageFile: courseImageFile,
  imagePreviewUrl: courseImagePreviewUrl,
  imageInputKey: courseImageInputKey,
  handleImageChange: handleCourseImageChange,
  removeImage: removeCourseImage,
  getImageUrl: getCourseImageUrl,
  appendImageToFormData: appendCourseImageToFormData,
  resetImageState: resetCourseImageState,
} = useImageUpload({
  maxSize: 2048,
  allowedTypes: ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'],
  storagePath: 'uploads/courses',
});

const openAdd = () => {
  editCourse.value = null;
  form.value = { name: '', description: '', fee: '', start_date: '', schedule: '', discount_info: '', image: '', status: true };
  resetCourseImageState();
  showDialog.value = true;
};

const openEdit = (course) => {
  editCourse.value = course;
  form.value = { 
    name: course.name, 
    description: course.description, 
    fee: course.fee, 
    start_date: course.start_date, 
    schedule: course.schedule, 
    discount_info: course.discount_info, 
    status: !!course.status 
  };
  resetCourseImageState();
  courseImagePreviewUrl.value = getCourseImageUrl(course.image);
  showDialog.value = true;
};

const saveCourse = async () => {
  if (!formRef.value) return;

  try {
    await formRef.value.validate();
    saving.value = true;

    const formData = new FormData();
    
    // Append course image
    appendCourseImageToFormData(formData, 'image');

    // Append other fields
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
    if (editCourse.value) {
      if (!courseImageFile.value && !editCourse.value.image) {
        formData.append('remove_image', 1);
      }
    }

    let response;
    const apiUrl = editCourse.value
      ? `/courses/${editCourse.value.id}`
      : '/courses';

    if (editCourse.value) {
      formData.append('_method', 'PUT');
      response = await axios.post(apiUrl, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });
      ElMessage.success('Cập nhật khóa học thành công!');
    } else {
      response = await axios.post(apiUrl, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });
      ElMessage.success('Thêm khóa học thành công!');
    }

    showDialog.value = false;
    fetchCourses();
  } catch (error) {
    console.error('Error saving course:', error);
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
      ElMessage.error('Lỗi khi lưu khóa học!');
    }
  } finally {
    saving.value = false;
  }
};

const removeCourse = async (id) => {
  try {
    await axios.delete(`/api/courses/${id}`)
    ElMessage.success('Đã xóa khóa học!')
    fetchCourses({ page: currentPage.value, search: search.value })
  } catch (e) {
    ElMessage.error('Không thể xóa khóa học!')
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
const openLessons = (course) => {
  selectedCourse.value = course
  showLessonsDialog.value = true
}

const handlePageChange = (newPage) => {
  fetchCourses({ page: newPage, search: search.value });
};

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
</style> 