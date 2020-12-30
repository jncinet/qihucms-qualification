<?php

namespace Qihucms\Qualification\Controllers\Admin;

use App\Admin\Controllers\Controller;
use Qihucms\Qualification\Models\QualificationPa;
use App\Models\User;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PaController extends Controller
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '个人认证';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new QualificationPa());

        $grid->model()->latest();

        $grid->filter(function ($filter) {
            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            // 在这里添加字段过滤器
            $filter->like('user.username', __('user.username'));
            $filter->like('real_name', __('qualification::qualification_pa.real_name'));
            $filter->equal('status', __('qualification::qualification_pa.status.label'))
                ->select(__('qualification::qualification_pa.status.value'));

        });

        $grid->column('id', __('qualification::qualification_pa.id'));
        $grid->column('user.username', __('user.username'));
        $grid->column('real_name', __('qualification::qualification_pa.real_name'));
        $grid->column('id_card_no', __('qualification::qualification_pa.id_card_no'));
        $grid->column('status', __('qualification::qualification_pa.status.label'))
            ->select(__('qualification::qualification_pa.status.value'));
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
        $show = new Show(QualificationPa::findOrFail($id));

        $show->field('id', __('qualification::qualification_pa.id'));
        $show->field('user_id', __('user.username'))->as(function () {
            return $this->user->username ?? '';
        });
        $show->field('real_name', __('qualification::qualification_pa.real_name'));
        $show->field('id_card_no', __('qualification::qualification_pa.id_card_no'));
        $show->field('files', __('qualification::qualification_pa.files'))->carousel();
        $show->field('status', __('qualification::qualification_pa.status.label'))
            ->using(__('qualification::qualification_pa.status.value'));
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
        $form = new Form(new QualificationPa());

        $form->select('user_id', __('qualification::qualification_pa.user_id'))
            ->options(function ($use_id) {
                $model = User::find($use_id);
                if ($model) {
                    return [$model->id => $model->username];
                }
            })
            ->ajax(route('admin.select.user'))
            ->rules('required');
        $form->text('real_name', __('qualification::qualification_pa.real_name'));
        $form->text('id_card_no', __('qualification::qualification_pa.id_card_no'));
        $form->multipleImage('files', __('qualification::qualification_pa.files'))
            ->uniqueName()
            ->removable()
            ->move('qualification/pa');
        $form->select('status', __('qualification::qualification_pa.status.label'))
            ->options(__('qualification::qualification_pa.status.value'));

        return $form;
    }
}
