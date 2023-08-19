<template>
    <div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Free Trial</th>
                <th scope="col">Start Date</th>
                <th scope="col">Note</th>
                <th scope="col">Created By User</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- Looping through each customer in the customers array -->
                <tr v-for="customer in customers" :key="customer.id">
                    <td>{{ customer.id }}</td>
                    <td>{{ customer.name }}</td>
                    <td>{{ customer.address }}</td>
                    <td>{{ customer.phone_num }}</td>
                    <td>{{ customer.free_trial }}</td>
                    <td>{{ customer.start_date }}</td>
                    <td>{{ customer.note }}</td>
                    <td>{{ customer.created_by_user }}</td>
                    <td>
                      <div class="row gap-3">
                        <router-link :to="`/customers/${customer.id}`" class="p-2 col border btn btn-primary">View</router-link>   <!-- Link to view the customer details -->
                        <router-link :to="`/customers/${customer.id}/edit`" class="p-2 col border btn btn-success">Edit</router-link><!-- Link to edit the customer details -->
                        <router-link :to="`/contracts/${customer.id}`" class="p-2 col border btn btn-dark">Contracts</router-link><!-- Link to view contracts for the current customer -->
                        <router-link :to="`/contracts/create/${customer.id}`" class="p-2 col border btn btn-dark">Add Contract</router-link><!-- Link to add a new contract for the current customer -->              
                        <button @click="deleteCustomer(customer.id)" type="button" class="p-2 col border btn btn-danger">Delete</button>
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
        customers: []
    }
  },
  async created() {
    try {
      // Making an API request to fetch the list of customers
      const response = await axios.get('/api/customers');
      this.customers = response.data; 
    } catch (error) {
      console.error(error);
    }
  },
  methods: {
    async deleteCustomer(id) {
      try {
        // Deleting the customer 
        await axios.delete(`/api/customers/${id}`);
        this.customers = this.customers.filter(customer => customer.id !== id); // Updating the customers list by filtering out the deleted customer
      } catch (error) {
        console.error(error);
      }
    }
  }
}
</script>