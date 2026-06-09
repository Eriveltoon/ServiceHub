<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm, router } from "@inertiajs/vue3";
import Swal from "sweetalert2";

const form = useForm();

defineProps({
    tickets: Array,
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
            form.delete(route("tickets.destroy", id), {
                onSuccess: () => {
                    Swal.fire(
                        "Excluído!",
                        "O ticket foi removido com sucesso.",
                        "success",
                    );
                },
            });
        }
    });
};
</script>

<template>
    <Head title="Tickets" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Tickets
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
                        Lista de Tickets
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
                            :href="route('tickets.create')"
                            class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
                        >
                            <i class="bi bi-plus-lg"></i>
                            Novo Ticket
                        </Link>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div v-if="tickets.length === 0">
                            Nenhum ticket cadastrado.
                        </div>

                        <table
                            v-else
                            class="min-w-full divide-y divide-gray-200"
                        >
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 text-left">ID</th>
                                    <th class="px-4 py-3 text-left">Título</th>
                                    <th class="px-4 py-3 text-left">Projeto</th>
                                    <th class="px-4 py-3 text-left">Empresa</th>
                                    <th class="px-4 py-3 text-left">Status</th>
                                    <th class="px-4 py-3 text-left">Ações</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr
                                    v-for="ticket in tickets"
                                    :key="ticket.id"
                                    class="border-t"
                                >
                                    <td class="px-4 py-3">
                                        {{ ticket.id }}
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ ticket.title ?? ticket.name }}
                                    </td>

                                    <td class="px-4 py-3">
                                        <span
                                            class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-700 font-medium"
                                        >
                                            {{ ticket.project?.name ?? "-" }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3">
                                        <span
                                            class="px-2 py-1 text-xs rounded bg-purple-100 text-purple-700 font-medium"
                                        >
                                            {{
                                                ticket.project?.company?.name ??
                                                "-"
                                            }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3">
                                        <span
                                            class="px-2 py-1 text-xs rounded font-medium"
                                            :class="{
                                                'bg-green-100 text-green-700':
                                                    ticket.status === 'open',
                                                'bg-yellow-100 text-yellow-700':
                                                    ticket.status ===
                                                    'in_progress',
                                                'bg-red-100 text-red-700':
                                                    ticket.status === 'closed',
                                            }"
                                        >
                                            {{
                                                ticket.status === "open"
                                                    ? "Aberto"
                                                    : ticket.status ===
                                                        "in_progress"
                                                      ? "Em andamento"
                                                      : "Fechado"
                                            }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3 flex gap-2">
                                        <Link
                                            :href="
                                                route('tickets.edit', ticket.id)
                                            "
                                            class="inline-flex items-center gap-2 rounded bg-yellow-500 px-3 py-1 text-white hover:bg-yellow-600 transition"
                                        >
                                            <i class="bi bi-pencil-square"></i>
                                            Editar
                                        </Link>

                                        <button
                                            @click="destroy(ticket.id)"
                                            class="inline-flex items-center gap-2 rounded bg-red-600 px-3 py-1 text-white hover:bg-red-700 transition"
                                        >
                                            <i class="bi bi-trash"></i>
                                            Excluir
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
