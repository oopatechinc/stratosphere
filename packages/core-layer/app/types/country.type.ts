import type {State} from "./state.type";

export type Country = {
    id: number,
    name: string,
    iso: string,
    is_active?: boolean,
    geographical_unit_name?: string,
    states?: State[]
}
