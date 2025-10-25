<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import GuestLayout from '@/layouts/GuestLayout.vue';
import { Icon } from '@iconify/vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps<{
  media: any;
}>();

type blogs = {
  date: string;
  slug: string;
  title: string;
  desc: string;
  featured_image: {
    name: string;
    url: string;
  };
};

const blogs = ref<blogs[]>([
  {
    date: '',
    slug: 'hi',
    title: 'Exploring the Power of Minimalism in Visual Design',
    desc: 'thsi isosidjfiosdjfiosdjfiosjf siodjfosijfsiodfj siodjf siojfsiodjfsoidjf siodjf s',
    featured_image: { name: 'test', url: '/media/avatar.webp' },
  },
  {
    date: '',
    slug: 'hi',
    title: 'This is a test',
    desc: 'thsi isosidjfiosdjfiosdjfiosjf siodjfosijfsiodfj siodjf siojfsiodjfsoidjf siodjf s',
    featured_image: { name: 'test', url: '/media/avatar.webp' },
  },
  {
    date: '',
    slug: 'hi',
    title: 'Exploring the Power of Minimalism in Visual Design',
    desc: 'thsi isosidjfiosdjfiosdjfiosjf siodjfosijfsiodfj siodjf siojfsiodjfsoidjf siodjf s',
    featured_image: { name: 'test', url: '/media/avatar.webp' },
  },
  {
    date: '',
    slug: 'hi',
    title: 'This is a test',
    desc: 'thsi isosidjfiosdjfiosdjfiosjf siodjfosijfsiodfj siodjf siojfsiodjfsoidjf siodjf s',
    featured_image: { name: 'test', url: '/media/avatar.webp' },
  },
  {
    date: '',
    slug: 'hi',
    title: 'Exploring the Power of Minimalism in Visual Design',
    desc: 'thsi isosidjfiosdjfiosdjfiosjf siodjfosijfsiodfj siodjf siojfsiodjfsoidjf siodjf s',
    featured_image: { name: 'test', url: '/media/avatar.webp' },
  },
  {
    date: '',
    slug: 'hi',
    title: 'This is a test',
    desc: 'thsi isosidjfiosdjfiosdjfiosjf siodjfosijfsiodfj siodjf siojfsiodjfsoidjf siodjf s',
    featured_image: { name: 'test', url: '/media/avatar.webp' },
  },
  {
    date: '',
    slug: 'hi',
    title: 'Exploring the Power of Minimalism in Visual Design',
    desc: 'thsi isosidjfiosdjfiosdjfiosjf siodjfosijfsiodfj siodjf siojfsiodjfsoidjf siodjf s',
    featured_image: { name: 'test', url: '/media/avatar.webp' },
  },
  {
    date: '',
    slug: 'hi',
    title: 'This is a test',
    desc: 'thsi isosidjfiosdjfiosdjfiosjf siodjfosijfsiodfj siodjf siojfsiodjfsoidjf siodjf s',
    featured_image: { name: 'test', url: '/media/avatar.webp' },
  },
]);
</script>

<template>
  <Head>
    <title>Blog</title>
  </Head>
  <guest-layout class="mt-16">
    <template #title>
      A collection of my
      <span class="text-primary-darken-2">thoughts</span>.
    </template>
    <v-container>
      <template v-if="blogs.length">
        <v-row
          v-gsap.whenVisible.stagger.from="{
            opacity: 0,
            y: 50,
            stagger: 0.4,
          }"
          class="mb-16"
        >
          <template
            v-for="({ slug, title, desc, featured_image: { name, url } }, i) in blogs"
            :key="title"
          >
            <template v-if="i === 0">
              <v-col cols="12">
                <v-row class="mb-3">
                  <v-col cols="12" md="6">
                    <Link :href="`/blog/${slug}`" as="span">
                      <v-hover v-slot="{ isHovering, props }">
                        <v-card
                          v-bind="props"
                          border
                          color="white"
                          height="400"
                          rounded="xl"
                          :variant="isHovering ? 'tonal' : 'text'"
                          :to="`/blogs/${slug}`"
                        >
                          <v-img cover :src="url" :alt="name">
                            <template v-slot:placeholder>
                              <div class="d-flex align-center justify-center fill-height">
                                <v-skeleton-loader
                                  class="w-100 h-100"
                                  type="image"
                                ></v-skeleton-loader>
                              </div>
                            </template>
                          </v-img>
                          <!-- <v-card
                                                        border
                                                        flat
                                                        height="400"
                                                        class="mb-3"
                                                        rounded="xl"
                                                    >
                                                    </v-card> -->
                        </v-card>
                      </v-hover>
                    </Link>
                  </v-col>
                  <v-col cols="12" md="6">
                    <div class="d-flex flex-column">
                      <Link class="text-decoration-none" :href="`/blog/${slug}`">
                        <v-card-text
                          class="pt-0 text-h3 font-weight-medium text-white pb-0 line-clamp-3"
                          style="line-height: normal; white-space: normal"
                        >
                          {{ title }}
                        </v-card-text>
                      </Link>
                      <v-card-text class="text-white text-subtitle-1">
                        {{ desc }}
                      </v-card-text>
                      <v-card-actions>
                        <Link class="text-decoration-none" :href="`/blog/${slug}`" as="VBtn">
                          <v-btn icon variant="outlined" width="100" height="60" rounded="pill">
                            <v-icon>
                              <Icon icon="carbon:arrow-right" />
                            </v-icon>
                          </v-btn>
                        </Link>
                      </v-card-actions>
                    </div>
                  </v-col>
                </v-row>
              </v-col>
            </template>
            <template v-else>
              <v-col cols="12" sm="6" md="6" lg="4">
                <v-hover #default="{ isHovering, props }">
                  <Link v-bind="props" class="text-decoration-none" :href="`/blog/${slug}`">
                    <v-card
                      border
                      flat
                      height="400"
                      class="mb-3"
                      color="white"
                      :variant="isHovering ? 'tonal' : 'text'"
                      rounded="xl"
                    >
                      <v-img cover height="400" :src="url" :alt="name">
                        <template v-slot:placeholder>
                          <div class="d-flex align-center justify-center fill-height">
                            <v-skeleton-loader class="w-100 h-100" type="image"></v-skeleton-loader>
                          </div>
                        </template>
                      </v-img>
                    </v-card>
                    <v-card border="0" rounded="0" color="transparent">
                      <v-card-text
                        class="pt-2 text-h6 text-white px-0 pb-0 line-clamp-3"
                        style="line-height: normal; white-space: normal"
                      >
                        {{ title }}
                      </v-card-text>
                      <v-card-text class="text-white text-caption pl-0">
                        April 20, 2025
                      </v-card-text>
                    </v-card>
                  </Link>
                </v-hover>
              </v-col>
            </template>
          </template>
        </v-row>
      </template>
      <template v-else>
        <v-row>
          <v-col cols="12">
            <v-card border>
              <v-card-text> Sorry, content not available at the moment. </v-card-text>
            </v-card>
          </v-col>
        </v-row>
      </template>
    </v-container>
  </guest-layout>
</template>
