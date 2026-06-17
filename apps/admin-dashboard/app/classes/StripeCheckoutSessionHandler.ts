import {AbstractRedirectHandler} from "~/classes/AbstractRedirectHandler";

export class StripeCheckoutSessionHandler extends AbstractRedirectHandler{
    override async handle() {
        if (this.route.query.session_id) {
            let error = false
            await this.client(`/stripe/check-subscription-status`, {
                method: 'POST',
                body: {
                    checkout_session_id: this.route.query.session_id,
                }
            }).catch(() => {
                error = true
            })

            if (!error) {
                this.router.push('/dashboard/account/subscription')
            }
        }
    }
}