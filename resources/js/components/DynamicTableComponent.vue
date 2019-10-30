<template>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th>Stock</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="product in products">
                <td>{{ product.name }}</td>
                <td>{{ product.description }}</td>
                <td><input type="number" v-model="product.quantity" v-bind:max="product.stock"></td>
                <td>{{ product.stock }}</td>
                <td><button class="btn btn-sm btn-danger" @click="deleteProduct(product)">&times;</button></td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props:{
        products: Array
    },
    methods:{
        deleteProduct(product){
            this.$emit('deleteFromProducts', product);
        }
    }
    
}
</script>