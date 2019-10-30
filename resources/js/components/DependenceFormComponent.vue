<template>
  <form action autocomplete="off">
    <div class="form-group">
      <label for="dependence">Dependencia</label>

      <div class>
        <input
          type="text"
          name="dependence"
          placeholder="Ingrese el codigo o nombre de la dependencia"
          v-model="query"
          v-on:keyup="autoComplete"
          class="form-control"
        />
        <div class="panel-footer" v-if="results.length">
          <ul class="list-group">
            <li
              class="list-group-item"
              v-for="result in results"
              v-on:click="setResult(result)"
            >{{ result.code+' - '+result.name }}</li>
          </ul>
        </div>
      </div>
    </div>
  </form>
</template>

<script>
export default {
    data(){
        return {
            query: '',
            results: [],
            dependence: null
        }
    },
    methods:{
            autoComplete(){
              this.dependence = null;
              if(this.query.length>0){
                axios.get('/api/dependences', {params: { code: this.query }})
                    .then(
                    results => {
                        this.results = results.data.data;
                    }
                    ).catch(
                    error =>{
                        console.log(error);
                    }
                    );
              }else{
                this.results = [];
              }
            },
            setResult(result){
                this.query = result.code + '-' +result.name;
                this.dependence = result;
                this.results = [];
                this.$emit('addDependence', this.dependence);
            }
    }
};
</script>
