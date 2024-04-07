<!-- ExampleComponent.vue -->
<template>
    <div class="container">
        <h2>Your component runs again!</h2>
        <h3 v-if="authData != null">
            {{ authData.name }}
        </h3>
        <button class="btn btn-outline-info btn-sm" @click="testAction()"><i
            class="mdi mdi-account-check-outline text-primary"></i></button>
    </div>
</template>

<script>
import API from './../../api'
export default {
    data() {
        return {
            authData: {}
        }
    },
    methods: {
        testAction() {
            API.post('/api/auth/me')
                .then(response => {
                    this.authData = response.data
                })
                .catch(error => {
                    console.error(error)
                })
        },
    },
    mounted() {
        console.log('Component mounted.');
    }
}
</script>
<style scoped>
h2 {
    background-color: #1a202c;
    font-size: 1.2em;
    color: #2fff8a;
}
</style>
