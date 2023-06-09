import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import { library } from "@fortawesome/fontawesome-svg-core";
import {
    faHatWizard,
    faBell,
    faInbox,
    faCircleXmark,
    faCirclePlus,
    faCheck,
    faBullseye,
} from "@fortawesome/free-solid-svg-icons";
import {
    faBell as farBell,
    faCalendarDays,
    faCircleUser,
    faTrashCan,
    faCircleRight,
} from "@fortawesome/free-regular-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

library.add(
    faHatWizard,
    faBell,
    farBell,
    faCalendarDays,
    faInbox,
    faCircleXmark,
    faCirclePlus,
    faCircleUser,
    faTrashCan,
    faCheck,
    faBullseye,
    faCircleRight
);

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .component("font-awesome-icon", FontAwesomeIcon)
            .component("VueDatePicker", VueDatePicker)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
