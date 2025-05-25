<template>
  <div class="contact-management-page">
    <el-card>
      <h2>Quản lý Liên hệ</h2>
      <div class="contact-header">
        <el-input v-model="search" placeholder="Tìm kiếm liên hệ..." clearable class="search-input" @input="fetchContacts" />
      </div>
      <el-table :data="contacts" v-loading="loading" style="width: 100%;">
        <el-table-column prop="id" label="ID" width="60"></el-table-column>
        <el-table-column prop="name" label="Tên"></el-table-column>
        <el-table-column prop="phone" label="Số điện thoại"></el-table-column>
        <el-table-column prop="email" label="Email"></el-table-column>
        <el-table-column prop="message" label="Nội dung"></el-table-column>
        <el-table-column prop="status" label="Trạng thái" width="100">
          <template #default="{ row }">
            <el-tag :type="row.status === 'replied' ? 'success' : 'info'">{{ row.status }}</el-tag>
          </template>
        </el-table-column>
        <el-table-column label="Ngày tạo" width="180">
          <template #default="{ row }">
            {{ new Date(row.created_at).toLocaleString() }}
          </template>
        </el-table-column>
        <el-table-column label="Hành động" width="100">
          <template #default="{ row }">
            <el-popconfirm title="Xác nhận xóa liên hệ này?" @confirm="deleteContact(row.id)">
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
          :total="totalContacts"
          layout="total, prev, pager, next"
          background
        />
      </div>
    </el-card>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { ElMessage, ElMessageBox } from 'element-plus';

const contacts = ref([]);
const loading = ref(false);
const search = ref('');

const currentPage = ref(1);
const pageSize = ref(10);
const totalContacts = ref(0);

const fetchContacts = async () => {
  loading.value = true;
  try {
    const response = await axios.get('/api/contacts', {
      params: {
        page: currentPage.value,
        per_page: pageSize.value,
        search: search.value,
      }
    });
    contacts.value = response.data.data;
    totalContacts.value = response.data.total;
    currentPage.value = response.data.current_page;
  } catch (error) {
    ElMessage.error('Lỗi khi tải danh sách liên hệ!');
    console.error(error);
  } finally {
    loading.value = false;
  }
};

const deleteContact = async (contactId) => {
  ElMessageBox.confirm(
    'Bạn có chắc chắn muốn xóa liên hệ này không?',
    'Cảnh báo',
    {
      confirmButtonText: 'Xóa',
      cancelButtonText: 'Hủy',
      type: 'warning',
    }
  ).then(async () => {
    try {
      await axios.delete(`/api/contacts/${contactId}`);
      ElMessage.success('Xóa liên hệ thành công!');
      fetchContacts(); // Refresh the list after deletion
    } catch (error) {
      ElMessage.error(error.response?.data?.message || 'Lỗi khi xóa liên hệ!');
      console.error(error);
    }
  }).catch(() => {
      // Catch cancel action
  });
};

const handlePageChange = (newPage) => {
  currentPage.value = newPage;
  fetchContacts();
};

onMounted(() => {
  fetchContacts();
});
</script>

<style scoped>
.contact-management-page {
  padding: 16px;
}

.contact-header {
  display: flex;
  justify-content: flex-end;
  margin-bottom: 16px;
}

.search-input {
  width: 260px;
  margin-right: auto; /* Push the search input to the left */
}

.pagination-container {
  margin-top: 16px;
  display: flex;
  justify-content: flex-end;
}
</style> 