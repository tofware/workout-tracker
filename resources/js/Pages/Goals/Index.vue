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
                                            {{ goal.status }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-blue-gray-50">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ goal.notes }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-blue-gray-50">
                                        <!-- <a href="#"
                                            class="block font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900">
                                            Edit
                                        </a> -->
                                        <!-- <Link
                                            class="block font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900"
                                            :href="`/workouts/` + workout.id + `/exercises`">Exercises</Link> -->
                                        <Link :href="'/goals/' +  goal.id" method="delete" as="button">Delete</Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <form @submit.prevent="submit">
                        <div>
                            <label for="goal_type">Goal Type</label>
                            <input v-model="form.goal_type" id="goal_type" required>
                        </div>
                        <div class="mt-2 text-sm text-red-600" v-show="form.errors['goal_type']">
                            {{ form.errors['goal_type'] }}
                        </div>

                        <div>
                            <label for="target_value">Target Value</label>
                            <input v-model="form.target_value" id="target_value" required>
                        </div>
                        <div class="mt-2 text-sm text-red-600" v-show="form.errors['target_value']">
                            {{ form.errors['target_value'] }}
                        </div>

                        <div>
                            <label for="deadline">Deadline</label>
                            <input v-model="form.deadline" id="deadline" type="date" required>
                        </div>
                        <div class="mt-2 text-sm text-red-600" v-show="form.errors['deadline']">
                            {{ form.errors['deadline'] }}
                        </div>

                        <div>
                            <label for="notes">Notes</label>
                            <input v-model="form.notes" id="notes" required>
                        </div>
                        <div class="mt-2 text-sm text-red-600" v-show="form.errors['notes']">
                            {{ form.errors['notes'] }}
                        </div>

                        <div>
                            <label for="exercise">Exercise</label>
                            <select v-model="form.exercise" id="exercise" required>
                                <option value="">--</option>
                                <option v-for="exercise in props.exercises" :value="exercise.id" :key="exercise.id">
                                    {{ exercise.name }}
                                </option>
                            </select>
                        </div>
                        <div class="mt-2 text-sm text-red-600" v-show="form.errors['exercise']">
                            {{ form.errors['exercise'] }}
                        </div>
                        <button>Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
