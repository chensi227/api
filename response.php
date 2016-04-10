<?php
/**
* 封装API接口类
*/
class Response
{

    const JSON='json';

    /**
    * 按综合方式 返回输出通信数据
    * @static
    * @access public
    * @param int $code 状态码
    * @param string $message 提示信息
    * @param array $data 信息
    * @param string $type 返回的数据类型
    * @return string 
    */
    public static function api($code,$message='',$data=[],$type=self::JSON)
    {
        if(!is_numeric($code)) return '';
        $result=[
            'code'      =>      $code,
            'message'   =>      $message,
            'data'      =>      $data,
        ];

        switch ($type) {
            case 'json':
                self::json($code,$message,$data);
                break;
            case 'xml':
                self::xml($code,$message,$data); 
                break;
            case 'array':
                //供测试用
                var_dump($result); 
                break;
            default:
                //其他数据
                //
                break;
        }
    }

    /**
    * 按json 返回输出通信数据
    * @static
    * @access public
    * @param int $code 状态码
    * @param string $message 提示信息
    * @param array $data 信息
    * @return string 
    */
        public static function json($code,$message='',$data=[])
    {
        if(!is_numeric($code)) return '';
        $result=[
            'code'    =>    $code,
            'message' =>    $message,
            'data'    =>    $data,
        ];

        echo json_encode($result);
        exit;
    }

    /**
    * 按xml 返回输出通信数据
    * @static
    * @access public
    * @param int $code 状态码
    * @param string $message 提示信息
    * @param array $data 信息
    * @return string 
    */
    public static function xml($code,$message='',$data=[])
    {
        if(!is_numeric($code)) return '';
        $result=[
            'code'      =>      $code,
            'message'   =>      $message,
            'data'      =>      $data,
        ];
        $xml='';
        header('Content-Type:text/xml');
        $xml="<?xml version='1.0' encoding='UTF-8'?>\n";
        $xml.="<root>\n";
        $xml.=self::xmlToEncode($result);
        $xml.="</root>";
        echo $xml;
    }

    /**
    * 将数组封装成xml格式
    * @static
    * @access public
    * @param array $data 需要封装的数组
    * @return string 
    */
    public static function xmlToEncode($data)
    {
        if(!is_array($data)) return false;
        $attr=$item='';
        $xml='';
        foreach($data as $key => $value)
        {
            if(is_numeric($key))
            {
                $attr="id='{$key}'";
                $key="item";
            }
            $xml.="<{$key} {$attr}>";
            $xml.=is_array($value)?self::xmlToEncode($value):$value;
            $xml.="</{$key}>\n";
        }
        return $xml;
    }
}