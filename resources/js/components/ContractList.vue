<template>
    <div> 
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Start Date</th>
                <th scope="col">Expire Date</th>
                <th scope="col">Payment</th>
                <th scope="col">Note</th>
                <th scope="col">Created By User</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
                 <!-- Looping through contracts and displaying each contract's details -->
                <tr v-for="contract in contracts" :key="contract.id">
                    <td>{{ contract.id }}</td>
                    <td>{{ contract.start_date }}</td>
                    <td>{{ contract.expire_date }}</td>
                    <td>{{ contract.payment }}</td>
                    <td>{{ contract.note }}</td>
                    <td>{{ contract.created_by_user }}</td>
                    <td>
                      <div class="row gap-3">
                        <!-- Link to edit contract page with customer_id and contract_id -->
                        <router-link :to="`/contracts/${this.$route.params.customer_id}/${contract.id}/edit`" class="p-2 col border btn btn-success">Edit</router-link>
                        <button @click="deleteContract(contract.id)" type="button" class="p-2 col border btn btn-danger">Delete</button>
                      </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      contracts: []
    };
  },

  async created() {
    try {
      // Getting the customer_id from route params to fetch contracts for a specific customer
      const customer_id = this.$route.params.customer_id; 
      const response = await axios.get(`/api/contracts/${customer_id}`); // Make an API request to get the contracts associated with the customer_id
      this.contracts = response.data; // Update the contracts array with the response data
    } catch (error) {
      console.error(error);
    }
  },
  methods: {
    async deleteContract(id) {
      try {
         // Deleting the contract 
        await axios.delete(`/api/contracts/${id}`);
        this.contracts = this.contracts.filter(contract => contract.id !== id); // Updating the contracts list by filtering out the deleted contract
      } catch (error) {
        console.error(error);
      }
    }
  }
};
</script>