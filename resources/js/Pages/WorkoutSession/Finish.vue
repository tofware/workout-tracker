<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    workout: Object,
    exercises: Object,
    workoutSession: Object,
})
</script>

<template>
    <Head title="Workout Details" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Workout Finished
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
                <div class="bg-white shadow-md sm:rounded-lg p-6">
                    Details
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
