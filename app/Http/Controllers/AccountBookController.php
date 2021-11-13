<?php

namespace App\Http\Controllers;

use App\Models\AccountBook;
use App\Models\AccountReference;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OpenBookRequest;

class AccountBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $account_reference = AccountReference::all();

        $account = AccountBook::latest()->first();
     
        if($account){
            $account->lote = $account->lote +1;
        }
        

        $select_account = DB::table('account_books')
        ->join('account_references','account_books.caixa_id','=','account_references.id')
        ->select('account_books.*','account_references.descricao')
        ->where('data_fech','=',null)
        ->get();
        return view('operation.open_account_book',compact('select_account','account_reference','account'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OpenBookRequest $request)
    {
        $account_bank = $request->all();
        if($account_bank['data_fech'] == null) {
            $account_book = AccountBook::create($account_bank);
            if($account_book == true){
                return redirect()->back()->with([toast()->success("Caixa aberto com sucesso!")]);
            }
        }
        else{
            return redirect()->back()->with([toast()->error("Erro ao tentar abrir caixa")]);
        }
    }

    public function show($id)
    {
        $account = AccountBook::findOrfail($id);
        $account_reference = AccountReference::all();
        $select_account = DB::table('account_books')
        ->join('account_references','account_books.caixa_id','=','account_references.id')
        ->select('account_books.*','account_references.descricao')
        ->where('data_fech','=',null)
        ->get();
        return view("operation.close_account_book", compact('select_account','account_reference','account'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccountBook  $accountBook
     * @return \Illuminate\Http\Response
     */
    public function close(Request $request,$id)
    {
        $account_book = AccountBook::find($id);
        $account_book->data_fech = $request->input('data_fech');
        switch($account_book->data_fech){
            case(null);
                return redirect()->back()->with([toast()->error("Data de fechamento é obrigatório!")]);
            break;
            case($account_book->data_fech < $account_book->data_aber);
                return redirect()->back()->with([toast()->error("Data de fechamento não pode ser menor do que a data de abertura!")]);
            break;
        }
        $account_book->update();
        if($account_book == true){
            return redirect()->route("account.book")->with([toast()->info("Caixa fechado com sucesso!")]);
        }
        return redirect()->back()->with([toast()->error("Erro ao tentar fechar caixa!")]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccountBook  $accountBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountBook $accountBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccountBook  $accountBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountBook $accountBook)
    {
        //
    }

    public function post_index(){
        return view('operation.posting_account');
    }
}