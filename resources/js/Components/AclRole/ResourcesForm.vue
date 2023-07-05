<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { watchEffect, inject } from "vue";
import {
  defaultResourcesActions,
  superAdminOnlyResources,
  isRoleSuperAdmin,
} from "@/shared";
import RoleSuffix from "@/Components/AclRole/RoleSuffix.vue";

const selectedRole = inject("selectedRole");
const aclData = inject("aclData");

const aclRoleUpdateForm = useForm({
  suffix: selectedRole.value.suffix,
  aclResources: selectedRole.value.resources,
});

const submitForm = () => {
  aclRoleUpdateForm.put(route("aclRoles.update", selectedRole.value.suffix));
};

/**
 *
 * @param {string} role
 * @param {string} resource
 * @return {boolean}
 */
const canResourceBeDisplayed = (role, resource) => {
  return (
    (isRoleSuperAdmin(role) &&
      superAdminOnlyResources.includes(resource.suffix)) ||
    (!isRoleSuperAdmin(role) &&
      !superAdminOnlyResources.includes(resource.suffix))
  );
};

/**
 * @param {string} resource
 * @param {string} action
 */
const isResourceWithActionPresentInRole = (resource, action) => {
  return aclRoleUpdateForm.aclResources.find(
    (el) => el.suffix === resource && el.action === action
  );
};

/**
 *
 * @param {string} resource
 * @param {string} action
 */
const updateFormResources = (resource, action) => {
  const element = aclRoleUpdateForm.aclResources.find(
    (el) => el.suffix === resource && el.action === action
  );

  if (!element) {
    aclRoleUpdateForm.aclResources.push({
      suffix: resource,
      action: action,
    });
  } else {
    aclRoleUpdateForm.aclResources.splice(
      aclRoleUpdateForm.aclResources.indexOf(element),
      1
    );
  }
};

watchEffect(async () => {
  aclRoleUpdateForm.suffix = selectedRole.value.suffix;
  aclRoleUpdateForm.aclResources = selectedRole.value.resources;
  aclRoleUpdateForm.isDirty = false;
  // document.querySelectorAll('input[type=checkbox]').forEach(el => el.checked = false);
  // UPDATE WARTOSCI W SELECTCIE
});
</script>
<template>
  <form class="w-10/12" @submit.prevent="submitForm()">
    <RoleSuffix :form="aclRoleUpdateForm" />

    <div class="flex justify-between flex-col mt-4 gap-4">
      <div class="card card-compact bg-base-100 shadow-md rounded w-full">
        <div class="card-body">
          <h2 class="card-title">{{ __("resources") }}</h2>
          <ul class="w-full space-y-3">
            <template
              v-for="resource in aclData.aclResources.data"
              :key="resource"
            >
              <li v-if="canResourceBeDisplayed(selectedRole.suffix, resource)">
                <div class="flex flex-col">
                  <span>{{ `${__(resource.suffix)}` }}</span>
                  <div class="flex justify-between">
                    <template
                      v-for="action in defaultResourcesActions"
                      :key="action"
                    >
                      <label
                        class="label p-0 pt-1 justify-start space-x-1 cursor-pointer"
                      >
                        <input
                          :disabled="
                            aclRoleUpdateForm.processing ||
                            isRoleSuperAdmin(selectedRole.suffix)
                          "
                          type="checkbox"
                          class="checkbox checkbox-secondary"
                          :checked="
                            isResourceWithActionPresentInRole(
                              resource.suffix,
                              action.label
                            )
                          "
                          @change="
                            updateFormResources(resource.suffix, action.label)
                          "
                        />
                        <i :class="action.icon"></i>
                      </label>
                    </template>
                  </div>
                </div>
              </li>
            </template>
          </ul>
        </div>
      </div>
    </div>
  </form>
</template>
