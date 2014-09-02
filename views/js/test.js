/**
 * Created by GreyFox on 9/2/14.
 */
$(document).ready
(

    function()
    {
        console.log('ready');
        $('#sendreqeust').on('click',function ()
        {
            $.ajax({
                    url:'/controlers/api.php',
                    dataType:'json',
                    type:'GET',
                    data:'from=2014-03-01&to=2014-03-30&days=7&sun=true&sat=true',
                    success: function(data)
                    {
                        //console.log(data[0]) ;

                        console.log(data);
                    },
                    error: function(){ console.log('error...!')  }

                }

            );
        });
    }
);