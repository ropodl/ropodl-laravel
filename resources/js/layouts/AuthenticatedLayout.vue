<script setup lang="ts">
import { left, right } from '@/composables/nav';
import { Icon } from '@iconify/vue';
import { router, usePage } from '@inertiajs/vue3';
import { computed, defineAsyncComponent, ref } from 'vue';

const snackbar = defineAsyncComponent(() => import('@/components/shared/snackbar.vue'));

defineProps<{
  title: string;
}>();

const { props } = usePage();

type navItem = {
  icon: string;
  title: string;
  subtitle?: string;
  to?: string;
  subitems?: {
    title: string;
    to?: string;
    grand?: { title: string; to?: string }[];
  }[];
};

const navItems = ref<navItem[]>([
  { icon: 'carbon:home', title: 'Home', to: '/admin' },
  {
    icon: 'carbon:edit',
    title: 'Blog',
    subtitle: 'Content And Portfolio',
    subitems: [
      { title: 'All Blogs', to: '/admin/blog' },
      { title: 'Add New', to: '/admin/blog/create' },
      { title: 'Categories', to: '/admin/category' },
      { title: 'Tags', to: '/admin/tag' },
      {
        title: 'Blog Comments',
        grand: [{ title: 'All Comments', to: '/admin/blog/comments' }],
      },
    ],
  },
  {
    icon: 'carbon:image',
    title: 'Portfolio',
    subitems: [
      { title: 'All Portfolio', to: '/admin/portfolio' },
      { title: 'Add New', to: '/admin/portfolio/create' },
      { title: 'Work Type', to: '/admin/portfolio-type' },
    ],
  },
  // {
  //     icon: 'mdi-phone-outline',
  //     title: 'Contact Request',
  //     subtitle: 'Contact and Feedback',
  //     to: '/admin/contact-request',
  // },
]);

const railIcon = computed(() => {
  return left.value ? 'carbon:side-panel-close' : 'carbon:side-panel-open';
});

const openHome = () => {
  window.open('/', '_blank');
};
</script>

<template>
  <v-app>
    <v-app-bar flat density="compact" border="b" order="0" height="54" color="rgba(var(--v-theme-surface), 0.7)"
      class="px-1 blur-8">
      <v-row align="center">
        <v-col cols="4" md="4">
          <v-btn v-tooltip:right="`${left ? 'Collapse' : 'Expand'} Navigation`" icon height="54" variant="text"
            rounded="0" @click="left = !left">
            <v-icon>
              <Icon :icon="railIcon" />
            </v-icon>
          </v-btn>
          <v-menu open-on-hover>
            <template v-slot:activator="{ props }">
              <v-btn rounded="0" color="primary" v-bind="props"> Website </v-btn>
            </template>
            <v-list density="compact">
              <v-list-item link title="Visit Website" @click="openHome">
                <template #prepend>
                  <v-icon>
                    <Icon icon="carbon:earth-southeast-asia-filled" />
                  </v-icon>
                </template>
              </v-list-item>
            </v-list>
          </v-menu>
        </v-col>
        <v-col cols="4" md="4">
          <div class="d-flex align-center justify-center">
            {{ title }}
          </div>
        </v-col>
        <v-col cols="4" md="4">
          <div class="d-flex align-center justify-end"></div>
        </v-col>
      </v-row>
    </v-app-bar>
    <v-navigation-drawer v-model="left" permanent order="1" color="rgba(var(--v-theme-surface), 0.7)" class="blur-8">
      <v-list nav open-strategy="single" density="compact">
        <template v-for="{ title, icon, to, subitems } in navItems" :key="to">
          <template v-if="!subitems">
            <v-list-item :title link @click="router.visit(<string>to)">
              <template #prepend>
                <v-icon :icon />
              </template>
            </v-list-item>
          </template>
          <template v-else>
            <v-list-group>
              <template v-slot:activator="{ props }">
                <v-list-item v-bind="props" :title>
                  <template #prepend>
                    <v-icon :icon />
                  </template>
                </v-list-item>
              </template>

              <template v-for="({ title, grand, to }, i) in subitems" :key="i">
                <template v-if="!grand">
                  <v-list-item :title link @click="router.visit(<string>to)"></v-list-item>
                </template>
              </template>

            </v-list-group>
          </template>
        </template>
      </v-list>
      <template v-slot:append>
        <v-divider></v-divider>
        <v-list>
          <template v-if="props.auth?.user">
            <v-list-item class="pe-0" :title="props.auth?.user.name" :subtitle="props.auth?.user.email">
              <template #prepend>
                <v-avatar>
                  <v-img :src="`https://ui-avatars.com/api/?name=${props.auth?.user.name}`"></v-img>
                </v-avatar>
              </template>
              <template #append>
                <v-menu>
                  <template v-slot:activator="{ props }">
                    <v-btn v-bind="props" icon="mdi-menu-down" size="small" variant="text"></v-btn>
                  </template>
                  <v-list density="compact">
                    <v-list-item title="Profile Settings"></v-list-item>
                    <v-divider></v-divider>
                    <v-list-item title="Log Out"></v-list-item>
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
    <v-layout>
      <snackbar />
    </v-layout>
    <v-navigation-drawer v-model="right" order="2" temporary location="right" width="400"
      color="rgba(var(--v-theme-surface), 0.7)" class="pa-3 blur-8" content-class="d-flex flex-column">
      <slot name="right-nav-body"></slot>
      <template #append>
        <v-divider></v-divider>
        <slot name="right-nav-append"></slot>
      </template>
    </v-navigation-drawer>
  </v-app>
</template>
