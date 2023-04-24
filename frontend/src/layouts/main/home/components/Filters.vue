<template>
  <v-row class="pa-5">
    <v-col class="bgFilter pa-5" sm="12" md="12">
      <card>
        <b class="titleFilter"
          >Selecione um veículo que deseja simular o financiamento</b
        >

        <v-row class="mt-1">
          <v-col class="d-flex flex-wrap" cols="12" md="4" lg="3" xl="2">
            <v-select
              v-model="filter.vehicle"
              :items="items"
              item-title="name"
              item-value="id"
              return-object
              density="compact"
              variant="solo"
            />
          </v-col>
          <v-col class="d-flex flex-wrap" cols="12" md="4">
            <v-btn
              color="#7d28f7"
              class="rounded-xl mt-1 pa-2 text-white"
              @click="entryValue()"
              ><span class="pl-8 pr-8 btnSimulation">Simular</span></v-btn
            >
          </v-col>
        </v-row>
      </card>
    </v-col>
  </v-row>
</template>

<script lang="ts">
import { store } from "@/store/Store";
import CarService from "@/app/Services/CarService";
import Swal from "sweetalert2";

export default {
  props: {
    data: Array,
  },
  data() {
    return {
      filter: {
        vehicle: { id: 0, name: "Selecione" },
      },
      showEntry: false,
      items: this.data || [],
    };
  },
  async mounted() {
    const data = (await this.fetch()) || [];
    this.addItems(data);
  },
  methods: {
    async fetch() {
      const params = {
        all: true,
      };

      return (await CarService.build().search(params)) || [];
    },
    async load() {
      return (
        (await CarService.build().read({ id: this.filter.vehicle.id })) || []
      );
    },
    addItems(data = []) {
      this.items = data || [];

      this.items.unshift({ id: 0, name: "Selecione" });
    },
    entryValue() {
      if (this.filter.vehicle.id == 0) {
        new Swal({ title: "Atenção", text: "Favor selecionar um veículo" });
        return;
      }

      new Swal({
        title: "Valor de entrada?",
        text:
          "Valor do veículo " +
          this.$filters.toCurrency(this.filter.vehicle.total),
        input: "number",
        inputPlaceholder: "Valor",
        showCloseButton: true,
      }).then((resp: any) => {
        if (resp.isConfirmed) {
          const value = parseInt(resp.value);

          if (this.filter.vehicle.total < value) {
            new Swal({
              title: "Atenção",
              text: "O valor da entrada não pode ser maior que o valor total do veículo!",
            }).then(() => {
              this.entryValue();
            });

            return;
          }

          store.commit("home_addCarEntryValue", value);

          this.executeFilter();
        }
      });
    },
    async executeFilter() {
      store.commit("home_addCarFilter", this.filter.vehicle);

      if (this.filter.vehicle.id != 0) {
        const data = await this.load();

        store.commit("home_addCar", data);

        this.$emit("executeFilter");
      }
    },
  },
};
</script>

<style>
.bgFilter {
  background: white;
}
.titleFilter {
  font-size: 14px;
  color: #616161;
}
.btnSimulation {
  font-size: 12px;
  font-weight: bold;
}
</style>
