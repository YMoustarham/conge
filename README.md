#conge
=====

an application that helps get the must of your holydays by giving user the best period to take thier holydays


 API
 =========================================
 get reults of claculations Ajax example :
 ____________________________________________________________
  $.ajax({
         url:'/controlers/api.php',
         dataType:'json',
         type:'GET',
         data: getString,
         success: function(data)
         {
             console.log(data);
         },
         error: function(){ console.log('error...!')  }

         }

  )
______________________________________________________________

result will be an object with this structure:

    Data.economique  //return list of most economic periods
    Data.longue      //return list of longest periods


   each period object structure is as follow:

    Period.From  //the start date of the period
    Period.TO    //the end date
    Period.Holydays  //list of holydays in this period

    each Holyday object structure is:

    Holyday.Date        //the date :)
    Holyday.Name        //the holyday(s) or event(s) Name(s)
    Holyday.is_holyday  (not important!)

=================================================================

Taches

______________________________________________
//TODO    Create user table
//TODO    registre user with facebook
//TODO    login user with facebook
//TODO    get events
//TODO    recreate calculation core
//TODO    amplement an api (json)
//TODO    need API to support a list of additional include and exclude list of holydays from the client
//TODO    (optional) allow user to set the importance of every holyday befor submitting to API