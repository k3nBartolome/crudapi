<template>
    <div class="vue-template">
        <form @submit.prevent="postUser">
            <h3>Create User</h3>
 
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
                <input type="password" v-model="password" class="form-control form-control-lg" />
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" v-model="confirmpassword" class="form-control form-control-lg" />
            </div>
 
            <button type="submit" class="btn btn-dark btn-lg btn-block">Create User</button>
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
        async postUser(e){
            e.preventDefault();

            await axios.post('api/user',{
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
        }
    }
}
</script>