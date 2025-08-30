<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Icon } from '@iconify/vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const pagination = ref({
    current: 1,
    total: 100,
    itemsPerPage: 10,
});
</script>

<template>
    <Head>
        <title>Portfolios</title>
    </Head>
    <AuthenticatedLayout title="Portfolios List">
        <v-container>
            <v-row align="center">
                <v-col cols="12" md="4">
                    <v-text-field
                        hide-details
                        clearable
                        persistent-clear
                        rounded="lg"
                        placeholder="Search portfolios"
                    >
                        <template #prepend-inner>
                            <v-icon>
                                <Icon icon="carbon:search" />
                            </v-icon>
                        </template>
                    </v-text-field>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="12" md="6">
                    <div class="d-flex">
                        <v-spacer></v-spacer>
                        <v-btn flat class="me-3">
                            <v-icon>
                                <Icon icon="carbon:filter" />
                            </v-icon>
                        </v-btn>
                        <v-btn flat color="primary">Add New</v-btn>
                    </div>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12">
                    <v-card rounded="lg">
                        <v-data-table-server
                            :items="[
                                { title: 'est', actions: 'asd' },
                                { title: 'est', actions: 'asd' },
                            ]"
                            items-length="10"
                            hide-default-footer
                        ></v-data-table-server>
                    </v-card>
                </v-col>
            </v-row>
            <v-row align="center">
                <v-col cols="12" md="6">
                    <div class="d-flex justify-start">
                        <v-pagination
                            v-model="pagination.current"
                            density="compact"
                            :total-visible="5"
                            :length="10"
                        ></v-pagination>
                    </div>
                </v-col>
                <v-col cols="12" md="6">
                    <div class="d-flex align-center justify-end">
                        <span class="mr-3">Items Per Page:</span>
                        <v-select
                            v-model="pagination.itemsPerPage"
                            hide-details
                            :items="[10, 25, 50, 75, 100]"
                            density="compact"
                            max-width="100"
                        ></v-select>
                    </div>
                </v-col>
            </v-row>
        </v-container>
    </AuthenticatedLayout>
</template>
