<template>
    <div class="vue-template">
        <form @submit.prevent="putUser">
            <h3>Update User</h3>
 
            <div class="form-group">
                <label>Lastname</label>
                <input type="text" v-model="lname" class="form-control form-control-lg"/>
            </div>
 
            <div class="form-group">
                <label>Firstname</label>
                <input type="text" v-model="fname"  class="form-control form-control-lg"/>
            </div>
            <div class="form-group">
                <label>Middlename</label>
                <input type="text" v-model="mname"  class="form-control form-control-lg"/>
            </div>
            <div class="form-group">
                <label>Role</label>
                <select v-model="roles_selected" class="form-control"  @change="getRoles">
                    <option disabled value="" selected="selected">Please select one</option>
                    <option v-for="role in roles"  v-bind:value="role.id">{{ role.role_name}}</option>
                </select>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" v-model="email" class="form-control form-control-lg"/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" v-model="password" min="8" class="form-control form-control-lg" />
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" v-model="confirmpassword" min="8" class="form-control form-control-lg" />
            </div>
 
            <button type="submit" class="btn btn-dark btn-lg btn-block">Update User</button>
        </form>
    </div>
</template>
 
<script>
import axios from 'axios'

    export default {
    data() {
        return {
            roles_selected:"",
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
        async putUser(e){
            e.preventDefault();

            await axios.put("api/users/"+ this.$route.params.id,{
                lname: this.lname,
                fname: this.fname,
                mname: this.mname,
                role_id:this.roles_selected,
                email: this.email,
                password: this.password,
                confirmpassword: this.confirmpassword,})
            .then((response)=>{
            this.user =response.data.data;
            console.log(response.data.data)
            })
            .catch((error)=> {
            console.log(error)
            })
        },
        async getUsers(){
            await axios.get("api/users/"+ this.$route.params.id,)
            .then((response)=>{
            this.lname =response.data.data.lname;
            this.fname =response.data.data.fname;
            this.mname =response.data.data.mname;
            this.role_selected =response.data.data.role_selected;
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