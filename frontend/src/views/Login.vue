<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import api from '../services/api'
import NavbarLayout from '../components/NavbarLayout.vue'

const email = ref('')
const password = ref('')
const errorMessage = ref('')
const loading = ref(false)

const router = useRouter()

const handleLogin = async () => {
  errorMessage.value = ''

  // Simple validation
  if (!email.value || !password.value) {
    errorMessage.value = 'Email and password are required'
    return
  }

  loading.value = true

  try {
    const res = await api.post('/login', {
      email: email.value,
      password: password.value,
    })

    // Check token
    if (res.data.token) {
      localStorage.setItem('token', res.data.token)

      // redirect
      router.push('/dashboard')
    } else {
      errorMessage.value = 'Invalid server response'
    }
  } catch (err: any) {
    console.error('Login failed:', err)

    // Backend error message
    if (err.response?.data?.message) {
      errorMessage.value = err.response.data.message
    } else if (err.response?.status === 401) {
      errorMessage.value = 'Invalid email or password'
    } else if (err.message) {
      errorMessage.value = err.message
    } else {
      errorMessage.value = 'Something went wrong'
    }
  } finally {
    loading.value = false
  }
}
</script>

<template>
  <div>
    <NavbarLayout />

    <div class="login">
      <h1 class="text-xl mb-4">Login</h1>

      <form @submit.prevent="handleLogin">
        <label for="email">Email:</label>
        <br />

        <input v-model="email" type="email" id="email" placeholder="Email" required />

        <br /><br />

        <label for="password">Password</label>
        <br />

        <input v-model="password" type="password" id="password" placeholder="Password" required />

        <br /><br />

        <!-- Error Message -->
        <p v-if="errorMessage" class="error">
          {{ errorMessage }}
        </p>

        <button type="submit" :disabled="loading">
          {{ loading ? 'Logging in...' : 'Login' }}
        </button>
      </form>
    </div>
  </div>
</template>

<style scoped>
.login {
  width: 500px;
  margin: 20px auto;
  border: 2px solid #ccc;
  border-radius: 10px;
  padding: 50px;
}

label {
  font-weight: bold;
}

input {
  padding: 8px;
  width: 400px;
}

button {
  padding: 10px;
  background-color: #007bff;
  color: white;
  border-radius: 10px;
  border: none;
  cursor: pointer;
}

button:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.error {
  color: red;
  margin-bottom: 15px;
}
</style>