<script setup>
import { ref } from 'vue'
import api from '../services/api'
import NavbarLayout from '../components/NavbarLayout.vue'

// Form inputs
const platePrefix = ref('1')
const plateLetter = ref('A')
const plateNumber = ref('')

// Result data
const record = ref(null)
const searched = ref(false) // စစ်ဆေးပြီးကြောင်း အချက်ပြရန်

const checkFuelStatus = async () => {
  if (!plateNumber.value) return alert('ကားနံပါတ် ထည့်ပေးပါ')

  try {
    // API ကို query parameter တွေနဲ့ လှမ်းခေါ်မယ်
    const res = await api.get('/check-fuel', {
      params: {
        prefix: platePrefix.value,
        letter: plateLetter.value,
        number: plateNumber.value,
      },
    })

    record.value = res.data // data ရှိရင် record ထဲထည့်မယ် (ဥပမာ- { times: 1, updated_at: '...' })
    searched.value = true
  } catch (error) {
    console.error('Check Error:', error)
    alert('ရှာမတွေ့ပါ သို့မဟုတ် Error တက်နေပါသည်')
    record.value = null
  }
}

// ရက်စွဲ format ပြင်ရန်
const formatDate = (dateString) => {
  if (!dateString) return '-'
  const date = new Date(dateString)
  return date.toLocaleString('en-GB') // 12/05/2026, 15:30:00
}
</script>

<template>
  <div>
    <NavbarLayout></NavbarLayout>
    <div class="container">
      <!-- @submit.prevent သုံးထားလို့ page refresh မဖြစ်တော့ပါ -->
      <form @submit.prevent="checkFuelStatus">
        <label>Enter Plate Serial Number</label>
        <div class="plateSerial-list">
          <select v-model="platePrefix">
            <option v-for="n in 9" :key="n" :value="n">{{ n }}</option>
          </select>

          <select v-model="plateLetter">
            <option v-for="char in 'ABCDEFGHIJKLMNOPQRST'" :key="char" :value="char">
              {{ char }}
            </option>
          </select>

          <input v-model="plateNumber" type="text" placeholder="1234" /> <br />
          <button type="submit">Check</button>
        </div>
      </form>

      <!-- ရှာဖွေပြီးမှသာ ဒီအပိုင်းကို ပြပါမယ် -->
      <div v-if="searched && record" class="status-box">
        <p class="left-times">လက်ကျန်အကြိမ်ရေ: {{ 3 - record.times }} ကြိမ်</p>

        <!-- Logic: အခေါက်ရေ ၃ ဆိုရင် Full Time ပြမယ်၊ ၀-၂ ဆိုရင် Has Time ပြမယ် -->
        <p v-if="record.times >= 3" class="full-time">
          ယနေ့အတွက် အဆီဖြည့်ခွင့်မရှိတော့ပါ (Full Time)
        </p>
        <p v-else class="has-time">အဆီဖြည့်ခွင့်ရှိသေးသည်</p>

        <p class="last-time">နောက်ဆုံး အဆီဖြည့်သည့် အချိန်: {{ formatDate(record.updated_at) }}</p>
      </div>

      <div v-else-if="searched" class="status-box">
        <p>ယနေ့အတွက် မှတ်တမ်း မရှိသေးပါ။ (အဆီဖြည့်နိုင်ပါသည်)</p>
      </div>
    </div>
  </div>
</template>
<style scoped>
.container {
  width: 500px;
  height: auto;
  display: flex;
  flex-direction: column;
  margin: 50px auto;
  align-items: center;
  border: 2px solid #ccc;
  border-radius: 10px;
}
form {
  height: 80px;
  margin-top: 10px;
  font-size: 20px;
}
.left-times {
  color: #007bff;
  font-weight: 600;
}
.has-time {
  color: #28a745;
  font-weight: 600;
}
.full-time {
  color: #dc3545;
  font-weight: 600;
}
.last-time {
  color: #6c757d;
  font-weight: 700;
}
</style>