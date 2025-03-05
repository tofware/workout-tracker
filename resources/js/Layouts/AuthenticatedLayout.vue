<script setup>
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    title: String,
});
</script>

<template>
    <div class="flex bg-gray-100">
        <!-- Sidebar -->
        <aside
            class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 h-screen w-64 p-4 shadow-xl shadow-blue-gray-900/5">
            <div class="mb-2 p-4">
                <Link :href="route('dashboard')">
                <h5
                    class="block antialiased tracking-normal font-sans text-xl font-semibold leading-snug text-gray-900">
                    Workout Tracker
                </h5>
                </Link>

            </div>
            <nav class="flex flex-col gap-1 min-w-[240px] p-2 font-sans text-base font-normal">
                <NavLink :href="route('dashboard')" :active="route().current('dashboard')"
                    class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all text-gray-900 hover:bg-blue-50 hover:bg-opacity-80 focus:bg-blue-50 focus:bg-opacity-80 active:bg-gray-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
                    <div class="grid place-items-center mr-4">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3 3.75A.75.75 0 013.75 3h16.5a.75.75 0 01.75.75v16.5a.75.75 0 01-.75.75H3.75a.75.75 0 01-.75-.75V3.75zM9 9.75A.75.75 0 019.75 9h4.5a.75.75 0 01.75.75v10.5a.75.75 0 01-.75.75h-4.5a.75.75 0 01-.75-.75V9.75z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    Dashboard
                </NavLink>

                <NavLink :href="route('workouts.index')" :active="route().current('workouts.index')"
                    class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all text-gray-900 hover:bg-blue-50 hover:bg-opacity-80 focus:bg-blue-50 focus:bg-opacity-80 active:bg-gray-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
                    <div class="grid place-items-center mr-4">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M6.75 2.25a.75.75 0 00-1.5 0v1.5h-3a.75.75 0 000 1.5h3v3h-3a.75.75 0 000 1.5h3v3h-3a.75.75 0 000 1.5h3v3h-3a.75.75 0 000 1.5h3v1.5a.75.75 0 001.5 0v-1.5h10.5v1.5a.75.75 0 001.5 0v-1.5h3a.75.75 0 000-1.5h-3v-3h3a.75.75 0 000-1.5h-3v-3h3a.75.75 0 000-1.5h-3v-3h3a.75.75 0 000-1.5h-3v-1.5a.75.75 0 00-1.5 0v1.5H6.75v-1.5zm10.5 3h-10.5v3h10.5v-3zm-10.5 4.5h10.5v3h-10.5v-3zm10.5 4.5h-10.5v3h10.5v-3z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    Workouts
                </NavLink>

                <NavLink :href="route('workout-sessions.index')" :active="route().current('workout-sessions.index')"
                    class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all text-gray-900 hover:bg-blue-50 hover:bg-opacity-80 focus:bg-blue-50 focus:bg-opacity-80 active:bg-gray-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
                    <div class="grid place-items-center mr-4">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M6.75 2.25a.75.75 0 00-1.5 0v1.5h-3a.75.75 0 000 1.5h3v3h-3a.75.75 0 000 1.5h3v3h-3a.75.75 0 000 1.5h3v3h-3a.75.75 0 000 1.5h3v1.5a.75.75 0 001.5 0v-1.5h10.5v1.5a.75.75 0 001.5 0v-1.5h3a.75.75 0 000-1.5h-3v-3h3a.75.75 0 000-1.5h-3v-3h3a.75.75 0 000-1.5h-3v-3h3a.75.75 0 000-1.5h-3v-1.5a.75.75 0 00-1.5 0v1.5H6.75v-1.5zm10.5 3h-10.5v3h10.5v-3zm-10.5 4.5h10.5v3h-10.5v-3zm10.5 4.5h-10.5v3h10.5v-3z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    Workout Sessions
                </NavLink>

                <NavLink :href="route('goals.index')" :active="route().current('goals.index')"
                    class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all text-gray-900 hover:bg-blue-50 hover:bg-opacity-80 focus:bg-blue-50 focus:bg-opacity-80 active:bg-gray-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
                    <div class="grid place-items-center mr-4">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M12 2.25a.75.75 0 01.75.75v4.1l1.6-1.1a.75.75 0 11.85 1.25l-3 2.05a.75.75 0 01-.85 0l-3-2.05a.75.75 0 01.85-1.25l1.6 1.1V3a.75.75 0 01.75-.75zM6.75 12a.75.75 0 00-1.5 0v6.75H3a.75.75 0 000 1.5h6.75a.75.75 0 000-1.5H6.75V12zm9 0a.75.75 0 00-1.5 0v6.75H12a.75.75 0 000 1.5h6.75a.75.75 0 000-1.5H15.75V12z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    Goals
                </NavLink>

                <NavLink :href="route('progress-metrics.index')" :active="route().current('progress-metrics.index')"
                    class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all text-gray-900 hover:bg-blue-50 hover:bg-opacity-80 focus:bg-blue-50 focus:bg-opacity-80 active:bg-gray-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
                    <div class="grid place-items-center mr-4">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.5 3a.75.75 0 00-.75.75V20.25c0 .414.336.75.75.75h15a.75.75 0 00.75-.75V3.75A.75.75 0 0019.5 3h-15zM9 7.5a.75.75 0 011.5 0v7.5a.75.75 0 01-1.5 0V7.5zm3 3a.75.75 0 011.5 0v4.5a.75.75 0 01-1.5 0v-4.5zm3-1.5a.75.75 0 011.5 0v6a.75.75 0 01-1.5 0v-6z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    Progress Metrics
                </NavLink>

                <NavLink :href="route('profile.edit')" :active="route().current('profile.edit')"
                    class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all text-gray-900 hover:bg-blue-50 hover:bg-opacity-80 focus:bg-blue-50 focus:bg-opacity-80 active:bg-gray-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
                    <div class="grid place-items-center mr-4">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M12 2.25a5.25 5.25 0 100 10.5 5.25 5.25 0 000-10.5zM3 20.25a9 9 0 1118 0 .75.75 0 01-.75.75H3.75a.75.75 0 01-.75-.75z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    Profile
                </NavLink>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <slot />
        </main>
    </div>
</template>
