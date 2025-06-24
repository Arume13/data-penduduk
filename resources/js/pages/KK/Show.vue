<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    kk: Object,
    penduduk: Array,
    breadcrumbs: Array
});
</script>

<template>
    <Head title="Detail KK" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-auto">
            <h1 class="text-2xl font-semibold mb-4">Detail KK: {{ kk.noKK }}</h1>
            
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow mb-6">
                <h2 class="text-lg font-semibold mb-2">Informasi Kartu Keluarga</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p><span class="font-medium">No. KK:</span> {{ kk.noKK }}</p>
                        <p><span class="font-medium">Kepala Keluarga:</span> {{ kk.kepalaKeluarga }}</p>
                        <p><span class="font-medium">Alamat:</span> {{ kk.alamat }}</p>
                    </div>
                    <div>
                        <p><span class="font-medium">RT/RW:</span> {{ kk.rt }}/{{ kk.rw }}</p>
                        <p><span class="font-medium">No. Rumah:</span> {{ kk.noRumah }}</p>
                        <p><span class="font-medium">Total Anggota:</span> {{ penduduk.length }}</p>
                    </div>
                </div>
            </div>

            <h2 class="text-xl font-semibold mb-2">Anggota Keluarga</h2>
            <div class="overflow-x-auto rounded-lg border border-sidebar-border/70 dark:border-sidebar-border">
                <table class="w-full border-collapse text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="bg-gray-50 text-center dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="px-4 py-2 border border-gray-300">NIK</th>
                            <th class="px-4 py-2 border border-gray-300">Nama</th>
                            <th class="px-4 py-2 border border-gray-300">Tempat/Tgl Lahir</th>
                            <th class="px-4 py-2 border border-gray-300">Jenis Kelamin</th>
                            <th class="px-4 py-2 border border-gray-300">Pekerjaan</th>
                            <th class="px-4 py-2 border border-gray-300">Status Perkawinan</th>
                            <th class="px-4 py-2 border border-gray-300">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="p in penduduk" :key="p.nik" class="text-center border-b border-gray-300">
                            <td class="px-4 py-2 border border-gray-300">{{ p.nik }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ p.nama }}</td>
                            <td class="px-4 py-2 border border-gray-300">
                                {{ p.tempatLahir }}, 
                                {{ new Date(p.tanggalLahir).toLocaleDateString('id-ID') }}
                            </td>
                            <td class="px-4 py-2 border border-gray-300">{{ p.jenisKelamin }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ p.pekerjaan }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ p.statusPerkawinan }}</td>
                            <td class="px-4 py-2 border border-gray-300 space-x-2">
                                <Link :href="`/data-penduduk/${p.nik}`" class="bg-blue-600 text-white px-2 py-1 rounded hover:bg-blue-700 transition text-sm">
                                    Detail
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end mt-4">
                <Link href="/data-kk" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Kembali
                </Link>
            </div>
        </div>
    </AppLayout>
</template>
