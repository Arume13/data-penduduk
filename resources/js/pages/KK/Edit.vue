<script setup>
import { Head, router, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    kk: Object,
    breadcrumbs: Array
});

const form = useForm({
    noKK: props.kk.noKK,
    kepalaKeluarga: props.kk.kepalaKeluarga,
    alamat: props.kk.alamat,
    rt: props.kk.rt,
    rw: props.kk.rw,
    noRumah: props.kk.noRumah
});

const submit = () => {
    form.put(route('kk.update', props.kk.noKK), {
        onSuccess: () => {
            // Notifikasi atau redirect tambahan jika diperlukan
        },
        preserveScroll: true
    });
};
</script>

<template>
    <Head title="Edit Data KK" />
    
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-auto">
            <h1 class="text-2xl font-semibold mb-4">Edit Data KK: {{ kk.noKK }}</h1>
            
            <form @submit.prevent="submit" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- No KK (readonly) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Nomor Kartu Keluarga
                        </label>
                        <input
                            type="text"
                            v-model="form.noKK"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-gray-100 dark:bg-gray-700 cursor-not-allowed"
                            readonly
                            disabled
                        />
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
                            :class="{ 'border-red-500': form.errors.kepalaKeluarga }"
                        />
                        <p v-if="form.errors.kepalaKeluarga" class="mt-1 text-sm text-red-500">
                            {{ form.errors.kepalaKeluarga }}
                        </p>
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
                            :class="{ 'border-red-500': form.errors.alamat }"
                        ></textarea>
                        <p v-if="form.errors.alamat" class="mt-1 text-sm text-red-500">
                            {{ form.errors.alamat }}
                        </p>
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
                            :class="{ 'border-red-500': form.errors.rt }"
                        />
                        <p v-if="form.errors.rt" class="mt-1 text-sm text-red-500">
                            {{ form.errors.rt }}
                        </p>
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
                            :class="{ 'border-red-500': form.errors.rw }"
                        />
                        <p v-if="form.errors.rw" class="mt-1 text-sm text-red-500">
                            {{ form.errors.rw }}
                        </p>
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
                            :class="{ 'border-red-500': form.errors.noRumah }"
                        />
                        <p v-if="form.errors.noRumah" class="mt-1 text-sm text-red-500">
                            {{ form.errors.noRumah }}
                        </p>
                    </div>
                </div>

                <div class="flex justify-end mt-6 space-x-3">
                    <button
                        type="button"
                        @click="router.get(route('kk.index'))"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500"
                    >
                        Batal
                    </button>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <span v-if="!form.processing">Perbarui Data</span>
                        <span v-else class="inline-flex items-center">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Memproses...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
