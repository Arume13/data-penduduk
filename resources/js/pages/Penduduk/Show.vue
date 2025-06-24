<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    penduduk: Object,
    breadcrumbs: Array
});
</script>

<template>
    <Head :title="`Detail ${penduduk.nama}`" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-auto">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-semibold">Detail Penduduk</h1>
                <div class="space-x-2">
                    <Link 
                        :href="route('penduduk.edit', penduduk.nik)"
                        class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700 transition"
                    >
                        Edit Data
                    </Link>
                    <Link 
                        :href="route('penduduk.index')"
                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 transition"
                    >
                        Kembali
                    </Link>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                <!-- Header -->
                <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">
                        Informasi Pribadi
                    </h2>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kolom Kiri -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">NIK</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ penduduk.nik }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Nama Lengkap</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ penduduk.nama }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Tempat, Tanggal Lahir</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                    {{ penduduk.tempatLahir }}, {{ new Date(penduduk.tanggalLahir).toLocaleDateString('id-ID') }}
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Jenis Kelamin</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ penduduk.jenisKelamin }}</p>
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">No. Kartu Keluarga</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                    {{ penduduk.noKK }}
                                    <Link 
                                        v-if="penduduk.kk"
                                        :href="route('kk.show', penduduk.noKK)"
                                        class="ml-2 text-blue-600 hover:text-blue-800 text-xs"
                                    >
                                        (Lihat KK)
                                    </Link>
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Pekerjaan</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ penduduk.pekerjaan }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Kategori</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ penduduk.kategori }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Status Perkawinan</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ penduduk.statusPerkawinan }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-600">
                        <h3 class="text-md font-medium text-gray-900 dark:text-white mb-4">Alamat</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Alamat</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ penduduk.alamat }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">RT/RW</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ penduduk.rt }}/{{ penduduk.rw }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">No. Rumah</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ penduduk.noRumah }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
