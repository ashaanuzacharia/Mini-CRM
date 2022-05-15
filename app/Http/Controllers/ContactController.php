<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use App\Contacts;

class ContactController extends Controller
{
    public function index(){
        $contacts = Contacts::select('id','name','phone')->get();
        return view('contacts.index')->with('contacts',$contacts);
     }
  
     public function create(){
        return view('contacts.create');
     }
  
     public function store(Request $request){
        $data = $request->except('_method','_token','submit');
  
        $validator = Validator::make($request->all(), [
           'name' => 'required|string|min:3',
           'phone' => 'required|string|max:10',
        ]);
  
        if ($validator->fails()) {
           return redirect()->Back()->withInput()->withErrors($validator);
        }
  
        if($record = Contacts::firstOrCreate($data)){
           Session::flash('message', 'Added Successfully!');
           Session::flash('alert-class', 'alert-success');
           return redirect()->route('contacts');
        }else{
           Session::flash('message', 'Data not saved!');
           Session::flash('alert-class', 'alert-danger');
        }
  
        return Back();
     }
  
     public function edit($id){
        $contact = Contacts::find($id);
  
        return view('contacts.edit')->with('subject',$contact);
     }
  
     public function update(Request $request,$id){
        $data = $request->except('_method','_token','submit');
  
        $validator = Validator::make($request->all(), [
           'name' => 'required|string|min:3',
           'phone' => 'required|string|max:10',
        ]);
  
        if ($validator->fails()) {
           return redirect()->Back()->withInput()->withErrors($validator);
        }
        $contact = Contacts::find($id);
  
        if($contact->update($data)){
  
           Session::flash('message', 'Update successfully!');
           Session::flash('alert-class', 'alert-success');
           return redirect()->route('contacts');
        }else{
           Session::flash('message', 'Data not updated!');
           Session::flash('alert-class', 'alert-danger');
        }
  
        return Back()->withInput();
     }
  
     // Delete
     public function destroy($id){
        Contacts::destroy($id);
  
        Session::flash('message', 'Delete successfully!');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('contacts');
     }
}
