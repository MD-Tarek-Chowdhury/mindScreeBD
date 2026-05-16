<template>
    <div class="mx-auto max-w-4xl px-4 py-8">
        <h1 class="mb-6 text-2xl font-bold">Your DASS-21 Results</h1>

        <div class="grid gap-6 md:grid-cols-3">
            <div
                v-for="(score, category) in results"
                :key="category"
                class="rounded-lg bg-white p-6 shadow"
            >
                <h2 class="mb-2 text-xl font-semibold capitalize">
                    {{ category }}
                </h2>
                <p class="mb-2 text-3xl font-bold">{{ score.score }}</p>
                <p class="text-lg" :class="severityClass(score.level)">
                    {{ score.level }}
                </p>
            </div>
        </div>

        <div class="mt-8 text-center">
            <Link
                href="/assessment"
                class="rounded bg-blue-600 px-4 py-2 text-white"
                >Take Again</Link
            >
            <Link href="/" class="ml-4 text-gray-600">Home</Link>
        </div>
    </div>
</template>

<!-- eslint-disable -->
<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    results: Object, // { depression: {score, level}, anxiety: {...}, stress: {...} }
});

const severityClass = (level) => {
    const map = {
        Normal: 'text-green-600',
        Mild: 'text-yellow-600',
        Moderate: 'text-orange-600',
        Severe: 'text-red-600',
        'Extremely Severe': 'text-red-800 font-bold',
    };
    return map[level] || 'text-gray-800';
};
</script>
