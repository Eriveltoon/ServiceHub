<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, router } from "@inertiajs/vue3";

defineProps({
    projects: Array,
});

const form = useForm({
    project_id: "",
    title: "",
    description: "",
    status: "open",
    attachment_path: null,
});

const submit = () => {
    form.post(route("tickets.store"), {
        forceFormData: true,
    });
};

const goBack = () => {
    router.visit(route("tickets.index"));
};

const handleFileUpload = (e) => {
    form.attachment_path = e.target.files[0];
};
</script>

<template>
    <Head title="Novo Ticket" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Novo Ticket
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-lg border border-gray-200 rounded-xl"
                >
                    <div class="p-6">
                        <div class="mb-8 border-b border-gray-200 pb-4">
                            <h3 class="text-2xl font-bold text-gray-800">
                                Cadastro de Ticket
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Preencha os dados abaixo para criar um novo
                                ticket.
                            </p>
                        </div>
                        <form @submit.prevent="submit">
                            <!-- Projeto -->
                            <div class="mb-6">
                                <label
                                    class="block text-sm font-semibold text-gray-700 mb-2"
                                >
                                    Projeto
                                </label>

                                <select
                                    v-model="form.project_id"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-200"
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

                                <div
                                    v-if="form.errors.project_id"
                                    class="mt-2 text-sm font-medium text-red-600"
                                >
                                    {{ form.errors.project_id }}
                                </div>
                            </div>

                            <!-- Título -->
                            <div class="mb-6">
                                <label
                                    class="block text-sm font-semibold text-gray-700 mb-2"
                                >
                                    Título do Ticket
                                </label>

                                <input
                                    v-model="form.title"
                                    type="text"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-200"
                                />

                                <div
                                    v-if="form.errors.title"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ form.errors.title }}
                                </div>
                            </div>

                            <div class="mb-6">
                                <label
                                    class="block text-sm font-semibold text-gray-700 mb-2"
                                >
                                    Status
                                </label>

                                <select
                                    v-model="form.status"
                                    class="w-full rounded-md border-gray-300 shadow-sm"
                                >
                                    <option value="open">Aberto</option>
                                    <option value="in_progress">
                                        Em andamento
                                    </option>
                                    <option value="closed">Fechado</option>
                                </select>

                                <div
                                    v-if="form.errors.status"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ form.errors.status }}
                                </div>
                            </div>

                            <!-- Descrição -->
                            <div class="mb-6">
                                <label
                                    class="block text-sm font-semibold text-gray-700 mb-2"
                                >
                                    Descrição
                                </label>

                                <textarea
                                    v-model="form.description"
                                    rows="4"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-200"
                                ></textarea>

                                <div
                                    v-if="form.errors.description"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ form.errors.description }}
                                </div>
                            </div>

                            <div class="mb-6">
                                <label
                                    class="block text-sm font-semibold text-gray-700 mb-2"
                                >
                                    Anexo (opcional)
                                </label>

                                <input
                                    type="file"
                                    @change="handleFileUpload"
                                    class="w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm"
                                />
                            </div>

                            <!-- Ações -->
                            <div
                                class="mt-6 flex items-center justify-end gap-3"
                            >
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
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-700 transition disabled:opacity-50"
                                    :disabled="form.processing"
                                >
                                    <i class="bi bi-save"></i>
                                    Salvar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
