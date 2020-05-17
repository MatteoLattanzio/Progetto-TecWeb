var xmlHttp;

function acquista(str)
{ 
    xmlHttp=GetXmlHttpObjectAcquisto();
    if (xmlHttp==null)
    {
        alert ("Il browser non supporta la richiesta");
        return;
    }
    var url="php/acquista.php";
    url=url+"?id="+str;
    var action=document.getElementById("acquisto-button").value;
    url=url+"&action="+action;
    xmlHttp.onreadystatechange=stateChangedAcquisto;
    xmlHttp.open("GET",url,true);
    xmlHttp.send(null);

}

function stateChangedAcquisto() 
{ 
    

    if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
    { 
        if((document.getElementById("acquisto-button").value)=="aggiungi-carrello"){
            document.getElementById("acquisto-button").value="rimuovi-carrello";
            document.getElementById("acquisto-button").innerHTML="Rimuovi";
        }
        else{
            document.getElementById("acquisto-button").value="aggiungi-carrello";
            document.getElementById("acquisto-button").innerHTML="Acquista";
        }

    } 
}

function GetXmlHttpObjectAcquisto()
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