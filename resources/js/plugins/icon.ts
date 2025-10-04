// import carbonIcons from '@iconify-json/carbon/icons.json';
import { Icon as IconifyIcon } from '@iconify/vue';
import { h } from 'vue';
import type { IconProps, IconSet } from 'vuetify';

const iconify: IconSet = {
    component: (props: IconProps) => {
        return h(IconifyIcon, {
            icon: props.icon as string,
            tag: props.tag,
        });
    },
};

// addCollection(carbonIcons);

export { iconify };
