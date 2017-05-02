<?php
/**
 * 客户资料列表
 * 均使用本文件作为实际处理代码，只是使用的模板不同，如有相关变动，只需改本文件及相关模板即可
 *
 * @version        $Id: customer_list.php $
 * @author        	andyzhao
 * @time           2013/9/6
 */


//----------------------------------------
//导出excel
//----------------------------------------
if($action == 'exit_xls')
{
	$dsql->SetQuery($query);
	$dsql->Execute('an');
	if($dsql->GetTotalRow('an') <= 0)
	{
		ShowMsg('客户资料为空，请重新导出！', -1);
		exit();
	}
	require_once(DEDEADMIN.'/PHPExcel/PHPExcel.php');
/** 
 * 以下是使用示例，对于以 //// 开头的行是不同的可选方式，请根据实际需要 
 * 打开对应行的注释。 
 * 如果使用 Excel5 ，输出的内容应该是GBK编码。 
 */  
	require_once(DEDEADMIN.'/PHPExcel/PHPExcel/Writer/Excel5.php');     

// 创建一个处理对象实例  
$objExcel = new PHPExcel();  
// 创建文件格式写入对象实例, uncomment  
$objWriter = new PHPExcel_Writer_Excel5($objExcel);    // 用于其他版本格式  
//*************************************  
//设置文档基本属性  
$objProps = $objExcel->getProperties();  
$objProps->setCreator("Andyzhao");   
//*************************************  
//设置当前的sheet索引，用于后续的内容操作。  
//一般只有在使用多个sheet的时候才需要显示调用。  
//缺省情况下，PHPExcel会自动创建第一个sheet被设置SheetIndex=0  
$objExcel->setActiveSheetIndex(0);  
$objActSheet = $objExcel->getActiveSheet();  
  
//设置当前活动sheet的名称  
$objActSheet->setTitle(iconv('gbk', 'utf-8', ' 教育-学硕项目客户资源统计'));  
  
//*************************************  
//A1合并单元格  
$objActSheet->mergeCells('A1:B1');  
$objActSheet->mergeCells('A1:C1'); 
$objActSheet->mergeCells('A1:D1'); 
$objActSheet->mergeCells('A1:D1'); 
$objActSheet->mergeCells('A1:E1'); 
$objActSheet->mergeCells('A1:F1'); 
$objActSheet->mergeCells('A1:J1'); 
$objActSheet->mergeCells('A1:H1'); 
$objActSheet->mergeCells('A1:I1'); 
$objActSheet->mergeCells('A1:J1');
$objActSheet->mergeCells('A1:H1');
$objActSheet->mergeCells('A1:I1');
$objActSheet->mergeCells('A1:J1');
$objActSheet->mergeCells('A1:K1');
$objActSheet->mergeCells('A1:L1');
$objActSheet->mergeCells('A1:M1');
$objActSheet->mergeCells('A1:N1');
$objActSheet->mergeCells('A1:O1');
$objActSheet->mergeCells('A1:P1');
$objActSheet->mergeCells('A1:Q1');
$objActSheet->mergeCells('A1:R1');
$objActSheet->mergeCells('A1:S1');
$objActSheet->mergeCells('A1:T1');
$objActSheet->mergeCells('A1:U1');
$objActSheet->mergeCells('A1:V1');
$objActSheet->mergeCells('A1:W1');


//A2合并单元格  
$objActSheet->mergeCells('A2:B2');  
$objActSheet->mergeCells('A2:C2'); 
$objActSheet->mergeCells('A2:D2'); 
$objActSheet->mergeCells('A2:D2'); 
$objActSheet->mergeCells('A2:E2'); 
$objActSheet->mergeCells('A2:F2'); 
$objActSheet->mergeCells('A2:J2'); 
$objActSheet->mergeCells('A2:H2'); 
$objActSheet->mergeCells('A2:I2'); 
$objActSheet->mergeCells('A2:J2');
$objActSheet->mergeCells('A2:H2');
$objActSheet->mergeCells('A2:I2');
$objActSheet->mergeCells('A2:J2');
$objActSheet->mergeCells('A2:K2');
$objActSheet->mergeCells('A2:L2');
$objActSheet->mergeCells('A2:M2');
$objActSheet->mergeCells('A2:N2');
$objActSheet->mergeCells('A2:O2');
$objActSheet->mergeCells('A2:P2');
$objActSheet->mergeCells('A2:Q2');
$objActSheet->mergeCells('A2:R2');
$objActSheet->mergeCells('A2:S2');
$objActSheet->mergeCells('A2:T2');
$objActSheet->mergeCells('A2:U2');
$objActSheet->mergeCells('A2:V2');
$objActSheet->mergeCells('A2:W2');

//A3A4A5合并
$objActSheet->mergeCells('A3:A4');
$objActSheet->mergeCells('A3:A5');

//B3B4B5合并
$objActSheet->mergeCells('B3:B4');
$objActSheet->mergeCells('B3:B5');
//C3D3E3合并
$objActSheet->mergeCells('C3:D3');
$objActSheet->mergeCells('C3:E3');
//C4C5合并
$objActSheet->mergeCells('C4:C5');
//D4D5合并
$objActSheet->mergeCells('D4:D5');
//E4E5合并
$objActSheet->mergeCells('E4:E5');
//F3F4合并
$objActSheet->mergeCells('F3:F4');
//G3G4合并
$objActSheet->mergeCells('G3:G4');
//H3H4合并
$objActSheet->mergeCells('H3:H4');
//F3G3H3合并
$objActSheet->mergeCells('F3:G3');
$objActSheet->mergeCells('F3:H3');
//I3I4,J3J4合并
$objActSheet->mergeCells('I3:I4');
$objActSheet->mergeCells('J3:J4');
//I3J3合并
$objActSheet->mergeCells('I3:J3');
//K3K4K5
$objActSheet->mergeCells('K3:K4');
$objActSheet->mergeCells('K3:K5');
//L3L4L5
$objActSheet->mergeCells('L3:L4');
$objActSheet->mergeCells('L3:L5');
//M3M4M5
$objActSheet->mergeCells('M3:M4');
$objActSheet->mergeCells('M3:M5');
//N3N4N5
$objActSheet->mergeCells('N3:N4');
$objActSheet->mergeCells('N3:N5');
//O3O4O5
$objActSheet->mergeCells('O3:O4');
$objActSheet->mergeCells('O3:O5');
//P3P4P5
$objActSheet->mergeCells('P3:P4');
$objActSheet->mergeCells('P3:P5');
//Q3Q4Q5
$objActSheet->mergeCells('Q3:Q4');
$objActSheet->mergeCells('Q3:Q5');
//R3R4R5
$objActSheet->mergeCells('R3:R4');
$objActSheet->mergeCells('R3:R5');
//S3S4S5
$objActSheet->mergeCells('S3:S4');
$objActSheet->mergeCells('S3:S5');
//T3T4
$objActSheet->mergeCells('T3:T4');
//U3U4
$objActSheet->mergeCells('U3:U4');
//V3V4
$objActSheet->mergeCells('V3:V4');
//T3U3V3
$objActSheet->mergeCells('T3:U3');
$objActSheet->mergeCells('T3:V3');
//W3W4W5
$objActSheet->mergeCells('W3:W4');
$objActSheet->mergeCells('W3:W5');
//设置单元格内容  
//由PHPExcel根据传入内容自动判断单元格内容类型  
$objActSheet->setCellValue('A1', iconv('gbk', 'utf-8', ' 教育集团 考研项目  (高辅学员)资源统计'));  //  
$objActSheet->setCellValue('A2', iconv('gbk', 'utf-8', '部门主管:   李红艳'));            // 
$objActSheet->setCellValue('A3', iconv('gbk', 'utf-8', '序号'));  
$objActSheet->setCellValue('B3', iconv('gbk', 'utf-8', '咨询时间 '));
$objActSheet->setCellValue('C3', iconv('gbk', 'utf-8', '学员基本信息 '));
$objActSheet->setCellValue('C4', iconv('gbk', 'utf-8', '姓名'));
$objActSheet->setCellValue('D4', iconv('gbk', 'utf-8', '性别'));
$objActSheet->setCellValue('E4', iconv('gbk', 'utf-8', '联系方式'));
$objActSheet->setCellValue('F3', iconv('gbk', 'utf-8', '现专业信息 '));
$objActSheet->setCellValue('F5', iconv('gbk', 'utf-8', '院校'));
$objActSheet->setCellValue('G5', iconv('gbk', 'utf-8', '专业'));
$objActSheet->setCellValue('H5', iconv('gbk', 'utf-8', '应届/在职'));
$objActSheet->setCellValue('I3', iconv('gbk', 'utf-8', '研究生报考信息'));
$objActSheet->setCellValue('I5', iconv('gbk', 'utf-8', '院校'));
$objActSheet->setCellValue('J5', iconv('gbk', 'utf-8', '专业'));
$objActSheet->setCellValue('K3', iconv('gbk', 'utf-8', '咨询课程'));
$objActSheet->setCellValue('L3', iconv('gbk', 'utf-8', '推荐课程'));
$objActSheet->setCellValue('M3', iconv('gbk', 'utf-8', '整体评估'));
$objActSheet->setCellValue('N3', iconv('gbk', 'utf-8', '发布人'));
$objActSheet->setCellValue('O3', iconv('gbk', 'utf-8', '目标签单日期'));
$objActSheet->setCellValue('P3', iconv('gbk', 'utf-8', '实际签单日期'));
$objActSheet->setCellValue('Q3', iconv('gbk', 'utf-8', '实缴金额'));
$objActSheet->setCellValue('R3', iconv('gbk', 'utf-8', '所报课程 '));
$objActSheet->setCellValue('S3', iconv('gbk', 'utf-8', '客户来源渠道'));
$objActSheet->setCellValue('T3', iconv('gbk', 'utf-8', '跟踪状况'));
$objActSheet->setCellValue('T5', iconv('gbk', 'utf-8', '一次'));
$objActSheet->setCellValue('U5', iconv('gbk', 'utf-8', '二次'));
$objActSheet->setCellValue('V5', iconv('gbk', 'utf-8', '三次'));
$objActSheet->setCellValue('W3', iconv('gbk', 'utf-8', '未签单原因'));

$key = 5;
while ($row = $dsql->GetArray('an'))
{
	++$key;
	$objActSheet->setCellValue("A".$key, $row['cu_id']);
	$objActSheet->setCellValue("B".$key, date('Y-m-d',$row['consult_time']));
	$objActSheet->setCellValue("C".$key, iconv('gbk', 'utf-8',$row['cu_name']));
	$objActSheet->setCellValue("D".$key, iconv('gbk', 'utf-8',$row['cu_sex']));
	$objActSheet->setCellValue("E".$key, iconv('gbk', 'utf-8',$row['cu_mobile']));
	$objActSheet->setCellValue("F".$key, iconv('gbk', 'utf-8',$row['now_school']));
	$objActSheet->setCellValue("J".$key, iconv('gbk', 'utf-8',$row['now_major']));
	$objActSheet->setCellValue("H".$key, iconv('gbk', 'utf-8',$row['is_work']));
	$objActSheet->setCellValue("I".$key, iconv('gbk', 'utf-8',$row['cu_school']));
	$objActSheet->setCellValue("J".$key, iconv('gbk', 'utf-8',$row['cu_major']));
	$objActSheet->setCellValue("K".$key, iconv('gbk', 'utf-8',$row['consult_course']));
	$objActSheet->setCellValue("L".$key, iconv('gbk', 'utf-8',$row['recommend_course']));
	$objActSheet->setCellValue("M".$key, iconv('gbk', 'utf-8',$row['evaluate_all']));
	$objActSheet->setCellValue("N".$key, iconv('gbk', 'utf-8',$row['cu_publisher']));
	$objActSheet->setCellValue("O".$key, iconv('gbk', 'utf-8',date('Y-m-d',$row['goal_signtime'])));
	$objActSheet->setCellValue("P".$key, iconv('gbk', 'utf-8',date('Y-m-d',$row['fact_signtime'])));
	$objActSheet->setCellValue("Q".$key, iconv('gbk', 'utf-8',$row['fact_money']));
	$objActSheet->setCellValue("R".$key, iconv('gbk', 'utf-8',$row['choice_course']));
	$objActSheet->setCellValue("S".$key, iconv('gbk', 'utf-8',$row['come_from']));
	$objActSheet->setCellValue("T".$key, iconv('gbk', 'utf-8',$row['follow_first']));
	$objActSheet->setCellValue("U".$key, iconv('gbk', 'utf-8',$row['follow_second']));
	$objActSheet->setCellValue("V".$key, iconv('gbk', 'utf-8',$row['follow_third']));
	$objActSheet->setCellValue("W".$key, iconv('gbk', 'utf-8',$row['no_sign']));
}

//A1单元格格式设定
$objActSheet->getColumnDimension('A1')->setAutoSize(true);  //设置宽度
$objStyleA1 = $objActSheet->getStyle('A1');
 //设置字体  
$objFontA1 = $objStyleA1->getFont();  
$objFontA1->setName(iconv('gbk', 'utf-8', '宋体'));//字体名称  
$objFontA1->setSize(16);  //字号大小
$objFontA1->setBold(true);  //字体加粗
//对齐方式
$objAlignA1 = $objStyleA1->getAlignment();  
$objAlignA1->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
$objAlignA1->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);  //对齐方式
//A2单元格格式设定
$objStyleA2 = $objActSheet->getStyle('A2');
 //设置字体  
