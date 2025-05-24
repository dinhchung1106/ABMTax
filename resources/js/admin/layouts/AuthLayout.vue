<template>
  <div class="auth-layout">
    <slot />
  </div>
</template>

<script setup>
// Không cần logic gì đặc biệt
</script>

<style scoped>
.auth-layout {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #e0e7ff 0%, #f5f7fa 100%);
}
</style> 