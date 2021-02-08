# Teste PHP Vx Case

[Live Demo](http://vx.bolty.cc)

### How to Install

* git clone https://github.com/fernandesd/sales-manager.git
* cd sales-manager
* cp .env.example .env
    * configure .env variables
* composer install
* php artisan key:generate
* php artisan storage:link
* php artisan migrate --seed
* php artisan serve
* visit [localhost:8000](http://localhost:8000)

### Endpoints api (base url:http://vx.bolty.cc/api/v0)

| uri           | http method | description   | 
| ------------- |:-------------:|-------------:|
| /produtos             | GET | list all products |
| /produtos/{slugProduct}     | GET | shows a specific product|
| /carrinho | GET | list all cart      |
| /carrinho/adicionar/{slugProduct} | POST | add a product to cart|
| /carrinho/remover/{cartIndex} | DELETE | remove a item from cart |
| /vendas | GET | list all sales      |
| /vendas/criar | POST| create a new sale      |
| /vendas/{idSale} | GET | shows a specific sale|


 
