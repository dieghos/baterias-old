<form action="" method="get">
    <input type="hidden" name="type" value="month">
    <div class="row">
        <div class="col-md-3">
            <select-year-component></select-year-component>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
    </div>
</form>
<br>
<table class="table">
        <thead>
            <tr>
                <th>{{__('Modelo')}}</th>
                <th>{{__('Enero')}}</th>
                <th>{{__('Febrero')}}</th>
                <th>{{__('Marzo')}}</th>
                <th>{{__('Abril')}}</th>
                <th>{{__('Mayo')}}</th>
                <th>{{__('Junio')}}</th>
                <th>{{__('Julio')}}</th>
                <th>{{__('Agosto')}}</th>
                <th>{{__('Septiembre')}}</th>
                <th>{{__('Octubre')}}</th>
                <th>{{__('Noviembre')}}</th>
                <th>{{__('Diciembre')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->total_jan  }}</td>
                    <td>{{ $product->total_feb  }}</td>
                    <td>{{ $product->total_mar  }}</td>
                    <td>{{ $product->total_apr  }}</td>
                    <td>{{ $product->total_may  }}</td>
                    <td>{{ $product->total_jun  }}</td>
                    <td>{{ $product->total_jul  }}</td>
                    <td>{{ $product->total_aug  }}</td>
                    <td>{{ $product->total_sep  }}</td>
                    <td>{{ $product->total_oct  }}</td>
                    <td>{{ $product->total_nov  }}</td>
                    <td>{{ $product->total_dec  }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

