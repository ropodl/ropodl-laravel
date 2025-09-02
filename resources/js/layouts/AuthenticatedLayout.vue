<script setup lang="ts">
import { useNavDrawerStore } from '@/store/admin/nav';
import { Icon } from '@iconify/vue';
import { usePage } from '@inertiajs/vue3';
import { storeToRefs } from 'pinia';
import { computed, ref } from 'vue';

defineProps<{
    title: string;
}>();

const { props } = usePage();

const nav = useNavDrawerStore();
const { left, right } = storeToRefs(nav);

const navItems = ref([
    { icon: 'mdi-home-outline', title: 'Home', to: '/admin/' },
    {
        icon: 'mdi-pencil-outline',
        title: 'Blog',
        subtitle: 'Content And Portfolio',
        subitems: [
            { title: 'All Blogs', to: '/admin/blog' },
            { title: 'Add New', to: '/admin/blog/create' },
            { title: 'Categories', to: '/admin/category' },
            { title: 'Tags', to: '/admin/tag' },
            {
                icon: 'mdi-pencil-outline',
                title: 'Blog Comments',
                grand: [{ title: 'All Comments', to: '/admin/blog/comments' }],
            },
        ],
    },
    {
        icon: 'mdi-image-outline',
        title: 'Portfolio',
        subitems: [
            { title: 'All Portfolio', to: '/admin/portfolio' },
            { title: 'Add New', to: '/admin/portfolio/create' },
            { title: 'Work Type', to: '/admin/portfolio/type' },
        ],
    },
    {
        icon: 'mdi-phone-outline',
        title: 'Contact Request',
        subtitle: 'Contact and Feedback',
        to: '/admin/contact-request',
    },
]);
//     {
//         icon: 'carbon:home',
//         title: 'Home',
//         to: '/admin/',
//     },
//     {
//         icon: 'carbon:blog',
//         title: 'Blogs',
//         to: '/admin/blog',
//     },
//     {
//         icon: 'carbon:home',
//         title: 'Portfolios',
//         to: '/admin/portfolio',
//     },
// ]);

const railIcon = computed(() => {
    return left.value ? 'carbon:side-panel-open' : 'carbon:side-panel-close';
});

const openHome = () => {
    window.open('/', '_blank');
};

const open = ref(['/admin/']);

const admins = [
    ['Management', 'mdi-account-multiple-outline'],
    ['Settings', 'mdi-cog-outline'],
];
const cruds = [
    ['Create', 'mdi-plus-outline'],
    ['Read', 'mdi-file-outline'],
    ['Update', 'mdi-update'],
    ['Delete', 'mdi-delete'],
];
</script>

<template>
    <v-app>
        <v-app-bar
            flat
            density="compact"
            border="b"
            order="0"
            height="64"
            color="rgba(var(--v-theme-surface), 0.7)"
            class="px-1 blur-8"
        >
            <v-row align="center">
                <v-col cols="12" md="4">
                    <v-btn
                        icon
                        height="36"
                        variant="text"
                        @click="left = !left"
                    >
                        <v-icon>
                            <Icon :icon="railIcon" />
                        </v-icon>
                    </v-btn>
                    <v-menu open-on-hover>
                        <template v-slot:activator="{ props }">
                            <v-btn color="primary" v-bind="props">
                                Website
                            </v-btn>
                        </template>
                        <v-list density="compact">
                            <v-list-item
                                link
                                title="Visit Website"
                                @click="openHome"
                            >
                                <template #prepend>
                                    <v-icon>
                                        <Icon
                                            icon="carbon:earth-southeast-asia-filled"
                                        />
                                    </v-icon>
                                </template>
                            </v-list-item>
                        </v-list>
                    </v-menu>
                </v-col>
                <v-col cols="12" md="4">
                    <div class="d-flex align-center justify-center">
                        {{ title }}
                    </div>
                </v-col>
                <v-col cols="12" md="4">
                    <div class="d-flex align-center justify-end"></div>
                </v-col>
            </v-row>
        </v-app-bar>
        <v-navigation-drawer
            permanent
            :rail="left"
            order="1"
            color="rgba(var(--v-theme-surface), 0.7)"
            class="blur-8"
        >
            {{ open }}
            <v-list v-model:opened="open" nav density="compact">
                <template
                    v-for="{ title, icon, to, subitems } in navItems"
                    :key="title"
                >
                    <v-list-item
                        prepend-icon="mdi-home"
                        title="Home"
                    ></v-list-item>

                    <v-list-group value="Users">
                        <template v-slot:activator="{ props }">
                            <v-list-item
                                v-bind="props"
                                prepend-icon="mdi-account-circle"
                                title="Users"
                            ></v-list-item>
                        </template>

                        <v-list-group value="Admin">
                            <template v-slot:activator="{ props }">
                                <v-list-item
                                    v-bind="props"
                                    title="Admin"
                                ></v-list-item>
                            </template>

                            <v-list-item
                                v-for="([title, icon], i) in admins"
                                :key="i"
                                :prepend-icon="icon"
                                :title="title"
                                :value="title"
                            ></v-list-item>
                        </v-list-group>

                        <v-list-group value="Actions">
                            <template v-slot:activator="{ props }">
                                <v-list-item
                                    v-bind="props"
                                    title="Actions"
                                ></v-list-item>
                            </template>

                            <v-list-item
                                v-for="([title, icon], i) in cruds"
                                :key="i"
                                :prepend-icon="icon"
                                :title="title"
                                :value="title"
                            ></v-list-item>
                        </v-list-group>
                    </v-list-group>
                </template>
            </v-list>
            <template v-slot:append>
                <v-divider></v-divider>
                <v-list>
                    <template v-if="props.auth?.user">
                        <v-list-item
                            class="pe-0"
                            :title="props.auth?.user.name"
                            :subtitle="props.auth?.user.email"
                        >
                            <template #prepend>
                                <v-avatar>
                                    <v-img
                                        :src="`https://ui-avatars.com/api/?name=${props.auth?.user.name}`"
                                    ></v-img>
                                </v-avatar>
                            </template>
                            <template #append>
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
                                        <v-list-item
                                            title="Log Out"
                                        ></v-list-item>
                                    </v-list>
                                </v-menu>
                            </template>
                        </v-list-item>
                    </template>
                </v-list>
            </template>
        </v-navigation-drawer>
        <v-main>
            <slot />
        </v-main>
        <v-navigation-drawer
            v-model="right"
            order="2"
            temporary
            location="right"
            width="400"
            color="rgba(var(--v-theme-surface), 0.7)"
            class="pa-3 blur-8"
            content-class="d-flex flex-column"
        >
            <slot name="right-nav-body"></slot>
            <template #append>
                <v-divider></v-divider>
                <slot name="right-nav-append"></slot>
            </template>
        </v-navigation-drawer>
    </v-app>
</template>
