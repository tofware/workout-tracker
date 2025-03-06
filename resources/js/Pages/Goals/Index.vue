<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
    goals: Object,
    exercises: Object
})

const form = useForm({
    goal_type: '',
    target_value: '',
    deadline: '',
    notes: '',
    exercise: ''
})

const submit = () => {
    form.post(route('goals.store'));
}
</script>

<template>

    <Head title="Goals" />

    <AuthenticatedLayout>
        <section id="content" class="bg-white h-full sm:rounded-lg">
            <div
                class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
                <table class="w-full text-left table-auto min-w-max">
                    <thead>
                        <tr>
                            <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                    Type
                                </p>
                            </th>
                            <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                    Target Value
                                </p>
                            </th>
                            <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                    Deadline
                                </p>
                            </th>
                            <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                    Status
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
                                    Actions
                                </p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="goal in props.goals">
                            <td class="p-4 border-b border-blue-gray-50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ goal.goal_type }}
                                </p>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ goal.target_value }}
                                </p>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ goal.deadline }}
                                </p>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ goal.status_label }}
                                </p>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ goal.notes }}
                                </p>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <Link :href="'/goals/' + goal.id" method="delete" as="button">Delete</Link>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <form @submit.prevent="submit" class="m-3 max-w-lg">
                <div class="mb-4">
                    <label for="goal_type" class="block text-sm font-medium text-gray-700">Goal Type</label>
                    <input v-model="form.goal_type" id="goal_type" required placeholder="Enter your goal type"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mt-2 text-sm text-red-600" v-show="form.errors['goal_type']">
                    {{ form.errors['goal_type'] }}
                </div>

                <div class="mb-4">
                    <label for="target_value" class="block text-sm font-medium text-gray-700">Target
                        Value</label>
                    <input v-model="form.target_value" id="target_value" required placeholder="Enter your target value"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mt-2 text-sm text-red-600" v-show="form.errors['target_value']">
                    {{ form.errors['target_value'] }}
                </div>

                <div class="mb-4">
                    <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
                    <input v-model="form.deadline" id="deadline" type="date" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mt-2 text-sm text-red-600" v-show="form.errors['deadline']">
                    {{ form.errors['deadline'] }}
                </div>

                <div class="mb-4">
                    <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                    <input v-model="form.notes" id="notes" required placeholder="Enter any additional notes"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mt-2 text-sm text-red-600" v-show="form.errors['notes']">
                    {{ form.errors['notes'] }}
                </div>

                <div class="mb-4">
                    <label for="exercise" class="block text-sm font-medium text-gray-700">Exercise</label>
                    <select v-model="form.exercise" id="exercise" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Select an Exercise --</option>
                        <option v-for="exercise in props.exercises" :value="exercise.id" :key="exercise.id">
                            {{ exercise.name }}
                        </option>
                    </select>
                </div>
                <div class="mt-2 text-sm text-red-600" v-show="form.errors['exercise']">
                    {{ form.errors['exercise'] }}
                </div>
                <button type="submit"
                    class="mt-4 w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Submit
                </button>
            </form>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
