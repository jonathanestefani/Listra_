<template>
  <v-row class="pa-5">
    <v-col class="ma-0 pa-0" cols="12" md="3" lg="3" xl="3">
      <v-card flat class="mx-auto h-100">
        <v-img
          class="align-end text-white"
          height="250"
          :src="getImage()"
          cover
        >
          <v-card-title>
            <v-icon class="iconGps" icon="mdi-google-maps"></v-icon>
            {{ car?.city?.name }}
          </v-card-title>
        </v-img>

        <v-card-subtitle class="pt-3">
          <b>{{ car?.name }}</b>
        </v-card-subtitle>

        <v-card-text>
          <div>{{ car?.description }}</div>

          <div class="mt-5">
            <v-icon icon="mdi-calendar"></v-icon>
            {{ car?.year }}

            <v-icon icon="mdi-speedometer"></v-icon>
            {{ car?.mileage }} km

            <v-icon icon="mdi-car-shift-pattern"></v-icon>
            {{ car?.gearbox_type }}
          </div>

          <div class="d-flex d-flex-wrap mt-5 justify-space-between">
            <div class="priceTotal">R$ {{ car?.total.toLocaleString() }}</div>

            <v-icon
              icon="d-flex d-inline-flex justify-center d-md-none iconHeart mdi-heart-outline"
            ></v-icon>
          </div>
        </v-card-text>
      </v-card>
    </v-col>

    <v-col class="d-none d-md-inline ma-0 pa-0 pl-5" cols="12" md="9">
      <Detail :data="car" />
    </v-col>

    <v-col class="justify-center w-100 d-md-none ma-0 pa-0" cols="12">
      <Detail :data="car" />
    </v-col>
  </v-row>
</template>

<script lang="ts">
import Detail from "./Detail.vue";
import Vehicle from "./Vehicle";

export default {
  components: { Detail },
  props: { data: Object },
  data() {
    return {
      filter: {
        vehicle: 0,
      },
      car: new Vehicle(),
    };
  },
  mounted() {
    this.car = this.data || new Vehicle();
  },
  watch: {
    data: {
      handler() {
        this.car = this.data || new Vehicle();
      },
    },
  },
  methods: {
    getImage() {
      return "http://localhost:8000/api/file/" + this.car.photo;
    },
  },
};
</script>

<style scoped>
.iconGps {
  color: #7d28f7;
  font-size: 20px;
}
.iconHeart {
  color: #7d28f7;
}
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
  font-size: 26px;
  font-weight: bold;
}
</style>
