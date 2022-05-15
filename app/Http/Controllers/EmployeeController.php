<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use App\Employee;
use App\Company;
use DB;

class EmployeeController extends Controller
{
    public function index(){
        $employees = Employee::orderBy('id', 'DESC')->paginate(10);
        
        return view('employee.index')->with(compact('employees'));
     }

     public function create(){
        $companies = Company::get();
        return view('employee.create')->with(compact('companies'));
     }
  
     public function store(Request $request){
        $data = $request->except('_method','_token','submit');
  
        $this->validate($request,[
         'first_name' => 'required|string|min:3',
         'last_name' => 'required|string|min:3',
         'email' => 'required|email',

        
       ]);
  
        if($record = Employee::firstOrCreate($data)){
           Session::flash('message', 'Added Successfully!');
           Session::flash('alert-class', 'alert-success');
           return redirect()->route('employee');
        }else{
           Session::flash('message', 'Data not saved!');
           Session::flash('alert-class', 'alert-danger');
        }
  
        return Back();
     }
     public function view(Request $request, $id = null){

       $employee = Employee::where(['id'=>$id])->first();
        return view('employee.show')->with('employee',$employee);
     }

     //edit
   public function edit($id=null){
      $employee = Employee::where(['id'=>$id])->first();
      //Sector dropdown starts
      $companies = DB::table('companies')->get();
      $companies_dropdown = "<option selected disabled>Select</option>";
      foreach($companies as $company){
              if($company->name==$employee->sector){
              $selected = "selected";
              }else{
              $selected = "";
              }
          $companies_dropdown .= "<option value='".$company->name."' ".$selected.">".$company->name."</option>";
      }
       return view('employee.edit')->with(compact('employee','companies_dropdown'));
    }
  
    public function update(Request $request,$id){
     $data = $request->except('_method','_token','submit');
      
      $this->validate($request,[
        'first_name' => 'required|string|min:3',
        'last_name' => 'required|string',
        'email' => 'required|email',
         
      ]);
      
     $employee = Employee::find($id);
  
       if($employee->update($data)){
  
          Session::flash('message', 'Update successfully!');
          Session::flash('alert-class', 'alert-success');
          return redirect()->route('employee');
       }else{
          Session::flash('message', 'Data not updated!');
          Session::flash('alert-class', 'alert-danger');
       }
  
       return Back()->withInput();
    }
  
    public function destroy($id){
      Employee::destroy($id);
  
      Session::flash('message', 'Delete successfully!');
      Session::flash('alert-class', 'alert-success');
      return redirect()->route('employee');
   }
}
