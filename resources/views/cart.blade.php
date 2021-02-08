@extends("layouts.site")

@section('title')
Home
@endsection

@section('content')
<section>
    <div class="row mt-3">
        <div class="card text-center">
            <div class="card-header">
               Itens no carrinho - <span class="total-carrinho"></span>
            </div>
            <ul class="list-group list-group-flush cart-container">
                
            </ul>

            <button type="button" class="btn btn-dark btn-lg m-3 saleCreate">Finalizar venda</button>
        </div>
    </div>
</section>
@endsection