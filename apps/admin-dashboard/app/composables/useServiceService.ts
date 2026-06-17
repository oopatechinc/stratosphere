
export const useServiceService = () => {
    async function store() {
        return useSanctumFetch('services', {method: 'POST', body: {name: 'Service'}});
    }
    async function update() {

    }



    return {store, update}
}