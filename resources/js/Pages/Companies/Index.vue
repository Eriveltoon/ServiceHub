<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import { router } from "@inertiajs/vue3";

const form = useForm();

defineProps({
    companies: Array,
});

const goBack = () => {
    router.visit(route("dashboard"));
};

const destroy = (id) => {
    Swal.fire({
        title: "Tem certeza?",
        text: "Essa ação não pode ser desfeita!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Sim, excluir",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route("companies.destroy", id), {
                onSuccess: () => {
                    Swal.fire(
                        "Excluído!",
                        "A empresa foi removida com sucesso.",
                        "success",
                    );
                },
            });
        }
    });
};
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
                <div
                    v-if="$page.props.flash?.success"
                    class="mb-4 rounded-lg bg-green-100 border border-green-300 text-green-800 px-4 py-3"
                >
                    {{ $page.props.flash.success }}
                </div>

                <div
                    v-if="$page.props.flash?.error"
                    class="mb-4 rounded-lg bg-red-100 border border-red-300 text-red-800 px-4 py-3"
                >
                    {{ $page.props.flash.error }}
                </div>

                <div class="mb-6 flex justify-between items-center">
                    <h3 class="text-2xl font-bold text-gray-800">
                        Lista de Empresas
                    </h3>

                    <div class="mt-6 flex justify-end gap-3">
                        <div class="mt-6 flex items-center justify-end gap-3">
                            <button
                                type="button"
                                @click="goBack"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition focus:outline-none focus:ring-2 focus:ring-gray-300"
                            >
                                <i class="bi bi-arrow-left"></i>
                                Voltar
                            </button>

                            <Link
                                :href="route('companies.create')"
                                class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
                            >
                                <i class="bi bi-plus-lg"></i>
                                Nova Empresa
                            </Link>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div
                    class="overflow-hidden bg-white shadow-lg border border-gray-200 rounded-xl"
                >
                    <div class="p-6">
                        <div v-if="companies.length === 0">
                            Nenhuma empresa cadastrada.
                        </div>

                        <table
                            v-else
                            class="min-w-full divide-y divide-gray-200"
                        >
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"
                                    >
                                        ID
                                    </th>

                                    <th
                                        class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"
                                    >
                                        Nome
                                    </th>

                                    <th
                                        class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"
                                    >
                                        Ações
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr
                                    v-for="company in companies"
                                    :key="company.id"
                                    class="border-t hover:bg-gray-200 transition"
                                >
                                    <td class="px-4 py-4">
                                        <span
                                            class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700"
                                        >
                                            #{{ company.id }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-4">
                                        <span class="font-medium text-gray-800">
                                            {{ company.name }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-4 flex gap-2">
                                        <Link
                                            :href="
                                                route(
                                                    'companies.edit',
                                                    company.id,
                                                )
                                            "
                                            class="inline-flex items-center gap-2 rounded bg-yellow-500 px-3 py-1 text-white hover:bg-yellow-600 transition"
                                        >
                                            <i class="bi bi-pencil-square"></i>
                                        </Link>

                                        <button
                                            @click="destroy(company.id)"
                                            class="inline-flex items-center gap-2 rounded bg-red-600 px-3 py-1 text-white hover:bg-red-700 transition"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>
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
