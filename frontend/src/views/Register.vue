<template>
  <div class="auth-container">
    <div class="auth-card">
      <div class="auth-header">
        <h1>Create Account</h1>
        <p>Register to access dashboard</p>
      </div>

      <form>
        <div class="form-group">
          <label>Full Name</label>
          <input
            type="text"
            placeholder="Enter full name"
          />
        </div>

        <div class="form-group">
          <label>Email Address</label>
          <input
            type="email"
            placeholder="Enter email"
          />
        </div>

        <div class="form-group">
          <label>Password</label>
          <input
            type="password"
            placeholder="Enter password"
          />
        </div>

        <div class="form-group">
          <label>Confirm Password</label>
          <input
            type="password"
            placeholder="Confirm password"
          />
        </div>

        <button
          type="submit"
          class="auth-btn"
        >
          Register
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

.auth-footer {
  margin-top: 20px;
  text-align: center;
}

.auth-footer a {
  color: #2563eb;
  font-weight: 600;
}
</style>