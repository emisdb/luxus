<template>
    <div class="table-responsive pt-3">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>
                    Дата
                </th>
                <th>
                    Задача
                </th>
                <th>
                    Описание
                </th>
                <th>
                    Кому
                </th>
                <th>
                    Завершить
                </th>
                <th>
                    Статус
                </th>
                <th>
                    <button class="btn btn-sm btn-success" @click="search('')"><i
                        class="mdi mdi-table-plus text-primary"></i></button>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="property in results" :key="property.id">
                <td>{{ formatDate(property.created_at) }}</td>
                <td>{{ property.name }}</td>
                <td>{{ property.description }}</td>
                <td>{{ property.user }}</td>
                <td>{{ property.completion_date }}</td>
                <td>{{ property.status }}</td>
                <td>
                    <button class="btn btn-info btn-sm" @click="edit(property.id)"><i
                        class="mdi mdi-table-edit text-primary"></i></button>
                    <button class="btn btn-danger btn-sm" @click="remove(property.id)"><i
                        class="mdi mdi-table-remove text-primary"></i></button>
                </td>
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
        <div>
            <PaginatorComp :links="links" @resp="(msg) => paging = msg"/>
        </div>

    </div>
</template>

<script>
import PaginatorComp from './PaginatorComponent.vue'

export default {
    data() {
        return {
            filters: {
                status: '',
                user_id: null,
                completion_date: null,
            },
            results: [],
            links: {},
            searching: false,
            paging: ''
        }
    },
    components: {
        PaginatorComp
    },
    methods: {
        async search(page = '') {
            this.searching = true;

            // Construct the query based on the values in the input fields
            const query = Object.entries(this.filters)
                .filter(([key, value]) => value !== null && value !== '')
                .map(([key, value]) => `${key}=${encodeURIComponent(value)}`)
                .join('&');

            try {
                var action = `/api/task?${query}`
                if (page) {
                    action = page + `&${query}`
                }
                console.log(action)

                const response = await fetch(action);
                const data = await response.json();
                this.results = data.data;
                this.links = data.links;
                this.searching = false;
            } catch (error) {
                console.error('Error fetching data:', error);
                // Set searching flag to false in case of error
                this.searching = false;
            }
        },
        formatDate(date) {
            var today = new Date(date)
            return (('0' + today.getDate()).slice(-2) + "-" +
                ('0' + (today.getMonth() + 1)).slice(-2) + "-" +
                today.getFullYear()).toString()
        },
        edit(id) {
            alert('edit ' + id)
        },
        remove(id) {
            alert('rm ' + id)
        }
    },
    watch: {
        paging(val) {
             if (val) {
                this.search(val);
            }
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

button i.text-primary {
    font-size: 1.4em;
    color: white !important;
    font-weight: bold;
}
</style>
