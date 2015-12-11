window.addEventListener("load", function()
{
	//alert("hello from javascript file");	
	//sessionStorage.removeItem('mycustomercart');
	//document.getElementById("create_table_button").addEventListener("click", buttonhandler);
	console.log("we loaded the index page!");
	//location.href = "#top";
	location.href = "#";
	RemoveChildrenFromElement('message_box');
	GetProductsFromService();	
});

function GetProductsFromService()
{	
	GetProductData();	
}

function GetProductData()
{
	/* Set User Key And Pass for post request */
	var  formData = "securitycode=foo&passkey=bar";
	
		$.ajax({
			url: 'data_service.php',
			type: 'POST',
			data: formData,
			dataType: 'json',
			success: function(data) 
			{ 
				console.log("GetProductData: ", JSON.stringify(data));				
				GetProductDataCallBack(data['data']);
			},
			error: function(data) 
			{ 
				console.log("GetProductData: ", JSON.stringify(data));				
			}			
		});			
}

function GetProductDataCallBack(data)
{
	var a=[];
	
	console.log("GetProductDataCallBack");
		
	WriteJsonDataToDiv(data);
	
	var localData = JSON.stringify(data);
	sessionStorage.setItem('myproductlist', localData);
}

function WriteJsonDataToDiv(data)
{	
	var i = 0;
	// header for products //
	var mytext = "<h3>Our Products</h3>";
	$.each(data, function(key, val) 
	{	
		mytext = mytext.concat("<a href=#viewitem",i++,">Name:", val.name,"</a><br>");
		mytext = mytext.concat("Category:", val.category, "<br>");
		mytext = mytext.concat("Price:$", val.price, "<br>");
		mytext = mytext.concat("<br>");
	});			
	console.log("WriteJsonDataToDiv");
	$("#insert_here").html( mytext);			
}

function GetProductInfoFromSessionStorage()
{
	var data = JSON.parse(sessionStorage.getItem('myproductlist'));
	console.log("Gotdata from session storage");
	return data;
}


window.addEventListener("hashchange", function()
{
	var loc = window.location.hash;	
	console.log("haschange");					
	console.log(loc);	

	SetVisibilityOfElement('view_cart', true);	
	
	if(loc.indexOf('viewitem') !=-1)
	{		
		var a = GetProductInfoFromSessionStorage();		
		
		if(a == null)
		{
			console.log("session storage is empty: returning");
			return;
		}		
		var mytext = "<p><a href=#index>Back To Main</a></p>";		
		
		var dx = loc.replace( /^\D+/g, '');
		console.log("viewitem:----", dx)
				
		if(a[dx] != undefined)
		{
				mytext = mytext.concat("<strong>Name:", a[dx].name,"</strong><br>");
				mytext = mytext.concat("Price:$", a[dx].price, "<br>");
				mytext = mytext.concat("Description:", a[dx].description, "<br>");		
		}
		else
		{
			console.log("Product not found in list");
			return;
		}				
			
		var mybutton = document.createElement("BUTTON");
		mybutton.onclick = AddToCartButton;
		
		mybutton.id = dx;
		mybutton.name = a[dx].name;
		mybutton.innerHTML = "Add To Cart";

		myselect = document.createElement("select");
		myselect.id = "select_quantity";
		
		var numoptions = 4;
		
		for(var i=0; i<numoptions; i++)
		{
			var myoption = document.createElement("OPTION");
			myoption.appendChild(document.createTextNode(i+1));	
			myselect.appendChild(myoption);
		}		
				
		var thediv = $('#insert_here')[0];
		mytext = mytext.concat("<br>");
						
		thediv.innerHTML = mytext;
		thediv.appendChild(mybutton);
		thediv.appendChild(myselect);	

		ClearElementInnerHTML("shopping_cart");
		RemoveChildrenFromElement('message_box');
	}
	else if(loc.indexOf('view_cart') !=-1)
	{	
		ViewCustomerCart(false);
	}
	else if(loc.indexOf('empty_cart') !=-1)
	{
		EmptyCart();
	}	
	else if(loc.indexOf('index') != -1)
	{
		console.log("got the index page from hashchange function");	
		var data = GetProductInfoFromSessionStorage();	
		if(data != null)			
			WriteJsonDataToDiv(data);		
		else
			console.log("data is null can't write products to page");
		
		ClearElementInnerHTML("shopping_cart");
		RemoveChildrenFromElement('message_box');
	}
	else if(loc.indexOf('checkout') != -1)
	{
		SetVisibilityOfElement('view_cart', false);	
		
		var mytext = "<p><a href=#index>Continue Shopping</a></p>";			
		$('#insert_here').html(mytext);
				
		RemoveChildrenFromElement('message_box');
		ViewCustomerCart(true);		
	}
});



