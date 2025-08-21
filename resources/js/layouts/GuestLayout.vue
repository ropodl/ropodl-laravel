<script setup lang="ts">
import navbar from '@/components/guest/layout/navbar.vue';

defineProps<{
    title?: string;
}>();
</script>

<template>
    <v-app>
        <navbar />
        <v-main>
            <template v-if="title">
                <v-container>
                    <v-row>
                        <v-col
                            cols="12"
                            class="text-lg-h1 text-h3 font-weight-bold"
                        >
                            {{ title }}
                        </v-col>
                    </v-row>
                </v-container>
            </template>
            <slot />
        </v-main>
    </v-app>
</template>
