<?php

namespace Qihucms\Qualification\Controllers\Admin;

use App\Admin\Controllers\Controller;
use Qihucms\Qualification\Models\QualificationCo;
use App\Models\User;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CoController extends Controller
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '企业认证';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new QualificationCo());

        $grid->model()->latest();

        $grid->filter(function ($filter) {
            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            // 在这里添加字段过滤器
            $filter->like('user.username', __('user.username'));
            $filter->like('company_name', __('qualification::qualification_co.company_name'));
            $filter->equal('status', __('qualification::qualification_co.status.label'))
                ->select(__('qualification::qualification_co.status.value'));

        });

        $grid->column('user.username', __('user.username'));
        $grid->column('company_name', __('qualification::qualification_co.company_name'));
        $grid->column('company_id', __('qualification::qualification_co.company_id'));
        $grid->column('status', __('qualification::qualification_co.status.label'))
            ->select(__('qualification::qualification_co.status.value'));
        $grid->column('created_at', __('admin.created_at'));
        $grid->column('updated_at', __('admin.updated_at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(QualificationCo::findOrFail($id));

        $show->field('user_id', __('user.username'))->as(function () {
            return $this->user->username ?? '';
        });
        $show->field('company_name', __('qualification::qualification_co.company_name'));
        $show->field('company_id', __('qualification::qualification_co.company_id'));
        $show->field('files', __('qualification::qualification_co.files'))->carousel();
        $show->field('contacts', __('qualification::qualification_co.contacts'));
        $show->field('mobile', __('qualification::qualification_co.mobile'));
        $show->field('email', __('qualification::qualification_co.email'));
        $show->field('address', __('qualification::qualification_co.address'));
        $show->field('status', __('qualification::qualification_co.status.label'))
            ->using(__('qualification::qualification_co.status.value'));
        $show->field('created_at', __('admin.created_at'));
        $show->field('updated_at', __('admin.updated_at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new QualificationCo());

        $form->select('user_id', __('qualification::qualification_pa.user_id'))
            ->options(function ($use_id) {
                $model = User::find($use_id);
                if ($model) {
                    return [$model->id => $model->username];
                }
            })
            ->ajax(route('admin.select.user'))
            ->rules('required');
        $form->text('company_name', __('qualification::qualification_co.company_name'))->rules('required');
        $form->text('company_id', __('qualification::qualification_co.company_id'))->rules('required');
        $form->multipleImage('files', __('qualification::qualification_co.files'))
            ->uniqueName()
            ->removable()
            ->move('qualification/co');
        $form->text('contacts', __('qualification::qualification_co.contacts'))->rules('required');
        $form->mobile('mobile', __('qualification::qualification_co.mobile'))->rules('required');
        $form->email('email', __('qualification::qualification_co.email'));
        $form->text('address', __('qualification::qualification_co.address'));
        $form->select('status', __('qualification::qualification_co.status.label'))
            ->options(__('qualification::qualification_co.status.value'));

        return $form;
    }
}
