/**
 * Returns initials from given name and surname
 * @param {string} name
 * @param {string} surname
 * @author Mariusz Waloszczyk
 */
const getUserInitials = (name, surname) => {
    return name.charAt(0).toUpperCase() + surname.charAt(0).toUpperCase();
};

/**
 * Checks if any of user's roles has given resource and action
 * @param {array<string>} roles
 * @param {array<string>} navResources
 * @author Mariusz Waloszczyk
 */
const hasUserResourceWithAction = (roles, navResources) => {
    for (let element of roles.value) {
        for (let role of element) {
            for (let resource of role.resources) {
                if (!navResources.length) {
                    return true;
                } else {
                    for (let navResource of navResources) {
                        if (
                            resource.suffix === navResource &&
                            JSON.parse(resource.pivot.actions).includes(
                                "viewAny"
                            )
                        ) {
                            return true;
                        }
                    }
                }
            }
        }
    }

    return false;
};

export { getUserInitials, hasUserResourceWithAction, openModal, closeModal };
