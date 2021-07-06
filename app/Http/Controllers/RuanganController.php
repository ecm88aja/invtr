<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* use App\Supplier as Obj; */
use App\Ruangan as Obj;
use Session;
use App\Models\User;
// tipe 2 required
use Validator;

class RuanganController extends Controller
{
    protected $page = 'ruangan';
    protected $success = 'Data Berhasil';
    protected $failed = 'Data Gagal';
    protected $insert = 'Disimpan';
    protected $update = 'Diubah';
    protected $delete = 'Dihapus';




public function __construct()
{

    $this->middleware('auth');

}

    public function index()
    {
        //


        $data = Obj::all();
        $no=1;
        $page=$this->page;



        return view($this->page.'/index',compact('data','no','page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $page = $this->page;
        $num = Obj::orderBy('created_at','desc')->count();
        $dataCode = Obj::orderBy('created_at','desc')->first();
        if ($num ==0) {
            $code = 'KGD001';

        }
        else{
            $c = $dataCode->kode_gedung;

            $code = substr($c, 3)+1;
            $code = "KGD00".$code;
        }


        return view($this->page.'/create',compact('page','code'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validasi


      /*   $input = $request->all();
        $request->validate([
            'Nama_Gedung'  =>      'required',
            'Nama_Ruangan' =>    'required',
            'Kode_Ruangan' =>    'required',
            'Pic' => 'required'
        ]); */






        $obj = new Obj;
        $obj->kode_gedung = $request->kode_gedung;
        $obj->nama_gedung = $request->nama_gedung;
        $obj->pic = $request->pic;
        $obj->nama_ruangan = $request->nama_ruangan;
        $obj->kode_ruangan = $request->kode_ruangan;
        /* $obj->pic = $request->pic; */
        $save = $obj->save();
        if ($save) {
            # code...
            Session::flash('success',$this->success.$this->insert);
        }

        return redirect('/'.$this->page);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data= Obj::find($id);
        $page = $this->page;
        return view($this->page.'/edit',compact('data','page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $obj = Obj::find($id);
        $obj->nama_gedung = $request->nama_gedung;
        $obj->pic = $request->pic;
        $obj->nama_ruangan = $request->nama_ruangan;
        $obj->kode_ruangan = $request->kode_ruangan;

        $obj->save();


        return redirect('/'.$this->page);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $obj = Obj::find($id);
        $obj->delete();
        // Session::flash('success',);
        return redirect('/'.$this->page);
    }


    public function search(Request $request){
        $q = $request->q;
        $page=$this->page;
        if (empty($q)) {
            # code...
            return redirect('/'.$page);
        }
        $data = Obj::where('nama_gedung','LIKE','%'.$q.'%')->orWhere('kode_gedung','LIKE','%'.$q.'%')->paginate(10);

        $no=1;
        return view($this->page.'/search',compact('data','no','page','q'));


    }
}
