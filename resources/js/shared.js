export const defaultResourcesActions = [
  {
    label: "view_any",
    icon: "fa-solid fa-eye",
  },
  {
    label: "view",
    icon: "fa-regular fa-eye",
  },
  {
    label: "create",
    icon: "fa-solid fa-plus",
  },
  {
    label: "update",
    icon: "fa-solid fa-pen-to-square",
  },
  {
    label: "delete",
    icon: "fa-solid fa-trash",
  },
];

export const superAdminOnlyResources = [
  "res_overall_users",
  "res_overall_fire_brigade_units",
  "res_overall_equipment_resources",
  "res_overall_equipment",
];

/**
 * Returns initials from given name and surname
 * @param {string} name
 * @param {string} surname
 * @author Mariusz Waloszczyk
 */
export const getUserInitials = (name, surname) => {
  return name.charAt(0).toUpperCase() + surname.charAt(0).toUpperCase();
};

/**
 * Returns string with first letter as uppercase
 * @param {string} text
 * @author Mariusz Waloszczyk
 */
export const capitalize = (text) => {
  return text.charAt(0).toUpperCase() + text.slice(1);
};

/**
 * Checks if any of user's roles has given resource and action
 * @param {array<string>} roles
 * @param {array<string>} navResources
 * @author Mariusz Waloszczyk
 */
export const autheniticatedUserHasResources = (roles, navResources) => {
  const ACTION_VIEW_ANY = "view_any";
  for (let element of roles.value) {
    for (let role of element) {
      for (let resource of role.resources) {
        for (let navResource of navResources) {
          if (
            resource.suffix === navResource &&
            resource.pivot.action === ACTION_VIEW_ANY
          ) {
            return true;
          }
        }
      }
    }
  }

  return false;
};

/**
 * Opens modal window by Id
 * @param {string} id
 * @author Mariusz Waloszczyk
 */
export const openModal = (id) => {
  document.getElementById(id).classList.add("modal-open");
};

/**
 * Closes modal window by Id
 * @param {string} id
 * @author Mariusz Waloszczyk
 */
export const closeModal = (id) => {
  document.getElementById(id).classList.remove("modal-open");
};

/**
 * Checks if role is superadmin
 * @param {string} suffix
 * @author Mariusz Waloszczyk
 */
export const isRoleSuperAdmin = (suffix) => {
  return suffix === "role_super_admin";
};
