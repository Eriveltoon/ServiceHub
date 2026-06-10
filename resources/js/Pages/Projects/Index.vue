<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm, router } from "@inertiajs/vue3";
import Swal from "sweetalert2";

const form = useForm();

defineProps({
    projects: Array,
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
            form.delete(route("projects.destroy", id), {
                onSuccess: () => {
                    Swal.fire(
                        "Excluído!",
                        "O projeto foi removido com sucesso.",
                        "success",
                    );
                },
            });
        }
    });
};
</script>

<template>
    <Head title="Projetos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Projetos
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- Flash -->
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

                <!-- Header -->
                <div class="mb-6 flex justify-between items-center">
                    <h3 class="text-2xl font-bold text-gray-800">
                        Lista de Projetos
                    </h3>

                    <div class="flex items-center gap-3">
                        <button
                            type="button"
                            @click="goBack"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-100 transition"
                        >
                            <i class="bi bi-arrow-left"></i>
                            Voltar
                        </button>

                        <Link
                            :href="route('projects.create')"
                            class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
                        >
                            <i class="bi bi-plus-lg"></i>
                            Novo Projeto
                        </Link>
                    </div>
                </div>

                <!-- Table -->
                <div
                    class="overflow-hidden bg-white shadow-lg border border-gray-200 rounded-xl"
                >
                    <!-- Table -->
                    <div
                        class="overflow-hidden bg-white shadow-lg border border-gray-200 rounded-xl"
                    >
                        <div class="p-6">
                            <div v-if="projects.length === 0">
                                Nenhum projeto cadastrado.
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
                                            Empresa
                                        </th>

                                        <th
                                            class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"
                                        >
                                            Descrição
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
                                        v-for="project in projects"
                                        :key="project.id"
                                        class="border-t hover:bg-gray-200 transition"
                                    >
                                        <td class="px-4 py-4">
                                            <span
                                                class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700"
                                            >
                                                #{{ project.id }}
                                            </span>
                                        </td>

                                        <td class="px-4 py-4">
                                            {{ project.name }}
                                        </td>

                                        <td class="px-4 py-4">
                                            <span
                                                class="px-2 py-1 text-xs rounded bg-purple-100 text-purple-700 font-medium"
                                            >
                                                {{
                                                    project.company?.name ?? "-"
                                                }}
                                            </span>
                                        </td>

                                        <td class="px-4 py-4 max-w-xs">
                                            <span
                                                class="block truncate"
                                                :title="project.description"
                                            >
                                                {{ project.description ?? "-" }}
                                            </span>
                                        </td>

                                        <td class="px-4 py-4 flex gap-2">
                                            <Link
                                                :href="
                                                    route(
                                                        'projects.edit',
                                                        project.id,
                                                    )
                                                "
                                                class="inline-flex items-center gap-2 rounded bg-yellow-500 px-3 py-1 text-white hover:bg-yellow-600 transition"
                                            >
                                                <i
                                                    class="bi bi-pencil-square"
                                                ></i>
                                            </Link>

                                            <button
                                                @click="destroy(project.id)"
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
        </div>
    </AuthenticatedLayout>
</template>
