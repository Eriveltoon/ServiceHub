<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Login" />

        <div class="flex items-center justify-center bg-gray-50 px-4">
            <!-- CARD elevado (mais forte, como primeira sugestão) -->
            <div
                class="w-full max-w-md rounded-xl border border-gray-200 shadow-2xl"
            >
                <!-- Header estilo dashboard -->
                <div class="px-6 py-5 border-b border-gray-100">
                    <h1 class="text-xl font-semibold text-gray-800">
                        Acesso ao sistema
                    </h1>
                    <p class="text-sm text-gray-500 mt-1">
                        Entre com suas credenciais para continuar
                    </p>
                </div>

                <div class="p-6">
                    <div v-if="status" class="mb-4 text-sm text-green-600">
                        {{ status }}
                    </div>

                    <form @submit.prevent="submit">
                        <!-- Email -->
                        <div>
                            <InputLabel for="email" value="E-mail" />

                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                required
                                autofocus
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
                                autocomplete="current-password"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.password"
                            />
                        </div>

                        <!-- Remember -->
                        <div class="mt-4 flex items-center">
                            <label class="flex items-center">
                                <Checkbox
                                    name="remember"
                                    v-model:checked="form.remember"
                                />
                                <span class="ms-2 text-sm text-gray-600">
                                    Lembrar de mim
                                </span>
                            </label>
                        </div>

                        <!-- Actions -->
                        <div class="mt-6 flex flex-col gap-3">
                            <PrimaryButton
                                class="w-full justify-center bg-indigo-700 hover:bg-indigo-800"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Entrar
                            </PrimaryButton>

                            <div
                                class="flex items-center justify-between text-sm"
                            >
                                <Link
                                    :href="route('register')"
                                    class="text-indigo-700 hover:text-indigo-900"
                                >
                                    Criar conta
                                </Link>

                                <Link
                                    v-if="canResetPassword"
                                    :href="route('password.request')"
                                    class="text-gray-600 hover:text-gray-900"
                                >
                                    Esqueci minha senha
                                </Link>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
