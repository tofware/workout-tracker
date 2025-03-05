<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    workouts: Object
})

const form = useForm({ workout: '' });
</script>

<template>

    <Head title="Choose Workout" />

    <AuthenticatedLayout>
        <section id="content" class="bg-white h-full">
            <div class="max-w-md mx-auto bg-white p-6">
                <form @submit.prevent="form.post(route('workout-sessions.store'))" class="space-y-4">
                    <h1
                        class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-3xl">
                        Choose a workout</h1>
                    <div>
                        <label for="workout" class="block text-sm font-medium text-gray-700">Workout</label>
                        <select v-model="form.workout" id="workout" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">--</option>
                            <option v-for="workout in props.workouts" :value="workout.id" :key="workout.id">
                                {{ workout.name }}
                            </option>
                        </select>
                    </div>

                    <button type="submit"
                        class="w-full rounded-md bg-blue-600 px-4 py-3 text-sm font-semibold uppercase tracking-wide text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Start Workout Session
                    </button>
                </form>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
