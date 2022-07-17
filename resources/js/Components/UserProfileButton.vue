<script setup>
  import { Inertia } from '@inertiajs/inertia';
  import { Link } from '@inertiajs/inertia-vue3';
  import { getUserInitials } from '@/shared.js'

  const logout = () => {
    Inertia.post('logout');
  }

</script>
<template>
  <div class="dropdown dropdown-end">
    <label tabindex="0" class="btn btn-circle">
      <div class="avatar placeholder">
          <div class="
            w-10 
            rounded-full 
            ring
            ring-base-100 
            bg-primary"
          >
            <span>
              {{ 
                getUserInitials(
                  $page.props.user.name,
                  '$page.props.user.surname'
                ) 
              }}
            </span>
          </div>
        </div>
    </label>
    <ul tabindex="0" class="dropdown-content menu p-2 shadow text-base-content bg-base-100 rounded-box w-52">
      <li>
        <Link :href="route('profile.show')">
          <i class="fa-solid fa-house"></i>
          Profil
        </Link>
      </li>
      <li @click="logout">
        <a>
          <i class="fa-solid fa-right-from-bracket"></i>
          Wyloguj
        </a>
      </li>
    </ul>
  </div>
</template>