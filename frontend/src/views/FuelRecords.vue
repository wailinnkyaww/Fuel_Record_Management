<script setup lang="ts">
import { ref } from 'vue'
import api from '../services/api'
import NavbarLayout from '../components/NavbarLayout.vue'

const region = ref('YGN')
const platePrefix = ref('1')
const plateLetter = ref('A')
const plateNumber = ref('')

const oilType = ref('p-diesel')
const liter = ref('')
const totalPrice = ref('')
const times = ref(1)

const loading = ref(false)
const successMessage = ref('')
const errorMessage = ref('')

const handleSubmit = async () => {
  successMessage.value = ''
  errorMessage.value = ''

  // Validation
  if (!region.value || !plateNumber.value || !oilType.value || !liter.value || !totalPrice.value) {
    errorMessage.value = 'All fields are required'
    return
  }

  loading.value = true

  try {
    const res = await api.post('/fuel-records', {
      region: region.value,
      plate_prefix: platePrefix.value,
      plate_letter: plateLetter.value,
      plate_number: plateNumber.value,
      oil_type: oilType.value,
      liter: liter.value,
      total_price: totalPrice.value,
      times: times.value,
    })

    successMessage.value = res.data.message || 'Fuel record added successfully'

    // Reset form
    plateNumber.value = ''
    liter.value = ''
    totalPrice.value = ''
  } catch (err: any) {
    console.error(err)

    if (err.response?.data?.message) {
      errorMessage.value = err.response.data.message
    } else {
      errorMessage.value = 'Something went wrong'
    }
  } finally {
    loading.value = false
  }
}
</script>

<template>
  <div class="record">
    <NavbarLayout />

    <form @submit.prevent="handleSubmit">
      <h1>Add Fuel Record</h1>

      <div class="container">
        <!-- Region -->
        <label>Region / State</label>

        <select v-model="region">
          <option value="YGN">YGN (Yangon)</option>
          <option value="MDY">MDY (Mandalay)</option>
          <option value="NPW">NPW (Naypyidaw)</option>
          <option value="BGO">BGO (Bago)</option>
        </select>

        <!-- Plate -->
        <label>Plate Serial</label>

        <div class="plateSerial-list">
          <select v-model="platePrefix">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
          </select>

          <select v-model="plateLetter">
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            <option value="E">E</option>
            <option value="F">F</option>
            <option value="G">G</option>
            <option value="H">H</option>
            <option value="I">I</option>
            <option value="J">J</option>
            <option value="K">K</option>
            <option value="L">L</option>
            <option value="M">M</option>
            <option value="N">N</option>
            <option value="O">O</option>
            <option value="P">P</option>
            <option value="Q">Q</option>
            <option value="R">R</option>
            <option value="S">S</option>
            <option value="T">T</option>
          </select>

          <input v-model="plateNumber" type="text" placeholder="1234" />
        </div>

        <!-- Oil Type -->
        <label>Oil Type</label>

        <select v-model="oilType">
          <option value="p-diesel">Premium Diesel</option>
          <option value="diesel">Diesel</option>
          <option value="95_octane">95 Octane</option>
          <option value="92_octane">92 Octane</option>
        </select>

        <!-- Liter -->
        <label>Liter</label>

        <input v-model="liter" type="number" placeholder="e.g. 50" />

        <!-- Total Price -->
        <label>Total Price</label>

        <input v-model="totalPrice" type="number" placeholder="e.g. 50000" />
        <input type="hidden" v-model="times" value="1" />

        <!-- Messages -->
        <p v-if="successMessage" class="success">
          {{ successMessage }}
        </p>

        <p v-if="errorMessage" class="error">
          {{ errorMessage }}
        </p>

        <!-- Submit -->
        <button type="submit" class="btn-submit" :disabled="loading">
          {{ loading ? 'Saving...' : 'Register & Check Fuel Status' }}
        </button>
      </div>
    </form>
  </div>
</template>

<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

form {
  width: 500px;
  padding: 20px;
  border: 2px solid #ccc;
  border-radius: 8px;
  margin: 30px auto;
}

form h1 {
  text-align: center;
  margin-bottom: 20px;
}

.container {
  display: grid;
  grid-template-columns: 150px 300px;
  gap: 15px;
  align-items: center;
}

label {
  text-align: right;
  font-weight: bold;
}

input,
select {
  padding: 8px;
  width: 100%;
}

.plateSerial-list {
  display: flex;
  gap: 5px;
}

.btn-submit {
  grid-column: 1 / -1;
  padding: 10px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.btn-submit:disabled {
  opacity: 0.6;
}

.success {
  color: green;
  grid-column: 1 / -1;
}

.error {
  color: red;
  grid-column: 1 / -1;
}
</style>