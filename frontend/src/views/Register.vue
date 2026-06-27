<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import { useToast } from "vue-toastification";
import { registerUser } from "@/services/auth";

const router = useRouter();
const toast = useToast();

const name = ref("");
const email = ref("");
const password = ref("");
const confirmPassword = ref("");
const loading = ref(false);

const handleRegister = async () => {
  if (
    !name.value ||
    !email.value ||
    !password.value ||
    !confirmPassword.value
  ) {
    toast.error("All fields are required");
    return;
  }

  if (password.value !== confirmPassword.value) {
    toast.error("Passwords do not match");
    return;
  }

  try {
    loading.value = true;

    const response = await registerUser({
      name: name.value,
      email: email.value,
      password: password.value,
    });

    if (response.status) {
      toast.success(response.message);

      setTimeout(() => {
        router.push("/login");
      }, 1000);
    }
  } catch (error) {
    toast.error(
      error?.response?.data?.message ||
      "Registration Failed"
    );
  } finally {
    loading.value = false;
  }
};
</script>

<template>
  <div class="auth-container">
    <div class="auth-card">
      <div class="auth-header">
        <h1>Create Account</h1>
        <p>Register to access dashboard</p>
      </div>

      <form @submit.prevent="handleRegister">
        <div class="form-group">
          <label>Full Name</label>

          <input
            v-model="name"
            type="text"
            placeholder="Enter full name"
          />
        </div>

        <div class="form-group">
          <label>Email Address</label>

          <input
            v-model="email"
            type="email"
            placeholder="Enter email"
          />
        </div>

        <div class="form-group">
          <label>Password</label>

          <input
            v-model="password"
            type="password"
            placeholder="Enter password"
          />
        </div>

        <div class="form-group">
          <label>Confirm Password</label>

          <input
            v-model="confirmPassword"
            type="password"
            placeholder="Confirm password"
          />
        </div>

        <button
          type="submit"
          class="auth-btn"
          :disabled="loading"
        >
          {{
            loading
              ? "Registering..."
              : "Register"
          }}
        </button>
      </form>

      <div class="auth-footer">
        Already have an account?

        <router-link to="/login">
          Login
        </router-link>
      </div>
    </div>
  </div>
</template>

<style scoped>
.auth-container {
  min-height: 100vh;
  background: #f8fafc;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 20px;
}

.auth-card {
  width: 100%;
  max-width: 500px;
  background: white;
  padding: 35px;
  border-radius: 16px;
  box-shadow: 0 10px 30px rgba(0,0,0,.08);
}

.auth-header {
  text-align: center;
  margin-bottom: 30px;
}

.auth-header h1 {
  margin-bottom: 8px;
}

.auth-header p {
  color: #64748b;
}

.form-group {
  margin-bottom: 18px;
}

.form-group label {
  display: block;
  margin-bottom: 8px;
  font-weight: 600;
}

.form-group input {
  width: 100%;
  height: 48px;
  border: 1px solid #dbe2ea;
  border-radius: 10px;
  padding: 0 15px;
  box-sizing: border-box;
}

.form-group input:focus {
  outline: none;
  border-color: #2563eb;
}

.auth-btn {
  width: 100%;
  height: 48px;
  border: none;
  border-radius: 10px;
  background: #2563eb;
  color: white;
  font-size: 16px;
  cursor: pointer;
}

.auth-btn:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

.auth-footer {
  margin-top: 20px;
  text-align: center;
}

.auth-footer a {
  color: #2563eb;
  font-weight: 600;
  text-decoration: none;
}
</style>