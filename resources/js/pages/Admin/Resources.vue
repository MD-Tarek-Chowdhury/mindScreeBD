<template>
    <div class="mx-auto max-w-5xl px-4 py-8">
        <h1 class="mb-6 text-2xl font-bold">Manage Mental Health Resources</h1>

        <!-- Create Form -->
        <form
            @submit.prevent="createResource"
            class="mb-8 rounded bg-white p-4 shadow"
        >
            <h2 class="mb-2 text-lg font-semibold">Add New Resource</h2>
            <div class="grid gap-4 md:grid-cols-2">
                <input
                    v-model="newResource.name"
                    placeholder="Name"
                    required
                    class="rounded border p-2"
                />
                <select
                    v-model="newResource.type"
                    required
                    class="rounded border p-2"
                >
                    <option value="Helpline">Helpline</option>
                    <option value="Counseling Center">Counseling Center</option>
                    <option value="Hospital">Hospital</option>
                </select>
                <input
                    v-model="newResource.phone"
                    placeholder="Phone"
                    class="rounded border p-2"
                />
                <input
                    v-model="newResource.address"
                    placeholder="Address"
                    class="rounded border p-2"
                />
                <label class="flex items-center">
                    <input
                        type="checkbox"
                        v-model="newResource.is_24_7"
                        class="mr-2"
                    />
                    24/7 Available
                </label>
            </div>
            <button
                type="submit"
                class="mt-4 rounded bg-green-600 px-4 py-2 text-white"
            >
                Create
            </button>
        </form>

        <!-- Resources List -->
        <div class="overflow-hidden rounded bg-white shadow">
            <table class="min-w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 text-left">Name</th>
                        <th>Type</th>
                        <th>Phone</th>
                        <th>24/7</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="resource in resources"
                        :key="resource.id"
                        class="border-t"
                    >
                        <td class="p-2">{{ resource.name }}</td>
                        <td class="p-2">{{ resource.type }}</td>
                        <td class="p-2">{{ resource.phone || '-' }}</td>
                        <td class="p-2">
                            {{ resource.is_24_7 ? 'Yes' : 'No' }}
                        </td>
                        <td class="p-2">
                            <button
                                @click="deleteResource(resource.id)"
                                class="text-red-600"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div
            v-if="$page.props.flash.message"
            class="mt-4 rounded bg-green-100 p-2 text-green-700"
        >
            {{ $page.props.flash.message }}
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm, router } from '@inertiajs/vue3';

defineProps({
    resources: Array,
});

const newResource = ref({
    name: '',
    type: 'Helpline',
    phone: '',
    address: '',
    is_24_7: false,
});

const createResource = () => {
    const form = useForm(newResource.value);
    form.post('/admin/resources', {
        preserveScroll: true,
        onSuccess: () => {
            newResource.value = {
                name: '',
                type: 'Helpline',
                phone: '',
                address: '',
                is_24_7: false,
            };
        },
    });
};

const deleteResource = (id) => {
    if (confirm('Delete this resource?')) {
        router.delete(`/admin/resources/${id}`, { preserveScroll: true });
    }
};
</script>
