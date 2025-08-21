import ts from '@typescript-eslint/eslint-plugin';
import vue from 'eslint-plugin-vue';

export default [
    {
        ignores: ['**/node_modules/**', '**/dist/**', '**/vendor/**'],
    },
    {
        files: ['resources/js/**/*.{js,ts,vue}'],
        languageOptions: {
            parserOptions: {
                ecmaVersion: 'latest',
            },
        },
        plugins: { vue, '@typescript-eslint': ts },
        rules: {
            'vue/multi-word-component-names': 'off',
            'no-undef': 'off',
        },
    },
];