$objFontA2 = $objStyleA1->getFont();  
$objFontA2->setName(iconv('gbk', 'utf-8', '宋体'));//字体名称  
$objFontA2->setSize(12);  //字号大小
$objFontA2->setBold(true);  //字体加粗
$objStyleA2 = $objActSheet->getStyle('A2');  
$objFillA2 = $objStyleA2->getFill();  
$objFillA2->setFillType(PHPExcel_Style_Fill::FILL_SOLID);  
$objFillA2->getStartColor()->setARGB('FFEEEEEE');  

//*************************************  
//设置单元格样式  
  
//设置宽度  
$objActSheet->getColumnDimension('A')->setAutoSize(true);  //设置宽度
$objActSheet->getColumnDimension('B')->setAutoSize(true);  
$objStyleA3 = $objActSheet->getStyle('A3');  
$objStyleA3->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);  
//设置字体  
$objFontA3 = $objStyleA3->getFont();  
$objFontA3->setName('Courier New');  
$objFontA3->setSize(10);  
$objFontA3->setBold(true);  
//设置对齐方式  
$objAlignA3 = $objStyleA3->getAlignment();  
$objAlignA3->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
$objAlignA3->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);  
//设置边框  
$objBorderA3 = $objStyleA3->getBorders();  
$objBorderA3->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objBorderA3->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  
$objBorderA3->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  
$objBorderA3->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  
  
