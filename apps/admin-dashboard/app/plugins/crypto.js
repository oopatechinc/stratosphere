import CryptoJS from 'crypto-js';

export default defineNuxtPlugin(() => {
    return {
        provide: {
            crypto: CryptoJS
        }
    };
});