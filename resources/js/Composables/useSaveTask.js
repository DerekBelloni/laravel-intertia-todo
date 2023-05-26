import { Inertia } from "@inertiajs/inertia";

export default function useSaveTask() {
    //
    async function saveTask(url, taskBody, options) {
        let params = null;
        let { parent_task_id = null, subtask_type = null } = options;

        if (parent_task_id == null && subtask_type == null) {
            params = {
                task_body: taskBody,
            };
        } else {
            params = {
                parent_task_id: parent_task_id,
                task_body: taskBody,
                subtask_type: "work",
            };
        }

        Inertia.post(url, params);
    }

    return {
        saveTask,
    };
}