//设置填充颜色  
$objFillA3 = $objStyleA3->getFill();  
$objFillA3->setFillType(PHPExcel_Style_Fill::FILL_SOLID);  
$objFillA3->getStartColor()->setARGB('FFEEEEEE');  
  
//从指定的单元格复制样式信息.  
$objActSheet->duplicateStyle($objStyleA3, 'B3:W3');  
$objActSheet->duplicateStyle($objStyleA3, 'C4:V5');  
//添加图片  
$objDrawing = new PHPExcel_Worksheet_Drawing();  
$objDrawing->setName('ZealImg');  
$objDrawing->setDescription('Image inserted by Zeal');  
$objDrawing->setPath('./logo.jpg');  
$objDrawing->setHeight(42);  
$objDrawing->setCoordinates('A1');  
$objDrawing->setOffsetX(10);  
$objDrawing->setRotation(15);  
$objDrawing->getShadow()->setVisible(true);  
$objDrawing->getShadow()->setDirection(42);  
$objDrawing->setWorksheet($objActSheet);

//添加一个新的worksheet  
$objExcel->createSheet();  
$objExcel->getSheet(1)->setTitle(iconv('gbk', 'utf-8', ' 教育-学硕项目客户资源统计'));  
//保护单元格  
$objExcel->getSheet(1)->getProtection()->setSheet(true);  
$objExcel->getSheet(1)->protectCells('A1:W3', 'PHPExcel');  
$outputFileName = iconv('gbk', 'utf-8', ' 教育-学硕项目客户资源统计').''.date('Y-m-d',time()).".xls";  

