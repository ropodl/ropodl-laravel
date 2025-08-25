<script setup lang="ts">
import { Icon } from '@iconify/vue';
import { computed, ref } from 'vue';

defineProps<{
    title: string;
}>();

const rail = ref(true);

const navItems = ref([
    {
        icon: 'carbon:home',
        title: 'Home',
    },
]);

const railIcon = computed(() => {
    return rail.value ? 'carbon:side-panel-open' : 'carbon:side-panel-close';
});
</script>

<template>
    <v-app>
        <v-app-bar flat order="1" height="64">
            <v-btn variant="text" height="64" @click="rail = !rail">
                <v-icon>
                    <Icon :icon="railIcon" />
                </v-icon>
            </v-btn>
            {{ title }}
        </v-app-bar>
        <v-navigation-drawer permanent :rail order="0">
            <v-list nav density="compact">
                <template v-for="{ title, icon } in navItems" :key="title">
                    <v-tooltip :text="title" :disabled="!rail">
                        <template v-slot:activator="{ props }">
                            <v-list-item :title v-bind="props">
                                <template #prepend>
                                    <v-icon>
                                        <Icon :icon />
                                    </v-icon>
                                </template>
                            </v-list-item>
                        </template>
                    </v-tooltip>
                </template>
            </v-list>
            <template v-slot:append>
                <div class="pa-2">
                    <v-btn block> Logout </v-btn>
                </div>
            </template>
        </v-navigation-drawer>

        <v-main>
            <slot />
        </v-main>
    </v-app>
</template>
