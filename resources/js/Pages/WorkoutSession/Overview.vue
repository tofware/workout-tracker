<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';

const props = defineProps({
    workout: Object,
    exercises: Object,
    workoutSession: Object,
    exercises_count: Number
})

const redirect = () => {
    router.get(route('workout-sessions.start', props.workoutSession));
};
</script>

<template>

    <Head title="Workout Details" />

    <AuthenticatedLayout>
        <section id="content" class="bg-white h-full">
            <div class="max-w-lg mx-auto bg-white p-6">
                <div class="mt-6 p-4">
                    <h3 class="text-lg font-semibold text-gray-800">This workout plan contains a total of {{ props.exercises_count }} exercises.</h3>
                    <p v-for="exercise in workout.exercises">
                        <p class="text-md text-gray-600"><strong> {{ exercise.name }} </strong> - Difficulty: {{ exercise.difficulty }}</p>
                    </p>
                </div>
                <button @click="redirect" class="w-full rounded-md bg-blue-600 px-4 py-3 text-sm font-semibold uppercase tracking-wide text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Start Workout
                </button>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
