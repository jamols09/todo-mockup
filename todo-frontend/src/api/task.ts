/* eslint-disable @typescript-eslint/no-explicit-any */
import { api } from "./api";


export const getTasks = async () => {
    const result = await api.get("/tasks");
    return result.data;
}

export const createTask = async (task: any) => {
    const result = await api.post("/tasks", task);
    return result.data;
}

export const updateTask = async (task: any) => {
    const result = await api.put(`/tasks/${task.id}`, task);
    return result.data;
}

export const deleteTask = async (id: number) => {
    const result = await api.delete(`/tasks/${id}`);
    return result.data;
}