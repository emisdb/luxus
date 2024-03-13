<!-- SearchComponent.vue -->
<template>
    <div>
        <input type="text" v-model="query" placeholder="Search query">
        <button @click="search">Search</button>

        <table v-if="results.length">
            <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Bedrooms</th>
                <th>Bathrooms</th>
                <th>Storeys</th>
                <th>Garages</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="property in results" :key="property.id">
                <td>{{ property.name }}</td>
                <td>{{ property.price }}</td>
                <td>{{ property.bedrooms }}</td>
                <td>{{ property.bathrooms }}</td>
                <td>{{ property.storeys }}</td>
                <td>{{ property.garages }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            query: '',
            results: []
        }
    },
    methods: {
        search() {
            // Make AJAX request to API
            fetch('/api/property-data?' + this.query)
                .then(response => response.json())
                .then(data => {
                    this.results = data.data;
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }
    }
}
</script>
