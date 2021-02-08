@extends("layouts.site")

@section('title')
Home
@endsection

@section('content')
<section class="mt-3">
    <div class="table-responsive">
        <table class="table" id="myTable">
        <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Data da venda</th>
                    <th scope="col">Valor Total</th>
                    <th scope="col">Tempo de entrega (dias)</th>
                    <th scope="col">Detalhes</th>
                </tr>
            </thead>
        </table>
    </div>
</section>
@endsection