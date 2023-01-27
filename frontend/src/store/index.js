import { createStore } from "vuex";

export const store = createStore({
    state() {
      return {
        numofRecipes: 0,
        numofDrinks: 0,
        myallRecipes: [],
        myallDrinks: [],
      }
    }
  });