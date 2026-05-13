import axios from 'axios';
import Alpine from 'alpinejs';

window.axios = axios;
window.Alpine = Alpine;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Alpine.js persist plugin for localStorage
 */
document.addEventListener('alpine:init', () => {
    Alpine.plugin((Alpine) => {
        Alpine.magic('persist', () => (key, defaultValue) => {
            // Get initial value from localStorage
            let value = defaultValue;
            const storedValue = localStorage.getItem(key);

            if (storedValue !== null) {
                try {
                    value = JSON.parse(storedValue);
                } catch (e) {
                    value = storedValue;
                }
            }

            // Create reactive object
            const reactiveValue = Alpine.reactive({ value });

            // Watch for changes and save to localStorage
            Alpine.effect(() => {
                localStorage.setItem(key, JSON.stringify(reactiveValue.value));

                // Also update the document class for dark mode
                if (key === 'darkMode') {
                    if (reactiveValue.value) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                }
            });

            return reactiveValue;
        });
    });
});
