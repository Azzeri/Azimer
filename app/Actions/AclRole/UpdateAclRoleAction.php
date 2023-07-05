<?php

namespace App\Actions\AclRole;

use App\Models\AclRole;
use App\Services\AclService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @author Mariusz Waloszczyk
 */
class UpdateAclRoleAction
{
    public function __construct(private AclService $aclService)
    {
    }

    /**
     * Updates role in db
     *
     * @author Mariusz Waloszczyk
     */
    public function execute(
        Request $request,
        AclRole $aclRole,
    ): bool {
        // dd($request->aclResources);
        if ($request->aclResources) {
            try {
                DB::beginTransaction();
                $resources = $aclRole->resources;
                $aclRole->resources()->detach();
                // throw new Exception;
                
                foreach ($request->aclResources as $resource) {
                    $aclRole->resources()->attach($resource['suffix'], ['action' => $resource['action']]);
                }
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
            }
            // $aclResources = collect($request->aclResources);
//             $aclResources = [];
//             $arr = [];
//             $keys = [];
//             $values = [];
//             foreach ($request->aclResources as $key => $value) {
//                 // $keys[] = $value['suffix'];
//                 // $values[] = ['action' => $value['action']];
//                 // $keys = array_keys($request->aclResources);
//     	        // $keys[array_search($key, $keys)] = $value['suffix'];
//                 // $arr = array_combine($keys, $request->aclResources);

//                 // $aclResources->put($resource['suffix'], ['action' => $resource['action']]);

//                 $aclResources = array_merge_recursive($aclResources, [
//                     $value['suffix'] => ['action' => $value['action']]
//                 ]);
//                 // $aclResources[$resource['suffix']] = ['action' => $resource['action']];
//             }
//             // dd($aclResources);
//             // $arr = array_fill_keys($keys, 'banana');
//             $combined = array_combine($keys, $values);
// //             dd($aclResources);
// // die();
            
            // foreach ($request->aclResources as $requestResource) {
            //     dump($requestResource['suffix'] === $roleResource->suffix
            //         && $requestResource['action'] === $roleResource->pivot->action);
            // }
            // die();
            // $aclRole->resources()->sync($aclResources);
        }

        return $aclRole->update([
            'suffix' => $request->suffix,
        ]);
    }
}
