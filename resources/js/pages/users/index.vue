<template>
<br>
<button><router-link to="/user/add">user</router-link></button>
<br>
    <table class="min-w-full border divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50">
                    <span class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">
                        ID</span>
                </th>
                <th class="px-6 py-3 bg-gray-50">
                    <span class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Last
                        Name</span>
                </th>
                <th class="px-6 py-3 bg-gray-50">
                    <span class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">First
                        Name</span>
                </th>
                <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Middlename</span>
                </th>
                <th class="px-6 py-3 bg-gray-50">
                    <span class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Role
                        ID</span>
                </th>
                <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Email</span>
                </th>
                <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Actions</span>
                </th>
            </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200 divide-solid">
            <template v-for="user in users" :key="user.id">
                <tr class="bg-white">
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ user.id }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ user.lname }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ user.fname }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ user.mname }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ user.role_id }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ user.email }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        <button @click="deleteUsers(user.id)"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Delete</button>
                        <button @click="getUsers(user.id)"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <router-link :to="`/user/update/${user.id}`">Update</router-link></button>
                        <button @click="getUsers(user.id)"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <router-link :to="`/user/show/${user.id}`">View</router-link></button>
                    </td>
                </tr>
            </template>
        </tbody>
    </table>
</template>
<script>
import axios from 'axios'
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
        async deleteUsers(id) {
            await axios.delete("/api/user/" + id)
                .then((response) => {
                    this.users = response.data.data;
                    console.log(response.data.data)
                    this.getUsers();
                })
                .catch((error) => {
                    console.log(error)
                })
        },
       
    }
}
</script>