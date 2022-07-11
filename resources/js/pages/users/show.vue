<template>
    <div class="vue-template">
        <form > 
            <h3>View User</h3>
 
            <div class="form-group">
                <label>Lastname</label>
                <input type="text" v-model="lname" class="form-control form-control-lg" disabled/>
            </div>
 
            <div class="form-group">
                <label>Firstname</label>
                <input type="text" v-model="fname"  class="form-control form-control-lg" disabled/>
            </div>
            <div class="form-group">
                <label>Middlename</label>
                <input type="text" v-model="mname"  class="form-control form-control-lg" disabled/>
            </div>
            <div class="form-group">
                <label>Role</label>
                <input type="text" v-model="role_id"  class="form-control form-control-lg" disabled/>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" v-model="email" class="form-control form-control-lg" disabled/>
            </div>
        </form>
    </div>
</template>
 
<script>
import axios from 'axios'

    export default {
    data() {
        return {
            role_id:"",
            lname:"",
            fname:"",
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
        this.getUsers()
        
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

        async getUsers(){
            await axios.get("api/users/"+ this.$route.params.id,)
            .then((response)=>{
            this.lname =response.data.data.lname;
            this.fname =response.data.data.fname;
            this.mname =response.data.data.mname;
            this.role_id =response.data.data.role_id;
            this.email =response.data.data.email;
            this.password =response.data.data.password;
            this.confirmpassword =this.confirmpassword;
            console.log(response.data.data)
            })
            .catch((error)=> {
            console.log(error)
            })
        }
    }
}
</script>