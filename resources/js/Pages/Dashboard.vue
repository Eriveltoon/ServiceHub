<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <!-- <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2> -->
        </template>

        <div class="py-12">
            <div class="p-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-2">
                    Bem-vindo ao ServiceHub
                </h3>

                <p class="text-gray-600 mb-6">
                    Sistema de gerenciamento de empresas, projetos e tickets.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h4 class="text-lg font-semibold text-gray-700">
                            Empresas
                        </h4>
                        <p class="text-3xl font-bold text-indigo-600 mt-3">0</p>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <h4 class="text-lg font-semibold text-gray-700">
                            Projetos
                        </h4>
                        <p class="text-3xl font-bold text-indigo-600 mt-3">0</p>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <h4 class="text-lg font-semibold text-gray-700">
                            Tickets
                        </h4>
                        <p class="text-3xl font-bold text-indigo-600 mt-3">0</p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
