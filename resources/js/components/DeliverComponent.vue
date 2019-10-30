<template>
  <div>
    <h3 class="text-center">Entrega de equipamiento</h3>
    <div class="row">
      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <product-form-component @addToProducts = "addToProducts"></product-form-component>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <dependence-form-component @addDependence = "setDependence"></dependence-form-component>
          </div>
        </div>
      </div>
      <div class="card col-md-9">
        <table-component :products="products" @deleteFromProducts="removeFromProducts"></table-component>
      </div>
    </div>
    <br />
    <div class="text-center">
      <button class="btn btn-lg btn-danger" :disabled="!(products&&dependence)" v-on:click="deliver()">Recibo</button>
    </div>
  </div>
  
</template>

<script>
export default {
    data(){
        return {
            products: [],
            dependence: undefined
        }
    },
    methods:{
        deliver(){
          var self = this;
            axios.post('/api/transactions/deliver', {
              
              products: this.products,
              dependence: { 
                id:this.dependence.id, 
                code: this.dependence.code, 
                name: this.dependence.name
              }
            })
            .then(function (response) {
              self.crearReciboEntrega(response);
              window.location = response.data.redirect;
            })
            .catch(function (error) {
              console.log(JSON.stringify(error));
            });
        },
        addToProducts(product){
          var index = this.products.findIndex(x => JSON.stringify(x) === JSON.stringify(product));
          if(index === -1){
            this.products.push(product);
          }
        },
        removeFromProducts(product){
            this.products.splice(this.products.indexOf(product),1);
        },
        setDependence(dependence){
          this.dependence = dependence;
        },
        showError(error){
            this.$swal({
              type: 'error',
              title: 'Algo salió mal',
              text: error,
              confirmButtonText: 'Ok'
            });
        }
    }
};
</script>
