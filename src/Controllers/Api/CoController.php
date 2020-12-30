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
     * 添加认证
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
        $data = array_merge($data, ['user_id' => Auth::id(), 'status' => 0]);
        $result = $this->co->create($data);

        if ($result) {
            return new CoResource($result);
        }

        return $this->jsonResponse([__('qualification::message.create_fail')], '', 422);
    }

    /**
     * 查询认证
     *
     * @param  int $id
     * @return CoResource
     */
    public function show($id)
    {
        $result = $this->co->findOrFail($id);

        return new CoResource($result);
    }

    /**
     * 修改认证
     *
     * @param  CoStoreRequest $request
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CoStoreRequest $request, $id)
    {
        $data = $request->only([
            'company_name', 'company_id', 'files', 'contacts',
            'mobile', 'email', 'address'
        ]);
        $data = array_merge($data, ['user_id' => Auth::id(), 'status' => 0]);

        if ($this->co->where('user_id', Auth::id())->where('id', $id)->update($data)) {
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
        if ($this->co->where('user_id', Auth::id())->where('id', $id)->delete()) {
            return $this->jsonResponse(['id' => intval($id)]);
        }

        return $this->jsonResponse([__('qualification::message.delete_fail')], '', 422);
    }
}
