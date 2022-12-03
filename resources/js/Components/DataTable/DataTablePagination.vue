<template>
    <div v-if="meta.links.length > 3" class="btn-group">
        <template v-for="(link, p) in meta.links" :key="p">
            <div
                v-if="link.url === null"
                class="btn sm:btn-sm btn-disabled"
                v-html="link.label"
            />
            <Link
                v-else
                class="btn sm:btn-sm"
                :class="{ 'btn-active': link.active }"
                :href="link.url"
                v-html="link.label"
            />
        </template>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    meta: Object,
});
</script>
