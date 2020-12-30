<?php

namespace Qihucms\Qualification\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Auth;
use Qihucms\Qualification\Models\QualificationPa;
use Qihucms\Qualification\Requests\PaStoreRequest;
use Qihucms\Qualification\Resources\Pa as PaResource;

class PaController extends ApiController
{
    protected $pa;

    public function __construct(QualificationPa $pa)
    {
        $this->middleware('auth:api');
        $this->pa = $pa;
    }

    /**
     * 查询认证
     *
     * @return PaResource
     */
    public function check()
    {
        return new PaResource($this->pa->find(Auth::id()));
    }

    /**
     * 修改认证
     *
     * @param  PaStoreRequest $request
     * @return \Illuminate\Http\JsonResponse|PaResource
     */
    public function store(PaStoreRequest $request)
    {
        $data = $request->only([
            'real_name', 'id_card_no', 'files'
        ]);
        $data['status'] = 0;

        if ($this->pa->updateOrCreate(['user_id' => Auth::id()], $data)) {
            return new PaResource($this->pa->find(Auth::id()));
        }

        return $this->jsonResponse([__('qualification::message.update_fail')], '', 422);
    }
}
