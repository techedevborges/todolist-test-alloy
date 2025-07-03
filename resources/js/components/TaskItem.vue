<script setup>
defineProps({
  task: Object,
  onToggle: Function,
  onDelete: Function,
})
</script>

<template>
  <li class="flex justify-between items-center p-2 border-b">
    <span :class="{ 'line-through text-gray-500': task.finalizada }">
      {{ task.titulo }}
    </span>
    <div class="flex gap-2">
      <button @click="onToggle(task.id)">✔️</button>
      <button @click="onDelete(task.id)">🗑️</button>
    </div>
  </li>
</template>
