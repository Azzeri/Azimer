<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

defineProps({
		aclRoles: Object,
    aclResourcesDropdown: Object,
});

</script>

<template>
	<AppLayout title="Roles">
		{{ aclRoles  }}
		<hr />
		{{ aclResourcesDropdown }}
	</AppLayout>
</template>
