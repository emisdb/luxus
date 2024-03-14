<template>
    <div class="table-responsive pt-3">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>
                    <input type="text" v-model="filters.name" placeholder="Name">
                </th>
                <th class="number">
                    <div>
                        <input type="number" v-model="filters.min_price" placeholder="Min Price">
                    </div>
                    <div>
                        <input type="number" v-model="filters.max_price" placeholder="Max Price">
                    </div>
                </th>
                <th class="number">
                    <input type="number" v-model="filters.bedrooms" placeholder="Bedrooms">
                </th>
                <th class="number">
                    <input type="number" v-model="filters.bathrooms" placeholder="Bathrooms">
                </th>
                <th class="number">
                    <input type="number" v-model="filters.storeys" placeholder="Storeys">
                </th>
                <th class="number">
                    <input type="number" v-model="filters.garages" placeholder="Garages">
                </th>
                <th class="number">
                    <button @click="search">Search</button>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="property in results" :key="property.id">
                <td>{{ property.name }}</td>
                <td class="number">{{ property.price }}</td>
                <td class="number">{{ property.bedrooms }}</td>
                <td class="number">{{ property.bathrooms }}</td>
                <td class="number">{{ property.storeys }}</td>
                <td class="number">{{ property.garages }}</td>
            </tr>
            </tbody>
        </table>
        <div v-if="searching" class="search-indicator">
            <i class="fas fa-spinner fa-spin"></i> Searching...
        </div>

        <!-- Display message if no results found -->
        <div v-if="!searching && results.length === 0" class="no-results-message">
            No results found.
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            filters: {
                name: '',
                min_price: null,
                max_price: null,
                bedrooms: null,
                bathrooms: null,
                storeys: null,
                garages: null
            },
            results: [],
            searching: false
        }
    },
    methods: {
        search() {
            this.searching = true;
            // Construct the query based on the values in the input fields
            const query = Object.entries(this.filters)
                .filter(([key, value]) => value !== null && value !== '')
                .map(([key, value]) => `${key}=${encodeURIComponent(value)}`)
                .join('&');

            // Make AJAX request to API
            fetch(`/api/property-data?${query}`)
                .then(response => response.json())
                .then(data => {
                    this.results = data.data;
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
            this.searching = false;
        }
    }
}
</script>
<style scoped>
th input {
    width: 80px;
}

td.number, th.number {
    text-align: right;
    padding: 5px 10px;
}

.search-indicator {
    margin-top: 10px;
    color: #666;
}

/* Styles for no results message */
.no-results-message {
    margin-top: 10px;
    color: #f00;
}

.fa-spinner {
    animation: fa-spin 2s infinite linear;
}
</style>
