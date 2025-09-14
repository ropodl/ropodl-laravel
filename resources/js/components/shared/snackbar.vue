<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
defineProps<{
    props?: object;
}>();
</script>
<template>
    <v-snackbar v-bind="props" />
</template>

<style></style>
