<template>
  <div
    class="todo-app max-w-md mx-auto my-auto p-6 bg-white shadow-md rounded-lg mb-8"
  >
    <h1 class="text-2xl font-bold mb-4 text-gray-600 text-center">Task list</h1>
    <form @submit.prevent="addTask" class="mb-4">
      <input
        v-model="newTask"
        placeholder="Add a new task"
        class="w-full p-2 border border-gray-300 rounded mb-2 text-black"
        required
      />
      <select
        v-model="newStatus"
        :class="{
          'text-green-500': newStatus === 'completed',
          'text-yellow-500': newStatus === 'pending',
        }"
        class="w-full p-2 border border-gray-300 rounded mb-2 text-black capitalize"
      >
        <option
          v-for="status in taskStatus"
          :key="status"
          :class="{
            'text-green-500': status === 'completed',
            'text-yellow-500': status === 'pending',
          }"
        >
          {{ status }}
        </option>
      </select>
      <textarea
        placeholder="Add a description"
        v-model="newDescription"
        rows="10"
        class="w-full p-2 border border-gray-300 rounded mb-2 text-black"
      ></textarea>
      <button
        type="submit"
        class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600 font-bold"
      >
        Add Task
      </button>
    </form>
  </div>
  <div
    class="todo-app max-w-md mx-auto my-auto p-6 bg-white shadow-md rounded-lg"
  >
    <div
      v-for="(task, index) in tasks"
      :key="index"
      class="items-center justify-between mb-2 text-black border-b-2 border-gray-300 pb-2 mb-2"
    >
      <div class="mb-5">
        <div class="w-full text-black capitalize">
          <b>Status: </b>
          <span
            v-if="!isEditing || editingIndex !== index"
            :class="{
              'text-green-400': task.status === 'completed',
              'text-yellow-300': task.status === 'pending',
            }"
          >
            {{ task.status }}
          </span>
          <select v-else v-model="task.status">
            <option value="completed">Completed</option>
            <option value="pending">Pending</option>
          </select>
        </div>
        <div class="w-full text-black capitalize">
          <b>Title: </b>
          <span v-if="!isEditing || editingIndex !== index">
            {{ task.title }}
          </span>
          <input v-else v-model="task.title" />
        </div>
        <div class="w-full text-black capitalize">
          <b>Description: </b>
          <span v-if="!isEditing || editingIndex !== index">
            {{ task.description }}
          </span>
          <input v-else v-model="task.description" />
        </div>
      </div>
      <button
        @click="editTask(index)"
        class="mr-2 bg-yellow-500 text-white p-1 rounded hover:bg-yellow-600"
      >
        {{ isEditing && editingIndex === index ? 'Save' : 'Edit' }}
      </button>
      <button
        @click="removeTask(task.id)"
        class="mr-2 bg-red-500 text-white p-1 rounded hover:bg-red-600"
      >
        Delete
      </button>
    </div>
  </div>
</template>

<script setup lang="ts">
import { createTask, getTasks, deleteTask, updateTask } from '@/api/task'
import { onMounted, ref } from 'vue'

interface Task {
  text: string
  status: 'pending' | 'completed'
  description: string
}
const editingIndex = ref(-1)
const isEditing = ref(false)
const taskStatus = ref(['pending', 'completed'])
const newStatus = ref('pending')
const newTask = ref('')
const newDescription = ref('')
const tasks = ref<Task[]>([])

onMounted(async () => {
  /**
   * Get all tasks
   */
  tasks.value = await getTasks()
  console.log(tasks.value)
})

/**
 * Add a new task
 */
const addTask = async () => {
  // Create a new task through api call
  await createTask({
    title: newTask.value,
    status: newStatus.value,
    description: newDescription.value,
  })
  // Get all tasks to refresh the list
  tasks.value = await getTasks()
}

/**
 * Edit a task
 */
const editTask = async (index: number) => {
  if (isEditing.value && editingIndex.value === index) {
    // Save the changes
    isEditing.value = false
    editingIndex.value = -1

    // Update the task
    await updateTask(tasks.value[index])
    // Get all tasks to refresh the list
    await getTasks()
  } else {
    // Enable editing
    isEditing.value = true
    editingIndex.value = index
  }
}

/**
 * Remove a task
 */
const removeTask = async (id: number) => {
  await deleteTask(id)
  // Get all tasks to refresh the list
  tasks.value = await getTasks()
}
</script>
