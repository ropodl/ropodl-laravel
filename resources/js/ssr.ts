import { createInertiaApp } from '@inertiajs/vue3';
import createServer from '@inertiajs/vue3/server';
import { renderToString } from '@vue/server-renderer';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createPinia } from 'pinia';
import { createSSRApp, DefineComponent, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import vuetify from './plugins/vuetify';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const pinia = createPinia();

createServer(
    (page) =>
        createInertiaApp({
            page,
            render: renderToString,
            title: (title) => `${title} - Saroj Poudel`,
            resolve: (name) =>
                resolvePageComponent(
                    `./pages/${name}.vue`,
                    import.meta.glob<DefineComponent>('./pages/**/*.vue'),
                ),
            setup({ App, props, plugin }) {
                return createSSRApp({ render: () => h(App, props) })
                    .use(plugin)
                    .use(ZiggyVue, {
                        ...page.props.ziggy,
                        location: new URL(page.props.ziggy.location),
                    })
                    .use(vuetify)
                    .use(pinia);
            },
        }),
    { cluster: true },
);
