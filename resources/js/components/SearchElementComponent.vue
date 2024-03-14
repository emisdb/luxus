<template>
    <div class="table-responsive pt-3">
        <el-button type="primary" :icon="Search" @click="search" class="searcher">Search</el-button>

        <el-table :data="results"  style="width: 100%">
            <el-table-column prop="name" width="180">
                <template #header>
                    <el-input
                        v-model="filters.name"
                        style="width: 160px"
                        placeholder="Name"
                        clearable
                    />
                </template>
            </el-table-column>
            <el-table-column prop="price" width="180">
                <template #header>
                    <div>
                        <el-input-number v-model="filters.min_price" :min="1" placeholder="Min Price"/>
                    </div>
                    <div>
                        <el-input-number v-model="filters.max_price" :min="1" placeholder="Max Price"/>
                    </div>
                </template>
            </el-table-column>
            <el-table-column prop="bedrooms">
                <template #header>
                    <el-input-number v-model="filters.bedrooms" :min="1" :max="100" placeholder="Bedrooms"/>
                </template>
            </el-table-column>
            <el-table-column prop="bathrooms">
                <template #header>
                    <el-input-number v-model="filters.bathrooms" :min="1" :max="10" placeholder="Bathrooms"/>
                </template>
            </el-table-column>
            <el-table-column prop="storeys">
                <template #header>
                    <el-input-number v-model="filters.storeys" :min="1" :max="100" placeholder="Storeys"/>
                </template>
            </el-table-column>
            <el-table-column prop="garages">
                <template #header>
                    <el-input-number v-model="filters.garages" :min="1" :max="10" placeholder="Garages"/>
                </template>
            </el-table-column>
        </el-table>
        <div v-if="searching" class="search-indicator">
            <i class="fas fa-spinner fa-spin"></i> Searching...
        </div>
    </div>

</template>

<script>
import {defineComponent} from 'vue'
import {ElConfigProvider} from 'element-plus'
import { Search} from '@element-plus/icons-vue'

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
            setTimeout(() => {
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
            }, 2000); // Simulate 1-second delay (replace with actual API call)
        }
    }
}
defineComponent({
    components: {
        ElConfigProvider,
    },
    setup() {
        return {
            zIndex: 3000,
            size: 'medium',
        }
    },
})
</script>
<style>

button.searcher {
    width: 200px;
}

.el-table td.el-table_1_column_2 div,
.el-table td.el-table_1_column_3 div,
.el-table td.el-table_1_column_4 div,
.el-table td.el-table_1_column_5 div,
.el-table td.el-table_1_column_6 div {
    text-align: right;
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
