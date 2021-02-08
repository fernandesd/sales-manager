$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

$(document).ready(function () {
    const url = 'http://wordpress.test/api/v0';
    let productContainer = $('.products-container');
    let cartContainer = $('.cart-container');
    let template = '';
    fetch(`${url}/produtos`).then(response => {
        response.json()
            .then(data => {
                data.data.forEach(item => {
                    template += `
                        <div class="col">
                        <div class="card">
                            <img src="${item.image_url}" class="card-img-top" alt="${item.name}">
                            <div class="card-body">
                                <h5 class="card-title">${item.name}</h5>
                                <p class="card-text d-flex justify-content-between">RS ${item.price} <a href><span class="cartAdd" data-slug="${item.slug}" data-toggle="tooltip" data-placement="top" title="Adicionar ao carrinho"> <i class="fas fa-cart-plus"></i> </span></a></p>
                            </div>
                        </div>
                    </div>
        `
                });

                productContainer.html(template);
                template = '';



                const cartAdd = $('.cartAdd');
                cartAdd.click((e) => {
                    e.preventDefault();
                    fetch(`${url}/carrinho/adicionar/${e.currentTarget.dataset.slug}`, {
                        method: 'post',
                        headers: {
                            'Accept': 'application/json, text/plain, */*',
                            'Content-Type': 'application/json'
                        },
                    }).then(res => res.json())
                        .then(res => {
                            alert(res.message);
                        });
                });
            });
    });

    fetch(`${url}/carrinho`).then(response => {
        response.json()
            .then(data => {
                let total = 0;
                data.data.forEach((item, index) => {
                    total += Number((item.price * item.quantity).toFixed(2));
                    template += `
                    <li class="list-group-item border-0">Produto: ${item.name}</li>
                    <li class="list-group-item border-0">Preço: ${item.price}</li>
                    <li class="list-group-item border-0">Quantidade: ${item.quantity}</li>
                    <li class="list-group-item border-0">Tempo de entrega: ${item.delivery_time} dias</li>
                    <li class="list-group-item border-0">Total: ${(item.price * item.quantity).toFixed(2)}</li>
                    <span>
                    <a class="btn btn-outline-danger btn-sm remove-cart-btn" href="#" role="button" data-index="${index}"><i class="fas fa-trash-alt"></i></a>
                    </span>
                    <hr/>
                    `
                });

                $('.total-carrinho').text('Total: ' + total.toFixed(2));
                cartContainer.html(template);
                template = '';

                const rmCart = $('.remove-cart-btn');
                rmCart.click((e) => {
                    e.preventDefault();
                    fetch(`${url}/carrinho/remover/${e.currentTarget.dataset.index}`, {
                        method: 'delete',
                        headers: {
                            'Accept': 'application/json, text/plain, */*',
                            'Content-Type': 'application/json'
                        },
                    }).then(res => res.json())
                        .then(res => {
                            alert(res.message);
                            document.location.reload(true);
                        });
                });
            });
    });


    const saleCreate = $('.saleCreate');
    saleCreate.click((e) => {
        e.preventDefault();

        fetch(`${url}/carrinho`).then(response => {
            response.json()
                .then(data => {
                    fetch(`${url}/vendas/criar`, {
                        method: 'post',
                        headers: {
                            'Accept': 'application/json, text/plain, */*',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ 'items': data.data })
                    }).then(res => res.json())
                        .then(res => {
                            alert(res.message);
                            document.location.reload(true);
                        });
                });

        });
    });

    const table = $('#myTable').DataTable({
        ajax: `${url}/vendas`,
        columns: [
            { data: 'id' },
            { data: 'created_at' },
            { data: 'total_cost' },
            { data: 'max_delivery_time' },
            { data: '' }
        ],
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": '<button class="btn btn-info btn-sm"><i class="far fa-eye"></i></button>'
        }]
    });

    $('#myTable tbody').on('click', 'button', function (e) {
        const vendaId = $('#myTable').DataTable().row($(this).parents('tr')).data().id;

        fetch(`${url}/vendas/${vendaId}`).then(response => {
            response.json()
                .then(data => {
                    data.data.items.forEach(item => {
                        template += `
                        <li class="list-group-item border-0">Produto: ${item.name}</li>
                        <li class="list-group-item border-0">Preço: ${item.price}</li>
                        <li class="list-group-item border-0">Quantidade: ${item.quantity}</li>
                        <li class="list-group-item border-0">Tempo de entrega: ${item.delivery_time} dias</li>
                        <li class="list-group-item border-0">Total: ${(item.price * item.quantity).toFixed(2)}</li>
                        <hr/>`
                    });
                    Swal.fire({
                        html: template
                      });
                });
            });
        });
    });
