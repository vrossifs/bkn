<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Akun;
use DB;

class PegBknController extends Controller
{
    //
    public function index()
    {
    	//
    	return view('pegbkn.dashboard');
    }

    public function lihatBarang()
    {
    	//
    	$barang = DB::table('barang')->get();
        return view('pegbkn.lihatBarang', compact('barang'));
    }

    public function beliBarang()
    {
    	// 
    	$barang = DB::table('barang')->get();
        return view('pegbkn.beliBarang', compact('barang'));
    }

    public function dialogBeliBarang($kdbarang)
    {
    	$barang = DB::table('barang')
    		->where(['kdbarang' => $kdbarang])->get();
        return view('pegbkn.dialogBeliBarang', compact('barang'));
    }

    public function ambilBarang()
    {
    	$barang = DB::table('barang')->get();
        return view('pegbkn.ambilBarang', compact('barang'));
    }

    public function dialogAmbilBarang($kdbarang)
    {
        $barang = DB::table('barang')
            ->where(['kdbarang' => $kdbarang])->get();
        return view('pegbkn.dialogAmbilBarang', compact('barang'));
    }

    public function dialogDetailBarang($kdbarang)
    {
    	$barang = DB::table('barang')
    		->where(['kdbarang' => $kdbarang])->get();
        return view('pegbkn.dialogDetailBarang', compact('barang'));
    }
}
