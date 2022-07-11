<template>
    <div class="vue-template">
        <form @submit.prevent="putRole">
            <h3>Create Role</h3>
 
            <div class="form-group">
                <label>Role Name</label>
                <input type="text" v-model="role_name" class="form-control form-control-lg"/>
            </div>
 
            <div class="form-group">
                <label>Role Description</label>
                <input type="text" v-model="role_description"  class="form-control form-control-lg"/>
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
            roles_selected:"",
            role_name:"",
            role_description:"",
            mname:"",
            roles:"",
            email:"",
            password:"",
            confirmpassword:"",
        }
    },
    mounted() {
        console.log('Component mounted.')
        this.getRoles()
        this.getRoles()
        
    },
    methods: {
        async putRole(e){
            e.preventDefault();

            await axios.put("api/roles/"+ this.$route.params.id,{
                role_name: this.role_name,
                role_description: this.role_description,})
            .then((response)=>{
            this.role =response.data.data;
            console.log(response.data.data)
            })
            .catch((error)=> {
            console.log(error)
            })
        },
        async getRoles(){
            await axios.get("api/roles/"+ this.$route.params.id,)
            .then((response)=>{
            this.role_name =response.data.data.role_name;
            this.role_description =response.data.data.role_description;
            console.log(response.data.data)
            })
            .catch((error)=> {
            console.log(error)
            })
        }
    }
}
</script>