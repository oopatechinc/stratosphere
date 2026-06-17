import {useRouter, useRoute, useSanctumClient} from "#imports";

export class AbstractRedirectHandler {
    client = useSanctumClient()
    route = useRoute()
    router = useRouter()
    snackbarStore = useSnackbarStore()
    localePath = useLocalePath()

    async handle() {
        throw Error('This method must be overwritten')
    }
}