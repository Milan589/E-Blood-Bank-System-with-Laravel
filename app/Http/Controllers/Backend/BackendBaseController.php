<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackendBaseController extends Controller
{
    //for view optimization
    function __LoadDataToView($viewPath)
    {
        view()->composer($viewPath, function ($view) {
            $view->with('base_route', $this->base_route);
            $view->with('base_view', $this->base_view);
            $view->with('module', $this->module);
            // $view->with('folder',$this->folder);

        });
        return $viewPath;
    }
}
