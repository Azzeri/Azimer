import { capitalize } from "../shared";

export const translations = {
  methods: {
    __(key, capitalized = true, replacements = {}) {
      let translation = window._translations[key] || key;

      Object.keys(replacements).forEach(r => {
        translation = translation.replace(`:${r}`, replacements[r]);
      });

      return capitalized ? capitalize(translation) : translation;
    },
  },
};