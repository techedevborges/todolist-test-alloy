import axios from 'axios'

const API_URL = 'http://localhost:8000/api/tarefas'

export default {
    getTasks() {
        return axios.get(API_URL)
    },

    createTask(data) {
        return axios.post(API_URL, data)
    },

    updateTask(id, data) {
        return axios.put(`${API_URL}/${id}`, data)
    },

    deleteTask(id) {
        return axios.delete(`${API_URL}/${id}`)
    }
}
