<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import GuestLayout from '@/layouts/GuestLayout.vue';
import { socials } from '@/utils/socials';
import { Icon } from '@iconify/vue';
import { Head } from '@inertiajs/vue3';
</script>
<template>
    <Head>
        <title>
            Fullstack Developer with experience in Vuejs, Laravel, Hono, Express
        </title>
    </Head>
    <GuestLayout class="mt-16">
        <v-container>
            <v-row class="mb-3">
                <v-col cols="12">
                    <div class="text-h1 font-weight-bold mb-9">
                        I’m a fullstack developer with passion to create
                        <span class="text-primary-darken-2"
                            >a great experiences</span
                        >
                    </div>
                </v-col>
            </v-row>
            <v-row align="center" class="mb-3">
                <v-col cols="12" md="4">
                    <v-divider></v-divider>
                </v-col>
                <v-col cols="12" md="8">
                    <div class="text-h6 font-weight-light">
                        I’m Saroj Poudel, a full-stack developer and designer
                        based in Kathmandu, Nepal. I focus on creating digital
                        experiences that are intuitive, enjoyable, and
                        effective. Recently, I've been building with Vue,
                        Strapi, Hono combining design sense with strong
                        engineering to deliver practical solutions.
                    </div>
                </v-col>
            </v-row>
            <v-row align="center" class="mb-6">
                <v-col cols="12" md="9">
                    <ul class="list-none pl-0 d-flex align-center">
                        <template v-for="{ name, link } in socials" :key="name">
                            <li class="me-6">
                                <v-hover #default="{ isHovering, props }">
                                    <a
                                        v-bind="props"
                                        class="text-decoration-none text-primary text-h5"
                                        :class="
                                            isHovering
                                                ? 'text-primary-darken-2'
                                                : 'text-primary'
                                        "
                                        :href="link"
                                        target="_blank"
                                    >
                                        {{ name }}
                                        <v-icon size="x-small">
                                            <Icon
                                                icon="carbon:arrow-up-right"
                                            />
                                        </v-icon>
                                    </a>
                                </v-hover>
                            </li>
                        </template>
                    </ul>
                </v-col>
                <v-col cols="12" md="3">
                    <v-btn border block rounded="pill" size="100">
                        Let's talk
                        <template #append>
                            <v-icon end>
                                <Icon icon="mdi-arrow-right" />
                            </v-icon>
                        </template>
                    </v-btn>
                </v-col>
            </v-row>
        </v-container>
    </GuestLayout>
</template>
