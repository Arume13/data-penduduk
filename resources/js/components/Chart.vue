<script setup lang="ts">
import { ref, onMounted, watch } from 'vue';
import { Chart as ChartJS, registerables } from 'chart.js';

ChartJS.register(...registerables);

const props = defineProps({
  type: String,
  data: Object,
  options: Object
});

const chartCanvas = ref<HTMLCanvasElement | null>(null);
let chartInstance: ChartJS | null = null;

onMounted(() => {
  renderChart();
});

watch(() => [props.data, props.options], () => {
  renderChart();
}, { deep: true });

const renderChart = () => {
  if (chartCanvas.value) {
    if (chartInstance) {
      chartInstance.destroy();
    }
    
    const ctx = chartCanvas.value.getContext('2d');
    if (ctx) {
      chartInstance = new ChartJS(ctx, {
        type: props.type,
        data: props.data,
        options: props.options
      });
    }
  }
};
</script>

<template>
  <canvas ref="chartCanvas"></canvas>
</template>
