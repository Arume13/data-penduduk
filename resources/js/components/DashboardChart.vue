<template>
    <canvas ref="chartCanvas"></canvas>
</template>

<script setup lang="ts">
import { ref, onMounted, watch } from 'vue';
import { Chart, registerables } from 'chart.js';

Chart.register(...registerables);

const props = defineProps({
    totalKK: Number,
    totalPenduduk: Number,
    kategoriData: Object
});

const chartCanvas = ref<HTMLCanvasElement | null>(null);
let chartInstance: Chart | null = null;

const createChart = () => {
    if (chartInstance) {
        chartInstance.destroy();
    }

    const ctx = chartCanvas.value?.getContext('2d');
    if (ctx) {
        chartInstance = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Total KK', 'Total Penduduk', 'Bayi', 'Anak-anak', 'Remaja', 'Dewasa', 'Lansia'],
                datasets: [{
                    label: 'Jumlah',
                    data: [
                        props.totalKK,
                        props.totalPenduduk,
                        props.kategoriData.Bayi,
                        props.kategoriData.AnakAnak,
                        props.kategoriData.Remaja,
                        props.kategoriData.Dewasa,
                        props.kategoriData.Lansia
                    ],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
};

onMounted(() => {
    createChart();
});

watch(() => [props.totalKK, props.totalPenduduk, props.kategoriData], createChart);
</script>
