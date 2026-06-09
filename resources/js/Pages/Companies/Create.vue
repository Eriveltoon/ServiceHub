<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
});

const submit = () => {
    form.post(route("companies.store"));
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
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <form @submit.prevent="submit">
                            <div class="mb-6">
                                <label
                                    for="name"
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Nome da Empresa
                                </label>

                                <input
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    class="w-full rounded-md border-gray-300 shadow-sm"
                                />

                                <div
                                    v-if="form.errors.name"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ form.errors.name }}
                                </div>
                            </div>

                            <button
                                type="submit"
                                class="rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700"
                            >
                                Salvar Empresa
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
