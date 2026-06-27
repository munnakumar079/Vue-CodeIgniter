<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import { useToast } from "vue-toastification";
import { loginUser } from "@/services/auth";

const router = useRouter();
const toast = useToast();

const email = ref("");
const password = ref("");
const loading = ref(false);

const handleLogin = async () => {
  try {
    loading.value = true;

    const response = await loginUser({
      email: email.value,
      password: password.value,
    });

    if (response.status) {
      localStorage.setItem(
        "token",
        response.token
      );

      localStorage.setItem(
        "user",
        JSON.stringify(response.user)
      );

      toast.success("Login Successful");

      setTimeout(() => {
        router.push("/dashboard");
      }, 1000);
    }
  } catch (error) {
    toast.error(
      error?.response?.data?.message ||
      "Login Failed"
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
        <h1>Employee Portal</h1>
        <p>Login to manage employees</p>
      </div>

      <form @submit.prevent="handleLogin">
        <div class="form-group">
          <label>Email Address</label>

          <input
            v-model="email"
            type="email"
            placeholder="Enter your email"
            required
          />
        </div>

        <div class="form-group">
          <label>Password</label>

          <input
            v-model="password"
            type="password"
            placeholder="Enter your password"
            required
          />
        </div>

        <button
          type="submit"
          class="auth-btn"
          :disabled="loading"
        >
          {{ loading ? "Logging in..." : "Login" }}
        </button>
      </form>

      <div class="auth-footer">
        Don't have an account?

        <router-link to="/register">
          Register
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
  max-width: 450px;
  background: white;
  padding: 35px;
  border-radius: 16px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
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
  margin-top: 10px;
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