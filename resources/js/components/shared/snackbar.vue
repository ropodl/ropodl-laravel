<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import { snackbar } from '@/composables/snack';

const { show, text, color } = snackbar();
</script>
<template>
  <v-snackbar v-model="show" :color :text />
</template>
