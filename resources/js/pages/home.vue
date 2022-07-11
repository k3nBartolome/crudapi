<template>
    <button @click="logout">Logout</button> 
    <button><router-link to="/login">Login</router-link></button>
    <button><router-link to="/Role/index">Role List</router-link></button>
    <button><router-link to="/user/index">User List</router-link></button>
    <br>
    <router-view></router-view>
    
</template>

<script>
import { mapMutations } from "vuex";
export default {
    data() {
        return {
            users: false
        }
    },
    mounted() {
        console.log('Component mounted.')
        this.getUsers()
    },
    methods: {
        async getUsers() {
            await axios.get('/api/users')
                .then((response) => {
                    this.users = response.data.data;
                    console.log(response.data.data)
                })
                .catch((error) => {
                    console.log(error)
                })
        },
        ...mapMutations(["setLogout"]),
        logout() {
            this.setLogout()
            this.$router.push("/login");
        }
    }
}
</script>