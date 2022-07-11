<template>
    <div class="vue-tempalte">
        <form @submit.prevent="login">
            <h3>Login</h3>
 
            <div class="form-group">
                <label>Email address</label>
                <input type="email" v-model="email" class="form-control form-control-lg" />
            </div>
 
            <div class="form-group">
                <label>Password</label>
                <input type="password" v-model="password" class="form-control form-control-lg" />
            </div>
            <span>{{form.message}}</span>
            <button type="submit" class="btn btn-dark btn-lg btn-block">Login</button>
        </form>
    </div>
</template>
 
<script>
import { mapMutations } from "vuex";
    export default {
    data: () => {
        return {
            email: "",
            password: "",
            form:{
                message:" ",
            }
        };
    },
    methods: {
        ...mapMutations(["setUser", "setToken"]),
        async login(e) {
           e.preventDefault();
            let user;
            let token;
            let isLogin;
            await axios.post('/api/login', {
                    email: this.email,
                    password: this.password
                })
                .then(function(response) {
                    isLogin=true;
                    user = response.data.data
                    token = response.data.token
                    console.log(response.data);
                })
                .catch(function(error) {
                    console.log(error);
                    isLogin = false;
                });
                if(isLogin){
                    this.setUser(user);
                this.setToken(token);
            this.$router.push("/user/index");
                }else{
                    this.form.message="Invalid Credentials";
                }
        },
    },
};
</script>