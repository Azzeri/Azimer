<template>
    <transition
        leave-active-class="transition ease-in duration-1000"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div
            v-if="message && visible"
            class="alert alert-success fixed bg-opacity-100 w-full md:w-auto md:top-10 right-0 rounded-none md:rounded-l-xl text-white"
            style="z-index: 999"
        >
            <div class="flex-1 space-x-2 items-center">
                <i class="fas fa-check"></i>
                <label>{{ message }}</label>
            </div>
        </div>
    </transition>
</template>

<script>
import { usePage } from "@inertiajs/inertia-vue3";
import { computed, watch, defineComponent, ref } from "vue";
export default defineComponent({
    setup() {
        const message = computed(() => usePage().props.value.flash.message);
        const visible = ref(false);
        const timeout = ref(null);
        watch(
            () => message.value,
            (_) => {
                visible.value = true;
                if (timeout.value) clearTimeout(timeout.value);
                timeout.value = setTimeout(() => (visible.value = false), 2000);
            },
            { deep: true }
        );
        return { message, visible, timeout };
    },
});
</script>
