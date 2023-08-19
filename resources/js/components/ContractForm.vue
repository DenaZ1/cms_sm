<template>
    <div>
      <!-- Display appropriate header based on whether it's a new contract or an existing contract to edit it -->
      <h2 v-if="isNewContract">Add Contract</h2>
      <h2 v-else>Edit Contract</h2>
        <form @submit.prevent="submitForm">
          <div class="mb-3">
            <label for="start_date" class="form-label">Start Date:</label>
            <input class="form-control" type="date" id="start_date" v-model="contract.start_date" required />
          </div>
          <div class="mb-3">
            <label for="expire_date" class="form-label">Expire Date:</label>
            <input class="form-control" type="date" id="expire_date" v-model="contract.expire_date" required />
          </div>
          <div class="mb-3">
            <label for="payment" class="form-label">Payment</label>
            <input class="form-control" type="float" id="payment" v-model="contract.payment" required />
          </div>
          <div class="mb-3">
            <label for="note" class="form-label">Note:</label>
            <textarea class="form-control" id="note" v-model="contract.note" required></textarea>
          </div>
          <div class="mb-3">
            <label for="created_by_user" class="form-label">Created By User:</label>
            <input class="form-control" type="text" id="created_by_user" v-model="contract.created_by_user" required />
          </div>
          
          <!-- Submit button based on whether it's a new contract or existing contract -->
          <button type="submit" v-if="isNewContract" class="btn btn-primary">Add Contract</button>
          <button type="submit" v-else class="btn btn-primary">Update Contract</button>
          
        </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        contract: {
          start_date: '',
          expire_date: '',
          payment: 0,
          note: '',
          created_by_user: ''
        }
      }
    },
    computed: {
      isNewContract() {
         //checking if it's a new contract or an existing contract (edit) based on the route path
        return !this.$route.path.includes('edit');
      }
    },
    async created() {
      // Fetching contract data if it's not a new contract for existing contract
      if (!this.isNewContract) {
        const response = await axios.get(`/api/contracts/${this.$route.params.customer_id}/${this.$route.params.id}`);
        this.contract = response.data;
      }
    },
    methods: {
      async submitForm() {
        try {
        
          if (this.isNewContract) {
            // Creating a new contract
            const customer_id = this.$route.params.customer_id
            await axios.post(`/api/contracts/${customer_id}`,this.contract);
          } else {
            // Updating an existing contract
            const customer_id = this.$route.params.customer_id;
            const id = this.$route.params.id;
            await axios.put(`/api/contracts/${customer_id}/${id}`, this.contract);   
          }
          this.$router.push('/'); // Redirect to the main page after successful submission
        } catch (error) {
          console.error(error);
        }
      }
    }
  }
  </script>