<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

// const vMaska = vMaska;
const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
    phone: user.profile?.phone ?? "",
    position: user.profile?.position ?? "",
});

console.log(user);

const maskPhone = (event) => {
    let input = event.target;
    let value = input.value;

    // guarda posição do cursor
    let cursorPosition = input.selectionStart;

    // remove tudo que não é número
    let numbers = value.replace(/\D/g, "");

    // limita 11 dígitos
    numbers = numbers.slice(0, 11);

    let formatted = "";

    if (numbers.length > 10) {
        // (11) 99999-9999
        formatted = numbers.replace(/^(\d{2})(\d{5})(\d{0,4})$/, "($1) $2-$3");
    } else if (numbers.length > 6) {
        // (11) 9999-9999 (parcial)
        formatted = numbers.replace(/^(\d{2})(\d{4})(\d{0,4})$/, "($1) $2-$3");
    } else if (numbers.length > 2) {
        formatted = numbers.replace(/^(\d{2})(\d{0,5})$/, "($1) $2");
    } else {
        formatted = numbers;
    }

    form.phone = formatted;
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Informações do Perfil
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Atualize seus dados pessoais e informações profissionais.
            </p>
        </header>

        <form
            @submit.prevent="form.patch(route('profile.update'))"
            class="mt-6 space-y-6"
        >
            <!-- Nome -->
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

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <!-- Email -->
            <div>
                <InputLabel for="email" value="E-mail" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <!-- Telefone (UserProfile) -->
            <div>
                <InputLabel for="phone" value="Telefone" />

                <TextInput
                    id="phone"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.phone"
                    autocomplete="tel"
                    maxlength="15"
                    @input="maskPhone"
                />

                <InputError class="mt-2" :message="form.errors.phone" />
            </div>

            <!-- Cargo (UserProfile) -->
            <div>
                <InputLabel for="position" value="Cargo" />

                <TextInput
                    id="position"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.position"
                    autocomplete="organization-title"
                />

                <InputError class="mt-2" :message="form.errors.position" />
            </div>

            <!-- Verificação de email -->
            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="mt-2 text-sm text-gray-800">
                    Seu e-mail ainda não foi verificado.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="rounded-md text-sm text-gray-600 underline hover:text-gray-900"
                    >
                        Reenviar e-mail de verificação
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 text-sm font-medium text-green-600"
                >
                    Um novo link de verificação foi enviado para o seu e-mail.
                </div>
            </div>

            <!-- Botão -->
            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">
                    Salvar
                </PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600"
                    >
                        Salvo.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
