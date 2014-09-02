<?php /* Smarty version Smarty-3.1.19, created on 2014-09-02 18:39:51
         compiled from "views\home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:39665405a8dd071614-21126268%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c4e9f075aa24fd1d92d7ddf9b9c93e3ead799b59' => 
    array (
      0 => 'views\\home.tpl',
      1 => 1409675905,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '39665405a8dd071614-21126268',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5405a8dd25d997_03510380',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5405a8dd25d997_03510380')) {function content_5405a8dd25d997_03510380($_smarty_tpl) {?><label for="from_date">From</label>
<input type="date" id="from_date" name="btn" value="send">
<label for="to_date">To</label>
<input type="date" id="to_date" name="btn" value="send">
<label for="num_of_days">number of Days</label>
<input type="text" id="num_of_days" name="btn" value="send">
<label for="include_sat">Saturdays</label>
<input type="checkbox" id="include_sat">
<label for="include_sun">Sundays</label>
<input type="checkbox" id="include_sun">
<input type="button" id="sendreqeust" name="btn" value="send">
<br>
<pre>
    <div id="result" ></div>
</pre>










<script type="text/javascript" src="views/js/jquery.js"></script>
<script type="text/javascript" src="views/js/test.js"></script><?php }} ?>
