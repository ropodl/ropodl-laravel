<script setup lang="ts">
import { left, right } from '@/composables/nav';
import type { navItem } from '@/types/layout';
import { router, usePage } from '@inertiajs/vue3';
import { defineAsyncComponent, ref } from 'vue';

const snackbar = defineAsyncComponent(() => import('@/components/shared/snackbar.vue'));

defineProps<{
  title: string;
}>();

const { props } = usePage();
console.log(props.ziggy.location);

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
  {
    icon: 'mdi-phone-outline',
    title: 'Contact Request',
    subtitle: 'Contact and Feedback',
    to: '/admin/contact-request',
  },
]);
</script>

<template>
  <v-app>
    <v-navigation-drawer
      v-model="left"
      rail
      permanent
      height="100"
      color="rgba(var(--v-theme-surface), 0.7)"
      class="blur-8"
    >
      <v-list
        nav
        density="compact"
      >
        <template
          v-for="{ title, icon, to, subitems } in navItems"
          :key="to"
        >
          {{  }}
          <template v-if="!subitems">
            <v-list-item
              v-bind="props"
              rounded="lg"
              link
              :title
              @click="router.visit(<string>to)"
            >
              <template #prepend>
                <v-icon :icon />
              </template>
            </v-list-item>
          </template>
          <template v-else>
            <v-menu
              :close-on-content-click="false"
              location="end"
              offset="14"
            >
              <template v-slot:activator="{ props }">
                <v-list-item
                  v-bind="props"
                  link
                >
                  <template #prepend>
                    <v-icon :icon />
                  </template>
                </v-list-item>
              </template>

              <v-card width="300">
                <v-card-title class="d-flex align-center pb-0">
                  <v-icon
                    start
                    :icon
                    size="small"
                  ></v-icon>
                  {{ title }}
                </v-card-title>
                <!-- <v-divider></v-divider> -->
                <v-list
                  density="compact"
                  class="pa-0"
                >
                  <template
                    v-for="(item, i) in subitems"
                    :key="i"
                  >
                    <v-list-item
                      link
                      :title="item.title"
                      @click="router.visit(<string>item.to)"
                    ></v-list-item>
                  </template>
                </v-list>
              </v-card>
            </v-menu>
          </template>
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
                  <v-img :src="`https://ui-avatars.com/api/?name=${props.auth?.user.name}`"></v-img>
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
    <v-navigation-drawer
      v-model="right"
      temporary
      order="2"
      location="right"
      width="400"
      color="rgba(var(--v-theme-surface), 0.7)"
      class="pa-3 blur-8"
      content-class="d-flex flex-column"
    >
      <slot name="right-nav-body"></slot>
      <template #append>
        <!-- <v-divider></v-divider> -->
        <slot name="right-nav-append"></slot>
      </template>
    </v-navigation-drawer>
  </v-app>
</template>
