<template>
  <div>
    <b-form-group>
      <b-form-checkbox-group
        id="checkbox-convenients"
        v-model="arr_convenients_id"
        :options="options"
      ></b-form-checkbox-group>
    </b-form-group>
    <div>
      Selected:
      <strong>{{ arr_convenients_id }}</strong>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    convenients: {
      type: Array
    },
    convenientsRoom: {
      type: Array
    }
  },
  data() {
    return {
      arr_convenients_id: [], // Must be an array reference!
      options: []
    };
  },
  methods: {
    arrOptionConvenient(convenients) {
      var arrOptionCustom = convenients.map(
        (convenient, index, convenients) => {
          return { text: convenient.name, value: convenient.id };
        }
      );
      this.options = arrOptionCustom;
    }
  },
  watch: {
    arr_convenients_id: {
      handler: function() {
        this.$emit("arr-convenients-id", this.arr_convenients_id);
        console.log("emit");
      }
    },
    convenients: {
      handler: function() {
        this.arrOptionConvenient(this.convenients);
        if (this.convenientsRoom) {
          this.arr_convenients_id = this.convenientsRoom;
        }
        console.log("reload bind data convenients");
      }
    }
  }
};
</script>
<style lang="css">
#checkbox-convenients > .custom-checkbox {
  margin-top: 6px;
  margin-left: 0px;
  min-width: 30%;
}
</style>
