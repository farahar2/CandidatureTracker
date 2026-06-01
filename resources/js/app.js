import Alpine from 'alpinejs';
import { createIcons, icons } from 'lucide';

window.Alpine = Alpine;
Alpine.start();

// Initialiser Lucide Icons
document.addEventListener('DOMContentLoaded', () => {
    createIcons({ icons });
});

document.addEventListener('alpine:init', () => {
    createIcons({ icons });
});

// Re-render icons après navigation
const observer = new MutationObserver(() => {
    createIcons({ icons });
});
observer.observe(document.body, { childList: true, subtree: true });