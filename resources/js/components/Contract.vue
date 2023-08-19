<template>
    <div>
         <!-- Displaying contract details -->
        <h5 id="associating-form-text-with-form-controls">Start Date:</h5>
        <h6>{{ contract.start_date }}</h6>
        <h5 id="associating-form-text-with-form-controls">Expire Date:</h5>
        <h6>{{ contract.expire_date }}</h6>
        <h5 id="associating-form-text-with-form-controls">Payment:</h5>
        <h6>{{ contract.payment }}</h6>
        <h5 id="associating-form-text-with-form-controls">Note:</h5>
        <h6>{{ contract.note }}</h6>
        <h5 id="associating-form-text-with-form-controls">Created By User:</h5>
        <h6>{{ contract.created_by_user }}</h6>

        <router-link :to="`/contracts/${contract.id}/edit`" class="btn btn-primary">Edit</router-link><!-- Link to edit the contract using the contract ID -->
       
    </div>
</template>

<script>
import axios from 'axios';

export default {
data() {
    return {
        contract: {}
    }
},
async created() {
    try {
    //Getting the customer_id from route params to fetch contracts for a specific customer
    const contract_id = this.$route.params.id;
    const response = await axios.get(`/api/contracts/${contract_id}`);
    this.contract = response.data;  // Updating the contract object with the fetched contract data
    } catch (error) {
    console.error(error);
    }
}
}
</script>