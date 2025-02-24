<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';

const props = defineProps({
    workout: Object,
    exercises: Object,
    workoutSession: Object,
})

const redirect = () => {
    router.get(route('workout-sessions.start', props.workoutSession));
};
</script>

<template>
    <Head title="Workout Details" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Workout Overview
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
                <div class="bg-white shadow-md sm:rounded-lg p-6">
                    Details
                    <button @click="redirect" class="px-4 py-2 bg-blue-500 text-white rounded">
                        Start Workout
                    </button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
