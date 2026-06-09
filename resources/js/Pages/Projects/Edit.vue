<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, router } from "@inertiajs/vue3";

const props = defineProps({
    project: Object,
    companies: Array,
});

const form = useForm({
    name: props.project.name,
    description: props.project.description,
    company_id: props.project.company_id,
});

const submit = () => {
    form.put(route("projects.update", props.project.id));
};

const goBack = () => {
    router.visit(route("projects.index"));
};
</script>

<template>
    <Head title="Editar Projeto" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold">Editar Projeto</h2>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <form @submit.prevent="submit">
                            <!-- Empresa -->
                            <div class="mb-6">
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Empresa
                                </label>

                                <select
                                    v-model="form.company_id"
                                    class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 text-gray-900"
                                >
                                    <option value="">
                                        Selecione uma empresa
                                    </option>

                                    <option
                                        v-for="company in companies"
                                        :key="company.id"
                                        :value="company.id"
                                    >
                                        {{ company.name }}
                                    </option>
                                </select>
                            </div>

                            <!-- Nome -->
                            <div class="mb-6">
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Nome do Projeto
                                </label>

                                <input
                                    v-model="form.name"
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
