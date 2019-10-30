@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Productos</h2>
    <div class="text-right">
        <a href="{{ route('products.create') }}" class="btn btn-lg btn-primary">Nuevo</a>
    </div>
    <hr>
    @if (count($products)>0)
        <table class="table">
            <thead>
                <tr>
                    <th>{{__('Nombre')}}</th>
                    <th>{{__('Descripción')}}</th>
                    <th>{{__('Stock')}}</th>
                    <th>{{__('Acciones')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <a href="{{ route('products.edit', ['product' => $product->id])}}" class="btn btn-sm btn-primary">Editar</a>
                            <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$product->id}})" 
                                data-target="#DeleteModal" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Borrar</a>
                        </td>
                    </tr>    
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    @else
        <h3 class="text-center">No se encontraron registros en la base de datos.</h3>        
    @endif
</div>

<div id="DeleteModal" class="modal fade text-danger" role="dialog">
    <div class="modal-dialog ">
      <!-- Modal content-->
      <form action="" id="deleteForm" method="post">
          <div class="modal-content">
              <div class="modal-header bg-danger">
                  <h4 class="modal-title text-center">Confirmar borrado</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <p class="text-center">¿Desea eliminar el producto?</p>
              </div>
              <div class="modal-footer">
                  <center>
                      <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                      <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Borrar</button>
                  </center>
              </div>
          </div>
      </form>
    </div>
   </div>
@endsection

<script type="text/javascript">
    function deleteData(id)
    {
        var id = id;
        var url = '{{ route("products.destroy",":id")}}';
        url = url.replace(':id',id);
        $("#deleteForm").attr('action',url);
    }

    function formSubmit()
    {
        $("#deleteForm").submit();
    }
</script>