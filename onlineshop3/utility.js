function SetVisibilityOfElement(elementname, visible)
{
	if(visible)
		document.getElementById(elementname).style.visibility = "visible";
	else
		document.getElementById(elementname).style.visibility = "hidden";
}

function ClearElementInnerHTML(elementname)
{
	document.getElementById(elementname).innerHTML = "";	
}

function RemoveChildrenFromElement(elementname)
{
	console.log("remove childrem from element:", elementname);
	var boxdiv = document.getElementById(elementname);
	while (boxdiv.hasChildNodes()) 
	{   
		boxdiv.removeChild(boxdiv.firstChild);
	}	
}

function CreateShoppingCartNavLinks(myDiv)
{
	var p = document.createElement('p');	
	var a1 = document.createElement('a');
	a1.href = '#empty_cart';	
	a1.innerHTML = "Empty Cart";
	
	var a2 = document.createElement('a');
	a2.href = '#checkout';
	a2.innerHTML = "Check Out";
	
	t1 = document.createTextNode(" > > ");
	
	p.appendChild(a1);
	p.appendChild(t1);
	p.appendChild(a2);
	
	myDiv.appendChild(p);	
}
function CreateShoppingCartTotalFooter(myDiv, totalprice)
{
	console.log("CreateShoppingCartTotal--- totalprice", totalprice);
	var p = document.createElement('p');
	var txt = "Total______$" + totalprice;
	p.innerHTML = txt;
	p.style.fontWeight = 'bold';
	p.style.fontSize = 24;
	myDiv.appendChild(p);
}

function WriteToMessageBox(elementname, msg)
{
	RemoveChildrenFromElement(elementname);
	
	var p = document.createElement('p');	
	var t = document.createTextNode(msg);
	p.appendChild(t);
	
	var boxdiv = document.getElementById(elementname);
	
	boxdiv.appendChild(p);		
}
// jquery helper //
function DoesItemExistInCart(cartdata, productid)
{
	console.log("DoesItemExistInCart -- productid", productid);
	
	var ret = false;
	
	$.each(cartdata, function(key, val)
	{
		
		if(val.id == productid)
		{		
			ret =  true;
			// return only returns to JQuery // works as a break!
			return;
		}
	});
	return ret;
}