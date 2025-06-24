<script setup>
import { Head, router, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, computed } from 'vue';

const loading = ref(false);
const showToast = ref(false);
const toastMessage = ref('');
const toastType = ref('');
const searchQuery = ref('');

const props = defineProps({
    dataKK: {
        type: Array,
        required: true
    },
    userRole: { 
        type: String,
        required: true
    },
    breadcrumbs: {
        type: Array,
        required: true
    }
});

console.log(props.userRole);

// Fungsi untuk navigasi ke detail KK
function viewDetail(noKK) {
    router.get(`/data-kk/${noKK}`);
}

// Fungsi untuk navigasi ke halaman edit KK
function editKK(noKK) {
    router.get(`/data-kk/${noKK}/edit`);
}

// Fungsi untuk menampilkan notifikasi
function showNotification(message, type) {
    toastMessage.value = message;
    toastType.value = type;
    showToast.value = true;
    setTimeout(() => showToast.value = false, 3000); 
}

// Fungsi untuk menghapus KK
function deleteKK(noKK) {
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        loading.value = true; // Set loading state
        router.delete(`/data-kk/${noKK}`, {
            onSuccess: () => {
                loading.value = false; // Reset loading state
                showNotification('Data KK berhasil dihapus!', 'success');
            },
            onError: () => {
                loading.value = false; // Reset loading state
                showNotification('Gagal menghapus data KK!', 'error');
            }
        });
    }
}

// Computed property untuk memfilter data KK berdasarkan pencarian
const filteredDataKK = computed(() => {
    if (!searchQuery.value) {
        return props.dataKK; // Gunakan props.dataKK
    }
    return props.dataKK.filter(item => {
        return (
            item.noKK.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            item.kepalaKeluarga.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            item.alamat.toLowerCase().includes(searchQuery.value.toLowerCase())
        );
    });
});
</script>

<template>
    <Head title="Data KK" />

    <AppLayout :breadcrumbs="breadcrumbs">
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
            <h1 class="text-2xl font-semibold mb-4">Data KK</h1>
            
            <div class="mb-4 flex justify-between">
                <input 
                    type="text" 
                    v-model="searchQuery" 
                    placeholder="Cari No.KK, Kepala Keluarga, atau Alamat"
                    class="border border-gray-300 rounded-md px-4 py-2 w-full"
                />
                <Link 
                    @click="router.get('/data-kk/create')"
                    class="bg-blue-600 text-white px-4 py-2 text-center rounded hover:bg-blue-700 transition ml-4"
                >
                    Tambah KK
                </Link>
            </div>

            <div class="overflow-x-auto rounded-lg border border-sidebar-border/70 dark:border-sidebar-border">
                <table class="w-full border-collapse text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="bg-gray-50 text-center dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                        <tr>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">No.KK</th>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">Kepala Keluarga</th>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">Alamat</th>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">RT</th>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">RW</th>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">No.Rumah</th>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">Total Anggota Kel</th>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in filteredDataKK" :key="item.noKK" class="bg-white text-center border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ item.noKK }}</td>
                            <td class="px-6 py-4">{{ item.kepalaKeluarga }}</td>
                            <td class="px-6 py-4">{{ item.alamat }}</td>
                            <td class="px-6 py-4">{{ item.rt }}</td>
                            <td class="px-6 py-4">{{ item.rw }}</td>
                            <td class="px-6 py-4">{{ item.noRumah }}</td>
                            <td class="px-6 py-4">{{ item.totalAnggota }}</td>
                            <td class="px-6 py-4 space-x-2">
                                <Link
                                    @click="viewDetail(item.noKK)"
                                    class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition"
                                >
                                    Detail
                                </Link>
                                <Link 
                                    @click="editKK(item.noKK)"
                                    class="bg-yellow-600 text-white px-3 py-1 rounded hover:bg-yellow-700 transition"
                                >
                                    Edit
                                </Link>
                                <button 
                                    v-if="props.userRole !== 'anggota'" 
                                    @click="deleteKK(item.noKK)"
                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition"
                                    :disabled="loading"
                                >
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
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