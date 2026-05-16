<template>
    <div class="px-4 py-8">
        <h1 class="text-2xl font-bold">Dashboard</h1>
        <p>Welcome, {{ $page.props.auth.user.name }}!</p>
        <Link
            href="/assessment"
            class="mt-4 inline-block rounded bg-blue-600 px-4 py-2 text-white"
            >Take Assessment</Link
        >
    </div>
</template>

<!-- eslint-disable -->
<script setup>
import { Link } from '@inertiajs/vue3';
</script>
