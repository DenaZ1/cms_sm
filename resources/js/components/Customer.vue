<template>
    <div>
          <!-- Displaying customer details -->
        <h5 id="associating-form-text-with-form-controls">Name:</h5>
        <h6>{{ customer.name }}</h6>
        <h5 id="associating-form-text-with-form-controls">Address:</h5>
        <h6>{{ customer.address }}</h6>
        <h5 id="associating-form-text-with-form-controls">Phone Number:</h5>
        <h6>{{ customer.phone_num }}</h6>
        <h5 id="associating-form-text-with-form-controls">Free Trial:</h5>
        <h6>{{ customer.free_trial }}</h6>
        <h5 id="associating-form-text-with-form-controls">Start Date:</h5>
        <h6>{{ customer.start_date }}</h6>
        <h5 id="associating-form-text-with-form-controls">Note:</h5>
        <p>{{ customer.note }}</p>
        <h5 id="associating-form-text-with-form-controls">Created By User:</h5>
        <h6>{{ customer.created_by_user }}</h6>

        <router-link :to="`/customers/${customer.id}/edit`" class="btn btn-primary">Edit</router-link><!-- Link to edit the customer using the customer ID -->
       
    </div>
</template>

<script>
import axios from 'axios';

export default {
data() {
    return {
    customer: {}
    }
},
async created() {
    try {
    // Getting the customer ID from the route params
    const response = await axios.get(`/api/customers/${this.$route.params.id}`);
    this.customer = response.data;  // Updating the customer object with the fetched customer data
    } catch (error) {
    console.error(error);
    }
}
}
</script>