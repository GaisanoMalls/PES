<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\DepartmentConfiguration;
use App\Models\EvaluationPermission;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function evalPerm()
    {
        $evaluationPermissions = EvaluationPermission::all();
        return view('admin.settings.evalPerm-index', compact('evaluationPermissions'));
    }
    public function deptConfig()
    {
        return view('admin.settings.deptConfig-create');
    }

    public function deptConfigIndex()
    {
        $departmentConfigurations = DepartmentConfiguration::all();

        return view('admin.settings.deptConfig.index', [
            'departmentConfigurations' => $departmentConfigurations,
        ]);
    }


    public function deptConfigShow($id)
    {
        $config = DepartmentConfiguration::findOrFail($id);

        return view('admin.settings.deptConfig.show', compact('config'));
    }

    public function evalpermCreate()
    {
        return view('admin.settings.evalPerm.evalPerm-create');
    }
}
