<!-- ExampleComponent.vue -->
<template>
    <div>
        <h2>Your component runs again!</h2>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log('Component mounted.');
    }
}
</script>
<style scoped>
h2 {
    background-color: #00ad81;
    font-size: 1.2em;
    color: #2fff8a;
}
</style>
