<template>
    <div class="vue-template">
        <form>
            <h3>View Role</h3>
 
            <div class="form-group">
                <label>Role Name</label>
                <input type="text" v-model="role_name" class="form-control form-control-lg" disabled/>
            </div>
 
            <div class="form-group">
                <label>Role Description</label>
                <input type="text" v-model="role_description"  class="form-control form-control-lg" disabled/>
            </div>
        </form>
    </div>
</template>
<script>
import axios from 'axios'

    export default {
    data() {
        return {
            role_name:"",
            role_description:"",
        }
    },
    mounted() {
        console.log('Component mounted.')
        this.getRoles()
        
        
    },
    methods: {
        async getRoles() {
            console.log(this.roles_selected)
            await axios.get('/api/roles')
                .then((response) => {
                this.roles = response.data.data;
                console.log(response.data.data)
                })
                .catch((error) => {
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