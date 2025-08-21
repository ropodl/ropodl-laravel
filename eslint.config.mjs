import ts from '@typescript-eslint/eslint-plugin';
import pluginVue from 'eslint-plugin-vue';
import globals from 'globals';

export default [
    // 1. Generic Vue rules (flat/recommended)
    ...pluginVue.configs['flat/recommended'],

    // 2. Project-specific settings
    {
        ignores: ['**/node_modules/**', '**/dist/**', '**/vendor/**'],

        files: ['resources/js/**/*.{js,ts,vue}'],

        languageOptions: {
            parser: '@typescript-eslint/parser',
            parserOptions: {
                ecmaVersion: 'latest',
                sourceType: 'module',
                ecmaFeatures: {
                    jsx: true,
                },
            },
            globals: { ...globals.browser },
        },

        plugins: {
            vue: pluginVue,
            '@typescript-eslint': ts,
        },

        rules: {
            'vue/multi-word-component-names': 'off', // common for small components
            'no-undef': 'off',
            // add more project-specific rules here
        },
    },
];
