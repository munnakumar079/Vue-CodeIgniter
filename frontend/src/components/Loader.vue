<template>
  <div class="skeleton-wrapper">
    <div
      v-for="item in 8"
      :key="item"
      class="skeleton-row"
    >
      <div class="skeleton skeleton-avatar"></div>

      <div class="skeleton-content">
        <div class="skeleton skeleton-title"></div>
        <div class="skeleton skeleton-text"></div>
      </div>

      <div class="skeleton skeleton-status"></div>

      <div class="skeleton skeleton-button"></div>
    </div>
  </div>
</template>

<script setup>
</script>

<style scoped>
.skeleton-wrapper {
  background: #fff;
  border-radius: 14px;
  padding: 20px;
  box-shadow: 0 2px 15px rgba(0,0,0,0.05);
}

.skeleton-row {
  display: flex;
  align-items: center;
  gap: 20px;
  padding: 18px 0;
  border-bottom: 1px solid #f1f5f9;
}

.skeleton-row:last-child {
  border-bottom: none;
}

.skeleton {
  position: relative;
  overflow: hidden;
  background: #e5e7eb;
  border-radius: 8px;
}

.skeleton::after {
  content: "";
  position: absolute;
  inset: 0;
  transform: translateX(-100%);
  animation: shimmer 1.4s infinite;
  background: linear-gradient(
    90deg,
    transparent,
    rgba(255,255,255,0.7),
    transparent
  );
}

@keyframes shimmer {
  100% {
    transform: translateX(100%);
  }
}

.skeleton-avatar {
  width: 50px;
  height: 50px;
  border-radius: 50%;
}

.skeleton-content {
  flex: 1;
}

.skeleton-title {
  width: 200px;
  height: 18px;
  margin-bottom: 10px;
}

.skeleton-text {
  width: 150px;
  height: 12px;
}

.skeleton-status {
  width: 90px;
  height: 32px;
}

.skeleton-button {
  width: 120px;
  height: 36px;
}

@media (max-width: 768px) {
  .skeleton-row {
    gap: 12px;
  }

  .skeleton-title {
    width: 120px;
  }

  .skeleton-text {
    width: 80px;
  }

  .skeleton-button {
    width: 70px;
  }
}
</style>