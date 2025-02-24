<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    workouts: Object
})

const form = useForm({ workout: '' });
</script>

<template>
    <Head title="Workout Create" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create workout
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="form.post(route('workout-sessions.store'))">
                            <div>
                            <label for="workout">Workout</label>
                                <select v-model="form.workout" id="workout" required>
                                    <option value="">--</option>
                                    <option v-for="workout in props.workouts" :value="workout.id" :key="workout.id">
                                        {{  workout.name }}
                                    </option>
                                </select>
                            </div>
                            <button type="submit" class="inline-block rounded-md bg-blue-500 px-4 py-3 text-xs font-semibold uppercase tracking-widest text-white shadow-sm">
                                Start Workout Session
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
