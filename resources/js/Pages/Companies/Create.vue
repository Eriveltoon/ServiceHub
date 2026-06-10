<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";

const form = useForm({
    name: "",
});

const submit = () => {
    form.post(route("companies.store"));
};

const goBack = () => {
    router.visit(route("companies.index"));
};
</script>

<template>
    <Head title="Nova Empresa" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Nova Empresa
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
                                Cadastro de Empresas
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Preencha os dados abaixo para criar uma nova
                                empresa.
                            </p>
                        </div>
                        <form @submit.prevent="submit">
                            <div class="mb-6">
                                <label
                                    for="name"
                                    class="block text-sm font-semibold text-gray-700 mb-2"
                                >
                                    Nome da Empresa
                                </label>

                                <input
                                    id="name"
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

                            <div class="mt-6 flex justify-end gap-3">
                                <div
                                    class="mt-6 flex items-center justify-end gap-3"
                                >
                                    <button
                                        type="button"
                                        @click="goBack"
                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition focus:outline-none focus:ring-2 focus:ring-gray-300"
                                    >
                                        <i class="bi bi-arrow-left"></i>
                                        Voltar
                                    </button>

                                    <button
                                        type="submit"
                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-700 transition focus:outline-none focus:ring-2 focus:ring-blue-400 disabled:opacity-50 disabled:cursor-not-allowed"
                                    >
                                        <i class="bi bi-save"></i>
                                        Salvar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
