/**
 * Created by GreyFox on 9/2/14.
 */
var Data;
$(document).ready
(

    function()
    {
        console.log('ready');
        $('#sendreqeust').on('click',function ()
        {
            var from = $('#from_date').val();
            var to = $('#to_date').val();
            var days = $('#num_of_days').val();
            var sat = document.getElementById('include_sat').checked;
            var sun = document.getElementById('include_sun').checked;

            var getString='from='+from+'&to='+to+'&days='+days+'&sun='+sun+'&sat='+sat;

            $.ajax({
                    url:'/controlers/api.php',
                    dataType:'json',
                    type:'GET',
                    data: getString,
                    success: function(data)
                    {
                        console.log(data);
                        Data = data;
                        text='';
                        resultDiv.html('');
                        text +='Jours Economique <br>';
                        data.economique.forEach(drawPeriod);

                        text +='Jours Longue <br>';
                        data.longue.forEach(drawPeriod);
                    },
                    error: function(){ console.log('error...!')  }

                }

            );
        });
    }
);
var text= '';
var resultDiv =$('#result');
function drawPeriod(period,index,array)
{

    text += '----> de :'+period.From+' a :'+period.To+' days: '+period.DaysCount+' cost: '+period.Cost+'<br/>';
    period.Holydays.forEach(drawHolyday);
    text+='<br/>';
    resultDiv.html(text);
}
function drawHolyday(holyday,index,array)
{
    text += '---------->  '+ holyday.Name+' le: '+holyday.Date+'<br>';
}