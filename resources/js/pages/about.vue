<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import GuestLayout from '@/layouts/GuestLayout.vue';
import { socials } from '@/utils/socials';
import { Icon } from '@iconify/vue';
import { Head, Link } from '@inertiajs/vue3';

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

const software = [
    {
        text: 'Adobe Illustrator',
        icon: 'iconoir:adobe-illustrator',
    },
    {
        text: 'Adobe Photoshop',
        icon: 'iconoir:adobe-photoshop',
    },
    {
        text: 'Adobe XD',
        icon: 'iconoir:adobe-xd',
    },
    {
        text: 'Adobe Premiere Pro',
        icon: 'basil:adobe-premiere-outline',
    },
    {
        text: 'MS Office',
        icon: 'simple-icons:microsoftoffice',
    },
    {
        text: 'VS Code',
        icon: 'tabler:brand-vscode',
    },
    {
        text: 'Linux',
        icon: 'carbon:linux',
    },
];

const frontend = [
    {
        text: 'VueJS',
        icon: 'fa6-brands:vuejs',
    },
    {
        text: 'Vuetify',
        icon: 'mdi:vuetify',
    },
    {
        text: 'NuxtJS',
        icon: 'tabler:brand-nuxt',
    },
];
const backend = [
    {
        text: 'ExpressJs',
        icon: 'simple-icons:express',
    },
    {
        text: 'MongoDB',
        icon: 'tabler:brand-mongodb',
    },
    {
        text: 'SupaBase',
        icon: 'tabler:brand-supabase',
    },
];

// const { data: profile, error: profileError } = await useLazyFetch(
//   "https://api.github.com/users/ropodl"
// );
// const { data: repos, error: reposError } = await useLazyFetch(
//   "https://api.github.com/users/ropodl/repos"
// );

