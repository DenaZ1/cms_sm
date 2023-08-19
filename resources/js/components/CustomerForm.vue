<template>
    <div>
      <!-- Display appropriate header based on whether it's a new customer or an existing customer to edit it -->
      <h2 v-if="isNewCustomer">Add Customer</h2>
      <h2 v-else>Edit Customer</h2>
        <form @submit.prevent="submitForm">
          <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input class="form-control" type="text" id="name" v-model="customer.name" required />
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Address:</label>
            <input class="form-control" type="text" id="address" v-model="customer.address" required />
          </div>
          <div class="mb-3">
            <label for="phone_num" class="form-label">Phone Number:</label>
            <input class="form-control" type="text" id="phone_num" v-model="customer.phone_num" required />
          </div>
          <div class="mb-3">
            <label for="free_trial" class="form-label">Free Trial:</label>
            <input class="form-control" type="text" id="free_trial" v-model="customer.free_trial" required />
          </div>
          <div class="mb-3">
            <label for="start_date" class="form-label">Start Date:</label>
            <input class="form-control" type="date" id="start_date" v-model="customer.start_date" required />
          </div>
          <div class="mb-3">
            <label for="note" class="form-label">Note:</label>
            <textarea class="form-control" id="note" v-model="customer.note" required></textarea>
          </div>
          <div class="mb-3">
            <label for="created_by_user" class="form-label">Created By User:</label>
            <input class="form-control" type="text" id="created_by_user" v-model="customer.created_by_user" required />
          </div>

          <!-- Submit button based on whether it's a new customer or existing customer -->
          <button type="submit" v-if="isNewCustomer" class="btn btn-primary">Add Customer</button>
          <button type="submit" v-else class="btn btn-primary">Update Customer</button>
          
        </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        customer: {
          name: '',
          address: '',
          phone_num: '',
          free_trial: '',
          start_date: '',
          note: '',
          created_by_user: ''
        }
      }
    },
    computed: {
        isNewCustomer() {
        //checking if it's a new customer or an existing customer (edit) based on the route path
        return !this.$route.path.includes('edit');
      }
    },
    async created() {
      // Fetching customer details for editing if it's not a new customer or existing customer
      if (!this.isNewCustomer) {
        const response = await axios.get(`/api/customers/${this.$route.params.id}`);
        this.customer = response.data;
      }
    },
    methods: {
      async submitForm() {
        try {
          if (this.isNewCustomer) {
            await axios.post('/api/customers', this.customer);// Adding a new customer
          } else {
            await axios.put(`/api/customers/${this.$route.params.id}`, this.customer);// Updating an existing customer
          }
          this.$router.push('/');// Redirect to the home page after submission
        } catch (error) {
          console.error(error);
        }
      }
    }
  }
  </script>