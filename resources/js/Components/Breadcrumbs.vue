<script setup>
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    links: Array,
    lastLabel: String,
});
</script>
<template>
    <div class="text-sm breadcrumbs mt-4">
        <ul>
            <li v-for="link in links">
                <Link :href="route(link.url)">{{ __(link.label) }}</Link>
            </li>
            <li>{{ lastLabel }}</li>
        </ul>
    </div>
</template>
