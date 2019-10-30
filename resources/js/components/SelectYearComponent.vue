<template>
    <select class="custom-select" name="year">
        <option v-for="year in years" :selected="currentValue == year.year" :value="year.year">{{year.year}}</option>
    </select>
</template>

<script>
export default {
    data(){
        return {
            years:[],
            currentValue: new URLSearchParams(window.location.search).get('year')
        }
    },
    methods:{
        getYears(){
            axios.get('/api/orders/years').then(
                results =>{
                    this.years = results.data;
                }
            ).catch(
                error=>console.error(error)
            );
        }
    },
    beforeMount(){
        this.getYears()
    }
}  
</script>
