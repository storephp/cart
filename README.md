<p align="center"><a href="#" target="_blank"><img src="./cover.svg"/></a></p>

<p align="center">
  <a href="https://packagist.org/packages/storephp/cart" target="_blank"><img src="https://img.shields.io/static/v1?label=Packagist&message=storephp/cart&color=blue&logo=packagist&logoColor=white" alt="Source"></a>
  <a href="https://packagist.org/packages/storephp/cart" target="_blank"><img src="https://poser.pugx.org/storephp/cart/v" alt="Packagist Version"></a>
</p>

# StorePHP Cart

Cart module for eCommerce system based on laravel.

## Documentation

### Installation

```bash
composer require storephp/cart
```

Install via composer.

```bash
php artisan migrate
```

You need to migrate the package tables.

### How to use

#### Create New Cart

```php
<?php

use Storephp\Cart\Facades\CartManagement;

$cart = CartManagement::initCart('01HF7V7N1MG9SDFPQYWXDNHR9Q', 'USD'); // <- ULID
```

You can open the cart if it exists or create a new cart if not exist.

#### Open Exist Cart

```php
<?php

use Storephp\Cart\Facades\CartManagement;

$cart = CartManagement::openCart('01HF7V7N1MG9SDFPQYWXDNHR9Q'); // <- ULID
```

#### Get Ulid

```php
$cart->getUlid();
```

#### Get Currency

```php
$cart->getCurrency();
```

Open the existing cart only

#### Add Quote

```php
<?php

use App\Models\Product;
use Storephp\Cart\Facades\CartManagement;

$product = Product::first();

$cart = CartManagement::openCart('01HF7V7N1MG9SDFPQYWXDNHR9Q'); // <- ULID
$cart->quote()->addQuote($product, 1);
```

You need preparing `Product` model to use like this.

```php
// Product model
<?php

...
use Storephp\Cart\Contracts\IQuote;
use Storephp\Cart\Traits\HasQuote;
use Storephp\Cart\Traits\HasTotal;

class Product extends Model implements IQuote
{
    use HasFactory;
    use HasQuote;
    use HasTotal;

    public function getPriceAttribute(): float
    {
        return (float) $this->price;
    }

    public function getSpecialPriceAttribute(): float|null
    {
        return null;
    }
}
```

#### Increase Quote

```php
<?php

use App\Models\Product;
use Storephp\Cart\Facades\CartManagement;

$product = Product::first();

$cart = CartManagement::openCart('01HF7V7N1MG9SDFPQYWXDNHR9Q'); // <- ULID
$cart->quote()->increaseQuote($product, 5);
```

#### Decrease Quote

```php
<?php

use App\Models\Product;
use Storephp\Cart\Facades\CartManagement;

$product = Product::first();

$cart = CartManagement::openCart('01HF7V7N1MG9SDFPQYWXDNHR9Q'); // <- ULID
$cart->quote()->decreaseQuote($product, 2);
```

#### Remove Quote

```php
<?php

use App\Models\Product;
use Storephp\Cart\Facades\CartManagement;

$product = Product::first();

$cart = CartManagement::openCart('01HF7V7N1MG9SDFPQYWXDNHR9Q'); // <- ULID
$cart->quote()->removeQuote($product);
```

#### Get Cart

```php
<?php

use Storephp\Cart\Facades\CartManagement;

$cart = CartManagement::initCart('01HF7V7N1MG9SDFPQYWXDNHR9Q'); // <- ULID
$cart->getCart();
```

#### Get Quotes

```php
<?php

use Storephp\Cart\Facades\CartManagement;

$cart = CartManagement::initCart('01HF7V7N1MG9SDFPQYWXDNHR9Q'); // <- ULID
$cart->quote()->getQuotes();
```

#### Get Totals

```php
<?php

use Storephp\Cart\Facades\CartManagement;

$cart = CartManagement::initCart('01HF7V7N1MG9SDFPQYWXDNHR9Q'); // <- ULID
$totals = $cart->totals();
$totals->getSubTotal();
$totals->getDiscountTotal();
$totals->getGrandTotal();
```

If you need to add global discount on cart you can use.

```php
$totals->setGlobalDiscountTotal(500.00)
    ->getGrandTotal();
```

## Contributing

Thank you for considering contributing to this package! Be one of the Store team.

## License

This package is an open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
