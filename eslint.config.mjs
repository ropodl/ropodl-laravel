import skipFormatting from '@vue/eslint-config-prettier/skip-formatting';
import {
    defineConfigWithVueTs,
    vueTsConfigs,
} from '@vue/eslint-config-typescript';
import pluginOxlint from 'eslint-plugin-oxlint';
import pluginVue from 'eslint-plugin-vue';
import { globalIgnores } from 'eslint/config';

export default defineConfigWithVueTs(
    {
        name: 'app/files-to-lint',
        files: ['**/*.{ts,mts,tsx,vue}'],
        rules: {
            'vue/multi-word-component-names': 'off',
        },
    },

    globalIgnores([
        '**/dist/**',
        '**/bootstrap/**',
        '**/vendor/**',
        '**/public/**',
        '**/dist-ssr/**',
        '**/coverage/**',
    ]),

    pluginVue.configs['flat/essential'],
    vueTsConfigs.recommended,
    ...pluginOxlint.configs['flat/recommended'],
    skipFormatting,
);
