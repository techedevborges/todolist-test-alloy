<script setup>
import { ref } from 'vue'
import { useTaskStore } from '@/stores/taskStore'

const titulo = ref('')
const taskStore = useTaskStore()

function handleSubmit() {
  if (!titulo.value) return
  taskStore.createTask({ titulo: titulo.value })
  titulo.value = ''
}
</script>

<template>
  <form @submit.prevent="handleSubmit" class="flex gap-2 mb-4">
    <input v-model="titulo" placeholder="Nova tarefa" class="border px-2 py-1 rounded" />
    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Adicionar</button>
  </form>
</template>
