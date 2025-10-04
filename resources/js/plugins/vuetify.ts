import { createVuetify } from 'vuetify';
import 'vuetify/styles';
import { iconify } from './icon';

const vuetify = createVuetify({
    ssr: true,
    defaults: {
        VBtn: {
            class: 'text-none',
            rounded: 'lg',
            variant: 'flat',
        },
        VCard: {
            border: true,
            flat: true,
            rounded: 'lg',
        },
        VAutocomplete: {
            rounded: 'lg',
            density: 'comfortable',
            variant: 'outlined',
        },
        VTextField: {
            rounded: 'lg',
            density: 'compact',
            variant: 'outlined',
        },
        VTextarea: {
            rounded: 'lg',
            variant: 'outlined',
        },
        VDataTableServer: {
            hover: true,
            rounded: 'lg',
            class: 'bg-transparent',
            density: 'comfortable',
        },
        VSelect: {
            rounded: 'lg',
            density: 'comfortable',
            variant: 'outlined',
        },
        VTooltip: {
            rounded: 'lg',
            theme: 'light',
        },
        VLabel: {
            class: 'pt-0 pl-0 font-weight-medium pb-2',
        },
    },
    theme: {
        defaultTheme: 'dark',
        variations: {
            colors: [
                'primary',
                'secondary',
                'error',
                'info',
                'success',
                'warning',
            ],
            lighten: 5,
            darken: 5,
        },
        themes: {
            dark: {
                dark: true,
                colors: {
                    primary: '#FFFFFF',
                },
            },
            light: {
                dark: false,
                colors: {
                    primary: '#FFFFFF',
                },
            },
        },
    },
    icons: {
        defaultSet: 'iconify',
        aliases: {
            collapse: 'carbon:chevron-up',
            complete: 'carbon:checkmark-filled',
            cancel: 'carbon:close-filled',
            close: 'carbon:close',
            delete: 'carbon:trash-can',
            clear: 'carbon:close',
            success: 'carbon:checkmark-filled',
            info: 'carbon:information-filled',
            warning: 'carbon:warning-filled',
            error: 'carbon:error-filled',
            prev: 'carbon:chevron-left',
            next: 'carbon:chevron-right',
            checkboxOn: 'carbon:checkbox-checked',
            checkboxOff: 'carbon:checkbox',
            checkboxIndeterminate: 'carbon:subtract',
            delimiter: 'carbon:circle-filled',
            sortAsc: 'carbon:caret-up',
            sortDesc: 'carbon:caret-down',
            expand: 'carbon:chevron-down',
            menu: 'carbon:menu',
            subgroup: 'carbon:chevron-right',
            dropdown: 'carbon:chevron-down',
            radioOn: 'carbon:radio-button',
            radioOff: 'carbon:radio-button-unchecked',
            edit: 'carbon:pen',
            ratingEmpty: 'carbon:star',
            ratingFull: 'carbon:star-filled',
            ratingHalf: 'carbon:star-half',
            loading: 'carbon:loop',
            first: 'carbon:page-first',
            last: 'carbon:page-last',
            unfold: 'carbon:unfold-more',
            file: 'carbon:document',
            plus: 'carbon:add',
            minus: 'carbon:subtract',
            calendar: 'carbon:calendar',
            treeviewCollapse: 'carbon:chevron-down',
            treeviewExpand: 'carbon:chevron-right',
            eyeDropper: 'carbon:color-palette',
            upload: 'carbon:cloud-upload',
            color: 'carbon:color-palette',
            command: 'carbon:mac-command',
            ctrl: 'carbon:mac-control',
            space: 'carbon:space',
            shift: 'carbon:shift',
            alt: 'carbon:mac-option',
            enter: 'carbon:enter',
            arrowup: 'carbon:arrow-up',
            arrowdown: 'carbon:arrow-down',
            arrowleft: 'carbon:arrow-left',
            arrowright: 'carbon:arrow-right',
            backspace: 'carbon:backspace',
        },
        sets: {
            iconify: iconify,
        },
    },
});

export default vuetify;
