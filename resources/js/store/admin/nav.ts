import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useNavDrawerStore = defineStore('useNavDrawer', () => {
    const left = ref(true);
    const right = ref(false);
    return { left, right };
});
