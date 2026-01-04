<?php
/**
 * Copyright 2012-2026 ShopeX (https://www.shopex.cn)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

class sales_export_aftersale{

    var $export_title =  array(
            'aftersale' => array(
                'common' => array(
                    '*:店铺名称'          => 'shop_id',
                    '*:订单号'            => 'order_id',
                    '*:售后单号'          => 'aftersale_bn',
                    '*:售后申请单号'      => 'return_id',
                    '*:退换货单号'        => 'reship_id',
                    '*:补差价订单'        => 'diff_order_bn',
                    '*:换货订单号'        => 'change_order_bn',
                    '*:退款申请单号'      => 'return_apply_id',
                    '*:售后类型'          => 'return_type',
                    '*:已退款金额'        => 'refundmoney',
                    '*:退款支付方式'      => 'paymethod',
                    '*:退款申请金额'      => 'refund_apply_money',
                    '*:用户名'            => 'member_id',
                    '*:手机号'            => 'ship_mobile',
                    '*:支付类型'          => 'pay_type',      
                    '*:退款帐号'          => 'account',      
                    '*:退款银行'          => 'bank',      
                    '*:收款帐号'          => 'pay_account',    
                    '*:退款申请时间'      => 'refund_apply_time', 
                    '*:审核人'            => 'check_op_id',
                    '*:质检人'            => 'op_id',
                    '*:退款人'            => 'refund_op_id',
                    '*:售后申请时间'      => 'add_time',
                    '*:审核时间'          => 'check_time',
                    '*:质检时间'          => 'acttime',
                    '*:退款时间'          => 'refundtime',
                    '*:售后单据创建时间'  => 'aftersale_time',
                ),
                'return' => array(
                    '*:店铺名称'          => 'shop_id',
                    '*:订单号'            => 'order_id',
                    '*:售后单号'          => 'aftersale_bn',
                    '*:售后申请单号'      => 'return_id',
                    '*:退换货单号'        => 'reship_id',                    
                    '*:退款申请单号'      => 'return_apply_id',
                    '*:售后类型'          => 'return_type',
                    '*:已退款金额'        => 'refundmoney',
                    '*:退款支付方式'      => 'paymethod',
                    '*:退款申请金额'      => 'refund_apply_money',
                    '*:用户名'            => 'member_id',
                    '*:手机号'            => 'ship_mobile',
                    '*:支付类型'          => 'pay_type',      
                    '*:退款帐号'          => 'account',      
                    '*:退款银行'          => 'bank',      
                    '*:收款帐号'          => 'pay_account',    
                    '*:退款申请时间'      => 'refund_apply_time', 
                    '*:审核人'            => 'check_op_id',
                    '*:质检人'            => 'op_id',
                    '*:退款人'            => 'refund_op_id',
                    '*:售后申请时间'      => 'add_time',
                    '*:审核时间'          => 'check_time',
                    '*:质检时间'          => 'acttime',
                    '*:退款时间'          => 'refundtime',
                    '*:售后单据创建时间'  => 'aftersale_time',
                ),
                'change' => array(
                    '*:店铺名称'          => 'shop_id',
                    '*:订单号'            => 'order_id',
                    '*:售后单号'          => 'aftersale_bn',
                    '*:售后申请单号'      => 'return_id',
                    '*:退换货单号'        => 'reship_id',
                    '*:补差价订单'        => 'diff_order_bn',
                    '*:换货订单号'        => 'change_order_bn',
                    '*:退款申请单号'      => 'return_apply_id',
                    '*:售后类型'          => 'return_type',
                    '*:已退款金额'        => 'refundmoney',
                    '*:退款支付方式'      => 'paymethod',
                    '*:退款申请金额'      => 'refund_apply_money',        
                    '*:用户名'            => 'member_id',
                    '*:手机号'            => 'ship_mobile',
                    '*:支付类型'          => 'pay_type',      
                    '*:退款帐号'          => 'account',      
                    '*:退款银行'          => 'bank',      
                    '*:收款帐号'          => 'pay_account',    
                    '*:退款申请时间'      => 'refund_apply_time',    
                    '*:审核人'            => 'check_op_id',
                    '*:质检人'            => 'op_id',
                    '*:退款人'            => 'refund_op_id',
                    '*:售后申请时间'      => 'add_time',
                    '*:审核时间'          => 'check_time',
                    '*:质检时间'          => 'acttime',
                    '*:退款时间'          => 'refundtime',
                    '*:售后单据创建时间'  => 'aftersale_time',
                ),
                'refund' => array(
                    '*:店铺名称'          => 'shop_id',
                    '*:订单号'            => 'order_id',
                    '*:售后单号'          => 'aftersale_bn',
                    '*:售后申请单号'      => 'return_id',
                    '*:退款申请单号'      => 'return_apply_id',
                    '*:售后类型'          => 'return_type',
                    '*:已退款金额'        => 'refundmoney',
                    '*:退款支付方式'      => 'paymethod',
                    '*:退款申请金额'      => 'refund_apply_money',
                    '*:用户名'            => 'member_id',
                    '*:手机号'            => 'ship_mobile',
                    '*:支付类型'          => 'pay_type',      
                    '*:退款帐号'          => 'account',      
                    '*:退款银行'          => 'bank',      
                    '*:收款帐号'          => 'pay_account',    
                    '*:退款申请时间'      => 'refund_apply_time', 
                    '*:退款人'            => 'refund_op_id',
                    '*:售后申请时间'      => 'add_time',
                    '*:退款时间'          => 'refundtime',
                    '*:售后单据创建时间'  => 'aftersale_time',
                ),
            ),
            'aftersale_items' => array(
                'common' => array(
                    '*:售后单号'       => 'aftersale_bn',
                    '*:支付类型'       => 'pay_type',
                    '*:退款帐号'       => 'account',
                    '*:退款银行'       => 'bank',
                    '*:收款帐号'       => 'pay_account',
                    '*:申请退款金额'   => 'money',
                    '*:已退款金额'     => 'refunded',
                    '*:付款方式'       => 'payment',
                    '*:退款申请时间'   => 'create_time',
                    '*:退款完成时间'   => 'last_modified',
                    '*:货品'           => 'bn',
                    '*:货品名称'       => 'product_name',
                    '*:数量'           => 'num',
                    '*:销售价'         => 'price',
                    '*:仓库名称'       => 'branch_id',
                    '*:售后类型'       => 'return_type',
                ),
                'return' => array(
                    '*:售后单号'       => 'aftersale_bn',
                    '*:支付类型'       => 'pay_type',
                    '*:退款帐号'       => 'account',
                    '*:退款银行'       => 'bank',
                    '*:收款帐号'       => 'pay_account',
                    '*:申请退款金额'   => 'money',
                    '*:已退款金额'     => 'refunded',
                    '*:付款方式'       => 'payment',
                    '*:退款申请时间'   => 'create_time',
                    '*:退款完成时间'   => 'last_modified',
                    '*:货品'           => 'bn',
                    '*:货品名称'       => 'product_name',
                    '*:数量'           => 'num',
                    '*:销售价'         => 'price',
                    '*:仓库名称'       => 'branch_id',
                    '*:售后类型'       => 'return_type',
                ),
                'change' => array(
                    '*:售后单号'       => 'aftersale_bn',
                    '*:支付类型'       => 'pay_type',
                    '*:退款帐号'       => 'account',
                    '*:退款银行'       => 'bank',
                    '*:收款帐号'       => 'pay_account',
                    '*:申请退款金额'   => 'money',
                    '*:已退款金额'     => 'refunded',
                    '*:付款方式'       => 'payment',
                    '*:退款申请时间'   => 'create_time',
                    '*:退款完成时间'   => 'last_modified',
                    '*:货品'           => 'bn',
                    '*:货品名称'       => 'product_name',
                    '*:数量'           => 'num',
                    '*:销售价'         => 'price',
                    '*:仓库名称'       => 'branch_id',
                    '*:售后类型'       => 'return_type',
                ),
                'refund' => array(
                    '*:售后单号'       => 'aftersale_bn',
                    '*:支付类型'       => 'pay_type',
                    '*:退款帐号'       => 'account',
                    '*:退款银行'       => 'bank',
                    '*:收款帐号'       => 'pay_account',
                    '*:申请退款金额'   => 'money',
                    '*:已退款金额'     => 'refunded',
                    '*:付款方式'       => 'payment',
                    '*:退款申请时间'   => 'create_time',
                    '*:退款完成时间'   => 'last_modified',
                    '*:售后类型'       => 'return_type',
                ),
            ),
        );

    /**
     * 导出title方法
     * @param main aftersale 主表字段 aftersale_items 明细字段
     * @param type 退货单(return) 换货单(change) 拒收退货单(refuse) 退款单(refund)  通用(common) 
     * @return void
     * @author 
     **/
    public function io_title($main,$type)
    {
        return $this->export_title[$main][$type];
    }

    /**
     * 导出内容明细方法
     *
     * @return void
     * @author 
     **/
    public function io_contents($main,$type,$data){

        foreach ($this->export_title[$main][$type] as $k => $v){
            $result[$k] = $data[$v];
        }

        return $result;
    }
}