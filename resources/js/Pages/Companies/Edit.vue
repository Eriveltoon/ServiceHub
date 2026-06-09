<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    company: Object,
});

const form = useForm({
    name: props.company.name,
});

const submit = () => {
    form.put(route("companies.update", props.company.id));
};

const goBack = () => {
    router.visit(route("companies.index"));
};
</script>

<template>
    <Head title="Editar Empresa" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold">Editar Empresa</h2>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <form @submit.prevent="submit">
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Nome da Empresa
                                </label>

                                <input
                                    v-model="form.name"
                                    type="text"
                                    class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-900"
                                />
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
                                        :disabled="form.processing"
                                    >
                                        <i class="bi bi-check-lg"></i>

                                        <span v-if="!form.processing"
                                            >Atualizar</span
                                        >
                                        <span v-else>Salvando...</span>
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
