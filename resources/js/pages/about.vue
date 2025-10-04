<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import GuestLayout from '@/layouts/GuestLayout.vue';
import { Icon } from '@iconify/vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const experience = [
    {
        title: 'Graphic/Web Designer',
        year: '2018',
        desc: 'Fivonest Technology @ Solteemode, Kathmandu',
    },
    {
        title: 'Chief Technology Officer',
        year: '2019 - 2023',
        desc: 'SoftMahal Technologies @ Mid Baneshwor, Kathmandu',
    },
    {
        title: 'Mid Level Frontend Developer',
        year: '2024 - Current',
        desc: 'Aayulogic Pvt. Ltd. @ Chakupat, Lalitpur',
    },
];

// const software = [
//     {
//         text: 'Adobe Illustrator',
//         icon: 'iconoir:adobe-illustrator',
//     },
//     {
//         text: 'Adobe Photoshop',
//         icon: 'iconoir:adobe-photoshop',
//     },
//     {
//         text: 'Adobe XD',
//         icon: 'iconoir:adobe-xd',
//     },
//     {
//         text: 'Adobe Premiere Pro',
//         icon: 'basil:adobe-premiere-outline',
//     },
//     {
//         text: 'MS Office',
//         icon: 'simple-icons:microsoftoffice',
//     },
//     {
//         text: 'VS Code',
//         icon: 'tabler:brand-vscode',
//     },
//     {
//         text: 'Linux',
//         icon: 'carbon:linux',
//     },
// ];

// const frontend = [
//     {
//         text: 'VueJS',
//         icon: 'fa6-brands:vuejs',
//     },
//     {
//         text: 'Vuetify',
//         icon: 'mdi:vuetify',
//     },
//     {
//         text: 'NuxtJS',
//         icon: 'tabler:brand-nuxt',
//     },
// ];
// const backend = [
//     {
//         text: 'ExpressJs',
//         icon: 'simple-icons:express',
//     },
//     {
//         text: 'MongoDB',
//         icon: 'tabler:brand-mongodb',
//     },
//     {
//         text: 'SupaBase',
//         icon: 'tabler:brand-supabase',
//     },
// ];

const items = ref([
    {
        src: 'https://cdn.prod.website-files.com/64aac2cf3e57b0b94358bac8/64c3379c2af64bdc37bd731d_Pipefy.svg',
        width: 120,
        title: 'This is a test',
    },
    {
        src: 'https://cdn.prod.website-files.com/64aac2cf3e57b0b94358bac8/64c3379b998d40df52eb9f7b_Django.svg',
        width: 120,
    },
    {
        src: 'https://cdn.prod.website-files.com/64aac2cf3e57b0b94358bac8/64c3379c16bbd4367791cbf8_Rackspace.svg',
        width: 120,
    },
    {
        src: 'https://cdn.prod.website-files.com/64aac2cf3e57b0b94358bac8/64c3379b3b98e1ea07ff4956_Portal.svg',
        width: 120,
    },
]);
</script>
<template>
    <Head>
        <title>About Me</title>
    </Head>
    <GuestLayout class="mt-16">
        <template #title>
            <span class="text-primary-darken-2">About me,</span> my story and my
            experience.
        </template>
        <v-container>
            <v-row>
                <v-col cols="12" md="6">
                    <v-card border rounded="xl">
                        <v-parallax
                            cover
                            height="400"
                            scale="0.9"
                            src="/media/full.jpg"
                        ></v-parallax>
                    </v-card>
                </v-col>
                <v-col
                    cols="12"
                    md="6"
                    class="d-flex flex-column justify-space-between"
                >
                    <div class="text-h6 font-weight-light">
                        As a Senior Designer with over 10 years of experience, I
                        specialize in creating intuitive and user-centered
                        interfaces for a wide range of digital products and
                        experiences.
                    </div>
                    <Link href="/" as="span">
                        <v-btn border rounded="pill" width="230" height="80">
                            Let's talk
                            <template #append>
                                <v-icon end>
                                    <Icon icon="mdi-arrow-right" />
                                </v-icon>
                            </template>
                        </v-btn>
                    </Link>
                </v-col>
            </v-row>
            <v-row class="py-16">
                <v-col cols="12" md="6">
                    <div
                        class="text-h3 font-weight-medium position-sticky"
                        style="top: 50px"
                    >
                        My past work<br />experience
                    </div>
                </v-col>
                <v-col cols="12" md="6">
                    <v-list
                        bg-color="transparent"
                        class="py-0"
                        density="default"
                    >
                        <template
                            v-for="(item, index) in experience"
                            :key="item.title"
                        >
                            <v-list-item :class="index === 0 ? 'mb-6' : 'my-6'">
                                <v-list-item-title
                                    class="text-h5 font-weight-medium mb-3"
                                >
                                    {{ item.title }}
                                </v-list-item-title>
                                <v-list-item-subtitle
                                    class="text-body-1"
                                    style="line-height: unset"
                                >
                                    {{ item.desc }}
                                </v-list-item-subtitle>
                                <template #append>
                                    {{ item.year }}
                                </template>
                            </v-list-item>
                            <v-divider></v-divider>
                        </template>
                    </v-list>
                </v-col>
            </v-row>
            <v-row class="pb-16">
                <v-col cols="12">
                    <div class="text-h2 font-weight-medium">
                        A visual partner for brands, companies, and agencies.
                    </div>
                </v-col>
                <v-col cols="12" class="mt-10">
                    <v-row>
                        <template v-for="item in items" :key="item.src">
                            <v-col cols="12" md="3">
                                <v-img width="120" :src="item.src"></v-img>
                                <v-card-title class="px-0">
                                    UIUX & Branding
                                </v-card-title>
                                <v-card-subtitle class="px-0"
                                    >2022</v-card-subtitle
                                >
                            </v-col>
                        </template>
                    </v-row>
                </v-col>
            </v-row>
        </v-container>
    </GuestLayout>
</template>
