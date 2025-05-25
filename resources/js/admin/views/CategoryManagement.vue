<template>
  <div class="category-management-page">
    <el-card>
      <h2>Quản lý Danh mục Tin tức</h2>
      <div class="category-header">
        <el-button type="primary" @click="openAddDialog">Thêm Danh mục</el-button>
      </div>
      <el-table :data="categories" v-loading="loading" style="width: 100%;">
        <el-table-column prop="id" label="ID" width="60"></el-table-column>
        <el-table-column prop="name" label="Tên Danh mục"></el-table-column>
        <el-table-column prop="slug" label="Slug"></el-table-column>
        <el-table-column label="Trạng thái" width="100">
          <template #default="{ row }">
            <el-tag :type="row.status ? 'success' : 'info'">{{ row.status ? 'Hiện' : 'Ẩn' }}</el-tag>
          </template>
        </el-table-column>
        <el-table-column label="Hành động" width="150">
          <template #default="{ row }">
            <el-button size="small" @click="openEditDialog(row)">Sửa</el-button>
            <el-popconfirm title="Xác nhận xóa danh mục này?" @confirm="deleteCategory(row.id)">
              <template #reference>
                <el-button size="small" type="danger">Xóa</el-button>
              </template>
            </el-popconfirm>
          </template>
        </el-table-column>
      </el-table>
    </el-card>

    <el-dialog :title="editCategory ? 'Sửa Danh mục' : 'Thêm Danh mục mới'" v-model="showDialog" width="500px">
      <el-form :model="form" :rules="rules" ref="formRef" label-width="120px">
        <el-form-item label="Tên Danh mục" prop="name">
          <el-input v-model="form.name"></el-input>
        </el-form-item>
        
        <el-form-item label="Trạng thái" prop="status">
          <el-switch v-model="form.status" active-text="Hiện" inactive-text="Ẩn" />
        </el-form-item>
      </el-form>
      <template #footer>
        <el-button @click="showDialog = false">Hủy</el-button>
        <el-button type="primary" :loading="saving" @click="saveCategory">Lưu</el-button>
      </template>
    </el-dialog>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { ElMessage, ElMessageBox } from 'element-plus';

const categories = ref([]);
const loading = ref(false);
const showDialog = ref(false);
const saving = ref(false);
const editCategory = ref(null);
const form = ref({ name: '', slug: '', status: true });
const rules = {
  name: [{ required: true, message: 'Vui lòng nhập tên danh mục', trigger: 'blur' }],
};
const formRef = ref(null);

const fetchCategories = async () => {
  loading.value = true;
  try {
    const response = await axios.get('/api/categories');
    categories.value = response.data;
  } catch (error) {
    ElMessage.error('Lỗi khi tải danh sách danh mục!');
    console.error(error);
  } finally {
    loading.value = false;
  }
};

const openAddDialog = () => {
  editCategory.value = null;
  form.value = { name: '', status: true };
  showDialog.value = true;
  if (formRef.value) {
    formRef.value.resetFields();
  }
};

const openEditDialog = (category) => {
  editCategory.value = category;
  form.value = { name: category.name, status: !!category.status };
  showDialog.value = true;
  if (formRef.value) {
    formRef.value.resetFields();
  }
};

const saveCategory = async () => {
  if (!formRef.value) return;

  formRef.value.validate(async (valid) => {
    if (valid) {
      saving.value = true;
      try {
        let response;
        const dataToSave = {
            name: form.value.name,
            status: form.value.status ? 1 : 0,
        };

        if (editCategory.value) {
          response = await axios.put(`/api/categories/${editCategory.value.id}`, dataToSave);
          ElMessage.success('Cập nhật danh mục thành công!');
        } else {
          response = await axios.post('/api/categories', dataToSave);
          ElMessage.success('Thêm danh mục thành công!');
        }
        showDialog.value = false;
        fetchCategories();
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
            ElMessage.error(error.response?.data?.message || 'Lỗi khi lưu danh mục!');
         }
        console.error(error);
      } finally {
        saving.value = false;
      }
    }
  });
};

const deleteCategory = async (categoryId) => {
  ElMessageBox.confirm(
    'Bạn có chắc chắn muốn xóa danh mục này không?',
    'Cảnh báo',
    {
      confirmButtonText: 'Xóa',
      cancelButtonText: 'Hủy',
      type: 'warning',
    }
  ).then(async () => {
    try {
      await axios.delete(`/api/categories/${categoryId}`);
      ElMessage.success('Xóa danh mục thành công!');
      fetchCategories();
    } catch (error) {
      ElMessage.error(error.response?.data?.message || 'Lỗi khi xóa danh mục!');
      console.error(error);
    }
  }).catch(() => {
      // Catch cancel action
  });
};

onMounted(() => {
  fetchCategories();
});
</script>

<style scoped>
.category-management-page {
  padding: 16px;
}

.category-header {
  display: flex;
  justify-content: flex-end;
  margin-bottom: 16px;
}
</style> 