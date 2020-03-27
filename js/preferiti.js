var xmlHttp;

function preferiti(str)
{ 
    xmlHttp=GetXmlHttpObjectPreferiti();
    if (xmlHttp==null)
    {
        alert ("Browser does not support HTTP Request");
        return;
    }
    var url="php/preferiti.php";
    url=url+"?id="+str;
    var action=document.getElementById("preferiti-button").value;
    url=url+"&action="+action;
    xmlHttp.onreadystatechange=stateChangedPreferiti;
    xmlHttp.open("GET",url,true);
    xmlHttp.send(null);

}

function stateChangedPreferiti() 
{ 
    

    if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
    { 
        if((document.getElementById("preferiti-button").value)=="aggiungi-preferiti"){
            document.getElementById("preferiti-button").value="rimuovi-preferiti";
            document.getElementById("preferiti-button").innerHTML="<i class=\"fa fa-heart\"></i>";
        }
        else{
            document.getElementById("preferiti-button").value="aggiungi-preferiti";
            document.getElementById("preferiti-button").innerHTML="<i class=\"fa fa-heart-o\"></i>";
        }
    } 
}

function GetXmlHttpObjectPreferiti()
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