<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    users: {
        type: Object,
        required: true,
    },
    userRole: {
        type: Object,
        required: true,
    },
});

console.log(props.userRole);
</script>

<template>
    <Head title="Manage Users" />

    <AppLayout>
        <template #header>
            <h2 class="text-xl leading-tight font-semibold text-gray-800">Manajemen User</h2>
        </template>

        <div class="py-6">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-200 bg-white p-6">
                        <div class="mb-4">
                            <Link
                                v-if="props.userRole !== 'anggota'"
                                :href="route('users.create')"
                                class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
                            >
                                Tambah User Baru
                            </Link>
                        </div>

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-left text-sm text-gray-500">
                                <thead class="bg-gray-50 text-xs text-gray-700 uppercase">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Nama</th>
                                        <th scope="col" class="px-6 py-3">Email</th>
                                        <th scope="col" class="px-6 py-3">Role</th>
                                        <th scope="col" class="px-6 py-3">Tanggal Daftar</th>
                                        <th scope="col" class="px-6 py-3" v-if="props.userRole !== 'anggota'">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in users" :key="user.id" class="border-b bg-white hover:bg-gray-50">
                                        <td class="px-6 py-4 font-medium whitespace-nowrap text-gray-900">
                                            {{ user.name }}
                                        </td>
                                        <td class="px-6 py-4">{{ user.email }}</td>
                                        <td class="px-6 py-4">{{ user.role }}</td>
                                        <td class="px-6 py-4">{{ user.created_at }}</td>
                                        <td class="space-x-2 px-6 py-4">
                                            <Link
                                                v-if="props.userRole !== 'anggota'"
                                                :href="route('users.edit', user.id)"
                                                class="rounded bg-yellow-500 px-3 py-1 text-white hover:bg-yellow-600"
                                            >
                                                Edit
                                            </Link>
                                            <Link
                                                v-if="props.userRole !== 'anggota'"
                                                :href="route('users.destroy', user.id)"
                                                method="delete"
                                                as="button"
                                                class="rounded bg-red-600 px-3 py-1 text-white hover:bg-red-700"
                                            >
                                                Hapus
                                            </Link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
