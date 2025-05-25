<template>
  <el-dialog :title="'Quản lý buổi học - ' + course.name" v-model="show" width="900px" @close="$emit('close')">
    <div class="sessions-container">
      <!-- Sessions List -->
      <div class="sessions-list">
        <div class="sessions-header">
          <h3>Danh sách buổi học</h3>
          <el-button type="primary" @click="openAddSession">Thêm buổi học</el-button>
        </div>
        
        <el-table :data="sessions" style="width:100%" v-loading="loading" row-key="id">
          <el-table-column prop="order" label="#" width="60" />
          <el-table-column prop="title" label="Tên buổi học" />
          <el-table-column prop="date" label="Ngày học" width="120">
            <template #default="{ row }">
              {{ formatDate(row.date) }}
            </template>
          </el-table-column>
          <el-table-column label="Hành động" width="200">
            <template #default="{ row }">
              <el-button size="small" @click="openEditSession(row)">Sửa</el-button>
              <el-button size="small" type="danger" @click="removeSession(row.id)">Xóa</el-button>
              <el-button size="small" type="info" @click="selectSession(row)">Xem bài học</el-button>
            </template>
          </el-table-column>
        </el-table>
      </div>

      <!-- Lessons List -->
      <div class="lessons-list" v-if="selectedSession">
        <div class="lessons-header">
          <h3>Bài học - {{ selectedSession.title }}</h3>
          <el-button type="primary" @click="openAddLesson">Thêm bài học</el-button>
        </div>

        <el-table :data="lessons" style="width:100%" v-loading="lessonsLoading" row-key="id">
          <el-table-column prop="order" label="#" width="60" />
          <el-table-column prop="title" label="Tên bài học" />
          <el-table-column prop="duration" label="Thời lượng (phút)" width="120" />
          <el-table-column prop="description" label="Mô tả" show-overflow-tooltip />
          <el-table-column label="Hành động" width="160">
            <template #default="{ row }">
              <el-button size="small" @click="openEditLesson(row)">Sửa</el-button>
              <el-button size="small" type="danger" @click="removeLesson(row.id)">Xóa</el-button>
            </template>
          </el-table-column>
        </el-table>
      </div>
    </div>

    <!-- Session Form Dialog -->
    <el-dialog :title="editSession ? 'Sửa buổi học' : 'Thêm buổi học'" v-model="showSessionForm" width="500px" append-to-body>
      <el-form :model="sessionForm" :rules="sessionRules" ref="sessionFormRef" label-width="110px">
        <el-form-item label="Tên buổi học" prop="title">
          <el-input v-model="sessionForm.title" />
        </el-form-item>
        <el-form-item label="Ngày học" prop="date">
          <el-date-picker v-model="sessionForm.date" type="date" placeholder="Chọn ngày" format="YYYY-MM-DD" value-format="YYYY-MM-DD" />
        </el-form-item>
        <el-form-item label="Thứ tự" prop="order">
          <el-input-number v-model="sessionForm.order" :min="1" />
        </el-form-item>
      </el-form>
      <template #footer>
        <el-button @click="showSessionForm = false">Hủy</el-button>
        <el-button type="primary" @click="saveSession">Lưu</el-button>
      </template>
    </el-dialog>

    <!-- Lesson Form Dialog -->
    <el-dialog :title="editLesson ? 'Sửa bài học' : 'Thêm bài học'" v-model="showLessonForm" width="500px" append-to-body>
      <el-form :model="lessonForm" :rules="lessonRules" ref="lessonFormRef" label-width="110px">
        <el-form-item label="Tên bài học" prop="title">
          <el-input v-model="lessonForm.title" />
        </el-form-item>
        <el-form-item label="Mô tả" prop="description">
          <el-input v-model="lessonForm.description" type="textarea" rows="3" />
        </el-form-item>
        <el-form-item label="Thời lượng" prop="duration">
          <el-input-number v-model="lessonForm.duration" :min="1" :step="5" />
        </el-form-item>
        <el-form-item label="Thứ tự" prop="order">
          <el-input-number v-model="lessonForm.order" :min="1" />
        </el-form-item>
      </el-form>
      <template #footer>
        <el-button @click="showLessonForm = false">Hủy</el-button>
        <el-button type="primary" @click="saveLesson">Lưu</el-button>
      </template>
    </el-dialog>
  </el-dialog>
</template>

<script setup>
import { ref, reactive, onMounted, watch } from 'vue'
import axios from 'axios'
import { ElMessage } from 'element-plus'

const props = defineProps({
  course: {
    type: Object,
    required: true,
    validator: (value) => {
      return value && value.id
    }
  }
})

const emit = defineEmits(['close'])

// State
const show = ref(true)
const loading = ref(false)
const lessonsLoading = ref(false)
const sessions = ref([])
const lessons = ref([])
const selectedSession = ref(null)

// Session Form
const showSessionForm = ref(false)
const editSession = ref(null)
const sessionFormRef = ref(null)
const sessionForm = reactive({
  title: '',
  date: '',
  order: 1
})

// Lesson Form
const showLessonForm = ref(false)
const editLesson = ref(null)
const lessonFormRef = ref(null)
const lessonForm = reactive({
  title: '',
  description: '',
  duration: 30,
  order: 1
})

