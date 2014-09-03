<?php /* Smarty version Smarty-3.1.19, created on 2014-09-03 12:16:38
         compiled from "views\home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:81725406dff5e4e877-56716686%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c4e9f075aa24fd1d92d7ddf9b9c93e3ead799b59' => 
    array (
      0 => 'views\\home.tpl',
      1 => 1409739385,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '81725406dff5e4e877-56716686',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5406dff6048b40_35272139',
  'variables' => 
  array (
    'login' => 0,
    'events' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5406dff6048b40_35272139')) {function content_5406dff6048b40_35272139($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['login']->value)) {?><?php echo $_smarty_tpl->tpl_vars['login']->value;?>
<?php }?>
<pre>
    <?php if (isset($_smarty_tpl->tpl_vars['events']->value)) {?><?php echo $_smarty_tpl->tpl_vars['events']->value;?>
<?php }?>
</pre>
<label for="from_date">From</label>
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
