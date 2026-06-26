<template>
  <div class="table-wrapper">
    <table v-if="employees.length">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Department</th>
          <th>Status</th>
          <th width="180">Actions</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="employee in employees" :key="employee.id">
          <td>{{ employee.id }}</td>

          <td>
            <div class="user-info">
              <div class="avatar">
                {{ employee.name.charAt(0).toUpperCase() }}
              </div>
              <span>{{ employee.name }}</span>
            </div>
          </td>

          <td>{{ employee.email }}</td>

          <td>{{ employee.department }}</td>

          <td>
            <span
              class="status-badge"
              :class="employee.status"
            >
              {{ employee.status }}
            </span>
          </td>

          <td>
            <div class="action-buttons">
              <button
                class="edit-btn"
                @click="$emit('edit', employee)"
              >
                Edit
              </button>

              <button
                class="delete-btn"
                @click="$emit('delete', employee)"
              >
                Delete
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>

    <div v-else class="empty-state">
      <h3>No Employees Found</h3>
      <p>Add your first employee to get started.</p>
    </div>
  </div>
</template>

<script setup>
defineProps({
  employees: {
    type: Array,
    default: () => [],
  },
});

defineEmits(["edit", "delete"]);
</script>

<style scoped>
.table-wrapper {
  background: #fff;
  border-radius: 14px;
  overflow-x: auto;
  box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
}

table {
  width: 100%;
  border-collapse: collapse;
}

thead {
  background: #f8fafc;
}

th {
  text-align: left;
  padding: 18px;
  font-size: 14px;
  font-weight: 600;
  color: #475569;
  border-bottom: 1px solid #e2e8f0;
}

td {
  padding: 18px;
  border-bottom: 1px solid #f1f5f9;
}

tbody tr:hover {
  background: #f8fafc;
}

.user-info {
  display: flex;
  align-items: center;
  gap: 12px;
}

.avatar {
  width: 38px;
  height: 38px;
  border-radius: 50%;
  background: #2563eb;
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
}

.status-badge {
  padding: 6px 12px;
  border-radius: 999px;
  font-size: 13px;
  text-transform: capitalize;
  font-weight: 600;
}

.active {
  background: #dcfce7;
  color: #15803d;
}

.inactive {
  background: #fee2e2;
  color: #dc2626;
}

.action-buttons {
  display: flex;
  gap: 10px;
}

.edit-btn,
.delete-btn {
  border: none;
  padding: 8px 14px;
  border-radius: 8px;
  cursor: pointer;
  font-weight: 600;
}

.edit-btn {
  background: #dbeafe;
  color: #2563eb;
}

.delete-btn {
  background: #fee2e2;
  color: #dc2626;
}

.empty-state {
  text-align: center;
  padding: 80px 20px;
}

.empty-state h3 {
  margin-bottom: 10px;
  color: #1e293b;
}

.empty-state p {
  color: #64748b;
}

@media (max-width: 768px) {
  table {
    min-width: 850px;
  }
}
</style>