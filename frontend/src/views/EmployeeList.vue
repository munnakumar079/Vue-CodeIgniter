<template>
  <div class="container">

    <EmployeeFilter
      @add="openModal"
    />

    <EmployeeSkeleton v-if="loading" />

    <template v-else>

      <EmployeeTable
        :employees="employees"
        @edit="editEmployee"
        @delete="deleteEmployee"
      />

      <EmployeePagination
        :currentPage="currentPage"
        :totalItems="employees.length"
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
import { ref, onMounted } from "vue";
import { useToast } from "vue-toastification";

import EmployeeFilter from "@/components/EmployeeFilter.vue";
import EmployeeTable from "@/components/EmployeeTable.vue";
import EmployeeModal from "@/components/EmployeeModal.vue";
import Pagination from "@/components/Pagination.vue";
import Loader from "@/components/Loader.vue";

import {
  getEmployees,
  createEmployee,
  updateEmployee,
  deleteEmployeeApi,
} from "@/services/employee";

const toast = useToast();

const showModal = ref(false);
const selectedEmployee = ref(null);

const employees = ref([]);

const currentPage = ref(1);

const loading = ref(false);

const fetchEmployees = async () => {
  try {
    loading.value = true;

    const response = await getEmployees();

    employees.value = response.data.data;
  } catch (error) {
    toast.error("Failed to load employees");
    console.error(error);
  } finally {
    loading.value = false;
  }
};

onMounted(() => {
  fetchEmployees();
});

const openModal = () => {
  selectedEmployee.value = null;
  showModal.value = true;
};

const closeModal = () => {
  showModal.value = false;
};

const editEmployee = (employee) => {
  selectedEmployee.value = employee;
  showModal.value = true;
};

const deleteEmployee = async (employee) => {
  try {
    await deleteEmployeeApi(employee.id);

    toast.success("Employee deleted successfully");

    fetchEmployees();
  } catch (error) {
    toast.error("Delete failed");
    console.error(error);
  }
};

const saveEmployee = async (employee) => {
  try {

    if (employee.id) {
      await updateEmployee(
        employee.id,
        employee
      );

      toast.success(
        "Employee updated successfully"
      );
    } else {
      await createEmployee(employee);

      toast.success(
        "Employee created successfully"
      );
    }

    closeModal();

    fetchEmployees();

  } catch (error) {
    toast.error("Operation failed");
    console.error(error);
  }
};

const changePage = (page) => {
  currentPage.value = page;
};
</script>