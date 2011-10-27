<?php
namespace Xnni\Bundle\UtilBundle\Password;

require_once 'Text/Password.php';

/**
 * @author Hidenori Goto <hidenorigoto@gmail.com>
 */
class Generator
{
    const PASSWORD_CHAR = "2,3,4,5,6,7,8,a,b,c,d,e,f,g,h,i,j,k,m,n,o,p,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H,J,K,L,M,N,P,Q,R,S,T,U,V,W,X,Y,Z";

    /**
     * パスワード生成
     *
     * @param integer $length 生成するパスワードの桁数
     *
     * @return string
     */
    public static function generate($length = 10)
    {
        if (!class_exists('Text_Password')) {
            throw new \RuntimeException('Text_Password library does not exists.');
        }

        $obj = new \Text_Password();
        return $obj->create($length, "unpronounceable", self::PASSWORD_CHAR);
    }
}

