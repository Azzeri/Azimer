<script setup>
import { closeModal } from "@/shared";
defineProps({
    id: String,
    header: String,
});
</script>
<template>
    <div :id="id" class="modal">
        <div class="modal-box">
            <button
                @click="closeModal(id)"
                class="btn btn-sm btn-circle absolute right-2 top-2"
            >
                ✕
            </button>
            <h3 v-if="header" class="font-bold text-lg">{{ header }}</h3>
            <div>
                <slot name="content" />
            </div>
        </div>
    </div>
</template>
