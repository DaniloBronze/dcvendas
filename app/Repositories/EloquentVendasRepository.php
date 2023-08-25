<?php

namespace App\Repositories;

use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EloquentVendasRepository implements VendasRepository
{
  public function add(Request $request): Sales
  {
    $rules = [
      'client_id' => 'required',
      'product' => 'required',
      'amount' => 'required',
      'quantity' => 'required',
      'payment' => 'required',
    ];

    if ($request->input('payment') == 2) {
      $rules['plots'] = 'required';
    }

    $request->validate($rules);

    DB::beginTransaction();

    try {
      $venda = Sales::create($request->all());
      DB::commit();

      return $venda;
    } catch (\Exception $e) {
      DB::rollback();
      throw $e;
    }
  }
}
