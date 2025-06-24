<script setup>
import { Head, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';

const form = ref({
    noKK: '',
    kepalaKeluarga: '',
    alamat: '',
    rt: '',
    rw: '',
    noRumah: ''
});

const errors = ref({});
const loading = ref(false);
const showToast = ref(false);
const toastMessage = ref('');
const toastType = ref('success');

function showNotification(message, type) {
    toastMessage.value = message;
    toastType.value = type;
    showToast.value = true;
    setTimeout(() => showToast.value = false, 3000);
}

function submitForm() {
    loading.value = true;
    router.post('/data-kk', form.value, {
        onSuccess: () => {
            showNotification('Data KK berhasil ditambahkan!', 'success');
            router.get('/data-kk');
        },
        onError: (err) => {
            errors.value = err;
            showNotification('Gagal menambahkan data KK!', 'error');
        },
        onFinish: () => {
            loading.value = false;
        }
    });
}
</script>

<template>
    <Head title="Tambah Data KK" />

    <AppLayout :breadcrumbs="[
        { title: 'Data KK', href: '/data-kk' },
        { title: 'Tambah KK', href: '/data-kk/create' }
    ]">
        <!-- Toast Notification -->
        <div v-if="showToast" 
            :class="{
                'bg-green-500': toastType === 'success',
                'bg-red-500': toastType === 'error'
            }"
            class="fixed bottom-4 right-4 text-white px-6 py-3 rounded-lg shadow-lg transition-all duration-300 z-50">
            {{ toastMessage }}
        </div>

        <!-- Loading Overlay -->
        <div v-if="loading" class="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-40">
            <div class="loader"></div>
        </div>

        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-auto">
            <h1 class="text-2xl font-semibold mb-4">Tambah Data KK</h1>
            
            <form @submit.prevent="submitForm" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- No. KK -->
                    <div>
                        <label for="noKK" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Nomor Kartu Keluarga <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="noKK"
                            v-model="form.noKK"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                            placeholder="Masukkan nomor KK"
                            required
                        />
                        <p v-if="errors.noKK" class="mt-1 text-sm text-red-500">{{ errors.noKK }}</p>
                    </div>

                    <!-- Kepala Keluarga -->
                    <div>
                        <label for="kepalaKeluarga" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Nama Kepala Keluarga <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="kepalaKeluarga"
                            v-model="form.kepalaKeluarga"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                            placeholder="Masukkan nama kepala keluarga"
                            required
                        />
                        <p v-if="errors.kepalaKeluarga" class="mt-1 text-sm text-red-500">{{ errors.kepalaKeluarga }}</p>
                    </div>

                    <!-- Alamat -->
                    <div class="md:col-span-2">
                        <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Alamat <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            id="alamat"
                            v-model="form.alamat"
                            rows="2"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                            placeholder="Masukkan alamat lengkap"
                            required
                        ></textarea>
                        <p v-if="errors.alamat" class="mt-1 text-sm text-red-500">{{ errors.alamat }}</p>
                    </div>

                    <!-- RT -->
                    <div>
                        <label for="rt" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            RT <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="rt"
                            v-model="form.rt"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                            placeholder="Masukkan nomor RT"
                            required
                        />
                        <p v-if="errors.rt" class="mt-1 text-sm text-red-500">{{ errors.rt }}</p>
                    </div>

                    <!-- RW -->
                    <div>
                        <label for="rw" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            RW <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="rw"
                            v-model="form.rw"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                            placeholder="Masukkan nomor RW"
                            required
                        />
                        <p v-if="errors.rw" class="mt-1 text-sm text-red-500">{{ errors.rw }}</p>
                    </div>

                    <!-- Nomor Rumah -->
                    <div>
                        <label for="noRumah" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Nomor Rumah <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="noRumah"
                            v-model="form.noRumah"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                            placeholder="Masukkan nomor rumah"
                            required
                        />
                        <p v-if="errors.noRumah" class="mt-1 text-sm text-red-500">{{ errors.noRumah }}</p>
                    </div>
                </div>

                <div class="flex justify-end mt-6 space-x-3">
                    <button
                        type="button"
                        @click="router.get('/data-kk')"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500"
                    >
                        Kembali
                    </button>
                    <button
                        type="submit"
                        :disabled="loading"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <span v-if="!loading">Simpan Data</span>
                        <span v-else class="inline-flex items-center">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Menyimpan...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>

<style>
.loader {
    border: 4px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    border-top: 4px solid #fff;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
