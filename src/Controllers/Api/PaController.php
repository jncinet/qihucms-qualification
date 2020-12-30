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
     * 添加认证
     *
     * @param  PaStoreRequest $request
     * @return \Illuminate\Http\JsonResponse|PaResource
     */
    public function store(PaStoreRequest $request)
    {
        $data = $request->only([
            'real_name', 'id_card_no', 'files'
        ]);
        $data = array_merge($data, ['user_id' => Auth::id(), 'status' => 0]);
        $result = $this->pa->create($data);

        if ($result) {
            return new PaResource($result);
        }

        return $this->jsonResponse([__('qualification::message.create_fail')], '', 422);
    }

    /**
     * 查询认证
     *
     * @param  int $id
     * @return PaResource
     */
    public function show($id)
    {
        $result = $this->pa->findOrFail($id);

        return new PaResource($result);
    }

    /**
     * 修改认证
     *
     * @param  PaStoreRequest $request
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PaStoreRequest $request, $id)
    {
        $data = $request->only([
            'real_name', 'id_card_no', 'files'
        ]);
        $data = array_merge($data, ['user_id' => Auth::id(), 'status' => 0]);

        if ($this->pa->where('user_id', Auth::id())->where('id', $id)->update($data)) {
            return $this->jsonResponse(['id' => intval($id)]);
        }

        return $this->jsonResponse([__('qualification::message.update_fail')], '', 422);
    }

    /**
     * 删除认证
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if ($this->pa->where('user_id', Auth::id())->where('id', $id)->delete()) {
            return $this->jsonResponse(['id' => intval($id)]);
        }

        return $this->jsonResponse([__('qualification::message.delete_fail')], '', 422);
    }
}