// const getTitle = (name: string) => {
//     return name
//         .split('-')
//         .map((word, index) =>
//             index === 0
//                 ? word.charAt(0).toUpperCase() + word.slice(1)
//                 : word.charAt(0).toUpperCase() + word.slice(1),
//         )
//         .join('');
// };
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
                        A visual partner for brands, companies, and agencies
                    </div>
                </v-col>
                <v-col> </v-col>
            </v-row>
            <v-row dense>
                <v-col cols="12" md="3">
                    <v-row dense>
                        <v-col cols="12" sm="6" md="12">
                            <v-card
                                border
                                height="121"
                                color="brand"
                                class="d-flex align-center"
                            >
                                <v-icon
                                    size="90"
                                    class="position-absolute opacity-40 right-0 top-0"
                                >
                                    <Icon icon="mdi:calendar-clock-outline" />
                                </v-icon>
                                <div class="w-100">
                                    <v-card-title
                                        class="text-h3 font-weight-black text-white pb-0"
                                        style="line-height: 1"
                                    >
                                        5+
                                    </v-card-title>
                                    <v-card-text class="pt-0">
                                        Years of Experience
                                    </v-card-text>
                                </div>
                            </v-card>
                        </v-col>
                        <v-col cols="12" sm="6" md="12">
                            <v-card
                                border
                                height="121"
                                class="d-flex justify-end align-center"
                            >
                                <v-icon
                                    size="90"
                                    class="position-absolute opacity-40 left-0 top-0"
                                >
                                    <Icon
                                        icon="streamline:business-handshake"
                                    />
                                </v-icon>
                                <div>
                                    <v-card-title
                                        class="text-h3 pb-0 font-weight-black text-brand"
                                        style="line-height: 1"
                                    >
                                        10+
                                    </v-card-title>
                                    <v-card-text>Satisfied Clients</v-card-text>
                                </div>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-col>
                <v-col cols="12" md="3">
                    <v-card border height="250">
                        <v-hover v-slot="{ isHovering, props }">
                            <v-img
                                cover
                                v-bind="props"
                                class="h-100"
                                :class="isHovering ? 'zoom-image' : ''"
                                src="/image/portfolio/api(new)/api.avif"
                            >
                                <v-card-title>Website Design</v-card-title>
                            </v-img>
                        </v-hover>
                    </v-card>
                </v-col>
                <v-col cols="12" sm="6" md="3">
                    <v-card
                        border
                        height="250"
                        class="d-flex justify-center align-center"
                    >
                        <v-card-text
                            class="text-h3 font-weight-bold"
                            style="line-height: 50px"
                        >
                            <span class="text-brand">Designer</span> by Nature,
                            <span class="text-brand">Developer by</span> Choice
                        </v-card-text>
                    </v-card>
                </v-col>
                <v-col cols="12" sm="6" md="3">
                    <v-card border height="121" color="brand" class="mb-2">
                        <v-card-title class="h-100">
                            <ul
                                class="list-none h-100 d-flex justify-center align-center flex-wrap"
                            >
                                <template
                                    v-for="{ text, icon } in backend"
                                    :key="text"
                                >
                                    <li>
                                        <v-tooltip
                                            :text
                                            location="bottom"
                                            theme="light"
                                        >
                                            <template
                                                v-slot:activator="{ props }"
                                            >
                                                <v-btn
                                                    flat
                                                    icon
                                                    v-bind="props"
                                                    color="transparent"
                                                >
                                                    <v-icon size="40">
                                                        <Icon :icon />
                                                    </v-icon>
                                                </v-btn>
                                            </template>
                                        </v-tooltip>
                                    </li>
                                </template>
                            </ul>
                        </v-card-title>
                    </v-card>
                    <v-card border height="121">
                        <v-card-title class="h-100">
                            <ul
                                class="list-none h-100 d-flex justify-center align-center flex-wrap"
                            >
                                <template
                                    v-for="{ text, icon } in frontend"
                                    :key="text"
                                >
                                    <li>
                                        <v-tooltip
                                            :text
                                            location="bottom"
                                            theme="light"
                                        >
                                            <template
                                                v-slot:activator="{ props }"
                                            >
                                                <v-btn
                                                    flat
                                                    icon
                                                    v-bind="props"
                                                    color="transparent"
                                                >
                                                    <v-icon
                                                        color="brand"
                                                        size="40"
                                                    >
                                                        <Icon :icon />
                                                    </v-icon>
                                                </v-btn>
                                            </template>
                                        </v-tooltip>
                                    </li>
                                </template>
                            </ul>
                        </v-card-title>
                    </v-card>
                </v-col>
            </v-row>
            <v-row dense>
                <v-col cols="12" md="3">
                    <v-row dense>
                        <v-col cols="12">
                            <v-card border height="250">
                                <v-hover v-slot="{ isHovering, props }">
                                    <v-img
                                        cover
                                        v-bind="props"
                                        class="h-100"
                                        :class="isHovering ? 'zoom-image' : ''"
                                        src="/image/portfolio/bishwaskhabar/full.webp"
                                    >
                                        <v-card-title>Branding</v-card-title>
                                    </v-img>
                                </v-hover>
                            </v-card>
                        </v-col>
                        <v-col cols="12" sm="6" md="12">
                            <v-card border color="brand" height="121">
                                <v-card-title class="h-100">
                                    <ul
                                        class="list-style-none h-100 d-flex justify-center align-center flex-wrap"
                                    >
                                        <template
                                            v-for="{
                                                name,
                                                icon,
                                                link,
                                            } in socials"
                                            :key="name"
                                        >
                                            <li>
                                                <v-tooltip
                                                    :text="name"
                                                    location="bottom"
                                                    theme="light"
                                                >
                                                    <template
                                                        v-slot:activator="{
                                                            props,
                                                        }"
                                                    >
                                                        <v-btn
                                                            flat
                                                            icon
                                                            v-bind="props"
                                                            :href="link"
                                                            target="_blank"
                                                            color="transparent"
                                                        >
                                                            <v-icon>
                                                                <Icon :icon />
                                                            </v-icon>
                                                        </v-btn>
                                                    </template>
                                                </v-tooltip>
                                            </li>
                                        </template>
                                    </ul>
                                </v-card-title>
                            </v-card>
                        </v-col>
                        <v-col cols="12" sm="6" md="12">
                            <v-card border height="250">
                                <v-card-title>Contact Me</v-card-title>
                                <v-divider />
                                <v-card-text>
                                    Please feel free to contact me.
                                </v-card-text>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-col>
                <v-col cols="12" md="6">
                    <v-row dense>
                        <v-col cols="12" sm="12" md="12">
                            <v-card border height="121">
                                <v-hover v-slot="{ isHovering, props }">
                                    <v-img
                                        cover
                                        v-bind="props"
                                        class="h-100"
                                        :class="isHovering ? 'zoom-image' : ''"
                                        src="https://cdn.dribbble.com/users/1462542/screenshots/6586732/legends.png"
                                    >
                                        <v-card-title>
                                            Graphic Design
                                        </v-card-title>
                                    </v-img>
                                </v-hover>
                            </v-card>
                        </v-col>
                        <v-col cols="12">
                            <v-row dense>
                                <v-col cols="12" sm="6" md="6">
                                    <v-card border height="121" class="mb-2">
                                        <v-card-title
                                            class="d-flex h-100 justify-center align-center"
                                        >
                                            <ul
                                                class="list-style-none d-flex flex-wrap"
                                            >
                                                <template
                                                    v-for="{
                                                        text,
                                                        icon,
                                                    } in software"
                                                    :key="text"
                                                >
                                                    <li>
                                                        <v-tooltip
                                                            :text
                                                            location="bottom"
                                                            theme="light"
                                                        >
                                                            <template
                                                                v-slot:activator="{
                                                                    props,
                                                                }"
                                                            >
                                                                <v-btn
                                                                    flat
                                                                    icon
                                                                    v-bind="
                                                                        props
                                                                    "
                                                                    target="_blank"
                                                                    color="transparent"
                                                                >
                                                                    <v-icon
                                                                        size="x-large"
                                                                    >
                                                                        <Icon
                                                                            :icon
                                                                        />
                                                                    </v-icon>
                                                                </v-btn>
                                                            </template>
                                                        </v-tooltip>
                                                    </li>
                                                </template>
                                            </ul>
                                        </v-card-title>
                                    </v-card>
                                    <v-row dense>
                                        <v-col cols="12" md="6">
                                            <v-card
                                                border
                                                height="121"
                                                class="mb-2 pa-0"
                                            >
                                                <v-img
                                                    cover
                                                    src="/avatar.jpg"
                                                ></v-img>
                                            </v-card>
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <!-- <v-card
                                                border
                                                height="121"
                                                class="mb-2"
                                                :class="[
                                                    profileError
                                                        ? ''
                                                        : 'd-flex align-center justify-center',
                                                ]"
                                            >
                                                <div v-if="profile">
                                                    <v-card-title
                                                        class="text-h4 text-center font-weight-black text-brand pb-0"
                                                    >
                                                        {{
                                                            profile.public_repos
                                                        }}
                                                    </v-card-title>
                                                    <v-card-text
                                                        class="text-center pb-0"
                                                    >
                                                        Public Repos
                                                    </v-card-text>
                                                </div>
                                                <div v-else>
                                                    <v-alert
                                                        rounded="0"
                                                        type="error"
                                                        text="Error loading GitHub profile"
                                                    ></v-alert>
                                                </div>
                                            </v-card> -->
                                        </v-col>
                                    </v-row>
                                    <v-card border height="250" title="Repos">
                                        <v-divider></v-divider>
                                        <v-card-text
                                            class="pa-0"
                                            style="
                                                height: 195px;
                                                overflow-y: scroll;
                                            "
                                        >
                                            <!-- <template v-if="repos">
                                                <v-list
                                                    class="py-0"
                                                    density="compact"
                                                    bg-color="transparent"
                                                >
                                                    <template
                                                        v-for="(
                                                            { name, html_url },
                                                            i
                                                        ) in repos"
                                                    >
                                                        <v-list-item
                                                            :title="
                                                                getTitle(name)
                                                            "
                                                        >
                                                            <template
                                                                v-slot:append
                                                            >
                                                                <v-btn
                                                                    icon
                                                                    size="small"
                                                                    :href="
                                                                        html_url
                                                                    "
                                                                    target="_blank"
                                                                    variant="text"
                                                                >
                                                                    <v-icon>
                                                                        <Icon
                                                                            name="mdi:open-in-new"
                                                                        />
                                                                    </v-icon>
                                                                </v-btn>
                                                            </template>
                                                        </v-list-item>
                                                        <v-divider
                                                            v-if="
                                                                i !=
                                                                repos.length - 1
                                                            "
                                                        ></v-divider>
                                                    </template>
                                                </v-list>
                                            </template>
                                            <template v-else>
                                                <v-alert
                                                    rounded="0"
                                                    type="error"
                                                    text="Error loading GitHub repo infos"
                                                ></v-alert>
                                            </template> -->
                                        </v-card-text>
                                    </v-card>
                                </v-col>
                            </v-row>
                        </v-col>
                    </v-row>
                </v-col>
            </v-row>
        </v-container>
    </GuestLayout>
</template>
