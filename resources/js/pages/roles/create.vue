<template>
    <div class="vue-template">
        <form @submit.prevent="postRole">
            <h3>Create Role</h3>
 
            <div class="form-group">
                <label>Role Name</label>
                <input type="text" v-model="role_name" class="form-control form-control-lg"/>
            </div>
 
            <div class="form-group">
                <label>Role Description</label>
                <input type="text" v-model="role_description" class="form-control form-control-lg"/>
            </div>
           
            <button type="submit" class="btn btn-dark btn-lg btn-block">Create Role</button>
        </form>
    </div>
</template>
<script>
import axios from 'axios'
    export default {
    data() {
        return {
            role_name:"",
            role_description:""
            
        }
    },
    mounted() {
        console.log('Component mounted.')
        
    },
    methods: {
        async postRole(e){
            e.preventDefault();

            await axios.post('api/role',{
               role_name: this.role_name,
               role_description: this.role_description,})
            .then((response)=>{
            this.role =response.data.data;
            console.log(response.data.data)
            })
            .catch((error)=> {
            console.log(error)
            })
        }
    }
} 
</script>