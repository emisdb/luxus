<!-- ExampleComponent.vue -->
<template>
    <div  style="display: flex; background-color: silver">
        <div v-if="links.first">
            <button type="button" class="btn btn-secondary" @click="paginate('first')"><i class="mdi mdi-chevron-double-left text-primary"></i>
            </button>
        </div>
        <div v-if="links.prev">
            <button type="button" class="btn btn-secondary" @click="paginate('prev')"><i class="mdi mdi-chevron-left text-primary"></i>
            </button>
        </div>
        <div v-if="links.next">
            <button type="button" class="btn btn-secondary" @click="paginate('next')"><i class="mdi mdi-chevron-right text-primary"></i>
            </button>
        </div>
        <div v-if="links.last">
            <button type="button" class="btn btn-secondary" @click="paginate('last')"><i class="mdi mdi-chevron-double-right text-primary"></i>
            </button>
        </div>
        {{ links }}
    </div>
</template>

<script>
export default {
    emits: [
        'resp'
    ],
    props: {
        links: Object
    },
    mounted() {
        console.log('Component mounted.');
    },
    methods: {
      paginate(step){
          this.$emit('resp', this.links[step])
      }
    }
}
</script>
<style scoped>
button i.text-primary {
    font-size: 1.4em;
    color: white !important;
    font-weight: bold;
}
</style>
