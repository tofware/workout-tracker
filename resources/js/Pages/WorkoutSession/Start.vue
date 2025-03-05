<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, computed, onMounted, onUnmounted } from 'vue';

const props = defineProps({
    workout: Object,
    exercises: Object,
    workoutSession: Object,
})

const exercises = ref(props.exercises.map(exercise => ({
    id: exercise.id,
    name: exercise.name,
    difficulty: exercise.difficulty,
    force: exercise.force,
    mechanic: exercise.mechanic,
    instructions: exercise.instructions,
    equipment: exercise.equipment.name,
    sets: [{ reps: null, weight: null, notes: '' }],
})));

const currentExerciseIndex = ref(0);
const loading = ref(false);
const elapsedSeconds = ref(0);
let interval = null
const intensity = ref('')
const notes = ref('')
const caloriesBurned = ref('')

const startTimer = () => {
    interval = setInterval(() => {
        elapsedSeconds.value++
    }, 1000)
}

const stopTimer = () => {
    if (interval) clearInterval(interval)
}

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
        } else {
            router.post(route('workout-sessions.finish', props.workoutSession), {
                duration: elapsedSeconds.value,
                average_intensity: intensity.value,
                notes: notes.value,
                calories_burned: caloriesBurned.value
            })
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

const formattedTime = computed(() => {
    const hours = Math.floor(elapsedSeconds.value / 3600)
    const minutes = Math.floor((elapsedSeconds.value % 3600) / 60)
    const seconds = elapsedSeconds.value % 60

    return [
        hours > 0 ? String(hours).padStart(2, '0') : null,
        String(minutes).padStart(2, '0'),
        String(seconds).padStart(2, '0')
    ].filter(Boolean).join(':')
})

onMounted(startTimer)
onUnmounted(() => clearInterval(interval))
</script>

<template>

    <Head title="Workout Details" />

    <AuthenticatedLayout>
        <section id="content" class="bg-white h-full">
            <div class="max-w-4xl mx-auto bg-white p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">
                    Workout: {{ workout.name }} {{ formattedTime }}
                </h2>

                <p class="text-gray-600 mb-4 text-sm">
                    Exercise {{ currentExerciseIndex + 1 }} of {{ exercises.length }}
                </p>

                <div class="bg-gray-100 p-4 rounded-lg mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">{{ currentExercise.name }}</h3>
                    <p class="text-sm text-gray-600">Difficulty: {{ currentExercise.difficulty }}</p>
                    <p class="text-sm text-gray-600">Force: {{ currentExercise.force }} </p>
                    <p class="text-sm text-gray-600">Mechanic: {{ currentExercise.mechanic }}</p>
                    <p class="text-sm text-gray-600">Equipment: {{ currentExercise.equipment }}</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="text-md font-semibold text-gray-700 mb-2">Instructions</h4>
                    <ul class="list-decimal list-inside text-gray-600 text-sm space-y-2">
                        <li v-for="(instruction, index) in currentExercise.instructions" :key="index">
                            {{ instruction.instruction }}
                        </li>
                    </ul>
                </div>

                <div v-for="(set, index) in currentExercise.sets" :key="index" class="flex items-center space-x-2 mb-2">
                    <input type="number" v-model="set.reps" class="border p-2 rounded w-full" placeholder="Reps" min="1"
                        max="500" />
                    <input type="number" v-model="set.weight" class="border p-2 rounded w-full"
                        placeholder="Weight (kg)" min="0" max="1000" />

                    <input type="text" v-model="set.notes" class="border p-2 rounded w-full"
                        placeholder="Notes (optional)"></input>

                    <button v-if="currentExercise.sets.length > 1" @click="removeSet(index)"
                        class="text-red-500">✖</button>
                </div>

                <button @click="addSet" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">+ Add Set</button>

                <div v-if="currentExerciseIndex == exercises.length - 1">
                    <h3 class="text-lg font-semibold text-center mb-4">Workout Session Overall Data</h3>

                    <input v-model="intensity" type="number" placeholder="Average Intensity"
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <textarea v-model="notes" placeholder="Notes (How was your workout?)"
                        class="w-full p-2 mt-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>

                    <input v-model="caloriesBurned" type="number" placeholder="Calories Burned"
                        class="w-full p-2 mt-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mt-4 flex justify-between">
                    <button v-if="currentExerciseIndex > 0" @click="prevExercise"
                        class="bg-gray-500 text-white px-4 py-2 rounded">
                        Previous
                    </button>
                    <button @click="nextExercise" class="bg-green-500 text-white px-4 py-2 rounded" :disabled="loading">
                        <span v-if="loading">Saving...</span>
                        <span v-else>Next</span>
                    </button>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
