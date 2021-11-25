<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Permission;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    // Check if the user has permission to access group whose id matches $groupId
    protected function getPermissionLevel($userId, $groupId){
        try{
            // firstOrFail() method returns a exception when nothing has found 
            $permission = Permission::where([
                    ['user_id', '=', $userId],
                    ['group_id', '=', $groupId],
                ])
                ->firstOrFail();
            return $permission->permission_level;
        }catch(ModelNotFoundException $e){
            // When catch a exception, user doesn't have a permission
            Log::debug($e);
            return -1;
        }
    }
}
