<script setup lang="ts">
import { ref, reactive } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Data Penduduk',
        href: '/data-penduduk',
    },
];

// Sample data for the table
const dataPenduduk = ref([
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
]);

const showModal = ref(false);

const form = reactive({
    noKK: '',
    nik: '',
    nama: '',
    tempatLahir: '',
    tanggalLahir: '',
    jenisKelamin: '',
    pekerjaan: '',
    kategori: '',
    statusPerkawinan: '',
    alamat: '',
    rt: '',
    rw: '',
    noRumah: '',
});

const kategoriOptions = [
    'Balita',
    'Anak-anak',
    'Remaja',
    'Dewasa',
    'Lanjut Usia',
    'Berkebutuhan Khusus',
];

function openModal() {
    showModal.value = true;
}

function closeModal() {
    showModal.value = false;
    resetForm();
}

function resetForm() {
    form.noKK = '';
    form.nik = '';
    form.nama = '';
    form.tempatLahir = '';
    form.tanggalLahir = '';
    form.jenisKelamin = '';
    form.pekerjaan = '';
    form.kategori = '';
    form.statusPerkawinan = '';
    form.alamat = '';
    form.rt = '';
    form.rw = '';
    form.noRumah = '';
}

function submitForm() {
    // For now, just add the new data to the table and close modal
    dataPenduduk.value.push({ ...form });
    closeModal();
}
</script>

<template>
    <Head title="Data Penduduk" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-auto">
            <div class="flex justify-between mb-2">
            <h1 class="text-2xl font-semibold mb-4">Data Penduduk</h1>
                <button
                    @click="openModal"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    Tambah Data Penduduk
                </button>
            </div>
            <div class="overflow-x-auto rounded-lg border border-sidebar-border/70 dark:border-sidebar-border">
                <table class="w-full border-collapse text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="bg-gray-50 text-center dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                        <tr>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">No.KK</th>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">NIK</th>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">Nama</th>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">Tempat Lahir</th>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">Tanggal Lahir</th>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">Jenis Kelamin</th>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">Pekerjaan</th>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">Kategori</th>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">Status Perkawinan</th>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">Alamat</th>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">RT</th>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">RW</th>
                            <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">No.Rumah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in dataPenduduk" :key="item.nik" class="bg-white text-center border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ item.noKK }}</td>
                            <td class="px-6 py-4">{{ item.nik }}</td>
                            <td class="px-6 py-4">{{ item.nama }}</td>
                            <td class="px-6 py-4">{{ item.tempatLahir }}</td>
                            <td class="px-6 py-4">{{ item.tanggalLahir }}</td>
                            <td class="px-6 py-4">{{ item.jenisKelamin }}</td>
                            <td class="px-6 py-4">{{ item.pekerjaan }}</td>
                            <td class="px-6 py-4">{{ item.kategori }}</td>
                            <td class="px-6 py-4">{{ item.statusPerkawinan }}</td>
                            <td class="px-6 py-4">{{ item.alamat }}</td>
                            <td class="px-6 py-4">{{ item.rt }}</td>
                            <td class="px-6 py-4">{{ item.rw }}</td>
                            <td class="px-6 py-4">{{ item.noRumah }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Modal -->
            <div
                v-if="showModal"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
            >
                <div class="bg-white dark:bg-gray-600 rounded-lg shadow-lg w-full max-w-3xl p-6 overflow-auto max-h-[90vh]">
                    <h2 class="text-xl font-semibold mb-4">Tambah Data Penduduk</h2>
                    <form @submit.prevent="submitForm" class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="noKK" class="block mb-1 font-medium">No.KK</label>
                                <input
                                    id="noKK"
                                    v-model="form.noKK"
                                    type="text"
                                    class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required
                                />
                            </div>
                            <div>
                                <label for="nik" class="block mb-1 font-medium">NIK</label>
                                <input
                                    id="nik"
                                    v-model="form.nik"
                                    type="text"
                                    class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required
                                />
                            </div>
                            <div>
                                <label for="nama" class="block mb-1 font-medium">Nama</label>
                                <input
                                    id="nama"
                                    v-model="form.nama"
                                    type="text"
                                    class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required
                                />
                            </div>
                            <div>
                                <label for="tempatLahir" class="block mb-1 font-medium">Tempat Lahir</label>
                                <input
                                    id="tempatLahir"
                                    v-model="form.tempatLahir"
                                    type="text"
                                    class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required
                                />
                            </div>
                            <div>
                                <label for="tanggalLahir" class="block mb-1 font-medium">Tanggal Lahir</label>
                                <input
                                    id="tanggalLahir"
                                    v-model="form.tanggalLahir"
                                    type="date"
                                    class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required
                                />
                            </div>
                            <div>
                                <label for="jenisKelamin" class="block mb-1 font-medium">Jenis Kelamin</label>
                                <select
                                    id="jenisKelamin"
                                    v-model="form.jenisKelamin"
                                    class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required
                                >
                                    <option value="" disabled class="bg-white dark:bg-gray-600">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" class="bg-white dark:bg-gray-600">Laki-laki</option>
                                    <option value="Perempuan" class="bg-white dark:bg-gray-600">Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label for="pekerjaan" class="block mb-1 font-medium">Pekerjaan</label>
                                <input
                                    id="pekerjaan"
                                    v-model="form.pekerjaan"
                                    type="text"
                                    class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required
                                />
                            </div>
                            <div>
                                <label for="kategori" class="block mb-1 font-medium">Kategori</label>
                                <select
                                    id="kategori"
                                    v-model="form.kategori"
                                    class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required
                                >
                                    <option value="" disabled>Pilih Kategori</option>
                                    <option v-for="option in kategoriOptions" :key="option" :value="option" class="bg-white dark:bg-gray-600">{{ option }}</option>
                                </select>
                            </div>
                            <div>
                                <label for="statusPerkawinan" class="block mb-1 font-medium">Status Perkawinan</label>
                                <input
                                    id="statusPerkawinan"
                                    v-model="form.statusPerkawinan"
                                    type="text"
                                    class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required
                                />
                            </div>
                            <div>
                                <label for="alamat" class="block mb-1 font-medium">Alamat</label>
                                <input
                                    id="alamat"
                                    v-model="form.alamat"
                                    type="text"
                                    class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required
                                />
                            </div>
                            <div>
                                <label for="rt" class="block mb-1 font-medium">RT</label>
                                <input
                                    id="rt"
                                    v-model="form.rt"
                                    type="text"
                                    class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required
                                />
                            </div>
                            <div>
                                <label for="rw" class="block mb-1 font-medium">RW</label>
                                <input
                                    id="rw"
                                    v-model="form.rw"
                                    type="text"
                                    class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required
                                />
                            </div>
                            <div>
                                <label for="noRumah" class="block mb-1 font-medium">No.Rumah</label>
                                <input
                                    id="noRumah"
                                    v-model="form.noRumah"
                                    type="text"
                                    class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required
                                />
                            </div>
                        </div>
                        <div class="flex justify-end gap-4 mt-6">
                            <button
                                type="button"
                                @click="closeModal"
                                class="px-4 py-2 rounded border border-gray-300 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-400"
                            >
                                Batal
                            </button>
                            <button
                                type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
