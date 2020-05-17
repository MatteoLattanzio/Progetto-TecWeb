var xmlHttp;

function like(str)
{ 
    xmlHttp=GetXmlHttpObjectLike();
    if (xmlHttp==null)
    {
        alert ("Il browser non supporta la richiesta");
        return;
    }
    var url="php/like.php";
    url=url+"?id="+str;
    var action=document.getElementById("like-button").value;
    url=url+"&action="+action;
    xmlHttp.onreadystatechange=stateChangedLike;
    xmlHttp.open("GET",url,true);
    xmlHttp.send(null);

}

function stateChangedLike() 
{ 
    

    if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
    { 
        if((document.getElementById("like-button").value)=="aggiungi-like"){
            document.getElementById("like-button").value="rimuovi-like";
            document.getElementById("like-button").innerHTML="<i class=\"fa fa-thumbs-up\"></i>";
        }
        else{
            document.getElementById("like-button").value="aggiungi-like";
            document.getElementById("like-button").innerHTML="<i class=\"fa fa-thumbs-o-up\"></i>";
        }

        document.getElementById("count-like").innerHTML=xmlHttp.responseText;
    } 
}

function GetXmlHttpObjectLike()
{
    var xmlHttp=null;
    try
    {
        // Firefox, Opera 8.0+, Safari
        xmlHttp=new XMLHttpRequest();
    }
    catch (e)
    {
        //Internet Explorer
        try
        {
            xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e)
        {
            xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlHttp;
}