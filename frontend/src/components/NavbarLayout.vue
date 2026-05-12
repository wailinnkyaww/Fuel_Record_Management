<template>
  <div class="navbar">
    <nav>
      <router-link to="/">Home</router-link><br />
      <router-link to="/dashboard">Dashboard</router-link><br />
      <router-link to="/status">Status</router-link><br />
      <router-link to="/fuelrecord">Add Records</router-link><br />
      <router-link to="/login">Login</router-link><br />
    </nav>
  </div>
</template>
<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
nav {
  display: flex;
  gap: 1rem;
  background-color: gray;
  height: 50px;
  align-items: center;
  padding-left: 50px;
}
.navbar nav a {
  display: block;
  padding: 0.5rem;
  text-decoration: none;
  color: white;
}

.navbar nav a:hover {
  /* background-color: #4b5563; */
  background-color: white;
  color: #4b5563;
  border-radius: 10px;
}
</style>