<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\TutorialSave;
use App\Http\Requests\Admin\TutorialSort;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tutorial;
use Illuminate\Support\Facades\DB;

class TutorialController extends Controller
{
    public function fetch(Request $request)
    {
        return response([
            'data' => Tutorial::get()
        ]);
    }

    public function save(TutorialSave $request)
    {
        $params = $request->only(array_keys(TutorialSave::RULES));

        if (!$request->input('id')) {
            if (!Tutorial::create($params)) {
                abort(500, '创建失败');
            }
        } else {
            try {
                Tutorial::find($request->input('id'))->update($params);
            } catch (\Exception $e) {
                abort(500, '保存失败');
            }
        }

        return response([
            'data' => true
        ]);
    }

    public function show(Request $request)
    {
        if (empty($request->input('id'))) {
            abort(500, '参数有误');
        }
        $tutorial = Tutorial::find($request->input('id'));
        if (!$tutorial) {
            abort(500, '教程不存在');
        }
        $tutorial->show = $tutorial->show ? 0 : 1;
        if (!$tutorial->save()) {
            abort(500, '保存失败');
        }

        return response([
            'data' => true
        ]);
    }

    public function sort(TutorialSort $request)
    {
        $sort = $request->input('sort');
        $tutorial = Tutorial::find($request->input('id'))->first();
        if (!$tutorial) {
            abort(500, '教程不存在');
        }
        DB::beginTransaction();
        $tutorial->sort = $sort;
        if (!$tutorial->save()) {
            DB::rollBack();
            abort(500, '保存失败');
        }

        $tutorials = Tutorial::where('sort', '>', $sort)->get();
        foreach ($tutorials as $tutorial) {
            $sort++;
            if (!$tutorial->save(['sort' => $sort])) {
                abort(500, '保存失败');
            }
        }
        DB::commit();
        return response([
            'data' => true
        ]);
    }

    public function drop(Request $request)
    {
        if (empty($request->input('id'))) {
            abort(500, '参数有误');
        }
        $tutorial = Tutorial::find($request->input('id'));
        if (!$tutorial) {
            abort(500, '教程不存在');
        }
        if (!$tutorial->delete()) {
            abort(500, '删除失败');
        }

        return response([
            'data' => true
        ]);
    }
}
