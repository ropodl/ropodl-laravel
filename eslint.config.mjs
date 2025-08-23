import skipFormatting from '@vue/eslint-config-prettier/skip-formatting';
import {
    defineConfigWithVueTs,
    vueTsConfigs,
} from '@vue/eslint-config-typescript';
import pluginOxlint from 'eslint-plugin-oxlint';
import pluginVue from 'eslint-plugin-vue';
import { globalIgnores } from 'eslint/config';

// To allow more languages other than `ts` in `.vue` files, uncomment the following lines:
// import { configureVueProject } from '@vue/eslint-config-typescript'
// configureVueProject({ scriptLangs: ['ts', 'tsx'] })
// More info at https://github.com/vuejs/eslint-config-typescript/#advanced-setup

export default defineConfigWithVueTs(
    {
        name: 'app/files-to-lint',
        files: ['**/*.{ts,mts,tsx,vue}'],
    },

    globalIgnores(['**/dist/**', '**/dist-ssr/**', '**/coverage/**']),

    pluginVue.configs['flat/essential'],
    vueTsConfigs.recommended,
    ...pluginOxlint.configs['flat/recommended'],
    skipFormatting,
);

// import ts from '@typescript-eslint/eslint-plugin';
// import tsParser from '@typescript-eslint/parser';
// import pluginVue from 'eslint-plugin-vue';
// import globals from 'globals';

// export default [
//     // 1. Generic Vue rules (flat/recommended)
//     ...pluginVue.configs['flat/recommended'],

//     // 2. Project-specific settings
//     {
//         ignores: ['**/node_modules/**', '**/dist/**', '**/vendor/**'],

//         files: ['resources/js/**/*.{js,ts,vue}'],

//         languageOptions: {
//             parser: tsParser, // ✅ actual parser object, not a string
//             parserOptions: {
//                 ecmaVersion: 'latest',
//                 sourceType: 'module',
//                 ecmaFeatures: {
//                     jsx: true,
//                 },
//             },
//             globals: { ...globals.browser },
//         },

//         plugins: {
//             vue: pluginVue,
//             '@typescript-eslint': ts,
//         },

//         rules: {
//             'vue/multi-word-component-names': 'off',
//             'no-undef': 'off',
//         },
//     },
// ];
