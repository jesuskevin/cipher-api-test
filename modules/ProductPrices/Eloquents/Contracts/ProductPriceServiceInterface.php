<?php

namespace Modules\ProductPrices\Eloquents\Contracts;

use Illuminate\Http\Request;

interface ProductPriceServiceInterface
{
    public function index();
    public function store(Request $request);
    public function show($id);
    public function update(Request $request, $id);
    public function destroy($id);
}
