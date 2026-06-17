import {StripeCheckoutSessionHandler} from "~/classes/StripeCheckoutSessionHandler";
import {IntegrationHandler} from "~/classes/IntegrationHandler";

export class RedirectFactory {
    TYPE_STRIPE_CHECKOUT_SESSION = 'stripe_checkout_session'
    TYPE_PLATFORM_INTEGRATION = 'platform_integration'
    getInstance(type: string) {
        switch (type) {
            case this.TYPE_STRIPE_CHECKOUT_SESSION:
                return new StripeCheckoutSessionHandler()
            case this.TYPE_PLATFORM_INTEGRATION:
                return new IntegrationHandler()
            default:
                throw Error('Unsupported redirect action!')
        }
    }
}