<template>
  <v-card flat class="mx-auto h-100">
    <v-card-subtitle class="pt-3">
      <span class="d-none d-sm-none d-md-block titleCard"
        >Valores simulados para você</span
      >

      <v-row class="d-none d-md-flex">
        <v-col md="6">
          <span class="under">{{ "_".repeat(43) }}</span>
        </v-col>
      </v-row>
    </v-card-subtitle>
    <v-card-text class="pa-0">
      <v-container>
        <div class="text-center">
          <v-progress-circular
            v-if="loaderSimulate"
            :size="50"
            color="primary"
            indeterminate
          ></v-progress-circular>
        </div>
        <v-row>
          <v-col class="pl-5 lr-5" md="8" lg="6" xl="4">
            <v-row class="mt-0">
              <v-col md="12">
                <v-card class="w-100">
                  <v-card-text>
                    <strong>48X</strong>
                    <span class="installmentPriceObs mt-2">Sem juros</span>
                    <br />
                    <span class="installmentPrice">{{
                      getSimulateFormatted(simulate.forty_eight)
                    }}</span>
                  </v-card-text>
                </v-card>
              </v-col>
            </v-row>

            <v-row class="mt-0 justify-space-between">
              <v-col
                class="d-inline-flex justify-space-between flex-wrap"
                cols="12"
                md="6"
              >
                <v-card class="w-100">
                  <v-card-text>
                    <strong>12X</strong>
                    <br />
                    <span class="installmentPrice">{{
                      getSimulateFormatted(simulate.twelve)
                    }}</span>
                  </v-card-text>
                </v-card>
              </v-col>
              <v-col
                class="d-inline-flex justify-space-between flex-wrap"
                cols="12"
                md="6"
              >
                <v-card class="w-100">
                  <v-card-text>
                    <strong>6X</strong>
                    <br />
                    <span class="installmentPrice">{{
                      getSimulateFormatted(simulate.six)
                    }}</span>
                  </v-card-text>
                </v-card>
              </v-col>
            </v-row>
          </v-col>
        </v-row>
        <v-row>
          <v-col
            class="d-flex-wrap d-inline-flex"
            cols="12"
            md="8"
            align-content="start"
          >
            <div class="d-none d-md-flex ml-2 mb-5 text-white bgWhatsapp">
              <v-icon icon="mdi-whatsapp text-white"></v-icon>
              <span class="ml-2">Falar com consultor</span>
            </div>

            <div
              class="d-flex d-inline-flex justify-center d-md-none w-100 text-white bgWhatsapp"
            >
              <v-icon icon="mdi-whatsapp text-white"></v-icon>
              <span class="ml-2">Falar com consultor</span>
            </div>

            <strong class="ml-5 d-none d-sm-none mt-2 d-md-inline phone">{{
              car?.phone
            }}</strong>
          </v-col>
        </v-row>
      </v-container>
    </v-card-text>
  </v-card>
</template>

<script lang="ts">
import { store } from "@/store/Store";
import SimulateService from "@/app/Services/SimulateService";
import Vehicle from "./Vehicle";
import Simulate from "./Simulate";

export default {
  props: { data: Object },
  data() {
    return {
      filter: {
        vehicle: 0,
      },
      car: new Vehicle(),
      simulate: new Simulate(),
      loaderSimulate: false,
    };
  },
  mounted() {
    this.car = this.data || new Vehicle();

    this.fetchSimulate();
  },
  watch: {
    data: {
      handler() {
        this.car = this.data || new Vehicle();

        this.fetchSimulate();
      },
    },
  },
  methods: {
    getSimulateFormatted(value) {
      return this.$filters.toCurrency(value);
    },
    getTotalWithDiscount() {
      return (
        parseFloat(this.car.total) - parseFloat(store.state.home.entryValue)
      );
    },
    async fetchSimulate() {
      try {
        if (parseFloat(this.car.total) <= 0) {
          return;
        }

        this.loaderSimulate = true;

        const params = {
          total: this.getTotalWithDiscount(),
        };

        const data = await SimulateService.build().search(params);

        this.simulate = data;

        this.loaderSimulate = false;
      } catch (error) {
        this.simulate = new Simulate();
        console.log(error);
      } finally {
        this.loaderSimulate = false;
      }
    },
  },
};
</script>

<style scoped>
.v-card .v-card-title {
  line-height: 2rem;
  background: white;
  margin: 9px 0;
  padding: 0 10px;
  border-top-right-radius: 36px;
  border-bottom-right-radius: 36px;
  width: fit-content;
  color: black;
  font-size: 16px !important;
}
.v-card .v-card-subtitle {
  font-size: 22px !important;
  color: #222;
}
.priceTotal {
  font-size: 22px;
  font-weight: bold;
}
.installmentPriceObs {
  position: absolute;
  right: 0;
  background-color: #7d28f7;
  color: white;
  padding: 2px 10px;
  border-top-left-radius: 10px;
  border-bottom-left-radius: 10px;
}
.installmentPrice {
  font-size: 1.1rem;
  font-weight: 800;
  color: #7d28f7;
}
.bgWhatsapp {
  padding: 10px 30px !important;
  border-radius: 20px !important;
}
.phone {
  color: #777;
}
</style>
