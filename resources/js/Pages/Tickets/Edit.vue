<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, router } from "@inertiajs/vue3";

const props = defineProps({
    ticket: Object,
    projects: Array,
});

const form = useForm({
    title: props.ticket.title,
    description: props.ticket.description,
    status: props.ticket.status,
    project_id: props.ticket.project_id,
    attachment_path: null,
});

// const submit = () => {
//     form.put(route("tickets.update", props.ticket.id));
// };
const submit = () => {
    form.transform((data) => ({
        ...data,
        _method: "put",
    })).post(route("tickets.update", props.ticket.id), {
        forceFormData: true,
    });
};

const goBack = () => {
    router.visit(route("tickets.index"));
};
</script>

<template>
    <Head title="Editar Ticket" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold">Editar Ticket</h2>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <form @submit.prevent="submit">
                            <!-- Projeto -->
                            <div class="mb-6">
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Projeto
                                </label>

                                <select
                                    v-model="form.project_id"
                                    class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 text-gray-900"
                                >
                                    <option value="">
                                        Selecione um projeto
                                    </option>

                                    <option
                                        v-for="project in projects"
                                        :key="project.id"
                                        :value="project.id"
                                    >
                                        {{ project.name }}
                                    </option>
                                </select>
                            </div>

                            <!-- Título -->
                            <div class="mb-6">
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Título
                                </label>

                                <input
                                    v-model="form.title"
                                    type="text"
                                    class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 text-gray-900"
                                />
                            </div>

                            <!-- Descrição -->
                            <div class="mb-6">
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Descrição
                                </label>

                                <textarea
                                    v-model="form.description"
                                    rows="4"
                                    class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 text-gray-900"
                                ></textarea>
                            </div>

                            <!-- Status -->
                            <div class="mb-6">
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Status
                                </label>

                                <select
                                    v-model="form.status"
                                    class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 text-gray-900"
                                >
                                    <option value="open">Aberto</option>
                                    <option value="in_progress">
                                        Em andamento
                                    </option>
                                    <option value="closed">Fechado</option>
                                </select>
                            </div>

                            <!-- Anexo -->
                            <div class="mb-6">
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Anexo (opcional)
                                </label>

                                <input
                                    type="file"
                                    class="w-full border-gray-300 rounded-lg p-2 text-gray-900"
                                    @change="
                                        (e) =>
                                            (form.attachment_path =
                                                e.target.files[0])
                                    "
                                />

                                <p class="text-sm text-gray-500 mt-1">
                                    Envie um novo arquivo para substituir o
                                    atual (se houver).
                                </p>
                            </div>

                            <!-- Ações -->
                            <div class="mt-6 flex justify-end gap-3">
                                <button
                                    type="button"
                                    @click="goBack"
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-100 transition"
                                >
                                    <i class="bi bi-arrow-left"></i>
                                    Voltar
                                </button>

                                <button
                                    type="submit"
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-700 transition disabled:opacity-50 disabled:cursor-not-allowed"
                                    :disabled="form.processing"
                                >
                                    <i class="bi bi-check-lg"></i>

                                    <span v-if="!form.processing">
                                        Atualizar
                                    </span>
                                    <span v-else> Salvando... </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
