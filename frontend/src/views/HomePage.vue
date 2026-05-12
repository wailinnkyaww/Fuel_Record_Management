<template>
  <div>
    <NavbarLayout></NavbarLayout>
    <div class="home-page">
      <div class="home">
        <h1 class="ttl">Welcome to the Fuel Record Management System</h1>
        <p class="desc">Please login to access your dashboard and manage your fuel records.</p>
      </div>
      <div>
        <img src="../assets/images/homeBg1.jpg" alt="" />
      </div>
    </div>
  </div>
</template>

<script>
import NavbarLayout from '../components/NavbarLayout.vue'

export default {
  components: {
    NavbarLayout,
  },
}
</script>

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
.home-page {
  display: grid;
  grid-template-columns: 900px 500px 1fr 1fr;
  align-items: center;
  margin-left: 80px;
}
img {
  width: 500px;
  height: 500px;
  border: 2px solid #ccc;
}
.home {
  width: 900px;
  height: 500px;
  margin: 50px auto;
  border: 2px solid #ccc;
  border-top-left-radius: 10px;
}
.ttl {
  text-align: center;
  margin-top: 50px;
}
.desc {
  text-align: center;
  margin: 20px auto;
  font-size: 1.2rem;
  color: #555;
}
</style>