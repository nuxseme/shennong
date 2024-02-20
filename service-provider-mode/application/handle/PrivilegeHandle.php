<?php

namespace application\handle;

use application\FieldLog;
use domain\exception\PrivilegeException;
use domain\FieldSettingConstants;

/**
 * 字段权限校验
 * Class PrivilegeHandle
 * @package application\handle
 */
class PrivilegeHandle
{
    private array $fields;
    private array $privilegeConfig;
    private int $noPrivilegeDealWith;

    /**
     * @param array $fields
     * @param array $privilegeConfig
     * @param int $noPrivilegeDealWith
     */
    public function __construct(
        array $fields,
        array $privilegeConfig,
        int $noPrivilegeDealWith = FieldSettingConstants::NO_PRIVILEGE_SILENCE
    ){
        $this->fields = $fields;
        $this->privilegeConfig = $privilegeConfig;
        $this->noPrivilegeDealWith = $noPrivilegeDealWith;
    }

    public function writeProcess(array $data)
    {
        $unsetFieldMap = [];
        foreach ($this->fields as  $field) {
            if(!isset($this->privilegeConfig[$field])) continue;

//            'name' => 1, //读
//           'tel' => 3,//隐藏
//           'order_no' => 2,//写
            //todo 常量细节后续优化
            if($this->privilegeConfig[$field] == 3||$this->privilegeConfig[$field] == 1) {
                //不可写
                if($this->noPrivilegeDealWith == FieldSettingConstants::NO_PRIVILEGE_THROW_EXCEPTION) {
                    throw new PrivilegeException('当前对象字段无写权限');
                }else{
                    //静默处理  unset
                    foreach ($data as &$row) {
                        unset($row[$field]);
                        $unsetFieldMap[] = $field;
                    }
                }
            }
        }
        !empty($unsetFieldMap) && FieldLog::debug(__METHOD__.'unset field map'.print_r($unsetFieldMap,true));
        return $data;

    }

    public function readProcess(array $data)
    {
        $unsetFieldMap = [];
        foreach ($this->fields as  $field) {
            if(!isset($this->privilegeConfig[$field])) continue;

//            'name' => 1, //读
//           'tel' => 3,//隐藏
//           'order_no' => 2,//写
            //todo 常量细节后续优化
            if($this->privilegeConfig[$field] == 3||$this->privilegeConfig[$field] == 2) {
                //不可写
                if($this->noPrivilegeDealWith == FieldSettingConstants::NO_PRIVILEGE_THROW_EXCEPTION) {
                    throw new PrivilegeException('当前对象字段无读权限');
                }else{
                    //静默处理  unset
                    foreach ($data as &$row) {
                        unset($row[$field]);
                        $unsetFieldMap[] = $field;
                    }
                }
            }
        }
        !empty($unsetFieldMap) && FieldLog::debug(__METHOD__.'unset field map'.print_r($unsetFieldMap,true));
        return $data;
    }
}