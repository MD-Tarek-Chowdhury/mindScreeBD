<template>
    <div class="mx-auto max-w-3xl px-4 py-8">
        <h1 class="mb-6 text-2xl font-bold">DASS-21 Assessment</h1>
        <form @submit.prevent="submitForm">
            <div
                v-for="(question, index) in questions"
                :key="index"
                class="mb-6 rounded bg-white p-4 shadow"
            >
                <p class="mb-2 font-medium">
                    {{ index + 1 }}. {{ question.text }}
                </p>
                <div class="flex space-x-4">
                    <label
                        v-for="option in options"
                        :key="option.value"
                        class="inline-flex items-center"
                    >
                        <input
                            type="radio"
                            :value="option.value"
                            v-model="answers[index]"
                            class="mr-1"
                            required
                        />
                        {{ option.label }}
                    </label>
                </div>
            </div>

            <div
                v-if="formErrors.length"
                class="mb-4 rounded bg-red-100 p-3 text-red-700"
            >
                <ul>
                    <!-- eslint-disable -->
                    <li v-for="err in formErrors">{{ err }}</li>
                </ul>
            </div>

            <button
                type="submit"
                :disabled="submitting"
                class="rounded bg-blue-600 px-6 py-2 text-white hover:bg-blue-700"
            >
                {{ submitting ? 'Submitting...' : 'Submit Assessment' }}
            </button>
        </form>
    </div>
</template>

<!-- eslint-disable -->
<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const questions = [
    'নিজেকে শান্ত করতে আমার কষ্ট হয়েছে',
    'আমার মুখ শুকিয়ে যাওয়ার অনুভূতি হয়েছে',
    'আমি কোনো ইতিবাচক অনুভূতি পাইনি',
    'আমার শ্বাস নিতে কষ্ট হয়েছে',
    'কিছু করার উদ্যোগ নিতে আমার কষ্ট হয়েছে',
    'আমি অতিরিক্ত প্রতিক্রিয়া দেখিয়েছি',
    'আমার হাত-পা কাঁপছে',
    'আমি অনেক নার্ভাস এনার্জি ব্যবহার করছি বলে মনে হয়েছে',
    'আমি এমন পরিস্থিতি নিয়ে চিন্তিত ছিলাম যেখানে আমি আতঙ্কিত হতে পারি',
    'ভবিষ্যতে করার মতো কিছু নেই বলে মনে হয়েছে',
    'আমি নিজেকে অস্থির মনে করছি',
    'নিজেকে শিথিল করতে আমার কষ্ট হয়েছে',
    'আমি দুঃখী ও হতাশ বোধ করেছি',
    'কাজ শেষ করতে বাধা দেয় এমন কিছুতে আমি অসহিষ্ণু ছিলাম',
    'আমি আতঙ্কিত বোধ করেছি',
    'কোনো কিছুতে উৎসাহিত হতে পারিনি',
    'আমি নিজেকে মূল্যহীন মনে করেছি',
    'আমি বেশ স্পর্শকাতর ছিলাম',
    'আমার হৃদস্পন্দনের গতি বেড়েছে বলে অনুভব করেছি',
    'কোনো কারণ ছাড়াই ভয় পেয়েছি',
    'জীবন অর্থহীন মনে হয়েছে',
];

const options = [
    { value: 0, label: 'কখনই না' },
    { value: 1, label: 'মাঝে মাঝে' },
    { value: 2, label: 'প্রায়ই' },
    { value: 3, label: 'অনেক সময়' },
];

const answers = ref(Array(21).fill(null));
const submitting = ref(false);
const formErrors = ref([]);

const form = useForm({ answers: [] });

const submitForm = () => {
    if (answers.value.some((a) => a === null)) {
        formErrors.value = ['Please answer all 21 questions.'];
        return;
    }
    formErrors.value = [];
    submitting.value = true;
    form.answers = answers.value;
    form.post('/assessment', {
        preserveState: false,
        onSuccess: () => {
            submitting.value = false;
        },
        onError: (errors) => {
            submitting.value = false;
            if (errors.answers) formErrors.value = [errors.answers];
        },
    });
};
</script>
