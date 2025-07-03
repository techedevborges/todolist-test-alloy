<script setup>
import { onMounted } from 'vue'
import { useTaskStore } from '@/stores/taskStore'
import TaskItem from './TaskItem.vue'

const taskStore = useTaskStore()

onMounted(() => taskStore.fetchTasks())
</script>

<template>
  <div>
    <ul>
      <TaskItem
        v-for="task in taskStore.tasks"
        :key="task.id"
        :task="task"
        :onToggle="taskStore.toggleTask"
        :onDelete="taskStore.deleteTask"
      />
    </ul>
  </div>
</template>
