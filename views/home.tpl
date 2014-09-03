{if isset($login)}{$login}{/if}
<pre>
{if isset($events)}{$events}{/if}
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
<script type="text/javascript" src="views/js/test.js"></script>