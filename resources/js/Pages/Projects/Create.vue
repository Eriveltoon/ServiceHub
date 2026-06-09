<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, router } from "@inertiajs/vue3";

defineProps({
    companies: Array,
});

const form = useForm({
    name: "",
    company_id: "",
    description: "",
});

const submit = () => {
    form.post(route("projects.store"));
};

const goBack = () => {
    router.visit(route("projects.index"));
};
</script>

<template>
    <Head title="Novo Projeto" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Novo Projeto
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
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
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-200"
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

                                <div
                                    v-if="form.errors.company_id"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ form.errors.company_id }}
                                </div>
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
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-200"
                                />

                                <div
                                    v-if="form.errors.name"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ form.errors.name }}
                                </div>
                            </div>

                            <div class="mb-6">
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2"
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
