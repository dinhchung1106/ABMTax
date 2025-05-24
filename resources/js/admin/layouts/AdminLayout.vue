<template>
  <el-container class="admin-layout">
    <el-aside :width="collapsed ? '64px' : '220px'" class="sidebar">
      <div class="logo-area">
        <img src="/logo.png" class="logo-img" alt="Logo" />
        <transition name="fade">
          <span v-if="!collapsed" class="logo-text">ABM Tax Admin</span>
        </transition>
      </div>
      <el-menu :default-active="$route.path" router :collapse="collapsed" class="sidebar-menu modern-sidebar">
        <el-menu-item index="/admin/dashboard"><el-icon><Odometer /></el-icon><span>Dashboard</span></el-menu-item>
        <el-menu-item index="/admin/users"><el-icon><User /></el-icon><span>Users</span></el-menu-item>
        <el-menu-item index="/admin/services"><el-icon><Suitcase /></el-icon><span>Services</span></el-menu-item>
        <el-menu-item index="/admin/news"><el-icon><Document /></el-icon><span>News</span></el-menu-item>
        <el-menu-item index="/admin/courses"><el-icon><Reading /></el-icon><span>Courses</span></el-menu-item>
        <el-menu-item index="/admin/contacts"><el-icon><Message /></el-icon><span>Contacts</span></el-menu-item>
        <el-menu-item index="/admin/slider-banners"><el-icon><Picture /></el-icon><span>Quản lý Slider Banner</span></el-menu-item>
        <el-menu-item index="/admin/company-info">
          <el-icon><OfficeBuilding /></el-icon>
          <span>Thông tin công ty</span>
        </el-menu-item>
        <el-menu-item index="/admin/roles">
          <el-icon><Lock /></el-icon>
          <span>Quản lý Vai trò</span>
        </el-menu-item>
        <el-menu-item index="/admin/profile">
          <el-icon><EditPen /></el-icon>
          <span>Chỉnh sửa thông tin cá nhân</span>
        </el-menu-item>
      </el-menu>
      <transition name="fade">
        <div class="sidebar-footer" v-if="!collapsed">
          <el-avatar size="medium" src="/avatar.png" class="avatar-shadow" />
          <span class="sidebar-username">Admin</span>
        </div>
      </transition>
      <el-button class="collapse-btn" @click="collapsed = !collapsed" circle plain size="small">
        <el-icon><i :class="collapsed ? 'el-icon-arrow-right' : 'el-icon-arrow-left'" /></el-icon>
      </el-button>
    </el-aside>
    <el-container>
      <el-header class="header modern-header">
        <div class="header-left">
          <span class="header-title">Quản trị hệ thống</span>
        </div>
        <div class="header-right">
          <el-dropdown>
            <span class="el-dropdown-link">
              <el-avatar size="medium" src="/avatar.png" class="avatar-shadow" />
              <span class="header-username">Admin</span>
              <el-icon><i class="el-icon-arrow-down"></i></el-icon>
            </span>
            <template #dropdown>
              <el-dropdown-menu>
                <el-dropdown-item @click="$router.push('/admin/profile')">Chỉnh sửa thông tin cá nhân</el-dropdown-item>
                <el-dropdown-item @click="logout">Đăng xuất</el-dropdown-item>
              </el-dropdown-menu>
            </template>
          </el-dropdown>
        </div>
      </el-header>
      <el-main class="main-content modern-main">
        <slot />
      </el-main>
    </el-container>
  </el-container>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { ElIcon } from 'element-plus'
import { Odometer, User, Suitcase, Document, Reading, Message, OfficeBuilding, Lock, EditPen, Picture } from '@element-plus/icons-vue'

const router = useRouter()
const collapsed = ref(false)

function logout() {
  localStorage.removeItem('token')
  localStorage.removeItem('user')
  router.push({ name: 'AdminLogin' })
}
</script>

<style scoped>
.admin-layout {
  min-height: 100vh;
  font-family: 'Inter', 'Roboto', Arial, sans-serif;
  background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}
.sidebar {
  background: linear-gradient(135deg, #22304a 0%, #001529 100%);
  color: #fff;
  min-height: 100vh;
  position: relative;
  transition: width 0.2s;
  box-shadow: 2px 0 12px #e0e3e8;
  border-top-right-radius: 18px;
  border-bottom-right-radius: 18px;
}
.logo-area {
  display: flex;
  align-items: center;
  padding: 22px 12px 16px 12px;
  background: rgba(255,255,255,0.04);
  border-bottom: 1px solid #2c3e50;
  border-top-right-radius: 18px;
}
.logo-img {
  width: 38px;
  height: 38px;
  border-radius: 12px;
  margin-right: 12px;
  box-shadow: 0 2px 8px #0002;
}
.logo-text {
  font-weight: bold;
  font-size: 20px;
  color: #fff;
  letter-spacing: 1px;
  text-shadow: 0 2px 8px #0002;
}
.sidebar-menu {
  background: transparent;
  border-right: none;
  margin-top: 18px;
}
.modern-sidebar .el-menu-item {
  color: #fff !important;
  border-radius: 8px;
  margin: 0 10px 8px 10px;
  font-size: 16px;
  transition: background 0.2s, color 0.2s;
}
.modern-sidebar .el-menu-item.is-active {
  background: linear-gradient(90deg, #409EFF 60%, #66b1ff 100%) !important;
  color: #fff !important;
  box-shadow: 0 2px 8px #409eff44;
}
.modern-sidebar .el-menu-item:hover {
  background: #22304a99 !important;
  color: #fff !important;
}
.sidebar-footer {
  display: flex;
  align-items: center;
  padding: 18px 12px;
  border-top: 1px solid #2c3e50;
  margin-top: 30px;
  border-bottom-right-radius: 18px;
  background: rgba(255,255,255,0.03);
}
.sidebar-username {
  margin-left: 12px;
  color: #fff;
  font-size: 16px;
  font-weight: 500;
}
.avatar-shadow {
  box-shadow: 0 2px 8px #409eff44;
  border: 2px solid #fff;
}
.collapse-btn {
  position: absolute;
  bottom: 22px;
  left: 50%;
  transform: translateX(-50%);
  background: #22304a;
  color: #fff;
  border: none;
  box-shadow: 0 2px 8px #0001;
}
.header {
  background: linear-gradient(90deg, #fff 60%, #e3eafc 100%);
  display: flex;
  justify-content: space-between;
  align-items: center;
  height: 64px;
  border-bottom: 1px solid #e0e3e8;
  box-shadow: 0 2px 8px #e0e3e8;
  padding: 0 32px;
}
.header-title {
  font-size: 22px;
  font-weight: 700;
  color: #22304a;
  letter-spacing: 1px;
}
.header-right {
  display: flex;
  align-items: center;
}
.header-username {
  margin: 0 10px;
  color: #22304a;
  font-weight: 600;
  font-size: 16px;
}
.main-content {
  background: transparent;
  min-height: 100vh;
  padding: 32px 24px 24px 24px;
  border-radius: 18px;
  box-shadow: 0 2px 16px #e0e3e8;
  margin: 18px 18px 0 0;
}
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.3s;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
@media (max-width: 900px) {
  .sidebar {
    min-width: 64px !important;
    width: 64px !important;
  }
  .main-content {
    padding: 16px 4px 4px 4px;
    margin: 8px 4px 0 0;
  }
  .header {
    padding: 0 8px;
  }
  .logo-area {
    padding: 12px 4px 8px 4px;
  }
}
</style> 