@extends('_layouts.shop')

@section('main-content')
<div class="mid_div common_table caiwu" style="min-height: 600px;">
	<h1 class="h1">财务管理</h1>
	
	<table>
		<tr>
			<td colspan="11" style="font-size: 16px;">{{ Auth::user()->compony ? Auth::user()->compony :Auth::user()->seller->name }} 采购/销售明细账</td>
		</tr>
		<tr>
			<td>序号</td>
			<td>合同签订日期</td>
			<td>合同编号</td>
			<td>合同类型</td>
			<td>客户名称</td>
			<td>合同金额</td>
			<td>应收账款</td>
			<td>应付账款</td>
			<td>实收账款</td>
			<td>实付账款</td>
			<td>余额</td>
		</tr>
		<?php $total=0;$money1=0;$money2=0; $money3=0;$money4=0;$money5=0;?>
		@foreach($rs as $k=>$order)
			<?php $total +=  $order->order_amount; ?>
			@if($order->user_id == Auth::user()->id)
				<?php
					$money2 += $order->order_amount;
					$money4 += $order->paid_amount;
					$money5 += $order->order_amount - $order->paid_amount;
				?>
				<tr>
					<td>{{ $k+1 }}</td>
					<td><?php echo substr($order->created_at,0,4) ?>年<?php echo substr($order->created_at,5,2) ?>月<?php echo substr($order->created_at,8,2) ?>日</td>
					<td>{{ $order->order_sn or '' }}</td>
					<td>采购</td>
					<td>{{ $order->seller->name }}</td>
					<td>{{ $order->order_amount }}</td>
					<td>-</td>
					<td>{{ $order->order_amount }}</td>
					<td>-</td>
					<td>{{ $order->paid_amount }}</td>
					<td>{{ sprintf("%.2f", ($order->order_amount - $order->paid_amount)) }}</td>
				</tr>
			@elseif($order->seller_id == Auth::user()->id)
                    <?php
                    $money1 += $order->order_amount;
                    $money3 += $order->paid_amount;
                    ?>
				<tr>
					<td>{{ $k+1 }}</td>
					<td><?php echo substr($order->created_at,0,4) ?>年<?php echo substr($order->created_at,5,2) ?>月<?php echo substr($order->created_at,8,2) ?>日</td>
					<td>{{ $order->order_sn or '' }}</td>
					<td>销售</td>
					<td>{{ $order->seller->name }}</td>
					<td>-</td>
					<td>{{ $order->order_amount }}</td>
					<td>-</td>
					<td>{{ $order->paid_amount }}</td>
					<td>-</td>
					<td>0</td>
				</tr>
			@endif
		@endforeach
		<tr>
			<td colspan="5">合计</td>
			<td>{{ sprintf("%.2f", $total) }}</td>
			<td>{{ sprintf("%.2f", $money1) }}</td>
			<td>{{ sprintf("%.2f", $money2) }}</td>
			<td>{{ sprintf("%.2f", $money3) }}</td>
			<td>{{ sprintf("%.2f", $money4) }}</td>
			<td>{{ sprintf("%.2f", $money5) }}</td>
		</tr>
	</table>
</div>
@endsection

@section('footer')
	@include('_layouts.shop_footer2')
@endsection