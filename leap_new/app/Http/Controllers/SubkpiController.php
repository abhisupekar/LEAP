<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth as Auth;
use DB;
use App\Kpi;
use App\Subkpi;
use App\Department;
use App\KpiSubkpiDepartment;
use DataTables;

class SubkpiController extends Controller
{
    private function subkpiFormRequiredData()
    {
       $kpis = Kpi::orderBy('id')->pluck('name','id');
       $departments = Department::orderBy('id')->pluck('name','id');
       $requiredData = ['kpis' => $kpis, 'departments' => $departments];
       return $requiredData;
    }

    public function createSubkpiForm() {
       $requiredData = $this->subkpiFormRequiredData();
       return view('subkpi.subkpi-add', ['kpis' => $requiredData['kpis'], 'departments' => $requiredData['departments']]);
    }

    public function create(Request $request)
    {   
        if (Auth::user()) {
            $subkpi = new Subkpi;
            $subkpi->name = $request->name;
            $subkpi->description = $request->description;
            $subkpi->min = $request->min;
            $subkpi->max = $request->max;
            $status = $subkpi->save();
            if ($status) {
                $departments = $request->department;
                $processedData = $this->processData($departments, $subkpi->id, $request);
                $relationshipStatus = $this->saveRelationship($processedData);
                if($relationshipStatus) {
                    return view('subkpi.subkpis');
                } 
            }
        }
        return redirect()->guest('login');
    }

    private function processData($departments, $subkpiId, $request)
    {
        $subkpiData = array();
        foreach ($departments as $key => $departmentID) {
            $subkpiData[$key] = ['kpi_id' => (int) $request->kpis, 'subkpi_id' => $subkpiId, 'department_id' => $departmentID];
        }
        return $subkpiData;
    }

    private function saveRelationship($subkpiData){
        $relationshipStatus = KpiSubkpiDepartment::insert($subkpiData);
        return $relationshipStatus;
    }

    public function index()
    {
        if (Auth::user()) {
           return view('subkpi.subkpis');
        }
        return redirect()->guest('login');
    }

    public function list()
    {
        if (Auth::user()) {
            $subkpi = Subkpi::getSukpisDetails();
            return DataTables::of($subkpi)
            ->addColumn('action', function ($subkpi) {
                return '<form action="/subkpi-edit" method="POST"><input type="hidden" name="_token" value="'.csrf_token() .'"/><input type="hidden" name="subkpi_id" id="subkpi_id" value="'.$subkpi->id.'"/><input type="submit" value ="Edit" class="btn btn-sm btn-primary"/></form>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
        }
        return redirect()->guest('login');

    }

    public function updatePreprocess(Request $request)
    {
        if (Auth::user()) {
            $requiredData = $this->subkpiFormRequiredData();
            $subkpiToUpdate = Subkpi::find($request->subkpi_id);
            $kpiSubkpiDepartmentData = KpiSubkpiDepartment::where('subkpi_id', $request->subkpi_id)->get();
            $departments = [];
            foreach($kpiSubkpiDepartmentData as $key => $value)
            {
                array_push($departments, $value['department_id']);
            }
            $temp = [];
            $temp['id'] = $request->subkpi_id;
            $temp['name'] = $subkpiToUpdate->name;
            $temp['description'] = $subkpiToUpdate->description;
            $temp['min'] = $subkpiToUpdate->min;
            $temp['max'] = $subkpiToUpdate->max;
            $temp['departments'] = $departments;
            $temp['kpi_id'] = $kpiSubkpiDepartmentData[0]['kpi_id'];
            return view('subkpi.subkpi-update', ['kpis' => $requiredData['kpis'],'departments' => $requiredData['departments'], 'temp' => $temp]);
        }
        return redirect()->guest('login');
    }

    public function update(Request $request)
    {
        if (Auth::user()) {
            $subkpiUpdate = Subkpi::find($request->id);
            $subkpiUpdate->name = $request->name;
            $subkpiUpdate->description = $request->description;
            $subkpiUpdate->min = $request->min;
            $subkpiUpdate->max = $request->max;
            $status = $subkpiUpdate->save();
            if($status) {
                $deletedRows = KpiSubkpiDepartment::where('subkpi_id', $request->id)->delete();
                $departments = $request->department;
                $processedData = $this->processData($departments, $request->id, $request);
                $relationshipStatus = $this->saveRelationship($processedData);
                if($relationshipStatus) {
                    return view('subkpi.subkpis');
                }
            }
        }
        return redirect()->guest('login');
    }
}
