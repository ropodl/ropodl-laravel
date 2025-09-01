<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Icon } from '@iconify/vue';
import { Head, useForm } from '@inertiajs/vue3';
import { portfolio as port } from './portfolio';

const { portfolio } = defineProps<{
    portfolio?: port;
}>();

const form = useForm({
    title: portfolio?.title,
    slug: portfolio?.slug,
    content: portfolio?.content,
    status: portfolio?.status,
});

const submit = () => {
    form.post(route('portfolio.store'), {
        onFinish: () => {
            // form.reset();
            alert('Finish');
        },
    });
};
</script>

<template>
    <Head>
        <title>{{ portfolio ? 'Edit' : 'Create' }} Portfolio</title>
    </Head>
    <AuthenticatedLayout :title="`${portfolio ? 'Edit' : 'Create'} Portfolio`">
        <form @submit.prevent="submit">
            <v-container>
                <v-row>
                    <v-col cols="12" md="8">
                        <div class="d-flex align-center mb-3">
                            <v-btn border icon size="small" class="me-3">
                                <v-icon>
                                    <Icon icon="carbon:arrow-left" />
                                </v-icon>
                            </v-btn>
                            <div>
                                <v-breadcrumbs
                                    :items="['a', 'b', 'c']"
                                ></v-breadcrumbs>
                                <!-- {{ portfolio ? 'Edit' : 'Create' }} Portfolio -->
                            </div>
                        </div>
                        <v-label>This is title</v-label>
                        <v-text-field
                            v-model="form.title"
                            placeholder="eg. Lorem ipsum dolor"
                        ></v-text-field>
                        <v-card>
                            <v-card-text>
                                <v-row>
                                    <v-col cols="12" class="pb-0">
                                        <v-text-field
                                            placeholder="Blog Title"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" md="12" class="py-0">
                                        <v-text-field
                                            placeholder="Blog Title"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" md="6" class="py-0">
                                        <v-text-field
                                            placeholder="Blog Title"
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-col cols="12" md="4">
                        <v-card>
                            <v-card-title>Title</v-card-title>
                        </v-card>
                        <v-btn type="submit">Submit</v-btn>
                    </v-col>
                </v-row>
            </v-container>
        </form>
    </AuthenticatedLayout>
</template>
