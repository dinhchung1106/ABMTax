<template>
  <div class="company-info-settings-page">
    <el-card v-loading="loading || saving">
      <h2>Cài đặt thông tin công ty</h2>
      <el-form :model="form" :rules="rules" ref="companyInfoForm" label-width="120px">
        <el-form-item label="Tên công ty" prop="name">
          <el-input v-model="form.name"></el-input>
        </el-form-item>
        <el-form-item label="Địa chỉ" prop="address">
          <el-input v-model="form.address"></el-input>
        </el-form-item>
        <el-form-item label="Email" prop="email">
          <el-input v-model="form.email"></el-input>
        </el-form-item>
        <el-form-item label="Hotline" prop="hotline">
          <el-input v-model="form.hotline"></el-input>
        </el-form-item>
        <el-form-item label="Slogan" prop="slogan">
          <el-input v-model="form.slogan"></el-input>
        </el-form-item>
        <el-form-item label="Giới thiệu" prop="about">
          <el-input type="textarea" v-model="form.about"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="saveSettings" :loading="saving">Lưu cài đặt</el-button>
        </el-form-item>
      </el-form>
    </el-card>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { ElMessage } from 'element-plus';

const form = ref({
  name: '',
  address: '',
  email: '',
  hotline: '',
  slogan: '',
  about: '',
});

const loading = ref(true);
const saving = ref(false);

const rules = ref({
  name: [{ required: true, message: 'Vui lòng nhập tên công ty', trigger: 'blur' }],
  address: [{ required: true, message: 'Vui lòng nhập địa chỉ', trigger: 'blur' }],
  email: [
    { required: true, message: 'Vui lòng nhập email', trigger: 'blur' },
    { type: 'email', message: 'Vui lòng nhập email hợp lệ', trigger: ['blur', 'change'] },
  ],
  hotline: [{ required: true, message: 'Vui lòng nhập hotline', trigger: 'blur' }],
  slogan: [{ required: true, message: 'Vui lòng nhập slogan', trigger: 'blur' }],
  about: [{ required: true, message: 'Vui lòng nhập giới thiệu', trigger: 'blur' }],
});

const companyInfoForm = ref(null);

const saveSettings = async () => {
  companyInfoForm.value.validate(async (valid) => {
    if (valid) {
      saving.value = true;
      try {
        await axios.put('/api/company-info', form.value);
        ElMessage.success('Lưu cài đặt thành công!');
      } catch (error) {
        if (error.response && error.response.status === 400) {
          const errors = error.response.data;
          let errorMessage = 'Lỗi khi lưu cài đặt:\n';
          for (const field in errors) {
            errorMessage += `${field}: ${errors[field].join(', ')}\n`;
          }
          ElMessage.error(errorMessage);
        } else if (error.response && error.response.status === 401) {
             ElMessage.error('Phiên đăng nhập đã hết hạn. Vui lòng đăng nhập lại.');
         } else {
          ElMessage.error(error.response?.data?.message || 'Lỗi khi lưu cài đặt!');
        }
        console.error(error);
      } finally {
        saving.value = false;
      }
    } else {
      ElMessage.warning('Vui lòng kiểm tra lại các trường bị lỗi.');
      return false;
    }
  });
};

onMounted(() => {
  const initialData = window.initialCompanyInfo;
  if (initialData) {
      form.value = initialData;
  } else {
      console.warn('Initial company info data not available from blade view.');
  }
  loading.value = false;
});

</script>

<style scoped>
.company-info-settings-page {
  padding: 16px;
}
</style> 