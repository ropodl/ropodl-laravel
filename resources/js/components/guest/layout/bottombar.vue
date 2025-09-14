<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import { socials } from '@/utils/socials';
import { Icon } from '@iconify/vue';
</script>
<template>
    <v-footer
        absolute
        border="t"
        class="blur-8"
        color="rgba(var(--v-theme-background),0.7)"
    >
        <v-card color="transparent" border="0" rounded="0" class="py-16 w-100">
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <div class="text-h5 mb-6">
                                Liked my works? Let's Talk and work together
                            </div>
                            <div
                                class="text-h1 font-weight-bold d-flex align-start"
                            >
                                <span class="text-primary-darken-2">hello</span
                                >@ropodl.com
                                <v-btn
                                    icon
                                    color="primary"
                                    variant="tonal"
                                    rounded="circle"
                                    size="x-large"
                                    class="ms-3"
                                >
                                    <v-icon>
                                        <Icon icon="carbon:arrow-up-right" />
                                    </v-icon>
                                </v-btn>
                            </div>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>
            <v-card-text>
                <v-container>
                    <v-row align="center" justify="center">
                        <v-col cols="12" md="6">
                            <div class="d-flex align-center text-body-1">
                                Copyright © {{ new Date().getFullYear() }}.
                            </div>
                        </v-col>
                        <v-col cols="12" md="6">
                            <ul
                                class="list-none d-flex justify-sm-center justify-md-end"
                            >
                                <template
                                    v-for="{ icon, link } in socials"
                                    :key="link"
                                >
                                    <li>
                                        <v-btn
                                            icon
                                            rounded="lg"
                                            color="primary"
                                            variant="text"
                                            class="mr-3"
                                            :href="link"
                                        >
                                            <v-icon>
                                                <Icon :icon />
                                            </v-icon>
                                        </v-btn>
                                    </li>
                                </template>
                            </ul>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>
        </v-card>
    </v-footer>
</template>

<style></style>
