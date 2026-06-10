<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";

defineProps({
    ticket: Object,
});

const goBack = () => {
    router.visit(route("tickets.index"));
};
</script>

<template>
    <Head :title="`Ticket #${ticket.id}`" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Detalhes do Ticket
            </h2>
        </template>

        <div class="py-12 bg-gray-100 min-h-screen">
            <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
                <!-- Hero -->
                <div
                    class="mb-6 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white rounded-xl p-6 shadow-lg"
                >
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-indigo-100 text-sm">
                                Ticket #{{ ticket.id }}
                            </p>

                            <h1 class="text-2xl font-bold mt-1">
                                {{ ticket.title }}
                            </h1>
                        </div>

                        <button
                            type="button"
                            @click="goBack"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-white text-indigo-700 hover:bg-gray-100 transition"
                        >
                            <i class="bi bi-arrow-left"></i>
                            Voltar
                        </button>
                    </div>
                </div>

                <!-- Informações Gerais -->
                <div
                    class="bg-white shadow-lg border border-gray-200 rounded-xl p-6"
                >
                    <h3
                        class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2"
                    >
                        <i class="bi bi-info-circle"></i>
                        Informações Gerais
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Projeto -->
                        <div
                            class="bg-blue-50 border border-blue-200 rounded-lg p-4"
                        >
                            <p
                                class="text-xs uppercase text-blue-600 font-semibold"
                            >
                                Projeto
                            </p>

                            <p class="mt-2 font-medium text-gray-800">
                                {{ ticket.project?.name ?? "-" }}
                            </p>
                        </div>

                        <!-- Empresa -->
                        <div
                            class="bg-purple-50 border border-purple-200 rounded-lg p-4"
                        >
                            <p
                                class="text-xs uppercase text-purple-600 font-semibold"
                            >
                                Empresa
                            </p>

                            <p class="mt-2 font-medium text-gray-800">
                                {{ ticket.project?.company?.name ?? "-" }}
                            </p>
                        </div>

                        <!-- Status -->
                        <div
                            class="rounded-lg p-4 border"
                            :class="{
                                'bg-green-50 border-green-200':
                                    ticket.status === 'open',

                                'bg-yellow-50 border-yellow-200':
                                    ticket.status === 'in_progress',

                                'bg-red-50 border-red-200':
                                    ticket.status === 'closed',
                            }"
                        >
                            <p
                                class="text-xs uppercase font-semibold text-gray-600"
                            >
                                Status
                            </p>

                            <p class="mt-2 font-bold text-gray-800">
                                {{
                                    ticket.status === "open"
                                        ? "Aberto"
                                        : ticket.status === "in_progress"
                                          ? "Em andamento"
                                          : "Fechado"
                                }}
                            </p>
                        </div>

                        <!-- ID -->
                        <div
                            class="bg-gray-50 border border-gray-200 rounded-lg p-4"
                        >
                            <p
                                class="text-xs uppercase text-gray-600 font-semibold"
                            >
                                Identificador
                            </p>

                            <p class="mt-2 font-medium text-gray-800">
                                #{{ ticket.id }}
                            </p>
                        </div>

                        <!-- Descrição -->
                        <div class="md:col-span-2">
                            <p
                                class="text-xs uppercase text-gray-600 font-semibold mb-2"
                            >
                                Descrição
                            </p>

                            <div
                                class="rounded-lg border border-gray-200 bg-gray-50 p-4"
                            >
                                <p class="text-gray-700 whitespace-pre-line">
                                    {{
                                        ticket.description ||
                                        "Sem descrição informada."
                                    }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dados Técnicos -->
                <div
                    v-if="ticket.detail"
                    class="mt-6 bg-white shadow-lg border border-gray-200 rounded-xl p-6"
                >
                    <h3
                        class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2"
                    >
                        <i class="bi bi-cpu"></i>
                        Dados Técnicos Processados
                    </h3>

                    <div
                        class="rounded-lg border-l-4 border-indigo-500 bg-indigo-50 p-4"
                    >
                        <div class="flex items-center gap-2 mb-3">
                            <i
                                class="bi bi-file-earmark-text text-indigo-600"
                            ></i>

                            <span class="font-semibold text-indigo-700">
                                Conteúdo Extraído do Arquivo
                            </span>
                        </div>

                        <p class="whitespace-pre-line text-gray-700">
                            {{ ticket.detail.technical_data.raw }}
                        </p>
                    </div>
                </div>

                <!-- Sem dados técnicos -->
                <div
                    v-else
                    class="mt-6 bg-yellow-50 border border-yellow-200 rounded-xl p-4"
                >
                    <div class="flex items-center gap-2">
                        <i class="bi bi-exclamation-triangle"></i>

                        <p class="text-yellow-700">
                            Este ticket ainda não possui dados técnicos
                            processados.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
