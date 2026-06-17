import {AbstractRedirectHandler} from "~/classes/AbstractRedirectHandler";

export class IntegrationHandler extends AbstractRedirectHandler{
    override async handle() {
        if (!this.route.query.code) {
            this.snackbarStore.displayErrorMessage('Invalid query provided')
            this.router.push(this.localePath('/dashboard/integrations'))
        }

        const payload = {
            ...JSON.parse(this.route.query.state as string),
            code: this.route.query.code
        }

        let error = false
        await useSanctumFetch('integrations', {method: 'POST', body: payload}).catch(() => {
            error = true
        })

        if (error) {
            this.snackbarStore.displayErrorMessage('Invalid query provided')
        }

        this.snackbarStore.displaySuccessMessage('You have successfully connected your integration')

        this.router.push(this.localePath('/dashboard/integrations'))

        // if (this.route.query.session_id) {
        //     let error = false
        //     await this.client(`/stripe/check-subscription-status`, {
        //         method: 'POST',
        //         body: {
        //             checkout_session_id: this.route.query.session_id,
        //         }
        //     }).catch(() => {
        //         error = true
        //     })
        //
        //     if (!error) {
        //         this.router.push('/dashboard/account/subscription')
        //     }
        // }
    }
}