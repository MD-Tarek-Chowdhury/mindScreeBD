<template>
    <div class="min-h-screen bg-gray-50">
        <div class="mx-auto max-w-4xl px-4 py-16 text-center">
            <h1 class="mb-4 text-4xl font-bold text-gray-800">MindScreen BD</h1>
            <p class="mb-8 text-lg text-gray-600">
                Mental Wellness Portal — DASS-21 Screening
            </p>

            <div class="mb-8 rounded-lg bg-white p-6 shadow-md">
                <p class="mb-4">
                    Laravel v{{ laravelVersion }} | PHP v{{ phpVersion }}
                </p>
                <div v-if="canLogin" class="space-x-4">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="'/dashboard'"
                        class="text-blue-600"
                        >Dashboard</Link
                    >
                    <template v-else>
                        <Link :href="'/login'" class="text-blue-600"
                            >Login</Link
                        >
                        <Link
                            v-if="canRegister"
                            :href="'/register'"
                            class="text-blue-600"
                            >Register</Link
                        >
                    </template>
                </div>
            </div>

            <Link
                :href="'/assessment'"
                class="rounded-lg bg-blue-600 px-6 py-3 text-white hover:bg-blue-700"
            >
                Start DASS-21 Screening
            </Link>
        </div>
    </div>
</template>

<!-- eslint-disable -->
<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>
