<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
    metrics: Object
})

const form = useForm({
    weight: '',
    body_fat_percentage: '',
    muscle_mass: '',
    notes: ''
})

const submit = () => {
    form.post(route('progress-metrics.store'));
}
</script>

<template>

    <Head title="Progress Metrics" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div
                        class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
                        <table class="w-full text-left table-auto min-w-max">
                            <thead>
                                <tr>
                                    <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                            Weight
                                        </p>
                                    </th>
                                    <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                            Body Fat Percentage
                                        </p>
                                    </th>
                                    <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                            Muscle Mass
                                        </p>
                                    </th>
                                    <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                            Notes
                                        </p>
                                    </th>
                                    <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                            Created at
                                        </p>
                                    </th>
                                    <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                            Actions
                                        </p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="metric in props.metrics">
                                    <td class="p-4 border-b border-blue-gray-50">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ metric.weight }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-blue-gray-50">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ metric.body_fat_percentage }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-blue-gray-50">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ metric.muscle_mass }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-blue-gray-50">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ metric.notes }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-blue-gray-50">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ metric.created_at }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-blue-gray-50">
                                        <Link :href="'/progress-metrics/' + metric.id" method="delete" as="button">
                                        Delete</Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <form @submit.prevent="submit" class="m-3 max-w-lg">
                        <div class="mb-4">
                            <label for="weight" class="block text-sm font-medium text-gray-700">Weight</label>
                            <input v-model="form.weight" id="weight" required placeholder="Enter your weight"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="mt-2 text-sm text-red-600" v-show="form.errors['weight']">
                            {{ form.errors['weight'] }}
                        </div>

                        <div class="mb-4">
                            <label for="body_fat_percentage" class="block text-sm font-medium text-gray-700">Body fat
                                percentage</label>
                            <input v-model="form.body_fat_percentage" id="body_fat_percentage" required
                                placeholder="Enter your body fat percentage"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="mt-2 text-sm text-red-600" v-show="form.errors['body_fat_percentage']">
                            {{ form.errors['body_fat_percentage'] }}
                        </div>

                        <div class="mb-4">
                            <label for="muscle_mass" class="block text-sm font-medium text-gray-700">Muscle mass</label>
                            <input v-model="form.muscle_mass" id="muscle_mass" required
                                placeholder="Enter your muscle mass"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="mt-2 text-sm text-red-600" v-show="form.errors['muscle_mass']">
                            {{ form.errors['muscle_mass'] }}
                        </div>

                        <div class="mb-4">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                            <input v-model="form.notes" id="notes" required placeholder="Enter any additional notes"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="mt-2 text-sm text-red-600" v-show="form.errors['notes']">
                            {{ form.errors['notes'] }}
                        </div>

                        <button type="submit"
                            class="mt-4 w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
