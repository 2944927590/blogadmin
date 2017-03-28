<?php
namespace Broadcast\Model;
use Common\Model\HyAllModel;

/**
 * 公告管理模型
 *
 * @author
 */
class BroadcastModel extends HyAllModel {

    /**
     * @overrides
     */
    protected function initTableName(){
        return 'broadcast';
    }

    /**
     * @overrides
     */
    protected function initInfoOptions(){
        return array(
            'title' => '公告管理',
            'subtitle' => '对博客的公告进行管理'
        );
    }
    /**
     * @overrides
     */
    protected function initSqlOptions(){
        return array(
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
                    'title' => '新增公告',
                    'icon' => 'fa-plus'
                ),
            )
        );
    }
    /**
     * @overrides
     */
    protected function initFieldsOptions() {
        return array (
            'content' => array(
                'title' => '公告内容',
                'list' => array(
                    'order' => false
                ),
                'form' => array(
                    'type' => 'textarea',
                    'validate' => array (
                        'required' => true
                    ),
                    'attr' => 'style="height: 260px;"'
                )
            ),
            'create_time' => array (
                'list' => array(
                    'title' => '创建时间',
                    'callback' => array('to_time'),
                ),
                'form' => array(
                    'fill' => array(
                        'add' => array('value', time())
                    )
                )
            ),
            'status' => array(
                'title' => '状态',
                'list' => array(
                    'callback' => array('status')
                ),
                'form' => array(
                    'type' => 'select',
                    'style' => 'no-bs-select'
                )
            )
        );
    }
    protected function getOptions_status() {
        return array (
            '1' => '正常',
            '0' => '禁用'
        );
    }
}