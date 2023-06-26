<?php

namespace App\Http\Controllers;

use App\Models\WebsiteContent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class WebsiteController extends Controller
{
    public function index(){
        return view('index');
    }

    public function ministry(){
        return view('ministry');
    }

    public function sermon(){
        return view('sermons');
    }

    public function event(){
        return view('events');
    }

    public function contact(){
        return view('contact');
    }

    public function create(){
        return view('create-content');
    }

    public function edit($id){
        $content = WebsiteContent::find($id);
        return view('edit-content', compact('content'));
    }
    
    public function process(Request $request)
    {
        if ($request->hasfile('file')) {
            $filename = $request->file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $path = $request->file->storeAs('public/images/' . $folder, $filename);
            Session::put('location', $folder);
            Session::put('Fname', $filename);
        }
    }

    public function store(Request $request){

        $data = $request->validate([
            'page' => 'required',
            'page' => 'required',
            'topic' => 'required',
            'content' => 'required',
        ]);

        if(Session::get('Fname') == ''){
            return redirect()->back()->with('error','Image is required');
        }

        $file =  Session::get('Fname');
        WebsiteContent::Create($data  + ['user_id'=>auth()->id(),'image' => Session::get('location') . '/' . $file ]);
        Session::forget('Fname', 'location');

        return redirect()->route('dashboard')->with('status','Content saved successfully');

    }

    public function update(Request $request, $id){

        $data = $request->validate([
            'page' => 'required',
            'page' => 'required',
            'topic' => 'required',
            'content' => 'required',
        ]);

        $content = WebsiteContent::find($id);

        $file =  Session::get('Fname');

        $content->update($data  + ['user_id'=>auth()->id()]);

        if($file != ''){
            $content->update(['image' => Session::get('location') . '/' . $file]);
        }

        Session::forget('Fname', 'location');

        return redirect()->route('dashboard')->with('status','Content updated successfully');

    }

    public function destroy($id){
        WebsiteContent::find($id)->delete();
        return redirect()->back()->with('status','Content deleted successfully');
    }

    public function dashboard()
    {
        if(request()->ajax()){
            $data = WebsiteContent::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="'.route('content.edit', $row->id).'" class="btn btn-primary btn-sm">Edit</a>
                            <form action="'.route('content.destroy', $row->id).'" method="POST" style="display:inline">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="submit" class="btn btn-danger text-gray-800 btn-sm">Delete</button>
                            </form>';
                })
                ->addColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->format('F j, Y g:i A');
                })
                ->rawColumns(['action','content'])
                ->make(true);
        }
        
        return view('dashboard');
    }
}
