<?php

namespace Modules\Currencies\Eloquents\Contracts;

use Illuminate\Http\Request;

interface CurrencyServiceInterface
{
    public function index();
    public function store(Request $request);
    public function show($id);
    public function update(Request $request, $id);
    public function destroy($id);
}
