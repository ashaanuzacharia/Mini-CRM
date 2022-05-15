<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use App\Company;

use Image;

class CompanyController extends Controller
{
    public function index(){
        $companies = Company::orderBy('id', 'DESC')->paginate(10);
        return view('companies.index')->with('companies',$companies);
     }

     public function create(){
        return view('companies.create');
     }
  
     public function store(Request $request){
        $data = $request->all();
  
        $validator = Validator::make($request->all(), [
           'name' => 'required|string|min:3',
           'email'=>'required|email',
           'image.*' => 'mimes:doc,pdf,docx,zip,jpeg,png,jpg,gif,svg',
        ]);
  
        if ($validator->fails()) {
           return redirect()->Back()->withInput()->withErrors($validator);
        }
         $company = new Company;
         $company->name = $data['name'];
         $company->email = $data['email'];
         $company->website = $data['website'];
         
         if($request->hasFile('image')){
            $image_tmp = $request->file('image');
            if($image_tmp->isValid()){
            $extension = $image_tmp->getClientOriginalExtension();
            $filename = 'im'. '_'.rand(111,99999).'_'.'.'.$extension;
            $image_path = public_path('images/logos/'.$filename);
            Image::make($image_tmp)->fit(600,360)->save($image_path);  
            }
        }else{
            $filename = '';
        }
        $company->logo = $filename;
        $company->save();

         Session::flash('message', 'Added Successfully!');
         Session::flash('alert-class', 'alert-success');
         return redirect()->route('company');
        
     }
     public function view(Request $request, $id = null){

        $company = Company::where(['id'=>$id])->first();
        return view('companies.show')->with('company',$company);
     }

     //edit
   public function edit($id=null){
       $company = Company::where(['id'=>$id])->first();
  
       return view('companies.edit')->with(compact('company'));
    }
  
    public function update(Request $request,$id){
      $data = $request->all();
      
      $this->validate($request,[
         'name' => 'required|string|min:3',
         'email'=>'required|email',
         'image.*' => 'mimes:doc,pdf,docx,zip,jpeg,png,jpg,gif,svg',
         
      ]);
      
      $company = Company::find($id);
  
       if($company->update($data)){
  
          Session::flash('message', 'Update successfully!');
          Session::flash('alert-class', 'alert-success');
          return redirect()->route('company');
       }else{
          Session::flash('message', 'Data not updated!');
          Session::flash('alert-class', 'alert-danger');
       }
  
       return Back()->withInput();
    }
  
    public function destroy($id){
      Company::destroy($id);
  
      Session::flash('message', 'Delete successfully!');
      Session::flash('alert-class', 'alert-success');
      return redirect()->route('company');
   }

}
