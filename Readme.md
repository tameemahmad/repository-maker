# Implementation of repository patteren and service layer using commands

A simple Laravel 5 and laravel 6 library that allows you to implement Repository Pattern with a single command

## Installation

```
composer require temify/laravel-repository-pattern
```

## Features

Will generate

* Service class
* Interface implementations
* ServiceProvider for contracts

## Enable the package (Optional)

This package implements Laravel auto-discovery feature. After you install it the package provider and facade are added automatically .

## Configuration

Publish the configuration file

This step is required

```
php artisan vendor:publish --provider="Temify\RepositoryPattern\RepositoryPatterServiceProvider"
```

## Usage

After publishing the configuration file just run the below command

```
php artisan make:repo YOURMODEL
```

That's it, Now you've successfully implemented the repository pattern

## Example

```php
php artisan make:repo Product
```

#### ProductRepositoryInterface.php

```php
<?php

namespace App\Repositories;

interface ProductRepositoryInterface
{
    /**
     * Get's a record by it's ID
     *
     * @param int
     */
    public function get($id);

    /**
     * Get's all records.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a record.
     *
     * @param int
     */
    public function delete($id);


}
```
```php

#### ProductRepository.php

<?php

namespace App\Repositories;

use App\Models\Product;


class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Get's a record by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($id)
    {
        return Product::find($id);
    }

    /**
     * Get's all records.
     *
     * @return mixed
     */
    public function all()
    {
        return Product::all();
    }

    /**
     * Deletes a record.
     *
     * @param int
     */
    public function delete($id)
    {
        Product::destroy($id);
    }

    /**
     * Updates a post.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data)
    {
        Product::find($id)->update($data);
    }
}

##### Now go to

```Repositories/RepositoryBackendServiceProvider.php```
and register the interface and class you have'just created

```php
<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class RepositoryBackendServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(
            /*
            * Register your Repository classes and interface here
            **/

            'App\Repositories\ProductRepositoryInterface',
            'App\Repositories\ProductRepository'
        );
    }
}

```

##### And now in your ```app/Http/Controllers/ProductController```

```php
<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;

class ProductController extends Controller
{
    protected $product;

    public function __construct(ProductRepositoryInterface $product)
    {
        $this->$product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->product->all();

        return $data;
    }
  
}
```

##### That's it , All done .
