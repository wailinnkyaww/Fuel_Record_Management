<template>
  <router-view />
</template>
<!-- <script setup lang="ts"></script>

<template>
  <div id="app" class="p-6 max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Fuel Record Management</h1>

    <div class="mb-4">
      <button @click="fetchRecords" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">
        Refresh
      </button>
      <button @click="addRecord" class="bg-green-500 text-white px-4 py-2 rounded">
        Add Record
      </button>
    </div>

    <table class="min-w-full border border-gray-300">
      <thead>
        <tr class="bg-gray-100">
          <th class="border px-4 py-2">ID</th>
          <th class="border px-4 py-2">Vehicle</th>
          <th class="border px-4 py-2">Fuel (Price)</th>
          <th class="border px-4 py-2">Date</th>
          <th class="border px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="record in records" :key="record.id">
          <td class="border px-4 py-2">{{ record.id }}</td>
          <td class="border px-4 py-2">{{ record.vehicle.vehicle_number }}</td>
          <td class="border px-4 py-2">{{ record.price }}</td>
          <td class="border px-4 py-2">{{ record.fuel_date }}</td>
          <td class="border px-4 py-2">
            <button
              @click="deleteRecord(record.id)"
              class="bg-red-500 text-white px-2 py-1 rounded"
            >
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    <div v-if="loading" class="mt-4 text-blue-500 font-semibold">Loading...</div>
    <div v-if="error" class="mt-4 text-red-500 font-semibold">{{ error }}</div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted } from 'vue'
import axios from 'axios'

interface FuelRecord {
  id: number
  price: number
  fuel_date: string
  vehicle: []
}

export default defineComponent({
  name: 'App',
  setup() {
    const records = ref<FuelRecord[]>([])
    const loading = ref(false)
    const error = ref('')

    const fetchRecords = async () => {
      loading.value = true
      error.value = ''
      try {
        const response = await axios.get<FuelRecord[]>('http://127.0.0.1:8000/api/fuel-records')
        records.value = response.data
        console.log(records.value)
      } catch (err: any) {
        error.value = err.message || 'Failed to fetch records'
      } finally {
        loading.value = false
      }
    }

    const addRecord = async () => {
      // Temporary example data
      const newRecord = {
        vehicle_id: 1, // existing vehicle id
        price: 5000,
        fuel_date: new Date().toISOString().split('T')[0],
      }
      try {
        await axios.post('http://127.0.0.1:8000/api/fuel-records', newRecord)
        fetchRecords()
      } catch (err: any) {
        error.value = err.message || 'Failed to add record'
      }
    }

    const deleteRecord = async (id: number) => {
      try {
        await axios.delete(`http://127.0.0.1:8000/api/fuel-records/${id}`)
        fetchRecords()
      } catch (err: any) {
        error.value = err.message || 'Failed to delete record'
      }
    }

    onMounted(() => {
      fetchRecords()
    })

    return {
      records,
      loading,
      error,
      fetchRecords,
      addRecord,
      deleteRecord,
    }
  },
})
</script>

<style scoped>
table {
  border-collapse: collapse;
}
th,
td {
  text-align: left;
}
</style> -->
