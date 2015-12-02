window.addEventListener("load", function()
{
	//alert("hello from javascript file");	
	
	//document.getElementById("create_table_button").addEventListener("click", buttonhandler);

	ShowProducts();
	
});

function ShowProducts()
{
	mycontent = document.getElementById("insert_here");
	
	var stuff = "<h3>Our Products</h3>";
	var stuff = stuff.concat(GetHTMLProductList());
	
	mycontent.innerHTML = stuff;			
}


window.addEventListener("hashchange", function()
{
	var loc = window.location.hash;
	
	mycontent = document.getElementById("insert_here");
	
	var a = GetArrayOfProducts();
	
	console.log(loc);
	
	var mytext = "<a href='./index.html'>Back To Main</a><br>";

	if(loc.indexOf('item')	!=-1)
	{
		if(loc.indexOf('viewitem1') != -1)
		{		
			mytext = mytext.concat("<strong>Name:", a[0].name,"</strong><br>");
			mytext = mytext.concat("Price:$", a[0].price, "<br>");
			mytext = mytext.concat("Description:", a[0].description, "<br>");
			
		}		
		else if(loc.indexOf('viewitem2') != -1)
		{		
			mytext = mytext.concat("<strong>Name:", a[1].name,"</strong><br>");
			mytext = mytext.concat("Price:$", a[1].price, "<br>");
			mytext = mytext.concat("Description:", a[1].description, "<br>");		
			
		}	
		else if(loc.indexOf('viewitem3') != -1)
		{		
			mytext = mytext.concat("<strong>Name:", a[2].name,"</strong><br>");
			mytext = mytext.concat("Price:$", a[2].price, "<br>");
			mytext = mytext.concat("Description:", a[2].description, "<br>");
			
		}	
		var str = loc.replace("#", "");
		console.log(str);
		mytext = mytext.concat("<br><input type='button' id='",str,"' value='Add To Cart'></input>");
		mytext = mytext.concat("Quantity:<select name='product_quantity' id='product_quantity'><option value=1>1</option><option value=2>2</option><option value=3>3</option></select>");
		
				
		mycontent.innerHTML = mytext;	
		
		document.getElementById(str).addEventListener("click", AddToCartButton());
	}	
	else
	{
		ShowProducts();
	}
	
});


function AddToCartButton()
{
	console.log("you bought shit");

}


function buttonhandler() {
	
	myelement = document.getElementById("message_box");
	
	if (myelement.innerHTML == "Hello World")
	{
		myelement.innerHTML = "Hello";
	}
	else
		myelement.innerHTML = "Hello World";
		
	mycontent = document.getElementById("insert_here");
	
	var stuff = InitializeObjects();
	
	mycontent.appendChild(stuff);
}

var Product = function(name, category, price, description)
{
	this.name = name;
	this.category = category;
	this.price = price;
	this.description = description;
}

function GetHTMLProductList()
{
	var a = GetArrayOfProducts();
	
	var mytext = "";
	
	for (var i = 0; i < a.length; i++)
	{
		mytext = mytext.concat("<a href=#viewitem",i+1,">Name:", a[i].name,"</a><br>");
		mytext = mytext.concat("Category:", a[i].category, "<br>");
		mytext = mytext.concat("Price:$", a[i].price, "<br>");
		mytext = mytext.concat("<br>");
	}	
	return mytext;
}


function GetArrayOfProducts()
{
	var product1 = new Product("Lucky Jeans", "Pants", 100, "Really Comfortable Jeans");
	var product2 = new Product("Nord Fire 3", "Musical Instruments", 2200, "B3 Organ simulator with Leslie Simulation.");
	var product3 = new Product("Callaway Driver", "Golf", 200, "Driver designed to hit long!");	

	var a=[];
	
	a.push(product1);
	a.push(product2);
	a.push(product3);
	
	return a;
}
function Product(name, category, price, description)
{
	this.name = name;
	this.category = category;
	this.price = price;
	this.description = description;	
}

function InitializeObjects()
{
	var product1 = new Product("Lucky Jeans", "Pants", 200, "Really Comfortable Jeans");
	var product2 = new Product("Nord Fire 3", "Musical Instruments", 2200, "B3 Organ simulator with Leslie Simulation.");
	var product3 = new Product("Callaway Driver", "Golf", 200, "Driver designed to hit long!");	

	var a=[];
	
	a.push(product1);
	a.push(product2);
	a.push(product3);
		
	var mytable = document.createElement('table');
	
	var tr1 = document.createElement('tr');
	
	var th1 = document.createElement('th');
	var th2 = document.createElement('th');
	var th3 = document.createElement('th');
	var th4 = document.createElement('th');	
	
	var header1 = document.createTextNode("Name");
	var header2 = document.createTextNode("Category");
	var header3 = document.createTextNode("Price");
	var header4 = document.createTextNode("Description");
	
	th1.appendChild(header1);
	th2.appendChild(header2);
	th3.appendChild(header3);
	th4.appendChild(header4);
	
	tr1.appendChild(th1);
	tr1.appendChild(th2);
	tr1.appendChild(th3);
	tr1.appendChild(th4);
		
	mytable.appendChild(tr1);
	
	for(var i = 0; i<a.length; i++)
	{
		var tr1 = document.createElement('tr');
		
		var td1 = document.createElement('td');
		var td2 = document.createElement('td');
		var td3 = document.createElement('td');
		var td4 = document.createElement('td');
		
		var text1 = document.createTextNode(a[i].name);
		var text2 = document.createTextNode(a[i].category);
		var text3 = document.createTextNode("$" + a[i].price);
		var text4 = document.createTextNode(a[i].description);
		
		td1.appendChild(text1);
		td2.appendChild(text2);
		td3.appendChild(text3);
		td4.appendChild(text4);

		tr1.appendChild(td1);
		tr1.appendChild(td2);
		tr1.appendChild(td3);
		tr1.appendChild(td4);
		
		mytable.appendChild(tr1);
	}
	document.body.appendChild(mytable);

	mytable["class"] =  "mytable";
	mytable["id"] =  "mytable";
	
	return mytable;
}