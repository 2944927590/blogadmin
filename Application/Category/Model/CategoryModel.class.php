<?php
namespace Category\Model;
use Common\Model\HyAllModel;

/**
 * 博客分类管理模型
 *
 * @author
 */
class CategoryModel extends HyAllModel {

    /**
     * @overrides
     */
    protected function initTableName(){
        return 'article_category';
    }

    /**
     * @overrides
     */
    protected function initInfoOptions(){
        return array(
            'title' => '博客分类管理',
            'subtitle' => '对博客的分类进行管理'
        );
    }
    /**
     * @overrides
     */
    protected function initSqlOptions(){
        return array(
            'associate' => array(
                'article_category|pid|id|name AS pid_text||left'
            ),
            'where' => array(
                'status' => array('lt', 9)
            )
        );
    }
    /**
     * @overrides
     */
    protected function initPageOptions(){
        return array(
            'deleteType' =>	'status|9',			//逻辑删除;	默认-物理删除:delete
            'action' => array(
                'edit' => array(
                    'title' => '编辑',
                    'max' => 1
                ),
                'delete' => array(
                    'title' => '删除',
                    'confirm' => true
                )
            ),
            'buttons' => array(
                'add' => array(
                    'title' => '新增博客分类',
                    'icon' => 'fa-plus'
                ),
            ),
            'formSize' => 'large'
        );
    }
    /**
     * @overrides
     */
    protected function initFieldsOptions() {
        return array (
            'pid' => array(
                'title' => '父分类',
                'list' => array(
                    'callback' => array('get_pid_name','{:pid}','{:pid_text}','{#}'),
                    'search' => array(
                        'type' => 'select'
                    )
                ),
                'form' => array(
                    'type' => 'select',
                    'select' => array(
                        'addon' => true,
                    ),
                    'validate' => array(
                        'required'=>true,
                    ),
                    'callback' => array('get_fir_list', '{:id}', '{#}'),
                    'tip' => '如无可选父栏目，下拉框拖动至底部另行补充'
                )
            ),
            'name' => array(
                'title' => '子分类',
                'list' => array(
                    'search' => array(
                        'type' => 'text',
                        'query' => 'like'
                    )
                ),
                'form' => array(
                    'title' => '子分类名称',
                    'type' => 'text',
                    'callback' => array('get_sec_list','{:id}','{#}')
                )
            ),
            'rank' => array(
                'title' => '权重',
                'list' => array(),
                'form' => array(
                    'type' => 'text',
                    'validate' => array(
                        'required' => true,
                        'regex' => '^\d{1,3}$'
                    ),
                    'tip' => '权重（0-999）越大越靠前'
                )
            ),
            'index_show' => array(
                'title' => '是否开启',
                'list' => array(
                    'callback' => array('status'),
                    'order' => false
                ),
                'form' => array(
                    'type' => 'select',
                    'validate' => array(
                        'required'=>true,
                    ),
                    'select' => array(
                        'first'=>'请选择...'
                    ),
                    'style' => 'no-bs-select'
                )
            ),
            'remark' => array(
                'title' => '备注',
                'list' => array(
                    'order' => false
                ),
                'form' => array(
                    'type'=>'textarea'
                )
            ),
            'status' => array(
                'title' => '状态',
                'list' => array(
                    'callback' => array('status')
                ),
                'form' => array(
                    'type' => 'select',
                    'options' => array(
                        '1' => '正常',
                        '00' => '禁用',
                    ),
                    'style' => 'no-bs-select'
                )
            )
        );
    }

    protected function callback_get_pid_name($pid, $pid_text) {
        return ($pid == 0) ? '<span style="color: #797676;">无父栏目</span>' : $pid_text;
    }
    protected function getOptions_pid(){
        return $arr = $this -> where(array(
            'status' => array('eq', 1),
            'pid' => array('eq', 0)
        )) -> getField('id, name');
    }
    protected function callback_get_fir_list($id) {
        return $this -> where(array(
            'id' => $id
        )) -> getField('pid');
    }
    protected function callback_get_sec_list($id){
        return $this -> where(array(
            'id' => $id
        )) -> getField('name');
    }
    protected function getOptions_index_show(){
        return array(
            1 => '开启',
            0 => '关闭',
        );
    }
    protected function _after_insert($data, $options){
        $sec_name = I('name');
        if( $sec_name ) return;
        $pid = I('pid');
        $data['pid'] = 0 ;
        $data['name'] = $pid;
        M('article_category') -> where(array(
            'id' => $data['id']
        )) -> save($data);
    }

    protected function _after_update($data, $options){
        $sec_name = I('name');
        if(!$sec_name) return;
        $data['name'] = $sec_name;
        M('article_category') -> where(array(
            'id' => $data['id']
        )) -> save($data);
    }
}