//到浏览器  
//header("Content-Type: application/force-download");  
//header("Content-Type: application/octet-stream");  
//header("Content-Type: application/download");  
//header('Content-Disposition:inline;filename="'.$outputFileName.'"');  
//header("Pragma: no-cache");  
//$objWriter->save('php://output'); 
ob_end_clean();
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='.$outputFileName);
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5'); 
$objWriter->save('php://output');  
die;
/*
	$file_name = '客户资料'.date('Y-m-d');
	$dsql->SetQuery($query);
	$dsql->Execute('an');
	if($dsql->GetTotalRow('an') <= 0)
	{
		ShowMsg('客户资料为空，请重新导出！', -1);
		exit();
	}
	header("Content-type:application/vnd.ms-excel"); 
	header("Content-Disposition:filename=".$file_name.".xls");
	echo "序号\t姓名\t手机号\t所在地\t报考院校\t专业\t发布人\t备注\t添加时间\r"; 
	$customer = array();
	while ($row = $dsql->GetArray('an'))
	{
		var_dump($row);die;
		$customer[] = $row;
		echo $row['cu_id']."\t";
		echo $row['cu_name']."\t";
		echo $row['cu_mobile']."\t";
		echo $row['cu_address']."\t";
		echo $row['cu_school']."\t";
		echo $row['cu_major']."\t";
		echo $row['cu_publisher']."\t";
		echo $row['cu_remark']."\t";
		echo $row['cu_time']."\t\r";
		
	}
	exit();
*/
}
