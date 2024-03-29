<template>
    <div>
        <h3>Редакция задачи</h3>
        <form @submit.prevent="submitForm">
            <div class="form-group">
                <label for="name">Задача:</label>
                <input type="text" id="name" v-model="formData.name" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">Описание:</label>
                <textarea id="description" v-model="formData.description" class="form-control" rows="5"></textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="completion_date">Выполнить:</label>
                        <input type="date" id="completion_date" v-model="formData.completion_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="status">Статус:</label>
                        <select id="status" v-model="formData.status" class="form-control">
                            <option value="new">New</option>
                            <option value="in_progress">In Progress</option>
                            <option value="complete">Complete</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="user_id">Назначена:</label>
                        <select id="user_id" v-model="formData.user_id" class="form-control">
                            <option v-for="user in users" :value="user.id">{{ user.name }}</option>
                         </select>
                     </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            formData: {
                id: null,
                name: '',
                description: '',
                completion_date: null,
                status: 'new',
                user_id: null
            },
            users: [],
            taskId: null
        };
    },
    methods: {
        async submitForm() {
            try {
                var action = `/api/task`
                if (this.taskId) {
                    action = action + `/${this.taskId}`
                    const response = await axios.put(action, this.formData);
                } else {
                    const response = await axios.post(action, this.formData);
                }
               this.$router.push('/noveo')
            } catch (error) {
                console.error('Error updating task:', error);
                // Handle error: display error message, revert changes, etc.
            }
        },
        async initData(){
            try {
                var action = `/api/users`
                const response = await axios.get(action);
                this.users = response.data;
            } catch (error) {
                console.error('Error fetching data:', error);
                // Set searching flag to false in case of error
                this.searching = false;
            }

        },
        async fillData(){
            try {
                var action = `/api/task/${this.taskId}`
                const response = await axios.get(action);
                this.formData = response.data.data;
            } catch (error) {
                console.error('Error fetching data:', error);
                // Set searching flag to false in case of error
                this.searching = false;
            }

        }

    },
    mounted() {
        this.initData()
        this.taskId = this.$route.params.id;
        if(this.taskId) this.fillData()
    }
};
</script>

<style scoped>
/* Add custom styles here */
</style>
