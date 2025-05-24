<template>
  <el-dialog :title="'Bài học - ' + course.name" v-model="show" width="700px" @close="$emit('close')">
    <el-button type="primary" @click="openAddLesson" style="margin-bottom:12px">Thêm bài học</el-button>
    <el-table :data="lessons" style="width:100%" v-loading="loading" row-key="id">
      <el-table-column prop="order" label="#" width="50" />
      <el-table-column prop="name" label="Tên bài học" />
      <el-table-column prop="duration" label="Thời lượng (phút)" width="120" />
      <el-table-column prop="status" label="Trạng thái" width="100">
        <template #default="{ row }">
          <el-tag :type="row.status ? 'success' : 'info'">{{ row.status ? 'Hiện' : 'Ẩn' }}</el-tag>
        </template>
      </el-table-column>
      <el-table-column label="Hành động" width="160">
        <template #default="{ row }">
          <el-button size="small" @click="openEditLesson(row)">Sửa</el-button>
          <el-popconfirm title="Xóa bài học này?" @confirm="removeLesson(row.id)">
            <template #reference>
              <el-button size="small" type="danger">Xóa</el-button>
            </template>
          </el-popconfirm>
        </template>
      </el-table-column>
    </el-table>
    <el-dialog :title="editLesson ? 'Sửa bài học' : 'Thêm bài học'" v-model="showForm" width="400px" append-to-body>
      <el-form :model="lessonForm" :rules="lessonRules" label-width="110px">
        <el-form-item label="Tên bài học" prop="name">
          <el-input v-model="lessonForm.name" />
        </el-form-item>
        <el-form-item label="Mô tả" prop="description">
          <el-input v-model="lessonForm.description" type="textarea" rows="2" />
        </el-form-item>
        <el-form-item label="Thời lượng" prop="duration">
          <el-input v-model.number="lessonForm.duration" type="number" min="1" />
        </el-form-item>
        <el-form-item label="Trạng thái" prop="status">
          <el-switch v-model="lessonForm.status" active-text="Hiện" inactive-text="Ẩn" />
        </el-form-item>
      </el-form>
      <template #footer>
        <el-button @click="showForm=false">Hủy</el-button>
        <el-button type="primary" @click="saveLesson">Lưu</el-button>
      </template>
    </el-dialog>
    <template #footer>
      <el-button @click="$emit('close')">Đóng</el-button>
    </template>
  </el-dialog>
</template>

<script>
import { ref, reactive, onMounted, watch } from 'vue'
import axios from 'axios'
export default {
  name: 'CourseLessonsDialog',
  props: ['course'],
  emits: ['close'],
  setup(props, { emit }) {
    const show = ref(true)
    const lessons = ref([])
    const loading = ref(false)
    const showForm = ref(false)
    const editLesson = ref(null)
    const lessonForm = reactive({ name: '', description: '', duration: '', order: 0, status: true })
    const lessonRules = {
      name: [{ required: true, message: 'Nhập tên bài học', trigger: 'blur' }],
      duration: [{ type: 'number', min: 1, message: 'Thời lượng > 0', trigger: 'blur' }],
    }
    const fetchLessons = async () => {
      loading.value = true
      const res = await axios.get(`/api/courses/${props.course.id}/lessons`)
      lessons.value = res.data
      loading.value = false
    }
    const openAddLesson = () => {
      editLesson.value = null
      Object.assign(lessonForm, { name: '', description: '', duration: '', order: lessons.value.length+1, status: true })
      showForm.value = true
    }
    const openEditLesson = (lesson) => {
      editLesson.value = lesson
      Object.assign(lessonForm, { ...lesson })
      showForm.value = true
    }
    const saveLesson = async () => {
      if (editLesson.value) {
        await axios.put(`/api/lessons/${editLesson.value.id}`, lessonForm)
      } else {
        await axios.post(`/api/courses/${props.course.id}/lessons`, lessonForm)
      }
      showForm.value = false
      fetchLessons()
    }
    const removeLesson = async (id) => {
      await axios.delete(`/api/lessons/${id}`)
      fetchLessons()
    }
    onMounted(fetchLessons)
    watch(() => props.course.id, fetchLessons)
    return { show, lessons, loading, showForm, editLesson, lessonForm, lessonRules, openAddLesson, openEditLesson, saveLesson, removeLesson }
  }
}
</script> 