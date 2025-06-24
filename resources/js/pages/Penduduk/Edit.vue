<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    penduduk: Object,
    kkList: Array,
    breadcrumbs: Array,
});

const form = useForm({
    noKK: props.penduduk.noKK,
    nik: props.penduduk.nik,
    nama: props.penduduk.nama,
    tempatLahir: props.penduduk.tempatLahir,
    tanggalLahir: props.penduduk.tanggalLahir,
    jenisKelamin: props.penduduk.jenisKelamin,
    pekerjaan: props.penduduk.pekerjaan,
    kategori: props.penduduk.kategori,
    statusPerkawinan: props.penduduk.statusPerkawinan,
    alamat: props.penduduk.alamat,
    rt: props.penduduk.rt,
    rw: props.penduduk.rw,
    noRumah: props.penduduk.noRumah,
});

const submit = () => {
    form.put(route('penduduk.update', props.penduduk.nik), {
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Edit Data Penduduk" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-auto rounded-xl p-4">
            <h1 class="mb-4 text-2xl font-semibold">Edit Data Penduduk: {{ penduduk.nama }}</h1>

            <form @submit.prevent="submit" class="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- No KK -->
                    <div>
                        <label for="noKK" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            No. Kartu Keluarga <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="noKK"
                            v-model="form.noKK"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            :class="{ 'border-red-500': form.errors.noKK }"
                            required
                        >
                            <option value="">Pilih KK</option>
                            <option v-for="kk in kkList" :key="kk.noKK" :value="kk.noKK">{{ kk.noKK }} - {{ kk.kepalaKeluarga }}</option>
                        </select>
                        <p v-if="form.errors.noKK" class="mt-1 text-sm text-red-500">
                            {{ form.errors.noKK }}
                        </p>
                    </div>

                    <!-- NIK -->
                    <div>
                        <label for="nik" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            NIK <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="nik"
                            v-model="form.nik"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            :class="{ 'border-red-500': form.errors.nik }"
                            placeholder="16 digit NIK"
                            required
                        />
                        <p v-if="form.errors.nik" class="mt-1 text-sm text-red-500">
                            {{ form.errors.nik }}
                        </p>
                    </div>

                    <!-- Nama -->
                    <div>
                        <label for="nama" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="nama"
                            v-model="form.nama"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            :class="{ 'border-red-500': form.errors.nama }"
                            required
                        />
                        <p v-if="form.errors.nama" class="mt-1 text-sm text-red-500">
                            {{ form.errors.nama }}
                        </p>
                    </div>

                    <!-- Tempat Lahir -->
                    <div>
                        <label for="tempatLahir" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tempat Lahir <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="tempatLahir"
                            v-model="form.tempatLahir"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            :class="{ 'border-red-500': form.errors.tempatLahir }"
                            required
                        />
                        <p v-if="form.errors.tempatLahir" class="mt-1 text-sm text-red-500">
                            {{ form.errors.tempatLahir }}
                        </p>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        <label for="tanggalLahir" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tanggal Lahir <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="date"
                            id="tanggalLahir"
                            v-model="form.tanggalLahir"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            :class="{ 'border-red-500': form.errors.tanggalLahir }"
                            required
                        />
                        <p v-if="form.errors.tanggalLahir" class="mt-1 text-sm text-red-500">
                            {{ form.errors.tanggalLahir }}
                        </p>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label for="jenisKelamin" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Jenis Kelamin <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="jenisKelamin"
                            v-model="form.jenisKelamin"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            :class="{ 'border-red-500': form.errors.jenisKelamin }"
                            required
                        >
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <p v-if="form.errors.jenisKelamin" class="mt-1 text-sm text-red-500">
                            {{ form.errors.jenisKelamin }}
                        </p>
                    </div>

                    <!-- Pekerjaan -->
                    <div>
                        <label for="pekerjaan" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Pekerjaan <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="pekerjaan"
                            v-model="form.pekerjaan"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            :class="{ 'border-red-500': form.errors.pekerjaan }"
                            required
                        />
                        <p v-if="form.errors.pekerjaan" class="mt-1 text-sm text-red-500">
                            {{ form.errors.pekerjaan }}
                        </p>
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="kategori" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="kategori"
                            v-model="form.kategori"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            :class="{ 'border-red-500': form.errors.kategori }"
                            required
                        >
                            <option value="Bayi">Bayi</option>
                            <option value="Anak-Anak">Anak-Anak</option>
                            <option value="Remaja">Remaja</option>
                            <option value="Dewasa">Dewasa</option>
                            <option value="Lansia">Lansia</option>
                        </select>
                        <p v-if="form.errors.kategori" class="mt-1 text-sm text-red-500">
                            {{ form.errors.kategori }}
                        </p>
                    </div>

                    <!-- Status Perkawinan -->
                    <div>
                        <label for="statusPerkawinan" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Status Perkawinan <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="statusPerkawinan"
                            v-model="form.statusPerkawinan"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            :class="{ 'border-red-500': form.errors.statusPerkawinan }"
                            required
                        >
                            <option value="Belum Menikah">Belum Menikah</option>
                            <option value="Menikah">Menikah</option>
                            <option value="Cerai">Cerai</option>
                        </select>
                        <p v-if="form.errors.statusPerkawinan" class="mt-1 text-sm text-red-500">
                            {{ form.errors.statusPerkawinan }}
                        </p>
                    </div>
                    <!-- Di Form Create/Edit -->
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <!-- Ibu Hamil -->
                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" v-model="form.ibu_hamil" class="rounded" />
                                <span class="ml-2">Ibu Hamil</span>
                            </label>
                        </div>

                        <!-- Ibu Menyusui -->
                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" v-model="form.ibu_menyusui" class="rounded" />
                                <span class="ml-2">Ibu Menyusui</span>
                            </label>
                        </div>

                        <!-- Kebutuhan Khusus -->
                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" v-model="form.berkebutuhan_khusus" class="rounded" />
                                <span class="ml-2">Berkebutuhan Khusus</span>
                            </label>
                            <input
                                v-if="form.berkebutuhan_khusus"
                                v-model="form.keterangan_khusus"
                                placeholder="Jenis kebutuhan khusus"
                                class="mt-1 w-full rounded border px-2 py-1"
                            />
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="md:col-span-2">
                        <label for="alamat" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Alamat <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            id="alamat"
                            v-model="form.alamat"
                            rows="2"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            :class="{ 'border-red-500': form.errors.alamat }"
                            required
                        ></textarea>
                        <p v-if="form.errors.alamat" class="mt-1 text-sm text-red-500">
                            {{ form.errors.alamat }}
                        </p>
                    </div>

                    <!-- RT -->
                    <div>
                        <label for="rt" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            RT <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="rt"
                            v-model="form.rt"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            :class="{ 'border-red-500': form.errors.rt }"
                            required
                        />
                        <p v-if="form.errors.rt" class="mt-1 text-sm text-red-500">
                            {{ form.errors.rt }}
                        </p>
                    </div>

                    <!-- RW -->
                    <div>
                        <label for="rw" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            RW <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="rw"
                            v-model="form.rw"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            :class="{ 'border-red-500': form.errors.rw }"
                            required
                        />
                        <p v-if="form.errors.rw" class="mt-1 text-sm text-red-500">
                            {{ form.errors.rw }}
                        </p>
                    </div>

                    <!-- Nomor Rumah -->
                    <div>
                        <label for="noRumah" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nomor Rumah <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="noRumah"
                            v-model="form.noRumah"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            :class="{ 'border-red-500': form.errors.noRumah }"
                            required
                        />
                        <p v-if="form.errors.noRumah" class="mt-1 text-sm text-red-500">
                            {{ form.errors.noRumah }}
                        </p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <Link
                        href="/data-penduduk"
                        class="rounded-md bg-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-400 focus:ring-2 focus:ring-gray-500 focus:outline-none"
                    >
                        Batal
                    </Link>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:outline-none disabled:cursor-not-allowed disabled:opacity-50"
                    >
                        <span v-if="!form.processing">Perbarui Data</span>
                        <span v-else class="inline-flex items-center">
                            <svg
                                class="mr-2 -ml-1 h-4 w-4 animate-spin text-white"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path
                                    class="opacity-75"
                                    fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                ></path>
                            </svg>
                            Memproses...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
