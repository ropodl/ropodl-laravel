<script setup lang="ts">
import Dynamic from '@/components/shared/dynamic.vue';
import { computed, defineAsyncComponent, ref } from 'vue';
import { useDisplay } from 'vuetify';

const GuestLayout = defineAsyncComponent(
    () => import('@/layouts/GuestLayout.vue'),
);

const test = ref(
    'oiajsdijas dij asidj aiosjd oaisdj aosijd oaisjd aiosjd aiosj',
);

const { xs, sm, md, lg, xlAndUp } = useDisplay();
const calculateHeight = computed(() => {
    if (xs.value) return 300;
    else if (sm.value) return 400;
    else if (md.value) return 550;
    else if (lg.value) return 650;
    else if (xlAndUp.value) return 800;
    return 700;
});
const blog = ref({
    date: '',
    slug: 'hi',
    title: 'Asus TUF Gaming F16 (2025) launched in Nepal with RTX 5060 GPU',
    featured_image: { name: 'test', url: '/media/avatar.webp' },
    excerpt: 'this is a tests',
    content: `asdasd`,
});
</script>
<template>
    <guest-layout>
        <v-card border="b" rounded="0">
            <v-img
                cover
                :height="calculateHeight"
                :src="blog.featured_image?.url"
                class="d-flex align-end"
            >
                <template v-if="blog.title">
                    <v-container>
                        <v-row>
                            <v-col cols="12">
                                <v-card-title
                                    class="text-md-h2 text-h4 font-weight-bold px-0"
                                    style="
                                        line-height: 1.2;
                                        font-family: 'Ubuntu';
                                        white-space: unset !important;
                                    "
                                >
                                    {{ blog.title }}
                                </v-card-title>
                            </v-col>
                        </v-row>
                    </v-container>
                </template>
            </v-img>
        </v-card>
    </guest-layout>
    <v-container>
        <v-row v-if="blog.excerpt">
            <v-col cols="12" md="12">
                <div class="text-h6 text-sm-h4 font-weight-light">
                    {{ blog.excerpt }}
                </div>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" md="12">
                <template v-if="blog.content">
                    <dynamic :content="blog.content" />
                </template>
            </v-col>
        </v-row>
    </v-container>
</template>
