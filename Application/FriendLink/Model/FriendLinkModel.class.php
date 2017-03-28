<?php
namespace FriendLink\Model;
use Common\Model\HyAllModel;

/**
 * 公告管理模型
 *
 * @author
 */
class FriendLinkModel extends HyAllModel {

    /**
     * @overrides
     */
    protected function initTableName(){
        return 'friend_link';
    }

    /**
     * @overrides
     */
    protected function initInfoOptions(){
        return array(
            'title' => '友情链接管理',
            'subtitle' => '对博客的友情链接进行管理'
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
                    'title' => '新增链接',
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
            'name' => array(
                'title' => '链接名称',
                'list' => array(
                    'order' => false
                ),
                'form' => array(
                    'type' => 'text',
                    'validate' => array (
                        'required' => true
                    )
                )
            ),
            'url'=>array(
                'title'=>'链接地址',
                'form' => array (
                    'type' => 'text',
                    'validate' => array (
                        'required' => true ,
                        'regex' => '^((https?|ftp|news):\/\/)?([a-z]([a-z0-9\-]*[\.。])+([a-z]{2}|aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel)|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))(\/[a-z0-9_\-\.~]+)*(\/([a-z0-9_\-\.]*)(\?[a-z0-9+_\-\.%=&]*)?)?(#[a-z][a-z0-9_]*)?$'
                    ),
                    'tip'=>'示例：http://www.baidu.com'
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