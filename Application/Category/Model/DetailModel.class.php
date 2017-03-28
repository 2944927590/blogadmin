<?php
namespace Category\Model;
use Common\Model\HyAllModel;

/**
 * 博客内容管理模型
 *
 * @author
 */
class DetailModel extends HyAllModel {

    /**
     * @overrides
     */
    protected function initTableName(){
        return 'article_detail';
    }

    /**
     * @overrides
     */
    protected function initInfoOptions() {
        return array (
            'title' => '博客内容管理',
            'subtitle' => '管理所有博客内容信息',
        );
    }
    /**
     * @overrides
     */
    protected function initSqlOptions() {

        return array (
            'associate' => array (
                'user|user_id|id|name AS user_name||left',
                'article_category|category_id|id|name AS category_name||left',
                'frame_file|file_id|id|name AS file_name||left'
            ),
            'where' => array (
                'status' => array('lt', 9),
            )
        );
    }
    /**
     * @overrides
     */
    protected function initPageOptions() {
        return array (
            'checkbox'	=> true,
            'deleteType' => 'status|9',
            'actions' 	=> array (
                'edit' => array (
                    'title' => '编辑',
                    'max' => 1
                ),
                'delete' => array (
                    'title' => '删除',
                    // 是否需要确认
                    'confirm' => true
                )
            ),
            'buttons' => array(
                'add' => array(
                    'title' => '新增博客',
                    'icon' => 'fa-plus'
                )
            ),
            'tips' => array(
                'add' => '温馨提示：发布栏目文章内容框的左上角可以放大编辑器',
                'edit' => '温馨提示：发布栏目文章内容框的左上角可以放大编辑器'
            ),
            'initJS' => array(
                'UEditor' => json_encode(
                    array(
                        'source', '|', 'undo', 'redo', '|',
                        'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
                        'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                        'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                        'directionalityltr', 'directionalityrtl', 'indent', '|',
                        'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
                        'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
                        'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe', 'insertcode', 'webapp', 'pagebreak', 'template', 'background', '|',
                        'horizontal', 'date', 'time', 'spechars', 'snapscreen', 'wordimage', '|',
                        'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
                        'print', 'preview', 'searchreplace', 'help', 'drafts'
                    )
                ),
                'Course'
            ),
            'formSize' => 'full',
        );
    }
    /**
     * @overrides
     */
    protected function initFieldsOptions() {
        return array (
            'title' => array(
                'title' => '标题',
                'list' => array (
                    'callback' => array('tplReplace', '{callback}' => array('val_decrypt'), C('TPL_DETAIL_BTN'), '{#}'),
                    'search' => array (
                        'query' => 'like'
                    )
                ),
                'form' => array (
                    'type' => 'text',
                    'validate' => array(
                        'required' => true
                    )
                )
            ),
            'category_id' => array (
                'title' => '博客类别',
                'list' => array(
                    'callback' => array('value', '{:category_name}'),
                    'search' => array (
                        'type' => 'select',
                        'select' => array(
                            'optgroup' => true
                        )
                    )
                ),
                'form' => array (
                    'type' => 'select',
                    'validate' => array(
                        'required' => true
                    ),
                    'select' => array(
                        'optgroup' => true
                    )
                )
            ),
            'content' => array (
                'form' => array(
                    'title' => '博客内容',
                    'type' => 'textarea',
                    'attr' => 'style="height:500px;width:140%;"',
                    'style' => 'make-ueditor',
                    'fill' => array(
                        'both' => array('content')
                    ),
                    'validate' => array(
                        'required' => true
                    ),
                ),
            ),
            'user_id' => array (
                'title' => '发布人',
                'list' => array(
                    'callback' => array('value','{:user_name}')
                ),
                'form' => array (
                    'add' => false,
                    'edit' => false,
                    'fill' => array(
                        'both'=> array('value', ss_uid())
                    )
                )
            ),
            'hits' => array (
                'title' => '点击量',
                'list' => array (
                    'width' => '30'
                ),
                'form' => array (
                    'type' => 'text'
                )
            ),
            'file_id' => array (
                'title' => '上传附件',
                'list' => array(
                    'callback' => array('downfile','{:file_name}')
                ),
                'form' => array (
                    'type' => 'file',
                    'ext'	=>	'jpg,jpeg,png'
                )
            ),
            'is_publish' => array (
                'title' => '是否发布',
                'list' => array (
                    'callback' => array('status'),
                    'search' => array (
                        'type' => 'select',
                        'options' => array(
                            '1' => '已发布',
                            '00' => '未发布',
                        )
                    )
                ),
                'form' => array (
                    'type' => 'select',
                    'options' => array(
                        '1' => '已发布',
                        '0' => '未发布',
                    ),
                    'style' => 'no-bs-select'
                )
            ),
            'create_time' => array (
                'list' => array(
                    'title' => '创建时间',
                    'callback' => array('to_time'),
                ),
                'form' => array(
                    'type' => 'date',
                    'fill' => array(
                        'add' => array('value', time())
                    )
                )
            ),
            'update_time' => array (
                'form' => array(
                    'type' => 'date',
                    'fill' => array(
                        'edit' => array('value', time())
                    )
                )
            ),
            'status' => array (
                'title' => '状态',
                'list' => array (
                    'width' => '30',
                    'callback' => array('status')
                ),
                'form' => array (
                    'type' => 'select',
                    'options' => array(
                        '0' => '禁用',
                        '1' => '正常'
                    ),
                    'style' => 'no-bs-select'
                )
            )
        );
    }

    protected function callback_content() {
        return I('content', '', '');
    }

    protected function callback_downfile($file_id, $file_name){
        if(!$file_id) return '无';
        return '<a href="'.file_down_url($file_id).'" title="'.$file_name.'" class="btn btn-xs green"><i class="fa fa-download"></i> 下载附件</a>';
    }
    protected function getOptions_category_id(){
        $arr = M('article_category')->where(array(
            'status'=>1,
        ))->getField('id,pid,name');
        foreach($arr as $k => $v){
            if(!$v['pid']) {
                foreach($arr as $k1 => $v1) {
                    if($v1['pid'] == $v['id']) {
                        $arr1[$v['name']][$v1['id']] = $v1['name'];
                    }
                }
                $arr2[$v['name']]=[];
            }
        }
        foreach($arr2 as $k2=>$v2){
            foreach($arr1 as $k3=>$v3){
                if($k2==$k3){
                    $arr2[$k2]=$v3;
                }
            }
        }
        foreach($arr2 as $k4=>$v4){
            if(!$v4){
                $id=M('article_category')->where(array('name'=>$k4))->getField('id');
                $arr2[$k4][$id]=$k4;
            }
        }
        return $arr2;
    }
    protected function callback_dateToTime($time){
        return strtotime($time);
    }
    protected function detail($pk) {
        $associate = array(
            'user|user_id|id|name AS user_name||left',
            'article_category|category_id|id|name AS category_name||left',
            'frame_file|file_id|id|name AS file_name||left'
        );
        $arr = $this -> associate($associate) -> where(array(
            'id' => $pk
        )) -> find();
        return array(
            'table' => array(
                'base' => array(
                    'title' => '内容信息',
                    'icon' => 'fa-list-alt',
                    'style' => 'green',
                    'cols' => '0,12',
                    'value' => array(
                        '' => val_decrypt($arr['content']),
                    )
                )
            )
        );
    }
}