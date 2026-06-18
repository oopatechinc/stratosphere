import type {Staff} from "@stratosphere/core-layer/types";

export const useAdminService = () => {
    async function get() {
        return useSanctumFetch('/admins', {method: 'GET'})
    }

    async function update(payload: []) {
        return useSanctumFetch('/admins', {method: 'POST', body: payload})
    }

    async function patch(adminId: number, payload: Staff) {
        return useSanctumFetch(`/admins/${adminId}`, {method: 'PATCH', body: payload})
    }

    return {get, update, patch}
}