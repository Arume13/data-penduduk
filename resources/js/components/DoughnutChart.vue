<script setup lang="ts">
import Chart from './Chart.vue';

const props = defineProps({
  data: Object,
  options: Object
});
</script>

<template>
  <Chart type="doughnut" :data="data" :options="options" />
</template>
