// composables/useTenant.ts
export const useTenant = () => {
    return useState('current_tenant', () => ({
        id: '',
        name: '',
        logo: '',
        theme: {
            primary: '#1976D2',
            secondary: '#424242',
            background: '#FFFFFF'
        },
        layout: 'centered' // centered | split-screen
    }))
}