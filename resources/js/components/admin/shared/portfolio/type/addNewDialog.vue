<script setup lang="ts">
import slugify from '@/utils/slugify';
import { useForm } from '@inertiajs/vue3';
import { Ref, ref, watch } from 'vue';

const { type } = defineProps<{
    type?: {
        id: number;
        title: string;
        slug: string;
    };
}>();

const form = useForm({
    title: '',
    slug: '',
});

watch(
    () => form.title,
    (title: string) => {
        if (type?.slug) return;
        else {
            form.slug = slugify(title, {
                maxLength: 70,
            });
        }
    },
);

const rules = {
    title: [
        (v: string) => !!v || 'Portfolio Type Title is required',
        (v?: string) =>
            (v && v.length <= 100) ||
            'Portfolio Type Title must be 100 characters or less',
    ],
    slug: [
        (v: string) => !!v || 'Portfolio Type Slug is required',
        (v?: string) =>
            (v && v.length <= 70) ||
            'Portfolio Type Slug must be 70 characters or less',
    ],
};

const typeForm = ref();
const submit = async (dialog: Ref) => {
    const { valid } = await typeForm.value.validate();

    if (valid) {
        const method = type ? 'patch' : 'post';
        const routeName = type
            ? 'portfolio-type.update'
            : 'portfolio-type.store';
        const routeParams = type ? [type.id] : [];

        form.submit(method, route(routeName, routeParams), {
            onSuccess: () => {
                dialog.value = false;
                form.reset();
            },
        });
    }
};
</script>
<template>
    <v-dialog persistent max-width="500">
        <template v-slot:activator="{ props: activatorProps }">
            <v-btn v-bind="activatorProps" flat color="primary">Add New</v-btn>
        </template>

        <template v-slot:default="{ isActive }">
            <v-form ref="typeForm" @submit.prevent="submit(isActive)">
                <v-card title="Add New Portfolio Type">
                    <v-card-text class="pb-0">
                        <v-label>Portfolio Type Title</v-label>
                        <v-text-field
                            v-model="form.title"
                            placeholder="eg. web, branding"
                            :rules="rules.title"
                        ></v-text-field>
                        <v-label>Portfolio Type Slug</v-label>
                        <v-text-field
                            v-model="form.slug"
                            placeholder="eg. web, branding"
                            persistent-counter
                            :rules="rules.slug"
                            :counter="70"
                        ></v-text-field>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn @click="isActive.value = false">
                            Close Dialog
                        </v-btn>
                        <v-btn
                            color="primary"
                            class="px-10"
                            variant="flat"
                            type="submit"
                        >
                            Save
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-form>
        </template>
    </v-dialog>
</template>

<style></style>
