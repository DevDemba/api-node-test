<template>
    <div class="container fluid">
        <h2>Dashboard</h2><br>
        <p>Lastname: {{ user[0].lastname }}</p>
        <p>Fisrtname: {{ user[0].firstname }}</p>
        <p>Email: {{ user[0].email }}</p>
        <p>Address: {{ user[0].address }}</p>
        <p>Phone: {{ user[0].phone }}</p>
        <p>Birthday: {{ user[0].birthday| birthday }}</p>
        <p>License driver: {{ user[0].license_driver }}</p>
        <p>Date of register: {{ user[0].register_date | formatDate}}</p>
        <p><strong>Point: {{ user[0].point }}</strong></p>
    </div>
</template>

<script>
import axios from 'axios';

export default {

  name: 'Dashboard',
  data () {
    return {
      user: []
    }
  },
  created() {
      this.user = JSON.parse(localStorage.getItem('user'));
      console.log(this.user)

    /* axios.get('/api/users/:id')
    .then(response => {
      this.user = response.data.data;
       console.log(response)
    })
    .catch(e => {
      this.errors = e;
      router.push('/');
    }) */
   // this.showProfile()
  }
}
</script>
