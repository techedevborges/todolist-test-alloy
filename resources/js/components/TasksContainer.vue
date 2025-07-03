<script setup>
import { useCounterStore } from "@/stores/counter";
import { storeToRefs } from "pinia";

const counterStore = useCounterStore();
const { counter } = storeToRefs(counterStore);

const increment = () => {
    counterStore.increment();
};

import TaskForm from './components/TaskForm.vue'
import TaskList from './components/TaskList.vue'
</script>

<template>
    <h1 class="text-2xl font-bold mb-4">Minha Lista de Tarefas</h1>
    <TaskForm />
    <TaskList />
    <div class="tasks">
        <p>Contador: {{ counter }}</p>
        <button @click="increment">Incrementar</button>
    </div>
</template>
