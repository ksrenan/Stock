
// Função que verifica se o navegador tem suporte AJAX 
function AjaxF(){
	var ajax;
	
	try{
		ajax = new XMLHttpRequest();
	}catch(e){
		try{
			ajax = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
			try{
				ajax = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				alert("Seu browser não da suporte à AJAX! Escolha outro navegador.");
				return false;
			}
		}
	}
	return ajax;
}
// Função que faz a requisição Ajax ao arquivo PHP
function recarregarFornecedores(){
	var ajax = AjaxF();	
	
	ajax.onreadystatechange = function(){
		if(ajax.readyState == 4)
		{
			document.getElementById('fornecedor').innerHTML = ajax.responseText;
		}
	}
	
	ajax.open("GET", "retorna_fornecedor.php", false);

	ajax.setRequestHeader("Content-Type", "text/html");
	ajax.send();
}
// Função que faz a requisição Ajax ao arquivo PHP
function recarregarItens(){
	var ajax = AjaxF();
	ajax.onreadystatechange = function(){
		if(ajax.readyState == 4)
		{
			document.getElementById('item').innerHTML = ajax.responseText;
		}
	}
	
	ajax.open("GET", "retorna_itens.php", false);

	ajax.setRequestHeader("Content-Type", "text/html");
	ajax.send();

}
// Função responsável por inserir linhas na lista de itens
function inserirItemLista(){
	
	if(document.getElementById('item').value != ""){
		if(document.getElementById('qtde').value != ""){
			if(document.getElementById('qtde').value != 0){
				var qtde = document.getElementById('qtde').value; // Get value Qtde
				var el = document.getElementById('item'); // get Element item
				var LabelItem = el.options[el.selectedIndex].innerHTML; // Get label Element Item

				switch (qtde.length){
				case 1: LabelQtde = "00000"+qtde;
				break;
				case 2: LabelQtde = "0000"+qtde;
				break;
				case 3: LabelQtde = "000"+qtde;
				break;
				case 4: LabelQtde = "00"+qtde;
				break;
				case 5: LabelQtde = "0"+qtde;
				break;
				default: LabelQtde = qtde;
				break;
				}
				
				var codItem = document.getElementById('item').value;
				
				var row = 'Qtde: '+LabelQtde+' | Item: '+LabelItem;

				var ListaItensAdicionados = document.getElementById("ListaItensAdicionados");
				var option = document.createElement("option");
//				option.value = LabelItem+'|'+qtde;
				option.value = codItem+'|'+qtde;
				option.text = row;
				ListaItensAdicionados.add(option);
				document.getElementById("ListaItensAdicionados").size++;
				document.getElementById('qtde').value = "";
				document.getElementById('item').selectedIndex = 0;
				document.getElementById('item').focus();
			}else{
				alert('Quantidade n\u00e3o pode ser igual a zero!');
				document.getElementById('qtde').focus();
			}
		}else{
			alert('Por favor insira um valor no campo quantidade.');
			document.getElementById('qtde').focus();
		}
	}else{
		alert(unescape('Voc\u00ea deve selecionar um item.'));
		document.getElementById('item').focus();
	}

}
function removerItemLista(){
	if(document.getElementById("ListaItensAdicionados").size > 0){
		if(document.getElementById("ListaItensAdicionados").value){
		var index = document.getElementById("ListaItensAdicionados").selectedIndex;
		document.getElementById("ListaItensAdicionados").remove(index);
		document.getElementById("ListaItensAdicionados").size--;
		alert('Item da linha '+(index+1)+' removido com sucesso da lista');
		}else{
			alert('Voc\u00ea n\u00e3o selecionou nenhum item para remover');
		}
	}else{
		alert('Voc\u00ea n\u00e3o tem itens na lista para remover!');
	}
}
