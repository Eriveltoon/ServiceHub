<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Registro" />

        <div class="flex items-center justify-center bg-gray-50 px-3 py-3">
            <!-- CARD igual login -->
            <div
                class="w-full max-w-md bg-white rounded-xl border border-gray-200 shadow-2xl"
            >
                <!-- Header -->
                <div class="px-6 py-2 mt-5 border-b border-gray-100">
                    <h1 class="text-xl font-semibold text-gray-800">
                        Criar conta
                    </h1>
                    <p class="text-sm text-gray-500 mt-1">
                        Preencha os dados para acessar o sistema
                    </p>
                </div>

                <div class="p-6">
                    <form @submit.prevent="submit">
                        <!-- Name -->
                        <div>
                            <InputLabel for="name" value="Nome" />

                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                required
                                autofocus
                                autocomplete="name"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.name"
                            />
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <InputLabel for="email" value="E-mail" />

                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                required
                                autocomplete="username"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.email"
                            />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <InputLabel for="password" value="Senha" />

                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.password"
                                required
                                autocomplete="new-password"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.password"
                            />
                        </div>

                        <!-- Confirm -->
                        <div class="mt-4">
                            <InputLabel
                                for="password_confirmation"
                                value="Confirmar senha"
                            />

                            <TextInput
                                id="password_confirmation"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.password_confirmation"
                                required
                                autocomplete="new-password"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.password_confirmation"
                            />
                        </div>

                        <!-- Actions -->
                        <div class="mt-6 flex flex-col gap-3">
                            <PrimaryButton
                                class="w-full justify-center bg-indigo-700 hover:bg-indigo-800"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Criar conta
                            </PrimaryButton>

                            <div class="text-sm text-center">
                                <Link
                                    :href="route('login')"
                                    class="text-indigo-700 hover:text-indigo-900"
                                >
                                    Já tenho uma conta
                                </Link>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
