<?php

namespace App\Http\Requests\Admin\Master;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Constant\Session;

class GeneralListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'kbn' => 'nullable',
            'value' => 'nullable',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes() {
        return [
            'kbn' => '区分',
            'value' => '値',
        ];
    }
    
    /**
     * 抽出条件
     *
     * @return array
     */
    public function filters(): array{
        $filters = [];
        if(isset($this->kbn)) {
            $filters[] = ['kbn', 'LIKE', '%'. $this->kbn. '%'];
        }
        if(isset($this->value)) {
            $filters[] = ['value', 'LIKE', '%'. $this->value. '%'];
        }
        return $filters;  
    }
    
    /**
     * 条件記憶用セッションセット
     *
     * @param  GeneralListRequest $request
     * @return void
     */
    public static function setRequestSession(GeneralListRequest $request){
        $request->session()->put(Session::MASTER_GENERAL_LIST_CONDS, $request->all());
    }
    
    /**
     * 条件記憶用セッション取得
     *
     * @param  array $conds
     * @return array
     */
    public static function getRequestSession(array $conds) : array{
        $rtn = [];
        if(!empty($conds['isInit']) && $conds['isInit']){
            session()->forget(Session::MASTER_GENERAL_LIST_CONDS);
        }else{
            $session_val = session(Session::MASTER_GENERAL_LIST_CONDS);
            $rtn = $session_val ?? [];
        }
        return $rtn;
    }
}
