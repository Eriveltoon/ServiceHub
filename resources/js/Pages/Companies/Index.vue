<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    companies: Array,
});
</script>

<template>
    <Head title="Empresas" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Empresas
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="mb-6 flex justify-between items-center">
                    <h3 class="text-2xl font-bold text-gray-800">
                        Lista de Empresas
                    </h3>

                    <Link
                        :href="route('companies.create')"
                        class="rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700"
                    >
                        Nova Empresa
                    </Link>
                </div>

                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div v-if="companies.length === 0">
                            Nenhuma empresa cadastrada.
                        </div>

                        <table
                            v-else
                            class="min-w-full divide-y divide-gray-200"
                        >
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 text-left">ID</th>

                                    <th class="px-4 py-3 text-left">Nome</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr
                                    v-for="company in companies"
                                    :key="company.id"
                                    class="border-t"
                                >
                                    <td class="px-4 py-3">
                                        {{ company.id }}
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ company.name }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
