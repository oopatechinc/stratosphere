import type { Tenant } from "@stratosphere/core-layer/types";
import {useSanctumClient} from "#build/imports";

export const useTenantService = () => {
    const client = useSanctumClient()
    async function get() {
        return client('/tenants')
    }

    async function store(tenant: Tenant) {
        return client<Tenant>('/tenants', {method: 'POST', body: tenant})
    }

    async function update(tenantId: number, payload: []) {
        return client<Tenant[]>('/tenants/' + tenantId, {method: 'POST', body: payload})
    }

    return {get, store, update}
}