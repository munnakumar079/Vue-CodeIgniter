<template>
  <div class="auth-container">
    <div class="auth-card">
      <div class="auth-header">
        <h1>Employee Portal</h1>
        <p>Login to manage employees</p>
      </div>

      <form>
        <div class="form-group">
          <label>Email Address</label>
          <input
            type="email"
            placeholder="Enter your email"
          />
        </div>

        <div class="form-group">
          <label>Password</label>
          <input
            type="password"
            placeholder="Enter your password"
          />
        </div>

        <button
          type="submit"
          class="auth-btn"
        >
          Login
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

.auth-footer {
  margin-top: 20px;
  text-align: center;
}

.auth-footer a {
  color: #2563eb;
  font-weight: 600;
}
</style>