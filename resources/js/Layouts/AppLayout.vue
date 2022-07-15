<script setup lang="ts">
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import {
    UserOutlined,
    VideoCameraOutlined,
    UploadOutlined,
} from "@ant-design/icons-vue";

defineProps({
    title: String,
});

const selectedKeys = ref<string[]>(["4"]);

const footerText = "Mariusz Waloszczyk";

const logout = () => {
    Inertia.post(route("logout"));
};
</script>

<template>
    <Head :title="title" />
    <a-layout :style="{ minHeight: '100vh' }">
        <a-layout>
            <a-layout-content>
                <a-page-header
                    style="border: 1px solid rgb(235, 237, 240)"
                    :title="title"
                    :avatar="{
                        src: 'https://avatars1.githubusercontent.com/u/8186664?s=460&v=4',
                    }"
                />
                <slot />
            </a-layout-content>
            <a-layout-footer
                :style="{ textAlign: 'center', backgroundColor: '' }"
            >
                {{ footerText }}
            </a-layout-footer>
        </a-layout>
        <a-layout-sider breakpoint="lg" collapsed-width="0" reverseArrow>
            <div class="flex flex-col h-full justify-between">
                <div>
                    <div class="logo" />
                    <a-menu
                        v-model:selectedKeys="selectedKeys"
                        theme="dark"
                        mode="inline"
                    >
                        <a-menu-item key="1">
                            <user-outlined />
                            <span class="nav-text">nav 1</span>
                        </a-menu-item>
                        <a-menu-item key="2">
                            <video-camera-outlined />
                            <span class="nav-text">nav 2</span>
                        </a-menu-item>
                        <a-menu-item key="3">
                            <upload-outlined />
                            <span class="nav-text">nav 3</span>
                        </a-menu-item>
                        <a-menu-item key="4">
                            <user-outlined />
                            <span class="nav-text">nav 4</span>
                        </a-menu-item>
                    </a-menu>
                </div>
                <div class="pl-2 pb-2">
                    <Link :href="route('profile.show')">
                        <a-button type="primary" size="large" shape="circle">
                            <!-- <a-avatar src="https://joeschmoe.io/api/v1/random" />  -->
                            MW
                        </a-button>
                    </Link>
                    <a-button
                        @click="logout"
                        type="primary"
                        size="large"
                        shape="circle"
                    >
                        <!-- <a-avatar src="https://joeschmoe.io/api/v1/random" />  -->
                        Logout
                    </a-button>
                </div>
            </div>
        </a-layout-sider>
    </a-layout>
</template>
<style>
.logo {
    height: 32px;
    background: rgba(255, 255, 255, 0.2);
    margin: 16px;
}
</style>
