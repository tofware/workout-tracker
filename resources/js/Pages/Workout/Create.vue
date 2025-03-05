<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    categories: Object
})

const form = useForm({
    category: '',
    name: '',
})

const submit = () => {
    form.post(route('workouts.store'));
}
</script>

<template>

    <Head title="Workout Create" />

    <AuthenticatedLayout>
        <section id="content" class="bg-white h-full">
            <div class="mx-auto sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Create New Workout</h2>
                <form @submit.prevent="submit" class="space-y-6">
                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input v-model="form.name" id="name" required
                            class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2">
                        <p class="mt-1 text-sm text-red-600" v-show="form.errors['name']">
                            {{ form.errors['name'] }}
                        </p>
                    </div>

                    <!-- Category Field -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                        <select v-model="form.category" id="category" required
                            class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2">
                            <option value="">-- Select a Category --</option>
                            <option v-for="category in props.categories" :value="category.id" :key="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                        <p class="mt-1 text-sm text-red-600" v-show="form.errors['category']">
                            {{ form.errors['category'] }}
                        </p>
                    </div>

                    <!-- Submit Button -->
                    <button
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-md shadow-md transition duration-300">
                        Submit
                    </button>
                </form>
            </div>
        </section>

    </AuthenticatedLayout>
</template>
