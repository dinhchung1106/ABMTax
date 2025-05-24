<template>
  <div class="login-bg">
    <div class="login-container">
      <div class="login-header">
        <h2 class="login-title">Login Form</h2>
        <el-button class="lang-btn" size="small" circle plain icon="el-icon-translate" />
      </div>
      <el-card class="login-card" shadow="always">
        <el-form :model="form" :rules="rules" ref="loginForm" class="login-form" @submit.native.prevent="onLogin">
          <el-form-item prop="email">
            <el-input v-model="form.email" placeholder="Username" size="large" prefix-icon="el-icon-user" />
          </el-form-item>
          <el-form-item prop="password">
            <el-input v-model="form.password" type="password" placeholder="Password" size="large" prefix-icon="el-icon-lock" show-password />
          </el-form-item>
          <el-form-item>
            <el-button type="primary" class="login-btn" size="large" :loading="loading" native-type="submit" block>Login</el-button>
          </el-form-item>
          <el-alert v-if="error" :title="error" type="error" show-icon class="mt-2" />
        </el-form>
        <div class="login-demo">
          <div>Username : <b>admin</b> &nbsp; Password : <b>any</b></div>
          <div>Username : <b>editor</b> &nbsp; Password : <b>any</b></div>
          <el-button size="small" class="login-demo-btn">Or connect with</el-button>
        </div>
      </el-card>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'
const router = useRouter()
const form = ref({ email: '', password: '' })
const rules = {
  email: [{ required: true, message: 'Please enter username', trigger: 'blur' }],
  password: [{ required: true, message: 'Please enter password', trigger: 'blur' }]
}
const loading = ref(false)
const error = ref('')
const onLogin = async () => {
  error.value = ''
  loading.value = true
  try {
    const res = await axios.post('/api/login', form.value)
    localStorage.setItem('token', res.data.token)
    localStorage.setItem('user', JSON.stringify(res.data.user))
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + res.data.token
    router.push({ name: 'AdminDashboard' })
  } catch (e) {
    error.value = e.response?.data?.message || 'Login failed'
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
.login-bg {
  min-height: 100vh;
  width: 100vw;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #2d3a4b;
}
.login-container {
  width: 370px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
.login-header {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 18px;
  position: relative;
}
.login-title {
  font-size: 28px;
  font-weight: 700;
  color: #fff;
  letter-spacing: 1px;
  margin: 0 auto 0 0;
  text-align: center;
}
.lang-btn {
  position: absolute;
  right: 0;
  top: 0;
  color: #fff;
  border: none;
  background: transparent;
}
.login-card {
  width: 100%;
  border-radius: 12px;
  box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.14);
  padding: 32px 24px 18px 24px;
  background: #1a222c;
}
.login-form {
  margin-top: 0;
}
.login-btn {
  width: 100%;
  font-size: 16px;
  font-weight: bold;
  letter-spacing: 1px;
  background: #409EFF;
  border: none;
}
.login-btn:hover {
  background: #66b1ff;
}
.login-demo {
  margin-top: 18px;
  color: #fff;
  font-size: 14px;
  display: flex;
  flex-direction: column;
  gap: 4px;
  align-items: flex-start;
}
.login-demo-btn {
  margin-top: 8px;
  background: #409EFF;
  color: #fff;
  border: none;
}
@media (max-width: 500px) {
  .login-container {
    width: 98vw;
  }
  .login-card {
    padding: 18px 4vw 12px 4vw;
  }
  .login-title {
    font-size: 20px;
  }
}
</style> 