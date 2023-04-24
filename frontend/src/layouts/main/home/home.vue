<template>
  <div>
    <v-container ma-0 pa-0 fill-height>
      <v-row class="mt-5">
        <v-col cols="12">
          <span class="titleCard colorGrey">Simulação de Financiamento</span>

          <v-row class="d-none d-md-flex">
            <v-col md="6">
              <span class="under">________________________________</span>
            </v-col>
          </v-row>
        </v-col>
      </v-row>

      <Filters @executeFilter="executeFilter" />

      <List v-if="showList" :data="car" />
    </v-container>
  </div>
</template>

<script lang="ts">
import { store } from "@/store/Store";
import Filters from "./components/Filters.vue";
import List from "./components/List.vue";

export interface Vehicle {
  id: Number;
  name: String;
  description: String;
  year: number;
  km: String;
  gearbox: String;
  price: number;
}

export default {
  components: {
    Filters,
    List,
  },
  mounted() {
    store.commit("home_addCar", {});
  },
  data() {
    return {
      filter: {
        vehicle: "",
      },
      showList: false,
      items: [],
      car: {},
    };
  },
  methods: {
    executeFilter() {
      this.showList = false;

      this.car = store.getters.getCar;

      this.showList = true;
    },
  },
};
</script>

<style>
.under {
  background-color: #7d28f7;
  height: 2px;
  font-size: 2px;
}
.titleCard {
  font-size: 24px;
  font-weight: bold;
}
.colorGrey {
  color: #4a4b4b;
}
</style>
