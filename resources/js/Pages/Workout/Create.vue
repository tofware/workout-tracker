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
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit">
                            <div>
                                <label for="name">Name</label>
                                <input v-model="form.name" id="name" required>
                            </div>
                            <div class="mt-2 text-sm text-red-600" v-show="form.errors['name']">
                                {{ form.errors['name'] }}
                            </div>
                            <div>
                                <label for="category">Category</label>
                                <select v-model="form.category" id="category" required>
                                    <option value="">--</option>
                                    <option v-for="category in props.categories" :value="category.id" :key="category.id">
                                        {{  category.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="mt-2 text-sm text-red-600" v-show="form.errors['category']">
                                {{ form.errors['category'] }}
                            </div>
                            <button>Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
