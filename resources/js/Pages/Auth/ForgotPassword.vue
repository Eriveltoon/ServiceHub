<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
});

const submit = () => {
    form.post(route("password.email"));
};
</script>

<template>
    <GuestLayout>
        <Head title="Recuperar senha" />

        <div
            class="min-h-screen flex items-center justify-center bg-gray-50 px-4"
        >
            <!-- CARD padrão sistema -->
            <div
                class="w-full max-w-md bg-white rounded-xl border border-gray-200 shadow-2xl"
            >
                <!-- Header -->
                <div class="px-6 py-5 border-b border-gray-100 mt-2">
                    <h1 class="text-xl font-semibold text-gray-800">
                        Recuperar senha
                    </h1>
                    <p class="text-sm text-gray-500 mt-1">
                        Informe seu e-mail para receber o link de redefinição
                    </p>
                </div>

                <div class="p-6">
                    <!-- Status -->
                    <div
                        v-if="status"
                        class="mb-4 text-sm font-medium text-green-600"
                    >
                        {{ status }}
                    </div>

                    <!-- Info -->
                    <p class="text-sm text-gray-600 mb-4">
                        Enviaremos um link para redefinir sua senha caso o
                        e-mail esteja cadastrado no sistema.
                    </p>

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

                        <!-- Actions -->
                        <div class="mt-6">
                            <PrimaryButton
                                class="w-full justify-center bg-indigo-700 hover:bg-indigo-800"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Enviar link de recuperação
                            </PrimaryButton>

                            <div class="mt-4 text-center">
                                <Link
                                    :href="route('login')"
                                    class="text-sm text-indigo-700 hover:text-indigo-900"
                                >
                                    Voltar para o login
                                </Link>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
