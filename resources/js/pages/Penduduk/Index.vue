<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const loading = ref(false);
const showToast = ref(false);
const toastMessage = ref('');
const toastType = ref('');
const searchQuery = ref('');

const props = defineProps({
    penduduk: {
        type: Object,
        required: true,
    },
    userRole: {
        type: String,
        required: true,
    },
    breadcrumbs: {
        type: Array,
        required: true,
    },
});

// Function to navigate to detail page
function viewDetail(nik) {
    router.get(`/data-penduduk/${nik}`);
}

// Function to navigate to edit page
function editPenduduk(nik) {
    router.get(`/data-penduduk/${nik}/edit`);
}

// Function to show notification
function showNotification(message, type) {
    toastMessage.value = message;
    toastType.value = type;
    showToast.value = true;
    setTimeout(() => (showToast.value = false), 3000);
}

// Function to delete penduduk
function deletePenduduk(nik) {
    if (confirm('Apakah Anda yakin ingin menghapus data penduduk ini?')) {
        loading.value = true; // Set loading state
        router.delete(`/data-penduduk/${nik}`, {
            onSuccess: () => {
                loading.value = false; // Reset loading state
                showNotification('Data penduduk berhasil dihapus!', 'success');
            },
            onError: () => {
                loading.value = false; // Reset loading state
                showNotification('Gagal menghapus data penduduk!', 'error');
            },
        });
    }
}

// Computed property to filter penduduk data based on search query
const filteredPenduduk = computed(() => {
    if (!searchQuery.value) {
        return props.penduduk.data; // Use props.penduduk.data
    }
    return props.penduduk.data.filter((item) => {
        return (
            item.nik.includes(searchQuery.value) ||
            item.nama.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            item.noKK.includes(searchQuery.value) ||
            item.jenisKelamin.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            item.pekerjaan.toLowerCase().includes(searchQuery.value.toLowerCase())
        );
    });
});
</script>

<template>
    <Head title="Data Penduduk" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <!-- Toast Notification -->
        <div
            v-if="showToast"
            :class="{
                'bg-green-500': toastType === 'success',
                'bg-red-500': toastType === 'error',
            }"
            class="fixed right-4 bottom-4 z-50 rounded-lg px-6 py-3 text-white shadow-lg transition-all duration-300"
        >
            {{ toastMessage }}
        </div>

        <!-- Loading Overlay -->
        <div v-if="loading" class="bg-opacity-30 fixed inset-0 z-40 flex items-center justify-center bg-black">
            <div class="loader"></div>
        </div>

        <div class="flex h-full flex-1 flex-col gap-4 overflow-auto rounded-xl p-4">
            <h1 class="mb-4 text-2xl font-semibold">Data Penduduk</h1>

            <div class="mb-4 flex justify-between">
                <input
                    type="text"
                    v-model="searchQuery"
                    placeholder="Cari NIK, Nama, No. KK, Jenis Kelamin, atau Pekerjaan"
                    class="w-full rounded-md border border-gray-300 px-4 py-2"
                />
                <Link
                    @click="router.get('/data-penduduk/create')"
                    class="ml-4 rounded bg-blue-600 px-4 py-2 text-center text-white transition hover:bg-blue-700"
                >
                    Tambah Penduduk
                </Link>
            </div>

            <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                <table class="w-full border-collapse text-left text-sm text-gray-500 dark:text-gray-400">
                    <thead class="bg-gray-50 text-center text-gray-700 dark:bg-gray-800 dark:text-gray-300">
                        <tr>
                            <th class="px-6 py-3">NIK</th>
                            <th class="px-6 py-3">Nama</th>
                            <th class="px-6 py-3">No. KK</th>
                            <th class="px-6 py-3">Jenis Kelamin</th>
                            <th class="px-6 py-3">Pekerjaan</th>
                            <th class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="item in filteredPenduduk"
                            :key="item.nik"
                            class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600"
                        >
                            <td class="px-6 py-4 text-center">{{ item.nik }}</td>
                            <td class="px-6 py-4 text-center">{{ item.nama }}</td>
                            <td class="px-6 py-4 text-center">{{ item.noKK }}</td>
                            <td class="px-6 py-4 text-center">{{ item.jenisKelamin }}</td>
                            <td class="px-6 py-4 text-center">{{ item.pekerjaan }}</td>
                            <td class="space-x-2 px-6 py-4 text-center">
                                <Link
                                    :href="`/data-penduduk/${item.nik}`"
                                    class="rounded bg-blue-600 px-3 py-1 text-white transition hover:bg-blue-700"
                                >
                                    Detail
                                </Link>
                                <Link
                                    :href="`/data-penduduk/${item.nik}/edit`"
                                    class="rounded bg-yellow-600 px-3 py-1 text-white transition hover:bg-yellow-700"
                                >
                                    Edit
                                </Link>
                                <button
                                    v-if="props.userRole !== 'anggota'"
                                    @click="deletePenduduk(item.nik)"
                                    class="rounded bg-red-600 px-3 py-1 text-white transition hover:bg-red-700"
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
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
