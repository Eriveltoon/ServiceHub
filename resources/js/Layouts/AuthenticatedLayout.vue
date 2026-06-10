<script setup>
import { ref } from "vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <!-- NAVBAR -->
            <nav class="border-b border-indigo-800 bg-indigo-700">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between">
                        <!-- ESQUERDA -->
                        <div class="flex">
                            <!-- LOGO -->
                            <div class="flex shrink-0 items-center">
                                <Link
                                    :href="route('dashboard')"
                                    class="text-2xl font-bold text-white"
                                >
                                    ServiceHub
                                </Link>
                            </div>

                            <!-- MENU -->
                            <div
                                class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"
                            >
                                <NavLink
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')"
                                >
                                    <i class="bi bi-speedometer2 me-2"></i>
                                    Dashboard
                                </NavLink>

                                <NavLink
                                    :href="route('companies.index')"
                                    :active="route().current('companies.*')"
                                >
                                    <i class="bi bi-buildings me-2"></i>
                                    Empresas
                                </NavLink>

                                <NavLink
                                    :href="route('projects.index')"
                                    :active="route().current('projects.*')"
                                >
                                    <i class="bi bi-kanban me-2"></i>
                                    Projetos
                                </NavLink>

                                <NavLink
                                    :href="route('tickets.index')"
                                    :active="route().current('tickets.*')"
                                >
                                    <i class="bi bi-ticket-perforated me-2"></i>
                                    Tickets
                                </NavLink>
                            </div>
                        </div>

                        <!-- DIREITA -->
                        <div class="hidden sm:ms-6 sm:flex sm:items-center">
                            <div class="relative ms-3">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center gap-2 rounded-md border border-transparent px-3 py-2 text-sm font-medium text-white hover:text-green-100 focus:outline-none"
                                            >
                                                <i
                                                    class="bi bi-person-circle text-lg"
                                                ></i>

                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink
                                            :href="route('profile.edit')"
                                        >
                                            <i class="bi bi-person me-2"></i>
                                            Perfil
                                        </DropdownLink>

                                        <DropdownLink
                                            :href="route('logout')"
                                            method="post"
                                            as="button"
                                        >
                                            <i
                                                class="bi bi-box-arrow-right me-2"
                                            ></i>
                                            Sair
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- MOBILE -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                                class="inline-flex items-center justify-center rounded-md p-2 text-gray-300 hover:bg-slate-700 hover:text-white"
                            >
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />

                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- MENU MOBILE -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden bg-slate-900"
                >
                    <div class="space-y-1 pb-3 pt-2">
                        <ResponsiveNavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                        >
                            Dashboard
                        </ResponsiveNavLink>

                        <ResponsiveNavLink
                            :href="route('companies.index')"
                            :active="route().current('companies.*')"
                        >
                            Empresas
                        </ResponsiveNavLink>

                        <ResponsiveNavLink
                            :href="route('projects.index')"
                            :active="route().current('projects.*')"
                        >
                            Projetos
                        </ResponsiveNavLink>

                        <ResponsiveNavLink
                            :href="route('tickets.index')"
                            :active="route().current('tickets.*')"
                        >
                            Tickets
                        </ResponsiveNavLink>
                    </div>
                </div>
            </nav>

            <!-- HEADER -->
            <header
                class="bg-slate-50 border-b border-gray-200"
                v-if="$slots.header"
            >
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- CONTEÚDO -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
