<!-- <template>
  <div>
    <NavbarLayout />
    <div class="dashboard">
      <table class="table">
        <caption class="tbCapt">
          <h1>Fuel Record Management</h1>
        </caption>

        <thead>
          <tr>
            <th scope="col">Total Vehicles</th>
            <th scope="col">Total liters</th>
            <th scope="col">Total Prices</th>
            <th scope="col">Date</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>1000</td>
            <td>10,000</td>
            <td>500,000</td>
            <td>8.5.2026</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import NavbarLayout from '../components/NavbarLayout.vue'

export default {
  name: 'dashboard',
  components: {
    NavbarLayout,
  },
}
</script>

<style scoped>
.dashboard {
  width: 1000px;
  height: auto;
  margin: 50px auto;
  border: 2px solid #ccc;
  border-radius: 10px;
}
.table {
  widows: auto;
  margin: 20px auto;
  /* border: 2px solid yellow; */
}
.table .tbCapt {
  color: blue;
  width: 800px;
}
.table th {
  border: 2px solid grey;
}
.table tr {
  color: darkslategrey;
  margin: 2px auto;
  text-align: center;
  border: 3px solid brown;
}
/* td {
  border: 1px solid rgb(221, 78, 78);
} */
</style> -->

<template>
  <div>
    <NavbarLayout />
    <div class="dashboard">
      <table class="table">
        <caption class="tbCapt">
          <h1>Daily Fuel Records Summary</h1>
        </caption>

        <thead>
          <tr>
            <th scope="col">Date</th>
            <th scope="col">Total Vehicles</th>
            <th scope="col">Total Liters</th>
            <th scope="col">Total Prices</th>
          </tr>
        </thead>

        <tbody>
          <!-- နေ့စဉ်အလိုက် data များကို loop ပတ်ပြီး ပြပါမည် -->
          <tr v-for="(stat, index) in stats" :key="index">
            <td>{{ formatDate(stat.date) }}</td>
            <td>{{ stat.total_vehicles }}</td>
            <td>{{ parseFloat(stat.total_liters).toLocaleString() }} L</td>
            <td>{{ parseInt(stat.total_prices).toLocaleString() }} MMK</td>
          </tr>

          <!-- Data မရှိသေးလျှင် ပြရန် -->
          <tr v-if="stats.length === 0">
            <td colspan="4">No daily records found.</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import NavbarLayout from '../components/NavbarLayout.vue'
import axios from 'axios'

export default {
  name: 'dashboard',
  components: {
    NavbarLayout,
  },
  data() {
    return {
      stats: [], // Array ဖြစ်သွားပါပြီ
    }
  },
  mounted() {
    this.fetchDailyData()
  },
  methods: {
    async fetchDailyData() {
      try {
        const res = await axios.get('http://127.0.0.1:8000/api/dashboard-stats')
        this.stats = res.data
      } catch (error) {
        console.error('Error fetching daily stats:', error)
      }
    },
    // ရက်စွဲကို ပိုကြည့်ကောင်းအောင် format လုပ်ရန်
    formatDate(dateString) {
      const options = { year: 'numeric', month: 'short', day: 'numeric' }
      return new Date(dateString).toLocaleDateString('en-GB', options)
    },
  },
}
</script>

<style scoped>
.dashboard {
  width: 1000px;
  height: auto;
  margin: 50px auto;
  border: 2px solid #ccc;
  border-radius: 10px;
}
.table {
  widows: auto;
  margin: 20px auto;
  /* border: 2px solid yellow; */
}
.table .tbCapt {
  color: blue;
  width: 800px;
}
.table th {
  border: 2px solid grey;
}
.table tr {
  color: darkslategrey;
  margin: 2px auto;
  text-align: center;
  border: 3px solid brown;
}
/* td {
  border: 1px solid rgb(221, 78, 78);
} */
</style> 