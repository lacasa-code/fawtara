@extends('layouts.app')
@section('content')

<style>
.table>thead>tr>th {
    padding: 12px 2px 12px 4px;
}

.table>tbody>tr>td {
    padding: 5px 2px 5px 2px;
}

#shoInvoice>tbody>.bayan>td {
    padding: 20px 2px 20px 2px;
}


#shoInvoice2>tbody>.sep>td {
    padding: 12px 2px 12px 2px;
}

</style>

<style type="text/css">
     <?php // html { font-family:Calibri, Arial, Helvetica, sans-serif; font-size:11pt; background-color:white } ?>
      a.comment-indicator:hover + div.comment { background:#ffd; position:absolute; display:block; border:1px solid black; padding:0.5em }
      a.comment-indicator { background:red; display:inline-block; border:1px solid black; width:0.5em; height:0.5em }
      div.comment { display:none }
      table { border-collapse:collapse; page-break-after:always }
      .gridlines td { border:1px dotted black }
      .gridlines th { border:1px dotted black }
      .b { text-align:center }
      .e { text-align:center }
      .f { text-align:right }
      .inlineStr { text-align:left }
      .n { text-align:right }
      .s { text-align:left }
      td.style0 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style0 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style1 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style1 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style2 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style2 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style3 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style3 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style4 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style4 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style5 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style5 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style6 { vertical-align:bottom; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style6 { vertical-align:bottom; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style7 { vertical-align:bottom; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style7 { vertical-align:bottom; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style8 { vertical-align:bottom; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style8 { vertical-align:bottom; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style9 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style9 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style10 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style10 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style11 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:12pt; background-color:white }
      th.style11 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:12pt; background-color:white }
      td.style12 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style12 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style13 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style13 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style14 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style14 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style15 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style15 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style16 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style16 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style17 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:8pt; background-color:white }
      th.style17 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:8pt; background-color:white }
      td.style18 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:8pt; background-color:white }
      th.style18 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:8pt; background-color:white }
      td.style19 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:12pt; background-color:#D8D8D8 }
      th.style19 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:12pt; background-color:#D8D8D8 }
      td.style20 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:12pt; background-color:white }
      th.style20 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:12pt; background-color:white }
      td.style21 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#7F7F7F; font-family:'Calibri'; font-size:12pt; background-color:white }
      th.style21 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#7F7F7F; font-family:'Calibri'; font-size:12pt; background-color:white }
      td.style22 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style22 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style23 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:12pt; background-color:white }
      th.style23 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:12pt; background-color:white }
      td.style24 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style24 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style25 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style25 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style26 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#FF0000; font-family:'Calibri'; font-size:11pt; background-color:#D8D8D8 }
      th.style26 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#FF0000; font-family:'Calibri'; font-size:11pt; background-color:#D8D8D8 }
      td.style27 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:16pt; background-color:white }
      th.style27 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:16pt; background-color:white }
      td.style28 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style28 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style29 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:8pt; background-color:white }
      th.style29 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:8pt; background-color:white }
      td.style30 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style30 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style31 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style31 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style32 { vertical-align:bottom; text-align:right; padding-right:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style32 { vertical-align:bottom; text-align:right; padding-right:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style33 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; text-decoration:underline; color:#0563C1; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style33 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; text-decoration:underline; color:#0563C1; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style34 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style34 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style35 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style35 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style36 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style36 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style37 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style37 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style38 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style38 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style39 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#7F7F7F; font-family:'Calibri'; font-size:12pt; background-color:white }
      th.style39 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#7F7F7F; font-family:'Calibri'; font-size:12pt; background-color:white }
      td.style40 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style40 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style41 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style41 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style42 { vertical-align:bottom; text-align:right; padding-right:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style42 { vertical-align:bottom; text-align:right; padding-right:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style43 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style43 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style44 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style44 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style45 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:16pt; background-color:white }
      th.style45 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:16pt; background-color:white }
      td.style46 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#FF0000; font-family:'Calibri'; font-size:16pt; background-color:white }
      th.style46 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#FF0000; font-family:'Calibri'; font-size:16pt; background-color:white }
      td.style47 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style47 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style48 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:8pt; background-color:white }
      th.style48 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:8pt; background-color:white }
      td.style49 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:8pt; background-color:white }
      th.style49 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:8pt; background-color:white }
      td.style50 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#7F7F7F; font-family:'Calibri'; font-size:14pt; background-color:white }
      th.style50 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#7F7F7F; font-family:'Calibri'; font-size:14pt; background-color:white }
      td.style51 { vertical-align:middle; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:14pt; background-color:white }
      th.style51 { vertical-align:middle; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:14pt; background-color:white }
      td.style52 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style52 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style53 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style53 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style54 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:12pt; background-color:#D8D8D8 }
      th.style54 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:12pt; background-color:#D8D8D8 }
      td.style55 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style55 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style56 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style56 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style57 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:8pt; background-color:white }
      th.style57 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:8pt; background-color:white }
      td.style58 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:12pt; background-color:#D8D8D8 }
      th.style58 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:12pt; background-color:#D8D8D8 }
      td.style59 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:12pt; background-color:#D8D8D8 }
      th.style59 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:12pt; background-color:#D8D8D8 }
      table.sheet0 col.col0 { width:90.82222118pt }
      table.sheet0 col.col1 { width:50.83333275pt }
      table.sheet0 col.col2 { width:50.83333275pt }
      table.sheet0 col.col3 { width:147.75555386pt }
      table.sheet0 col.col4 { width:63.03333261pt }
      table.sheet0 col.col5 { width:112.51110982pt }
      table.sheet0 col.col6 { width:53.54444383pt }
      table.sheet0 col.col7 { width:44.05555505pt }
      table.sheet0 col.col8 { width:62.35555484pt }
      table.sheet0 tr { height:15pt }
      table.sheet0 tr.row0 { height:44.25pt }
      table.sheet0 tr.row1 { height:30.75pt }
      table.sheet0 tr.row2 { height:18pt }
      table.sheet0 tr.row3 { height:18pt }
      table.sheet0 tr.row4 { height:18pt }
      table.sheet0 tr.row5 { height:18pt }
      table.sheet0 tr.row6 { height:18pt }
      table.sheet0 tr.row7 { height:18pt }
      table.sheet0 tr.row8 { height:18pt }
      table.sheet0 tr.row9 { height:18pt }
      table.sheet0 tr.row10 { height:18pt }
      table.sheet0 tr.row11 { height:18pt }
      table.sheet0 tr.row12 { height:18pt }
      table.sheet0 tr.row13 { height:18pt }
      table.sheet0 tr.row14 { height:18pt }
      table.sheet0 tr.row15 { height:18pt }
      table.sheet0 tr.row16 { height:18pt }
      table.sheet0 tr.row17 { height:18pt }
      table.sheet0 tr.row18 { height:18pt }
      table.sheet0 tr.row19 { height:18pt }
      table.sheet0 tr.row20 { height:18pt }
      table.sheet0 tr.row21 { height:34.5pt }
      table.sheet0 tr.row22 { height:18pt }
      table.sheet0 tr.row23 { height:18pt }
      table.sheet0 tr.row24 { height:18pt }
      table.sheet0 tr.row25 { height:18pt }
      table.sheet0 tr.row26 { height:18pt }
      table.sheet0 tr.row27 { height:18pt }
      table.sheet0 tr.row28 { height:18pt }
      table.sheet0 tr.row29 { height:18pt }
      table.sheet0 tr.row30 { height:18pt }
      table.sheet0 tr.row31 { height:18pt }
      table.sheet0 tr.row32 { height:18pt }
      table.sheet0 tr.row33 { height:18pt }
      table.sheet0 tr.row34 { height:18pt }
      table.sheet0 tr.row35 { height:18pt }
      table.sheet0 tr.row36 { height:18pt }
      table.sheet0 tr.row37 { height:18pt }
      table.sheet0 tr.row38 { height:18pt }
      table.sheet0 tr.row39 { height:18pt }
      table.sheet0 tr.row40 { height:18pt }
      table.sheet0 tr.row41 { height:22.5pt }
      table.sheet0 tr.row42 { height:22.5pt }
      table.sheet0 tr.row45 { height:16.05pt }
      table.sheet0 tr.row46 { height:16.05pt }
      table.sheet0 tr.row47 { height:16.05pt }
      table.sheet0 tr.row48 { height:16.05pt }
      table.sheet0 tr.row49 { height:10.5pt }
      table.sheet0 tr.row50 { height:16.05pt }
      table.sheet0 tr.row51 { height:16.05pt }
      table.sheet0 tr.row52 { height:23.25pt }
      table.sheet0 tr.row53 { height:17.25pt }
      table.sheet0 tr.row54 { height:18pt }
      table.sheet0 tr.row55 { height:18pt }
    </style>
  </head>

  <body>
