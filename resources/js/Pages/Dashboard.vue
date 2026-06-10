<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";

defineProps({
    companiesCount: Number,
    projectsCount: Number,
    ticketsCount: Number,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- Boas-vindas -->
                <div
                    class="bg-white shadow-lg border border-gray-200 rounded-xl p-6 mb-6"
                >
                    <h3 class="text-3xl font-bold text-gray-800 mb-2">
                        Bem-vindo ao ServiceHub
                    </h3>

                    <p class="text-gray-600">
                        Sistema de gerenciamento de empresas, projetos e
                        tickets.
                    </p>
                </div>

                <!-- Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Empresas -->
                    <div
                        @click="router.visit(route('companies.index'))"
                        class="bg-white shadow-lg border border-gray-200 rounded-xl p-6 cursor-pointer hover:shadow-xl hover:-translate-y-1 transition"
                    >
                        <div class="flex items-center justify-between">
                            <h4 class="text-lg font-semibold text-gray-700">
                                Empresas
                            </h4>

                            <i
                                class="bi bi-buildings text-3xl text-blue-600"
                            ></i>
                        </div>

                        <p class="text-4xl font-bold text-blue-600 mt-4">
                            {{ companiesCount }}
                        </p>

                        <p class="text-sm text-gray-500 mt-2">
                            Empresas cadastradas
                        </p>
                    </div>

                    <!-- Projetos -->
                    <div
                        @click="router.visit(route('projects.index'))"
                        class="bg-white shadow-lg border border-gray-200 rounded-xl p-6 cursor-pointer hover:shadow-xl hover:-translate-y-1 transition"
                    >
                        <div class="flex items-center justify-between">
                            <h4 class="text-lg font-semibold text-gray-700">
                                Projetos
                            </h4>

                            <i class="bi bi-kanban text-3xl text-blue-600"></i>
                        </div>

                        <p class="text-4xl font-bold text-blue-600 mt-4">
                            {{ projectsCount }}
                        </p>

                        <p class="text-sm text-gray-500 mt-2">
                            Projetos cadastrados
                        </p>
                    </div>

                    <!-- Tickets -->
                    <div
                        @click="router.visit(route('tickets.index'))"
                        class="bg-white shadow-lg border border-gray-200 rounded-xl p-6 cursor-pointer hover:shadow-xl hover:-translate-y-1 transition"
                    >
                        <div class="flex items-center justify-between">
                            <h4 class="text-lg font-semibold text-gray-700">
                                Tickets
                            </h4>

                            <i
                                class="bi bi-ticket-perforated text-3xl text-blue-600"
                            ></i>
                        </div>

                        <p class="text-4xl font-bold text-blue-600 mt-4">
                            {{ ticketsCount }}
                        </p>

                        <p class="text-sm text-gray-500 mt-2">
                            Tickets cadastrados
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
