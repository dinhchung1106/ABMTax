<template>
  <div class="collaborators-page">
    <el-card>
      <div class="collaborators-header">
        <h3>Danh sách Cộng tác viên</h3>
        <div class="search-box">
          <el-input
            v-model="searchQuery"
            placeholder="Tìm kiếm theo tên, email, số điện thoại..."
            clearable
            class="search-input"
            @clear="handleSearch"
            @keyup.enter="handleSearch"
          >
            <template #prefix>
              <el-icon><Search /></el-icon>
            </template>
          </el-input>
        </div>
      </div>
      
      <el-table :data="collaborators" style="width: 100%" v-loading="loading">
        <el-table-column prop="name" label="Tên" />
        <el-table-column prop="phone" label="Điện thoại" />
        <el-table-column prop="email" label="Email" />
        <el-table-column prop="job" label="Nghề nghiệp" />
        <el-table-column prop="created_at" label="Ngày đăng ký" width="150">
          <template #default="{ row }">
            {{ formatDate(row.created_at) }}
          </template>
        </el-table-column>
        <el-table-column prop="status" label="Trạng thái" width="120">
          <template #default="{ row }">
            <el-tag :type="getStatusType(row.status)">
              {{ getStatusText(row.status) }}
            </el-tag>
          </template>
        </el-table-column>
        <el-table-column label="Hành động" width="250">
          <template #default="{ row }">
            <el-button 
              v-if="row.status === 'pending'"
              type="success" 
              size="small" 
              @click="handleStatusUpdate(row, 'approved')"
            >
              Duyệt
            </el-button>
            <el-button 
              v-if="row.status === 'pending'"
              type="danger" 
              size="small" 
              @click="handleStatusUpdate(row, 'rejected')"
            >
              Từ chối
            </el-button>
            <el-button
              v-if="row.status === 'rejected' && row.reason"
              type="info"
              size="small"
              @click="showReason(row)"
            >
              Xem lý do
            </el-button>
          </template>
        </el-table-column>
      </el-table>

      <!-- Pagination -->
      <div class="pagination-container">
        <el-pagination
          @current-change="handleCurrentChange"
          :current-page="currentPage"
          :page-size="pageSize"
          :total="total"
          layout="total, prev, pager, next"
          background
        />
      </div>
    </el-card>

    <!-- Status Update Dialog -->
    <el-dialog
      v-model="statusDialogVisible"
      :title="statusDialogTitle"
      width="500px"
    >
      <el-form :model="statusForm" label-width="100px">
        <el-form-item label="Lý do">
          <el-input
            v-model="statusForm.reason"
            type="textarea"
            :rows="3"
            placeholder="Nhập lý do (không bắt buộc)"
          />
        </el-form-item>
      </el-form>
      <template #footer>
        <span class="dialog-footer">
          <el-button @click="statusDialogVisible = false">Hủy</el-button>
          <el-button type="primary" @click="submitStatusUpdate">
            Xác nhận
          </el-button>
        </span>
      </template>
    </el-dialog>

    <!-- View Reason Dialog -->
    <el-dialog
      v-model="reasonDialogVisible"
      title="Lý do từ chối"
      width="500px"
    >
      <div class="reason-content">
        {{ selectedReason }}
      </div>
      <template #footer>
        <span class="dialog-footer">
          <el-button @click="reasonDialogVisible = false">Đóng</el-button>
        </span>
      </template>
    </el-dialog>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import axios from 'axios';
import { ElMessage } from 'element-plus';
import { Search } from '@element-plus/icons-vue';

const collaborators = ref([]);
const loading = ref(false);
const statusDialogVisible = ref(false);
const statusDialogTitle = ref('');
const statusForm = ref({
  id: null,
  status: '',
  reason: ''
});

// Reason dialog
const reasonDialogVisible = ref(false);
const selectedReason = ref('');

// Pagination
const currentPage = ref(1);
const pageSize = ref(10);
const total = ref(0);

// Search
const searchQuery = ref('');

const formatDate = (date) => {
  if (!date) return '';
  return new Date(date).toLocaleDateString('vi-VN', {
    year: 'numeric',
    month: '2-digit',
    day: '2-digit',
    hour: '2-digit',
    minute: '2-digit'
  });
};

const fetchCollaborators = async () => {
  loading.value = true;
  try {
    const response = await axios.get('/api/collaborators', {
      params: {
        page: currentPage.value,
        per_page: pageSize.value,
        search: searchQuery.value
      }
    });
    collaborators.value = response.data.data;
    total.value = response.data.total;
  } catch (error) {
    console.error('Error fetching collaborators:', error);
    ElMessage.error('Lỗi khi tải danh sách cộng tác viên.');
  } finally {
    loading.value = false;
  }
};

const handleSearch = () => {
  currentPage.value = 1; // Reset to first page when searching
  fetchCollaborators();
};

const handleSizeChange = (val) => {
  pageSize.value = val;
  fetchCollaborators();
};

const handleCurrentChange = (val) => {
  currentPage.value = val;
  fetchCollaborators();
};

const getStatusText = (status) => {
  switch (status) {
    case 'pending':
      return 'Chờ duyệt';
    case 'approved':
      return 'Đã duyệt';
    case 'rejected':
      return 'Từ chối';
    default:
      return 'Không xác định';
  }
};

const getStatusType = (status) => {
  switch (status) {
    case 'pending':
      return 'warning';
    case 'approved':
      return 'success';
    case 'rejected':
      return 'danger';
    default:
      return 'info';
  }
};

const handleStatusUpdate = (row, newStatus) => {
  statusForm.value = {
    id: row.id,
    status: newStatus,
    reason: ''
  };
  statusDialogTitle.value = newStatus === 'approved' ? 'Duyệt cộng tác viên' : 'Từ chối cộng tác viên';
  statusDialogVisible.value = true;
};

const showReason = (row) => {
  selectedReason.value = row.reason || 'Không có lý do';
  reasonDialogVisible.value = true;
};

const submitStatusUpdate = async () => {
  try {
    await axios.put(`/api/collaborators/${statusForm.value.id}/status`, {
      status: statusForm.value.status,
      reason: statusForm.value.reason
    });
    
    ElMessage.success('Cập nhật trạng thái thành công');
    statusDialogVisible.value = false;
    fetchCollaborators(); // Refresh the list
  } catch (error) {
    console.error('Error updating status:', error);
    ElMessage.error('Lỗi khi cập nhật trạng thái');
  }
};

// Watch for search query changes with debounce
let searchTimeout;
watch(searchQuery, (newValue) => {
  clearTimeout(searchTimeout);
  searchTimeout = setTimeout(() => {
    handleSearch();
  }, 500);
});

onMounted(() => {
  fetchCollaborators();
});
</script>

<style scoped>
.collaborators-page {
  padding: 16px;
}

.collaborators-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}

.search-box {
  width: 260px;
}

.search-input {
  width: 100%;
}

h3 {
  margin: 0;
  font-size: 18px;
}

.dialog-footer {
  display: flex;
  justify-content: flex-end;
  gap: 8px;
}

.reason-content {
  padding: 16px;
  background-color: #f5f7fa;
  border-radius: 4px;
  white-space: pre-wrap;
  word-break: break-word;
}

.pagination-container {
  margin-top: 16px;
  display: flex;
  justify-content: flex-end;
}
</style> 