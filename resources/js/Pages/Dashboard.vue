<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    workoutsCompleted: Number,
    goalsAchieved: Number,
    setsDone: Number,
    timeWorkingOut: Number
});
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <section id="content"
            class="bg-white h-full">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
                <div class="bg-slate-50 p-5 m-2 rounded-md flex justify-between items-center shadow">
                    <div>
                        <h3 class="font-bold">Workouts Completed</h3>
                        <p class="text-gray-500">{{ workoutsCompleted }}</p>
                    </div>
                    <i class="fa-solid fa-users p-4 bg-gray-200 rounded-md"></i>
                </div>

                <div class="bg-slate-50 p-5 m-2 flex justify-between items-center shadow">
                    <div>
                        <h3 class="font-bold">Goals Achieved</h3>
                        <p class="text-gray-500"> {{ goalsAchieved }}</p>
                    </div>
                    <i class="fa-solid fa-users p-4 bg-green-200 rounded-md"></i>
                </div>

                <div class="bg-slate-50 p-5 m-2 flex justify-between items-center shadow">
                    <div>
                        <h3 class="font-bold">Sets Done</h3>
                        <p class="text-gray-500"> {{ setsDone }}</p>
                    </div>
                    <i class="fa-solid fa-users p-4 bg-yellow-200 rounded-md"></i>
                </div>

                <div class="bg-slate-50 p-5 m-2 flex justify-between items-center shadow">
                    <div>
                        <h3 class="font-bold">Time working out</h3>
                        <p class="text-gray-500">{{ timeWorkingOut }}</p>
                    </div>
                    <i class="fa-solid fa-users p-4 bg-red-200 rounded-md"></i>
                </div>
            </div>

            <div class="grid sm:grid-cols-3 m-5 pb-5">
                <Link
                    class="block px-5 py-5 bg-black text-white text-sm font-medium rounded shadow-md transition duration-300 ease-in-out transform hover:bg-gray-800 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50"
                    :href="`/workout-sessions/create/`">
                    Start Workout Session
                </Link>
            </div>

        </section>

    </AuthenticatedLayout>
</template>
