import { defineStore } from 'pinia'
import taskService from '@/services/taskService'

export const useTaskStore = defineStore('tasks', {
    state: () => ({
        tasks: [],
        loading: false,
    }),

    actions: {
        async fetchTasks() {
            this.loading = true
            try {
                const response = await taskService.getTasks()
                this.tasks = response.data
            } catch (error) {
                console.error('Erro ao buscar tarefas:', error)
            } finally {
                this.loading = false
            }
        },

        async createTask(taskData) {
            try {
                const response = await taskService.createTask(taskData)
                this.tasks.push(response.data)
            } catch (error) {
                console.error('Erro ao criar tarefa:', error)
            }
        },

        async updateTask(id, taskData) {
            try {
                const response = await taskService.updateTask(id, taskData)
                const index = this.tasks.findIndex(t => t.id === id)
                if (index !== -1) this.tasks[index] = response.data
            } catch (error) {
                console.error('Erro ao atualizar tarefa:', error)
            }
        },

        async deleteTask(id) {
            try {
                await taskService.deleteTask(id)
                this.tasks = this.tasks.filter(t => t.id !== id)
            } catch (error) {
                console.error('Erro ao excluir tarefa:', error)
            }
        },

        async toggleTask(id) {
            const task = this.tasks.find(t => t.id === id)
            if (!task) return
            try {
                const updated = { ...task, finalizada: !task.finalizada }
                await this.updateTask(id, updated)
            } catch (error) {
                console.error('Erro ao alternar tarefa:', error)
            }
        }
    }
})
