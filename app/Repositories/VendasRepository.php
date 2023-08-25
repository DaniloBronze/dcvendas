<?php

namespace App\Repositories;

use App\Http\Requests\VendasFormRequest;
use App\Models\Sales;

interface VendasRepository
{
  public function add(VendasFormRequest $request): Sales;
}
