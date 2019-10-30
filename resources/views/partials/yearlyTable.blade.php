<div class="container">
    <form action="" method="get">
        <input type="text" class="form-control" name="year">
        <button type="submit" class="btn btn-primary">Ac</button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Año</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{$product->name}}</td>
                    <td>{{$product->total_products}}</td>
                    <td>{{$product->year}}</td>
                    <td>{{$product->type}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>