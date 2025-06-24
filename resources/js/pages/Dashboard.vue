<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import StatsCard from '@/Components/StatsCard.vue';
import DoughnutChart from '@/Components/DoughnutChart.vue';
import BarChart from '@/Components/BarChart.vue';
import Chart from '@/Components/Chart.vue';

const props = defineProps({
  totalKK: Number,
  totalPenduduk: Number,
  kategoriData: Object,
  jenisKelaminData: Object,
  pendudukByMonth: Array,
  totalIbuHamil: Number,
  totalIbuMenyusui: Number,
  totalBerkebutuhanKhusus: Number
});

const breadcrumbs = [
  { title: 'Dashboard', href: '/dashboard' }
];

const chartOptions = {
  responsive: true,
  maintainAspectRatio: false,
  plugins: {
    legend: { position: 'bottom' }
  }
};

console.log(props);
</script>

<template>
  <Head title="Dashboard" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-6 space-y-6">
      <!-- Statistik Utama -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <StatsCard 
          title="Total KK" 
          :value="totalKK" 
          icon="users" 
          color="bg-blue-500"
        />
        <StatsCard 
          title="Total Penduduk" 
          :value="totalPenduduk" 
          icon="user-group" 
          color="bg-green-500"
        />
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
          <h3 class="text-lg font-semibold mb-4">Kategori Dominan</h3>
          <div class="flex items-center">
            <div class="w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
              <span class="text-blue-600 dark:text-blue-300 font-bold text-lg">
                {{
                  Object.entries(kategoriData).reduce((a, b) => a[1] > b[1] ? a : b)[0]
                    .replace(/([A-Z])/g, ' $1')
                    .trim()
                }}
              </span>
            </div>
            <div class="ml-4">
              <p class="text-gray-500">Populasi terbanyak</p>
              <p class="text-lg font-medium">
                {{ Object.entries(kategoriData).reduce((a, b) => a[1] > b[1] ? a : b)[1] }} penduduk
              </p>
            </div>
          </div>
        </div>
        <!-- <StatsCard 
          title="Kepadatan" 
          :value="Math.round(totalPenduduk / totalKK)" 
          icon="home" 
          color="bg-purple-500"
          description="Penduduk per KK"
        /> -->
      </div>

      <!-- Statistik Ibu Hamil, Ibu Menyusui, dan Kebutuhan Khusus -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <StatsCard 
          title="Ibu Hamil" 
          :value="totalIbuHamil" 
          icon="baby-carriage" 
          color="bg-pink-500"
        />
        <StatsCard 
          title="Ibu Menyusui" 
          :value="totalIbuMenyusui" 
          icon="baby" 
          color="bg-purple-500"
        />
        <StatsCard 
          title="Berkebutuhan Khusus" 
          :value="totalBerkebutuhanKhusus" 
          icon="wheelchair" 
          color="bg-orange-500"
        />
      </div>

      <!-- Baris Pertama Chart -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Chart Distribusi Kategori Penduduk -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
          <h3 class="text-lg font-semibold mb-4">Distribusi Kategori Penduduk</h3>
          <div class="h-80">
            <DoughnutChart
              :data="{
                labels: ['Bayi', 'Anak-Anak', 'Remaja', 'Dewasa', 'Lansia'],
                datasets: [{
                  data: [
                    kategoriData.Bayi,
                    kategoriData.AnakAnak,
                    kategoriData.Remaja,
                    kategoriData.Dewasa,
                    kategoriData.Lansia
                  ],
                  backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'
                  ]
                }]
              }"
              :options="chartOptions"
            />
          </div>
          <div class="mt-4 grid grid-cols-2 gap-4 text-sm">
            <div v-for="(value, key) in kategoriData" :key="key" class="flex items-center">
              <span class="w-3 h-3 rounded-full mr-2" 
                    :style="`background-color: ${
                      ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'][
                        ['Bayi', 'AnakAnak', 'Remaja', 'Dewasa', 'Lansia'].indexOf(key)
                      ]
                    }`"></span>
              <span class="capitalize">{{ key.replace(/([A-Z])/g, ' $1') }}</span>
              <span class="ml-auto font-medium">{{ value }}</span>
            </div>
          </div>
        </div>
        
        <!-- Chart Jenis Kelamin -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
          <h3 class="text-lg font-semibold mb-4">Persebaran Jenis Kelamin</h3>
          <div class="h-80">
            <BarChart 
              :data="{
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                  label: 'Jumlah',
                  data: [jenisKelaminData.LakiLaki, jenisKelaminData.Perempuan],
                  backgroundColor: ['#3B82F6', '#EC4899']
                }]
              }"
              :options="{
                ...chartOptions,
                scales: { y: { beginAtZero: true } },
                indexAxis: 'y'
              }"
            />
          </div>
          <div class="mt-4 flex justify-between text-sm">
            <span>Total Laki-laki: {{ jenisKelaminData.LakiLaki }}</span>
            <span>Total Perempuan: {{ jenisKelaminData.Perempuan }}</span>
          </div>
        </div>
      </div>

      <!-- Chart Pertumbuhan Penduduk -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Pertumbuhan Penduduk (12 Bulan Terakhir)</h3>
        <div class="h-96">
          <Chart
            type="line"
            :data="{
              labels: pendudukByMonth.map(item => item.month),
              datasets: [{
                label: 'Penduduk Baru',
                data: pendudukByMonth.map(item => item.count),
                borderColor: '#10B981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                fill: true,
                tension: 0.3
              }]
            }"
            :options="{
              ...chartOptions,
              responsive: true,
              interaction: { intersect: false, mode: 'index' },
              scales: { y: { beginAtZero: true } }
            }"
          />
        </div>
        <div class="mt-2 text-sm text-gray-500">
          Data pertumbuhan penduduk dalam 12 bulan terakhir
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
/* Efek hover untuk card */
.bg-white:hover, .dark\:bg-gray-800:hover {
  transform: translateY(-2px);
  transition: transform 0.2s ease;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}
</style>
