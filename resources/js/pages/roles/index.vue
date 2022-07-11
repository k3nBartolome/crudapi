<template>
    <br>
    <button>
        <router-link to="/role/add">Add Role</router-link>
    </button>
    <br>
    <table class="min-w-full border divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50">
                    <span class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">
                        ID</span>
                </th>
                <th class="px-6 py-3 bg-gray-50">
                    <span class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">
                        Role Name</span>
                </th>
                <th class="px-6 py-3 bg-gray-50">
                    <span class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">First
                        Role Description</span>
                </th>
                <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Actions</span>
                </th>
            </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200 divide-solid">
            <template v-for="role in roles" :key="role.id">
                <tr class="bg-white">
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ role.id }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ role.role_name }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ role.role_description }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        <button @click="deleteRoles(role.id)"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Delete</button>
                        <button @click="getRoles(role.id)"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <router-link :to="`/role/update/${role.id}`">Update</router-link>
                        </button>
                        <button @click="getRoles(role.id)"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <router-link :to="`/role/show/${role.id}`">View</router-link>
                        </button>
                    </td>
                </tr>
            </template>
        </tbody>
    </table>
</template>
<script>
import axios from 'axios'

const instance = axios.create({
  withCredentials: true
})
import { mapMutations } from "vuex";

export default {
    data() {
        return {
            roles: "",

        }
    },
    mounted() {
        console.log('Component mounted.')
        this.getRoles()
    },
    methods: {
        async getRoles() {
            await axios.get('/api/roles')
                .then((response) => {
                    this.roles = response.data.data;
                    console.log(response.data.data)
                })
                .catch((error) => {
                    console.log(error)
                })
        },
        async deleteRoles(id) {
            await axios.delete("/api/role/" + id,{withCredentials: true})
                .then((response) => {
                    this.roles = response.data.data;
                    console.log(response.data.data)
                    this.getRoles();
                })
                .catch((error) => {
                    console.log(error)
                }),
                await axios.get('/oauth/personal-access-tokens')
                .then(response => {
                console.log(response.data);
    });
        },

    }
}
</script>