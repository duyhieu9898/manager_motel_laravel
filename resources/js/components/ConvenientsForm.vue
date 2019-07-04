<template>
  <div>
    <b-form-group >
        <b-form-checkbox-group
            id="checkbox-convenients"
            v-model="convenients_edit"
            :options="options"

        ></b-form-checkbox-group>
    </b-form-group>

    <div>Selected: <strong>{{ convenients_edit }}</strong></div>
  </div>
</template>

<script>
    export default {
        props: {
            convenients: {
                type: Array
            },
            convenients_room: {
                type: Array
            },
        },
        data() {
            return {
                convenients_edit: [], // Must be an array reference!
                options: [],
            }
        },
        created(){
            this.arrOptionConvenient(this.convenients);
            this.convenients_edit=this.convenients_room;
        },
        methods:{
            arrOptionConvenient(convenients){
                var arrOptionCustom=convenients.map((convenient, index, convenients) => {
                    return {text:convenient.name,value:convenient.id};
                });
                this.options=arrOptionCustom;
            }
        },
        watch: {
            convenients_edit(){
               this.$emit('convenients_edit', this.convenients_edit);
            }
        },
    }
</script>
<style lang="css">
    #checkbox-convenients > .custom-checkbox{
       margin-top:6px;
       margin-left:0px;
       min-width: 30%;
    }
</style>
