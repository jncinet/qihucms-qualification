<?php

namespace Qihucms\Qualification\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Auth;
use Qihucms\Qualification\Requests\CoStoreRequest;
use Qihucms\Qualification\Resources\Co as CoResource;
use Qihucms\Qualification\Models\QualificationCo;

class CoController extends ApiController
{
    protected $co;

    public function __construct(QualificationCo $co)
    {
        $this->middleware('auth:api');
        $this->co = $co;
    }

    /**
     * 查询认证
     *
     * @return CoResource
     */
    public function check()
    {
        return new CoResource($this->co->findOrFail(Auth::id()));
    }

    /**
     * 修改认证
     *
     * @param  CoStoreRequest $request
     * @return \Illuminate\Http\JsonResponse|CoResource
     */
    public function store(CoStoreRequest $request)
    {
        $data = $request->only([
            'company_name', 'company_id', 'files', 'contacts',
            'mobile', 'email', 'address'
        ]);
        $data['status'] = 0;

        if ($this->co->updateOrCreate(['user_id' => Auth::id()], $data)) {
            return new CoResource($this->co->findOrFail(Auth::id()));
        }

        return $this->jsonResponse([__('qualification::message.update_fail')], '', 422);
    }
}
