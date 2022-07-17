<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import Navbar from '../Components/Navbar.vue';

defineProps({
    title: String,
});

</script>

<template>
    <Head :title="title" />
    <Navbar />
    <div 
        class="
            container 
            mx-auto 
            bg-base-100 
            text-base-content
        "
    >{{$page.props.user}}
        <slot/>
    </div>
</template>
