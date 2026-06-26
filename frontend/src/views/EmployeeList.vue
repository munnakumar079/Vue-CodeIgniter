<template>
  <div class="page-container">
    <EmployeeFilter
      @search="handleSearch"
      @status-change="handleStatusChange"
      @add="openAddModal"
    />

    <Loader v-if="loading" />

    <template v-else>
      <EmployeeTable
        :employees="paginatedEmployees"
        @edit="handleEdit"
        @delete="handleDelete"
      />

      <Pagination
        :currentPage="currentPage"
        :totalItems="filteredEmployees.length"
        :itemsPerPage="itemsPerPage"
        @page-change="changePage"
      />
    </template>

    <EmployeeModal
      :show="showModal"
      :employee="selectedEmployee"
      @close="closeModal"
      @save="saveEmployee"
    />
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";

import EmployeeFilter from "../components/EmployeeFilter.vue";
import EmployeeTable from "../components/EmployeeTable.vue";
import EmployeeModal from "../components/EmployeeModal.vue";
import Pagination from "../components/Pagination.vue";
import Loader from "../components/Loader.vue";

const loading = ref(true);

const showModal = ref(false);

const selectedEmployee = ref(null);

const currentPage = ref(1);

const itemsPerPage = 10;

const searchKeyword = ref("");

const selectedStatus = ref("");

const employees = ref([
  {
    id: 1,
    name: "Rahul Kumar",
    email: "rahul@gmail.com",
    department: "IT",
    status: "active",
  },
  {
    id: 2,
    name: "Amit Singh",
    email: "amit@gmail.com",
    department: "HR",
    status: "inactive",
  },
  {
    id: 3,
    name: "Rohit Sharma",
    email: "rohit@gmail.com",
    department: "Finance",
    status: "active",
  },
  {
    id: 4,
    name: "Saurabh Kumar",
    email: "saurabh@gmail.com",
    department: "Marketing",
    status: "active",
  },
  {
    id: 5,
    name: "Ankit Raj",
    email: "ankit@gmail.com",
    department: "IT",
    status: "inactive",
  },
]);

const filteredEmployees = computed(() => {
  return employees.value.filter((employee) => {
    const matchSearch =
      employee.name
        .toLowerCase()
        .includes(searchKeyword.value.toLowerCase()) ||
      employee.email
        .toLowerCase()
        .includes(searchKeyword.value.toLowerCase());

    const matchStatus =
      !selectedStatus.value ||
      employee.status === selectedStatus.value;

    return matchSearch && matchStatus;
  });
});

const paginatedEmployees = computed(() => {
  const start =
    (currentPage.value - 1) * itemsPerPage;

  const end = start + itemsPerPage;

  return filteredEmployees.value.slice(start, end);
});

const handleSearch = (value) => {
  searchKeyword.value = value;
  currentPage.value = 1;
};

const handleStatusChange = (value) => {
  selectedStatus.value = value;
  currentPage.value = 1;
};

const changePage = (page) => {
  currentPage.value = page;
};

const openAddModal = () => {
  selectedEmployee.value = null;
  showModal.value = true;
};

const handleEdit = (employee) => {
  selectedEmployee.value = employee;
  showModal.value = true;
};

const handleDelete = (employee) => {
  const confirmDelete = confirm(
    `Delete ${employee.name}?`
  );

  if (!confirmDelete) return;

  employees.value = employees.value.filter(
    (item) => item.id !== employee.id
  );
};

const saveEmployee = (employee) => {
  if (employee.id) {
    const index = employees.value.findIndex(
      (item) => item.id === employee.id
    );

    if (index !== -1) {
      employees.value[index] = employee;
    }
  } else {
    employee.id = Date.now();

    employees.value.unshift(employee);
  }

  closeModal();
};

const closeModal = () => {
  showModal.value = false;
  selectedEmployee.value = null;
};

onMounted(() => {
  setTimeout(() => {
    loading.value = false;
  }, 1500);
});
</script>

<style scoped>
.page-container {
  min-height: 100vh;
  background: #f8fafc;
  padding: 30px;
}

@media (max-width: 768px) {
  .page-container {
    padding: 15px;
  }
}
</style>