<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DepartmentConfiguration;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function evalPerm()
    {
        return view('admin.settings.evalPerm-index');
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
}
