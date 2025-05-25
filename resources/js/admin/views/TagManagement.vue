<template>
  <div class="tag-management-page">
    <el-card>
      <h2>Quản lý Thẻ (Tags)</h2>
      <div class="tag-header">
        <el-button type="primary" @click="openAddDialog">Thêm Thẻ</el-button>
      </div>
      <el-table :data="tags" v-loading="loading" style="width: 100%;">
        <el-table-column prop="id" label="ID" width="60"></el-table-column>
        <el-table-column label="Tên Thẻ">
          <template #default="{ row }">
            <el-tag size="small" type="primary">{{ row.name }}</el-tag>
          </template>
        </el-table-column>
        <el-table-column prop="slug" label="Slug" width="200"></el-table-column>
        <el-table-column label="Trạng thái" width="100">
          <template #default="{ row }">
            <el-tag :type="row.status ? 'success' : 'info'">{{ row.status ? 'Hiện' : 'Ẩn' }}</el-tag>
          </template>
        </el-table-column>
        <el-table-column label="Hành động" width="150">
          <template #default="{ row }">
            <el-button size="small" @click="openEditDialog(row)">Sửa</el-button>
            <el-popconfirm title="Xác nhận xóa thẻ này?" @confirm="deleteTag(row.id)">
              <template #reference>
                <el-button size="small" type="danger">Xóa</el-button>
              </template>
            </el-popconfirm>
          </template>
        </el-table-column>
      </el-table>
    </el-card>

    <el-dialog :title="editTag ? 'Sửa Thẻ' : 'Thêm Thẻ mới'" v-model="showDialog" width="500px">
      <el-form :model="form" :rules="rules" ref="formRef" label-width="120px">
        <el-form-item label="Tên Thẻ" prop="name">
          <el-input v-model="form.name"></el-input>
        </el-form-item>
         <el-form-item label="Trạng thái" prop="status">
          <el-switch v-model="form.status" active-text="Hiện" inactive-text="Ẩn" />
        </el-form-item>
      </el-form>
      <template #footer>
        <el-button @click="showDialog = false">Hủy</el-button>
        <el-button type="primary" :loading="saving" @click="saveTag">Lưu</el-button>
      </template>
    </el-dialog>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { ElMessage, ElMessageBox } from 'element-plus';

const tags = ref([]);
const loading = ref(false);
const showDialog = ref(false);
const saving = ref(false);
const editTag = ref(null);
const form = ref({ name: '', status: true });
const rules = {
  name: [{ required: true, message: 'Vui lòng nhập tên thẻ', trigger: 'blur' }],
};
const formRef = ref(null);

const fetchTags = async () => {
  loading.value = true;
  try {
    const response = await axios.get('/api/tags');
    tags.value = response.data;
  } catch (error) {
    ElMessage.error('Lỗi khi tải danh sách thẻ!');
    console.error(error);
  } finally {
    loading.value = false;
  }
};

const openAddDialog = () => {
  editTag.value = null;
  form.value = { name: '', status: true };
  showDialog.value = true;
  if (formRef.value) {
    formRef.value.resetFields();
  }
};

const openEditDialog = (tag) => {
  editTag.value = tag;
  form.value = { name: tag.name, status: !!tag.status };
  showDialog.value = true;
  if (formRef.value) {
    formRef.value.resetFields();
  }
};

const saveTag = async () => {
  if (!formRef.value) return;

  formRef.value.validate(async (valid) => {
    if (valid) {
      saving.value = true;
      try {
        let response;
        const dataToSave = { // Create a new object with only the data to send
            name: form.value.name,
            status: form.value.status ? 1 : 0, // Convert boolean to integer for backend
        };

        if (editTag.value) {
          response = await axios.put(`/api/tags/${editTag.value.id}`, dataToSave);
          ElMessage.success('Cập nhật thẻ thành công!');
        } else {
          response = await axios.post('/api/tags', dataToSave);
          ElMessage.success('Thêm thẻ thành công!');
        }
        showDialog.value = false;
        fetchTags();
      } catch (error) {
         if (error.response && error.response.status === 422) {
            const errors = error.response.data.errors;
             let errorMessage = 'Lỗi xác thực:<br>';
             for (const field in errors) {
                errorMessage += `- ${errors[field].join(', ')}<br>`;
             }
             ElMessageBox.alert(errorMessage, 'Lỗi', {
               dangerouslyUseHTMLString: true,
               confirmButtonText: 'OK',
             });
         } else {
            ElMessage.error(error.response?.data?.message || 'Lỗi khi lưu thẻ!');
         }
        console.error(error);
      } finally {
        saving.value = false;
      }
    }
  });
};

const deleteTag = async (tagId) => {
  ElMessageBox.confirm(
    'Bạn có chắc chắn muốn xóa thẻ này không?',
    'Cảnh báo',
    {
      confirmButtonText: 'Xóa',
      cancelButtonText: 'Hủy',
      type: 'warning',
    }
  ).then(async () => {
    try {
      await axios.delete(`/api/tags/${tagId}`);
      ElMessage.success('Xóa thẻ thành công!');
      fetchTags();
    } catch (error) {
      ElMessage.error(error.response?.data?.message || 'Lỗi khi xóa thẻ!');
      console.error(error);
    }
  }).catch(() => {
      // Catch cancel action
  });
};

onMounted(() => {
  fetchTags();
});
</script>

<style scoped>
.tag-management-page {
  padding: 16px;
}

.tag-header {
  display: flex;
  justify-content: flex-end;
  margin-bottom: 16px;
}
</style> 