<style>
<?php
//@page { margin-left: 0.31496062992126in; margin-right: 0.31496062992126in; margin-top: 0.74803149606299in; margin-bottom: 0.74803149606299in; }
 
//body { margin-left: 0.31496062992126in; margin-right: 0.31496062992126in; margin-top: 0.74803149606299in; margin-bottom: 0.74803149606299in; } ?>
</style>

<!-- page content -->
        <div class="right_col" role="main">
			<!--invoice modal-->
			<div id="myModal-job" class="modal fade setTableSizeForSmallDevices" role="dialog">
				<div class="modal-dialog modal-lg">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header"> 
							<a href=""><button type="button" data-dismiss="modal" class="close">&times;</button></a>
							<h4 id="myLargeModalLabel" class="modal-title">{{ trans('app.Invoice')}}</h4>
						</div>
						<div class="modal-body">
						</div>
					</div>
				</div>
			</div>
			<!--Payment modal-->
			<div id="myModal-payment" class="modal fade" role="dialog">
				<div class="modal-dialog modal-lg">
					<!-- Modal content-->
					<div class="modal-content modal-data">
						
					</div>
				</div>
			</div>
          	<div class="">
           		<div class="page-title">
              		<div class="nav_menu">
            			<nav>
              				<div class="nav toggle">
                				<a id="menu_toggle"><i class="fa fa-bars"></i><span class="titleup">&nbsp; {{ trans('app.Invoice')}}</span></a>
              				</div>
                  			@include('dashboard.profile')
            			</nav>
          			</div>
            	</div>
				@if(session('message'))
				<div class="row massage">
			 		<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="checkbox checkbox-success checkbox-circle">
							@if(session('message') == 'Successfully Submitted')
								<label for="checkbox-10 colo_success"> 
									{{trans('app.Successfully Submitted')}}  
								</label>
				   			@elseif(session('message')=='Successfully Updated')
				   				<label for="checkbox-10 colo_success"> 
				   					{{ trans('app.Successfully Updated')}}  
				   				</label>
				   			@elseif(session('message')=='Successfully Deleted')
				   				<label for="checkbox-10 colo_success"> 
				   					{{ trans('app.Successfully Deleted')}}  
				   				</label>
						   	@elseif(session('message')=='Successfully Sent')
						   	<label for="checkbox-10 colo_success"> 
						   		{{ trans('app.Successfully Sent')}}  
						   	</label>
						   	@elseif(session('message')=='Error! Something went wrong.')
						   		<label for="checkbox-10 colo_success"> 
						   			{{ trans('app.Error! Something went wrong.')}}  
						   		</label>
						   	@endif
                		</div>
					</div>
				</div>
				@endif
            	<div class="row" >
					<div class="col-md-12 col-sm-12 col-xs-12" >
            			<div class="x_content">
							<ul class="nav nav-tabs bar_tabs" role="tablist">
								@can('invoice_view')
									<li role="presentation" class="active"><a href="{!! url('/invoice/list')!!}"><span class="visible-xs"></span><i class="fa fa-list fa-lg">&nbsp;</i><b>{{ trans('app.Invoice List')}}</b></a></li>
								@endcan

								@can('invoice_add')
									<li role="presentation" class=""><a href="{!! url('/invoice/add')!!}"><span class="visible-xs"></span> <i class="fa fa-plus-circle fa-lg">&nbsp;</i>{{ trans('app.Add Invoice')}}</a></li>
								@endcan
								@can('invoice_add')
									<li role="presentation" class="setMarginForAddSalePartInvoiceOnSmallDevice"><a href="{!! url('/invoice/sale_part')!!}"><span class="visible-xs"></span> <i class="fa fa-plus-circle fa-lg">&nbsp;</i>{{ trans('app.Add Sale Part Invoice')}}</a></li>
								@endcan
							</ul>
						</div>
			 			<div class="x_panel setMarginForXpanelDivOnSmallDevice" style="margin-top: 30px;">
			 				<div class="row">
			 					<div class="col-md-4 col-sm-3 col-xs-3">
			 						<img height="60" src="{{ asset('public/admin/image001.jpg') }}" alt="lacasacode"> &nbsp; &nbsp; &nbsp;
 
			 						<?php //<span class="text-lead"> <i><u> Lacasa Code Company </u></i>  </span> ?>
			 					</div>

			 					<div class="col-md-5 col-sm-3 col-xs-3">
			 						<span class="text-lead"> <i><u> 
			 						   قسم المركبات التجارية 
			 							<br> Commercial Vehicles Division 
			 						</u></i> 
			 					   </span>
			 					</div>

			 					<div class="col-md-3 col-sm-4 col-xs-12">  
			 						<?php echo DNS2D::getBarcodeHTML(strval($invoice->id), 'QRCODE', 3,3); ?>
			 						</span>
			 					</div>

			 				</div>
                  			
                            <table border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0 gridlines">
        <col class="col0">
        <col class="col1">
        <col class="col2">
        <col class="col3">
        <col class="col4">
        <col class="col5">
        <col class="col6">
        <col class="col7">
        <col class="col8">
        <tbody>
         <!-- <tr class="row0">
            <td class="column0 style50 null style50" colspan="2"></td>
            <td class="column2 style50 s style50" colspan="4">Company Name</td>
            <td class="column6 style51 s style51" colspan="3">قسم</td>
          </tr>
          <tr class="row1">
            <td class="column0 style45 s style45" colspan="6">&nbsp;INVOICE-فاتورة </td>
            <td class="column6 style27 s">Branch</td>
            <td class="column7 style46 n style46" colspan="2">3652</td>
          </tr>
          <tr class="row2">
            <td class="column0 style42 s style42" colspan="9">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print Date:               </td>
          </tr> -->
          <tr class="row3">
            <td class="column0 style44 null style44" colspan="9"></td>
          </tr>
          <tr class="row4">
            <td class="column0 style0 s">SERVICE SALES</td>
            <td class="column1 style36 s style36" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;INVOICE NO:</td>
            <td class="column4 style44 null style44" rowspan="3"></td>
            <td class="column5 style31 s">رقم الفاتورة</td>
            <td class="column6 style0 s">DATE:</td>
            <td class="column7 style42 s style42" colspan="2">التاريخ</td>
          </tr>
          <tr class="row5">
            <td class="column0 style43 s style43" colspan="4">CUSTOMER NAME:                                                                                                                  </td>
            <td class="column5 style42 s style42" colspan="4">&nbsp;اسم العميل                                                                            </td>
          </tr>
          <tr class="row6">
            <td class="column0 style43 s style43" colspan="4">ADDRESS:</td>
            <td class="column5 style42 s style42" colspan="4">العنوان                                                                         </td>
          </tr>
          <tr class="row7">
            <td class="column0 style36 null style36" colspan="9"></td>
          </tr>
          <tr class="row8">
            <td class="column0 style0 s">CUSTOMER VAT NO:</td>
            <td class="column1 style36 null style36" colspan="2"></td>
            <td class="column3 style32 s">رقم العميل الضريبى</td>
            <td class="column4 style32 null"></td>
            <td class="column5 style36 null style36" colspan="4"></td>
          </tr>
          <tr class="row9">
            <td class="column0 style0 s">TELEPHONE ND:</td>
            <td class="column1 style36 null style36" colspan="2"></td>
            <td class="column3 style32 s">رقم الهاتف :</td>
            <td class="column4 style32 null"></td>
            <td class="column5 style0 s">VAT NO.:</td>
            <td class="column6 style36 null style36" colspan="2">Ahmed</td>
            <td class="column8 style32 s">الرقم الضريبى:</td>
          </tr>
          <tr class="row10">
            <td class="column0 style0 s">CUSTOMER NO:</td>
            <td class="column1 style36 null style36" colspan="2"></td>
            <td class="column3 style32 s">رقم العميل:</td>
            <td class="column4 style32 null"></td>
            <td class="column5 style0 s">BRANCH NAME:</td>
            <td class="column6 style36 null style36" colspan="2"></td>
            <td class="column8 style32 s">اسم الفرع:</td>
          </tr>
          <tr class="row11">
            <td class="column0 style0 s">MCO/JOB NO:</td>
            <td class="column1 style36 null style36" colspan="2"></td>
            <td class="column3 style32 s">رقم امر العمل:</td>
            <td class="column4 style32 null"></td>
            <td class="column5 style0 s">METERS READING (HAS/KM):</td>
            <td class="column6 style36 null style36" colspan="2"></td>
            <td class="column8 style32 s">قراءة العداد:</td>
          </tr>
          <tr class="row12">
            <td class="column0 style0 s">QUOTATION NO:</td>
            <td class="column1 style36 null style36" colspan="2"></td>
            <td class="column3 style32 s">رقم العرض:</td>
            <td class="column4 style32 null"></td>
            <td class="column5 style0 s">FLEET NUMBER:</td>
            <td class="column6 style36 null style36" colspan="2"></td>
            <td class="column8 style32 s">رقم الأسطول :</td>
          </tr>
          <tr class="row13">
            <td class="column0 style0 s">CUSTOMER P.O NO:</td>
            <td class="column1 style36 null style36" colspan="2"></td>
            <td class="column3 style32 s">رقم امر الشراء:</td>
            <td class="column4 style32 null"></td>
            <td class="column5 style0 s">REGISTRATION:</td>
            <td class="column6 style36 null style36" colspan="2"></td>
            <td class="column8 style32 s">رقم التسجيل:</td>
          </tr>
          <tr class="row14">
            <td class="column0 style0 s">CREDIT / CASH:</td>
            <td class="column1 style36 null style36" colspan="2"></td>
            <td class="column3 style32 s">نقدا/ على الحساب:</td>
            <td class="column4 style32 null"></td>
            <td class="column5 style0 s">MANUFACTURER:</td>
            <td class="column6 style36 null style36" colspan="2"></td>
            <td class="column8 style32 s">الصانع:</td>
          </tr>
          <tr class="row15">
            <td class="column0 style0 s">JOPE OPEN DATE:</td>
            <td class="column1 style36 null style36" colspan="2"></td>
            <td class="column3 style32 s">تاريخ بدء العمل:</td>
            <td class="column4 style32 null"></td>
            <td class="column5 style0 s">SERIAL NO:</td>
            <td class="column6 style36 null style36" colspan="2"></td>
            <td class="column8 style32 s">رقم التسلسل:</td>
          </tr>
          <tr class="row16">
            <td class="column0 style0 s">DELIVERY DATE:</td>
            <td class="column1 style36 null style36" colspan="2"></td>
            <td class="column3 style32 s">تاريخ التسليم:</td>
            <td class="column4 style32 null"></td>
            <td class="column5 style0 s">MODEL:</td>
            <td class="column6 style36 null style36" colspan="2"></td>
            <td class="column8 style32 s">الطراز:</td>
          </tr>
          <tr class="row17">
            <td class="column0 style22 null"></td>
            <td class="column1 style22 null"></td>
            <td class="column2 style22 null"></td>
            <td class="column3 style22 null"></td>
            <td class="column4 style22 null"></td>
            <td class="column5 style22 null"></td>
            <td class="column6 style22 null"></td>
            <td class="column7 style22 null"></td>
            <td class="column8 style23 null"></td>
          </tr>
          <tr class="row18">
            <td class="column0 style23 null"></td>
            <td class="column1 style22 null"></td>
            <td class="column2 style22 null"></td>
            <td class="column3 style22 null"></td>
            <td class="column4 style22 null"></td>
            <td class="column5 style22 null"></td>
            <td class="column6 style22 null"></td>
            <td class="column7 style22 null"></td>
            <td class="column8 style22 null"></td>
          </tr>
          <tr class="row19">
            <td class="column0 style34 null style34" colspan="9"></td>
          </tr>
          <tr class="row20">
            <td class="column0 style54 s style59" colspan="7">البيـــــــــــان DESCRIPTION</td>
            <td class="column7 style19 s">AMOUNT</td>
            <td class="column8 style19 s">القيمة</td>
          </tr>
          <tr class="row21">
            <td class="column0 style6 null"></td>
            <td class="column1 style7 null"></td>
            <td class="column2 style7 null"></td>
            <td class="column3 style7 null"></td>
            <td class="column4 style7 null"></td>
            <td class="column5 style7 null"></td>
            <td class="column6 style8 null"></td>
            <td class="column7 style2 null"></td>
            <td class="column8 style3 null"></td>
          </tr>
         
          <tr class="row35">
            <td class="column0 style2 null"></td>
            <td class="column1 style9 null"></td>
            <td class="column2 style9 null"></td>
            <td class="column3 style9 s">VALUE OF SERVICE</td>
            <td class="column4 style9 null"></td>
            <td class="column5 style9 s">قيمة الخدمة</td>
            <td class="column6 style3 null"></td>
            <td class="column7 style2 null"></td>
            <td class="column8 style3 null"></td>
          </tr>
          <tr class="row36">
            <td class="column0 style2 null"></td>
            <td class="column1 style9 null"></td>
            <td class="column2 style9 null"></td>
            <td class="column3 style9 s">DISCOUNT</td>
            <td class="column4 style9 null"></td>
            <td class="column5 style9 s">الخصم</td>
            <td class="column6 style3 null"></td>
            <td class="column7 style2 null"></td>
            <td class="column8 style3 null"></td>
          </tr>
          <tr class="row37">
            <td class="column0 style2 null"></td>
            <td class="column1 style9 null"></td>
            <td class="column2 style9 null"></td>
            <td class="column3 style9 s">TOTAL VALUE</td>
            <td class="column4 style9 null"></td>
            <td class="column5 style9 s">المجموع الكلى </td>
            <td class="column6 style3 null"></td>
            <td class="column7 style2 null"></td>
            <td class="column8 style3 null"></td>
          </tr>
          <tr class="row38">
            <td class="column0 style2 null"></td>
            <td class="column1 style9 null"></td>
            <td class="column2 style9 null"></td>
            <td class="column3 style9 s">VAT 15%</td>
            <td class="column4 style9 null"></td>
            <td class="column5 style9 s">ضريبة القيمة المضافة 15%</td>
            <td class="column6 style3 null"></td>
            <td class="column7 style2 null"></td>
            <td class="column8 style3 null"></td>
          </tr>
          <tr class="row39">
            <td class="column0 style4 null"></td>
            <td class="column1 style10 null"></td>
            <td class="column2 style10 null"></td>
            <td class="column3 style9 s">TOTAL WITH VAT</td>
            <td class="column4 style9 null"></td>
            <td class="column5 style9 s">المجموع الكلى مع الضريبة</td>
            <td class="column6 style5 null"></td>
            <td class="column7 style4 null"></td>
            <td class="column8 style5 null"></td>
          </tr>
          <tr class="row40">
            <td class="column0 style52 s style56" rowspan="2">AMOUNT IN WORDS</td>
            <td class="column1 style35 null style35" colspan="7"></td>
            <td class="column8 style55 s style41" rowspan="2">المبلغ بالأحرف</td>
          </tr>
          <tr class="row41">
            <td class="column1 style34 null style34" colspan="7"></td>
          </tr>
          <tr class="row42">
            <td class="column0">&nbsp;</td>
            <td class="column1">&nbsp;</td>
            <td class="column2">&nbsp;</td>
            <td class="column3">&nbsp;</td>
            <td class="column4">&nbsp;</td>
            <td class="column5">&nbsp;</td>
            <td class="column6">&nbsp;</td>
            <td class="column7">&nbsp;</td>
            <td class="column8">&nbsp;</td>
          </tr>
          <tr class="row43">
            <td class="column0">&nbsp;</td>
            <td class="column1">&nbsp;</td>
            <td class="column2">&nbsp;</td>
            <td class="column3">&nbsp;</td>
            <td class="column4">&nbsp;</td>
            <td class="column5">&nbsp;</td>
            <td class="column6">&nbsp;</td>
            <td class="column7">&nbsp;</td>
            <td class="column8">&nbsp;</td>
          </tr>
          <tr class="row44">
            <td class="column0 style52 s style37" colspan="2">توقيع العميل / الختم</td>
            <td class="column2 style37 s style37" colspan="2">اسم ممثل العميل</td>
            <td class="column4 style30 null"></td>
            <td class="column5 style13 s">مشرف حسابات الورش</td>
            <td class="column6 style37 s style37" colspan="2">مدير عمليات الصيانة</td>
            <td class="column8 style14 s">المدير المالى الاقليمى</td>
          </tr>
          <tr class="row45">
            <td class="column0 style53 s style47" colspan="2">CUSTOMER SGNATURE / STAMP</td>
            <td class="column2 style47 s style47" colspan="2">CUSTOMER REP.NAME</td>
            <td class="column4 style28 null"></td>
            <td class="column5 style15 s">SER. ACC. SUPER</td>
            <td class="column6 style47 s style47" colspan="2">SER. OPR. MANAGER</td>
            <td class="column8 style16 s">MGR. F&amp;A</td>
          </tr>
          <tr class="row46">
            <td class="column0 style2 null"></td>
            <td class="column1 style9 null"></td>
            <td class="column2 style9 null"></td>
            <td class="column3 style9 null"></td>
            <td class="column4 style9 null"></td>
            <td class="column5 style9 null"></td>
            <td class="column6 style9 null"></td>
            <td class="column7 style9 null"></td>
            <td class="column8 style3 null"></td>
          </tr>
          <tr class="row47">
            <td class="column0 style48 s style57" colspan="2">................................................................................</td>
            <td class="column2 style49 s style49" colspan="2">....................................................................</td>
            <td class="column4 style29 null"></td>
            <td class="column5 style17 s">.......................................................................</td>
            <td class="column6 style49 s style49" colspan="2">.......................................................................</td>
            <td class="column8 style18 s">........................................</td>
          </tr>
          <tr class="row48">
            <td class="column0 style2 null"></td>
            <td class="column1 style9 null"></td>
            <td class="column2 style9 null"></td>
            <td class="column3 style9 null"></td>
            <td class="column4 style9 null"></td>
            <td class="column5 style9 null"></td>
            <td class="column6 style9 null"></td>
            <td class="column7 style9 null"></td>
            <td class="column8 style3 null"></td>
          </tr>
          <tr class="row49">
            <td class="column0 style2 null"></td>
            <td class="column1 style9 null"></td>
            <td class="column2 style9 null"></td>
            <td class="column3 style9 null"></td>
            <td class="column4 style9 null"></td>
            <td class="column5 style9 s">INVOICED BY:</td>
            <td class="column6 style9 null"></td>
            <td class="column7 style9 null"></td>
            <td class="column8 style3 s">مصدر الفاتورة</td>
          </tr>
          <tr class="row50">
            <td class="column0 style2 null"></td>
            <td class="column1 style9 null"></td>
            <td class="column2 style9 null"></td>
            <td class="column3 style9 null"></td>
            <td class="column4 style9 null"></td>
            <td class="column5 style26 null"></td>
            <td class="column6 style9 null"></td>
            <td class="column7 style9 null"></td>
            <td class="column8 style3 null"></td>
          </tr>
          <tr class="row51">
            <td class="column0 style24 s">This invoice is subject to the Terms and Stated in the job authorization from E &amp; OE</td>
            <td class="column1 style25 null"></td>
            <td class="column2 style25 null"></td>
            <td class="column3 style25 null"></td>
            <td class="column4 style25 null"></td>
            <td class="column5 style40 s style41" colspan="4">هذة الفاتورة خاضعة للشروط الموضحه فى تصريح امر العمل، ما عدا السهو والخطأ</td>
          </tr>
          <tr class="row52">
            <td class="column0 style35 null style36" rowspan="2"></td>
            <td class="column1 style33 s"><a href="http://www.com/" title="">WWW.COM</a></td>
            <td class="column2 style21 null"></td>
            <td class="column3 style21 s">address</td>
            <td class="column4 style21 null"></td>
            <td class="column5 style21 s">Tel</td>
            <td class="column6 style21 s">Fax</td>
            <td class="column7 style37 null style38" colspan="2" rowspan="2"></td>
          </tr>
          <tr class="row53">
            <td class="column1 style39 null style39" colspan="6"></td>
          </tr>
          <tr class="row55">
            <td class="column0 style20 null"></td>
            <td class="column1 style20 null"></td>
            <td class="column2 style20 null"></td>
            <td class="column3 style20 null"></td>
            <td class="column4 style20 null"></td>
            <td class="column5 style20 null"></td>
            <td class="column6 style20 null"></td>
            <td class="column7 style20 null"></td>
            <td class="column8 style20 null"></td>
          </tr>
        </tbody>
    </table>

                  		</div>
                	</div>
            	</div>
          	</div>
        </div>
<!-- /page content -->

@endsection