<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    workouts: Object,
})

const confirmDelete = () => {
    const confirmed = confirm("Are you sure you want to delete this workout?");
    if (confirmed) {
      this.$inertia.delete(`/workouts/${workoutId}`);
    }
}
</script>

<template>

    <Head title="Workout" />

    <AuthenticatedLayout>
        <section id="content" class="bg-white h-full">
            <div class="sm:px-6 lg:px-8 flex">
                <Link
                    class="mt-3 rounded-md bg-blue-600 px-4 py-3 text-sm font-semibold uppercase tracking-wide text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    href="/workouts/create">
                Create new workout
                </Link>
            </div>

            <div class="mt-3 sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div
                        class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
                        <table class="w-full text-left table-auto min-w-max">
                            <thead>
                                <tr>
                                    <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                            Name
                                        </p>
                                    </th>
                                    <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                            Category
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
                                <tr v-for="workout in props.workouts">
                                    <td class="p-4 border-b border-blue-gray-50">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ workout.name }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-blue-gray-50">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ workout.category.name }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-blue-gray-50">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ workout.created_at }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-blue-gray-50">
                                        <Link
                                            class="block font-sans text-sm text-blue-gray-900 hover:text-blue-gray-700 transition-colors duration-200 ease-in-out"
                                            :href="`/workouts/` + workout.id + `/exercises`">Exercises</Link>
                                        <Link :href="'/workouts/' + workout.id" method="delete" as="button" @click.prevent="confirmDelete(workout.id)"
                                            class="mt-2 block font-sans text-sm text-red-600 hover:text-red-500 transition-colors duration-200 ease-in-out">
                                        Delete
                                        </Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

    </AuthenticatedLayout>
</template>
