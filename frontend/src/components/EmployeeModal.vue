<template>
  <div
    v-if="show"
    class="modal-overlay"
    @click.self="closeModal"
  >
    <div class="modal-container">
      <div class="modal-header">
        <h2>
          {{ isEdit ? "Edit Employee" : "Add Employee" }}
        </h2>

        <button
          class="close-btn"
          @click="closeModal"
        >
          ✕
        </button>
      </div>

      <form @submit.prevent="submitForm">
        <div class="form-group">
          <label>Name *</label>

          <input
            type="text"
            v-model="form.name"
            placeholder="Enter employee name"
          />

          <small v-if="errors.name">
            {{ errors.name }}
          </small>
        </div>

        <div class="form-group">
          <label>Email *</label>

          <input
            type="email"
            v-model="form.email"
            placeholder="Enter email address"
          />

          <small v-if="errors.email">
            {{ errors.email }}
          </small>
        </div>

        <div class="form-group">
          <label>Department *</label>

          <select v-model="form.department">
            <option value="">
              Select Department
            </option>

            <option value="IT">
              IT
            </option>

            <option value="HR">
              HR
            </option>

            <option value="Finance">
              Finance
            </option>

            <option value="Marketing">
              Marketing
            </option>
          </select>

          <small v-if="errors.department">
            {{ errors.department }}
          </small>
        </div>

        <div class="form-group">
          <label>Status</label>

          <select v-model="form.status">
            <option value="active">
              Active
            </option>

            <option value="inactive">
              Inactive
            </option>
          </select>
        </div>

        <div class="button-group">
          <button
            type="button"
            class="cancel-btn"
            @click="closeModal"
          >
            Cancel
          </button>

          <button
            type="submit"
            class="save-btn"
          >
            {{ isEdit ? "Update Employee" : "Save Employee" }}
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { reactive, watch, computed } from "vue";

const props = defineProps({
  show: {
    type: Boolean,
    default: false,
  },
  employee: {
    type: Object,
    default: null,
  },
});

const emit = defineEmits(["close", "save"]);

const form = reactive({
  id: null,
  name: "",
  email: "",
  department: "",
  status: "active",
});

const errors = reactive({
  name: "",
  email: "",
  department: "",
});

const resetForm = () => {
  form.id = null;
  form.name = "";
  form.email = "";
  form.department = "";
  form.status = "active";

  errors.name = "";
  errors.email = "";
  errors.department = "";
};

const isEdit = computed(() => !!props.employee);

watch(
  () => props.employee,
  (employee) => {
    if (employee) {
      form.id = employee.id;
      form.name = employee.name;
      form.email = employee.email;
      form.department = employee.department;
      form.status = employee.status;
    } else {
      resetForm();
    }
  },
  {
    immediate: true,
  }
);

const validate = () => {
  errors.name = "";
  errors.email = "";
  errors.department = "";

  let valid = true;

  if (!form.name.trim()) {
    errors.name = "Name is required";
    valid = false;
  }

  if (!form.email.trim()) {
    errors.email = "Email is required";
    valid = false;
  }

  if (!/\S+@\S+\.\S+/.test(form.email)) {
    errors.email = "Valid email required";
    valid = false;
  }

  if (!form.department) {
    errors.department = "Department is required";
    valid = false;
  }

  return valid;
};

const submitForm = () => {
  if (!validate()) return;

  emit("save", {
    id: form.id,
    name: form.name,
    email: form.email,
    department: form.department,
    status: form.status,
  });

  closeModal();
};

const closeModal = () => {
  resetForm();
  emit("close");
};
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(15, 23, 42, 0.6);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 999;
  padding: 20px;
}

.modal-container {
  width: 100%;
  max-width: 550px;
  background: white;
  border-radius: 16px;
  padding: 24px;
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 25px;
}

.modal-header h2 {
  margin: 0;
}

.close-btn {
  border: none;
  background: transparent;
  font-size: 22px;
  cursor: pointer;
}

.form-group {
  margin-bottom: 18px;
}

.form-group label {
  display: block;
  margin-bottom: 8px;
  font-weight: 600;
}

.form-group input,
.form-group select {
  width: 100%;
  height: 46px;
  padding: 0 14px;
  border: 1px solid #dbe2ea;
  border-radius: 10px;
  outline: none;
}

.form-group input:focus,
.form-group select:focus {
  border-color: #2563eb;
}

.form-group small {
  color: #dc2626;
  display: block;
  margin-top: 5px;
}

.button-group {
  display: flex;
  justify-content: flex-end;
  gap: 12px;
  margin-top: 25px;
}

.cancel-btn {
  border: 1px solid #dbe2ea;
  background: white;
  padding: 10px 18px;
  border-radius: 10px;
  cursor: pointer;
}

.save-btn {
  border: none;
  background: #2563eb;
  color: white;
  padding: 10px 18px;
  border-radius: 10px;
  cursor: pointer;
}

.save-btn:hover {
  background: #1d4ed8;
}
</style>