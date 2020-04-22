<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/21/2019
 * Time: 5:32 PM
 */

namespace Contact\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Contact\Repositories\ContactRepository;
use Illuminate\Http\Request;

class ApiContactController extends BaseController
{
    protected $con;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->con = $contactRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCreateApi(Request $request)
    {
        $contact_name = $request->get('contact_name');
        $email = $request->get('email');
        $phone = $request->get('phone');
        $contact_title = $request->get('contact_title');
        $content = $request->get('content');
        $group = $request->get('group');

        try{
            $this->con->create([
                'contact_name' => $contact_name,
                'email' => $email,
                'contact_title'=>$contact_title,
                'phone' => $phone,
                'content' => $content,
                'group' => $group,
                'contact_title' => $contact_title

            ]);

            return response()->json(['message' => 'success'])->setStatusCode(200);

        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }
    }

    function getQuestion(Request $request){
        $limit = $request->get('limit');
        $group = $request->get('group');

        $data = $this->con->findWhere(['group'=>$group,'status'=>'active'])->take($limit);
        return $data;

    }

}