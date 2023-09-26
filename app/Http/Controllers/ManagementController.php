<?php

namespace App\Http\Controllers;

use App\Models\ProgamCategory;
use App\Models\Program;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    //
    public function programIndex()
    {
        $data['identifier'] = "Management | Program";
        $data['programData'] = Program::showAllPrograms();
        $data['data'] = "Program - FFIMS Systems";
        return view('administrator.management.program', $data);
    }

    public function createprogram()
    {
        $data['identifier'] = "Management | Program | Create Program";
        $data['data'] = "Register Program - FFIMS Systems";
        return view('administrator.management.createprogram', $data);
    }

    public function getdtoupdate($id)
    {
        $prog = Program::find($id);
        if (!empty($prog)) {
            $data['programData'] = Program::where('program_id', '=', $id)->first();
            $data['identifier'] = "Management | Program | Update Program";
            $data['data'] = "Update Program - FFIMS Systems";
            return view('administrator.management.updateprogram', $data);
        } else {
            return back();
        }
    }

    public function storeProgram(Request $request)
    {
        $request->validate([
            'program_name' => 'required|unique:program',
        ], [
            'program_name' => 'Program is required!',
            'program_name.unique' => 'Progam already taken!',
        ]);
        $program = new Program();
        $program->program_name = strtoupper(trim($request->program_name));
        $program->created_by = (($request->created_by));
        $program->save();
        return redirect()->route('management.program')->with('success', "Program was successfully added!");
    }

    public function updateProgram(Request $request, $id)
    {
        $request->validate([
            'program_name' => 'required',
        ]);
        $prog = Program::find($id);
        $prog->program_name = strtoupper(trim($request->program_name));
        $prog->created_by = (($request->created_by));
        $prog->touch();
        return redirect()->route('management.program')->with('success', "Program was successfully updated!");
    }

    public function deleteProgram(Request $request)
    {
        $program = Program::find($request->program_id);
        $program->delete();
        return redirect()->route('management.program')->with('success', "Program was successfully removed!");
    }

    // Program Category ************************************************************************
    // Program Category ************************************************************************
    public function programCatIndex()
    {
        $data['listOfProgram'] = Program::where(['program_status' => 'Active', 'program.is_deleted' => '0'])->where('program_id', '!=', 37)
            ->orderBy('program.created_at', 'desc')->get();
        $data['identifier'] = "Management | Program Category";
        $data['programCatData'] = ProgamCategory::loadAndSearchProgramCategory();
        $data['data'] = "Program Category - FFIMS Systems";
        return view('administrator.management.programcat', $data);
    }
    public function createprogramCat()
    {

        $data['identifier'] = "Management | Program Category | Create Category";

        $data['listOfProgram'] = Program::where(['program_status' => 'Active', 'program.is_deleted' => '0'])->where('program_id', '!=', 37)
            ->orderBy('program.created_at', 'desc')->get();
        $data['data'] = "Register Category - FFIMS Systems";
        return view('administrator.management.createprogramcat', $data);
    }
    public function getProgramCategory($id)
    {
        $programCategory = ProgamCategory::find($id);
        if (!empty($programCategory)) {
            $data['listOfProgram'] = Program::where(['program_status' => 'Active', 'program.is_deleted' => '0'])->where('program_id', '!=', 37)
                ->orderBy('program.created_at', 'desc')->get();
            $data['programCategory'] = ProgamCategory::where('pc_id', '=', $id)->first();
            $data['identifier'] = "Management | Program Category | Update Category";
            $data['data'] = "Update Category - FFIMS Systems";
            return view('administrator.management.updateprogramcat', $data);
        } else {

            return back();
        }
    }

    public function storeProgamCategory(Request $request)
    {
        $request->validate([
            'pc_name' => 'required|unique:program_category',
            'prog_id' => 'required',
        ], [
            'pc_name' => 'Category is required!',
            'pc_name.unique' => 'Category name was already taken!',
            'prog_id' => 'Program Field is required!',
        ]);

        $progCat = new ProgamCategory();
        $progCat->pc_name = strtoupper(trim($request->pc_name));
        $progCat->prog_id = ($request->prog_id);
        $progCat->created_by = (($request->created_by));
        $progCat->save();
        return redirect()->route('management.programcategory')->with('success', "Progam Category was successfully added!");
    }
    public function updateProgramCategory(Request $request, $id)
    {
        $request->validate([
            'pc_name' => 'required',
            'prog_id' => 'required',
        ], [
            'pc_name' => 'Category is required!',
            'prog_id' => 'Program Field is required!',
        ]);
        $programCategory = ProgamCategory::find($id);
        $programCategory->pc_name = strtoupper(trim($request->pc_name));
        $programCategory->prog_id = ($request->prog_id);
        $programCategory->created_by = (($request->created_by));
        $programCategory->touch();
        return redirect()->route('management.programcategory')->with('success', "Progam Category was successfully updated!");
    }
    public function deleteProgramCategory(Request $request)
    {
        $program = ProgamCategory::find($request->pc_id);
        $program->is_deleted = 1;
        $program->touch();
        return redirect()->route('management.programcategory')->with('success', "Program was successfully removed!");
    }
    // Program Category ************************************************************************
    public function loadProgramCategory($program_id)
    {
        $data['programCategory'] = ProgamCategory::loadProgramCategory($program_id);
        return response()->json($data);
    }

    // Program Category ************************************************************************

}
