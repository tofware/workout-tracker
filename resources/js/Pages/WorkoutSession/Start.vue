<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    workout: Object,
    exercises: Object,
    workoutSession: Object,
})

const exercises = ref(props.exercises.map(exercise => ({
    id: exercise.id,
    name: exercise.name,
    sets: [{reps: null, weight: null, notes: ''}],
})));
const currentExerciseIndex = ref(0);
const loading = ref(false);

const currentExercise = computed(() => exercises.value[currentExerciseIndex.value]);

const addSet = () => {
    currentExercise.value.sets.push({ reps: null, weight: null, notes: '' });
};

const removeSet = (setIndex) => {
    if (currentExercise.value.sets.length > 1) {
        currentExercise.value.sets.splice(setIndex, 1);
    }
};

const nextExercise = async () => {
    loading.value = true;

    try {
        await router.post('/exercise-sets', {
            workout_session_id: props.workoutSession.id,
            exercise_id: currentExercise.value.id,
            sets: currentExercise.value.sets,
        }, {
            preserveScroll: true,
            preserveState: true,
        });

        if (currentExerciseIndex.value < exercises.value.length - 1) {
            currentExerciseIndex.value++;
        }else{
            router.get(route('workout-sessions.finish', props.workoutSession));
        }
    } catch (error) {
        console.error("Error saving exercise:", error);
    } finally {
        loading.value = false;
    }
};

const prevExercise = () => {
    if (currentExerciseIndex.value > 0) {
        currentExerciseIndex.value--;
    }
};
</script>

<template>
    <Head title="Workout Details" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ workout.name }} - Exercise {{ currentExerciseIndex + 1 }} of {{ exercises.length }}
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
                <div class="bg-white shadow-md sm:rounded-lg p-6">

                    <h3 class="text-lg font-bold mb-4">{{ currentExercise.name }}</h3>

                    <div v-for="(set, index) in currentExercise.sets" :key="index" class="flex items-center space-x-2 mb-2">
                        <input
                            type="number"
                            v-model="set.reps"
                            class="border p-2 rounded w-full"
                            placeholder="Reps"
                            min="1"
                            max="500"
                        />
                        <input
                            type="number"
                            v-model="set.weight"
                            class="border p-2 rounded w-full"
                            placeholder="Weight (kg)"
                            min="0"
                            max="1000"
                        />

                        <input
                            type="text"
                            v-model="set.notes"
                            class="border p-2 rounded w-full"
                            placeholder="Notes (optional)"
                        ></input>

                        <button v-if="currentExercise.sets.length > 1" @click="removeSet(index)" class="text-red-500">✖</button>
                    </div>

                    <button @click="addSet" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">+ Add Set</button>

                    <div class="mt-4 flex justify-between">
                        <button v-if="currentExerciseIndex > 0" @click="prevExercise" class="bg-gray-500 text-white px-4 py-2 rounded">
                            Previous
                        </button>
                        <button @click="nextExercise" class="bg-green-500 text-white px-4 py-2 rounded" :disabled="loading">
                            <span v-if="loading">Saving...</span>
                            <span v-else>Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