// Validation Rules
const sessionRules = {
  title: [{ required: true, message: 'Vui lòng nhập tên buổi học', trigger: 'blur' }],
  date: [{ required: true, message: 'Vui lòng chọn ngày học', trigger: 'change' }],
  order: [{ required: true, message: 'Vui lòng nhập thứ tự', trigger: 'blur' }]
}

const lessonRules = {
  title: [{ required: true, message: 'Vui lòng nhập tên bài học', trigger: 'blur' }],
  duration: [{ required: true, message: 'Vui lòng nhập thời lượng', trigger: 'blur' }],
  order: [{ required: true, message: 'Vui lòng nhập thứ tự', trigger: 'blur' }]
}

// Methods
const formatDate = (date) => {
  return new Date(date).toLocaleDateString('vi-VN')
}

const fetchSessions = async () => {
  if (!props.course || !props.course.id) {
    ElMessage.error('Không tìm thấy thông tin khóa học')
    return
  }

  loading.value = true
  try {
    console.log('Fetching sessions for course:', props.course.id)
    const res = await axios.get(`/api/courses/${props.course.id}/sessions`)
    sessions.value = res.data
  } catch (error) {
    console.error('Error fetching sessions:', error)
    if (error.response?.status === 404) {
      ElMessage.error('Không tìm thấy khóa học')
    } else {
      ElMessage.error(error.response?.data?.message || 'Lỗi khi tải danh sách buổi học')
    }
  } finally {
    loading.value = false
  }
}

const fetchLessons = async (sessionId) => {
  if (!sessionId) return
  lessonsLoading.value = true
  try {
    const res = await axios.get(`/api/sessions/${sessionId}/lessons`)
    lessons.value = res.data
  } catch (error) {
    ElMessage.error('Lỗi khi tải danh sách bài học')
  } finally {
    lessonsLoading.value = false
  }
}

const selectSession = (session) => {
  selectedSession.value = session
  fetchLessons(session.id)
}

// Session CRUD
const openAddSession = () => {
  editSession.value = null
  Object.assign(sessionForm, {
    title: '',
    date: '',
    order: sessions.value.length + 1
  })
  showSessionForm.value = true
}

const openEditSession = (session) => {
  editSession.value = session
  Object.assign(sessionForm, { ...session })
  showSessionForm.value = true
}

const saveSession = async () => {
  if (!sessionFormRef.value) return
  
  await sessionFormRef.value.validate(async (valid) => {
    if (valid) {
      try {
        const data = {
          ...sessionForm,
          course_id: props.course.id
        }
        
        if (editSession.value) {
          await axios.put(`/api/sessions/${editSession.value.id}`, data)
        } else {
          await axios.post(`/api/courses/${props.course.id}/sessions`, data)
        }
        showSessionForm.value = false
        fetchSessions()
        ElMessage.success('Lưu buổi học thành công')
      } catch (error) {
        console.error('Error saving session:', error)
        ElMessage.error(error.response?.data?.message || 'Lỗi khi lưu buổi học')
      }
    }
  })
}

const removeSession = async (id) => {
  try {
    await axios.delete(`/api/sessions/${id}`)
    fetchSessions()
    if (selectedSession.value?.id === id) {
      selectedSession.value = null
      lessons.value = []
    }
    ElMessage.success('Xóa buổi học thành công')
  } catch (error) {
    ElMessage.error('Lỗi khi xóa buổi học')
  }
}

// Lesson CRUD
const openAddLesson = () => {
  if (!selectedSession.value) return
  editLesson.value = null
  Object.assign(lessonForm, {
    title: '',
    description: '',
    duration: 30,
    order: lessons.value.length + 1
  })
  showLessonForm.value = true
}

const openEditLesson = (lesson) => {
  editLesson.value = lesson
  Object.assign(lessonForm, { ...lesson })
  showLessonForm.value = true
}

const saveLesson = async () => {
  if (!lessonFormRef.value || !selectedSession.value) return
  
  await lessonFormRef.value.validate(async (valid) => {
    if (valid) {
      try {
        const data = {
          ...lessonForm,
          session_id: selectedSession.value.id,
          course_id: props.course.id
        }
        
        if (editLesson.value) {
          await axios.put(`/api/lessons/${editLesson.value.id}`, data)
        } else {
          await axios.post(`/api/sessions/${selectedSession.value.id}/lessons`, data)
        }
        showLessonForm.value = false
        fetchLessons(selectedSession.value.id)
        ElMessage.success('Lưu bài học thành công')
      } catch (error) {
        ElMessage.error('Lỗi khi lưu bài học')
      }
    }
  })
}

const removeLesson = async (id) => {
  try {
    await axios.delete(`/api/lessons/${id}`)
    fetchLessons(selectedSession.value.id)
    ElMessage.success('Xóa bài học thành công')
  } catch (error) {
    ElMessage.error('Lỗi khi xóa bài học')
  }
}

// Lifecycle
onMounted(fetchSessions)
</script>

<style scoped>
.sessions-container {
  display: flex;
  gap: 20px;
}

.sessions-list {
  flex: 1;
  min-width: 400px;
}

.lessons-list {
  flex: 1;
  min-width: 400px;
  border-left: 1px solid #eee;
  padding-left: 20px;
}

.sessions-header,
.lessons-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}

h3 {
  margin: 0;
  font-size: 16px;
  font-weight: 600;
}
</style> 