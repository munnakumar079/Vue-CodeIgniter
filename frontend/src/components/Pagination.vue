<template>
  <div class="pagination-wrapper" v-if="totalPages > 1">
    <div class="pagination-info">
      Showing
      {{ startItem }}
      -
      {{ endItem }}
      of
      {{ totalItems }}
      records
    </div>

    <div class="pagination">
      <button
        class="page-btn"
        :disabled="currentPage === 1"
        @click="changePage(currentPage - 1)"
      >
        Previous
      </button>

      <button
        v-for="page in visiblePages"
        :key="page"
        class="page-btn"
        :class="{ active: currentPage === page }"
        @click="changePage(page)"
      >
        {{ page }}
      </button>

      <button
        class="page-btn"
        :disabled="currentPage === totalPages"
        @click="changePage(currentPage + 1)"
      >
        Next
      </button>
    </div>
  </div>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
  currentPage: {
    type: Number,
    required: true,
  },
  totalItems: {
    type: Number,
    required: true,
  },
  itemsPerPage: {
    type: Number,
    default: 10,
  },
});

const emit = defineEmits(["page-change"]);

const totalPages = computed(() =>
  Math.ceil(props.totalItems / props.itemsPerPage)
);

const startItem = computed(() => {
  return (props.currentPage - 1) * props.itemsPerPage + 1;
});

const endItem = computed(() => {
  const end = props.currentPage * props.itemsPerPage;
  return end > props.totalItems ? props.totalItems : end;
});

const visiblePages = computed(() => {
  const pages = [];

  for (let i = 1; i <= totalPages.value; i++) {
    pages.push(i);
  }

  return pages;
});

const changePage = (page) => {
  if (page < 1 || page > totalPages.value) return;

  emit("page-change", page);
};
</script>

<style scoped>
.pagination-wrapper {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 20px;
  background: white;
  padding: 18px 24px;
  border-radius: 14px;
  box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
}

.pagination-info {
  color: #64748b;
  font-size: 14px;
}

.pagination {
  display: flex;
  gap: 8px;
}

.page-btn {
  min-width: 40px;
  height: 40px;
  border: 1px solid #e2e8f0;
  background: white;
  border-radius: 8px;
  cursor: pointer;
  font-weight: 600;
  transition: 0.3s;
}

.page-btn:hover:not(:disabled) {
  background: #f1f5f9;
}

.page-btn.active {
  background: #2563eb;
  color: white;
  border-color: #2563eb;
}

.page-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

@media (max-width: 768px) {
  .pagination-wrapper {
    flex-direction: column;
    gap: 15px;
    text-align: center;
  }

  .pagination {
    flex-wrap: wrap;
    justify-content: center;
  }
}
</style>