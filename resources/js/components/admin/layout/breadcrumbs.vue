<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import { Icon } from '@iconify/vue';
import { Link } from '@inertiajs/vue3';

defineProps<{
    items: BreadcrumbItem[];
    back?: boolean;
}>();
</script>
<template>
    <v-row>
        <v-col cols="12">
            <div class="d-flex align-center">
                <template v-if="back">
                    <v-btn border icon size="small">
                        <v-icon>
                            <Icon icon="carbon:arrow-left" />
                        </v-icon>
                    </v-btn>
                </template>
                <v-breadcrumbs density="compact" :items="items">
                    <template v-slot:prepend>
                        <v-icon size="small">
                            <Icon icon="carbon:home" />
                        </v-icon>
                    </template>
                    <template #item="{ item }">
                        <Link
                            class="text-decoration-none text-white"
                            :href="item.href"
                            as="VBtn"
                        >
                            {{ item.title }}
                        </Link>
                    </template>
                </v-breadcrumbs>
            </div>
        </v-col>
    </v-row>
</template>
