<script setup lang="ts">
import { ref } from 'vue';
import Button from '@/components/ui/button/Button.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Data KK',
        href: '/data-kk',
    },
];

// Sample data for the table
const dataKK = [
    { noKK: '1234567890', alamat: 'Jl. Merdeka No.1', rt: '01', rw: '02', noRumah: '10', totalAnggota: 5 },
    { noKK: '0987654321', alamat: 'Jl. Sudirman No.5', rt: '03', rw: '04', noRumah: '20', totalAnggota: 4 },
    { noKK: '1122334455', alamat: 'Jl. Thamrin No.7', rt: '05', rw: '06', noRumah: '30', totalAnggota: 6 },
];

// Mock data penduduk for each KK
const dataPendudukByKK: Record<string, Array<{
    noKK: string;
    nik: string;
    nama: string;
    tempatLahir: string;
    tanggalLahir: string;
    jenisKelamin: string;
    pekerjaan: string;
    kategori: string;
    statusPerkawinan: string;
    alamat: string;
    rt: string;
    rw: string;
    noRumah: string;
}>> = {
    '1234567890': [
        {
            noKK: '1234567890',
            nik: '3210987654321',
            nama: 'Budi Santoso',
            tempatLahir: 'Jakarta',
            tanggalLahir: '1990-01-01',
            jenisKelamin: 'Laki-laki',
            pekerjaan: 'Karyawan',
            kategori: 'Dewasa',
            statusPerkawinan: 'Menikah',
            alamat: 'Jl. Merdeka No.1',
            rt: '01',
            rw: '02',
            noRumah: '10',
        },
        // Add more members if totalAnggota > 1
    ],
    '0987654321': [
        {
            noKK: '0987654321',
            nik: '1234567890123',
            nama: 'Siti Aminah',
            tempatLahir: 'Bandung',
            tanggalLahir: '1985-05-15',
            jenisKelamin: 'Perempuan',
            pekerjaan: 'Guru',
            kategori: 'Dewasa',
            statusPerkawinan: 'Menikah',
            alamat: 'Jl. Sudirman No.5',
            rt: '03',
            rw: '04',
            noRumah: '20',
        },
    ],
    '1122334455': [
        {
            noKK: '1122334455',
            nik: '5678901234567',
            nama: 'Andi Wijaya',
            tempatLahir: 'Surabaya',
            tanggalLahir: '2010-10-10',
            jenisKelamin: 'Laki-laki',
            pekerjaan: 'Pelajar',
            kategori: 'Anak-anak',
            statusPerkawinan: 'Belum Menikah',
            alamat: 'Jl. Thamrin No.7',
            rt: '05',
            rw: '06',
            noRumah: '30',
        },
    ],
};

const showModal = ref(false);
const selectedDataPenduduk = ref([]);

function openDetailModal(noKK: string) {
    selectedDataPenduduk.value = dataPendudukByKK[noKK] || [];
    showModal.value = true;
}

function closeModal() {
    showModal.value = false;
    selectedDataPenduduk.value = [];
}
</script>

<template>
    <Head title="Data KK" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-auto">
            <h1 class="text-2xl font-semibold mb-4">Data KK</h1>
            <div class="overflow-x-auto rounded-lg border border-sidebar-border/70 dark:border-sidebar-border">
                <table class="w-full border-collapse text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="bg-gray-50 text-center dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                        <tr>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">No.KK</th>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">Alamat</th>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">RT</th>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">RW</th>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">No.Rumah</th>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">Total Anggota Kel</th>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in dataKK" :key="item.noKK" class="bg-white text-center border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ item.noKK }}</td>
                            <td class="px-6 py-4">{{ item.alamat }}</td>
                            <td class="px-6 py-4">{{ item.rt }}</td>
                            <td class="px-6 py-4">{{ item.rw }}</td>
                            <td class="px-6 py-4">{{ item.noRumah }}</td>
                            <td class="px-6 py-4">{{ item.totalAnggota }}</td>
                            <td class="px-6 py-4">
                                <button
                                    @click="openDetailModal(item.noKK)"
                                    class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition"
                                >
                                    Detail
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>

    <!-- Modal -->
    <div
        v-if="showModal"
        class="fixed inset-1 z-50 flex items-center justify-center bg-black bg-opacity-50"
    >
        <div class="bg-white dark:bg-gray-500 rounded-lg shadow-lg w-full max-w-7xl p-6 overflow-auto max-h-[90vh]">
            <h2 class="text-xl font-semibold mb-4">Data Penduduk Detail</h2>
            <table class="w-full border-collapse text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 text-center dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="px-4 py-2 border border-gray-300">No.KK</th>
                        <th class="px-4 py-2 border border-gray-300">NIK</th>
                        <th class="px-4 py-2 border border-gray-300">Nama</th>
                        <th class="px-4 py-2 border border-gray-300">Tempat Lahir</th>
                        <th class="px-4 py-2 border border-gray-300">Tanggal Lahir</th>
                        <th class="px-4 py-2 border border-gray-300">Jenis Kelamin</th>
                        <th class="px-4 py-2 border border-gray-300">Pekerjaan</th>
                        <th class="px-4 py-2 border border-gray-300">Kategori</th>
                        <th class="px-4 py-2 border border-gray-300">Status Perkawinan</th>
                        <th class="px-4 py-2 border border-gray-300">Alamat</th>
                        <th class="px-4 py-2 border border-gray-300">RT</th>
                        <th class="px-4 py-2 border border-gray-300">RW</th>
                        <th class="px-4 py-2 border border-gray-300">No.Rumah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="penduduk in selectedDataPenduduk" :key="penduduk.nik" class="text-center border-b border-gray-300">
                        <td class="px-4 py-2 border border-gray-300">{{ penduduk.noKK }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ penduduk.nik }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ penduduk.nama }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ penduduk.tempatLahir }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ penduduk.tanggalLahir }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ penduduk.jenisKelamin }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ penduduk.pekerjaan }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ penduduk.kategori }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ penduduk.statusPerkawinan }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ penduduk.alamat }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ penduduk.rt }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ penduduk.rw }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ penduduk.noRumah }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="flex justify-end mt-4">
                <button
                    @click="closeModal"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500"
                >
                    Tutup
                </button>
            </div>
        </div>
    </div>
</template>
