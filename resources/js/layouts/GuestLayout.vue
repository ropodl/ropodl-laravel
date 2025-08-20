<script setup lang="ts">
import { ref } from 'vue';

const current = ref('/');
</script>
<template>
    <v-app>
        <v-main>
            <slot />
        </v-main>
    </v-app>
</template>
