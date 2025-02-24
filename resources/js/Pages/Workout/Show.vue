<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    workout: Object,
    workoutExercises: Object,
    exercises: Object
})
</script>

<template>

    <Head title="Workout Details" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Exercises
            </h2>
        </template>
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
                                            Exercise Name
                                        </p>
                                    </th>
                                    <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                            Exercise Difficulty
                                        </p>
                                    </th>
                                    <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                            Order
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
                                <tr v-for="exercise in props.exercises">
                                    <td class="p-4 border-b border-blue-gray-50">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ exercise.name }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-blue-gray-50">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ exercise.difficulty }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-blue-gray-50">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ exercise.pivot.order }}
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