function EmptyCart()
{
	DeleteCustomerCartFromStorage();
	RemoveChildrenFromElement('message_box');
	ViewCustomerCart(false);
}
function DeleteCustomerCartFromStorage()
{
	sessionStorage.removeItem("mycustomercart");
}

function ViewCustomerCart(total)
{
	var mytext;
	if(!total)	
		mytext = "<h3>Shopping Cart</h3>";	
	else
		mytext = "<h3>Check Out</h3>";
		
	var totalcost = 0;
		
	
	var myDiv = $("#shopping_cart")[0];
			
	var data = GetCustomerCartFromSessionStorage();
	if (data == null)
	{
		console.log("data was null");
		mytext = mytext.concat("<p>Your Cart is Empty<p>");
		myDiv.innerHTML = mytext;
		
	}
	else
	{
		var mytable = document.createElement("TABLE");
		mytable.border = '1';
		
		var tableBody = document.createElement('TBODY');
		mytable.appendChild(tableBody);
				
		var tr = document.createElement('TR');
			
		tableBody.appendChild(tr);
		
		var headers = ["Name", "Category", "Price", "Quantity"];
		
		for(var i = 0; i<headers.length; i++)
		{
			var th = document.createElement('TH');
			th.appendChild(document.createTextNode(headers[i]));
			tr.appendChild(th);
		}					
				
		$.each(data, function(key, val) 
		{				
			var tr = document.createElement('TR');
			
			tableBody.appendChild(tr);
			
			var td = document.createElement('TD');
			td.appendChild(document.createTextNode(val.name));
			td.setAttribute("class", "long-column");
			tr.appendChild(td);
			
			var a = FindAndReturnFromSessionStorage(val.id);
			
			if(a!=null)
			{
				td = document.createElement('TD');
				td.appendChild(document.createTextNode(a.category));
				td.setAttribute("class", "long-column");					
				tr.appendChild(td);

				td = document.createElement('TD');
				td.appendChild(document.createTextNode("$" + a.price));
				td.setAttribute("class", "short-column");				
				tr.appendChild(td);
				
				
				totalcost += parseInt(a.price)*(val.quantity);
				console.log("totalcost =", totalcost);
			}			
			td = document.createElement('TD');
			td.appendChild(document.createTextNode(val.quantity));
			td.setAttribute("class", "short-column");				
			tr.appendChild(td);	
			
			
		});		
		console.log("totalcost =", totalcost);
		myDiv.innerHTML = mytext;
		myDiv.appendChild(mytable);		
	
		if(total)
		{
			CreateShoppingCartTotalFooter(myDiv, totalcost);			
		}
		else
			CreateShoppingCartNavLinks(myDiv);	
	}	

}

function GetCustomerCartFromSessionStorage()
{
	console.log("GetCustomerCartFromSessionStorage call");
	
	if(sessionStorage.getItem('mycustomercart') == null)
	{
		console.log("mycustomercart is null;");
		return null;		
	}	
	var data = JSON.parse(sessionStorage.getItem('mycustomercart'));
	console.log("Got customer cart from session storage");
	return data;
}

function AddToCartButton()
{
	var currentINNERHTML = this.innerHTML;
	var productid = this.id;
	var productname = this.name;
	
	var quantity = document.getElementById("select_quantity").value;

	console.log("callerbutton:", currentINNERHTML, productname, ":", productid, " -- quantity selected:", quantity);

	AddItemToShoppingCartSessionStorage(productid, productname, quantity);
	
	// change url to signify event //
	location.href = "#addtocart";
}

function AddItemToShoppingCartSessionStorage(productid, productname, quantity)
{
	var data;
	var cartdata = GetCustomerCartFromSessionStorage();	
	
	myDiv = document.getElementById('insert_here');
	
	console.log(" AddItemTo -- quantity:", quantity);
	
	if(cartdata != null)
	{
		console.log("adding to cart");
			
		if(DoesItemExistInCart(cartdata, productid) == true)
		{
			console.log("Item Already Exists In Cart");
			WriteToMessageBox("message_box", "Item already in cart!");
			return;
		}
			
		cartdata.push(				
			{ "name": productname, "id": productid, "quantity" : quantity}
		);	
		data = cartdata;
		
		console.log(JSON.stringify(data));
		
	}
	else if(cartdata == null)
	{
		
		var newdata = [{ "name": productname, "id": productid, "quantity" : quantity}];
		console.log(newdata);
		data = newdata;			
	}			
	var localData = JSON.stringify(data);		
	sessionStorage.setItem('mycustomercart', localData);
	
	var mytext = "Added " + productname + " to cart!";
	WriteToMessageBox("message_box", mytext);
	
	// added item let's refresh cart //
	ViewCustomerCart();
}

function FindAndReturnFromSessionStorage(index)
{
	var b = GetProductInfoFromSessionStorage();

	if(b[index] != null)
	{
		return b[index];
	}
}