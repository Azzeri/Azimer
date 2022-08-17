<script setup>
import { navigation } from "../navigation";
import { Link } from "@inertiajs/inertia-vue3";
import { hasUserResourceWithAction } from "../shared";
import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

defineProps(["listClass", "tabindex"]);

const authenticatedUserRoles = computed(
    () => usePage().props.value.authenticatedUserRoles
);

const isAllowed = (resources) => {
    return hasUserResourceWithAction(
        authenticatedUserRoles,
        resources,
        "viewAny"
    );
};
</script>
<template>
    <ul :class="listClass" style="z-index: 999">
        <template v-for="nav in navigation" :key="nav">
            <template v-if="isAllowed(nav.resources)">
                <li v-if="!nav.subNavigation">
                    <Link :href="route(nav.link)">
                        <i :class="nav.icon"></i>
                        {{ nav.label }}
                    </Link>
                </li>
                <li v-else :tabindex="nav.tabindex">
                    <a>
                        <i :class="nav.icon"></i>
                        {{ nav.label }}
                    </a>
                    <ul class="p-2 text-base-content bg-base-100 shadow">
                        <template v-for="sub in nav.subNavigation" :key="sub">
                            <li v-if="isAllowed(sub.resources)">
                                <Link :href="route(sub.link)">
                                    <i :class="sub.icon"></i>
                                    {{ sub.label }}
                                </Link>
                            </li>
                        </template>
                    </ul>
                </li>
            </template>
        </template>
    </ul>
</template>
