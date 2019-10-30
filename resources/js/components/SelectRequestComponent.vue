<template>
  <select @change="request($event)" class="custom-select">
      <option selected disabled>Seleccione una opción</option>
      <option value="year" :selected="currentValue == 'year'">Anual</option>
      <option value="month" :selected="currentValue == 'month'">Mensual</option>
      <option value="model" :selected="currentValue == 'model'">Por modelo</option>
  </select>
</template>

<script>
export default {
    data(){
        return {
            currentValue: new URLSearchParams(window.location.search).get('type')
        }
    },
    methods:{
        request(event){
            window.location = window.location.href.split("?")[0]+'?type='+event.target.value;
        }
    }
}  
</script>
