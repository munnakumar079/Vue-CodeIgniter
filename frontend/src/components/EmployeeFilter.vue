<template>
  <div class="filter-container">
    <div class="left-section">
      <h2>Employee Management</h2>
      <p>Manage all employees from one place</p>
    </div>

    <div class="right-section">
      <input
        type="text"
        placeholder="Search employee..."
        v-model="search"
      />

      <select v-model="status">
        <option value="">All Status</option>
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
      </select>

      <button @click="$emit('add')">
        + Add Employee
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, watch } from "vue";

const search = ref("");
const status = ref("");

const emit = defineEmits([
  "search",
  "status-change",
  "add"
]);

watch(search, (value) => {
  emit("search", value);
});

watch(status, (value) => {
  emit("status-change", value);
});
</script>

<style scoped>
.filter-container {
  background: white;
  border-radius: 14px;
  padding: 24px;
  display: flex;
  justify-content: space-between;
  gap: 20px;
  align-items: center;
  box-shadow: 0 2px 15px rgba(0,0,0,0.05);
  margin-bottom: 20px;
}

.left-section h2 {
  margin: 0;
  font-size: 26px;
  font-weight: 700;
}

.left-section p {
  margin-top: 6px;
  color: #666;
}

.right-section {
  display: flex;
  gap: 12px;
}

.right-section input,
.right-section select {
  padding: 12px;
  border: 1px solid #ddd;
  border-radius: 8px;
  min-width: 220px;
}

.right-section button {
  background: #2563eb;
  color: white;
  border: none;
  padding: 12px 18px;
  border-radius: 8px;
  cursor: pointer;
  font-weight: 600;
}

.right-section button:hover {
  background: #1d4ed8;
}

@media(max-width:768px) {
  .filter-container {
    flex-direction: column;
    align-items: stretch;
  }

  .right-section {
    flex-direction: column;
  }

  .right-section input,
  .right-section select {
    width: 100%;
  }
}
</style>