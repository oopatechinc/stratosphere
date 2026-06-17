export const useIntegrations = () => {
    const INTEGRATION_PLATFORM_GOOGLE_MEET = 'google-meet'
    const INTEGRATION_PLATFORM_GOOGLE_CALENDAR = 'google-calendar'
    const INTEGRATION_PLATFORM_ZOOM = 'zoom'
    const INTEGRATION_PLATFORM_STRIPE = 'stripe'

    const GOOGLE_PLATFORM_INTEGRATIONS = [
        INTEGRATION_PLATFORM_GOOGLE_MEET,
        INTEGRATION_PLATFORM_GOOGLE_CALENDAR
    ]

    const integrations = computed(() => {
        return [
            {
                platform: INTEGRATION_PLATFORM_GOOGLE_MEET,
                icon: 'google-meet.svg',
                pages: {
                    connected: {
                        editComponent: 'IntegrationsGoogleCalendar',
                    }
                }
            },
            {
                platform: INTEGRATION_PLATFORM_GOOGLE_CALENDAR,
                icon: 'google-calendar.svg',
                pages: {
                    connected: {
                        editComponent: 'IntegrationsGoogleCalendar',
                    }
                }
            },
            {
                platform: INTEGRATION_PLATFORM_ZOOM,
                icon: 'zoom.svg',
                pages: {
                    connected: {
                        editComponent: 'IntegrationsZoom'
                    }
                }
            },
            {
                platform: INTEGRATION_PLATFORM_STRIPE,
                icon: 'stripe.svg',
                pages: {
                    connected: {
                        editComponent: 'IntegrationsStripe'
                    }
                }
            },
        ]
    })

    return {integrations, GOOGLE_PLATFORM_INTEGRATIONS}
}