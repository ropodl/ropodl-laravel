<script setup lang="ts">
import { Icon } from '@iconify/vue';
import { Link, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

defineProps<{
    title: string;
}>();

const {
    props: { auth },
} = usePage();

const rail = ref(true);

const navItems = ref([
    {
        icon: 'carbon:home',
        title: 'Home',
        to: '/admin/',
    },
    {
        icon: 'carbon:blog',
        title: 'Blogs',
        to: '/admin/blog',
    },
    {
        icon: 'carbon:home',
        title: 'Portfolios',
        to: '/admin/portfolio',
    },
]);

const railIcon = computed(() => {
    return rail.value ? 'carbon:side-panel-open' : 'carbon:side-panel-close';
});

const secondary = ref(false);
</script>

<template>
    <v-app>
        <v-app-bar flat border="b" order="0" height="64" class="px-1">
            <v-row align="center">
                <v-col cols="12" md="4">
                    <v-btn icon variant="text" @click="rail = !rail">
                        <v-icon>
                            <Icon :icon="railIcon" />
                        </v-icon>
                    </v-btn>
                    <v-menu>
                        <template v-slot:activator="{ props }">
                            <v-btn color="primary" v-bind="props">
                                Activator slot
                            </v-btn>
                        </template>
                        <v-list>
                            <Link href="/" target="_blank" as="span">
                                <v-list-item title="Visit Website" link>
                                    <template #prepend>
                                        <v-icon>
                                            <Icon
                                                icon="carbon:earth-southeast-asia-filled"
                                            />
                                        </v-icon>
                                    </template>
                                </v-list-item>
                            </Link>
                        </v-list>
                    </v-menu>
                </v-col>
                <v-col cols="12" md="4">
                    <div class="d-flex align-center justify-center">
                        {{ title }}
                    </div>
                </v-col>
                <v-col cols="12" md="4">
                    <div class="d-flex align-center justify-end">
                        <v-btn
                            icon
                            variant="text"
                            @click="secondary = !secondary"
                        >
                            <v-icon>
                                <Icon :icon="railIcon" />
                            </v-icon>
                        </v-btn>
                    </div>
                </v-col>
            </v-row>
        </v-app-bar>
        <v-navigation-drawer permanent :rail order="1">
            <v-list nav density="compact">
                <template v-for="{ title, icon, to } in navItems" :key="title">
                    <v-tooltip :text="title" :disabled="!rail">
                        <template v-slot:activator="{ props }">
                            <Link :href="to" as="span">
                                <v-list-item
                                    :title
                                    v-bind="props"
                                    link
                                    :active="$page.url === to"
                                    :variant="
                                        $page.url === to ? 'tonal' : undefined
                                    "
                                    color="primary"
                                >
                                    <template #prepend>
                                        <v-icon>
                                            <Icon :icon />
                                        </v-icon>
                                    </template>
                                </v-list-item>
                            </Link>
                        </template>
                    </v-tooltip>
                </template>
            </v-list>
            <template v-slot:append>
                <v-divider></v-divider>
                <v-list>
                    <v-list-item
                        :prepend-avatar="`https://ui-avatars.com/api/?name=${auth.user.name}`"
                        class="pe-0"
                        :title="auth.user.name"
                        :subtitle="auth.user.email"
                    >
                        <template v-slot:append>
                            <v-menu>
                                <template v-slot:activator="{ props }">
                                    <v-btn
                                        v-bind="props"
                                        icon="mdi-menu-down"
                                        size="small"
                                        variant="text"
                                    ></v-btn>
                                </template>
                                <v-list density="compact">
                                    <v-list-item
                                        title="Profile Settings"
                                    ></v-list-item>
                                    <v-divider></v-divider>
                                    <v-list-item title="Log Out"></v-list-item>
                                </v-list>
                            </v-menu>
                        </template>
                    </v-list-item>
                </v-list>
            </template>
        </v-navigation-drawer>
        <v-main>
            <slot />
        </v-main>
        <v-navigation-drawer
            v-model="secondary"
            order="2"
            floating
            temporary
            location="right"
        >
            <slot name="right-nav"></slot>
        </v-navigation-drawer>
    </v-app>
</template>
