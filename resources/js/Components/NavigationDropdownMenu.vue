<script setup>
import { navigation } from "../navigation";
import { Link } from "@inertiajs/inertia-vue3";
import { autheniticatedUserHasResources, capitalize } from "../shared";
import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

defineProps(["listClass", "tabindex"]);

const ACTION_VIEW_ANY = 'view_any';

const authenticatedUserRoles = computed(
    () => usePage().props.value.authenticatedUserRoles
);

const authenticatedUserIsPermitted = (resources) => {
    return autheniticatedUserHasResources(
        authenticatedUserRoles,
        resources,
        ACTION_VIEW_ANY
    );
};
</script>
<template>
    <ul :class="listClass" style="z-index: 999">
        <template v-for="nav in navigation" :key="nav">
            <template v-if="authenticatedUserIsPermitted(nav.resources)">
                <li v-if="!nav.subNavigation">
                    <Link :href="route(nav.link)">
                        <i :class="nav.icon"></i>
                        {{ capitalize(__(nav.label)) }}
                    </Link>
                </li>
                <li v-else :tabindex="nav.tabindex">
                    <a>
                        <i :class="nav.icon"></i>
                        {{ capitalize(__(nav.label)) }}
                    </a>
                    <ul class="p-2 text-base-content bg-base-100 shadow">
                        <template v-for="sub in nav.subNavigation" :key="sub">
                            <li v-if="authenticatedUserIsPermitted(sub.resources)">
                                <Link :href="route(sub.link)">
                                    <i :class="sub.icon"></i>
                                    {{ capitalize(__(sub.label)) }}
                                </Link>
                            </li>
                        </template>
                    </ul>
                </li>
            </template>
        </template>
    </ul>
</template>
