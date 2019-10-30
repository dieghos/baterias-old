<template>
  <form action v-on:submit.prevent="addProduct" autocomplete="off">
    <div class="form-group">
      <label for="product">Producto</label>

      <div class="">
        <input type="text"
          name="product"
          placeholder="Ingrese el producto"
          v-model="query"
          v-on:keyup="autoComplete"
          class="form-control"
        />
        <div class="panel-footer" v-if="results.length">
          <ul class="list-group">
            <li class="list-group-item" v-for="result in results" v-on:click="setResult(result)">{{ result.name+' - '+result.description }}</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="text-center">
      <button :disabled="!product" class="btn btn-success">Agregar</button>
    </div>
  </form>
</template>

<script>
export default {
  data(){
    return {
      query: '',
      results: [],
      product: null
    }
  },
  methods:{
    addProduct(){
      this.$emit('addToProducts', this.product);
      this.query = '';
      this.product = null;
    },
    autoComplete(){
      this.product = null;
      axios.get('/api/products', {params: { productName: this.query }})
        .then(
          results => {
            this.results = results.data.data;
          }
        ).catch(
          error =>{
            console.log(error);
          }
        );
    },
    setResult(result){
      this.query = result.name + '-' +result.description;
      this.product = result;
      this.results = [];
    }
  }
};
</script>
