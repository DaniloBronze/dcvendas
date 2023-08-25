<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticator;
use App\Repositories\VendasRepository;
use App\Http\Requests\VendasFormRequest;
use App\Models\Clients;
use App\Models\Products;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class VendasController extends Controller
{
    public function __construct(private VendasRepository $vendasRepository)
    {
        $this->middleware('auth')->except(['vendasIndex', 'showClientes', 'showProdutos', 'showVendas']);
    }

    public function vendasIndex()
    {
        Auth::check();
        return view('vendas.index');
    }

    public function createCliente()
    {

        return view('vendas.createCliente');
    }

    public function createVenda()
    {
        $clientes = Clients::all();
        $produtos = Products::all();
        $vendas = Sales::all();
        return view('vendas.createVenda', ['clientes' => $clientes, 'produtos' => $produtos, 'vendas' => $vendas]);
    }

    public function createProduto()
    {
        return view('vendas.createProduto');
    }

    public function storeCliente(VendasFormRequest $request)
    {
        DB::beginTransaction();
        $usuario = Clients::create($request->all());
        DB::commit();

        return to_route('lista.clientes')
            ->with('mensagem.sucesso', "Cliente '{$usuario->name}' cadastrado com sucesso");
    }

    public function storeProduto(VendasFormRequest $request)
    {
        DB::beginTransaction();
        $produto = Products::create($request->all());
        DB::commit();
        $formattedPrice = number_format($produto->price, 2, ',', '.');
        return redirect()->route('lista.produtos')->with('mensagem.sucesso', "O produto '{$produto->name}' cadastrado com sucesso com preço de R$ {$formattedPrice}");
    }

    public function showClientes()
    {
        $clientes = Clients::with(['sales'])->get();
        $messagemSucesso = session('mensagem.sucesso');
        return view('vendas.showClientes',)->with('clientes', $clientes)->with('mensagemSucesso', $messagemSucesso);
    }

    public function showProdutos()
    {
        $produtos = Products::query()->orderBy('price', 'desc')->get();
        $messagemSucesso = session('mensagem.sucesso');
        return view('vendas.showProdutos')->with('produtos', $produtos)->with('mensagemSucesso', $messagemSucesso);
    }

    public function showVendas(Request $request)
    {
        $produtoPesquisa = $request->input('produto_pesquisa');

        $vendasQuery = Sales::with('client');

        if ($produtoPesquisa) {
            $vendasQuery->where('product', 'LIKE', '%' . $produtoPesquisa . '%');
        }

        $vendas = $vendasQuery->get();
        $messagemSucesso = session('mensagem.sucesso');

        return view('vendas.showVendas')
            ->with('vendas', $vendas)
            ->with('mensagemSucesso', $messagemSucesso);
    }


    public function editCliente(Clients $cliente)
    {
        return view('vendas.editCliente')->with('cliente', $cliente);
    }

    public function editProduto(Products $produto)
    {
        return view('vendas.editProduto')->with('produto', $produto);
    }

    public function editVenda(Sales $venda)
    {
        $clienteSelecionado = Clients::find($venda->client_id);
        $nomeCliente = $clienteSelecionado ? $clienteSelecionado->name : 'Cliente Desconhecido';

        return view('vendas.editVenda', [
            'venda' => $venda,
            'nomeCliente' => $nomeCliente,
        ]);
    }

    public function updateVenda(Sales $venda, Request $request)
    {
        $paymentMethod = $request->input('payment');
        $rules = [
            'client_id' => 'required',
            'product' => 'required',
            'amount' => 'required',
            'quantity' => 'required',
            'payment' => 'required',
        ];

        if ($paymentMethod == 2) {
            $rules['plots'] = 'required';
        } else {
            $request->merge(['plots' => 'à vista']);
        }

        $request->validate($rules);

        $venda->fill($request->all());
        $venda->save();
        return to_route('lista.vendas')
            ->with('mensagem.sucesso', "A venda do '{$venda->product}' foi atualizado com sucesso");
    }

    public function updateProduto(Products $produto, VendasFormRequest $request)
    {
        $request->validate([
            'preço' => ['min:1'],
            'total' => ['min:1']
        ]);
        $produto->fill($request->all());
        $produto->save();
        return to_route('lista.produtos')
            ->with('mensagem.sucesso', "O produto '{$produto->name}' atualizado com sucesso");
    }

    public function destroyProduto(Products $produto)
    {
        $produto->delete();
        return to_route('lista.produtos')
            ->with('mensagem.sucesso', "O produto '{$produto->name}' deletado com sucesso");
    }

    public function updateCliente(Clients $cliente, VendasFormRequest $request)
    {
        $cliente->fill($request->all());
        $cliente->save();
        return to_route('lista.clientes')->with('mensagem.sucesso', "Cliente '{$cliente->name}' atualizado com sucesso");
    }

    public function destroyUsuario(Clients $cliente)
    {
        $cliente->delete();
        return to_route('lista.clientes')
            ->with('mensagem.sucesso', "Cliente '{$cliente->name}' deletado com sucesso");
    }

    public function destroyVenda(Sales $venda)
    {
        $venda->delete();
        return to_route('lista.vendas')
            ->with('mensagem.sucesso', "Venda deletada com sucesso");
    }

    public function storeVenda(Request $request)
    {
        $paymentMethod = $request->input('payment');
        $request->merge(['plots' => $paymentMethod == 1 ? 'à vista' : $request->input('plots')]);

        $formattedAmount = number_format($request->input('amount'), 2, ',', '.');
        $venda = $this->vendasRepository->add($request);

        $clienteId = $request->input('client_id');
        $clienteSelecionado = Clients::find($clienteId);
        $nomeClienteSelecionado = $clienteSelecionado ? $clienteSelecionado->name : 'Cliente Desconhecido';

        return redirect()->route('lista.vendas')
            ->with('mensagem.sucesso', "Venda cadastrada com sucesso para o cliente '{$nomeClienteSelecionado}' com valor de R$ {$formattedAmount}");
    }

    public function generatePDF(Sales $venda)
    {
        $clienteNome = $venda->client->name;
        $produtoNome = $venda->product;
        $valor = number_format($venda->amount, 2, ',', '.');
        $quantidade = $venda->quantity;
        $formaPagamento = $venda->payment == 1 ? 'À vista' : "Parcelado em {$venda->plots} vezes de R$ " . number_format($venda->amount / $venda->plots, 2, ',', '.');

        $pdf = PDF::loadView('vendas.pdf', [
            'clienteNome' => $clienteNome,
            'produtoNome' => $produtoNome,
            'valor' => $valor,
            'quantidade' => $quantidade,
            'formaPagamento' => $formaPagamento,
        ]);

        return $pdf->download('detalhes_da_venda.pdf');
    }
}
