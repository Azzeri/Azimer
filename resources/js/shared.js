const getUserInitials = (name, surname) => {
    return name.charAt(0).toUpperCase() + surname.charAt(0).toUpperCase();
};

export { getUserInitials };
